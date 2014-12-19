<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row">
    <h1>&nbsp;</h1>
    <div class="large-9 large-offset-1 medium-11 small-11">
        <ul class="cities">
            <li class="full-list" ng-repeat="image in list">
                <div class="row">
                    <div class="city-rank-num large-1 medium-1 small-3 columns">
                    {{$index + 1}}
                    </div>
                    <div class="large-2 medium-2 small-6 columns">

                            <a href="#/image/{{image.image_id}}">
                                <img class="full-image" ng-src="http://res.cloudinary.com/world-lens/image/upload/w_105,h_105,c_fill/v1387844193/{{image.image_url}}.jpg">
                            </a>

                    </div>
                    <div class="large-7 medium-7 small-12 columns">
                        <div class="row city-ranks">
                                <div class="large-2 medium-2 small-2">
                                    <h4 class="media-heading city-name"><a ng-href="#/city/{{image.image_id}}">{{image.first_name}}</a></h4>
                                </div>
                                <div class="large-3 medium-3 small-2 columns pad-left-none">
                                    <span class="city-rank-int">4.3</span>
                                            <h6 class="city-rank-name">Points</h6>
                                </div>
                                <div class="large-3 medium-3 small-2 columns">
                                            <span class="city-rank-int">.5</span>
                                            <h6 class="city-rank-name">Members</h6>
                                </div>
                                <div class="large-3 medium-3 columns">
                                    <span class="city-rank-int">.7</span>
                                    <h6 class="city-rank-name">Uploads</h6>
                                </div>
                                <div class="large-3 medium-3 columns">
                                    <span class="city-rank-int">3</span>
                                    <h6 class="city-rank-name">Highlights</h6>
                                </div>
                        </div>
                    </div>
                    <div class="large-1 medium-1 small-2 columns city-rank-arrow">
                        <a ng-href="#/city/{{image.image_id}}">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                 </div>

            </li>
        </ul>
    </div>
</div>