<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Load Book</title>

</head>


<body>
<div>

    <h1 align="center">Load Book</h1>

    <form action="/books/save" method="post" >
        @csrf
        <label for="Title">
            Title:
        </label>
        <input type="text" id="title" name="title"><br>

        <label for="Pages">
            Pages:
        </label>
        <input type="text" id="pages" name="pages"><br>

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





