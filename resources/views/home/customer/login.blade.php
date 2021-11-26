<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="img/login/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body>

<div class="limiter">
    <div class="container-login100" style="background-image: url('{{asset('frontend/img/login/bg-01.jpg')}}');">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <form class="login100-form validate-form flex-sb flex-w" method="post">
                @csrf
                    <span class="login100-form-title p-b-53">
						Sign In With
					</span>

                <a href="#" class="btn-face m-b-20">
                    <i class="fa fa-facebook-official"></i> Facebook
                </a>

                <a href="#" class="btn-google m-b-20">
                    <img src="{{asset('frontend/img/login/icon-google.png')}}" alt="GOOGLE"> Google
                </a>

                <div class="p-t-31 p-b-9">
                        <span class="txt1">
							Username
						</span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100"></span>
                </div>

                <div class="p-t-13 p-b-9">
                        <span class="txt1">
							Password
						</span>

                    <a href="#" class="txt2 bo1 m-l-5">
                        Forgot?
                    </a>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                </div>
                <span style="color: red"> @if(isset($msg))
                        {{$msg}}
                    @endif
                </span>
                <div class="container-login100-form-btn m-t-17">
                    <input class="login100-form-btn" type="submit" name="login" value="Login">
                </div>

                <div class="w-full text-center p-t-55">
                        <span class="txt2">
							Not a member?
						</span>

                    <a href="{{route('customer-register-page')}}" class="txt2 bo1">
                        Sign up now
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
<script src="{{asset('frontend/js/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('frontend/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('frontend/js/bootstrap/popper.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('frontend/js/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('frontend/js/daterangepicker/moment.min.js')}}"></script>
<script src="{{asset('frontend/js/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('frontend/js/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('frontend/js/select2/main.js')}}"></script>

</body>

</html>
