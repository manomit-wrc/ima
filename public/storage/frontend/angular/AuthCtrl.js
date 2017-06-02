var AuthCtrl = angular.module('AuthCtrl',[]);

AuthCtrl.controller('AuthController',function($scope,$http,Auth,$location){
	$scope.code = '';
	$scope.message = '';
	$scope.user = {};
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
	$scope.doRegistration = function(valid) {
		if(valid) {
				Auth.do_registration($scope.registration.first_name, 
				$scope.registration.last_name,
				$scope.registration.email_id,
				$scope.registration.mobile_no,
				$scope.registration.password).then(function(response){
				
				if(response.data.code == 500) {
					$scope.code = 1;
					$scope.message = response.data.message;
				}
				else if(response.data.code == 200) {
					$scope.code = 1;
					$scope.message = response.data.message;
				}
				else {
					$scope.code = 0;
					$scope.message = '';
				}
			});
		}
		
	};

	$scope.doLogin = function(valid) {
		if(valid) {
			Auth.do_login($scope.login.login_email_id, 
				$scope.login.login_password).then(function(response){
				
				if(response.data.status_code == 404) {
					$scope.code = 1;
					$scope.message = response.data.msg;
				}
				else if(response.data.status_code == 500) {
					$scope.code = 1;
					$scope.message = response.data.msg;
				}
				else {
					$scope.code = 0;
					$scope.message = '';
					Auth.getUser().then(function(response){
				
					$scope.user = response.data.result;
					$scope.dismiss();
					$location.path('/profile');
				});
				}
			});
		}
	};

	$scope.getToken = function() {
		Auth.getUser().then(function(response){
			$scope.user = response.data.result;
			$scope.first_name = $scope.user.first_name;
			$scope.last_name = $scope.user.last_name;
			$scope.mobile = $scope.user.mobile;
			$scope.email = $scope.user.email;
			$scope.city = $scope.user.city;
			$scope.pincode = $scope.user.pincode;
			$scope.sex = $scope.user.sex;
		});
	};

	$scope.doLogout = function() {

		Auth.logout();
		$scope.user = {};
		$location.path("/");
	};

	$scope.doProfile = function(valid) {
		//console.log($scope.doProfile);
	}
});