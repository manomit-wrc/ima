var imaRoute = angular.module('imaRoute',['ngRoute']);

imaRoute.config(function($routeProvider,$locationProvider){
	$locationProvider.html5Mode(true).hashPrefix('#');
	$routeProvider.when('/',{
		templateUrl: '/templates/home.html'
	}).when('/profile', {
		templateUrl: '/templates/profile.html',
		authenticated: true
	}).when('/change-password',{
		templateUrl: '/templates/change-password.html',
		authenticated: true
	}).when('/upload-journal',{
		templateUrl: '/templates/upload-journal.html',
		authenticated: true
	});
});

imaRoute.run(function($rootScope,$location,Auth){
	$rootScope.$on('$routeChangeStart',function(event,next,current){
		if(next.$$route.authenticated) {
			if(!Auth.isLoggedIn()) {
				$location.path("/");
			}

			if(next.$$route.originalPath == "/") {
                    if(Auth.isLoggedIn()) {
                        $location.path(current.$$route.originalPath);
                    }
                }
		}
	});
});