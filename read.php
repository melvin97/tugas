<?php 
if(isset($_GET['delete_id']))
{
    require_once "db.php";
    $conn =Konek_db();
    $id = $_GET['delete_id'];
    $query =$conn ->prepare("DELETE FROM users WHERE user_id=?");
    $query->bind_param("s", $id);
    $result =$query ->execute();
    if ($result)
        header("Location: read.php");
}
 ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">
function edt_id(id)
{
 if(confirm('Yakin Mau di Edit ?'))
 {
  window.location.href='edit_data.php?edit_id='+id;
 }
}
function delete_id(id)
{
 if(confirm('Yakin Mau di Delete ?'))
 {
  window.location.href='read.php?delete_id='+id;
 }
}
</script>
</head>
<body>
<center>

<div id="body">
 <div id="content">
    <table align="center">
    <tr>
    <th colspan="5"><a href="createdata.html">Tambah Data </a></th>
    </tr>
    <th>Nama Depan </th>
    <th>Nama Belakang</th>
    <th>Nama Kota</th>
    <th colspan="2">Perintah</th>
    </tr>
    <?php
    require_once "db.php";
    $conn =Konek_db();

    $query = $conn->prepare("SELECT * FROM users");
    $result=$query->execute();
    if(! $result)
        die("gagal query");

    $rows =$query->get_result();
    while($row= $rows->fetch_array()) {
     
  ?>
        <tr>
        <td><?php echo $row['first_name']; ?></td>
        <td><?php echo $row['last_name']; ?></td>
        <td><?php echo $row['user_city']; ?></td>
        <td align="center"><a href="javascript:edt_id('<?php echo $row['user_id']; ?>')"><img src="edit.png" align="EDIT" style="width:50px;"></a></td>
        <td align="center"><a href="javascript:delete_id('<?php echo $row['user_id']; ?>')"><img src="delete.png" align="DELETE" style="width:50px;"></a></td>
        </tr>
        <?php
 }
 ?>
    </table>
    </div>
</div>

</center>
</body>
</html>