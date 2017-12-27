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
    public function update($collection_id, $front, $back)
    {
        // $cards = Card::all();
        
        // if($cards->where('front', $front)->where('back', $back)) {
        //     $card = $cards->where('front', $front)->where('back', $back);
        //     $collection = Collection::find($collection_id);
        //     $collection->cards()->attach($card);
        // } else {
        //     $card = Card::create([
        //         'front' => $front,
        //         'back' => $back
        //     ]);
        //     $collection = Collection::find($collection_id);
        //     $collection->cards()->attach($card);
        // }

        // return redirect()->route('collections');
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
