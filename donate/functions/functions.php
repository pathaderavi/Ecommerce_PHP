<?php
/**
 * Created by PhpStorm.
 * User: ravikiranpathade
 * Date: 3/28/16
 * Time: 1:15 AM
 */

$con = mysqli_connect("localhost","cl60-eschoppe","root","cl60-eschoppe");
$total = 0;

function getCats(){
    global $con;

    $get_cats = "select * from categories";
    $run_cats =mysqli_query($con,$get_cats);

    while($row_cats=mysqli_fetch_array($run_cats)){
        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];
        echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a> ";

    }

}

function getBrands(){
    global $con;

    $get_brands = "select * from brands";
    $run_brands =mysqli_query($con,$get_brands);

    while($row_brands=mysqli_fetch_array($run_brands)){
        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];
        echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a> ";
    }

}
/*
function getPro()
{
    global $con;
    $get_pro = "select * from products ORDER by RAND() LIMIT 0,6";
    $run_pro = mysqli_query($con, $get_pro);

    while ($row_pro = mysqli_fetch_array($run_pro)) {
        $pro_id = $row_pro['product_id'];
        $pro_cat = $row_pro['product_cat'];
        $pro_brand = $row_pro['product_brand'];
        $pro_title = $row_pro['product_title'];
        $pro_price = $row_pro['products_price'];
        $pro_image = $row_pro['product_image'];
        //$pro_id = $row_pro['product_id'];


        echo "
        <div id='single_product'>
        <h3>$pro_title</h3>
        <img src='admin_area/product_images/$pro_image' width='180px' height='180px'/>
        <p><b>$ $pro_price</b></p>
        <a href='details.php?pro_id=$pro_id'>View Product</a>
        <a href='index.php'><button style='float:right'> Add to Cart</button></a>
             
        </div>
        
        ";
    }
*/
    function getPro()
    {
        if (!isset($_GET['cat'])) {
            if (!isset($_GET['brand'])) {
                global $con;
                $get_pro = "select * from products ORDER by RAND() LIMIT 0,6";
                $run_pro = mysqli_query($con, $get_pro);

                while ($row_pro = mysqli_fetch_array($run_pro)) {
                    $pro_id = $row_pro['product_id'];
                    $pro_cat = $row_pro['product_cat'];
                    $pro_brand = $row_pro['product_brand'];
                    $pro_title = $row_pro['product_title'];
                    $pro_price = $row_pro['products_price'];
                    $pro_image = $row_pro['product_image'];
                    //$pro_id = $row_pro['product_id'];


                    echo "
        <div id='single_product'>
        <h3>$pro_title</h3>
        <img src='admin_area/product_images/$pro_image' width='180px' height='180px'/>
        <p><b>$ $pro_price</b></p>
        <a href='details.php?pro_id=$pro_id'>View Product</a>
        <a href='index.php?add_cart=$pro_id'><button style='float:right'> Add to Cart</button></a>
             
        </div>
        
        ";
                }
            }
        }


}
function getCatPro()
{
    if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];

            global $con;
            $get_cat_pro = "select * from products where product_cat ='$cat_id'";
            $run_cat_pro = mysqli_query($con, $get_cat_pro);
            $count_cats = mysqli_num_rows($run_cat_pro);
            if($count_cats==0){
                echo "<h2 style='padding: 20px'>There are no products in this Category.</h2>";
            }
            while ($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {
                $pro_id = $row_cat_pro['product_id'];
                $pro_cat = $row_cat_pro['product_cat'];
                $pro_brand = $row_cat_pro['product_brand'];
                $pro_title = $row_cat_pro['product_title'];
                $pro_price = $row_cat_pro['products_price'];
                $pro_image = $row_cat_pro['product_image'];
                //$pro_id = $row_pro['product_id'];
                echo "
        <div id='single_product'>
        <h3>$pro_title</h3>
        <img src='admin_area/product_images/$pro_image' width='180px' height='180px'/>
        <p><b>$ $pro_price</b></p>
        <a href='details.php?pro_id=$pro_id'>View Product</a>
        <a href='index.php'><button style='float:right'> Add to Cart</button></a>
             
        </div>
        
        ";
            }

        }



}
function getBrandPro()
{
    if(isset($_GET['brand'])) {
        $cat_id = $_GET['brand'];

        global $con;
        $get_brand_pro = "select * from products where product_brand ='$brand_id'";
        $run_brand_pro = mysqli_query($con, $get_brand_pro);
        $count_brands = mysqli_num_rows($run_brand_pro);
        if($count_brands==0){
            echo "<h2 style='padding: 20px'>There are no products with this Brand.</h2>";
        }
        while ($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {
            $pro_id = $row_brand_pro['product_id'];
            $pro_cat = $row_brand_pro['product_cat'];
            $pro_brand = $row_brand_pro['product_brand'];
            $pro_title = $row_brand_pro['product_title'];
            $pro_price = $row_brand_pro['products_price'];
            $pro_image = $row_brand_pro['product_image'];
            //$pro_id = $row_pro['product_id'];
            echo "
        <div id='single_product'>
        <h3>$pro_title</h3>
        <img src='admin_area/product_images/$pro_image' width='180px' height='180px'/>
        <p><b>$ $pro_price</b></p>
        <a href='details.php?pro_id=$pro_id'>View Product</a>
        <a href='index.php'><button style='float:right'> Add to Cart</button></a>
             
        </div>
        
        ";
        }

    }
}

function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    return $ip;
}


