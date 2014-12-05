<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row">
    <div class="large-6 medium-9 large-centered medium-centered columns">
        <h1 class="text-center">{{randcat}}</h1>
        <div style="position: absolute; left: 50%; top: 50%">
            <div style="position: relative; left: -50%;">
                <button class="btn" ng-click="reorder()"><span class="glyphicon glyphicon-refresh"></span></button>
            </div>
        </div>


        <ul class="pad-left-game small-block-grid-2 medium-block-grid-2 large-block-grid-2 large-centered">
            <li class="game-pad" ng-repeat="img in images | filter:{categories: randcat, city: randcity} | limitTo: 4">
                <a ng-href="#/image/{{img.image_id}}">
                    <img class="media-object img-width image{{$index}}" ng-src="http://res.cloudinary.com/world-lens/image/upload/w_240,h_240,c_fill/v1387844193/{{img.image_url}}.jpg">
                </a>
                <div class="text-center vote">


                    <button ng-if="(img.image_id == img.liked_image)" ng-show="img.isLiked" class="button to-like not-clicked-like" ng-click="vote(img.image_l_id, img.image_id, img, 'img.isLiked')">
                        <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}</button>


                    <button ng-if="(img.image_id == img.liked_image)" ng-show="!img.isLiked" class="button liked to-like" ng-click="vote(img.image_l_id, img.image_id, img, '!img.isLiked')">
                        <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}
                    </button>

                    <button ng-if="(img.image_id == img.feature_image_id)" ng-show="img.isHigh" class="button to-highlight not-clicked-highlight" ng-click="highlight(img.id, img.image_id, img, 'img.isHigh')">
                        <span class="glyphicon glyphicon-star"></span> {{img.h_points | number }}
                    </button>

                    <button ng-if="(img.image_id == img.feature_image_id)" ng-show="!img.isHigh" class="button highlighted to-highlight" ng-click="highlight(img.id, img.image_id, img, '!img.isHigh')">
                        <span class="glyphicon glyphicon-star"></span> {{img.h_points | number }}
                    </button>


                    <button ng-if="!img.liked_image" ng-show="!img.isLiked" class="button to-like not-clicked-like" ng-click="vote(img.image_l_id, img.image_id, img, 'img.isLiked')">
                        <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}
                    </button>
                    <button ng-if="!img.liked_image" ng-show="img.isLiked" class="button liked to-like" ng-click="vote(img.image_l_id, img.image_id, img, '!img.isLiked')">
                        <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}</button>


                    <button ng-if="!img.feature_image_id" ng-show="!img.isHigh" class="button to-highlight not-clicked-highlight" ng-click="highlight(img.id, img.image_id, img, 'img.isHigh')">
                        <span class="glyphicon glyphicon-star"></span> {{img.h_points | number }}
                    </button>

                    <button ng-if="!img.feature_image_id" ng-show="img.isHigh" class="button highlighted to-highlight" ng-click="highlight(img.id, img.image_id, img, '!img.isHigh')">
                        <span class="glyphicon glyphicon-star"></span> {{img.h_points | number }}
                    </button>

                </div>
            </li>
        </ul>

    </div>
</div>