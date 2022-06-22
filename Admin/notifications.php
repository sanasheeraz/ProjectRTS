<?php
include('../Database/config.php');
$db=new Database();

if(isset($_POST['view'])&&isset($_POST['sender'])){
// $con = mysqli_connect("localhost", "root", "", "notif");

if($_POST["view"] != ''&&$_POST["sender"] != '')
{
    $query="";
    if($_POST['sender']=='dr')
    {
        $query="UPDATE dropshipper SET d_notify='Yes' WHERE d_notify='No'";
    }
    if($_POST['sender']=='wr')
    {
        $query="UPDATE wholeseller SET w_notify='Yes' WHERE w_notify='No'";
    }
    if($_POST['sender']=='do')
    {
        $query="UPDATE dropshipper_order SET do_notify='Yes' WHERE do_notify='No'";
    }
    if($_POST['sender']=='wo')
    {
        $query="UPDATE wholeseller_order SET wo_notify='Yes' WHERE wo_notify='No'";
    }
    mysqli_query($db->conn,$query);
}
$d_result = $db->select('dropshipper','*',"d_notify='No'");
$d_count = mysqli_num_rows($db->sql);
$do_result = $db->select('dropshipper_order','*',"do_notify='No'");
$do_count = mysqli_num_rows($db->sql);
$w_result = $db->select('wholeseller','*',"w_notify='No'");
$w_count = mysqli_num_rows($db->sql);
$wo_result = $db->select('wholeseller_order','*',"wo_notify='No'");
$wo_count = mysqli_num_rows($db->sql);
$data = array(
    'dropshipper_count' => $d_count,
    'wholeseller_count'  => $w_count,
    'dropshipper_order_count' => $do_count,
    'wholeseller_order_count'  => $wo_count
);

echo json_encode($data);

}

?>