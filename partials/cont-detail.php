
<div class="row cont">
    
    <div class="medium-2 columns side-cont">
        <h4>Ranking</h4>

            <ul class="cities">
                <li ng-repeat="city in cities">
                    <span class="city-points">{{city.points | shortenedNumAsInt}}</span>
                    <a ng-href="auth/login.php">{{ city.city }}</a>
                </li>
            </ul>
    </div>
    <div class="large-7 columns pull-2">
        <h3 class="cont-title">{{mainImage.city}}, {{mainImage.state}} {{mainImage.country}}</h3>
        <h4 class="cont-points">{{mainImage.img_points | number}} <span class="glyphicon glyphicon-heart"></span></h4>
        <img ng-src="{{main_image}}">
        <p>
            by {{mainImage.first_name}} {{mainImage.last_name}}
        </p>
    </div>


