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
        <form action="{{route('autho.store')}}" method="POST">
        @csrf

            <label for="board_id">Board id</label>
            <input type="text" name="board_id" id="board_id">

            <label for="users_id">User id</label>
            <input type="text" name="users_id" id="users_id">

            <label for="delete">delete</label>
            <input type="number" name="delete" id="delete">

            <label for="modify">modify</label>
            <input type="number" name="modify" id="modify">

            <label for="public">ta mere</label>
            <input type="number" name="public" id="public">


            <button type="submit">type submit</button>
        </form>
</body>
</html>
@endsection
