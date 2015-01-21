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

        <form ng-submit="vote()" id="rate" class="row">
            <ul> 
                <li>
                    <h4>Exposure</h4>
                    <div id="exposure"></div>
                    <p id="exposure-p"></p>
                    <input ng-value="exposure" id="exposure-rating" type="hidden">
                </li>
                <li>
                    <h4>Focus</h4>
                    <div id="focus"></div>
                    <input ng-model="focus" id="focus-rating" type="hidden">
                </li>
                <li>
                    <h4>Lighting</h4>
                    <div id="lighting"></div>
                    <input ng-model="lighting" id="lighting-rating" type="hidden">
                </li>
                <li>
                    <h4>Story</h4>
                    <div id="story"></div>
                    <input ng-model="story" id="story-rating" type="hidden">
                </li>
                 <li>
                    <h4>Creativity</h4>
                    <div id="creativity"></div>
                    <input ng-model="creativity" id="creativity-rating" type="hidden">
                </li>
            </ul>

                <div style="clear: both;"></div>

                <h5 id="total-rate"></h5>
                <button class="btn vote-btn" type="submit">Vote!</button>

                
            
        </form>

    </div>

    
</div>
<div class="row">
    <!-- COMMENTS -->
    <div class="medium-8 large-6 large-push-2 medium-push-1 columns feed">
        

        <form ng-submit="submit(comment)">
            <h6 id="counter">{{400 - comment.length}} characters remaining</h6>
            <textarea ng-model="comment" ng-maxlength="400" class="form-control counted" name="message" placeholder="Type in your message"
                      rows="6" style="margin-bottom:10px;"></textarea>

            <button class="comment-btn btn" type="submit">Post New Message</button>
        </form>

        <div class="image-feed">
            <div ng-repeat="feed in mainImage.feed | orderBy: '-votes'" class="row">


                <p ng-show="feed.comment">
                    <!-- messages (upvote) -->
                    <div class="large-1 medium-1 small-2 columns">
                        <div ng-if="(feed.com_img_id == feed.cv_img_id)">
                            <button ng-click="changeVote(feed.com_img_id, feed.id, vote, 'none')" g-class="{true:'up', false:''}[vote=='up']" class="btn">{{feed.votes}}</button>
                        </div>

                        <div ng-if="(feed.com_img_id != feed.cv_img_id)">
                            <button ng-click="changeVote(feed.com_img_id, feed.id, vote, 'up')" g-class="{true:'', false:''}[vote=='up']" class="btn">{{feed.votes}}</button>
                        </div>
                    </div>
                    <div class="large-7 medium-7 small-7 columns">
                        <h4><a ng-href="#/user/{{feed.id}}">{{feed.first_name}}</a></h4>
                        <p>{{feed.comment}}</p>
                    </div>
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
                                    <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_125,h_125,c_fill/v1387844193/{{img.image_url}}.jpg">
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
                                <img ng-src="http://res.cloudinary.com/world-lens/image/upload/w_125,h_125,c_fill/v1387844193/{{img.image_url}}.jpg">
                            </a>

                        </li>
                    </ul>

                </div>
             
            </div>
        </div>
    </div>
</div>

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