
<div class="row">

     <!-- A standard form for sending the image data to your server -->
    <div id='backend_upload'>

        

        <div class="btn-group btn-group-justified text-center" role="group" aria-label="...">
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary" ng-click="active='direct'">Direct Upload</a>
          </div>
          <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning" ng-click="active='instagram'">Instagram</button>
          </div>
       
        </div>

      
      <form class="form-horizontal" action="image/upload_backend.php" method="post" enctype="multipart/form-data">
          


          <div class="row">


            <!-- DIRECT -->
             <div class="large-8 large-centered columns" ng-show="active == 'direct'">

                    <!--
                     <div class="row">
                     <label></label>
                     <a href="" class="btn" ng-click="addImage()">Add Image</a>

                 </div>
                
                      <div ng-repeat="todo in todos" class="col-md-4">
                        -->
                 <h2 class="text-center">Direct Upload</h2>

                        <input id="fileupload" type="file" name="files[]" accept="image/gif, image/jpeg, image/png">
                        <img id="imageupload" src="#" />
                
                 <p>Caption
                        <input type="text" name="caption" class="form-control">
                </p>

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
            

                        
               

             </div>


            <!-- INSTAGRAM -->
            <div class="large-12 columns instagram" ng-show="active == 'instagram'">
                <h2 class="text-center">Instagram</h2>
                
                <div class="large-7 large-centered columns">
                <p class="text-center">Please enter in your correct username and check all of the images you want to upload.</p>
                    <div class="row">
                      <input type="text" ng-keypress="preventEnter($event, user)" ng-model="user" class="form-control large-9 columns" placeholder="Enter your username here">
                      <button type="button" class="btn btn-info btn-default large-3 columns" ng-click="search(user)">Search</button>
                    </div>
                </div>
                    <div>
                        <!-- A compact view smaller photos and titles -->
                        <div ng-repeat="p in pics" class="col-md-4 col-xs-2 col">

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
                <input type="submit" class="btn btn-lg btn-image-submit btn-success" value="Upload">
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

