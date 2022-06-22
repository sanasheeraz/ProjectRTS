<?php
session_start();
if(isset($_POST['save']))
{
	foreach($_POST['indexes'] as $key) {
		//echo $_POST['qty_'.$key];
		$_SESSION['qty_array'][$key]=$_POST['qty_'.$key];

	}

	echo $_SESSION['qty_array'][$key];
	$_SESSION['message']='Cart updated successfully';
	echo "<script>
    window.location = 'mycart.php';
</script>";
}
?>