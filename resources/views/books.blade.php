<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Books</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
</head>


<body>
<div style="text-align: center">
    <h1>Books</h1>

    <table>

        <thead>

        <tr>
            @foreach($keys as $key)
                <td>
                    <a href="?sort_by={{$key}}&order=DESC&page={{$_GET['page'] ?? 1}}">
                        &uarr;
                    </a>

                    {{$key}}

                    <a href="?sort_by={{$key}}&order=ASC&page={{$_GET['page'] ?? 1}}">
                        &darr;
                    </a>


                </td>
            @endforeach
        </tr>


        </thead>

        <tbody>
        @foreach($books as $book)
            <tr>
                @foreach($keys as $key)
                    <td>
                        @if($key == 'title')
                            <a href="/books/{{$book->id}}">
                                {{$book->$key}}
                            </a>
                        @else
                            {{$book->$key}}
                        @endif
                    </td>
                @endforeach

                <td>
                    <form action="/books/{{$book->id}}/delete" method="post">
                        @csrf
                        <input type="submit" value="Delete">
                    </form>
                </td>

                <td>
                    <a href="/books/{{$book->id}}/edit">
                        Edit
                    </a>
                </td>

            </tr>
        @endforeach
        </tbody>

    </table>


    <div class="pagination" style="display: flex; justify-content: center; align-content: center; padding-top: 10px;">

        <button>
            <a class="page-link" href="{{$books->previousPageUrl()}}">
                Previous
            </a>
        </button>

        <button>
            <a class="page-link" href="{{$books->nextPageUrl()}}">
                Next
            </a>
        </button>

    </div>

    <div style="display: flex; justify-content: center; align-content: center; padding-top: 10px;">
        <button>
            <a href="/books/loadBook">
                Add Book
            </a>
        </button>
    </div>
</div>

</body>
</html>
