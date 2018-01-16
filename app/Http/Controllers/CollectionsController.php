<?php

namespace App\Http\Controllers;

use App\Language;
use App\Card;
use App\Category;
use App\Collection;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = new Collection();
        $collections = $collection->userCollections(Auth::id());
        return view('user.collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = Language::all();
        $cats = Category::all();
        $user_id = Auth::id();
        $user = User::find($user_id);
        $groups = $user->groups;

        return view('user.collections.create', compact('langs', 'cats', 'user_id', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collection = Collection::create([
            'name' => $request->name,
            'language_id' => $request->language_id,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'private' => $request->rights,
            'group' => $request->group
        ]);

        return redirect()->route('collections');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Collection::find($id);
        $cards = $collection->cards;

        return view('user.collections.edit', compact('collection', 'cards'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cards = Card::all();
        $collection = Collection::find($id);

        // Collection name change
        if ($collection->name != $request->name) {
            $collection->name = $request->name;
            $collection->save();
        }
        // Collection name change

        // Add new card to collection
        if ($request->front != '' && $request->back != '') {
            
            if ($cards->where('front', $request->front)->count() > 0 && $cards->where('back', $request->back)->count() > 0) {
                $card = $cards->where('front', $request->front)->where('back', $request->back);
                $collection->cards()->attach($card);
            } else {
                $card = Card::create([
                    'front' => $request->front,
                    'back' => $request->back
                ]);
                $collection->cards()->attach($card);
            }
        }
        // Add new card to collection
        
        
                
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $collection = Collection::find($id);
        $collection->delete();

        return redirect()->back();
    }

    public function browseIndex()
    {
        $langs = Language::all();
        $cats = Category::all();

        return view('user.collections.browse.index', compact('langs','cats'));
    }

    public function browse(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $groups = $user->groups;
        $collections = Collection::all();
        $public = Collection::where('language_id', $request->language_id)
                            ->where('category_id', $request->category_id)
                            ->where('private', 0)
                            ->where('group', 0)
                            ->get();

        $group = array();
        foreach ($groups as $g) {
            $group = $collections->where('group', $g->id);
        }
        
        return view('user.collections.browse.browse', compact('public', 'group'));
    }

    public function browseCollection($id)
    {
        $collection = Collection::find($id);
        $cards = $collection->cards;

        return view('user.collections.browse.collection', compact('collection', 'cards'));
    }

    public function add($id)
    {
        $collection = Collection::find($id);

        $new_collection = $collection->replicate();
        $new_collection->user_id = Auth::user()->id;
        $new_collection->group = 0;
        $new_collection->save();

        foreach ($collection->cards as $card) {
            $new_collection->cards()->attach($card);
        }

        $collection = new Collection();
        $collections = $collection->userCollections(Auth::id());

        return view('user.collections.index', compact('collections'));
    }

    public function merge(Request $request)
    {
        $collection1 = Collection::find($request->collection1);
        $collection2 = Collection::find($request->collection2);

        $cards1 = $collection1->cards;
        $cards2 = $collection2->cards;

        $newCollection = Collection::create([
            'name' => $collection1->name . ' + ' . $collection2->name,
            'language_id' => $collection1->language_id,
            'category_id' => $collection1->category_id,
            'user_id' => $collection1->user_id,
            'private' => $collection1->private,
            'group' => $collection1->group
        ]);

        foreach ($cards1 as $card) {
            $newCollection->cards()->attach($card);
        }

        foreach ($cards2 as $card) {
            $newCollection->cards()->attach($card);
        }

        return redirect()->back();
    }
}
