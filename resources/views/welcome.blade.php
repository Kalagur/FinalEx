<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Типа пираты</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .alert-success {
            color: red;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="title m-b-md">
        Тестовое задание
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div><br><br>
    @endif
    <div class="container">
        @foreach ($users as $user)
            <a href="user?id={{ $user->id }}">{{ $user->name }}</a> - {{ $user->balance }} ₽
            @if ($user->transaction_money)
                (Сумма последнего перевода: {{ $user->transaction_money }} ₽,
                дата перевода: {{ $user->transaction_create }}, статус: {{ $user->status }})<br>
            @else
                - Данный пользователь не осуществлял транзакций<br>
            @endif
        @endforeach

    </div>
</div>
</div>
</body>
</html>
