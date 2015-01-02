
<div class="row">

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


         
             <div class="large-4 large-push-2 columns">

                 <!--
                 <div class="row">
                     <label></label>
                     <a href="" class="btn" ng-click="addImage()">Add Image</a>

                 </div>
                 -->

                    <!--
                      <div ng-repeat="todo in todos" class="col-md-4">
                        -->
                 <h2>Direct Upload</h2>

                        <input id="fileupload" type="file" name="files[]" accept="image/gif, image/jpeg, image/png">
                        <img id="imageupload" src="#" />
               

                 <p>Category
                        <select name="category[]" class="form-control">
                          <option value="Street">Street</option>
                          <option value="Architecture">Architecture</option>
                          <option value="Landscape">Landscape</option>
                          <option value="Sports">Sports</option>
                          <option value="Wildlife">Wildlife</option>
                          <option value="Nature">Nature</option>
                          <option value="Aerial">Aerial</option>
                          <option value="People">People</option>
                          <option value="Portrait">Portrait</option>
                          <option value="Macro">Macro</option>
                          <option value="Other">Other</option>
                        </select>
                 </p>
            

                        
                <p>Caption
                        <textarea name="caption" class="form-control"></textarea>
                </p>

             </div>

            <div class="large-4 large-pull-2 columns instagram">
                <h2>Instagram</h2>
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
                                <option value="Street">Street</option>
                                <option value="Architecture">Architecture</option>
                                <option value="Landscape">Landscape</option>
                                <option value="Sports">Sports</option>
                                <option value="Wildlife">Wildlife</option>
                                <option value="Nature">Nature</option>
                                <option value="Aerial">Aerial</option>
                                <option value="People">People</option>
                                <option value="Portrait">Portrait</option>
                                <option value="Macro">Macro</option>
                                <option value="Other">Other</option>
                            </select>

                            <br>

                            <input type="checkbox" name="instagram[]" value="{{p.images.standard_resolution.url}}">

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

