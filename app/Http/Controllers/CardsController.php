<?php

namespace App\Http\Controllers;

use App\Card;
use App\Collection;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update($collection_id, $card_id, $front, $back)
    {
        $collection = Collection::find($collection_id);
        $card = $collection->cards()->find($card_id);
        dd($card->front, $front);
        if ($card->front != $front || $card->back != $back) {
            dd('asd');
            $existingCard = Card::where('front', $front)->where('back', $back)->first();
            if ($existingCard != null) {
                $collection->cards()->detach($card);
                $collection->cards()->attach($existingCard);
            } else {
                $newCard = Card::create([
                    'front' => $front,
                    'back' => $back
                    ]);
                $collection->cards()->detach($card);
                $collection->cards()->attach($newCard);
            }
        }
        
        return redirect()->route('collection.edit', ['id' => $collection_id]);
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

    public function deleteCard($collection_id, $id)
    {
        $card = Card::find($id);
        $collection = Collection::find($collection_id);
        $collection->cards()->detach($card);

        return redirect()->back();
    }
}
