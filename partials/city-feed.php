<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row">
    <h1></h1>
    <div class="large-21 medium-12 small-12 columns curvy curvy-color">

        <div class="large-12 medium-6 small-6 columns">
            <div class="move_left first-rank">
                <h4 class="text-center">Most Popular <span class="glyphicon glyphicon-heart"></span></h4>
                <div class="rank">
                    <ul class="cities">
                        <li ng-repeat="city in cities | filter:query | orderBy:'-points' | limitTo:5">

                            <a class="city-up" ng-href="#/city/{{ city.l_id }}">{{ city.city }}</a>
                            <span class="city-points">{{city.points | number}}</span>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <div class="large-12 medium-6 small-6 columns">
            <div class="move_left">
                <h4 class="text-center">Most Uploads <span class="glyphicon glyphicon-upload"></span></h4>
                <div class="rank">
                    <ul class="cities">
                        <li ng-repeat="city in cities | filter:query | orderBy:'-uploads' | limitTo:5">

                            <a class="city-up" ng-href="#/city/{{ city.l_id }}">{{ city.city }}</a>
                            <span class="city-points">{{city.uploads | number}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="large-12 medium-6 small-6 columns">
            <div class="move_left">
                <h4 class="text-center">Most Highlights <span class="glyphicon glyphicon-star"></span></h4>
                <div class="rank">
                    <ul class="cities">
                        <li ng-repeat="city in cities | filter:query | orderBy:'-highlights' | limitTo:5">

                            <a class="city-up" ng-href="#/city/{{ city.l_id }}">{{ city.city }}</a>
                            <span class="city-points">{{city.highlights | number}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="large-9 columns">
        <div class="" ng-controller="FeedCtrl">

            <div ng-repeat="key in feed">
                <div class="move-down">
                    <a ng-href="#/user/{{key.id}}">
                        <img alt="25%x180" class="user-pic"
                             ng-src="http://res.cloudinary.com/world-lens/image/upload/w_32,h_32,c_fill/v1387844193/{{key.profile_pic}}.jpg"></a>
                    <a ng-href="#/user/{{key.id}}" class="user-feed">{{ key.first_name }} {{ key.last_name }}</a> uploaded  for <a href="#/city/{{ key.l_id}}">{{ key.city }}, {{key.state}} {{ key.country }}</a>
                </div>
                <div ng-controller="FeedImage" ng-init="init(key.gallery_id)">

                    <ul class="small-block-grid-2 medium-block-grid-5 large-block-grid-8">
                        <li class="padles" ng-repeat="img in images | unique:'image_url'">
                            <a ng-href="#/image/{{img.image_id}}">
                                <img class="small-user-feed" alt="25%x180" style="margin-top: 10px;"
                                     ng-src="http://res.cloudinary.com/world-lens/image/upload/w_250,h_250,c_fill/v1387844193/{{img.image_url}}.jpg">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


