@extends('layouts.app')
@section('content')
<body>

    <h1>Edition profil</h1>

    {{-- If the condition is met then the controller returns the value success and displays the message it contains --}}
    @if(session()->has('success'))
    {{session()->get('success')}}
    @endif
    @if($errors->any())
    <div>
        <p class="fontStyle">Une erreur est survenu veuillez réessayer</p>
    </div>
    @endif

    {{-- Route for changing the profile --}}
    <form action="{{route('profil.update', [Auth::id()])}}" method="post">
    @csrf
    @method('PUT')

    <label for="name" class="fontStyle">Nom</label>
    <input type="text" name="name" id="name" value="{{$users->name}}">
        {{-- Error message details --}}
        @if($errors->has('name'))
        {{$errors->first('name')}}
        @endif

    <label for="email" class="fontStyle">Email</label>
    <input type="text" name="email" id="email" value="{{$users->email}}">
        @if($errors->has('email'))
        {{$errors->first('email')}}
        @endif


    <button class="btn" type="submit">Valider</button>
    </form>

@endsection
