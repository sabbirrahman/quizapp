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
			.when('/about', 			{ templateUrl: 'templates/about.html', controller: 'MainController'     })
			.otherwise( { redirectTo: '/'});
        mdlConfigProvider.floating = false;
	}])

	// Resource Services
	.factory("Quiz", ["$resource", function($resource) {
  		return $resource("api/student/quizzes/:id", {id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" }
  		});
	}])
	
	.factory("Question", ["$resource", function($resource) {
  		return $resource("api/student/quizzes/:quiz_id/questions/:id", {quiz_id:'@quiz_id', id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" }
  		});
	}])
	
	.factory("Option", ["$resource", function($resource) {
  		return $resource("api/student/questions/:question_id/options/:id", {question_id:'@question_id', id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" }
  		});
	}])
	
	.factory("Student", ["$resource", function($resource) {
  		return $resource("api/student/students/:id", {id:'@id'}, {
  			//query: { isArray: false },
  			update: { method : "PUT" }
  		});
	}])

	.controller('MainController', ['$scope', function($scope){

	}])


	/* Quiz Controllers */
	.controller('QuizzesController', ['$scope', '$http', 'Quiz',
		function($scope, $http, Quiz){
			$scope.quizzes = Quiz.query();
			$scope.participate = function(index) {
				$http.get('api/student/participate/'+$scope.quizzes[index].id)
					.success(function(res){
						$scope.quizzes[index].participated = parseInt(res);
					});
			}
		}
	])


	/* Question Controllers */
	.controller('QuestionsController', ['$scope', '$routeParams', '$http', '$timeout', 'Quiz', 'Question',
		function($scope, $routeParams, $http, $timeout, Quiz, Question){
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
							stop: function() {
								$scope.submitAnswers();
							}
						}
					});
					clock2.setTime($scope.quiz.duration*60);
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
				for(var i=0; i<$scope.questions.length; i++) {
					if($scope.questions[i].answer) {
						$scope.answers.push({
							question_id : $scope.questions[i].id,
							option_id : $scope.questions[i].answer
						});
					}
				}
			   	$http.post('api/student/answers', $scope.answers)
					.success(function(){
						$scope.answers = [];
					});
			}
		}
	])


	/* Stat Controllers */
	.controller('StatsController', ['$scope', '$http', 'Quiz',
		function($scope, $http, Quiz){
			$http.get('api/student/myquizzes')
				.success(function(res){
					$scope.quizzes = res;
				})
		}
	])

	.controller('StatController', ['$scope', '$routeParams', '$http', 'Quiz',
		function($scope, $routeParams, $http, Quiz){
			$scope.quiz_id = $routeParams.id
			$http.get('api/student/answers/'+$scope.quiz_id)
				.success(function(res){
					$scope.questions = res;
				});
			$http.get('api/student/score/'+$scope.quiz_id)
				.success(function(res){
					$scope.score = res;
				})
		}
	])
	
	.filter("asDate", function () {
    	return function(input) {
        	return Date.parse(input);;
    	}
	})
	.filter("hourminute", function () {
    	return function(input) {
    		var h = Math.floor(input/60);
    		var m = input%60;
    		var output = "";
    		output += h ? h+' h' : '';
    		output += h&&m ? ' ' : '';
    		output += m ? m+' m' : '';
        	return output;
    	}
	});