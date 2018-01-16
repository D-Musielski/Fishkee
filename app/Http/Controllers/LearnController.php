<?php

namespace App\Http\Controllers;

use Auth;
use App\Collection;
use Illuminate\Http\Request;

class LearnController extends Controller
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
        return view('user.learning.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
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

    public function learn($id)
    {
        $collection = Collection::find($id);
        $cards = $collection->cards;

        $cards = $cards->shuffle();

        $cardsToLearn = $cards->filter(function($card){
            return $card->pivot->knows == 0;
        });

        $collection_id = $id;

        $card = $this->randomCard($cardsToLearn);
        
        return view('user.learning.learn', compact('card','cards', 'cardsToLearn', 'collection_id'));
    }

    public function randomCard($cards)
    {
        if ($cards->count() > 0) {
            return $cards->first();
        } else {
            return 'Brawo! Nauczyłeś się już wszystkich słówek!';
        }
    }
    
    public function know($collection_id, $card_id)
    {
        $collection = Collection::find($collection_id);
        $cards = $collection->cards;
        $card = $cards->find($card_id);
        $card->pivot->knows = 1;
        $card->pivot->save();
        
        return redirect()->back();
    }
    
    public function restart($id)
    {
        $collection = Collection::find($id);

        foreach ($collection->cards as $card) {
            $card->pivot->knows = 0;
            $card->pivot->update();
        }

        return redirect()->back();
    }
}
