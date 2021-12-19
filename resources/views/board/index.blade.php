@extends('layouts.app')


@section('content')



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>

                {{-- PARTIE TABLEAU --}}

        <div class="d-flex justify-content-center align-items-center mb-5">
            <h1 class="d-flex display-4 ml-3">Tableau : <div class="ml-3" id="disappear"> {{$boards->boardname}} </div></h1>

            <div id="appear" style="display:none">
                <form class=" d-flex justify-content-center align-items-center ml-5" action="{{route('home.update', [$boards->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input class="form-control mr-2" name="newName" value="{{$boards->boardname}}">
                    <button class="btncss" type="submit"><img class="imgcss" src="../img/save.png"></button>
                </form>
            </div>
            <button id="name" class="btncss ml-5" type="submit"><img class="imgcss" src="../img/modif.png"></button>

                {{-- Modale pour inviter un ami --}}
            <button class="btn btn-sm ml-3" data-toggle="modal" data-target="#InvitModal" >Inviter un FriendTrello</button>
            <div class="modal fade" id="InvitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title text-light" id="exampleModalLongTitle"> Mes amis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    <form action="{{route('board.store')}}" method="POST">
                    @csrf

                        <div class="modal-body">
                                <label for="mylist">Pour ajouter des amis, vous devez passer à la version <span class="premium">PREMIUM</span> du site.
                                    <br>
                                    <br>
                                    Veuillez envoyer 3 bitcoins à l'adresse suivante pour débloquer cette fonctionnalité:
                                    <br>
                                    0x06230Ec777582E9884c11f89486f1E0deB03Bc8c
                                </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

                {{-- PARTIE LISTES --}}

        <div class="col text-center mb5">
            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModalCenter">
                Ajouter une liste
            </button>
        </div>
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title text-light" id="exampleModalLongTitle"> Mes listes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <form action="{{route('board.store')}}" method="POST">
                @csrf
                    <div class="modal-body">
                            <label for="mylist">Nom de ma liste:</label>
                            <input class="form-control" type="text" name="list">
                            <input type="hidden" name="id_board" value="{{$boards->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="listContainer ml-3">
                @foreach($boards->listBoards as $listBoard)
                <div class="card mr-3 mt-3" style="width: 18rem;">
                    <div class="card-header">

                        <div class="d-flex justify-content-around">
                            <div class="listTitle hiddenList{{$listBoard->id}}"> {{$listBoard->listname}}</div>
                            <div class="appearList{{$listBoard->id}}" style="display:none">
                            <form class="d-flex" action="{{route('board.update', [$listBoard->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                    <input class="inputModify" name="newListName" value="{{$listBoard->listname}}">
                                    <button class="btnSave btncss ml-2" type="submit"><img class="imgcss" src="../img/save.png"></button>
                            </form>
                            </div>


                            <button class="list_btn btncss ml-2" data-list-id="{{$listBoard->id}}" type="submit"><img class="imgcss" src="../img/modif.png"></button>

                            <form action="{{route('board.destroy', [$listBoard->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btncss ml-2" type="submit"><img class="imgcss" src="../img/suppr.png"></button>

                            </form>
                        </div>


                {{-- PARTIE CARDS --}}

                            <form action="{{route('card.store')}}" method="POST">
                                @csrf
                                <label for="cards"></label>
                                <input type="text" name="cardname" id="cards">
                                <input type="hidden" name="id_list" value="{{$listBoard->id}}">
                            </form>
                    </div>
                        @foreach ($listBoard->cards as $card)
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-around"><a href="" data-target="#{{$card->id}}" data-toggle="modal" > <div class="hiddenCard{{$card->id}}">{{$card->cardname}}  </div> </a>
                                    <div class="appearCard{{$card->id}}"  style="display:none">
                                    <form class="d-flex" action="{{route('card.update', [$card->id])}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input name="newCardName" class="w-75" value="{{$card->cardname}}">
                                        <button class="btnCssWhite ml-2" type="submit"><img class="imgcss" src="../img/save.png"></button>
                                    </form>
                                    </div>
                                    <button  class="click_btn btnCssWhite ml-2" data-card-id="{{$card->id}}" type="button" ><img class="imgcss" src="../img/modif.png"></button>
                                    <form action="{{route('card.destroy', [$card->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btnCssWhite ml-2" type="submit"><img class="imgcss" src="../img/suppr.png"></button>

                                    </form>
                                      <!-- Modal -->

                                      <div class="modal fade" id="{{$card->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title text-light" id="exampleModalLongTitle">{{$card->cardname}}</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>

                {{-- PARTIE COMMENTAIRES --}}

                                            <div class="modal-body">
                                                <form action="{{route('comment.store')}}" method="POST">
                                                    @csrf
                                                    <label for="comments">Vos commentaires : </label>
                                                    <input type="text" name="comment" id="comments">
                                                    <input type="hidden" name="id_card" value="{{$card->id}}">
                                                    <input type="hidden" name="id_users" value="{{Auth::user()->id}}">
                                                    <div class="modal-footer d-flex flex-column">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary">Commenter</button>
                                                        </div>
                                                </form>
                                                        <div>
                                                            <ul class="list-group">
                                                                @foreach ( $card->comments as $comment )
                                                                    <li class="list-group-item d-flex justify-content-end">
                                                                        <div class="hiddenComment{{$comment->id}}">{{$comment->comment}} </div>
                                                                        <div class="appearComment{{$comment->id}}" style="display:none">
                                                                        <form class="d-flex" action="{{route('comment.update', [$comment->id])}}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <input class="inputModify" name="newCommentName" value="{{$comment->comment}}">
                                                                            <button class="btnCssWhite ml-2" type="submit"><img class="imgcss" src="../img/save.png"></button>
                                                                        </form>
                                                                        </div>
                                                                        <button  class="click_btn_comment btnCssWhite ml-5" data-comment-id="{{$comment->id}}" type="button"><img class="imgcss" src="../img/modif.png"></button>
                                                                        <form action="{{route('comment.destroy', [$comment->id])}}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btnCssWhite ml-2" type="submit"><img class="imgcss" src="../img/suppr.png"></button>
                                                                        </form>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                     @endforeach
                </div>
            @endforeach
        </div>

<script type="text/javascript">

// Button call and click event to show or hide divs
$("#name").click(
        function()
        {
          $("#appear").show();
          $("#disappear").hide();
        }
      );

//run Javascript code as soon as the DOM becomes safe to manipulate
$(document).ready(function() {
//query selector on button
    let list_btn = $('.list_btn');

    list_btn.on('click', function () {
        /**
        * select the clicked button and get his data attribute on clicked button ()
        * @param int list-id
        */
        let target_btn_list = $(this).data('list-id');
        /*
        *Query selector the divs to hide and show
        *then hide and show the targeted id
        */
        $('.appearList' + target_btn_list).show();
        $('.hiddenList' + target_btn_list).hide();

    })
});


$(document).ready(function(){


    let card_btn = $('.click_btn');
    card_btn.on('click',function(){

      let target_btn_card =  $(this).data('card-id');
        $('.appearCard'+ target_btn_card).show();
        $('.hiddenCard'+ target_btn_card).hide();
    })

    });
$(document).ready(function(){

    let comment_btn = $('.click_btn_comment');
    comment_btn.on('click',function(){

        let target_comment = $(this).data('comment-id');

        $('.appearComment'+ target_comment).show();
        $('.hiddenComment'+ target_comment).hide();
    })
});






        </script>

</body>
</html>

@endsection



