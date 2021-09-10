<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
 
       {{-- Laravel Mix - CSS File --}}
       <link rel="stylesheet" href="{{ mix('css/app.css') }}">
 
    </head>
    <body>
        <div id="app" class="container-fluid">
            
            <div>
                <frontend-component></frontend-component>
            </div>
        </div>
 
        {{-- Laravel Mix - JS File --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
                'apiToken' => session('user')->api_token ?? null
            ]) !!}
        </script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>