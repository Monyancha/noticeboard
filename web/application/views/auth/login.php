<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : login.php
 *  Date : 2/21/15 10:21 AM
 *  Description :
 *
 */
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <link rel="icon" type="image/png" href="/assets/img/favicon.png" />
    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet" type="text/css">

    <link href="/assets/css/main.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .mainbox {
            color: #000000;
        }
    </style>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="/">
                <i class="fa fa-info-circle"></i> <span class="light">USIU</span> Notice Board
            </a>
        </div>

        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li class="hidden">
                    <a href="/"></a>
                </li>
                <li>
                    <a class="page-scroll" href="/#about">About</a>
                </li>
                <li>
                    <a class="page-scroll" href="/#download">Download</a>
                </li>
                <li>
                    <a class="page-scroll" href="/dashboard">Dashboard</a>
                </li>
                <li>
                    <a class="page-scroll" href="/#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="intro">
    <div class="intro-body">
        <div class="container">

            <? if ($error) { ?>
                <div style="margin-top:50px;"
                     class="alert alert-danger col-sm-8 col-sm-offset-2"><? echo $error; ?></div>
            <? } ?>

            <? if ($message) { ?>
                <div style="margin-top:50px;"
                     class="alert alert-success col-sm-8 col-sm-offset-2"><? echo $message; ?></div>
            <? } ?>

            <div id="loginbox" style="margin-top:50px;"
                 class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="panel-title">
                            Staff Log In
                        </div>
                    </div>

                    <div style="padding-top:30px" class="panel-body">

                        <form id="loginform" class="form-horizontal" role="form" action="/auth/login" method="post">

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                <input type="email" class="form-control" name="email" value="" placeholder="Email"
                                       required="required">
                            </div>

                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="pwd" placeholder="Password"
                                       required="required">
                            </div>


                            <div style="margin-top:10px;" class="form-group">
                                <div class="col-sm-12 controls">
                                    <input type="submit" class="btn btn-success">
                                    <input type="reset" class="btn btn-danger">
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-12 control">
                                    <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                                        <span>
                                            Don't have an account? &nbsp;<a href="/auth/register">Register here!</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


        </div>

    </div>
</div>

<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>
