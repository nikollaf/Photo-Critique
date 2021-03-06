<?php
include 'core/init.php';

?>
<!doctype html>
<html lang="en" ng-app="worldlensApp">
<head>
  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Picritic</title>
     
  <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
  <meta name="copyright" content="WL, inc. Copyright (c) 2014" />
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="css/foundation.min.css">
  <link rel="stylesheet" href="css/custom.css">


</head>
<body>
  <?php if (empty($_SESSION['id'])) : ?>
  <header>

     <div class="row">
      <div class="brand-name">
        <div class="large-2 medium-2 small-12 columns">
          <h1><a href="#/feed">Picritic</a></h1>
        </div>
        <div class="large-6 medium-8 small-12 columns auth">
            <form class="row" ng-submit="submit(email, password)" ng-controller="LoginController">
                <div class="large-5 medium-5 columns">
                    <input type="text" class="form-control" ng-model="email" name="email" placeholder="email">
                </div>
                <div class="large-4 medium-5 columns">
                    <input type="password" class="form-control" ng-model="password" name="password" placeholder="password">
                </div>
                {{error}}
                <div class="large-1 medium-2 columns" style="float: left; padding: 0;">
                  <input type="submit" id="submit" class="btn btn-default" value="Log In">
                </div>

            </form>
        </div>
      </div>

    </div>
  </header>


<?php elseif(isset($_SESSION['id'])): ?>
  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
     <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#/feed">Pictric</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    

 

  <!-- Collect the nav links, forms, and other content for toggling
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="city-query" ng-model="query" placeholder="Search">
      </div>
      
      <button type="submit" class="btn btn-default">Submit</button>
      -->
   
    <ul class="nav navbar-nav navbar-left">
         <li><a ng-href="#/world-feed"><span class="glyphicon glyphicon-globe"></span> World Feed</a></li>
        <li><a ng-href="#/traveler"><span class="glyphicon glyphicon-flash"></span> Game</a></li>
        <li><a ng-href="#/images"><span class="glyphicon glyphicon-stats"></span> Top Images</a></li>
        <li><a ng-href="#/users"><span class="glyphicon glyphicon-star"></span> Top Users</a></li>
        <li><a ng-href="#/shop"><span class="glyphicon glyphicon-gift"></span> Shop</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

      <li class="user-nav-pic"><?php echo '<a href="#/user/'.$_SESSION['id'].'">' . $_SESSION['full_name'] ; ?></a></li>
      <li class="dropdown" ng-controller="NotificationsCtrl">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="badge">{{messages.length}}</span> <b class="caret"></b></a>
            <ul class="notifications dropdown-menu">

                <li ng-repeat="message in messages"><a href="#">{{message.first_name}}</a> wants to follow you? <span ng-click="connect(message.id , 'Y', message)" class="glyphicon glyphicon-ok"></span> / <span ng-click="connect(message.id, 'N', message)" class="glyphicon glyphicon-remove"></span></li>
                <li ng-show="!messages.length">&nbsp;You currently have no new messages.</li>
            </ul>
       </li>

       <li><a href="#/upload" title="Image Upload"><span class="glyphicon glyphicon-picture"></span>Upload</a></li>
       <li><a href="auth/logout.php"><span class="glyphicon glyphicon-log-out"></span></a></li>

    </ul>
  </div><!-- /.navbar-collapse -->
</div>
</nav>
<?php endif; ?>

  <div class="view-container">
    <div ng-view>

    </div>
  </div>


  <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>


  <script src="js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular.min.js"></script>
  <script src="js/vendor/modernizr.js"></script>
  

  <script src="js/infinitescroll.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular-route.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular-resource.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular-sanitize.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.5/angular-animate.js"></script>
  <script src="js/app.js"></script>
  <script src="js/controller.js"></script>
  <script src="js/filter.js"></script>
  <script src="js/services.js"></script>


  <script src="js/foundation.min.js"></script>
  <script src="js/ui-bootstrap.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>



</body>
</html>