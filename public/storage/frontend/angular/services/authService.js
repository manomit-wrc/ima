var authService = angular.module('authService',['ngStorage']);

authService.factory('Auth', function($http,$q,AuthToken){
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

	authFactory.do_login = function(email,password) {
		var defer = $q.defer();
		$http.post('/api/login', {
			email:email,
			password:password
		}).then(function(response){
			AuthToken.setToken(response.data.token);
			defer.resolve(response);
		}).catch(function(reason){
			defer.resolve(reason);
		});

		return defer.promise;
	};

	authFactory.logout = function() {
		AuthToken.setToken();
	};

	authFactory.isLoggedIn = function() {
		if(AuthToken.getToken())
			return true;
		else
			return false;
	};
	authFactory.getUser = function() {
		var defer = $q.defer();
		if(AuthToken.getToken())
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