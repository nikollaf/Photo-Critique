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


