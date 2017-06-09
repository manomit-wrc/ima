var imaRoute = angular.module('imaRoute',['ngRoute','ngCookies']);

imaRoute.config(function($routeProvider,$locationProvider,$qProvider){
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
	}).when('/news/:news_id/:slug',{
		templateUrl: '/templates/news.html'
	}).when('/events/:events_id/:slug',{
		templateUrl: '/templates/events.html'
	}).when('/activate/:active_token/:active_time', {
		templateUrl: '/templates/activate.html'
	}).when('/news-list',{
		templateUrl: '/templates/news-list.html'
	}).when('/events-list',{
		templateUrl: '/templates/events-list.html'
	});

	$qProvider.errorOnUnhandledRejections(false);
});

imaRoute.run(function($rootScope,$location,Auth,$cookieStore){
	$rootScope.$on('$routeChangeStart',function(event,next,current){
		if(next.$$route.authenticated) {
			if(!Auth.isLoggedIn() && !$cookieStore.get('remember_token')) {
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