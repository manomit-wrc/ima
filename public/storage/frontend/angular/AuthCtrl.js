var AuthCtrl = angular.module('AuthCtrl',['oitozero.ngSweetAlert','ui.bootstrap','ngSlimScroll']);

AuthCtrl.controller('AuthController',function($scope,$http,Auth,$location,$routeParams,$cookieStore,$window,SweetAlert,$modal){
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
	$scope.contact_address = '';
	$scope.footer_data='';
    
	//for paginations//
	$scope.news_data = [];
	$scope.events_data = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];
    $scope.map='';

    $scope.find_doctors = {};

    $scope.group_list = {};
    $scope.doctor_list = {};

    $scope.onSubmit = false;


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
			$scope.testimonial = $scope.user.testimonial;
			$scope.state_id = $scope.user.state_id;
			$scope.license = $scope.user.license;
			$scope.doctor_id = $scope.user.id;
			$scope.auth_id = $scope.user.id;
			$scope.avators = $scope.user.avators;
			$scope.address = $scope.user.address;

			

			if($scope.user.type == "C") {
				$scope.company_registration_no = $scope.user.company_regsitration_no;
				$scope.doe = $scope.user.doe;
			}
			
			
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

	$scope.getAllDoctors = function(pageNumber) {
		
          
		if(pageNumber===undefined){
      		pageNumber = '1';
    	}

		$http.get('/api/doctor-list?page='+pageNumber).then(function(response) {

		
    	  
    	  $scope.doctor_list = response.data.doctor_list.data;
	      
      	  $scope.totalPages   = response.data.doctor_list.last_page;
          $scope.currentPage  = response.data.doctor_list.current_page;

          var pages = [];

	      for(var i=1;i<=response.data.doctor_list.last_page;i++) {          
	        pages.push(i);
	      }
             //console.log(pages);
	      $scope.range = pages;
		  
	    });
	};
	
	$scope.groupList = function(pageNumber) {
		

		if(pageNumber===undefined){
      		pageNumber = '1';
    	}

		$http.get('/api/group-list?page='+pageNumber).then(function(response){

			$scope.group_list = response.data.group_list.data;
            $scope.totalPages   = response.data.group_list.last_page;
          $scope.currentPage  = response.data.group_list.current_page;
            var pages = [];

	      for(var i=1;i<=response.data.group_list.last_page;i++) {          
	        pages.push(i);
	      }

	      $scope.range = pages;

    	}).catch(function(reason) {

		});
	};
    
    $scope.getdrugList = function(pageNumber) {
		
         //console.log(pageNumber);
		if(pageNumber===undefined){
      		pageNumber = '1';
    	}

		$http.get('/api/drug-list?page='+pageNumber).then(function(response){
            
            console.log(response.data.drug_list.data);
			$scope.drug_list = response.data.drug_list.data;
            $scope.totalPages   = response.data.drug_list.last_page;
          $scope.currentPage  = response.data.drug_list.current_page;
            var pages = [];

	      for(var i=1;i<=response.data.drug_list.last_page;i++) {          
	        pages.push(i);
	      }

	      $scope.range = pages;

    	}).catch(function(reason) {

		});
	};

    
    $scope.getGroupData = function(pageNumber) {
		

		if(pageNumber===undefined){
      		pageNumber = '1';
    	}

		$http.get('/api/group-list?page='+pageNumber).then(function(response){
              
            //console.log(response.data.group_list.data);
			$scope.$parent.group_list = response.data.group_list.data;
            $scope.$parent.totalPages   = response.data.group_list.last_page;
          $scope.$parent.currentPage  = response.data.group_list.current_page;
            var pages = [];

	      for(var i=1;i<=response.data.group_list.last_page;i++) {          
	        pages.push(i);
	      }

	      $scope.$parent.range = pages;

    	}).catch(function(reason) {

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
			
			$scope.testimonial = response.data.testimonialdata;
			
			
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
	$scope.doContact=function(valid) {
		
		        //console.log($scope.registration.firstname);
		        //console.log('hello');
		       if(valid) {
				$scope.isDisabled = true;
				Auth.do_contact($scope.registration.firstname, 
				$scope.registration.lastname,
				$scope.registration.email_id,
				$scope.registration.phone,
				$scope.registration.comment).then(function(response){
				
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
					if($scope.user.type == "D") {
						$window.location.href = "/profile";
					}
					else {
						$window.location.href = "/company-profile";
					}
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

	$scope.getMedicalCat = function() {
		Auth.get_medical_cat().then(function(response){
			$scope.departments = response.data.departments;
		});
	};

	$scope.getcertificate = function() {
		
		Auth.get_certificate().then(function(response){
			$scope.qualification_list = response.data.qualification_list;
		});
		//console.log($scope.qualification_list);
	};

	$scope.getPaymentDetails = function() {
		

		Auth.get_payment_details($scope.doctor_id).then(function(response){
			
			$scope.payment = response.data.payment_details.payment;
			$scope.payment_date = response.data.payment_details.date_of_payment;
			$scope.certificates_arr = response.data.certificates_arr;
			$scope.qualification_arr = response.data.qualification_arr;
			
			$scope.qualification_id = $scope.qualification_arr;

		});
	};

	$scope.getJournalList = function() {
		

		Auth.get_journal_list($scope.doctor_id).then(function(response){
			$scope.journal_list = response.data.journals[0];
			console.log($scope.journal_list);
		});
	};

	


	$scope.getDrugData = function(pageNumber) {
		

		if(pageNumber===undefined){
      		pageNumber = '1';
    	}

		$http.get('/api/drug-list?page='+pageNumber).then(function(response){
              
            //console.log(response.data.group_list.data);
			$scope.$parent.drug_list = response.data.drug_list.data;
            $scope.$parent.totalPages   = response.data.drug_list.last_page;
          $scope.$parent.currentPage  = response.data.drug_list.current_page;
            var pages = [];

	      for(var i=1;i<=response.data.drug_list.last_page;i++) {          
	        pages.push(i);
	      }

	      $scope.$parent.range = pages;

    	}).catch(function(reason) {

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
                        doctor_id: $scope.auth_id,
                        testimonial: $scope.testimonial
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

	$scope.doCompanyProfile = function(valid) {
		if(valid) {
			$http({
                    method: 'POST',
                    url: 'api/update-company-profile',
                    headers: {
                		'Content-Type': undefined
            		},
                    data: {
                        first_name: $scope.first_name,
                        email: $scope.email,
                        mobile: $scope.mobile,
                        state_id: $scope.state_id,
                        city: $scope.city,
                        pincode: $scope.pincode,
                        doe: $scope.doe,
                        company_registration_no: $scope.company_registration_no,
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

	$scope.uploadedImage = function(element) {
		 $scope.$apply(function($scope) {
	       $scope.image = element.files[0];
	       
	      });
	};

	$scope.uploadedVideo = function(element) {
		 $scope.$apply(function($scope) {
	       $scope.video = element.files[0];
	       
	      });
	};

    $scope.loadProfile = function() {
       $scope.location = $location;	
       $location.path("/profile");
    };

    $scope.loadCompanyProfile = function() {
    	$scope.location = $location;
    	$location.path("/company-profile");
    };
    $scope.loadDrugProfile = function() {
    	$scope.location = $location;
    	$location.path("/drug-list");
    };

    $scope.loadChangePassword = function() {
		$scope.location = $location; 
    	$location.path("/change-password");
    };
    $scope.loadJournal = function() {
    	$scope.location = $location;
    	$location.path("/upload-journal");
    };
    $scope.loadJournalList = function() {
    	$scope.location = $location;
    	$location.path("/journal-list");
    };
     $scope.uploadcertificate = function() {
     	$scope.location = $location;
    	$location.path("/payment-certificate");
    };
	$scope.loadDoctors = function() {
		$scope.location = $location;
		$location.path("/doctor-list");
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


    $scope.getFileDetails = function (e) {

            $scope.doctor_file = [];
            $scope.$apply(function () {

                // STORE THE FILE OBJECT IN AN ARRAY.
                for (var i = 0; i < e.files.length; i++) {
                    $scope.doctor_file.push(e.files[i])
                }

            });

            
        };

     $scope.doUploadcertificate = function(valid) {
    	if(valid) {
    		Auth.submit_doctorcertificate($scope).then(function(response){
    			$scope.message = response.data.message;
				$scope.status_code = response.data.code;
				if($scope.status_code != 500) {
					/*$scope.payment = null;
					$scope.payment_date = null;
					$scope.qualification_id = null;
					$scope.doctor_file = null;*/
					
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
    		params: { events_id:$routeParams.events_id,slug: $routeParams.slug}
    		
    		
    	}).then(function(response){
    		
    		$scope.events_details = response.data.events_arr;
    		
    	});
    };

    $scope.activateAccount = function() {
    	$http.get('/api/activate-account',{
    		params: { active_token: $routeParams.active_token,active_time: $routeParams.active_time}
    	}).then(function(response){
    		$scope.message = response.data.msg;
    	});
    };

    $scope.getJournalDetails = function() {
    	$http.get('/api/journal-details',{
    		params: {journal_id: $routeParams.id}
    	}).then(function(response){
    		
    		$scope.category_id = response.data.journal_details.category_id;
    		$scope.title = response.data.journal_details.title;
    		$scope.description = response.data.journal_details.description;
    		$scope.published_date = response.data.journal_details.published_date;
    		$scope.journal_id = response.data.journal_details.id;

    		if(response.data.journal_details.journal_file != null) {
				$scope.file_source = '/uploads/doctors/journal/'+response.data.journal_details.journal_file;
				$scope.file_name = response.data.journal_details.journal_file;
			}


			
    	});
    };

    $scope.getDrugDetails = function() {
    	$http.get('/api/drug-details',{
    		params: {drug_id: $routeParams.id}
    	}).then(function(response){
    		//console.log(response.data.drug_details[0].department_id);
    		$scope.title = response.data.drug_details[0].title;
    		$scope.description = response.data.drug_details[0].description;
    		$scope.mfg_name = response.data.drug_details[0].mfg_name;
    		$scope.price = response.data.drug_details[0].price;
    		$scope.unit = response.data.drug_details[0].unit;
    		$scope.department_id = response.data.drug_details[0].department_id;
    	     //console.log(response.data.drug_details[0].department_id);
    		$scope.uid = response.data.drug_details[0].id;
    		

    		if(response.data.drug_details[0].image != null) {
				$scope.file_source = '/uploads/company/medicine/image/'+response.data.drug_details[0].image;
				$scope.file_name = response.data.drug_details[0].image;
				//console.log(response.data.drug_details.image);
			}
			if(response.data.drug_details[0].image != null) {
				$scope.video_source = '/uploads/company/medicine/video/'+response.data.drug_details[0].video;
				$scope.video_name = response.data.drug_details[0].video;
			}


			
    	});
    };


    $scope.doEditJournal = function(valid) {

    	if(valid) {
    		
    		Auth.edit_journal($scope).then(function(response){
    			$scope.message = response.data.message;
				$scope.status_code = response.data.code;
				if($scope.status_code != 500) {
					$scope.title = null;
					$scope.description = null;
					$scope.published_date = null;
					$scope.category_id = null;
					$scope.journal_file = null;

					$window.location.href = "/journal-list";
				}
				
    		});
    	}
    };

    $scope.removeJournal = function(journal_id,index) {
    	if(journal_id) {
    		$http.get('/api/delete-journal',{
    			params: {journal_id: journal_id}
    		}).then(function(response){
    			$scope.message = response.data.message;
    			$window.location.href = "/journal-list";
    		});
    	}
    };

    

    $scope.getContactusPage = function() {
          
          $http.get('/api/contact').then(function(response) {
          
          $scope.contact_data = response.data.contact_item;
          $scope.contact_address = $scope.contact_data[0].address;

	   });          
	    
    };
    $scope.getlocalBranchPage = function() {

          $http.get('/api/localbranch').then(function(response) {
          	
    	  $scope.branch_data = response.data.branch_item;
	   });
	    
	    
    }
    $scope.getCMS = function() {

          $http.get('/api/cms/',{
    		params: {slug: $routeParams.slug}
    		
    		
    	}).then(function(response){
    		
    		$scope.cms_details = response.data.cms_details;
    	});

    };
     $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();

    };

   $scope.getFootercontent= function() {

            $http.get('/api/footer').then(function(response){
    		$scope.footer_data = response.data.footer_item;
    		$scope.footer_description = response.data.footer_des;
    	});
	    
	    
    };

   $scope.getdoctorfrofile= function() {
             
             //alert('doctor');
            $http.get('/api/doctor_data').then(function(response){
            	//console.log(response.data);
    		$scope.doctor_content = response.data.doctor_item;
    		//$scope.footer_description = response.data.footer_des;
    	});
	    
	    
    };

    $scope.doUploadDrug = function(valid) {
    	if(valid) {
    		Auth.add_new_drug($scope).then(function(response){
    			$scope.message = response.data.message;
				$scope.status_code = response.data.code;
				if($scope.status_code != 500) {
					$scope.title = null;
					$scope.description = null;
					$scope.mfg_name = null;
					$scope.unit = null;
					$scope.price = null;
					$scope.image = null;
					$scope.video = null;

					SweetAlert.swal({   
				     title: "Thank You",   
				     text: response.data.message,   
				     type: "success",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK"
				    },  function(){  
				     window.location.reload();
				    });
				}
				
    		});
    	}
    }

 $scope.doEditDrug = function(valid) {
    	if(valid) {
    		Auth.edit_new_drug($scope).then(function(response){
    			$scope.message = response.data.message;
				$scope.status_code = response.data.code;
				if($scope.status_code != 500) {
					$scope.title = null;
					$scope.uid = null;
					$scope.description = null;
					$scope.mfg_name = null;
					$scope.unit = null;
					$scope.price = null;
					$scope.image = null;
					$scope.video = null;
					$scope.hidimg = null;
					$scope.hidvedio = null;

					SweetAlert.swal({   
				     title: "Thank You",   
				     text: response.data.message,   
				     type: "success",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK"
				    },  function(){  
				     window.location.reload();
				    });
				}
				
    		});
    	}
    };

	$scope.loadAddNewDrug = function() {
		$window.location.href = "/upload-drug";
	};

	$scope.loadGroup = function() {
		$scope.location = $location;
		$location.path('/groups');

	};

	$scope.loadAddNewGroup = function() {
		//$scope.activeClass = LeftBtnActive;
		$window.location.href = "/groups/add";
	};


	

	$scope.doAddGroup = function(valid) {
		if(valid) {
			$http.post('/api/add-group', {
			name:$scope.name,
			description:$scope.description,
			no_of_people:$scope.no_of_people,
			status:$scope.status
			}).then(function(response){
				$scope.message = response.data.message;
				$scope.code = response.data.code;
				if($scope.code == 200) {
					//
					 SweetAlert.swal({   
				     title: "Thank You",   
				     text: response.data.message,   
				     type: "success",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK"
				    },  function(){  
				     $window.location.href = "/groups";
				    });
				}
			}).catch(function(reason){
				
			});
		}
	};
    
	$scope.doEditGroup = function(valid) {
		if(valid) {
			$http.post('/api/edit-group', {
			name:$scope.name,
			description:$scope.description,
			no_of_people:$scope.no_of_people,
			status:$scope.status,
			group_id: $routeParams.id
			}).then(function(response){
				$scope.message = response.data.message;
				$scope.code = response.data.code;
				if($scope.code == 200) {
					//
					SweetAlert.swal({   
				     title: "Thank You",   
				     text: response.data.message,   
				     type: "success",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK"
				    },  function(){  
				     $window.location.href = "/groups";
				    });
				}
			}).catch(function(reason){
				
			});
		}
	};

	$scope.groupDetails = function() {
		$http.get('/api/group-details/',{
    		params: { group_id: $routeParams.id}
    	}).then(function(response){
    		$scope.name = response.data.group_details.name;
			$scope.no_of_people = response.data.group_details.no_of_people;
			$scope.description = response.data.group_details.description;
			$scope.status = response.data.group_details.status;
    	});
	};

	$scope.removeGroup = function(group_id) {
		
		SweetAlert.swal({   
			title: "Are you sure you want to delete this group?",
			text: "You will not be able to recover this group!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		},  function(isConfirm){
			if(isConfirm) {
				$http.get('/api/group-delete',{
				params: { group_id: group_id}
				}).then(function(response){
			SweetAlert.swal({   
				     title: "Deleted!",   
				     text: "Your group has been deleted",   
				     type: "success",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK"
				    },  function(){  
				     $window.location.href = "/groups";
				    });
				}); 
			}
		});
	}

	$scope.removedrug = function(drug_id) {
       
         SweetAlert.swal({   
			title: "Are you sure you want to delete this drug?",
			text: "You will not be able to recover this drug!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, delete it!",
			closeOnConfirm: false
		},  function(isConfirm){
			if(isConfirm) {
				$http.get('/api/delete-drug',{
				params: {drug_id:drug_id}
				}).then(function(response){
					SweetAlert.swal({   
				     title: "Deleted!",   
				     text: "Your drug has been deleted",   
				     type: "success",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK"
				    },  function(){  
				     $window.location.href = "/drug-list";
				    });
				}); 
			}
		});
 
    };
   

  $scope.loadPath = function() {
  	$scope.location = $location;
  	
  };
  $scope.findDoctors = function() {
  			if(Object.keys($scope.find_doctors).length == 0) {
  				
	  			$http.get('/api/find-doctors').then(function(response){
	  			$scope.find_doctors = response.data.find_doctors;
				})
				.catch(function(reason){

				});
  			}
  		
  }

  


  

  $scope.searchAllDoctors = function(pageNumber) {
		

		if(pageNumber===undefined){
      		pageNumber = '1';
    	}

		$http.get('/api/doctor-list?page='+pageNumber).then(function(response) {

		
    	  
    	  $scope.$parent.doctor_list = response.data.doctor_list.data;
	      
      	  $scope.$parent.totalPages   = response.data.doctor_list.last_page;
          $scope.$parent.currentPage  = response.data.doctor_list.current_page;

          var pages = [];

	      for(var i=1;i<=response.data.doctor_list.last_page;i++) {          
	        pages.push(i);
	      }

	      $scope.$parent.range = pages;
		  
	    });
	};

	 $scope.open = function (id) {
	 	angular.element(document.querySelector(".newli")).removeClass("open");
        $modal.open({
            templateUrl: 'myModalContent.html',
            backdrop: true, 
            windowClass: 'modal', 
            controller: function ($scope, $modalInstance, $log, user) {
                $http.get('/api/group-by-doctors',{
                	params: {doctor_id:id}
                }).then(function(response){
	  				$scope.groups = response.data.groups;
	  				$scope.receiver_email_id = response.data.doctor_details.email;
				})
				.catch(function(reason){

				});
                
                $scope.cancel = function () {
                    $modalInstance.dismiss('cancel'); 
                };
            },
            resolve: {
                user: function () {
                    return $scope.user;
                }
            }
        });
    };

    $scope.sendRequest = function() {
    	if(!$scope.sendGroupRequest.$valid)
    	{
    		SweetAlert.swal({   
		     title: "Please enter all details to send group request",  
		     type: "warning",     
		     confirmButtonColor: "#DD6B55",   
		     confirmButtonText: "OK",
		     closeOnConfirm: true
		    });
    	}
    	else{
    		$http.post('/api/send-group-request',{
				receiver_email_id: $scope.receiver_email_id,
				group_id: $scope.group_id,
				description: $scope.description	
    		}).then(function(response){
    			SweetAlert.swal({   
				     title: "Thank You",   
				     text: response.data.message,   
				     type: "success",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK"
				    },  function(){  
				     window.location.reload();
				    });
    		}).catch(function(reason){
    			SweetAlert.swal({   
				     title: "Thank You",   
				     text: response.data.message,   
				     type: "warning",     
				     confirmButtonColor: "#DD6B55",   
				     confirmButtonText: "OK",
				     closeOnConfirm: true
				    });
    		});
    	}
    	
    };


});

AuthCtrl.directive('addressBasedGoogleMap', function () {

    return {
        restrict: "A",
        template: "<div id='addressMap'></div>",
        scope: {
            Address: "=address",
            zoom: "="
        },
        controller: function ($scope, $element, $attrs, $http) {
            var geocoder;
            var latlng;
            var map;
            var marker;
            var lat;
            var lng;
            var addr;
            var initialize = function () {
                $http.get('/api/contact-address').then(function(response){

                	addr = response.data.contact_address;
                	geocoder = new google.maps.Geocoder();
	                geocoder.geocode({'address': addr }, 
	                function (results, status) 
	                  {
	                      
	                    if (status == google.maps.GeocoderStatus.OK) {
	                        
	                        lat = results[0].geometry.location.lat();
	                        lng = results[0].geometry.location.lng();
	                        latlng = new google.maps.LatLng(lat, lng);
	                   var mapOptions = {
	                    zoom: $scope.zoom,
	                    center: latlng,
	                    mapTypeId: google.maps.MapTypeId.ROADMAP
	                 };
	                map = new google.maps.Map
	                       (document.getElementById('addressMap'), mapOptions);
	                        map.setCenter(results[0].geometry.location);
	                        marker = new google.maps.Marker({
	                            map: map,
	                            position: results[0].geometry.location
	                        });
	                    }
	                });


	                
	                });

                
            };
            
            initialize();
        },
    };
});

AuthCtrl.directive('autocomplete', function($http,$localStorage) {
    return {
        restrict: 'A',
        require : 'ngModel',
        link : function ($scope, $element, $attrs, ngModelCtrl) {
              
              $element.autocomplete({
              	source: '/api/doctors/search?token='+$localStorage.token,
                select:function (event,ui) {
                  
                    ngModelCtrl.$setViewValue(ui.item);
                    
					$http.get('/api/doctor-search?page=1&doctor_id='+ui.item.id).then(function(response) {
						$scope.$parent.doctor_list = response.data.doctor_list.data;
	      
				      	$scope.$parent.totalPages   = response.data.doctor_list.last_page;
				        $scope.$parent.currentPage  = response.data.doctor_list.current_page;

				          var pages = [];

					      for(var i=1;i<=response.data.doctor_list.last_page;i++) {          
					        pages.push(i);
					      }

					      $scope.$parent.range = pages;
				    });
                    
                }
              });
                
            
        }
    }
});

AuthCtrl.directive('loading', function($http){
	return {
            restrict: 'A',
            link: function (scope, elm, attrs)
            {
                scope.isLoading = function () {
                    return $http.pendingRequests.length > 0;
                };

                scope.$watch(scope.isLoading, function (v)
                {
                    if(v){
                        elm.show();
                    }else{
                        elm.hide();
                    }
                });
            }
        };
    });

AuthCtrl.directive('groupAutocomplete', function($http,$localStorage) {
    return {
        restrict: 'A',
        require : 'ngModel',
        link : function ($scope, $element, $attrs, ngModelCtrl) {

              
              $element.autocomplete({
              	/*source:function(request, response) {
              		'/api/doctors/search',{ token: $localStorage.token }
              	},*/
                  
              	source: '/api/groups/search?token='+$localStorage.token,
                select:function (event,ui) {
                  
                    ngModelCtrl.$setViewValue(ui.item);


                    $http.get('/api/group-search-details?page=1&group_id='+ui.item.id).then(function(response) {

                    	   //console.log(response.data.group_search.data);
						$scope.$parent.group_list = response.data.group_search.data;
	      
				      	$scope.$parent.totalPages   = response.data.group_search.last_page;
				        $scope.$parent.currentPage  = response.data.group_search.current_page;

				          var pages = [];

					      for(var i=1;i<=response.data.group_search.last_page;i++) {          
					        pages.push(i);
					      }

					      $scope.$parent.range = pages;
					      
				    });
					
                

                }


              });
                
            
        }
    }

});

AuthCtrl.directive('drugAutocomplete', function($http,$localStorage) {

    return {
        restrict: 'A',
        require : 'ngModel',
        link : function ($scope,$element,attrs, ngModelCtrl) {

              
              $element.autocomplete({
              	/*source:function(request, response) {
              		'/api/doctors/search',{ token: $localStorage.token }
              	},*/
                  
              	source: '/api/drugs/search?token='+$localStorage.token,
                select:function (event,ui) {
                  
                    ngModelCtrl.$setViewValue(ui.item);

                    $http.get('/api/drugs-search-details?page=1&drug_id='+ui.item.id).then(function(response) {

                    	  //console.log(response.data.drug_search.data);
						$scope.$parent.drug_list = response.data.drug_search.data;
	      
				      	$scope.$parent.totalPages   = response.data.drug_search.last_page;
				        $scope.$parent.currentPage  = response.data.drug_search.current_page;

				          var pages = [];

					      for(var i=1;i<=response.data.drug_search.last_page;i++) {          
					        pages.push(i);
					      }

					      $scope.$parent.range = pages;
					      
				    });

                    
					
                }

              });
                
            
        }
    }
}).directive('imgCheck', ['$http', function($http){
        return {
            link: function(scope, element, attrs){
            	if(attrs.imgCheck) {
            		$http.get('/api/check-doctor-image',{
                	params: { avators: attrs.imgCheck}})
                     .then(function(response){
                     	
                        if(response.data.code==200){
                            attrs.$set('src','/uploads/doctors/thumb/'+attrs.imgCheck);
                        }else{
                            attrs.$set('src','/uploads/doctors/noimage_user.jpg');
                        }
                     })
                     .catch(function(reason){
                        attrs.$set('src','/uploads/doctors/noimage_user.jpg');
                     });
            	}
            	else {
            		attrs.$set('src','/uploads/doctors/noimage_user.jpg');
            	}
                
            }
        };
}]);;



