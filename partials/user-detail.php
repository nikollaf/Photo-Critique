
<div class="row">
        <div class="large-21 medium-3 columns curvy mar-top">
            <div class="row">
                <div class="medium-3 medium-centered columns profile-pic">
                    {{UserInfo.profile_pic}}
                    <img ng-src="{{user_pro_pic}}" alt="profile-pic">


                    <div class="connect" ng-show="user">
                        <a href="auth/profile.php" ng-class="connect">
                            <span class="glyphicon glyphicon-plus"></span> Edit
                        </a>
                    </div>

                    <div class="connect" ng-show="!mainUserInfo.active_follower && !user && !mainUserInfo.waiting_follower && !mainUserInfo.denied_follower">
                        <button ng-click="follow(mainUserInfo.id)" ng-class="connect" ng-disabled="isDisabled">
                            <span class="glyphicon glyphicon-plus"></span> {{ message }}
                        </button>
                    </div>
                    <div class="connect" ng-show="mainUserInfo.active_follower">
                        <button class="">
                            <span class="glyphicon glyphicon-ok"></span> Connected
                        </button>
                    </div>
                </div>

            </div>

            <div class="user-info">
                <p>{{mainUserInfo.info}}</p>
            </div>

            <ul class="fans">
                <li class="btn btn-fans bord" ng-click="showFollowers()">
                    
                    Follower <br><span class="badge">{{mainUserInfo.follower_users.length | number}}</span>
                </li>
                <li class="btn btn-fans bord" ng-click="showFollowing()">
                    
                    Following <br><span class="badge">{{ mainUserInfo.following_users.length | number}}</span>
                </li>
                <li class="btn btn-fans">
                    Highlights <br><span class="badge">23</span>
                </li>

            </ul>


<!--
            <div class="feature test text-center">
                <h4>Highlights <span class="glyphicon glyphicon-star-empty"></span></h4>
                <ul class="cities">
                    <li ng-repeat="img in mainUserInfo.featured">
                        <div class="text-center vote">{{img.first_name}} {{img.last_name}}</div>
                        <a ng-href="#/image/{{img.image_id}}">
                            <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_200,h_200,c_fill/v1387844193/{{img.image_url}}.jpg">
                        </a>

                    </li>
                </ul>
            </div>
-->
            <div>
                <script type="text/ng-template" id="myModalContent.html">
                    <div class="modal-header">
                        <h3>{{header}}</h3>
                    </div>
                    <div class="modal-body">
                        <ul>
                            <li ng-repeat="item in items">
                                <a>{{ item.first_name }}</a>
                            </li>
                        </ul>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
                    </div>
                </script>


            </div>

        </div>


        <div class="large-9 medium-9 columns">
            <div class="row">
                <h1>Life of {{mainUserInfo.name}}</h1>
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
    <div class="row">


             <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-5">
               
                <li class="scale-fade" ng-class="animation"  ng-repeat="img in mainUserInfo.images | orderBy:orderProp:true | filter:search">
                    <a ng-href="#/image/{{img.image_id}}">
                        <img class="user-images" ng-src="http://res.cloudinary.com/world-lens/image/upload/w_640,h_640,c_fill/v1387844193/{{img.image_url}}.jpg">
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
            <p ng-show="!mainUserInfo.images.length">You currently have no images</p>

    </div>
    </div>
</div>
<script>
    $(document).foundation();
</script>