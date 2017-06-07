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

imaApp.directive('forgotModal', function() {
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
                    scope.published_date = date;
                    scope.$apply();
                }
            });
        }
    };
});

imaApp.directive('ngMatch', function($parse){
  return {
        restrict: 'A',
        require: '?ngModel',
        link: function (scope, elem, attrs, ctrl) {
            if (!ctrl) return;
            if (!attrs['ngMatch']) return;

            var firstPassword = $parse(attrs['ngMatch']);

            var validator = function (value) {
              var temp = firstPassword(scope),
              v = value === temp;
              ctrl.$setValidity('match', v);
              return value;
          }

          ctrl.$parsers.unshift(validator);
          ctrl.$formatters.push(validator);
          attrs.$observe('ngMatch', function () {
          validator(ctrl.$viewValue);
          });
        }
    };
});