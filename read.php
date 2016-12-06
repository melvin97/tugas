<?php 
require_once "db.php";
require_once "twig.php";
if(isset($_GET['delete_id']))
{
    
    $conn =Konek_db();
    $id = $_GET['delete_id'];
    $query =$conn ->prepare("DELETE FROM users WHERE user_id=?");
    $query->bind_param("s", $id);
    $result =$query ->execute();
    if ($result)
        header("Location: read.php");
}else {
    $conn =Konek_db();

    $query = $conn->prepare("SELECT * FROM users");
    $result=$query->execute();
    if(! $result)
        die("gagal query");

    $rows =$query->get_result();
    $datas = array();
    while($row= $rows->fetch_array()) {
        $data = array("firstName" => $row['first_name'],
                      "lastName" => $row['last_name'],
                      "userCity" => $row['user_city'],
                      "userId" => $row['user_id']);
        array_push($datas, $data);

    }
    echo $twig->render("read.html", array("datas"=>$datas));
}
?>
