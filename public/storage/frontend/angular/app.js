var imaApp = angular.module('imaApp',['imaRoute','AuthCtrl','authService']);



imaApp.directive('myNavbar',function(){
	return {
		restrict: 'E',
		templateUrl: 'templates/navbar.html',
		scope: true
	};
	
});

imaApp.directive('mySidebar',function(){
    return {
		restrict: 'E',
		templateUrl: 'templates/sidebar.html',
		scope: true
	};
});

imaApp.directive('postsPagination', function(){  
   return{
      restrict: 'E',
      template: '<nav aria-label="Page navigation">'+
        '<ul class="pagination pagiright">'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getResultsPage(1)">&laquo;</a></li>'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getResultsPage(currentPage-1)">&lsaquo; Prev</a></li>'+
        '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
            '<a href="javascript:void(0)" ng-click="getResultsPage(i)">{{i}}</a>'+
        '</li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getResultsPage(currentPage+1)">Next &rsaquo;</a></li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getResultsPage(totalPages)">&raquo;</a></li>'+
      '</ul></nav>'
   };
});

imaApp.directive('doctorsPagination', function(){  
   return{
      restrict: 'E',
      template: '<nav aria-label="Page navigation">'+
        '<ul class="pagination pagiright">'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getAllDoctors(1)">&laquo;</a></li>'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getAllDoctors(currentPage-1)">&lsaquo; Prev</a></li>'+
        '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
            '<a href="javascript:void(0)" ng-click="getAllDoctors(i)">{{i}}</a>'+
        '</li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getAllDoctors(currentPage+1)">Next &rsaquo;</a></li>'+
        '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getAllDoctors(totalPages)">&raquo;</a></li>'+
      '</ul></nav>'
   };
});

imaApp.filter('htmlToPlaintext', function(){
	return function(text) {
      return  text ? String(text).replace(/<[^>]+>/gm, '') : '';
    };
});

imaApp.filter('slugify', function(){
  return function(input) {
      if (!input)
                return;
 
      // make lower case and trim
      var slug = input.toLowerCase().trim();

      // replace invalid chars with spaces
      slug = slug.replace(/[^a-z0-9\s-]/g, ' ');

      // replace multiple spaces or hyphens with a single hyphen
      slug = slug.replace(/[\s-]+/g, '-');

      return slug;
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
                    scope.doe = date;
                    scope.payment_date = date;
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

imaApp.directive('ngConfirmClick', function(){
  return {
            link: function (scope, element, attr) {
                var msg = attr.ngConfirmClick || "Are you sure?";
                var clickAction = attr.confirmedClick;
                element.bind('click',function (event) {
                    if ( window.confirm(msg) ) {
                        scope.$eval(clickAction)
                    }
                });
            }
        };
});