function cart(){
    global $con;

    if(isset($_GET['add_cart'])){
            $ip = getIp();
            $pro_id = $_GET['add_cart'];
            $check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
            $run_check = mysqli_query($con,$check_pro);
        if(mysqli_num_rows($run_check)>0){
            echo "";
        }else{
            $insert_pro = "insert into cart(p_id,ip_add) values('$pro_id','$ip')";
            $run_pro = mysqli_query($con,$insert_pro);

        }
        }


}

function total_items(){

    global $con;
    if(isset($_GET['add_cart'])){


        $ip = getIp();
        $get_items = "select * from cart where ip_add='$ip'";
        $run_items = mysqli_query($con,$get_items);
            $count_items = mysqli_num_rows($run_items);{

            }
    }else{
        $ip = getIp();
        $get_items = "select * from cart where ip_add='$ip'";
        $run_items = mysqli_query($con,$get_items);
        $count_items = mysqli_num_rows($run_items);
    }
echo $count_items;

}

function total_price(){

    $total = 0;

    global $con;

    $ip = getIp();{

    $sel_price = "select * from cart where ip_add='$ip'";

    $run_price = mysqli_query($con, $sel_price);

    while($p_price=mysqli_fetch_array($run_price)){

        $pro_id = $p_price['p_id'];

        $pro_price = "select * from products where product_id='$pro_id'";

        $run_pro_price = mysqli_query($con,$pro_price);

        while ($pp_price = mysqli_fetch_array($run_pro_price)){

            $product_price = array($pp_price['products_price']);

            $values = array_sum($product_price);

            $total =$total+ $values;
            $r = $_SESSION['customer_email'];
            #echo $r;
            $sql_toid = "SELECT customer_id from customers where customer_email='$r'";
            $run_toid = mysqli_query($con,$sql_toid);
            $row_toid = mysqli_fetch_row($run_toid);

            $toid = $row_toid[0];



            $sql_rew =  "SELECT SUM(amount) FROM payments where customer_id='$toid'";
            $run_rew = mysqli_query($con,$sql_rew);
            $row_rew = mysqli_fetch_row($run_rew);
            $res_rew = $row_rew[0]/20;

            $sel_erew = "select points from customers where customer_id='$toid'";
            $run_erew = mysqli_query($con,$sel_erew);
            $row_erew = mysqli_fetch_row($run_erew);
            $res_erew = $row_erew[0];
            $av_rew = $res_rew-$res_erew;

            if(isset($_GET['rw'])){

                #echo"<script>alert('$res_erew')</script>";
                $total= $total+ $res_erew-$res_rew;


            }

        }


    }

    echo "$" . $total;}


}
/*
function total_price(){     //done
    global $con;
    //global $total;
    //$total = 0;
    $ip = getIp(); //done
    $sel_price = "select * from cart where ip_add='$ip'";//done
    $run_price = mysqli_query($con,$sel_price);//done
    while($p_price=mysqli_fetch_array($run_price)){         //done

        $pro_id = $p_price['p_id'];     //done
        $pro_price = "select * from products WHERE product_id='$pro_id'";
        $run_pro_price = mysqli_query($con,$pro_price);
        while($pp_price = mysqli_fetch_array($run_pro_price))
        {
            $product_price = array($pp_price['product_price']);
            $values = array_sum($product_price);
            $total += $values;
        }

    }
    echo "$ ".$total;
    }
*/