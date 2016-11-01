<?php
if(isset($_GET['edit_id']))
{
    require_once "db.php";
    $conn =Konek_db();
    $id = $_GET['edit_id'];
    $query = $conn->prepare("SELECT * FROM users WHERE user_id=?");
    $query->bind_param("s", $id);
    $result=$query->execute();
    $rows =$query->get_result();
    $data= $rows->fetch_object();
}
if(isset($_POST['btn-update']))
{
 $first_name = $_POST['first_name'];
 $last_name = $_POST['last_name'];
 $city_name = $_POST['city_name'];
$query = $conn->prepare("UPDATE users SET first_name=?,last_name=?,user_city=? WHERE user_id=?");
$query->bind_param("sssi", $first_name, $last_name, $city_name, $id);
$result =$query ->execute();

if ($result)
    header("Location:read.php");
else
    echo"<p> gagal mengupdate data produk</p>";
}
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>

<div id="body">
 <div id="content">
    <form method="post">
    <table align="center">
    <tr>
    <td><input type="text" name="first_name" placeholder="First Name" value="<?php echo $data->first_name; ?>" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="last_name" placeholder="Last Name" value="<?php echo $data->last_name; ?>" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="city_name" placeholder="City" value="<?php echo $data->user_city; ?>" required /></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="btn-update"><strong>UPDATE</strong></button>
    </td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center>
</body>
</html>