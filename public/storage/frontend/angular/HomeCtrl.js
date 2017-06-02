var HomeCtrl = angular.module('HomeCtrl',[]);
HomeCtrl.controller('HomeController', function($scope,$http) {
	$scope.banners = {};
	$scope.teams = {};
	$scope.news = {};
	$scope.events = {};
	$scope.homeContent = function() {
		$http.get('/api/home-content').then(function(response){
			$scope.banners = response.data.banners;
			$scope.teams = response.data.teams;
			$scope.news = response.data.news;
			$scope.events = response.data.events;
			
		})
		.catch(function(reason){

		});
	}
});