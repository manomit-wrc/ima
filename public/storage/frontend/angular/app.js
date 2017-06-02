var imaApp = angular.module('imaApp',['imaRoute','AuthCtrl','authService']);



imaApp.directive('myNavbar',function(){
	return {
		restrict: 'E',
		templateUrl: 'templates/navbar.html',
		scope: true
	};
	
});

imaApp.filter('htmlToPlaintext', function(){
	return function(text) {
      return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
    };
});

imaApp.directive('loginModal', function() {
   return {
     restrict: 'A',
     link: function(scope, element, attr) {
       scope.dismiss = function() {
           $(element).modal('hide');
       };
     }
   } 
});