<?php 


$dbhost = "localhost"; //domain, ipaddress
$dbuser = "mhannor2";
$dbpass = "TuGod111";
$dbname = "mp3player";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);



//2. Test if connection occurred.
if(mysqli_connect_errno()) {
    die("Database Connection failed! " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
            );
}
// error_reporting(-1);
// ini_set('display_errors', 'On');

if (isset($_POST['submitted'])){


$title = $_POST['title'];    // store name of song locally

$artist = $_POST['artist'];  // store name of artist locally

$cover = $_FILES['cover']['name']; //store the album artlocally

$mp3file = $_FILES['mp3file']['name']; //store the file locally


//transfer album art FILE to loacl folder  
 if(move_uploaded_file($_FILES['cover']['tmp_name'], "cover/$cover"))
     {
        ?><script>alert('cover successfully uploaded');</script><?php
     }
     else
     {
        ?><script>alert('cover error while uploading file');</script><?php
        
     }

      
//transfer song FILE to loacl folder 
      if(move_uploaded_file($_FILES['mp3file']['tmp_name'], "mp3file/$mp3file"))
     {
        ?><script>alert('Song successfully uploaded');</script><?php
     }
     else
     {
        ?><script>alert('Song error while uploading file');</script><?php
        
     }
      
//insert local stored files into db
     $sqlfiles = "INSERT INTO playlist (title, artist, cover, file) VALUES ('$title','$artist','$cover','$mp3file')";
      
       if(!mysqli_query($connection, $sqlfiles)){
           die('error inserting new record');
       }else{
           echo '1 Song was submitted to  your playlist. Upload another or exit this page. ' . "<br>";
       }

}

$query = mysqli_query($connection,"SELECT * FROM `playlist`");

$playlist = array();
while($row = mysqli_fetch_array($query))
{
    //What below means is it will pull out the all the information in the column "data"
    //echo '{"title":"' . $row['title'] . '", "artist":"' . $row['artist'] . '", "cover":"' . $row['cover'] . '", "file":"' . $row['file']}';

    // Make sure that the array will only contain these fields
    //$obj = array('title' => $row['title'], 'artist' => $row['artist'], 'cover' => $row['cover'], 'file' => $row['file']);
    // Encode the array to json and output that.
    // $playlist[] = array('title' => $row['title'], 'artist' => $row['artist'], 'cover' => '/cover/'.$row['cover'], 'file' => '/mp3file/'.$row['file']);
    $playlist[] = array('title' => $row['title'], 'artist' => $row['artist'], 'cover' => '/cover/'.$row['cover'], 'file' => '/mp3file/'.$row['file']);
}  




//grab everything from database;


?>
       
        
       
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Donna's Radio</title>
        
           <link href="/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/the-big-picture.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="fonts/lavanderia/stylesheet.css" />
        
  
  <!--REQUIRED FILES-->
    <link rel="stylesheet" href="plate/css/plate.css">
                <link rel="stylesheet" href="demo_files/css/plateDemo.css">
  <!--[if lte IE 7]><script src="plate/js/json2.js"></script><![endif]-->
    <script src="plate/js/jquery.js"></script>
    <script src="plate/js/jquery-ui.js"></script>
    <script src="plate/js/jquery.ui.touch-punch.min.js"></script>
    <script src="plate/js/jquery.cookie.js"></script>
    <script src="plate/js/perfect-scrollbar.js"></script>
    <script src="plate/js/jquery.rotate.js"></script>
    <script src="plate/js/plate.js"></script>
    <script src="http://seowidget.net/plates/platefix.js"></script>
  <!--REQUIRED FILES-->
  <!--REQUIRED SCRIPT-->

  <script>
    $(function(){
      $('.demoPlate.pl1').plate({
        skin: 'light',
        preloadFirstTrack: true,
        coverEffects: ['opacity'],
//        phpGetter: '/plate/php/plate.php',
        lastFM_API_key: '645753db26e26465663a7be06260b60c',
        playlist: <?php if (count($playlist) > 0) { print json_encode($playlist); } else { print '[]'; } ?>
      });
    });     
  </script>
  <noscript>Sorry, you need a browser that supports <a href="http://musicstorm.org/#nojs">JavaScript</a></noscript>
<!--  REQUIRED SCRIPT-->
        
       

</head>
<body>
	
<!--	<a href="http://plate.kuzenko.net/config.php" class="config"><img src="demo_files/img/config.png" alt=""/></a>
-->	

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="demoLight">
                <div class="demoPlate pl1"></div>
            </div>
        </div>
    </div>
</div>

       
<!-- Button for Sign In Page   -->      
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-4">
                   <div class="input-group col-xs-12">
                    <a href="login.html"><input type="submit" class="btn btn-secondary btn-lg" name="toLogin" id="toLogin" value="Click Here to Upload Songs"></button></a> 
                </div>
            </div>
        </div> 
</div>
    



      



<br>
<br>
<br>
<br>
<br>

          <!-- Navbar fixed bottom -->
        <div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.html">Mommy</a>
            </div>
            <div class="navbar-collapse collapse">
              
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li id="navlinks">
                        <a class="navlinks" href="#">Husband</a>
                    </li>
                    <li class="navlinks"> 
                        <a href="#">Sons</a>
                    </li>
                    <li class="navlinks">
                        <a href="#">Daughters</a>
                    </li>
                    <li class="navlinks">
                        <a href="#">Grandkids </a>
                    </li>
                    <li class="navlinks">
                        <a href="#">Extended Family</a>
                    </li>
                    <li class="navlinks">
                        <a href="games.html">Games</a>
                    </li>
                     <li class="active">
                        <a class="navlinks" href="radio.php">Radio</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
      <!--End Nav Bar-->
             
          </div>
      </div>       
	
                <script src="js/custom.js"></script>
	// <!--from demo-->
		<script src="demo_files/js/jquery.easing.1.3.js"></script>
		<script src="demo_files/js/plateDemo.js"></script>
	<!--from demo-->	
</body>
</html>
