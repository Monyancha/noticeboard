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
<html lang="en" ng-app="sbAdminApp">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>USIU Notice Board :: Dashboard</title>

    <link rel="icon" type="image/png" href="/assets/img/favicon.png"/>
    <link href="/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="/assets/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="/assets/bower_components/flatly-sb-admin/css/plugins/timeline/timeline.css">
    <link rel="stylesheet" href="/assets/bower_components/datatables-bootstrap3/BS3/assets/css/datatables.css">

    <link rel="stylesheet" href="/assets/bower_components/flatly-sb-admin/css/sb-admin.css">

</head>

<body>

<div id="wrapper">

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/dashboard">USIU Notice Board</a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li><i class="fa fa-user fa-fw"></i> <? echo $user->name; ?></li>
            <li><a href="/auth/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>

        </ul>
    </nav>


    <div data-spy="affix" data-offset-top="0" data-offset-bottom="200">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu" sb-sidebar-menus menus-url="/assets/js/dashboard/json/menus.json">
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
                        <a href="#/">Dashboard</a>
                    </li>

                    <li>
                        <a href="#/feeds">Feeds</a>
                    </li>

                    <li>
                        <a href="#/content">Content</a>
                    </li>

                    <li>
                        <a href="#/notifs">Notifications<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#/notifs">Settings</a>
                            </li>
                            <li>
                                <a href="#/providers">Providers</a>
                            </li>
                        </ul>
                    </li>

                    <? /*
                    <li ng-repeat="menu in menus">
                        <a href="#{{ menu.route }}">{{ menu.name }}<span class="fa arrow" ng-if="menu.subMenus"></span></a>
                        <ul class="nav nav-second-level" ng-if="menu.subMenus">
                            <li ng-repeat="subMenu in menu.subMenus">
                                <a href="#{{ subMenu.route  }}">{{ subMenu.name }}</a>
                            </li>
                        </ul>
                    </li>
                    */ ?>

                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
    </div>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ pageHeader }}</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <ng-view></ng-view>

    </div>

</div>

<script src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<script src="/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Plugin Scripts - DataTables -->
<script src="/assets/bower_components/datatables/media/js/jquery.dataTables.js"></script>
<script src="/assets/bower_components/datatables-bootstrap3/BS3/assets/js/datatables.js"></script>

<!-- Plugin Scripts - Morris.js -->
<script src="/assets/bower_components/raphael/raphael-min.js"></script>
<script src="/assets/bower_components/morris.js/morris.js"></script>


<!-- Plugin Scripts - AngularJS -->
<script src="/assets/bower_components/angularjs/angular.min.js"></script>
<script src="/assets/bower_components/angular-route/angular-route.min.js"></script>

<!-- Plugin Scripts - SbAdmin -->
<script src="/assets/js/dashboard/admin-module.js"></script>
<script src="/assets/bower_components/flatly-sb-admin/js/sb-flot-module.js"></script>

<!-- Example Scripts -->
<script src="/assets/js/dashboard/dashboard.js"></script>

</body>

</html>
