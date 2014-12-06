
<div class="row">

<script type="text/javascript">

    $(function()
    {
        $("#f_elem_city").autocomplete({
            source: function (request, response) {
                $.getJSON(
                    "http://gd.geobytes.com/AutoCompleteCity?callback=?&q="+request.term,
                    function (data) {
                        response(data);
                    }
                );
            },
            minLength: 3,
            select: function (event, ui) {
                var selectedObj = ui.item;
                jQuery("#f_elem_city").val(selectedObj.value);
                getcitydetails(selectedObj.value);
                return false;
            },
            open: function () {
                jQuery(this).removeClass("ui-corner-all").addClass("ui-corner-top");
            },
            close: function () {
                jQuery(this).removeClass("ui-corner-top").addClass("ui-corner-all");
            }
        });
        jQuery("#f_elem_city").autocomplete("option", "delay", 100);


    function getcitydetails(fqcn) {

        if (typeof fqcn == "undefined") fqcn = jQuery("#f_elem_city").val();

        cityfqcn = fqcn;

        if (cityfqcn) {

            $.getJSON(
                "http://gd.geobytes.com/GetCityDetails?callback=?&fqcn="+cityfqcn,
                function (data) {
                    $("#geobytesinternet").val(data.geobytesinternet);

                    if (data.geobytesinternet == 'US') {

                        var trim = data.geobytesregionlocationcode.slice(2)
                        $("#geobytesregionlocationcode").val(trim);
                        $("#geobytescountry").val("");

                    } else {
                        $("#geobytescountry").val(data.geobytescountry);
                    }


                    //$("#geobytescountry").val(data.geobytescountry);

                    $("#geobytesregion").val(data.geobytesregion);
                    $("#geobyteslocationcode").val(data.geobyteslocationcode);
                    $("#geobytescity").val(data.geobytescity);
                    $("#geobytesmapreference").val(data.geobytesmapreference);
                    $("#geobytesfqcn").val(data.geobytesfqcn);

                }
            );
        }
    }

    });
