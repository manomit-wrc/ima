var imaRoute = angular.module('imaRoute',['ngRoute','ngCookies']);

imaRoute.config(function($routeProvider,$locationProvider,$qProvider){
	$locationProvider.html5Mode(true).hashPrefix('#');
	$routeProvider.when('/',{
		templateUrl: '/templates/home.html'
	}).when('/profile', {
		templateUrl: '/templates/profile.html',
		authenticated: true,
		type: "D"
	}).when('/company-profile', {
		templateUrl: '/templates/company-profile.html',
		authenticated: true,
		type: "C"
	}).when('/change-password',{
		templateUrl: '/templates/change-password.html',
		authenticated: true,
		type: "D"
	}).when('/upload-journal',{
		templateUrl: '/templates/upload-journal.html',
		authenticated: true,
		type: "D"
	}).when('/upload-drug',{
		templateUrl: '/templates/upload-drug.html',
		authenticated: true,
		type: "C"
	}).when('/drug-list',{
		templateUrl: '/templates/drug-list.html',
		authenticated: true,
		type: "C"
	}).when('/news/:news_id/:slug',{
		templateUrl: '/templates/news.html'
	}).when('/events/:events_id/:slug',{
		templateUrl: '/templates/events.html'
	}).when('/activate/:active_token/:active_time', {
		templateUrl: '/templates/activate.html'
	}).when('/news-list',{
		templateUrl: '/templates/news-list.html'
	}).when('/doctor-list',{
		templateUrl: '/templates/doctor-list.html',
		authenticated: true,
		type: "D"
	}).when('/group-request',{
		templateUrl: '/templates/group-request.html',
		authenticated: true,
		type: "D"
	}).when('/comment-list/:id',{
		templateUrl: '/templates/comment.html',
		authenticated: true,
		type: "D"
	}).when('/events-list',{
		templateUrl: '/templates/events-list.html'
	}).when('/contact',{
		templateUrl: '/templates/contact.html'
	}).when('/branches',{
		templateUrl: '/templates/local_branches.html'
	}).when('/payment-certificate',{
		templateUrl: '/templates/payment_certificate.html',
		authenticated: true,
		type: "D"
	}).when('/groups',{
		templateUrl: '/templates/groups.html',
		authenticated: true,
		type: "D"
	}).when('/groups/add',{
		templateUrl: '/templates/add-groups.html',
		authenticated: true,
		type: "D"
	}).when('/groups/edit/:id',{
		templateUrl: '/templates/edit-groups.html',
		authenticated: true,
		type: "D"
	}).when('/journal-list', {
		templateUrl: '/templates/journal_list.html',
		authenticated: true,
		type: "D"
	}).when('/:slug',{
		templateUrl: '/templates/cms.html'
	}).when('/journal/:id',{
		templateUrl: '/templates/edit_journal.html',
		authenticated: true,
		type: "D"
	}).when('/drug/:id',{
		templateUrl: '/templates/edit_drug.html',
		authenticated: true,
		type: "C"
	});

	$qProvider.errorOnUnhandledRejections(false);
});

imaRoute.run(function($rootScope,$location,Auth,$cookieStore){
	$rootScope.$on('$routeChangeStart',function(event,next,current){
		if(next.$$route.authenticated) {
			
			if(!Auth.isLoggedIn() && !$cookieStore.get('remember_token')) {
				$location.path("/");
			}
			Auth.returnType().then(function(response){
				if(response == next.$$route.type) {
					
					if(next.$$route.originalPath == "/") {
	                    if(Auth.isLoggedIn()) {
	                        $location.path(current.$$route.originalPath);
	                        
	                    }
            		}
				}
				else {
					$location.path("/");
				}
			});
			
		}
	});
});