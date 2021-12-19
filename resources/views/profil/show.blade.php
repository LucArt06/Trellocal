
@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

@section('content')

<div class="d-flex justify-content-center align-items-center flex-column">
    <p class="fontStyle">Pseudo: {{$users->name}}</p>
    <p class="fontStyle">Email: {{$users->email}}</p>
    <form action="{{route('profil.edit',[Auth::id()])}}" method="GET">
        <button class="btn" type="submit">Edit profil</button>
    </form>

</div>


@endsection
