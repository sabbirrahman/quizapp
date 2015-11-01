var atu = 'templates/admin/';
angular
	.module('quizapp-admin', ['ngRoute'])

	.config(['$routeProvider', function($routeProvider){
		$routeProvider
			.when('/',            { templateUrl: atu+'dashboard.html', controller: 'MainController' })
			.when('/quizzes',     { templateUrl: atu+'quizzes.html',   controller: 'MainController' })
			.when('/quizzes/:id', { templateUrl: atu+'quiz.html',      controller: 'MainController' })
			.when('/students',    { templateUrl: atu+'students.html',  controller: 'MainController' })
			.when('/students/:id',{ templateUrl: atu+'student.html',   controller: 'MainController' })
			.when('/stats',       { templateUrl: atu+'stats.html',     controller: 'MainController' })
			.when('/about',       { templateUrl: atu+'about.html',     controller: 'MainController' })
			.otherwise( { redirectTo: '/'});
	}])

	.controller('MainController', ['$scope', function(){

	}]);