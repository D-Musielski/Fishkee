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
    public function update(Request $request, $collection_id, $card_id, $front, $back)
    {
        $collection = Collection::find($collection_id);
        $card = $collection->cards()->find($card_id);

        if ($card->front != $request->front || $card->back != $request->back) {
            $existingCard = Card::where('front', $request->front)->where('back', $request->back)->first();
            if ($existingCard != null) {
                $collection->cards()->detach($card);
                $collection->cards()->attach($existingCard);
            } else {
                $newCard = Card::create([
                    'front' => $request->front,
                    'back' => $request->back
                    ]);
                $collection->cards()->detach($card);
                $collection->cards()->attach($newCard);
            }
        }
        
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

    public function deleteCard($collection_id, $id)
    {
        $card = Card::find($id);
        $collection = Collection::find($collection_id);
        $collection->cards()->detach($card);

        return redirect()->back();
    }
}
