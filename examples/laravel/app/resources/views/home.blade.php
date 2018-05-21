<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home Bluphant Example</title>

        <link href="{{ asset('css/example.css') }}" rel="stylesheet">
    </head>
    <body>

        <div class="container">
            @include('layouts.notes-header', [
                'title' => 'Bluphant Laravel Example',
                'active' => 'home',
                'sub_title' => ''
            ])

            <div id="content-container">
                <p>Bluphant PHP Adapter example.</p>
            </div>
        </div>

        <script type="text/javascript">

            // var socket = new WebSocket("ws://127.0.0.1:1215");

            // socket.onopen = function (event) {
            //     console.log("socket opened!");
            //     console.log(event);

            //     socket.send("sending some random data");

            //     socket.onmessage = function (event) {
            //         console.log("on message...");
            //         console.log(event);
            //     }
            // }

        </script>

    </body>
</html>
