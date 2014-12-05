<?php
namespace PhotoAlbum {



 

  // Sets up Cloudinary's parameters and RB's DB
  include 'settings.php';

  // Global settings
  if (array_key_exists('REQUEST_SCHEME', $_SERVER)) {
    $cors_location = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] .
        dirname($_SERVER["SCRIPT_NAME"]) . "/lib/cloudinary_cors.html";
  } else {
    $cors_location = "http://" . $_SERVER["HTTP_HOST"] . "/lib/cloudinary_cors.html";
  }

 
}

