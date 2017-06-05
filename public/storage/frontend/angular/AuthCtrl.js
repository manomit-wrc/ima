var AuthCtrl = angular.module('AuthCtrl',[]);

AuthCtrl.controller('AuthController',function($scope,$http,Auth,$location){
	$scope.code = '';
	$scope.message = '';
	$scope.user = {};
	$scope.banners = {};
	$scope.teams = {};
	$scope.news = {};
	$scope.events = {};
	$scope.doctor_id = '';

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
			$scope.dob = $scope.user.dob;
			$scope.biography = $scope.user.biography;
			$scope.state_id = $scope.user.state_id;
			$scope.license = $scope.user.license;
			$scope.doctor_id = $scope.user.id;
			$scope.auth_id = $scope.user.id;
			$scope.avators = $scope.user.avators;
			
			if($scope.user.avators != "") {
				$scope.image_source = '/uploads/doctors/thumb/'+$scope.user.avators;
			}
			else {
				$scope.image_source = '/uploads/doctors/noimage_user.jpg';
			}
		});

		Auth.getState().then(function(response){
			$scope.state_list = response.data.state_list;

		});
	};

	$scope.doLogout = function() {

		Auth.logout();
		$scope.user = {};
		$location.path("/");
	};

	$scope.doProfile = function(valid) {
		if(valid) {
			
			$http({
                    method: 'POST',
                    url: 'api/update-profile',
                    headers: {
                		'Content-Type': undefined
            		},
                    data: {
                        first_name: $scope.first_name,
                        last_name: $scope.last_name,
                        email: $scope.email,
                        mobile: $scope.mobile,
                        sex: $scope.sex,
                        state_id: $scope.state_id,
                        city: $scope.city,
                        pincode: $scope.pincode,
                        dob: $scope.dob,
                        license: $scope.license,
                        biography: $scope.biography,
                        doctor_id: $scope.auth_id
                    },
                    transformRequest: function (data, headersGetter) {
                        var formData = new FormData();
                        angular.forEach(data, function (value, key) {
                            formData.append(key, value);
                        });
                        return formData;
                    }
                })
                .then(function (response) {

                })
                .catch(function (reason) {

                });
		        
		}
	};

	$scope.uploadedFile = function(element) {

	    $scope.currentFile = element.files[0];
	    var reader = new FileReader();

	    reader.onload = function(event) {
	      $scope.image_source = event.target.result
	      $scope.$apply(function($scope) {
	       $scope.image = element.files[0];

	      	$http({
			  method  : 'POST',
			  url     : 'api/update-profile-photo',
			  processData: false,
			  transformRequest: function (data) {
			      var formData = new FormData();
			      formData.append("avators", $scope.image); 
			      formData.append("doctor_id", $scope.doctor_id);  
			      return formData;  
			  },  
			  data : $scope,
			  headers: {
			         'Content-Type': undefined
			  }
		   }).then(function (response) {

           });
	      });
	    }
	   reader.readAsDataURL(element.files[0]);
	   
	  }
});