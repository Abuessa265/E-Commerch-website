<?php
include('const/connection.php');


function getFeaturedProduct()
{
  global $con;
  $sql = "select * from `product` order by p_date desc limit 4";
  $res = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($res)) {
    $id = $row['p_id'];
    $product_name = $row['p_name'];
    $product_image = $row['p_img1'];
    $product_details = $row['p_details'];
    $product_price = $row['p_price'];
    echo '<div class="col-4" style="background:#F1F1F1; border-radius:10px">
                      <center><a href="product_details.php?p_id=' . $id . '"><img class="img-thumbnail" style="background:#F1F1F1;width: 200px;height: 200px;object-fit:contain; margin: 10px 10px !important" src=product_img/' . $product_image . ' /></a></center>
                      <div class="p-info">
                      <h4 style="font-weight:bold; font-size:16px; text-transform: uppercase">' . $product_name . '</h4>
                      <div class=""> 
      <h6 style="font-weight:lighter">' . $product_details . '</h6>
    </div>
                      <p>' . CURRENCY . '.' . $product_price . '</p>
                      </div>
                      
                      <center><a href="add_to_cart.php?add_to_cart=' . $id . '" class="btn" style="margin-top:10px">Add to cart</a></center>
                    
                    </div>';
  }
}

// fetch item from latest product table
function getLatestProduct()
{
  global $con;
  $sql = "select * from `latest_product`";
  $res = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($res)) {
    $id = $row['id'];
    $product_name = $row['name'];
    $product_image = $row['image'];
    $product_details = $row['details'];
    $product_price = $row['price'];
    echo '<div class="col-4">
    <center><img class="product_details.php?p_id=' . $id . '" style="background:#F1F1F1; float: center;width: 250px;height: 250px;object-fit: cover; object-fit:contain; !important" src=' . $product_image . ' /></center>
    <h4 style="font-weight:bold; font-size:16px; text-transform: uppercase">' . $product_name . '</h4>
    <div class=""> 
      <h6 style="font-weight:lighter">' . $product_details . '</h6>
    </div>
    <p>' . CURRENCY . '.' . $product_price . '</p>
    <div>
    <a href="add_to_cart.php?add_to_cart=' . $id . '" class="btn">Add to cart</a>
    </div>
    </div>';
  }
}

function IteminLatestProduct()
{
  global $con;
  $sql = "select * from `latest_product`";
  $res = mysqli_query($con, $sql);
  $count = mysqli_num_rows($res);

  return $count;
}

function getAllProduct()
{
  global $con;
  $sql = "select * from `product` order by rand() limit 12";
  $res = mysqli_query($con, $sql);
  while ($row = mysqli_fetch_array($res)) {
    $id = $row['p_id'];
    $product_name = $row['p_name'];
    $product_image = $row['p_img1'];
    $product_details = $row['p_details'];
    $product_price = $row['p_price'];
    echo '<div class="col-4">
      <center><img class="" style="background:#F1F1F1; float: center;width: 250px;height: 250px;object-fit: cover; object-fit:contain; !important" src=product_img/' . $product_image . ' /></center>
      <h4 style="font-weight:900; text-transform: uppercase">' . $product_name . '</h4>
      <div class=""> 
        <h6 style="font-weight:lighter">' . $product_details . '</h6>
      </div>
      <p>' . CURRENCY . '.' . $product_price . '</p>
      <div>
      <a href="add_to_cart.php?add_to_cart=' . $id . '" class="btn">Add to cart</a>
      </div>
    </div>';
  }
}

function count_all_product()
{
  global $con;
  $sql = "select * from product";
  $res = mysqli_query($con, $sql);
  $count = mysqli_num_rows($res);
  return ceil($count / 12);
}

function AddtoCart()
{
  global $con;
  if (isset($_GET['add_to_cart'])) {
    $product_id = $_GET['add_to_cart'];
    $ip = getIpaddress();
    $quantity = 1;

    $check_sql = "select * from cart_details where product_id='$product_id' and ip_address='$ip'";
    $result = mysqli_query($con, $check_sql);
    $count_row = mysqli_num_rows($result);
    if ($count_row == 0) {

      $sql = "insert into cart_details (product_id,ip_address,quantity) values('$product_id','$ip','$quantity')";
      $res = mysqli_query($con, $sql);
      if ($res) {
        echo "<script>alert('Item added to cart')</script>";
        echo "<script>window.open('products.php?section=1','_self')</script>";
        //         echo '<div class="alert alert-success" role="alert">
        //         <strong>Success..<br></strong> Item added to cart
        //  </div>';
      } else {
        die(mysqli_error($con));
      }
    } else {
      echo "<script>alert('This item  is already present inside cart')</script>";
      echo "<script>window.open('products.php?section=1','_self')</script>";
      //       echo '<div class="alert alert-warning" role="alert">
      //    <strong>Success..<br></strong> This item  is already present inside cart
      //  </div>';
    }
  }
}

