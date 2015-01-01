<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row">
    <div class="large-6 medium-9 large-centered medium-centered columns">
        <h2 class="text-center">May the best picture win.</h2>
        <!-- <h2 class="text-center">{{randcat}}</h2> -->
        <!-- <div style="position: absolute; left: 50%; top: 50%">
            <div style="position: relative; left: -50%;">
                <button class="btn"><span class="glyphicon glyphicon-refresh"></span></button>
            </div>
        </div> -->


        <ul class="pad-left-game small-block-grid-2 medium-block-grid-2 large-block-grid-2 large-centered">
            <li class="game-pad" ng-repeat="img in images | filter:{categories: randcat} | limitTo: 4">
                <div ng-if="!img.liked_image" ng-click="reorder(img.image_l_id, img.image_id, img, 'img.isLiked')">
                    <img class="media-object img-width image{{$index}}" ng-src="http://res.cloudinary.com/world-lens/image/upload/w_240,h_240,c_fill/v1387844193/{{img.image_url}}.jpg">
                </div>

                

                <div class="text-center vote">
                <br>
                    <!-- <button class="btn"> {{img.img_points | number}}</button> -->
                </div>
            </li>
        </ul>


    </div>
</div>