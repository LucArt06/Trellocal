<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Listboard;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'list' => 'required',
            'id_board' => 'required'

        ]);
        /**
         * we get the data from the inputs in the form and assign them to variables
         * on récupère les données des inputs dans le formulaire et on les affecte à des variables
         */
        $id_board = $request->input('id_board');
        $listname = $request->input('list');
        /**
         * we get the data in a variable in order to send them to the database
         * on récupère les données dans une variable afin des les envoyées dans la base de donnée
         */
        $list = [

            'listname' => $listname,
            'id_board' => $id_board
        ];
        /**
         * Create data in DataBase then redirect if success
         */
        Listboard::create($list);

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
        //Find list by id from DDB
        $name = Listboard::find($id);
        //Get value from input with $request
        $name->listname = $request->input('newListName');
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
        //Find List by id from DDB
        $list = Listboard::find($id);
        //Then delete it from DDB
        $list->delete();
        return back();
    }
}
