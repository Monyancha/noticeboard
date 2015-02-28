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
    var app = angular.module('DashboardApp', ['ngRoute']);
    app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider.
            when('/', {
                templateUrl: '/dashboard/partial/dashboard',
                controller: 'DashboardCtrl'
            }).
            when('/feeds', {
                templateUrl: '/dashboard/partial/feeds',
                controller: 'FeedsCtrl'
            }).
            when('/content', {
                templateUrl: '/dashboard/partial/content',
                controller: 'ContentCtrl'
            }).
            when('/edit', {
                templateUrl: '/dashboard/partial/content_edit',
                controller: 'ContentEditCtrl'
            }).
            when('/edit/:contentId', {
                templateUrl: '/dashboard/partial/urlRouter',
                controller: 'ContentEditCtrl'
            }).
            when('/notifications', {
                templateUrl: '/dashboard/partial/notifications',
                controller: "NotificationsCtrl"
            });
    }]).
        controller('DashboardCtrl', function ($scope) {
            $scope.$parent.pageHeader = 'Dashboard';
        }).
        controller('FeedsCtrl', function ($scope) {
            $scope.$parent.pageHeader = 'Noticeboard Feeds';
        }).
        controller('ContentCtrl', function ($location, $scope) {
            $scope.$parent.pageHeader = 'Noticeboard Content';

            $scope.addNewContent = function () {
                $location.path('/edit');
            };

            $scope.editContent = function () {
                var itemId = $("#editContentHiddenAction input").val();
                $location.path('/edit/' + itemId);
            };

        }).

        controller('ContentEditCtrl', function($scope, $location, $routeParams) {
            var itemId = $routeParams.contentId;
            $scope.$parent.pageHeader = itemId ? 'Edit Post' : 'New Post';
            if(itemId) {
                $scope.templateUrl = "/dashboard/partial/content_edit?content=" + itemId;
            }

            $scope.backToContent = function () {
                $location.path('/content');
            };

        }).

        controller('NotificationsCtrl', function ($scope) {
            $scope.$parent.pageHeader = 'Notifications';
        });


    $('#side-menu').metisMenu();

})();
