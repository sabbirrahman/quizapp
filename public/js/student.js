var atu = 'templates/student/';
angular
	.module('quizapp-student', ['ngRoute', 'ngResource', 'ngAnimate', 'angular-flipclock', 'mdl', 'templates'])
	.run(['$rootScope', '$timeout', function ($rootScope, $timeout) {
		$rootScope.$on('$viewContentLoaded', function() {
			$timeout(function() {
				componentHandler.upgradeAllRegistered();
			})
		})
	}])
	.config(['$routeProvider', 'mdlConfigProvider', function($routeProvider, mdlConfigProvider){
		$routeProvider
			.when('/', 					{ templateUrl: atu+'dashboard.html'	 , controller: 'MainController'     })
			.when('/quizzes',		    { templateUrl: atu+'quizzes.html'  	 , controller: 'QuizzesController'  })
			.when('/quiz/:id/questions',{ templateUrl: atu+'questions.html'	 , controller: 'QuestionsController'})
			.when('/stats', 			{ templateUrl: atu+'stats.html'    	 , controller: 'StatsController'    })
			.when('/stats/:id', 		{ templateUrl: atu+'stat.html'     	 , controller: 'StatController'     })
			.when('/result/:id', 		{ templateUrl: atu+'stat.html'     	 , controller: 'ResultController'   })
			.when('/settings', 			{ templateUrl: 'templates/settings.html', controller: 'SettingsController' })
			.when('/about', 			{ templateUrl: 'templates/about.html'   , controller: 'MainController'     })
			.otherwise( { redirectTo: '/'});
        mdlConfigProvider.floating = false;
	}])

	// Resource Services
	.factory("Quiz", ["$resource", function($resource) {
  		return $resource("api/student/quizzes/:id", {id:'@id'}, {
  			update: { method : "PUT" },
  			participate: { url:"api/student/quizzes/:quiz_id/participate/:student_id", isArray:false }
  		});
	}])

	.factory("Question", ["$resource", function($resource) {
  		return $resource("api/student/quizzes/:quiz_id/questions/:id", {quiz_id:'@quiz_id', id:'@id'});
	}])

	.factory("Answer", ["$resource", function($resource) {
  		return $resource("api/student/quizzes/:quiz_id/answers/", {quiz_id:'@quiz_id'}, {
  			correctAnswers: { url: 'api/student/quizzes/:quiz_id/correctanswers', isArray:true }
  		});
	}])

	.factory("Student", ["$resource", function($resource) {
  		return $resource("api/student/students/:id", {id:'@id'}, {
  			update: { method : "PUT" },
  			quizzes: { url:"api/student/students/:id/quizzes", isArray:true },
  			score: { url:"api/student/students/:student_id/score/:quiz_id", isArray:false }
  		});
	}])
	
	.factory("User", ["$resource", function($resource) {
  		return $resource("api/admin/users/:id", {id:'@id'}, {
  			update: { method:"PUT" },
  			updatePassword: { method:"POST", url:"api/student/users/:id/updatepassword", isArray:false }
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
		}
	])


	/* Question Controllers */
	.controller('QuestionsController', ['$scope', '$routeParams', '$location', 'Quiz', 'Question', 'Answer',
		function($scope, $routeParams, $location, Quiz, Question, Answer){
			$scope.Math = window.Math;
			$scope.pageNo = 1;
			$scope.maxPage;
			$scope.quiz_id = $routeParams.id;
			$scope.answers = [];

			var clock2StopCallback = function() {
				$scope.questions = Question.query({'quiz_id': $scope.quiz_id}, function(){
					$scope.maxPage = Math.ceil($scope.questions.length/10);
					var clock2 = $('.flip-clock2').FlipClock({
						autoStart: false,
						countdown: true,
						callbacks: {
							start: function() {
								if(localStorage.quiz_id)
									var quiz_id = angular.fromJson(localStorage.quiz_id)
								if(localStorage.myAnswers && quiz_id == $scope.quiz_id) {
									$scope.questions = angular.fromJson(localStorage.myAnswers);
								} else {
									localStorage.clear();
								}
								if(!localStorage.score) {
									localStorage.score = angular.toJson({startTime: new Date});
								}
								localStorage.quiz_id = angular.toJson($scope.quiz_id);
								$scope.interval = setInterval(function() {
									localStorage.myAnswers = angular.toJson($scope.questions);
								}, 5000);

							},
							stop: function() {
								$scope.submitAnswers();
							}
						}
					});
					if((Date.parse($scope.quiz.date_time)+($scope.quiz.duration*60*1000)) < new Date()) {
						if(localStorage.score) {
							$scope.score = angular.fromJson(localStorage.score);
						} else {
							$scope.score = { startTime: new Date }
						}
						clock2.setTime(Math.floor(($scope.quiz.duration*60) - ((new Date()/1000) - (Date.parse($scope.score.startTime)/1000))));
					} else {
						clock2.setTime(Math.floor(($scope.quiz.duration*60) - ((new Date()/1000) - (Date.parse($scope.quiz.date_time)/1000))));
					}
					clock2.start();
				});
			}

			$scope.quiz = Quiz.get({id: $scope.quiz_id}, function(){
				var date_time = Date.parse($scope.quiz.date_time) - new Date();
				if(date_time < 0) {
					clock2StopCallback();
				} else {
					var clock = $('.flip-clock').FlipClock({
						clockFace: "DailyCounter",
						autoStart: false,
						countdown: true,
						callbacks: {
							stop: clock2StopCallback
						}
					});
					clock.setTime(date_time/1000);
					clock.start();
				}
			});
			$scope.next = function() {
				$scope.pageNo++;
			}
			$scope.submitAnswers = function() {
				clearInterval($scope.interval);
				localStorage.myAnswers = angular.toJson($scope.questions);
				$scope.score = angular.fromJson(localStorage.score);
				$scope.score.endTime = new Date;
				localStorage.score = angular.toJson($scope.score);
				if((Date.parse($scope.quiz.date_time)+($scope.quiz.duration*60*1000)) < new Date()) {
					$location.path('/result/'+$scope.quiz_id);
					return;
				}
				for(var i=0; i<$scope.questions.length; i++) {
					if($scope.questions[i].answer) {
						$scope.answers.push({
							question_id : $scope.questions[i].id,
							option_id : $scope.questions[i].answer
						});
					}
				}
			   	Answer.save({quiz_id:$scope.quiz_id}, $scope.answers, function(res){
					$scope.answers = [];
					if(res[0] == 'e') {
						$location.path('/result/'+$scope.quiz_id);
					} else {
						$location.path('/stats/'+$scope.quiz_id);
					}
			   	});
			}
		}
	])


	/* Stat Controllers */
	.controller('StatsController', ['$scope', 'Student',
		function($scope, Student){
			$scope.quizzes = Student.quizzes({id: $scope.student_id});
		}
	])

	.controller('StatController', ['$scope', '$routeParams', 'Student', 'Answer',
		function($scope, $routeParams, Student, Answer){
			$scope.quiz_id = $routeParams.id
			$scope.questions = Answer.query({quiz_id: $scope.quiz_id});
			$scope.score     = Student.score({quiz_id: $scope.quiz_id, student_id: $scope.student_id});
		}
	])

	.controller('ResultController', ['$scope', '$routeParams', '$location', 'Answer',
		function($scope, $routeParams, $location, Answer){
			if(!localStorage.myAnswers || !localStorage.score || !localStorage.quiz_id) {
				$location.path('/').replace();
				return;
			}
			$scope.quiz_id = $routeParams.id
			$scope.questions = angular.fromJson(localStorage.myAnswers);

			$scope.score = angular.fromJson(localStorage.score);
			$scope.score.time = (Date.parse($scope.score.endTime) - Date.parse($scope.score.startTime))/1000;

			$scope.correctAnswers = Answer.correctAnswers({quiz_id: $scope.quiz_id}, function() {
				$scope.score.score = 0;
				for(var i = 0; i < $scope.questions.length; i++) {
					for(var j = 0; j < $scope.questions[i].options.length; j++) {
						if($scope.questions[i].answer == $scope.questions[i].options[j].id)
							$scope.questions[i].answer = $scope.questions[i].options[j].option;
					}
					$scope.questions[i].correct_answer = $scope.correctAnswers[i].option;
					if($scope.questions[i].answer == $scope.questions[i].correct_answer) $scope.score.score++;
				}
			});

			localStorage.clear();
		}
	])


	// Settings Controller
	.controller('SettingsController', ['$scope', 'Student', 'User',
		function($scope, Student, User){
			$scope.user = Student.get({id: $scope.student_id});

			$scope.update = function() {
				$scope.errors   = undefined;
				$scope.successi = undefined;
				$scope.successp = undefined;
				$scope.user.$update(
					function(res) { $scope.success = true;     },
					function(err) { $scope.errors  = err.data; }
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