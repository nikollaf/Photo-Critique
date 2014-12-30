<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/auth/login.php');
    exit();
}
?>
<div class="row">
    
    
    <div class="large-12 medium-12 small-12 columns">
        <div class="row">
            <h1 class="world-feed-title">Feed</h1>

            <div data-magellan-expedition="fixed" data-options="destination_threshold:65;throttle_delay:0;">
                <div class="small-12 medium-7 large-4 columns filter-nav">


                <ul class="filter">
                    <li class="dropdown">
                        <a class="btn btn-default btn-lg dropdown-toggle">
                            Sort <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" ng-click="orderProp = 'created'">Newest</a>
                                <a href="" ng-click="orderProp = '-created'">Oldest</a>
                                <a href="" ng-click="orderProp = 'img_points'">Most Liked</a>
                                <a href="" ng-click="orderProp = 'h_points'">Most Featured</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="btn btn-default btn-lg dropdown-toggle">
                            <span class="glyphicon glyphicon-plus"></span> Categories
                        </a>
                        <ul class="dropdown-menu cols-menu">
                            <li>
                               <a href="" ng-click="search.categories = ''"> All</a>
                               <a href="" ng-click="search.categories = 'Street'">Street<</a>
                               <a href="" ng-click="search.categories = 'Architecture'">Architecture<</a>
                               <a href="" ng-click="search.categories = 'Landscape'">Landscape<</a>
                               <a href="" ng-click="search.categories = 'Sports'">Sports<</a>
                               <a href="" ng-click="search.categories = 'Wildlife'">Wildlife<</a>
                               <a href="" ng-click="search.categories = 'Nature'">Nature<</a>
                               <a href="" ng-click="search.categories = 'Aerial'">Aerial<</a>
                               <a href="" ng-click="search.categories = 'People'">People<</a>
                               <a href="" ng-click="search.categories = 'Portrait'">Portrait<</a>
                               <a href="" ng-click="search.categories = 'Macro'">Macro<</a>
                               <a href="" ng-click="search.categories = 'Other'">Other<</a>
                            </li>
                        </ul>
                    </li>

                
                  </ul>
               </div>
            </div>
        </div>



        <div class="row">


            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-5">

                    <li class="scale-fade" ng-class="animation"  ng-repeat="img in world | orderBy:orderProp:true | filter:search | limitTo: totalDisplayed">
                        <a ng-href="#/image/{{img.image_id}}">
                            <img class="full-image image" ng-src="http://res.cloudinary.com/world-lens/image/upload/w_640,h_640,c_fill/v1387844193/{{img.image_url}}.jpg">
                        </a>
                        <div class="text-center vote">


                            <button ng-if="(img.image_id == img.liked_image)" ng-show="img.isLiked" class="button to-like not-clicked-like" ng-click="vote(img.image_l_id, img.image_id, img, 'img.isLiked')">
                                <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}</button>


                            <button ng-if="(img.image_id == img.liked_image)" ng-show="!img.isLiked" class="button liked to-like" ng-click="vote(img.image_l_id, img.image_id, img, '!img.isLiked')">
                                <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}
                            </button>

                         


                            <button ng-if="!img.liked_image" ng-show="!img.isLiked" class="button to-like not-clicked-like" ng-click="vote(img.image_l_id, img.image_id, img, 'img.isLiked')">
                                <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}
                            </button>
                            <button ng-if="!img.liked_image" ng-show="img.isLiked" class="button liked to-like" ng-click="vote(img.image_l_id, img.image_id, img, '!img.isLiked')">
                                <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}</button>


                           

                          

                        </div>
                    </li>

            </ul>

        </div>
    </div>
</div>
<script>
    $(document).foundation();
</script>