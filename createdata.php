<?php
require_once "db.php";


if(isset($_POST['btn-save']))
{
	$conn = konek_db();

 $first_name = $_POST['first_name'];
 $last_name = $_POST['last_name'];
 $city_name = $_POST['city_name'];


 	$query = $conn->prepare("INSERT INTO users(first_name,last_name,user_city) VALUES(?, ?, ?)");
    $query->bind_param("sss", $first_name,$last_name,$city_name);
    $result = $query->execute();
    if (! $result)
        die("<p>Proses query gagal.</p>");

    header("Location:read.php");
} else {
    echo "<p>Data produk belum diisi!</p>";
}
        
      

?>