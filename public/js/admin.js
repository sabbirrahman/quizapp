var atu = 'admin/';
angular
	.module('quizapp-admin', [	'ngRoute',
								'ngResource',
								'ngAnimate',
								'mdl',
								'ordinal',
								'templates'
							])

	.run(['$rootScope', '$timeout', function ($rootScope, $timeout) {
		$rootScope.$on('$viewContentLoaded', function() {
			$timeout(function() {
				componentHandler.upgradeAllRegistered();
			})
		})
	}])
	.config(['$routeProvider', 'mdlConfigProvider', function($routeProvider, mdlConfigProvider){
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
			.when('/student/:id',   { templateUrl: atu+'student.html'  , controller: 'StudentController'  })
			// Stats Routes
			.when('/stats',     { templateUrl: atu+'stats.html'      , controller: 'StatsController' })
			.when('/stats/:id', { templateUrl: atu+'stat.html'       , controller: 'StatController'  })
			// Other Routes
			.when('/settings',  { templateUrl: 'settings.html', controller: 'SettingsController'})
			.when('/about',     { templateUrl: 'about.html'   , controller: 'MainController'    })
			.otherwise( { redirectTo: '/'});
        mdlConfigProvider.floating = false;
	}])

	// Resource Services
	.factory("Quiz", ["$resource", function($resource) {
  		return $resource("api/admin/quizzes/:id", {id:'@id'}, {
  			update: { method : "PUT" },
  			participants: { method:"GET", url:"api/admin/quizzes/:id/participants", isArray:true }
  		});
	}])
	
	.factory("Question", ["$resource", function($resource) {
  		return $resource("api/admin/quizzes/:quiz_id/questions/:id", {quiz_id:'@quiz_id', id:'@id'}, {
  			update: { method : "PUT" }
  		});
	}])
	
	.factory("Option", ["$resource", function($resource) {
  		return $resource("api/admin/questions/:question_id/options/:id", {question_id:'@question_id', id:'@id'}, {
  			update: { method : "PUT" }
  		});
	}])
	
	.factory("Student", ["$resource", function($resource) {
  		return $resource("api/admin/students/:id", {id:'@id'}, {
  			update: { method:"PUT" },
  			quizzes: { method:"GET", url:"api/admin/students/:id/quizzes", isArray:true }
  		});
	}])
	
	.factory("User", ["$resource", function($resource) {
  		return $resource("api/admin/users/:id", {id:'@id'}, {
  			update: { method:"PUT" },
  			updatePassword: { method:"POST", url:"api/admin/users/:id/updatepassword", isArray:false }
  		});
	}])
	

	.controller('MainController', ['$scope', function($scope){
		$(document).click(function(ev) {
			if($(ev.target).parents('.mdl-layout__header').length > 0 ||
			   $(ev.target).parents('.mdl-layout__drawer').length > 0 ||
			   $(ev.target).hasClass('mdl-layout__drawer')) return;
			$(".mdl-layout__drawer").removeClass("is-visible");
		});
	}])


	/* Quiz Controllers */
	.controller('QuizzesController', ['$scope', '$filter', 'Quiz',
		function($scope, $filter, Quiz){
			$scope.quizzes = Quiz.query(function(){
				$scope.quizzes = $filter('orderBy')($scope.quizzes, 'date_time', true);
			});
			$scope.destroy = function(index) {
				Quiz.delete($scope.quizzes[index]);
				$scope.quizzes.splice(index, 1);
			}
		}
	])

	.controller('QuizAddController', ['$scope', '$location', 'Quiz',
		function($scope, $location, Quiz){
			$scope.quiz = {};
			$scope.create = function() {
				$scope.quiz.date_time = $('.date_time').val();
				Quiz.save($scope.quiz,
					function(){
						$location.path('/quizzes').replace();
				 }, function(err) {
				 		$scope.errors = err.data;
				});
			}
		}
	])

	.controller('QuizEditController', ['$scope', '$routeParams', '$location', 'Quiz',
		function($scope, $routeParams, $location, Quiz){
			$scope.id = $routeParams.id;
			$scope.quiz = Quiz.get({'id':$scope.id});
			$scope.update = function() {
				$scope.quiz.date_time = $('.date_time').val();
				$scope.quiz.$update(
					function() {
						$location.path('/quizzes').replace();
				 }, function(err) {
				 		$scope.errors = err.data;
				});
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

	.controller('QuestionAddController', ['$scope', '$routeParams', '$location', 'Question', 'Option',
		function($scope, $routeParams, $location, Question, Option){
			$scope.quiz_id = $routeParams.quiz_id;
			$scope.question = {
				question : "",
				options : []
			}
			$scope.create = function() {
				$scope.question.quiz_id = $scope.quiz_id;
				Question.save($scope.question,
					function(){
						$location.path('/quiz/'+ $scope.quiz_id +'/questions').replace();
				 }, function(err){
				 		$scope.errors = err.data;
				});
			}

			$scope.optionCreate = function(ev) {
				if(ev.keyCode != 13) return;
				ev.preventDefault();
				var newOption = {id:Math.floor(Math.random()*9999),option: $scope.newOpt};
				$scope.question.options.push(newOption);
				$scope.newOpt = "";
			}

			$scope.optionUpdate = function(ev, option) {
				if(ev.keyCode != 13) return;
				ev.preventDefault();
				$scope.editMode = "";
			}

			$scope.optionDelete = function(index) {
				$scope.question.options.splice(index, 1);
			}

			$scope.changeEditMode = function(id) {
				$scope.editMode = id;
			}
		}
	])

	.controller('QuestionEditController', ['$scope', '$routeParams', '$location', 'Question', 'Option',
		function($scope, $routeParams, $location, Question, Option){
			$scope.quiz_id = $routeParams.quiz_id;
			$scope.id 	   = $routeParams.id;
			$scope.question = Question.get({'quiz_id':$scope.quiz_id, 'id':$scope.id});
			
			$scope.update = function() {
				$scope.question.$update(
					function(){
						$location.path('/quiz/'+ $scope.quiz_id +'/questions').replace();
				 }, function(err){
				 		$scope.errors = err.data;
				});
			}

			$scope.optionCreate = function(ev) {
				if(ev.keyCode != 13) return;
				ev.preventDefault();
				var newOption = {question_id:$scope.id, option: $scope.newOpt};
				Option.save(newOption, function(res){
					$scope.question.options.push(res);
					$scope.newOpt = "";
				});
			}

			$scope.optionUpdate = function(ev, option) {
				if(ev.keyCode != 13) return;
				ev.preventDefault();
				Option.update(option);
				$scope.editMode = "";
			}

			$scope.optionDelete = function(index) {
				Option.delete($scope.question.options[index]);
				$scope.question.options.splice(index, 1);
			}

			$scope.changeEditMode = function(id) {
				$scope.editMode = id;
			}

		}
	])

	.controller('StudentsController', ['$scope', 'Student',
		function($scope, Student){
			$scope.students = Student.query();
		}
	])

	.controller('StudentController', ['$scope', '$routeParams', 'Student',
		function($scope, $routeParams, Student){
			$scope.id = $routeParams.id
			$scope.quizzes = Student.quizzes({id:$scope.id});
		}
	])


	/* Stat Controllers */
	.controller('StatsController', ['$scope', 'Quiz',
		function($scope, Quiz){
			$scope.quizzes = Quiz.query();
		}
	])

	.controller('StatController', ['$scope', '$routeParams', 'Quiz',
		function($scope, $routeParams, Quiz){
			$scope.quiz_id = $routeParams.id;
			$scope.participants = Quiz.participants({id:$scope.quiz_id}, function(){
				$scope.participants = $scope.participants.sort(function(ob1, ob2) {
					if(ob2.score > ob1.score) return 1;
					if(ob2.score == ob1.score && ob2.time < ob1.time) return 1;
					return 0;
				});
			});
		}
	])


	// Settings Controller
	.controller('SettingsController', ['$scope', 'User',
		function($scope, User){
			$scope.user = User.get({id: $scope.user_id});

			$scope.update = function() {
				$scope.errors   = undefined;
				$scope.successi = undefined;
				$scope.successp = undefined;
				$scope.user.$update(
					function(res) { $scope.successi = true;     },
					function(err) { $scope.errors   = err.data; }
				);
			}

			$scope.updatePassword = function(){
				$scope.errors   = undefined;
				$scope.successi = undefined;
				$scope.successp = undefined;
				User.updatePassword({id: $scope.user_id}, $scope.password,
					function(res){
						if(res[0] == 'f') {
							$scope.errors = { old_password: ["The old password doesn't match our record!"]}
						} else {
							$scope.successp = true;
							$scope.password = [];
						}
				 	}
				  , function(err){
					$scope.errors = err.data;
					console.log($scope.errors);
				});
			};
		}
	])

	/* Directive */
	.directive('error', function() {
		return {
    		restrict: 'E',
        	scope: { errors: '=' },
			template: `
				<div class="errors" ng-show="errors">
					<span class="text-danger repeat-animation" ng-repeat="msg in errors"> {{msg}}</span>
				</div>
			`
		};
	})
	/* End of Directive */


	/* Filters */
	.filter("asDate", function () {
    	return function(input) {
        	return Date.parse(input);;
    	}
    })
	.filter("hourminute", function () {
    	return function(input) {
    		var h = Math.floor(input/60);
    		var m = Math.floor(input%60);
    		var output = "";
    		output += h ? h+' h' : '';
    		output += h&&m ? ' ' : '';
    		output += m ? m+' m' : '';
        	return output;
    	}
	})
	.filter("hourminutesecond", function () {
    	return function(input) {
    		var h = Math.floor(input/3600); input %= 3600;
    		var m = Math.floor(input/60);   input %= 60;
    		var s = Math.floor(input);
    		var output = "";
    		output += h ? h+' h' : '';
    		output += h&&m ? ' ' : '';
    		output += m ? m+' m' : '';
    		output += (h&&s) || (m&&s) ? ' ' : '';
    		output += s ? s+' s' : '';
        	return output;
    	}
	});
	/* End of Filters */