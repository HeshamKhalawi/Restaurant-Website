<?php
  $cookie_name = "cart";
  $item_id = $_GET['id'];
  $base = $_GET['back'];
  $amount = 1;

  if(isset($_GET['amount'])){
    $amount = $_GET['amount'];
  }

  if(!isset($_COOKIE[$cookie_name])){
    $cart_items = array($item_id=>$amount);
    setcookie($cookie_name, json_encode($cart_items),time()+86400,  '/');    
  }else {
    $cart_items_cookie_values = $_COOKIE[$cookie_name];
    $cart_items = json_decode($cart_items_cookie_values, true);
    if(array_key_exists($item_id, $cart_items)){
      $cart_items[$item_id] += $amount;
    }else {
      $cart_items[$item_id] = $amount;
    }
    var_dump($cart_items);
    setcookie($cookie_name, json_encode($cart_items), time()+86400 ,'/');
  }
  header('Location: '.$base);
?>