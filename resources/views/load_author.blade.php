<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Load Author</title>

</head>


<body>
<div>

    <h1 align="center">Load Author</h1>

    <form action="/authors/save" method="post">
        @csrf
        <label for="Name">
            Name:
        </label>

        <input type="text" id="name" name="name"><br>
        <input type="submit">
    </form>
</div>

</body>
</html>

