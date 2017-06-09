var AuthCtrl = angular.module('AuthCtrl',[]);

AuthCtrl.controller('AuthController',function($scope,$http,Auth,$location,$routeParams,$cookieStore,$window){
	$scope.code = '';
	$scope.message = '';
	$scope.user = {};
	$scope.banners = {};
	$scope.teams = {};
	$scope.news = {};
	$scope.events = {};
	$scope.doctor_id = '';
	$scope.journal_file = {};
	$scope.isDisabled = false;

	//for paginations//
	$scope.news_data = [];
	$scope.events_data = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];
    

    $scope.init = function () {
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
			$scope.address = $scope.user.address;
			
			if($scope.user.avators != null) {
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
	$scope.init();


    $scope.getResultsPage = function(pageNumber) {

    	if(pageNumber===undefined){
      		pageNumber = '1';
    	}

    	$http.get('/api/news-list?page='+pageNumber).then(function(response) {
    	  
    	  $scope.news_data = response.data.news_item.data;
	      
      	  $scope.totalPages   = response.data.news_item.last_page;
          $scope.currentPage  = response.data.news_item.current_page;

          var pages = [];

	      for(var i=1;i<=response.data.news_item.last_page;i++) {          
	        pages.push(i);
	      }

	      $scope.range = pages; 
	    });
	    
	    
    };

    $scope.getEventPage = function(pageNumber) {

    	if(pageNumber===undefined){
      		pageNumber = '1';
    	}

    	$http.get('/api/events-list?page='+pageNumber).then(function(response) {
    	  
    	  $scope.events_data = response.data.events_item.data;
	      
      	  $scope.totalPages   = response.data.events_item.last_page;
          $scope.currentPage  = response.data.events_item.current_page;

          var pages = [];

	      for(var i=1;i<=response.data.events_item.last_page;i++) {          
	        pages.push(i);
	      }

	      $scope.range = pages; 
	    });
	    
	    
    };
   
	//end paginations//

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
				$scope.isDisabled = true;
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
				$scope.isDisabled = false;
			});
		}
		
	};

	$scope.doLogin = function(valid) {
		if(valid) {
			$scope.isDisabled = true;
			Auth.do_login($scope.login.login_email_id, 
				$scope.login.login_password,$scope.login.remember_me).then(function(response){
				$scope.isDisabled = false;
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
					//$location.path('/profile');
					$window.location.href = "/profile";
				});
				}
			});
		}
	};

	$scope.doForgotPassword = function(valid) {
		if(valid) {
			Auth.forgot_password($scope.email_id).then(function(response){

				$scope.code = 1;
				$scope.message = response.data.message;
			});
		}
	};

	$scope.closeLogin = function() {
		$scope.dismiss();
	};

	$scope.closeForgot = function() {
		$scope.dismiss();
	};

	$scope.doPassword = function(valid) {
		if(valid) {

			Auth.do_change_password($scope.old_password,$scope.auth_id,$scope.new_password).then(function(response){
				$scope.message = response.data.message;
				$scope.status_code = response.data.code;
			});
		}
	};

	

	$scope.getCategory = function() {
		Auth.get_category().then(function(response){
			$scope.categories = response.data.categories;
		});
	};

	$scope.getJournalList = function() {
		
		Auth.get_journal_list($scope.doctor_id).then(function(response){
			$scope.journal_list = response.data.journals[0];
			
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
                        address: $scope.address,
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
                	$scope.status_code = 1;
                	$scope.message = response.data.message;
                })
                .catch(function (reason) {
                	$scope.status_code = 1;
                	$scope.message = "Please try again";
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
	   
	  };

	$scope.uploadedJournalDoc = function(element) {
		 $scope.$apply(function($scope) {
	       $scope.journal_file = element.files[0];
	       
	      });
	};

    $scope.loadProfile = function() {
    	$location.path("/profile");
    };

    $scope.loadChangePassword = function() {
    	$location.path("/change-password");
    };
    $scope.loadJournal = function() {
    	$location.path("/upload-journal");
    };
    $scope.loadJournalList = function() {
    	$location.path("/journal-list");
    };

    $scope.doUploadJournal = function(valid) {
    	if(valid) {
    		
    		Auth.submit_journal($scope).then(function(response){
    			$scope.message = response.data.message;
				$scope.status_code = response.data.code;
				if($scope.status_code != 500) {
					$scope.title = null;
					$scope.description = null;
					$scope.published_date = null;
					$scope.category_id = null;
					$scope.journal_file = null;
				}
				
    		});
    	}
    };

    $scope.getNewsDetails = function() {
    	$http.get('/api/get-news/',{
    		params: { news_id: $routeParams.news_id,slug: $routeParams.slug}
    		
    		
    	}).then(function(response){
    		
    		$scope.news_details = response.data.news_arr;
    		$scope.tag_details = response.data.tags_arr;
    	});
    };

     $scope.getEventsDetails = function() {
    	$http.get('/api/get-events/',{
    		params: { events_id: $routeParams.events_id,slug: $routeParams.slug}
    		
    		
    	}).then(function(response){
    		
    		$scope.events_details = response.data.events_arr;
    		//$scope.tag_details = response.data.tags_arr;
    	});
    };

    $scope.activateAccount = function() {
    	$http.get('/api/activate-account',{
    		params: { active_token: $routeParams.active_token,active_time: $routeParams.active_time}
    	}).then(function(response){
    		$scope.message = response.data.msg;
    	});
    };

    
});