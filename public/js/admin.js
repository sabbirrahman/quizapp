var atu = 'templates/admin/';
angular
	.module('quizapp-admin', ['ngRoute', 'ngResource'])
	.run(function ($rootScope,$timeout) {
		$rootScope.$on('$viewContentLoaded', function() {
			$timeout(function() {
				componentHandler.upgradeAllRegistered();
			})
		})
	})
	.config(['$routeProvider', function($routeProvider){
		$routeProvider
			.when('/',            { templateUrl: atu+'dashboard.html', controller: 'MainController' })
			.when('/quizzes',     { templateUrl: atu+'quizzes.html',   controller: 'QuizzesController' })
			.when('/quizzes/:id', { templateUrl: atu+'quiz.html',      controller: 'MainController' })
			.when('/quiz/add',    { templateUrl: atu+'quizadd.html',   controller: 'QuizAddController' })
			.when('/students',    { templateUrl: atu+'students.html',  controller: 'StudentsController' })
			.when('/students/:id',{ templateUrl: atu+'student.html',   controller: 'MainController' })
			.when('/stats',       { templateUrl: atu+'stats.html',     controller: 'MainController' })
			.when('/about',       { templateUrl: atu+'about.html',     controller: 'MainController' })
			.otherwise( { redirectTo: '/'});
	}])

	// Resource Services
	.factory("Quiz", ["$resource", function($resource) {
  		return $resource("api/admin/quizzes/:id", {id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" },
  			//changeVisibility: { url: "api/admin/quizzes/changevisibility/:id", method : "POST" }
  		});
	}])
	
	.factory("Student", ["$resource", function($resource) {
  		return $resource("api/admin/students/:id", {id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" },
  			//changeVisibility: { url: "api/admin/quizzes/changevisibility/:id", method : "POST" }
  		});
	}])

	.controller('MainController', ['$scope', function($scope){

	}])

	.controller('QuizzesController', ['$scope', 'Quiz', function($scope, Quiz){
		$scope.quizzes = Quiz.query();
	}])

	.controller('QuizAddController', ['$scope', 'Quiz', function($scope, Quiz){
		$scope.create = function() {
			Quiz.save($scope.quiz);
		}
	}])

	.controller('StudentsController', ['$scope', 'Student', function($scope, Student){
		$scope.students = Student.query();
	}])
	
	.filter("asDate", function () {
    	return function(input) {
        	return Date.parse(input);;
    	}
	});