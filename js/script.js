

/*! perfect-scrollbar - v0.4.8
 * http://noraesae.github.com/perfect-scrollbar/
 * Copyright (c) 2014 Hyeonje Jun; Licensed MIT */
"use strict";(function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e(jQuery)})(function(e){var o={wheelSpeed:10,wheelPropagation:!1,minScrollbarLength:null,useBothWheelAxes:!1,useKeyboard:!0,suppressScrollX:!1,suppressScrollY:!1,scrollXMarginOffset:0,scrollYMarginOffset:0},n=function(){var e=0;return function(){var o=e;return e+=1,".perfect-scrollbar-"+o}}();e.fn.perfectScrollbar=function(t,r){return this.each(function(){var l=e.extend(!0,{},o),s=e(this);if("object"==typeof t?e.extend(!0,l,t):r=t,"update"===r)return s.data("perfect-scrollbar-update")&&s.data("perfect-scrollbar-update")(),s;if("destroy"===r)return s.data("perfect-scrollbar-destroy")&&s.data("perfect-scrollbar-destroy")(),s;if(s.data("perfect-scrollbar"))return s.data("perfect-scrollbar");s.addClass("ps-container");var a,c,i,u,p,d,f,h,b,v,g=e("<div class='ps-scrollbar-x-rail'></div>").appendTo(s),m=e("<div class='ps-scrollbar-y-rail'></div>").appendTo(s),w=e("<div class='ps-scrollbar-x'></div>").appendTo(g),T=e("<div class='ps-scrollbar-y'></div>").appendTo(m),L=parseInt(g.css("bottom"),10),y=parseInt(m.css("right"),10),S=n(),I=function(e,o){var n=e+o,t=u-b;v=0>n?0:n>t?t:n;var r=parseInt(v*(d-u)/(u-b),10);s.scrollTop(r),g.css({bottom:L-r})},C=function(e,o){var n=e+o,t=i-f;h=0>n?0:n>t?t:n;var r=parseInt(h*(p-i)/(i-f),10);s.scrollLeft(r),m.css({right:y-r})},k=function(e){return l.minScrollbarLength&&(e=Math.max(e,l.minScrollbarLength)),e},X=function(){g.css({left:s.scrollLeft(),bottom:L-s.scrollTop(),width:i,display:a?"inherit":"none"}),m.css({top:s.scrollTop(),right:y-s.scrollLeft(),height:u,display:c?"inherit":"none"}),w.css({left:h,width:f}),T.css({top:v,height:b})},Y=function(){i=s.width(),u=s.height(),p=s.prop("scrollWidth"),d=s.prop("scrollHeight"),!l.suppressScrollX&&p>i+l.scrollXMarginOffset?(a=!0,f=k(parseInt(i*i/p,10)),h=parseInt(s.scrollLeft()*(i-f)/(p-i),10)):(a=!1,f=0,h=0,s.scrollLeft(0)),!l.suppressScrollY&&d>u+l.scrollYMarginOffset?(c=!0,b=k(parseInt(u*u/d,10)),v=parseInt(s.scrollTop()*(u-b)/(d-u),10)):(c=!1,b=0,v=0,s.scrollTop(0)),v>=u-b&&(v=u-b),h>=i-f&&(h=i-f),X()},x=function(){var o,n;w.bind("mousedown"+S,function(e){n=e.pageX,o=w.position().left,g.addClass("in-scrolling"),e.stopPropagation(),e.preventDefault()}),e(document).bind("mousemove"+S,function(e){g.hasClass("in-scrolling")&&(C(o,e.pageX-n),e.stopPropagation(),e.preventDefault())}),e(document).bind("mouseup"+S,function(){g.hasClass("in-scrolling")&&g.removeClass("in-scrolling")}),o=n=null},D=function(){var o,n;T.bind("mousedown"+S,function(e){n=e.pageY,o=T.position().top,m.addClass("in-scrolling"),e.stopPropagation(),e.preventDefault()}),e(document).bind("mousemove"+S,function(e){m.hasClass("in-scrolling")&&(I(o,e.pageY-n),e.stopPropagation(),e.preventDefault())}),e(document).bind("mouseup"+S,function(){m.hasClass("in-scrolling")&&m.removeClass("in-scrolling")}),o=n=null},P=function(e,o){var n=s.scrollTop();if(0===e){if(!c)return!1;if(0===n&&o>0||n>=d-u&&0>o)return!l.wheelPropagation}var t=s.scrollLeft();if(0===o){if(!a)return!1;if(0===t&&0>e||t>=p-i&&e>0)return!l.wheelPropagation}return!0},M=function(){var e=!1;s.bind("mousewheel"+S,function(o,n,t,r){l.useBothWheelAxes?c&&!a?r?s.scrollTop(s.scrollTop()-r*l.wheelSpeed):s.scrollTop(s.scrollTop()+t*l.wheelSpeed):a&&!c&&(t?s.scrollLeft(s.scrollLeft()+t*l.wheelSpeed):s.scrollLeft(s.scrollLeft()-r*l.wheelSpeed)):(s.scrollTop(s.scrollTop()-r*l.wheelSpeed),s.scrollLeft(s.scrollLeft()+t*l.wheelSpeed)),Y(),e=P(t,r),e&&o.preventDefault()}),s.bind("MozMousePixelScroll"+S,function(o){e&&o.preventDefault()})},O=function(){var o=!1;s.bind("mouseenter"+S,function(){o=!0}),s.bind("mouseleave"+S,function(){o=!1});var n=!1;e(document).bind("keydown"+S,function(e){if(o){var t=0,r=0;switch(e.which){case 37:t=-3;break;case 38:r=3;break;case 39:t=3;break;case 40:r=-3;break;case 33:r=9;break;case 32:case 34:r=-9;break;case 35:r=-u;break;case 36:r=u;break;default:return}s.scrollTop(s.scrollTop()-r*l.wheelSpeed),s.scrollLeft(s.scrollLeft()+t*l.wheelSpeed),n=P(t,r),n&&e.preventDefault()}})},j=function(){var e=function(e){e.stopPropagation()};T.bind("click"+S,e),m.bind("click"+S,function(e){var o=parseInt(b/2,10),n=e.pageY-m.offset().top-o,t=u-b,r=n/t;0>r?r=0:r>1&&(r=1),s.scrollTop((d-u)*r)}),w.bind("click"+S,e),g.bind("click"+S,function(e){var o=parseInt(f/2,10),n=e.pageX-g.offset().left-o,t=i-f,r=n/t;0>r?r=0:r>1&&(r=1),s.scrollLeft((p-i)*r)})},A=function(){var o=function(e,o){s.scrollTop(s.scrollTop()-o),s.scrollLeft(s.scrollLeft()-e),Y()},n={},t=0,r={},l=null,a=!1;e(window).bind("touchstart"+S,function(){a=!0}),e(window).bind("touchend"+S,function(){a=!1}),s.bind("touchstart"+S,function(e){var o=e.originalEvent.targetTouches[0];n.pageX=o.pageX,n.pageY=o.pageY,t=(new Date).getTime(),null!==l&&clearInterval(l),e.stopPropagation()}),s.bind("touchmove"+S,function(e){if(!a&&1===e.originalEvent.targetTouches.length){var l=e.originalEvent.targetTouches[0],s={};s.pageX=l.pageX,s.pageY=l.pageY;var c=s.pageX-n.pageX,i=s.pageY-n.pageY;o(c,i),n=s;var u=(new Date).getTime();r.x=c/(u-t),r.y=i/(u-t),t=u,e.preventDefault()}}),s.bind("touchend"+S,function(){clearInterval(l),l=setInterval(function(){return.01>Math.abs(r.x)&&.01>Math.abs(r.y)?(clearInterval(l),void 0):(o(30*r.x,30*r.y),r.x*=.8,r.y*=.8,void 0)},10)})},E=function(){s.bind("scroll"+S,function(){Y()})},W=function(){s.unbind(S),e(window).unbind(S),e(document).unbind(S),s.data("perfect-scrollbar",null),s.data("perfect-scrollbar-update",null),s.data("perfect-scrollbar-destroy",null),w.remove(),T.remove(),g.remove(),m.remove(),w=T=i=u=p=d=f=h=L=b=v=y=null},B=function(o){s.addClass("ie").addClass("ie"+o);var n=function(){var o=function(){e(this).addClass("hover")},n=function(){e(this).removeClass("hover")};s.bind("mouseenter"+S,o).bind("mouseleave"+S,n),g.bind("mouseenter"+S,o).bind("mouseleave"+S,n),m.bind("mouseenter"+S,o).bind("mouseleave"+S,n),w.bind("mouseenter"+S,o).bind("mouseleave"+S,n),T.bind("mouseenter"+S,o).bind("mouseleave"+S,n)},t=function(){X=function(){w.css({left:h+s.scrollLeft(),bottom:L,width:f}),T.css({top:v+s.scrollTop(),right:y,height:b}),w.hide().show(),T.hide().show()}};6===o&&(n(),t())},K="ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch,q=function(){var e=navigator.userAgent.toLowerCase().match(/(msie) ([\w.]+)/);e&&"msie"===e[1]&&B(parseInt(e[2],10)),Y(),E(),x(),D(),j(),K&&A(),s.mousewheel&&M(),l.useKeyboard&&O(),s.data("perfect-scrollbar",s),s.data("perfect-scrollbar-update",Y),s.data("perfect-scrollbar-destroy",W)};return q(),s})}});


/*****
* rateYo - v1.2.0
* http://prrashi.github.io/rateyo/
* Copyright (c) 2014 Prashanth Pamidi; Licensed MIT
*****/

;(function ($) {
  "use strict";

  /* The basic svg string required to generate stars
   */
 var BASICSTAR = "<?xml version=\"1.0\" encoding=\"utf-8\"?>"+
                  "<svg version=\"1.1\" id=\"Layer_1\""+
                        "xmlns=\"http://www.w3.org/2000/svg\""+
                        "viewBox=\"0 12.705 512 486.59\""+
                        "x=\"0px\" y=\"0px\""+
                        "xml:space=\"preserve\">"+
                    "<polygon style=\"stroke-width: 1; stroke: black\" id=\"star-icon\""+
                              "points=\"256.814,12.705 317.205,198.566"+
                                      " 512.631,198.566 354.529,313.435 "+
                                      "414.918,499.295 256.814,384.427 "+
                                      "98.713,499.295 159.102,313.435 "+
                                      "1,198.566 196.426,198.566 \"/>"+
                  "</svg>";

  var DEFAULTS = {

    starWidth: "62px",
    normalFill: "white",
    ratedFill: "#c0392b",
    numStars: 1,
    minValue: 0,
    maxValue: 1,
    precision: 1,
    rating: 0,
    readOnly: false,
    onChange: null,
    onSet: null
  };

  function checkPercision (value, minValue, maxValue) {

    /* its like comparing 0.00 with 0 which is true*/
    if (value === minValue) {

      value = minValue;
    }
    else if(value === maxValue) {

      value = maxValue;
    }

    return value;
  }

  function checkBounds (value, minValue, maxValue) {

    var isValid = value >= minValue && value <= maxValue;

    if(!isValid){

        throw Error("Invalid Rating, expected value between "+ minValue +
                    " and " + maxValue);
    }

    return value;
  }

  function getInstance (node, collection) {

    var instance;

    $.each(collection, function () {

      if(node === this.node){

        instance = this;
        return false;
      }
    });

    return instance;
  }

  function deleteInstance (node, collection) {

    $.each(collection, function (index) {

      if (node === this.node) {

        var firstPart = collection.slice(0, index),
            secondPart = collection.slice(index+1, collection.length);

        collection = firstPart.concat(secondPart);

        return false;
      }
    });

    return collection;
  }

  function isDefined(value) {

    return typeof value !== "undefined";
  }

  /* The Contructor, whose instances are used by plugin itself,
   * to set and get values
   */
  function RateYo ($node, options) {

    this.$node = $node;

    this.node = $node.get(0);

    var that = this;

    $node.addClass("jq-ry-container");

    var $groupWrapper = $("<div/>").addClass("jq-ry-group-wrapper")
                                   .appendTo($node);

    var $normalGroup = $("<div/>").addClass("jq-ry-normal-group")
                                  .addClass("jq-ry-group")
                                  .appendTo($groupWrapper);

    var $ratedGroup = $("<div/>").addClass("jq-ry-rated-group")
                                 .addClass("jq-ry-group")
                                 .appendTo($groupWrapper);

    function showRating (ratingVal) {

      if(!isDefined(ratingVal)){

        ratingVal = options.rating;
      }

      var minValue = options.minValue,
          maxValue = options.maxValue;

      var percent = ((ratingVal - minValue)/(maxValue - minValue))*100;

      $ratedGroup.css("width", percent + "%");
    }

    function setStarWidth (newWidth) {

      if (!isDefined(newWidth)) {

        return options.starWidth;
      }

      // In the current version, the width and height of the star
      // should be the same
      options.starWidth = options.starHeight = newWidth;

      var containerWidth = parseInt(options.starWidth.replace("px","").trim());

      containerWidth = containerWidth*options.numStars;

      $node.width(containerWidth);

      $normalGroup.find("svg")
                  .attr({width: options.starWidth,
                         height: options.starHeight});

      $ratedGroup.find("svg")
                 .attr({width: options.starWidth,
                        height: options.starHeight});
    }

    function setNormalFill (newFill) {

      if (!isDefined(newFill)) {

        return options.normalFill;
      }

      options.normalFill = newFill;

      $normalGroup.find("svg").attr({fill: options.normalFill});
    }

    function setRatedFill (newFill) {

      if (!isDefined(newFill)) {

        return options.ratedFill;
      }

      options.ratedFill = newFill;

      $ratedGroup.find("svg").attr({fill: options.ratedFill});
    }

    function setNumStars (newValue) {

      if (!isDefined(newValue)) {

        return options.numStars;
      }

      options.numStars = newValue;

      $normalGroup.empty();
      $ratedGroup.empty();

      for (var i=0; i<options.numStars; i++) {

        $normalGroup.append($(BASICSTAR));
        $ratedGroup.append($(BASICSTAR));
      }

      setStarWidth(options.starWidth);
      setRatedFill(options.ratedFill);
      setNormalFill(options.normalFill);

      showRating();
    }

    function setMinValue (newValue) {

      if (!isDefined(newValue)) {

        return options.minValue;
      }

      options.minValue = newValue;

      showRating();

      return newValue;
    }

    function setMaxValue (newValue) {

      if (!isDefined(newValue)) {

        return options.maxValue;
      }

      options.maxValue = newValue;

      showRating();

      return newValue;
    }

    function setPrecision (newValue) {

      if (!isDefined(newValue)) {

        return options.precision;
      }

      options.precision = newValue;

      showRating();
    }

    function calculateRating (e) {

      var position = $normalGroup.offset(),
        nodeStartX = position.left,
        nodeEndX = nodeStartX + $normalGroup.width();

      var minValue = options.minValue,
          maxValue = options.maxValue;

      var pageX = e.pageX;

      var calculatedRating;

      if(pageX < nodeStartX) {

        calculatedRating = minValue;
      }else if (pageX > nodeEndX) {

        calculatedRating = maxValue;
      }else {

        calculatedRating = ((pageX - nodeStartX)/(nodeEndX - nodeStartX));
        calculatedRating *= (maxValue - minValue);
        calculatedRating += minValue;
      }

      return calculatedRating;
    }

    function onMouseEnter (e) {

      var rating = calculateRating(e).toFixed(options.precision);

      var minValue = options.minValue,
          maxValue = options.maxValue;

      rating = checkPercision(parseFloat(rating), minValue, maxValue);

      showRating(rating);

      $node.trigger("rateyo.change", {rating: rating});
    }

    function onMouseLeave () {

      showRating();

      $node.trigger("rateyo.change", {rating: options.rating});
    }

    function onMouseClick (e) {

      var resultantRating = calculateRating(e).toFixed(options.precision);
      resultantRating = parseFloat(resultantRating);

      that.rating(resultantRating);
    }

    function onChange (e, data) {

      if(options.onChange && typeof options.onChange === "function") {

        /* jshint validthis:true */
        options.onChange.apply(this, [data.rating, that]);
      }
    }

    function onSet (e, data) {

      if(options.onSet && typeof options.onSet === "function") {

        /* jshint validthis:true */
        options.onSet.apply(this, [data.rating, that]);
      }
    }

    function bindEvents () {

      $node.on("mousemove", onMouseEnter)
           .on("mouseenter", onMouseEnter)
           .on("mouseleave", onMouseLeave)
           .on("click", onMouseClick)
           .on("rateyo.change", onChange)
           .on("rateyo.set", onSet);
    }

    function unbindEvents () {

      $node.off("mousemove", onMouseEnter)
           .off("mouseenter", onMouseEnter)
           .off("mouseleave", onMouseLeave)
           .off("click", onMouseClick)
           .off("rateyo.change", onChange)
           .off("rateyo.set", onSet);
    }

    function setReadOnly (newValue) {

      if (!isDefined(newValue)) {

        return options.readOnly;
      }

      options.readOnly = newValue;

      unbindEvents();

      if (!newValue) {

        bindEvents();
      }
    }

    function setRating (newValue) {

      if (!isDefined(newValue)) {

        return options.rating;
      }

      var rating = newValue;

      var maxValue = options.maxValue,
          minValue = options.minValue;

      if (typeof rating === "string") {

        if (rating[rating.length - 1] === "%") {

          rating = rating.substr(0, rating.length - 1);
          maxValue = setMaxValue(100);
          minValue = setMinValue(0);
        }

        rating = parseFloat(rating);
      }

      checkBounds(rating, minValue, maxValue);

      rating = parseFloat(rating.toFixed(options.precision));

      checkPercision(parseFloat(rating), minValue, maxValue);

      options.rating = rating;

      showRating();

      $node.trigger("rateyo.set", {rating: rating});
    }

    function setOnSet (method) {

      if (!isDefined(method)) {

        return options.onSet;
      }

      options.onSet = method;
    }

    function setOnChange (method) {

      if (!isDefined(method)) {

        return options.onChange;
      }

      options.onChange = method;
    }

    this.rating = function (newValue) {

      if (!isDefined(newValue)) {

        return options.rating;
      }

      setRating(newValue);

      return $node;
    };

    this.destroy = function () {

      if (!options.readOnly) {
        unbindEvents();
      }

      RateYo.prototype.collection = deleteInstance($node.get(0),
                                                   this.collection);

      $node.removeClass("jq-ry-container").children().remove();

      return $node;
    };

    this.method = function (methodName) {

      if (!methodName) {

        throw Error("Method name not specified!");
      }

      if (!isDefined(this[methodName])) {

        throw Error("Method " + methodName + " doesn't exist!");
      }

      var args = Array.prototype.slice.apply(arguments, []),
          params = args.slice(1),
          method = this[methodName];

      return method.apply(this, params);
    };

    this.option = function (optionName, param) {

      if (!isDefined(optionName)) {

        return options;
      }

      var method;

      switch (optionName) {

        case "starWidth":

          method = setStarWidth;
          break;
        case "numStars":

          method = setNumStars;
          break;
        case "normalFill":

          method = setNormalFill;
          break;
        case "ratedFill":

          method = setRatedFill;
          break;
        case "minValue":

          method = setMinValue;
          break;
        case "maxValue":

          method = setMaxValue;
          break;
        case "precision":

          method = setPrecision;
          break;
        case "rating":

          method = setRating;
          break;
        case "readOnly":

          method = setReadOnly;
          break;
        case "onSet":

          method = setOnSet;
          break;
        case "onChange":

          method = setOnChange;
          break;
        default:

          throw Error("No such option as " + optionName);
      }

      method(param);

      return options[optionName];
    };

    setNumStars(options.numStars);
    setReadOnly(options.readOnly);

    this.collection.push(this);
    this.rating(options.rating);
  }

  RateYo.prototype.collection = [];

  function _rateYo (options) {

    var rateYoInstances = RateYo.prototype.collection;

    /* jshint validthis:true */
    var $nodes = $(this);

    if($nodes.length === 0) {

      return $nodes;
    }

    var args = Array.prototype.slice.apply(arguments, []);

    if (args.length === 0) {

      //Setting Options to empty
      options = args[0] = {};
    }else if (args.length === 1 && typeof args[0] === "object") {

      //Setting options to first argument
      options = args[0];
    }else if (args.length >= 1 && typeof args[0] === "string") {

      var methodName = args[0],
          params = args.slice(1);

      var result = [];

      $.each($nodes, function (i, node) {

        var existingInstance = getInstance(node, rateYoInstances);

        if(!existingInstance) {

          throw Error("Trying to set options before even initialization");
        }

        var method = existingInstance[methodName];

        if (!method) {

          throw Error("Method " + methodName + " does not exist!");
        }

        var returnVal = method.apply(existingInstance, params);

        result.push(returnVal);
      });

      result = result.length === 1? result[0]: $(result);

      return result;
    }else {

      throw Error("Invalid Arguments");
    }

    options = $.extend(JSON.parse(JSON.stringify(DEFAULTS)), options);

    return $.each($nodes, function () {

               var existingInstance = getInstance(this, rateYoInstances);

               if (!existingInstance) {

                 return new RateYo($(this), options);
               }
           });
  }

  function rateYo () {

    /* jshint validthis:true */
    return _rateYo.apply(this, Array.prototype.slice.apply(arguments, []));
  }

  $.fn.rateYo = rateYo;

}(jQuery));


/* Javascript */
 




