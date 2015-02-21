/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *
 *  Project : web
 *  File : dashboard
 *  Date : 2/21/15 1:19 PM
 *  Description :
 *
 */
'use strict';

var angular = window.angular;

(function () {
    var app = angular.module('sbAdminApp', ['ngRoute']);
    app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '/assets/js/dashboard/partial/dashboard.html',
                controller: 'SbDashboardCtrl'
            }).
            when('/feeds', {
                templateUrl: '/assets/js/dashboard/partial/feeds.html',
                controller: 'SbFeedsCtrl'
            });
    }]).
        controller('SbDashboardCtrl', function ($scope) {
            $scope.$parent.pageHeader = 'Dashboard';
        }).
        controller('SbFeedsCtrl', function ($scope) {
            $scope.$parent.pageHeader = 'Feeds';
        });
})();