function viewCart()
{
  global $con;
  $ip = getIpaddress();
  $sql = "select * from cart_details where ip_address = '$ip'";
  $res = mysqli_query($con, $sql);
  if (mysqli_num_rows($res) > 0) {
    if ($res) {
      while ($row = mysqli_fetch_assoc($res)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];
        $product_sql = "select * from product where product_id='$product_id'";
        $result = mysqli_query($con, $product_sql);
        while ($product_row = mysqli_fetch_assoc($result)) {
          $image = $product_row['p_img1'];
          $name = $product_row['p_name'];
          $price = $product_row['p_price'];
          $total = $price * $quantity;
          echo '<tr>
      <td>
        <div class="cart-info">
        <input type="checkbox" name="items[]" value="' . $product_id . '" style="height:15px; width:20px; margin-top:30px; margin-right: 10px">
          <img style="object-fit:contain" src=product_img/' . $image . ' />
          <div>
            <p style="text-transform: uppercase">' . $name . '</p>
            <small>Price: ' . CURRENCY . '.' . $price . '</small>
            <br />
            <a href="delete_from_cart.php?product_id=' . $product_id . '">Remove</a>
          </div>
        </div>
      </td>
      <td><a href="" style="margin-right: 8px; text-decoration:none; color: black;"><i class="fa-solid fa-minus"></i></a><input name="cart_update" type="text" style="font-size: 15px; width:30px; text-align:center !important" value=' . $quantity . '><a href="" style="margin-left: 8px; text-decoration:none; color: black;"><i class="fa-solid fa-plus"></i></a></td>
      <td>' . CURRENCY . '.' . $total . '</td>
    </tr>';
          // <i class="fa-duotone fa-minus"></i>
          // <i class="fa-duotone fa-plus"></i>
        }
      }
    } else {
      die(mysqli_error($con));
    }
  } else {
    echo '<td><div class="alert alert-warning" role="alert">
                      <h3>Oops! Your Cart is empty add some product to your cart   </h3>
                    </div></td>';
  }
}

function getIpaddress()
{
  //whether ip is from the share internet  
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address  
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

function ItemInCart()
{
  global $con;
  $ip = getIpaddress();
  $sql = "select * from cart_details where ip_address = '$ip'";
  $res = mysqli_query($con, $sql);
  $count_row = mysqli_num_rows($res);

  return $count_row;
}

function searchItem()
{
  global $con;
  if (isset($_GET['submit'])) {
    $key = $_GET['search'];
    $sql = "select * from product where p_keyword like '%$key%'";
    $res = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($res);
    if ($num_rows == 0) {
      echo "<div class='alert alert-warning' role='alert'><h2 class='text-center text-danger' style='margin-bottom: 120px; color: #acad24 !important'>No stock for this product</h2></div>";
    }
    if ($res) {
      while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['p_id'];
        $product_name = $row['p_name'];
        $product_image = $row['p_img1'];
        $product_details = $row['p_details'];
        $product_price = $row['p_price'];
        echo '<div class="col-4" style="background:#F1F1F1; border-radius:10px">
        <center><a href="product_details.php?p_id=' . $id . '"><img class="img-thumbnail" style="background:#F1F1F1;width: 200px;height: 200px;object-fit:contain; margin: 10px 10px !important" src=product_img/' . $product_image . ' /></a></center>
        <div class="p-info">
        <h4 style="font-weight:bold; font-size:16px; text-transform: uppercase">' . $product_name . '</h4>
        <div class=""> 
<h6 style="font-weight:lighter">' . $product_details . '</h6>
</div>
        <p>' . CURRENCY . '.' . $product_price . '</p>
        </div>
        
        <center><a href="add_to_cart.php?add_to_cart=' . $id . '" class="btn" style="margin-top:10px">Add to cart</a></center>
      
      </div>';
      }
    } else {
      die(mysqli_error($con));
    }
  }
}

function count_search_product()
{
  global $con;
  if (isset($_GET['submit'])) {
    $key = $_GET['search'];
    $sql = "select * from product where p_keyword like '%$key%'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);
    return ceil($count / 12);
  }
}

function PendingOrders()
{
  $con = mysqli_connect('localhost', 'root', '', 'ecom_sdp_3');
  $sql = "select * from pending_orders  where order_status = 'pending'";
  $res = mysqli_query($con, $sql);
  $pending_order = mysqli_num_rows($res);

  return $pending_order;
}

function ProductQuantity()
{
  $con = mysqli_connect('localhost', 'root', '', 'ecom_sdp_3');
  $sql = "select * from product  where p_quantity <= '0'";
  $res = mysqli_query($con, $sql);
  $product_quantity = mysqli_num_rows($res);

  return $product_quantity;
}


function getBuyProduct()
{
  $con = mysqli_connect('localhost', 'root', '', 'ecom_sdp_3');
  $ip = getIpaddress();
  $sql = "select * from user_info  where user_ip='$ip'";
  $res = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($res);
  $buy = $row['buy_product'];

  return $buy;
}


function getTotalAmount($id){
  global $con;

  $sql = "SELECT SUM(amount) as amount FROM user_orders WHERE user_id='$id'";

  $res = mysqli_query($con, $sql);

  if($res){
    $row = mysqli_fetch_assoc($res);

    $discount = $row["amount"];

    return $discount;
  }else{
    return -1;
  }
}

function getDiscount($user_total_previous_amount,$stotal){
  if($user_total_previous_amount >= 50000 || $stotal>=25000){
    $percentage=30;
  }
  else if( $user_total_previous_amount >= 40000 || $stotal>=20000){
    $percentage= 25;
  }
  else if( $user_total_previous_amount >= 30000 || $stotal>=15000){
    $percentage= 20;
  }
  else if( $user_total_previous_amount >= 20000 || $stotal>=10000){
    $percentage= 15;
  }
  else if( $user_total_previous_amount >= 10000 || $stotal>=5000){
    $percentage= 10;
  }
  else if( $user_total_previous_amount >= 2000 || $stotal>=2000){
    $percentage= 5;
  }
  else{
    $percentage= 0;
  }

  $discount = ($stotal/100)*$percentage;
  return round($discount);
}