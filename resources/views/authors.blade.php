<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Authors</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}" >
</head>

<body>
<div style="text-align: center">

    <h1>Authors</h1>



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

        @foreach($authors as $author)
            <tr>
                @foreach($keys as $key)
                    <td>
                        {{$author->$key}}
                    </td>
                @endforeach
                <td>
                    <form action="/authors/{{$author->id}}/delete" method="post">
                        @csrf
                        <input type="submit" value="Delete">
                    </form>
                </td>
                <td>
                    <a href="/authors/{{$author->id}}/edit">
                        Edit
                    </a>
                </td>

            </tr>

        @endforeach
        </tbody>




    </table>

    <div class="pagination" style="display: flex; justify-content: center; align-content: center; padding-top: 10px;">

        <button>
            <a class="page-link" href="{{$authors->previousPageUrl()}}">
                Previous
            </a>
        </button>

        <button>
            <a class="page-link" href="{{$authors->nextPageUrl()}}">
                Next
            </a>
        </button>

    </div>

    <div style="display: flex; justify-content: center; align-content: center; padding-top: 10px;">
        <button>
            <a href="/authors/loadAuthor">
                Add Author
            </a>
        </button>
    </div>



</div>

</body>
</html>





