<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
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
        /**
         * we check that the data in the inputs are present
         * on verifie que les données dans les inputs sont bien présente
         */
        $request->validate([
            'cardname' => 'required',
            'id_list' => 'required',
        ]);
        /**
         * we get the data from the inputs in the form and assign them to variables
         * on récupère les données des inputs dans le formulaire et on les affecte à des variables
         */
        $cardname = $request->input('cardname');
        $id_list = $request->input('id_list');
        /**
         * we get the data in a variable in order to send them to the database
         * on récupère les données dans une variable afin des les envoyées dans la base de donnée
         */
        $card = [
            'cardname' => $cardname,
            'id_list' => $id_list,
        ];

        /**
         * Create data in DataBase then redirect if success
         */

        Card::create($card);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$card = Card::find($id);

        //return view('board.index', compact('card'));
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
        //Find Card by id from DDB
        $name = Card::find($id);
        //Get value from input with $request
        $name->cardname = $request->input('newCardName');
        //Save the new data
        $name->save();
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
        //Find Card by id from DDB
        $card = Card::find($id);
        //Then delete it from DDB
        $card->delete();
        return back();
    }
}
