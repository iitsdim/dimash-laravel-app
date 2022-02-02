<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Authors</title>


    <!-- Fonts -->

    <!-- Styles -->
</head>


<body>
<div>

    <h1 align="center">Authors</h1>

    <table align="center">

        @if(count($authors) > 0)
            <tr>
                @foreach($authors[0] as $key=>$val)
                    <th>
                        {{$key}}
                    </th>
                @endforeach
            </tr>
        @endif

        @foreach($authors as $author)
            <tr>
                @foreach($author as $key=>$val)
                    <td>
                        {{$val}}
                    </td>
                @endforeach
                <td>
                    <a href="/authors/{{$author['id']}}/delete">
                        Delete
                    </a>
                </td>
                <td>
                    <a href="/authors/{{$author['id']}}/edit">
                        Edit
                    </a>
                </td>

            </tr>

        @endforeach


    </table>


</div>

</body>
</html>





