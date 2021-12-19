<?php

namespace App\Http\Controllers;

use App\Models\Board;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Recovery of the ID to be able to link it to the recovery of the tables
        $user = Auth::user()->id;

        // Retrieving data from the TABLE table based on the user ID
        $board = Board::where('id_users', $user)->orderByDesc('id')->get();


        //Redirect to home view with $board
        return view('home')->with([
            'boards' => $board
        ]);
    }

    public function create()
    {

        return view('home.create');
    }

    public function store(Request $request)
    {
        /**
         * we check that the data in the inputs are present
         * on verifie que les données dans les inputs sont bien présente
         */
        $request->validate([
            'boardname' => ['required'],
        ]);

        /**
         * we get the data from the inputs in the form and assign them to variables
         * on récupère les données des inputs dans le formulaire et on les affecte à des variables
         */
        $board = [
            'boardname' => $request->input('boardname'),
            'id_users' => Auth::user()->id, //Get user id from Auth::
        ];

        //Create data in Database
        Board::create($board);

        //on passe par une redirection qui redirigera la bonne data via l'index.
        //on utilise pas  return view('blog.index')
        return redirect()->route('home.index');
    }

    /**
     * Récupération des lists et des cards en fonction de l'id_user et id_board grâce au model et aux relations
     * Recovery of lists and cards according to the id_user and id_board thanks to the model and the relations.
     * @param int id
     */

    public function show($id)
    {
        //Assignement to a variable of the id of the connected user
        $user = Auth::user()->id;




        $boards = Board::with('listBoards.cards')->where('id_users', $user)->whereId($id)->firstOrFail();

        return view('board.index', compact('boards'));
    }

    public function update(Request $request, $id)
    {
        //Find board by id from DDB
        $name = Board::find($id);
        //Get value from input with $request
        $name->boardname = $request->input('newName');
        //Save the new data
        $name->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        //Find board by id from DDB
        $board = Board::find($id);
        //Then delete it from DDB
        $board->delete();
        return redirect()->back();
    }
}
