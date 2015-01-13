var worldlensServices = angular.module('worldlensServices', ['ngResource']);

worldlensServices.factory('City', ['$resource', function($resource){
    return $resource('api/index.php/city/:id', {}, {
        show: {method:'GET', isArray:true},
        query: { method: "GET", params: {id: '@id'}, isArray: true},
        update: { method: "PUT", params: {id : '@id', imageId : '@imageId'} }
    });
}]);

worldlensServices.factory('Cont', ['$resource', function($resource){
    return $resource('api/index.php/cont/:id', {}, {
        show: {method:'GET', isArray:true},
        query: { method: "GET", data: {id: '@id'}, isArray: true}
    });
}]);


worldlensServices.factory('Image', function ($resource) {
    return $resource('api/index.php/image/:id', {}, {
        query: { method: 'GET', params: {id: '@id'}, isArray: true },
        create: { method: 'POST', data: {comment: '@comment', imageId: '@imageId'}},
        show: {method: 'GET', isArray: true}
       
    })
});

worldlensServices.factory('Game', function ($resource) {
    return $resource('api/index.php/image/game', {}, {
        show: {method: 'GET', isArray: true}
    })
});


worldlensServices.factory('World', function ($resource) {
    return $resource('api/index.php/world', {}, {
        show: { method: 'GET', isArray: true }
    })
});

worldlensServices.factory('Feed', function ($resource) {
    return $resource('api/index.php/feed/:id', {}, {
        show: { method: 'GET', isArray: true },
        query: { method: "GET", params: {id: '@id', imageId:'@imageId'}, isArray: true}
    })
});

worldlensServices.factory('User', function ($resource) {
    return $resource('api/index.php/user/:id', {}, {
        show: { method: 'GET', isArray: true },
        query: { method: "GET", params: {id: '@id'}, isArray: true},
        follow: { method: "POST", params: {id: '@id'} }
    })
});


worldlensServices.factory('Users', function ($resource) {
    return $resource('api/index.php/users', {}, {
        show: { method: 'GET', isArray: true }
    })
});

worldlensServices.factory('MainUser', function ($resource) {
    return $resource('api/index.php/user', {}, {
        show: { method: 'GET', isArray: true }
    })
});

worldlensServices.factory('Like', function ($resource) {

    return $resource('api/index.php/like', {}, {

        insert: { method: "POST", params: { cityId: '@cityId', imageId: '@imageId'} },
        delete: { method: "PUT", data: {cityId: '@cityId', imageId: '@imageId'}}

    })

});

worldlensServices.factory('Highlight', function ($resource) {

    return $resource('api/index.php/highlight', {}, {

        insert: { method: "POST", data: {userId: '@userId', imageId: '@imageId'}},
        delete: { method: "PUT", data: {userId: '@userId', imageId: '@imageId'}}
    })

});

worldlensServices.factory('Message', function ($resource) {

    return $resource('api/index.php/message', {}, {

        get: { method: "GET", isArray: true},
        update: { method: "POST", data: {id: '@id', status: '@status'}}

    })

});