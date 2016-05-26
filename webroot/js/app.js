as = angular.module('myApp', [
        'ngRoute', 'myApp.controllers']);

as.config(function($routeProvider, $httpProvider) {
$routeProvider
    .otherwise({redirectTo: '/'});
});
