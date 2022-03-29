<?php
  $current_cart = $_POST['meals_ids'];
  $total_price_submited = $_POST['total_price'];
  if(isset($_COOKIE['cart'])){
    setcookie('recent_bought', json_encode($current_cart), time()+86400,  '/');     
    setcookie('cart', "", time()-86400,  '/');
  }
  header('Location: ../index.php');  
?>