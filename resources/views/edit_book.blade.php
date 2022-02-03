<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Edit Book</title>

</head>


<body>
<div>

    <h1 align="center">Edit Book {{$id}}</h1>

    <form action="/books/{{$id}}/save" method="post">
        @csrf
        <label for="Name">
            Name:
        </label>
        <input type="text" value="{{$name ?? ''}}" id="name" name="name"><br>

        @csrf
        <label for="Pages">
            Pages:
        </label>
        <input type="text" value="{{$pages ?? ''}}" id="pages" name="pages"><br>


        @csrf
        <label for="Select Author">
            Select Author
        </label>
        <select name="author_id" id="authors">
            @foreach($authors as $cur_author)
                <option value="{{$cur_author['id']}}">
                    {{$cur_author['name']}}
                </option>
            @endforeach
        </select>
        <br>

        <input type="submit">
    </form>
</div>

</body>
</html>

