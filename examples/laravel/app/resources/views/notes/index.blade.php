<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Bluphant Example</title>

        <link href="{{ asset('css/example.css') }}" rel="stylesheet">
    </head>
    <body>

        <div class="container">

            @include('layouts.notes-header', [
                'title' => 'Notes',
                'active' => 'notes',
                'sub_title' => $sub_title
            ])

            <hr />

            <div id="content-container">
                @yield('content')
            </div>
        </div>

    </body>
</html>
