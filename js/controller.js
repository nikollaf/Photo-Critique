
var worldlensControllers = angular.module('worldlensControllers', []);



worldlensControllers.controller('CityListCtrl', ['$scope', 'City',
    function($scope, City) {
        $scope.cities = City.show();

        $scope.orderProp = 'points';
        $scope.reverse = 'true';
        $scope.setLimit = 4;
        $scope.limit = 'See All';

        $scope.toggleLimit = function() {
            $scope.setLimit = $scope.cities.length;
            $scope.limit = '';
        }
        //console.log($scope.cities);

    }]);

worldlensControllers.controller('ContListCtrl', ['$scope', 'Cont', '$routeParams',
    function($scope, Cont, $routeParams) {
        //$scope.cities = Cont.query({ id: $routeParams.id });

        $scope.cities = Cont.query({id: $routeParams.id}, function(cont) {
            $scope.mainImage = cont.pop();


            $scope.main_image = 'http://res.cloudinary.com/world-lens/image/upload/w_450,h_450,c_fill/v1387844193/' + $scope.mainImage.image_url +'.jpg';
        });
}]);
////////////////////////
// World Feed Controller
////////////////////////
worldlensControllers.controller('WorldFeedCtrl', ['$scope', 'World', '$routeParams', 'Highlight', 'Like',
    function($scope, World, $routeParams, Highlight, Like) {


        $scope.world = World.show('', function(world) {
            $scope.mainWorld = world[0];

            $scope.world_images = world[0].images;

            $scope.vote = function (cityId, imageId, img, status) {

                var key = $scope.world_images.indexOf(img);

                postData = {cityId:cityId, imageId:imageId};

                if (status == 'img.isLiked') {
                    Like.insert(postData);
                    $scope.world_images[key].img_points = parseInt($scope.world_images[key].img_points) + 1;
                    console.log("Liked");
                } else if (status == '!img.isLiked') {
                    Like.delete(postData);
                    $scope.world_images[key].img_points = parseInt($scope.world_images[key].img_points) - 1;
                    console.log("Unliked");
                }
                img.isLiked = !img.isLiked;
            };

         

        });

        $scope.totalDisplayed = 10;

        $scope.loadMore = function() {
            $scope.totalDisplayed += 20;
            console.log("Loading");
        };

        $scope.orderProp = 'created';

}]);

worldlensControllers.controller('CityDetailCtrl', ['$scope', '$http', '$routeParams', 'City', 'Highlight', 'Like',
function($scope, $http, $routeParams, City, Highlight, Like) {
   
    $scope.mainCity = City.query({id: $routeParams.cityId}, function(city) {
        $scope.mainCityName = city[0];

        $scope.orderProp = 'created';
        
    });

    $scope.isDisabled = false;

    $scope.highlight = function(imageId, userId, event) {

        $(event.target).parent().addClass('highlighted');
        postData = {imageId:imageId, userId:userId}
        Highlight.insert(postData);
        $scope.isDisabled = true;
    }

    $scope.vote = function(cityId, imageId, event) {

        $(event.target).parent().addClass('liked');
        postData = {cityId:cityId, imageId:imageId};

        Like.insert(postData);
        $scope.isDisabled = true;
        //$scope.$watch('mainWorld');
        //console.log(cityId, imageId);
        // http://jsfiddle.net/pkozlowski_opensource/WXJ3p/15/
    }

}]);

worldlensControllers.controller('ImageListCtrl', ['$scope', '$routeParams', 'Image','$location', '$http',
function ($scope, $routeParams, Image, $location, $http) {

    
    $scope.image = Image.query({ id: $routeParams.id }, function(image) {
        $scope.mainImage = image[0];
         // fix blank load buG
        //$scope.profile_picture = 'http://res.cloudinary.com/world-lens/image/upload/w_45,h_45,c_fill/v1387844193/' +$scope.mainImage.profile_pic +'.jpg';
        $scope.main_image = 'http://res.cloudinary.com/world-lens/image/upload/w_0.8/v1387844193/' + $scope.mainImage.image_url +'.jpg';

        $("#exposure").rateYo({
            maxValue: 1,
            numStars: 1,
            ratedFill: '#1abc9c',
            starWidth: "60px",
            onChange: function (rating, rateYoInstance) {
              $('input#exposure-rating').val(rating);
            }
          });

         $("#focus").rateYo({
            maxValue: 1,
            numStars: 1,
            ratedFill: '#2ecc71',
            starWidth: "60px",
            onChange: function (rating, rateYoInstance) {
              $('input#focus-rating').val(rating);
            }
          });

         $("#creativity").rateYo({
            maxValue: 1,
            numStars: 1,
            ratedFill: '#9b59b6',
            starWidth: "60px",
            onChange: function (rating, rateYoInstance) {
              $('input#creativity-rating').val(rating);
            }
          });

         $("#lighting").rateYo({
            maxValue: 1,
            numStars: 1,
            ratedFill: '#3498db',
            starWidth: "60px",
            onChange: function (rating, rateYoInstance) {
              $('input#lighting-rating').val(rating);
            }
          });

         $("#story").rateYo({
            maxValue: 1,
            numStars: 1,
            ratedFill: '#34495e',
            starWidth: "60px",
            onChange: function (rating, rateYoInstance) {
              $('input#story-rating').val(rating);
            }
          });

      

        $scope.submit = function(comment) {

            Image.create({comment: comment, imageId: $routeParams.id});

            $scope.mainImage.feed.push({
                comment: comment
            });
        }
    });
    

    $scope.vote = function() {
         $http.post('/Photo-Critique/api/index.php/vote', 
            { 
                exposure : $('input#exposure-rating').val(),
                focus    : $('input#focus-rating').val(),
                lighting : $('input#lighting-rating').val(),
                creativity : $('creativity-rating').val(),
                story   : $('input#story-rating').val()

            }
        ).success(function(data, status, headers, config) {
        // this callback will be called asynchronously
        // when the response is available
      }).error(function(data, status, headers, config) {
        // called asynchronously if an error occurs
        // or server returns response with an error status.
      });
      
    }

   

}]);

