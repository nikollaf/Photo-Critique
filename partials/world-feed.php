<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/auth/login.php');
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
                        <li ng-repeat="city in mainWorld.cities | filter:query | limitTo:5">

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
                        <li ng-repeat="city in mainWorld.cities | filter:query | orderBy:'-uploads' | limitTo:5">

                            <a class="city-up" ng-href="#/city/{{ city.l_id }}"> {{ city.city }}</a>
                            <span class="city-points">{{city.uploads | shortenedNumAsInt}}</span>
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
                        <li ng-repeat="city in mainWorld.cities | filter:query | orderBy:'-highlights' | limitTo:5">

                            <a class="city-up" ng-href="#/city/{{ city.l_id }}">{{ city.city }}</a>
                            <span class="city-points">{{city.highlights | shortenedNumAsInt}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="large-9 medium-12 small-12 columns">
        <div class="row">
            <h1 class="world-feed-title">World Feed <br>{{search.vibes}} {{search.categories}}</h1>
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
                                <a href="" ng-click="search.categories = 'People'"> People</a>
                                <a href="" ng-click="search.categories = 'Culture'"> Culture</a>

                                <a href="" ng-click="search.categories = 'Nature'"> Nature</a>
                                <a href="" ng-click="search.categories = 'Animals'"> Animals</a>
                                <a href="" ng-click="search.categories = 'Food'"> Food</a>
                                <a href="" ng-click="search.categories = 'Architecture'"> Architecture</a>
                                <a href="" ng-click="search.categories = 'Fashion'"> Fashion</a>
                                <a href="" ng-click="search.categories = 'Sports'"> Sports</a>
                                <a href="" ng-click="search.categories = 'Other'"> Other</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="btn btn-default btn-lg dropdown-toggle">
                            <span class="glyphicon glyphicon-plus"></span> Vibes
                        </a>
                        <ul class="dropdown-menu four-cols-menu">
                            <li>
                                <a href="" ng-click="search.vibes = ''"> All</a>
                                <a href="" ng-click="search.vibes = 'Happy'"> Happy</a>
                                <a href="" ng-click="search.vibes = 'Sad'"> Sad</a>
                                <a href="" ng-click="search.vibes = 'Beautiful'"> Beautiful</a>
                                <a href="" ng-click="search.vibes = 'Hot'"> Hot</a>
                                <a href="" ng-click="search.vibes = 'Cold'"> Cold</a>
                                <a href="" ng-click="search.vibes = 'Cute'"> Cute</a>
                                <a href="" ng-click="search.vibes = 'Ugly'"> Ugly</a>
                                <a href="" ng-click="search.vibes = 'Peace'"> Peace</a>
                                <a href="" ng-click="search.vibes = 'Noise'"> Noise</a>
                                <a href="" ng-click="search.vibes = 'Exciting'"> Exciting</a>
                                <a href="" ng-click="search.vibes = 'Dull'"> Dull</a>
                                <a href="" ng-click="search.vibes = 'Romantic'"> Romantic</a>
                                <a href="" ng-click="search.vibes = 'Heartbreaking'"> Heartbreaking</a>
                                <a href="" ng-click="search.vibes = 'Funny'"> Funny</a>
                                <a href="" ng-click="search.vibes = 'Serious'"> Serious</a>
                                <a href="" ng-click="search.vibes = 'Luxury'"> Luxury</a>
                                <a href="" ng-click="search.vibes = 'Simplicity'"> Simplicity</a>
                                <a href="" ng-click="search.vibes = 'Mysterious'"> Mysterious</a>
                                <a href="" ng-click="search.vibes = 'Other'"> Other</a>
                            </li>
                        </ul>
                    </li>
                  </ul>
               </div>
            </div>
        </div>



        <div class="row">


            <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-5">

                    <li class="scale-fade" ng-class="animation"  ng-repeat="img in world_images | orderBy:orderProp:true | filter:search | limitTo: totalDisplayed">
                        <a ng-href="#/image/{{img.image_id}}">
                            <img class="full-image image" ng-src="http://res.cloudinary.com/world-lens/image/upload/w_640,h_640,c_fill/v1387844193/{{img.image_url}}.jpg">
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
</div>
<script>
    $(document).foundation();
</script>