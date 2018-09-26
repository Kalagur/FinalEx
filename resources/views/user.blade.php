<!doctype html>
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
          crossorigin="anonymous">

    <title>Типа пираты</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600"
          rel="stylesheet" type="text/css">

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

        .m-b-md {
            margin-bottom: 30px;
        }

        .alert-success {
            color: red;
        }

        .strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="title m-b-md">
        Тестовое задание
    </div>

@if (count($errors) > 0)
    <!-- Список ошибок формы -->
        <div class="alert alert-danger">
            <strong>Упс! Что-то пошло не так!</strong>

            <br><br>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div><br><br>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 text-left">
                <div class="text-center"><a href="/">На главную</a><br>
                    Текщий пользователь: <span class="text-success">
                        {{ $current[0]->name }}</span><br>
                    Текущий баланс: <span class="text-danger strong">
                        {{ $current[0]->balance }} ₽</span><br><br>
                </div>
                Кому будем переводить деньги?<br>
                <form method="post" action="{{ route('pay') }}">
                    <select class="form-control" name="trans_to">
                        @foreach ($not_current as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            <br>
                        @endforeach
                    </select>
                    Введите желаемую сумму:
                    <input type="text" class="form-control" name="sum"
                           placeholder="Сумма перевода в ₽" pattern="[0-9]{1,10}" min="1" required>
                    Время перевода (часовой пояс - Кемерово):
                    <input type="datetime-local" class="form-control"
                           name="trans_date" required><br>
                    <input type="hidden" name="status" value="pending">
                    <input type="hidden" name="trans_from"
                           value="{{ $current[0]->id }}">
                    <input type="submit" class="form-control btn-success"
                           value="ПЕРЕВЕСТИ">
                    {{ csrf_field() }}
                </form>
                <br>
            </div>
        </div>
    </div>
</div>
</div>
</body>