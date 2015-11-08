<?php
    function showErrorMsgs($errors) {
        if ($errors) {
            $str = "<div class='errors'>";
            foreach($errors as $error) {
                $str .= "<span class='text-danger repeat-animation'>" . $error . "</span>";
            }
            $str .=  "</div>";
            echo $str;
        }
    }
?>
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
    <title>quiZapp</title>
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
                    <div class="loginBox mdl-shadow--4dp login-form" style="display:none">
                        <form role="form" method="post" action="{{ url('/auth/login') }}" autocomplete="false">
                            {!! csrf_field() !!}
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="log" id="log" name="log" value="{{ old('log') }}"/>
                                <label class="mdl-textfield__label" for="log">email or username</label>
                            </div>
                            {{showErrorMsgs($errors->get('log'))}}

                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                                <label class="mdl-textfield__label" for="password">password</label>
                            </div>
                            {{showErrorMsgs($errors->get('password'))}}

                            <div class="mdl-textfield">
                                <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="remember">
                                    <input type="checkbox" id="remember" class="mdl-checkbox__input" name="remember" />
                                    <span class="mdl-checkbox__label">Remember Me</span>
                                </label>
                            </div>

                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Login</button>

                            <span class="noid">Don't have an ID? <span class="form-toggle">Register</span></span>
                            <!--<a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" href="{{ url('/password/email') }}">Forgot Your Password?</a>-->
                        </form>
                    </div>
                    <div class="loginBox mdl-shadow--4dp registration-form" style="display:none">
                        <form method="POST" action="/auth/register">
                            {!! csrf_field() !!}
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="name" name="name" value="{{ old('name') }}"/>
                                <label class="mdl-textfield__label" for="name">Name</label>
                            </div>
                            {{showErrorMsgs($errors->get('name'))}}
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="username" name="username" value="{{ old('username') }}"/>
                                <label class="mdl-textfield__label" for="username">Username</label>
                            </div>
                            {{showErrorMsgs($errors->get('username'))}}
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="email" id="email" name="email" value="{{ old('email') }}"/>
                                <label class="mdl-textfield__label" for="email">eMail</label>
                            </div>
                            {{showErrorMsgs($errors->get('email'))}}
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password" name="password"/>
                                <label class="mdl-textfield__label" for="password">Password</label>
                            </div>
                            {{showErrorMsgs($errors->get('password'))}}
                            
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password_confirmation" name="password_confirmation"/>
                                <label class="mdl-textfield__label" for="password_confirmation">Confirm Password</label>
                            </div>
                            {{showErrorMsgs($errors->get('password_confirmation'))}}

                            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Register</button>

                            <span class="noid">Already have an ID? <span class="form-toggle">Login</span></span>
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
    <script>
        $(document).ready(function(){
            if(!localStorage.form) localStorage.form = "login";
            
            if(localStorage.form == "login"   ) $('.login-form'       ).show();
            if(localStorage.form == "register") $('.registration-form').show();
            
            $('.form-toggle').click(function(){
                localStorage.form = (localStorage.form == "login") ? "register" : "login";
                $('.registration-form').toggle();
                $('.login-form').toggle();
            });
        });
    </script>
</body>

</html>