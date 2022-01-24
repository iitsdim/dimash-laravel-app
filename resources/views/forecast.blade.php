<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Forecast</title>

    <!-- Fonts -->

    <!-- Styles -->
</head>


<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0 font-semibold">

    <table>

        <tr>
            @foreach($variables as $var)
                <th><a href="?sortby={{$order[$var]}}{{$var}}">
                        {{$var}}
                        @if($order[$var] == '')
                        &uarr;
                        @else
                        &darr;
                    @endif
                </th>
            @endforeach
        </tr>

        @foreach($forecast as $day)
            <tr>
                @foreach ($variables as $var)
                    <td>{{$day[$var]}}</td>
                @endforeach
            </tr>
        @endforeach

    </table>

</div>

</body>
</html>
