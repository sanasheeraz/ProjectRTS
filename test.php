<?php 
$number=10;
$twenty_dis=10;
$ten_dis=20;
$thrty=30;
$pro_price=100;
$f1=0;

$f2=0;
echo "Total Product : ".$number;
echo "<br>";
echo "Product price : ".$pro_price;
echo "<br>";
echo "Total price : ".$pro_price*$number;
if( floor($number/30) > 0)
{
$complete=$number/30;
$whole=floor($number/30);
$fraction = $complete - $whole;

// echo $whole;
// echo $fraction;
$num = 30*$whole;
$product_qprice1=$num * $pro_price;
echo "<br>";
// echo $product_qprice1;
echo "<br>";

// echo (($product_qprice1 * $thrty)/100)."prp";
$f1= $product_qprice1-(($product_qprice1 * $thrty)/100);
echo "Final Prce For ".$num." Product is ".$f1;
if(($whole*30) + ($number-$num) == $number)
{
    echo "<br>";

    $sec= (($fraction*30) );
    echo $sec;
    echo "<br>";

    if($sec == 20)
    {
        $product_qprice2 = $sec * $pro_price;
        $dis2=($product_qprice2 * $twenty_dis)/100;
        $f2=$product_qprice2-$dis2;
       
    }   
    else
    {
        $product_qprice2 = $sec * $pro_price;
        $dis2=($product_qprice2 * $ten_dis)/100;
        $f2=$product_qprice2-$dis2;
    }
    echo "Final Prce For ".$sec." Product is ".$f2;

}
}
elseif ( floor($number/20) > 0)
{
    $product_qprice2 = 20 * $pro_price;
    $dis2=($product_qprice2 * $twenty_dis)/100;
    $f2=$product_qprice2-$dis2;
echo "20";
}
else
{
    $product_qprice2 = 10 * $pro_price;
    $dis2=($product_qprice2 * $ten_dis)/100;
    $f2=$product_qprice2-$dis2;
echo "10";
}
echo "<br>";

echo "Total Price After Discount ".$f1+$f2;

?>