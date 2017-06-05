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

imaApp.directive('fileinput', function() {
  return {
      scope: {
        fileinput: "=",
        filepreview: "="
      },
      link: function(scope, element, attributes) {
        element.bind("change", function(changeEvent) {

          scope.fileinput = changeEvent.target.files[0];
          var reader = new FileReader();
          reader.onload = function(loadEvent) {
            scope.$apply(function() {
              scope.filepreview = loadEvent.target.result;
              
            });
          }
          reader.readAsDataURL(scope.fileinput);
        });
      }
    }
});

imaApp.directive('jqdatepicker', function () {
    return {
        restrict: 'A',
        require: 'ngModel',
         link: function (scope, element, attrs) {
            element.datepicker({
                dateFormat: 'dd-mm-yy',
                onSelect: function (date) {
                    scope.dob = date;
                    scope.$apply();
                }
            });
        }
    };
});