<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
            'comment' => 'required',
            'id_card' => 'required',
            'id_users' => 'required',
        ]);

        /**
         * we get the data from the inputs in the form and assign them to variables
         * on récupère les données des inputs dans le formulaire et on les affecte à des variables
         */
        $comment = $request->input('comment');
        $id_card = $request->input('id_card');
        $id_users = $request->input('id_users');

        /**
         * we get the data in a variable in order to send them to the database
         * on récupère les données dans une variable afin des les envoyées dans la base de donnée
         */
        $comment = [
            'comment' => $comment,
            'id_card' => $id_card,
            'id_users' => $id_users,
        ];
        /**
         * Create data in DataBase then redirect if success
         */
        Comment::create($comment);
        return back();
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
        //Find comment by id from DDB
        $name = Comment::find($id);
        //Get value from input with $request
        $name->comment = $request->input('newCommentName');
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
        $comment = Comment::find($id);
        //Then delete it from DDB
        $comment->delete();
        return back();
    }
}
