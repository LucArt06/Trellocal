@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">

                <div class="card-header">{{ ('Vos Tableaux') }}</div>

                <div class="card-body">

                    {{-- Connection requirements --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Displaying the user name --}}
                    {{ Auth::user()->name.(' - Vous êtes connecté(e)!') }}
                </div>
                <div>
                    <!-- Button trigger modal -->
                    <div class="col text-center mb5">
                        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                            Créer Tableau
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-light" id="exampleModalLongTitle"> Créer un Tableau</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form action="{{route('home.store')}}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <label for="boardname">Nom du Tableau :</label>
                                    <input class="form-control "type="text" name="boardname">
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                                <button type="submit" class="btn btn-primary">Créer</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="boardContainer">
                    {{-- Foreach on the elements of the "Board" table  --}}
                    @foreach ($boards as $board )

                    <a class="boardContain" href="{{ route('board.show', [$board->id]) }}">

                        <p>{{$board->boardname}}</p>

                        {{-- Delete button to delete an array --}}

                        <form action ="{{ route('home.destroy', [$board->id]) }} "method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn-css-board ml-2" type="submit"><img class="imgcss" src="../img/suppr.png"></button>
                        </form>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
