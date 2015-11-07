<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7">   <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8">          <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9">                 <![endif]-->
<!--[if gt IE 8]><!-->
<html class="" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>quizapp</title>
    <link rel="stylesheet" href="{{ asset('/css/library.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/styles.css') }}" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="homepage">
    <div class="wrapper">
        <header class="logoBox">
            <div class="logo mdl-shadow--4dp">quiZapp</div>
        </header>
        <main class="container">
            <div class="row" style="margin-top: 140px;margin-bottom: 40px">
                <div class="col-sm-6 col-md-4 col-md-offset-1">
                    @if (Auth::user())
                    <div class="loginBox loggedin mdl-shadow--4dp">
                        <h2>Hello,</h2>
                        <b>{{Auth::user()->name}}</b><br>

                        <p>You are currently logged in as {{Auth::user()->role}}.</p>
                        
                        <a href=
                            @if (Auth::user()->role === 'admin')
                            {{"/admin"}}
                            @else
                            {{"/student"}}
                            @endif
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
                            Goto Dashboard
                        </a>


                        <a href="/auth/logout" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Logout</a>
                    </div>
                    @else
                    <div class="loginBox mdl-shadow--4dp">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger" style="margin-bottom:10px;">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul style="margin-left:20px;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form role="form" method="post" action="{{ url('/auth/login') }}" autocomplete="false">
                            <!-- <input type="hidden" name="log" value="IDONTKNOW"> -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="log" name="log" value="{{ old('log') }}"/>
                                <label class="mdl-textfield__label" for="log">email or username</label>
                            </div>

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                                <label class="mdl-textfield__label" for="password">password</label>
                            </div>

                            <div class="mdl-textfield">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                                    <input type="checkbox" id="remember" class="mdl-checkbox__input" name="remember" />
                                    <span class="mdl-checkbox__label">Remember Me</span>
                                </label>
                            </div>

                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Login</button>
                            <!--<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="{{ url('/password/email') }}">Forgot Your Password?</a>-->
                        </form>
                    </div>
                    @endif
                </div>
                <div class="col-sm-6 col-md-4 col-md-offset-2">
                    <div class="info mdl-shadow--4dp">
                        <h2>quizapp</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta facere culpa, quam similique cupiditate est, ratione vero. Voluptas animi, minus alias ipsum deserunt laborum dolore libero eos. Non, quisquam, odit.</p>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <span class="mdl-shadow--4dp">
                Build with <i class="material-icons" style="font-size:14px">favorite_border</i> 
                by <a href="http://fb.me/blackheartadhar">Sabbir Rahman</a>
            </span>
        </footer>
    </div>
    <script src="{{ asset('/js/library.js') }}"></script>
</body>

</html>