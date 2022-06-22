<?php
session_start();
include('Database/config.php');
$b = new Database();
$total =0;
if(isset($_SESSION['customer']) )
{
	if(!in_array($_GET['id'],$_SESSION['cart']))
	{
		array_push($_SESSION['cart'], $_GET['id']);
        array_push($_SESSION['qty_array'], 1);
		$_SESSION['message']='Product added to the cart';
		$sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
		$result=$b->conn->query($sql);
		$index=0;
		while ($row = mysqli_fetch_assoc($result)) {
			$total += $_SESSION['qty_array'][$index] * $row['pro_price'];
		}
		$_SESSION['total_price'] = $total;
		print_r($_SESSION['total_price']);
		header('location:products.php?addedtocart=TRUE');

	}
	else
	{
		$_SESSION['message']='Product already in cart';
		header('location:products.php?already=True');
	}
}
elseif(isset($_SESSION['dropshipper']))
{
	if(!in_array($_GET['id'],$_SESSION['cart']))
	{
		array_push($_SESSION['cart'], $_GET['id']);
        array_push($_SESSION['qty_array'] , 1);
		$d_id=$_SESSION['dropshipper'];
		$qu="SELECT * FROM `dropshipper` WHERE `d_id`=$d_id";
		$res=$b->conn->query($qu);
		$r=mysqli_fetch_assoc($res);
	
		$_SESSION['message']='Product added to the cart';
		$sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
		$result=$b->conn->query($sql);
		
		$index=0;
		while ($row = mysqli_fetch_assoc($result)) {
		$pr=$row['pro_price']-$row['pro_price']*($r['d_discount_per']/100);
			$total += $_SESSION['qty_array'][$index] * $pr;
		}
		$_SESSION['total_price'] = $total;
		print_r($pr);
		header('location:products.php?addedtocart=TRUE');

	}
	else
	{
		$_SESSION['message']='Product already in cart';
		header('location:products.php?already=True');
	}
}
elseif(isset($_SESSION['wholeseller']))
{
	if(!in_array($_GET['id'],$_SESSION['cart']))
	{
		array_push($_SESSION['cart'], $_GET['id']);
        array_push($_SESSION['qty_array'], 10);
		$_SESSION['message']='Product added to the cart';
		$sql = "SELECT * FROM product WHERE pro_id IN (" . implode(',', $_SESSION['cart']) . ")";
		$result=$b->conn->query($sql);
		$index=0;
		while ($row = mysqli_fetch_assoc($result)) {
			$total += $_SESSION['qty_array'][$index] * $row['pro_price'];
		}
		$_SESSION['total_price'] = $total;
		print_r($_SESSION['total_price']);
		header('location:products.php?addedtocart=TRUE');

	}
	else
	{
		$_SESSION['message']='Product already in cart';
		header('location:products.php?already=True');
	}
}else{

	header("location:login-register.php");
}

?>