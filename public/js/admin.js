var atu = 'templates/admin/';
angular
	.module('quizapp-admin', ['ngRoute', 'ngResource', 'templates'])
	.run(function ($rootScope,$timeout) {
		$rootScope.$on('$viewContentLoaded', function() {
			$timeout(function() {
				componentHandler.upgradeAllRegistered();
			})
		})
	})
	.config(['$routeProvider', function($routeProvider){
		$routeProvider
			.when('/', { templateUrl: atu+'dashboard.html', controller: 'MainController'     })
			// Quiz Routes
			.when('/quizzes',		{ templateUrl: atu+'quizzes.html' , controller: 'QuizzesController' })
			.when('/quiz/add',		{ templateUrl: atu+'quizform.html', controller: 'QuizAddController' })
			.when('/quiz/edit/:id',	{ templateUrl: atu+'quizform.html', controller: 'QuizEditController'})
			// Quiz Question Routes
			.when('/quiz/:id/questions',			 { templateUrl: atu+'questions.html'   , controller: 'QuestionsController'   })
			.when('/quiz/:quiz_id/question/add',	 { templateUrl: atu+'questionform.html', controller: 'QuestionAddController' })
			.when('/quiz/:quiz_id/question/edit/:id',{ templateUrl: atu+'questionform.html', controller: 'QuestionEditController'})
			// Student Routes
			.when('/students',      { templateUrl: atu+'students.html' , controller: 'StudentsController' })
			.when('/students/:id',  { templateUrl: atu+'student.html'  , controller: 'MainController'     })
			// Other Routes
			.when('/stats', { templateUrl: atu+'stats.html'    , controller: 'MainController'     })
			.when('/about', { templateUrl: atu+'about.html'    , controller: 'MainController'     })
			.otherwise( { redirectTo: '/'});
	}])

	// Resource Services
	.factory("Quiz", ["$resource", function($resource) {
  		return $resource("api/admin/quizzes/:id", {id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" }
  		});
	}])
	
	.factory("Question", ["$resource", function($resource) {
  		return $resource("api/admin/quizzes/:quiz_id/questions/:id", {quiz_id:'@quiz_id', id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" }
  		});
	}])
	
	.factory("Student", ["$resource", function($resource) {
  		return $resource("api/admin/students/:id", {id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" }
  		});
	}])

	.controller('MainController', ['$scope', function($scope){

	}])


	/* Quiz Controllers */
	.controller('QuizzesController', ['$scope', 'Quiz',
		function($scope, Quiz){
			$scope.quizzes = Quiz.query();
			$scope.destroy = function(index) {
				Quiz.delete($scope.quizzes[index]);
				$scope.quizzes.splice(index, 1);
			}
		}
	])

	.controller('QuizAddController', ['$scope', 'Quiz',
		function($scope, Quiz){
			$scope.create = function() {
				$scope.quiz.date_time = $('.date_time').val();
				Quiz.save($scope.quiz);
			}
		}
	])

	.controller('QuizEditController', ['$scope', '$routeParams', 'Quiz',
		function($scope, $routeParams, Quiz){
			$scope.id = $routeParams.id;
			$scope.quiz = Quiz.get({'id':$scope.id});
			$scope.update = function() {
				$scope.quiz.date_time = $('.date_time').val();
				$scope.quiz.$update();
			}
		}
	])


	/* Question Controllers */
	.controller('QuestionsController', ['$scope', '$routeParams', 'Question',
		function($scope, $routeParams, Question){
			$scope.quiz_id = $routeParams.id;
			$scope.questions = Question.query({'quiz_id': $scope.quiz_id});
			$scope.destroy = function(index) {
				Question.delete($scope.questions[index]);
				$scope.questions.splice(index, 1);
			}
		}
	])

	.controller('QuestionAddController', ['$scope', 'Question',
		function($scope, Question){
			$scope.create = function() {
				$scope.question.date_time = $('.date_time').val();
				Question.save($scope.question);
			}
		}
	])

	.controller('QuestionEditController', ['$scope', '$routeParams', 'Question',
		function($scope, $routeParams, Question){
			$scope.id = $routeParams.id;
			$scope.question = Question.get({'id':$scope.id});
			$scope.update = function() {
				$scope.question.date_time = $('.date_time').val();
				$scope.question.$update();
			}
		}
	])

	.controller('StudentsController', ['$scope', 'Student',
		function($scope, Student){
			$scope.students = Student.query();
		}
	])
	
	.filter("asDate", function () {
    	return function(input) {
        	return Date.parse(input);;
    	}
	});