worldlensControllers.controller('NotificationsCtrl', ['$scope', '$routeParams', 'Message',
    function ($scope, $routeParams, Message) {

        $scope.messages = Message.get();

        $scope.connect = function(id, status, message) {
            //console.log(id);
            Message.update({id: id, status: status});

            $scope.messages.splice($scope.messages.indexOf(message),1);


            //$scope.$watch($scope.messages, function(){} ,true)
            //
        }

        //$scope.$watch('messages', $scope.connect(), true);
}]);


worldlensControllers.controller('LoginController', ['$http', '$scope', '$location', '$route',
  function($http, $scope, $location, $route) {

    $scope.submit = function(email, password) {
        $http.post('api/index.php/login', {email: email, password: password})
            .success(function(data) {
                //
                $location.path('/world-feed');
                location.reload();

                //console.log(data);
            })
            .error(function(){
                $scope.error = 'Wrong username / password combination';
            });
    }

}]);

worldlensControllers.controller('FeedCtrl', ['$scope', '$routeParams', 'Feed', '$location',
    function ($scope, $routeParams, Feed, $location) {

        $scope.feed = Feed.show();

}]);




worldlensControllers.controller('FeedImage', ['$scope', '$routeParams', 'Feed', '$location',
    function ($scope, $routeParams, Feed, $location) {

        $scope.init = function(galleryId) {
            
            $scope.images = Feed.query({ id: galleryId });
            
        }

}]);


worldlensControllers.controller('UserController', ['$scope', '$routeParams', 'User', 'City', '$modal', 'Like', 'Highlight',
    function ($scope, $routeParams, User, City, $modal, Like, Highlight) {

        $scope.class = 'red';
        $scope.message = "Connect";
        $scope.isDisabled = false;

        $scope.userInfo = User.query({id: $routeParams.id}, function(user) {
            $scope.mainUserInfo = user[0];

            $scope.world_images = user[0].images;

            $scope.user_pro_pic = 'http://res.cloudinary.com/world-lens/image/upload/w_55,h_55,c_fill/v1387844193/' + $scope.mainUserInfo.profile_pic + '.jpg'

            if ($routeParams.id == $scope.mainUserInfo.current_user) {
                $scope.user = true;
                $scope.message = 'Edit';
            }

            $scope.following_users = user[0].following_users;

            $scope.followers = user[0].follower_users;

            $scope.vote = function (cityId, imageId, img, status) {

                var key = $scope.world_images.indexOf(img);

                postData = {cityId:cityId, imageId:imageId};

                if (status == 'img.isLiked') {
                    Like.insert(postData);
                    $scope.world_images[key].img_points = parseInt($scope.world_images[key].img_points) + 1;
                    console.log("Liked");
                } else if (status == '!img.isLiked') {
                    Like.delete(postData);
                    $scope.world_images[key].img_points = parseInt($scope.world_images[key].img_points) - 1;
                    console.log("Unliked");
                }
                img.isLiked = !img.isLiked;
            };

    


        });

        //console.log($scope.userInfo);

        $scope.showFollowing = function () {

            $scope.header = "Following";

            var modalInstance = $modal.open({
                templateUrl: 'myModalContent.html',
                controller: ModalInstanceCtrl,
                resolve: {
                    items: function () {
                        return $scope.following_users;

                    }
                }
            });
        };

        $scope.showFollowers = function () {

            $scope.header = "Followers";

            var modalInstance = $modal.open({
                templateUrl: 'myModalContent.html',
                controller: ModalInstanceCtrl,
                resolve: {
                    items: function () {
                        return $scope.followers;

                    }
                }
            });
        };

        $scope.vote = function(id, imageId) {

            postData = {id : id, imageId : imageId};
        //$http.post('http://localhost/projects/worldlens_3/api/index.php/like', {"cityId" : cityId, "imageId" : imageId}).success(console.log('h'));
            City.update(postData);
        //console.log(cityId, imageId);
        //console.log(Like.update);
        }

        $scope.follow = function(id) {
              postData = {id : id};
              User.follow(postData);
              $scope.class = 'green';
              $scope.message = "Request Send";
              $scope.isDisabled = true;
              return false;
              
        };

}]);



