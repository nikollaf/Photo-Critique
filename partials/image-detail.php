<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row">
    <div class="image-author">
        <a ng-href="#/user/{{mainImage.user_id}}">{{mainImage.user_name}}</a> in <a ng-href="#/city/{{mainImage.l_id}}">{{mainImage.city}}</a>
    </div>

    <div class="medium-3 large-23 columns feed">
        <p class="text-center">"{{mainImage.caption}}"</p>
        <form ng-submit="submit(comment)">
            <h6 id="counter">{{150 - comment.length}} characters remaining</h6>
            <textarea ng-model="comment" class="form-control counted" name="message" placeholder="Type in your message"
                      rows="4" style="margin-bottom:10px;"></textarea>

            <button class="comment-btn btn" type="submit">Post New Message</button>
        </form>
        <div class="image-feed">
            <div ng-repeat="feed in mainImage.feed | orderBy: '-created'">

                <p ng-show="feed.liked_image">
                    <a ng-href="#/user/{{feed.id}}">{{feed.first_name}}</a> liked this image.
                </p>

                <p ng-show="feed.comment">
                    <a ng-href="#/user/{{feed.id}}">{{feed.first_name}}</a>: {{feed.comment}}
                </p>
                <p ng-show="feed.feature_image_id">
                    <a ng-href="#/user/{{feed.id}}">{{feed.first_name}}</a> highlighted this image.
                </p>
            </div>
        </div>

    </div>
    <div class="medium-7 large-5 columns">

        <img class="main-image img-responsive" ng-src="{{main_image}}">
        <p class="left">
            {{mainImage.category }} |
            {{mainImage.vibe }}
        </p>
        <p class="right image-vote">
            <span class="glyphicon glyphicon-heart"></span> {{mainImage.highlights | shortenedNumAsInt}}
            <span class="glyphicon glyphicon-star"></span> {{mainImage.points | shortenedNumAsInt}}
        </p>
    </div>

    <div class="large-4 medium-12 columns curvy image-pad">
        <div class="row">
            <div class="no-margin row">
                <div class="medium-4 large-6 columns more-pics">

                        <h5>More From <a href="#/user/{{mainImage.user_id}}">{{mainImage.user_name}}</a></h5>
                        <ul class="small-block-grid-4 medium-block-grid-2 large-block-grid-2">
                            <li class="padles" ng-repeat="img in mainImage.user_image | limitTo: 4">
                                <a ng-href="#/image/{{img.image_id}}">
                                    <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_100,h_100,c_fill/v1387844193/{{img.image_url}}.jpg">
                                </a>

                            </li>
                        </ul>
                </div>
                <div class="medium-4 large-6 columns more-pics">
                    <div class="clearfix"></div>

                        <h5>More From <a href="#/city/{{mainImage.l_id}}">{{mainImage.city}}</a></h5>
                        <ul class="small-block-grid-4 medium-block-grid-2 large-block-grid-2">
                            <li class="padles" ng-repeat="img in mainImage.city_image | limitTo: 4">
                                <a ng-href="#/image/{{img.image_id}}">
                                    <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_100,h_100,c_fill/v1387844193/{{img.image_url}}.jpg">
                                </a>

                            </li>
                        </ul>

                </div>
            </div>
            <div class="no-margin row">
                <div class="medium-4 large-6 columns more-pics">
                    <div class="clearfix"></div>

                    <h5>More {{mainImage.category}}</h5>
                    <ul class="small-block-grid-4 medium-block-grid-2 large-block-grid-2">
                        <li class="padles" ng-repeat="img in mainImage.categories | limitTo: 4">
                            <a ng-href="#/image/{{img.image_id}}">
                                <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_100,h_100,c_fill/v1387844193/{{img.image_url}}.jpg">
                            </a>

                        </li>
                    </ul>

                </div>
                <div class="medium-4 large-6 columns more-pics">
                    <div class="clearfix"></div>

                    <h5>More {{mainImage.vibe}}</h5>
                    <ul class="small-block-grid-4 medium-block-grid-2 large-block-grid-2">
                        <li class="padles" ng-repeat="img in mainImage.vibes | limitTo: 4">
                            <a ng-href="#/image/{{img.image_id}}">
                                <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_100,h_100,c_fill/v1387844193/{{img.image_url}}.jpg">
                            </a>

                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.large-23').perfectScrollbar({
            useBothWheelAxes: false
        });
    });
</script>
<!--

            <div class="panel panel-default">
                <div class="panel-body">
                    <form accept-charset="UTF-8" action="" method="POST">
                        <textarea ng-model="comment" class="form-control counted" name="message" placeholder="Type in your message"
                                  rows="5" style="margin-bottom:10px;"></textarea>
                        <h6 class="pull-right" id="counter">{{150 - comment.length}} characters remaining</h6>
                        <button class="btn btn-info" type="submit">Post New Message</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="medium-3 pull-left-1 columns">

        </div>
    </div>
</div>
-->