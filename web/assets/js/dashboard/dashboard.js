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
    var app = angular.module('DashboardApp', ['ngRoute', 'ngToast']);

    app.factory('Toast', function(ngToast) {

        var loadToast = null;

        return {
            show: function(message, className) {
                ngToast.create({
                    content: message,
                    className: className
                });
            },

            startLoading: function () {
                ngToast.dismiss();
                loadToast =  ngToast.create({
                    content: "Loading...",
                    className: "warning",
                    dismissOnTimeout: false
                });
            },

            stopLoading: function () {
                ngToast.dismiss(loadToast);
            }

        }
    });

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
        controller('DashboardCtrl', function ($scope, Toast) {
            $scope.$parent.pageHeader = 'Dashboard';

            $scope.$parent.startLoading = function () { Toast.startLoading(); };
            $scope.$parent.stopLoading = function () { Toast.stopLoading(); };
        }).
        controller('FeedsCtrl', function ($scope) {
            $scope.$parent.pageHeader = 'Noticeboard Feeds';
        }).
        controller('ContentCtrl', function ($location, $scope, Toast) {
            $scope.$parent.pageHeader = 'Noticeboard Content';

            Toast.stopLoading();

            $scope.addNewContent = function () {
                Toast.startLoading();
                $location.path('/edit');
            };

            $scope.editContent = function () {
                Toast.startLoading();
                var itemId = $("#editContentHiddenAction input").val();
                $location.path('/edit/' + itemId);
            };
        }).

        controller('ContentEditCtrl', function($scope, $location, $routeParams, Toast) {
            Toast.stopLoading();

            var itemId = $routeParams.contentId;
            $scope.$parent.pageHeader = itemId ? 'Edit Post' : 'New Post';
            if(itemId) {
                $scope.templateUrl = "/dashboard/partial/content_edit?content=" + itemId;
            }

            $scope.backToContent = function () {
                Toast.startLoading();
                $location.path('/content');
            };
        }).

        controller('NotificationsCtrl', function ($scope) {
            $scope.$parent.pageHeader = 'Notifications';
        });


    $('#side-menu').metisMenu();

})();