worldlensControllers.controller('GameListCtrl', ['$scope', 'Image', '$routeParams', 'Like', 'Highlight',
    function($scope, Image, $routeParams, Like, Highlight) {

        $scope.images = Image.show();

        console.log($scope.images);

        var myArray = ['People', 'Nature', 'Architecture', 'Food'];

        //var myCity = ['', ''];
        $scope.randcat = myArray[Math.floor(Math.random() * myArray.length)];
        //$scope.randcity = myCity[Math.floor(Math.random() * myCity.length)];

        $scope.reorder = function(cityId, imageId, img, status) {
            shuffleArray($scope.images);
            $scope.randcat = myArray[Math.floor(Math.random() * myArray.length)];
            //$scope.randcity = myCity[Math.floor(Math.random() * myCity.length)];
            var key = $scope.images.indexOf(img);

            postData = {cityId:cityId, imageId:imageId};

            if (status == 'img.isLiked') {
                Like.insert(postData);
                $scope.images[key].img_points = parseInt($scope.images[key].img_points) + 1;
                console.log("Liked");
            } else if (status == '!img.isLiked') {
                Like.delete(postData);
                $scope.images[key].img_points = parseInt($scope.images[key].img_points) - 1;
                console.log("Unliked");
            }
            img.isLiked = !img.isLiked;
        }

        // -> Fisher–Yates shuffle algorithm
        var shuffleArray = function(array) {
            var m = array.length, t, i;

            // While there remain elements to shuffle
            while (m) {
                // Pick a remaining element…
                i = Math.floor(Math.random() * m--);

                // And swap it with the current element.
                t = array[m];
                array[m] = array[i];
                array[i] = t;
            }

            return array;
        }

        $scope.vote = function (cityId, imageId, img, status) {

            var key = $scope.images.indexOf(img);

            postData = {cityId:cityId, imageId:imageId};

            if (status == 'img.isLiked') {
                Like.insert(postData);
                $scope.images[key].img_points = parseInt($scope.images[key].img_points) + 1;
                console.log("Liked");
            } else if (status == '!img.isLiked') {
                Like.delete(postData);
                $scope.images[key].img_points = parseInt($scope.images[key].img_points) - 1;
                console.log("Unliked");
            }
            img.isLiked = !img.isLiked;
        };
}]);


/** City List Ctrl - Return all cities **/
worldlensControllers.controller('ListCityCtrl', ['$scope', 'City', '$routeParams',
    function($scope, City, $routeParams) {

        $scope.cities = City.show();

    }]);


worldlensControllers.controller('AddImageCtrl', ['$scope', '$http', 'Image', '$location', 'instagram','$resource',
function ($scope, Image, $location, $http, instagram, $resource) {

    $scope.todos = [];

 
  $scope.addImage = function() {

      $scope.todos.push({text:$scope.todoText, done:false});
  };
 
  $scope.removeImage = function(contact) {
    for (var i = 0, ii = $scope.todos.length; i < ii; i++) {
      if (contact === $scope.todos[i]) {
        $scope.todos.splice(i, 1);
      }
    }
  };


    $scope.pics = [];
    $scope.user = '';

    //https://api.instagram.com/v1/users/search?q=[USERNAME]&access_token=[ACCESS TOKEN]

    $scope.search = function(user) {
        var user = $resource('https://api.instagram.com/v1/users/search?q=:user&client_id=:client_id&callback=JSON_CALLBACK',{
            client_id: 'be4f6917108f4b3ab3eebbfce7bea4e2',
            user: user
        },{
            fetch:{method:'JSONP'}
        });

        $scope.id = user.fetch(function(response){

            var api = $resource('https://api.instagram.com/v1/users/:user_id/media/recent?client_id=:client_id&callback=JSON_CALLBACK',{
                client_id: 'be4f6917108f4b3ab3eebbfce7bea4e2',
                user_id: response.data[0].id
            },{

                fetch:{method:'JSONP'}
            });

            api.fetch(function(response){
                $scope.pics = response.data;
            });
        });
    }

    if($scope.user!="") {
        $scope.search();
    }

}]);

var ModalInstanceCtrl = function ($scope, $modalInstance, items) {

    $scope.items = items;

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
};



