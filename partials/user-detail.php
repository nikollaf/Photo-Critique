
<div class="row">
       


        <div class="large-12 medium-12 columns">
            <div class="row">
                <h1 class="text-center">{{mainUserInfo.name}}</h1>
                 <div class="medium-3 medium-centered columns curvy mar-top">
                <div class="row">
                    <div class="medium-3 medium-centered columns profile-pic">
                        


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
                <div class="row">
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
                            Votes <br><span class="badge">23</span>
                        </li>

                    </ul>
                </div>


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
            <div class="row">
                <div data-magellan-expedition="fixed" data-options="destination_threshold:65;throttle_delay:0;">
                    <div class="small-12 medium-12 large-4 columns filter-nav">


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
                                      <a href="" ng-click="search.categories = 'Street'">Street</a>
                                      <a href="" ng-click="search.categories = 'Architecture'">Architecture<</a>
                                      <a href="" ng-click="search.categories = 'Landscape'">Landscape</a>
                                      <a href="" ng-click="search.categories = 'Sports'">Sports</a>
                                      <a href="" ng-click="search.categories = 'Wildlife'">Wildlife</a>
                                      <a href="" ng-click="search.categories = 'Nature'">Nature</a>
                                      <a href="" ng-click="search.categories = 'Aerial'">Aerial</a>
                                      <a href="" ng-click="search.categories = 'People'">People</a>
                                      <a href="" ng-click="search.categories = 'Portrait'">Portrait</a>
                                      <a href="" ng-click="search.categories = 'Macro'">Macro</a>
                                      <a href="" ng-click="search.categories = 'Other'">Other</a>
                                    </li>
                                </ul>
                            </li>

                          
                        </ul>
                    </div>
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

                        <button ng-if="!img.liked_image" ng-show="!img.isLiked" class="button to-like not-clicked-like" ng-click="vote(img.image_l_id, img.image_id, img, 'img.isLiked')">
                            <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}
                        </button>
                        <button ng-if="!img.liked_image" ng-show="img.isLiked" class="button liked to-like" ng-click="vote(img.image_l_id, img.image_id, img, '!img.isLiked')">
                            <span class="glyphicon glyphicon-heart "></span> {{img.img_points | number}}</button>
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