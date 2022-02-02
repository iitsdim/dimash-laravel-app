<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Books</title>

</head>


<body>
<div>

    <h1 align="center">Books</h1>

    <table align="center">

        @if(count($books) > 0)
            <tr>
                @foreach($books[0] as $key=>$val)
                    <th>
                        {{$key}}
                    </th>
                @endforeach
            </tr>
        @endif

        @foreach($books as $book)
            <tr>
                @foreach($book as $key=>$val)
                    <td>
                        {{$val}}
                    </td>
                @endforeach

                <td>
                    <a href="/books/{{$book['id']}}/delete">
                        Delete
                    </a>

                </td>
                <td>
                    <a href="/books/{{$book['id']}}/edit">
                        Edit
                    </a>
                </td>
            </tr>
        @endforeach


    </table>


</div>

</body>
</html>





