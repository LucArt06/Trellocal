<?php

namespace App\Http\Controllers;

use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = Authorization::where('id_users', Auth::id())->get();
        return view('autho.index', compact('shares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autho.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'board_id' => 'required',
            'users_id' => 'required',
            'delete' => 'required',
            'modify' => 'required',
            'public' => 'required'

        ]);

        $id_board = $request->input('board_id');
        $id_users = $request->input('users_id');
        $delete = $request->input('delete');
        $modify = $request->input('modify');
        $public = $request->input('public');


        $auth = [
            'id_board' => $id_board,
            'id_users' => $id_users,
            'delete' => $delete,
            'modify' => $modify,
            'public' => $public,
        ];

        Authorization::create($auth);
        //on passe par une redirection qui redirigera la bonne data via l'index.
        //on utilise pas  return view('blog.index')
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
}
