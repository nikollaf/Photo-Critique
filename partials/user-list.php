<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row list-page">
    <h1>Top Users</h1>
    <div class="large-9 large-offset-1 medium-11 small-11">
        <ul class="cities">
            <li class="full-list" ng-repeat="user in users | orderBy: '-points'">
                <div class="row">
                    <div class="city-rank-num large-1 medium-1 small-3 columns">
                    {{$index + 1}}
                    </div>
                    <div class="large-2 medium-2 small-6 columns">

                            <a href="#/image/{{user.id}}">
                                
                            </a>

                    </div>
                    <div class="large-7 medium-7 small-12 columns">
                        <div class="row city-ranks">
                                <div class="large-8 medium-8 small-2">
                                    <div class="media-heading city-name">
                                        <span class="img-caption"><a ng-href="#/user/{{user.id}}"></a></span>
                                        <span class="user-name"><a ng-href="#/user/{{user.id}}">{{user.first_name}}</a></span>
                                    </div>
                                </div>
                                <div class="large-3 medium-3 small-2 columns pad-left-none">
                                    <span class="city-rank-int">4.3</span>
                                            <h6 class="city-rank-name">Rating</h6>
                                </div>
                                <div class="large-3 medium-3 small-2 columns">
                                            <span class="city-rank-int">{{user.points}}</span>
                                            <h6 class="city-rank-name">Points</h6>
                                </div>
                                <div class="large-3 medium-3 columns end">
                                    
                                </div>
                               
                        </div>
                    </div>
                    <div class="large-1 medium-1 small-2 columns city-rank-arrow">
                        <a ng-href="#/user/{{user.id}}">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                 </div>

            </li>
        </ul>
    </div>
</div>