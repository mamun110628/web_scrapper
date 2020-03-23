<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="{{url('storage/upload/setting/1551936198logo-b6.png')}}}" type="image/png">
    <title>Invogue Web Scrapper  || Login Panel</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="public/built_in/pages/css/pages.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{URL::to('public/css/login.css')}}">

    <style>
        .login-branch {
            width: 310px !important;
        }

        .branch-form {
            display: none;
        }

        .login-form {
            display: block;
        }

        .inv_mkl_left {
            margin-left: 5px;
            font-family: 'Montserrat' !important;
            color: #999999;
            font-size: 7px;
            font-weight: 400;
        }

        .content-login {
            position: absolute;
            z-index: 15;
            top: 47%;
            left: 0px;
            padding-left: 37px;
            margin: -100px 0 0 0px;
        }

        .slidelogin {
            overflow: hidden;
        }

        .slidelogin img {
            position: absolute;
            bottom: 0px;
        }
        #loading {
            position: absolute;
            opacity: 0.5;
            background-color: #fff !important;
            z-index: 99999;
            width: 100%;
            height: 100%;
        }

        #imagen {
            position: absolute;
            top: 7%;
            left: 77%;
            z-index: 100;
        }
    </style>

</head>

<body>
    

    <section class="login-block">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 nopad">
                    <div class="slidelogin hidden-xs">
                        <img style="width: 100%;" src="{{URL::to('public/assets/images/slid4.png')}}" alt="invogue" title="invogue" />
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 nopad">
                    <div class="login-container bg-white ">
<!--
                        <div id="loading">
                            <img id="imagen" src="~/Content/built_in/pages/img/progress/progress-circle-success.svg" alt="Loading..." />
                        </div>
-->
                        <div class="p-l-20 p-r-20">
                            <div class="panel-body">
                                <form method="post" action="{{URL::to('login_process')}}">
                                    {{ csrf_field() }}
                                    <div class="content-login">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 xl-mb30">
                                                <div class="form-group" style=" font-size:20px; margin-bottom:40px;text-transform: uppercase;">
                                                   Invogue Web Scrapper 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="login-form">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 xl-mb30">
                                                    <div class="form-group">
                                                        <input type="text" name="email" class="form-control" placeholder="" required>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 xl-mb30">
                                                    <div class="form-group">
                                                        <input type="password" name="password" class="form-control" placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>

<!--                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="checkbox">
                                                    <input type="checkbox" value="1" id="checkbox1" name="remember_me">
                                                        <label for="checkbox1">Keep Me Signed in</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="forget_password text-right">
                                                        <a href="{{url('forget_password')}}" class=""><small><i class="fa fa-lock"></i> Forget Password</small></a>
                                                    </div>
                                                </div>
                                            </div>-->

                                            <div style="margin-bottom:20px"></div>
                                            <button class="btn btn-primary cust_btn" style="margin-left:15px;" type="submit"> Sign in</button>
                                            <?php
                                            $login_fail = Illuminate\Support\Facades\Session::get('login_message');
                                            Illuminate\Support\Facades\Session::forget('login_message');
                                            ?>
                                            @if($login_fail)
                                            <p class="text-danger">{{$login_fail['message']}}</p>
                                            @endif
                                        </div>
                                    </div>



                                    <div style="bottom:30px;  left:32px;  position: absolute;">
                                        <div style="float:left;" class="login_footer">
                                            <div class="login_footer_img">
                                                <img style="width: 50px;" src="{{URL::to('public/assets/images/logo-b6.png')}}" alt="invogue" title="invogue" />
                                            </div>

                                            <div class="inv_mkl_left" style="width:200px;"> invoguesoft.com (880) 989-3572</div>
                                        </div>
                                        <div class="inv_mkl_left" style="float:left; margin-top:8px; right:0;">a INVOGUE SOFTWARE LIMITED Company</div>
                                    </div>




                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script>
        var slideloginHeight = $(window).outerHeight();
        $(".slidelogin").css({ "height": slideloginHeight });

        $(".slidelogin img").css({ "height": slideloginHeight + 100 });
    
    </script>
</body>

</html>
