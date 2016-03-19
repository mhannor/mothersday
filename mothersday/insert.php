<?php 
//1. Create a database connection
$dbhost = "localhost"; //domain, ipaddress
$dbuser = "mhannor";
$dbpass = "TuGod111";
$dbname = "songs";
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//2. Test if connection occurred.
if(mysqli_connect_errno()) {
    die("Database Connection failed! " .
            mysqli_connect_error() .
            " (" . mysqli_connect_errno() . ")"
            );
}
        


?>



<?php
//2. Perform database query

$query = "select * ";
$query .= "from subjects ";
//$query .= "where visible = 1 ";
$query .= "order by position asc";
$result = mysqli_query($connection, $query);
if (!$result) {
    die("Databse query failed or you have no info in your table.");
}
?>



<?php
if(isset($_POST['btn-upload']))
{
     $mp3 = rand(1000,100000)."-".$_FILES['mp3']['name'];
    $mp3_loc = $_FILES['mp3']['tmp_name'];
     $folder="mp3/";
     if(move_uploaded_file($mp3_loc,$folder.$mp3))
     {
        ?><script>alert('successfully uploaded');</script><?php
     }
     else
     {
        ?><script>alert('error while uploading file');</script><?php
     }
}

?>
        

    
<!DOCTYPE html>

<?php
    //Release returned data
    mysqli_free_result($result);
?>


<?php 
    //Close database connection
    mysqli_close($connection);
?>