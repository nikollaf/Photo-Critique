'use strict';

//CLOUDINARY_CONFIG = {"api_key": "YOUR_API_KEY", "cloud_name": "YOUR_CLOUD_NAME"};

/* App Module */

var worldlensApp = angular.module('worldlensApp', [
    'ngRoute',
    'worldlensControllers',
    'worldlensServices',
    'ngSanitize',
    'worldlensFilter',
    'citydetailFilter',
    'shortNumFilter',
    'ngAnimate',
    'AuthFactory',
     'ui.bootstrap',
    'infinite-scroll'
]);





worldlensApp.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/feed', {
                templateUrl: 'partials/city-feed.php',
                controller: 'CityListCtrl'
            }).
            when('/city/:cityId', {
                templateUrl: 'partials/city-detail.php',
                controller: 'CityDetailCtrl'
            }).
            when('/world-feed', {
                templateUrl: 'partials/world-feed.php',
                controller: 'WorldFeedCtrl'
            }).
             when('/upload', {
                templateUrl: 'image/upload.php',
                controller: 'AddImageCtrl'
            }).
            when('/register', {
                templateUrl: 'auth/register.php'
            }).
            when('/login', {
                templateUrl: 'auth/login.php',
                controller: 'LoginController'
            }).
            when('/user/:id', {
                templateUrl: 'partials/user-detail.php',
                controller: 'UserController'
            }).
            when('/images', {
                templateUrl: 'partials/full-list.php',
                controller: 'ListCityCtrl'
            }).
            when('/image/:id', {
                templateUrl: 'partials/image-detail.php',
                controller: 'ImageListCtrl'
            }).
            when('/users', {
                templateUrl: 'partials/user-list.php',
                controller: 'ListUserCtrl'
            }).
            when('/cont/:id', {
                templateUrl: 'partials/cont-detail.php',
                controller: 'ContListCtrl'
            }).
            when('/traveler', {
                templateUrl: 'partials/game-app.php',
                controller: 'GameListCtrl'
            }).
            otherwise({
                templateUrl: 'partials/home.php'
            });
    }]);


