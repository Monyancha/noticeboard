<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : dashboard.php
 *  Date : 2/21/15 1:13 PM
 *  Description :
 *
 */
?>
<!DOCTYPE html>
<html lang="en" ng-app="DashboardApp">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="icon" type="image/png" href="/assets/img/favicon.png"/>
<!--    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">-->
    <link href="/assets/bower_components/bootswatch/paper/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/bower_components/datatables/media/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css">
    <link href="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/assets/css/sb-admin.css" type="text/css">

</head>

<body>

<div id="wrapper">

    <nav id="page-header" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#/">
                <i class="fa fa-info-circle"></i> <span class="light">USIU</span> Notice Board
            </a>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li><i class="fa fa-user fa-fw"></i> <? echo $user->name; ?> </li>
            <li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
        </ul>
    </nav>

    <nav class="navbar-default navbar-fixed-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                    </div>
                </li>

                <li>
                    <a href="#/"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li>
                    <a href="#/feeds"><i class="fa fa-rss fa-fw"></i> Feeds</a>
                </li>

                <li>
                    <a href="#/content"><i class="fa fa-newspaper-o fa-fw"></i> Content</a>
                </li>

                <li>
                    <a href="#/notifications"><i class="fa fa-sliders fa-fw"></i> Notifications</a>
                </li>

            </ul>
        </div>
    </nav>


    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">{{ pageHeader }}</h3>
            </div>
        </div>

        <ng-view/>
    </div>


</div>

<!--<footer style="padding: 5px; color: #e7e7e7">-->
<!--    <div class="text-left">-->
<!--        <p>&copy; Salama AB 2015</p>-->
<!--    </div>-->
<!--</footer>-->

<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="/assets/bower_components/datatables/media/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<script src="/assets/bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>

<script src="/assets/bower_components/angularjs/angular.min.js"></script>
<script src="/assets/bower_components/angular-route/angular-route.min.js"></script>

<script src="/assets/js/dashboard/dashboard.js"></script>

</body>

</html>
