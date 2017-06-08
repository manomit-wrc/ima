var authService = angular.module('authService',['ngStorage']);

authService.factory('Auth', function($http,$q,AuthToken,$cookieStore){
	var authFactory = {};

	authFactory.do_registration = function(first_name,last_name,email_id,mobile_no,password) {
		var defer = $q.defer();
		$http.post('/api/registration', {
			first_name:first_name,
			last_name:last_name,
			email:email_id,
			mobile:mobile_no,
			password:password
		}).then(function(response){
			AuthToken.setToken(response.data.token);
			defer.resolve(response);
		}).catch(function(reason){
			defer.resolve(reason);
		});

		return defer.promise;
	};

	authFactory.do_login = function(email,password,remember_me) {
		var defer = $q.defer();
		$http.post('/api/login', {
			email:email,
			password:password
		}).then(function(response){
			AuthToken.setToken(response.data.token);
			if(remember_me) {
				$cookieStore.put("remember_token", response.data.token);
			}
			else {
				$cookieStore.put("remember_token", "");
			}
			defer.resolve(response);
		}).catch(function(reason){
			defer.resolve(reason);
		});

		return defer.promise;
	};

	authFactory.get_category = function() {
		var defer = $q.defer();
		$http.get('/api/categories').then(function(response){
			defer.resolve(response);
		}).catch(function(reason){
			defer.resolve(response);
		});

		return defer.promise;
	};

	authFactory.do_change_password = function(old_password,auth_id,new_password) {
		var defer = $q.defer();
		console.log(old_password+"-"+auth_id+"-"+new_password);
		$http.post('/api/update-password', {
			old_password:old_password,
			doctor_id:auth_id,
			new_password:new_password
		}).then(function(response) {
			defer.resolve(response);
		}).catch(function(reason) {
			defer.resolve(reason);
		});
		return defer.promise;
	};

	authFactory.logout = function() {

		AuthToken.setToken();
		$cookieStore.remove('remember_token');
	};

	authFactory.isLoggedIn = function() {
		if(AuthToken.getToken())
			return true;
		else
			return false;
	};
	authFactory.getUser = function() {
		var defer = $q.defer();
		if(AuthToken.getToken() || $cookieStore.get('remember_token'))
		{
			$http.get('/api/doctors').then(function(response){
				
				defer.resolve(response);
			}).catch(function(reason){
				defer.resolve(reason);
			});
			return defer.promise;
		}
		else {
			return $q.reject({message: 'No Token Found'});
		}
		
	};

	authFactory.getState = function() {
		var defer = $q.defer();
		$http.get('/api/state-list').then(function(response){
			defer.resolve(response);
		}).catch(function(reason){
			defer.resolve(reason);
		});

		return defer.promise;
	};

	authFactory.forgot_password = function(email_id) {
		var defer = $q.defer();
		$http.post('/api/check-user-email',{
			email:email_id
		}).then(function(response){
			defer.resolve(response);
		}).catch(function(reason){
			defer.resolve(response);
		});

		return defer.promise;
	};

	authFactory.submit_journal = function(journal) {
		var defer = $q.defer();
		$http({
		  method  : 'POST',
		  url     : 'api/submit-journal',
		  processData: false,
		  transformRequest: function (data) {
		      var formData = new FormData();
		      formData.append("journal_file", journal.journal_file); 
		      formData.append("doctor_id", journal.auth_id);  
		      formData.append("title", journal.title);
		      formData.append("description", journal.description);
		      formData.append("published_date", journal.published_date);
		      formData.append("category_id", journal.category_id);
		      return formData;  
		  },  
		  data : journal,
		  headers: {
		         'Content-Type': undefined
		  }
	   }).then(function (response) {
	   		defer.resolve(response);
       }).catch(function(reason){
       		defer.resolve(reason);
       });

       return defer.promise;
	}

	return authFactory;
});



authService.factory('AuthToken', function($localStorage){
	var authTokenFactory = {};

	authTokenFactory.getToken = function() {
		return $localStorage.token;
	};

	authTokenFactory.setToken = function(token) {
		if(token)
			$localStorage.token = token;
		else
			delete $localStorage.token;
	}

	return authTokenFactory;
});

authService.factory('AuthInterceptor', function ($q, $location, $localStorage) {
    return {
        'request': function (config) {
            config.headers = config.headers || {};
            if ($localStorage.token) {
                config.headers["token"] = $localStorage.token;
            }
            
            return config;
        },
        'responseError': function (response) {
        	

            if (response.status === 401 || response.status === 403 || response.status === 500) {
                $location.path("/");
            }
            return $q.reject(response);
        }
    };
}).config(function($httpProvider) {
  $httpProvider.interceptors.push('AuthInterceptor');
});