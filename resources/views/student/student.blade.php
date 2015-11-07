@extends('master')

@section('main')
    <div ng-app="quizapp-student" ng-controller="MainController" class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <div class="mdl-layout-spacer"></div>
                <!-- Right aligned menu below button -->
                <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
                    <i class="material-icons">more_vert</i>
                </button>

                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
                    <a href="#/settings"><li class="mdl-menu__item">Settings</li></a>
                    <a href="#/about"><li class="mdl-menu__item">About</li></a>
                    <a href="/auth/logout"><li class="mdl-menu__item">Logout</li></a>
                </ul>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <span class="mdl-layout-title logo"><a href="/">quiZapp</a></span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="#/"><i class="material-icons">dashboard</i> <span class="text">Dashboard</span></a>
                <a class="mdl-navigation__link" href="#/quizzes"><i class="material-icons">done_all</i> <span class="text">Quizzes</span></a>
                <a class="mdl-navigation__link" href="#/stats"><i class="material-icons">trending_up</i> <span class="text">Stats</span></a>
                <a class="mdl-navigation__link" href="#/about"><i class="material-icons">info</i> <span class="text">About</span></a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <div class="page-content">
                <div ng-view></div>
            </div>
        </main>
        <input type="hidden" ng-init="student_id = {{Auth::user()->student()->first()->id}}">
    </div>
@endsection

@section('scripts')
    <script src='js/student.js'></script>
    <script src='js/templates.js'></script>
@endsection