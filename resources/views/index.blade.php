<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;600&display=swap" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer>
    </script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>{{env('APP_NAME')}}</title>
</head>
<body>
    <div class="container mx-auto" id="app">
        <div class="bg-rose-300">
        <img class="m-auto" src="{{ asset('/images/logo.webp') }}">
        </div>
        <header-component></header-component>
        <home></home>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>