</script>





     <!-- A standard form for sending the image data to your server -->
    <div id='backend_upload'>

        <div class="row text-center">
            <!--

      <h1 class="text-center">Upload Image</h1>
           <div class="medium-12">
               <h4>Enter city</h4>
           </div>

           <div class="medium-12 large-9 large-centered columns">
               <input class="form-control ff_elem" type="text" value="" id="f_elem_city"/>
           </div>
           -->
        </div>

      
      <form class="form-horizontal" action="image/upload_backend.php" method="post" enctype="multipart/form-data">
          <div class="row">
              <div class="col-xs-2">
                  <!--
                  <label for="inputEmail3" class="col-sm-2 control-label">City</label>
                  -->
                  <input type="hidden" value="" id="geobytescity" name="city" class="form-control" ng-model="location">
              </div>
              <div class="col-xs-2">
                  <!--
                  <label for="inputEmail3" class="col-sm-2 control-label">State</label>
                  -->
                  <input type="hidden" id="geobytesregionlocationcode" name="state" class="form-control">
              </div>
              {{result}}
              <div class="col-xs-3">
                  <!--
                  <label for="inputEmail3" class="col-sm-2 control-label">Country</label>
                    -->
                  <input type="hidden" id="geobytescountry" value="" name="country" class="form-control" id="inputEmail3" placeholder="Country">
              </div>
              <div class="col-xs-3">
                  <!--
                  <label for="inputEmail3"  class="col-sm-2 control-label">Region</label>
                  -->
                  <input type="hidden" id="geobytesmapreference" value="" name="region" class="form-control" id="inputEmail3" placeholder="Region">
              </div>
          </div>


          <div class="row">
           
         
             <div class="large-4 columns">

                 <!--
                 <div class="row">
                     <label></label>
                     <a href="" class="btn" ng-click="addImage()">Add Image</a>

                 </div>
                 -->

                    <!--
                      <div ng-repeat="todo in todos" class="col-md-4">
                        -->
                 <h4>Direct Upload</h4>

                        <input id="fileupload" type="file" name="files[]" accept="image/gif, image/jpeg, image/png">
                        <img id="imageupload" src="#" />
                <p>City
                 <input class="form-control ff_elem" type="text" value="" id="f_elem_city"/>
                </p>

                 <p>Category
                        <select name="category[]" class="form-control">
                          <option value="People">People</option>
                          <option value="Architecture">Architecture</option>
                          <option value="Food">Food</option>
                          <option value="Sports">Sports</option>
                          <option value="Animals">Animals</option>
                          <option value="Nature">Nature</option>
                          <option value="Other">Other</option>
                        </select>
                 </p>
                 <p>Vibe
                        <select name="vibe[]" class="form-control">
                            <option value="">Vibes</option>
                            <option value="Happy"> Happy</option>
                            <option value="Sad"> Sad</option>
                            <option value="Beautiful"> Beautiful</option>
                            <option value="Hot"> Hot</option>
                            <option value="Cold"> Cold</option>
                            <option value="Cute"> Cute</option>
                            <option value="Ugly"> Ugly</option>
                            <option value="Peace"> Peace</option>
                            <option value="Noise"> Noise</option>
                            <option value="Exciting"> Exciting</option>
                            <option value="Dull"> Dull</option>
                            <option value="Romantic"> Romantic</option>
                            <option value="Heartbreaking"> Heartbreaking</option>
                            <option value="Funny"> Funny</option>
                            <option value="Serious"> Serious</option>
                            <option value="Luxury"> Luxury</option>
                            <option value="Simplicity"> Simplicity</option>
                            <option value="Mysterious"> Mysterious</option>
                            <option value="Other"> Other</option>
                       </select>
                 </p>

                        <input type="checkbox" name="status[]" value="Y" checked="checked">
                <p>Caption
                        <textarea name="caption" class="form-control"></textarea>
                </p>

             </div>

            <div class="large-4 columns instagram">
                <h4>Instagram</h4>
                <div>
                    <label>Your Username:</label>
                    <input type="text" ng-model="user" class="form-control" placeholder="Enter your username here">
                    <button type="button" class="btn btn-default" ng-click="search(user)">Search</button>
                </div>
                    <div>
                        <!-- A compact view smaller photos and titles -->
                        <div ng-repeat="p in pics" class="col-md-4">

                            <img ng-src="{{p.images.low_resolution.url}}" class="img-instagram">
                            <select name="category[]" class="form-control">
                                <option value="People">People</option>
                                <option value="Architecture">Architecture</option>
                                <option value="Food">Food</option>
                                <option value="Sports">Sports</option>
                                <option value="Animals">Animals</option>
                                <option value="Nature">Nature</option>
                                <option value="Other">Other</option>
                            </select>

                            <br>

                            <select name="vibe[]" class="form-control">
                                <option value="">Vibes</option>
                                <option value="Happy"> Happy</option>
                                <option value="Sad"> Sad</option>
                                <option value="Beautiful"> Beautiful</option>
                                <option value="Hot"> Hot</option>
                                <option value="Cold"> Cold</option>
                                <option value="Cute"> Cute</option>
                                <option value="Ugly"> Ugly</option>
                                <option value="Peace"> Peace</option>
                                <option value="Noise"> Noise</option>
                                <option value="Exciting"> Exciting</option>
                                <option value="Dull"> Dull</option>
                                <option value="Romantic"> Romantic</option>
                                <option value="Heartbreaking"> Heartbreaking</option>
                                <option value="Funny"> Funny</option>
                                <option value="Serious"> Serious</option>
                                <option value="Luxury"> Luxury</option>
                                <option value="Simplicity"> Simplicity</option>
                                <option value="Mysterious"> Mysterious</option>
                                <option value="Other"> Other</option>
                            </select>

                            <button type="button" class="btn btn-primary btn-radio">Check</button>
                            <input type="checkbox" name="instagram[]" value="{{p.images.standard_resolution.url}}">

                            <p><input id="public" type="checkbox" name="status[]" value="Y">Public</p>


                        </div>

                </div>

            </div>

         

          </div>
           <div class="row">
              <div class="col-md-12 text-center">
                <label></label>
                  <br>
                <input type="submit" class="btn btn-lg btn-image-submit" value="Upload">
              </div>
           </div>
        </form>
    </div>

</div>
        <script>

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imageupload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#fileupload").change(function(){
                readURL(this);
            });

            //http://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded

        </script>

