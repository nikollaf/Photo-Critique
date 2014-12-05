<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row">
    <div class="large-9 columns">
      <div class="text-center curvy">

    	<h1 class="main-city">Life in {{ mainCityName.city }}</h1>
          <ul class="city-detail">
              <li><span class="glyphicon glyphicon-user"></span>Members {{mainCityName.members | shortenedNumAsInt}}</li>
              <li><span class="glyphicon glyphicon-heart"></span>Likes {{mainCityName.points | shortenedNumAsInt}}</li>
              <li><span class="glyphicon glyphicon-star"></span>Highlights  {{mainCityName.highlights | shortenedNumAsInt}}</li>
              <li><span class="glyphicon glyphicon-upload"></span>Uploads {{mainCityName.uploads | shortenedNumAsInt}}</li>
          </ul>

      </div>
    </div>
    <div class="large-3 columns">

    </div>
</div>



<div class="row">
    <div class="large-9 columns">
        <div class="row">

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
                                <span class="glyphicon glyphicon-plus-sign"></span> Categories
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
                                <span class="glyphicon glyphicon-plus-sign"></span> Vibes
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
        <div>
             <ul class="city small-block-grid-1 medium-block-grid-2 large-block-grid-3">

                <li class="scale-fade" ng-class="animation"  ng-repeat="img in mainCityName.images | orderBy:predicate:true | filter:search">
                  <a ng-href="#/image/{{img.image_id}}">
                    <img class="image" ng-src="http://res.cloudinary.com/world-lens/image/upload/w_640,h_640,c_fill/v1387844193/{{img.image_url}}.jpg">
                  </a>
                    <div class="text-center vote">
                        <a ng-href="#/user/{{img.id}}">{{img.first_name}} {{img.last_name}}</a>
                        <div ng-if="(img.image_id == img.liked_image)" class="liked to-like">
                            <span class="glyphicon glyphicon-heart"></span> {{img.img_points | number}}
                        </div>

                        <div  ng-if="(img.image_id == img.feature_image_id)" class="highlighted to-highlight">
                            <span class="glyphicon glyphicon-star"></span> {{img.h_points | number }}
                        </div>

                        <button ng-show="!img.liked_image" class="to-like not-clicked-like" ng-click="vote(img.image_l_id, img.image_id, $event)"  ng-disabled="isDisabledLike">
                            <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}
                        </button>

                        <button ng-show="!img.feature_image_id" class="to-highlight not-clicked-highlight" ng-click="highlight(img.image_id, img.id, $event)" ng-disabled="isDisabledHighlight">
                            <span class="glyphicon glyphicon-star"></span> {{img.h_points | number }}
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="large-3 columns">
        <div data-magellan-expedition="fixed">
        <div class="nearby curvy">
            <h3>{{mainCityName.cont}}</h3>
            <ul class="cities">

                <li ng-repeat="near in mainCityName.near"><a ng-href="#/city/{{near.l_id}}">{{near.city}}</a>
                    <span class="city-points pad-right">{{near.points | shortenedNumAsInt}}</span>
                </li>
            </ul>
        </div>
            </div>
    </div>
 </div>
<script>
    $(document).foundation();
</script>

