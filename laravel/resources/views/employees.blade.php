<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            @if (Route::has('manager.login'))
                <div class="top-right links">
                    <a href="{{ url('/projects') }}">Projects</a>
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/manager/login') }}">Project Manager Login</a>
                        <a href="{{ url('/admin/login') }}">Admin Login</a>
                        <a href="{{ url('/admin/register') }}"> Admin Register</a>
                    @endif
                </div>
            @endif
        </div>
        <div class="container" style='margin:64px'>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="id-column">ID</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($employees as $employee)
                            <tr id="employee-{{ $employee->id }}">
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            </tr>
                        @empty
                            <tr>
                            <td colspan="6">There is no employee in the system.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
