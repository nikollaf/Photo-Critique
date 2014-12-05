
angular.module('shortNumFilter', []).filter('shortenedNumAsInt', function() {
    return function(num, uppercase, round) {
        //num = 1258730000;
        num = parseInt(num);
        if (uppercase === undefined) { uppercase = false }
        if (round === undefined) { round = false }

        var int;
        var noRounding;
        var rounding;
        //round = true;
        if (num >= 1000000000000) {
            int = (num / 1000000000000);
            noRounding = ((Math.floor(int*10)/10).toString());
            rounding = int.toFixed(1);
            return (round? rounding: noRounding).replace(/\.0$/, '') + (uppercase?'T':'t');
        }
        else if (num >= 1000000000) {
            int = (num / 1000000000);
            noRounding = ((Math.floor(int*10)/10).toString());
            rounding = int.toFixed(1);
            return (round? rounding: noRounding).replace(/\.0$/, '') + (uppercase?'B':'b');
        }
        else if (num >= 1000000) {
            int = (num / 1000000);
            noRounding = ((Math.floor(int*10)/10).toString());
            rounding = int.toFixed(1);
            return (round? rounding: noRounding).replace(/\.0$/, '') + (uppercase?'M':'m');
        }
        else if (num >= 1000) {
            int = (num / 1000);
            noRounding = ((Math.floor(int*10)/10).toString());
            rounding = int.toFixed(1);
            return (round? rounding: noRounding).replace(/\.0$/, '') + (uppercase?'K':'k');
        }
        return num;
    };
});


angular.module('worldlensFilter', []).filter('unique', function () {

  return function (items, filterOn) {

    if (filterOn === false) {
      return items;
    }

    if ((filterOn || angular.isUndefined(filterOn)) && angular.isArray(items)) {
      var hashCheck = {}, newItems = [];

      var extractValueToCompare = function (item) {
        if (angular.isObject(item) && angular.isString(filterOn)) {
          return item[filterOn];
        } else {
          return item;
        }
      };

      angular.forEach(items, function (item) {
        var valueToCheck, isDuplicate = false;

        for (var i = 0; i < newItems.length; i++) {
          if (angular.equals(extractValueToCompare(newItems[i]), extractValueToCompare(item))) {
            isDuplicate = true;
            break;
          }
        }
        if (!isDuplicate) {
          newItems.push(item);
        }

      });
      items = newItems;
    }
    return items;
  };
});

angular.module('citydetailFilter', []).filter('filterCat', function() {
  return function(items, options ) {
      // loop over all the options and if true ensure the car has them
      // I cant do this for you beacause I don't know how you would store this info in the car object but it should not be difficult
      return categories;
    };
});



angular.module('AuthFactory', []).factory("AuthenticationService", function($http, $sanitize, SessionService, FlashService, CSRF_TOKEN) {

    var cacheSession   = function() {
        SessionService.set('authenticated', true);
    };

    var uncacheSession = function() {
        SessionService.unset('authenticated');
    };

    var loginError = function(response) {
        FlashService.show(response.flash);
    };

    var sanitizeCredentials = function(credentials) {
        return {
            email: $sanitize(credentials.email),
            password: $sanitize(credentials.password),
            csrf_token: CSRF_TOKEN
        };
    };

    return {
        login: function(credentials) {
            var login = $http.post("api/index.php/user", sanitizeCredentials(credentials));
            login.success(cacheSession);
            login.success(FlashService.clear);
            login.error(loginError);
            return login;
        },
        logout: function() {
            var logout = $http.get("/auth/logout");
            logout.success(uncacheSession);
            return logout;
        },
        isLoggedIn: function() {
            return SessionService.get('authenticated');
        }
    };
});

angular.module('AuthFactory', []).factory("FlashService", function($rootScope) {
    return {
        show: function(message) {
            $rootScope.flash = message;
        },
        clear: function() {
            $rootScope.flash = "";
        }
    }
});

angular.module('AuthFactory', []).factory("SessionService", function() {
    return {
        get: function(key) {
            return sessionStorage.getItem(key);
        },
        set: function(key, val) {
            return sessionStorage.setItem(key, val);
        },
        unset: function(key) {
            return sessionStorage.removeItem(key);
        }
    }
});

angular.module('AuthFactory', []).factory('instagram', function($resource){



    return {
        fetchPopular: function(callback){

            // The ngResource module gives us the $resource service. It makes working with
            // AJAX easy. Here I am using the client_id of a test app. Replace it with yours.
            //489757105
            //https://api.instagram.com/v1/users/search?q=[USERNAME]&access_token=[ACCESS TOKEN]

            var api = $resource('https://api.instagram.com/v1/users/234/media/recent?client_id=:client_id&callback=JSON_CALLBACK',{
                client_id: 'be4f6917108f4b3ab3eebbfce7bea4e2'
            },{
                // This creates an action which we've chosen to name "fetch". It issues
                // an JSONP request to the URL of the resource. JSONP requires that the
                // callback=JSON_CALLBACK part is added to the URL.

                fetch:{method:'JSONP'}
            });

            api.fetch(function(response){

                // Call the supplied callback function
                callback(response.data);

            });
        }
    }
});



