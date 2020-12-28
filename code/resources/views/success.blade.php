<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Success</title>

    </head>
    <body>
        <h1>Success</h1>
        <dl>
            <dt>User-agent</dt><dd>{{$click->ua}}</dd>
            <dt>IP</dt><dd>{{$click->ip}}</dd>
            <dt>Ref</dt><dd>{{$click->ref}}</dd>
            <dt>Param1</dt><dd>{{$click->param1}}</dd>
            <dt>Param2</dt><dd>{{$click->param2}}</dd>
        </dl>
    </body>
</html>
