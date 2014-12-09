<?php
require '../core/session.php';

if (empty($_SESSION['id'])) {
    header('/');
    exit();
}
?>
<div class="row">



    <div class="medium-9 large-7 large-centered medium-centered columns">

        <h4>{{mainImage.caption}} <span><a ng-href="#/user/{{mainImage.user_id}}">{{mainImage.user_name}}</a></span></h4>

        <img class="main-image img-responsive" ng-src="{{main_image}}">
        
        <!-- <p class="right image-vote">
            <span class="glyphicon glyphicon-heart"></span> {{mainImage.highlights | shortenedNumAsInt}}
            <span class="glyphicon glyphicon-star"></span> {{mainImage.points | shortenedNumAsInt}}
        </p> -->

        <div style="clear: both;"></div>

        <form ng-submit="vote(exposure, focus, creativity, lighting, story)" id="rate" class="row">
                
                <div class="medium-2 large-2 columns">
                    <h4>Exposure</h4>
                    <div id="exposure"></div>
                    <p id="exposure-p"></p>
                    <input ng-value="exposure" id="exposure-rating" type="hidden">
                </div>

                <div class="medium-2 large-2 columns">
                    <h4>Focus</h4>
                    <div id="focus"></div>
                    <input ng-model="focus" id="focus-rating" type="hidden">
                </div>

                  <div class="medium-2 large-2 columns">

                    <h4>Lighting</h4>
                    <div id="lighting"></div>
                    <input ng-model="lighting" id="lighting-rating" type="hidden">

                </div>

                <div class="medium-2 large-2 columns">
                    <h4>Creativity</h4>
                    <div id="creativity"></div>
                    <input ng-model="creativity" id="creativity-rating" type="hidden">
                </div>

                <div class="medium-2 large-2 columns" style='float: left;'>
                    <h4>Story</h4>
                    <div id="story"></div>
                    <input ng-model="story" id="story-rating" type="hidden">
                </div>

                <div style="clear: both;"></div>

                <h5 id="total-rate"></h5>
                <button class="btn vote-btn" type="submit">Vote!</button>
                
            
        </form>

    </div>

    
</div>
<div class="row">
    <!-- COMMENTS -->
    <div class="medium-5 large-5 large-push-3 medium-push-3 columns feed">
        

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


    <!-- MORE IMAGES -->
    <div class="large-3 medium-12 columns curvy image-pad">
        <div class="row">
            <div class="no-margin row">
                <div class="more-pics">

                        <h5>More From <a href="#/user/{{mainImage.user_id}}">{{mainImage.user_name}}</a></h5>
                        <ul class="small-block-grid-4 medium-block-grid-2 large-block-grid-2">
                            <li ng-repeat="img in mainImage.user_image | limitTo: 4">
                                <a ng-href="#/image/{{img.image_id}}">
                                    <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_100,h_100,c_fill/v1387844193/{{img.image_url}}.jpg">
                                </a>

                            </li>
                        </ul>
                </div>
              
            </div>
            <div class="no-margin row">
                <div class="more-pics">
                    <div class="clearfix"></div>

                    <h5>More {{mainImage.category}}</h5>
                    <ul class="small-block-grid-4 medium-block-grid-2 large-block-grid-2">
                        <li ng-repeat="img in mainImage.categories | limitTo: 4">
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