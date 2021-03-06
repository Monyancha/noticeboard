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
    <link href="/assets/bower_components/bootswatch/paper/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/bower_components/bootstrap3-dialog/dist/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css">
    <link href="/assets/bower_components/datatables/media/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css">
    <link href="/assets/plugin/dataTables/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

    <link href="/assets/bower_components/ngtoast/dist/ngToast.min.css" type="text/css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/sb-admin.css" type="text/css">

</head>

<body>

<toast></toast>
<span class="hidden" id="startLoadingAction" ng-click="startLoading()"></span>
<span class="hidden" id="stopLoadingAction" ng-click="stopLoading()"></span>

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

        <ul class="nav navbar-top-links navbar-right visible-sm visible-md visible-lg">
            <li><i class="fa fa-user fa-fw"></i> <? echo $user->name; ?> </li>
            <li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
        </ul>
    </nav>

    <nav class="navbar-default navbar-fixed-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search" ng-controller="SearchCtrl">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" ng-model="query" placeholder="Search..." ng-keyup="checkSubmit($event)">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" ng-click="submitQuery()">
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

                <li class="visible-xs">
                    <a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>

            </ul>
        </div>
    </nav>


    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">
                    {{ pageHeader }}
                    <span class="pull-right small" id="pageActions"></span>
                </h4>
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
<script src="/assets/plugin/dataTables/dataTables.bootstrap.js"></script>

<script src="/assets/bower_components/bootstrap3-dialog/dist/js/bootstrap-dialog.min.js"></script>

<script src="/assets/bower_components/angularjs/angular.js"></script>
<script src="/assets/bower_components/angular-route/angular-route.min.js"></script>
<script src="/assets/bower_components/angular-animate/angular-animate.min.js"></script>
<script src="/assets/bower_components/angular-sanitize/angular-sanitize.min.js"></script>
<script src="/assets/bower_components/ngtoast/dist/ngToast.min.js"></script>

<script src="/assets/js/dashboard/dashboard.js"></script>

</body>

</html>
