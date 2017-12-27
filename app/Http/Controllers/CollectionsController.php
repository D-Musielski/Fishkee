<?php

namespace App\Http\Controllers;

use App\Language;
use App\Card;
use App\Category;
use App\Collection;

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
        return view('user.collections.create', compact('langs', 'cats', 'user_id'));
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
            'user_id' => $request->user_id
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

        /* TODO */
        // Check if some of the cards changed
        // if ($request->fronty != null) {
        //     for ($i = 0; $i < sizeof($request->fronty); $i++) {
        //         if ($cards->where('front',$request->fronty[$i])->count() == 0 || $cards->where('back',$request->backi[$i])->count() == 0) {
        //             $card = Card::create([
        //                 'front' => $request->fronty[$i],
        //                 'back' => $request->backi[$i]
        //             ]);
        //             $collection->cards()->attach($card);
        //         } else {
        //             $collection->cards()->sync($cards->where('front',$request->fronty[$i]));
        //         }
        //     }
        // }
        // Check if some of the cards changed

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
        //
    }
}
