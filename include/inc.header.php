<?php
  require_once "./php/meal_db.php";
  $cookie_name = 'cart';
  $is_not_empty = isset($_COOKIE[$cookie_name]);
  $meals_obj = new Meal_db();
  $total_price = 0;
  if($is_not_empty){
    $current_cart = json_decode($_COOKIE['cart'], true);
    $meals_ids = array_keys($current_cart);
    $total_price = $meals_obj->getTotalPrice($current_cart);
  }
?>
<nav class="navbar navbar-expand-lg navbar-dark p-0 bg--dark__purple px-5 py-2 fixed ">
  <div class="container-fluid d-flex align-items-center justify-content-between p-0">
    <a class="navbar-brand " href="./index.php">      
      <img class="common__logo--size" src="./assets/images/logo-White.svg" alt="logo"/>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
      <ul class="navbar-nav text-center">
        <li class="nav-item">
          <a class="nav-link nav-link__custom p-4" href="./index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link__custom p-4" href="./index.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link__custom p-4" href="./index.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link__custom p-4" href="./index.php">Testimonials</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link__custom p-4" href="./index.php">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link__custom p-4 bg--dark__red"  href="./index.php">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link__custom p-4 bg--dark__red" href="./index.php">Profile</a>
        </li>
        <li class="nav-item">
          <!-- Button trigger modal -->
          <a type="button" class="nav-link nav-link__custom p-4 bg--dark__red" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Cart 
            <span class="bg--dark__yellow px-2 py-1">
              <?php 
                $total_quantity = 0;
                if(!$is_not_empty){
                  echo $total_quantity;
                }else {
                  foreach($current_cart as $meal_id => $meal_quantity){
                    $total_quantity += $meal_quantity;
                  }
                  echo $total_quantity;
                }
              ?>  
            </span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Cart Content</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <div class="row">
            <div class="col">
              Title
            </div>
            <div class="col">
              Price
            </div>
          </div>
          <hr>
          <?php if($is_not_empty): ?>
            <?php  
              foreach($current_cart as $meal_id => $meal_quantity): 
              $meal = $meals_obj->getMealById($meal_id) 
            ?>
              <div class="row">
                <div class="col">
                 
                </div>
                <div class="col">
                
                </div>
              </div>
            <?php  endforeach ?>
            <hr>
            <div class="row text-danger">
              <div class="col">
                Total
              </div>
              <div class="col">
                <?= $total_price; ?>
              </div>
            </div>
          <?php endif ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn__custom bg--dark__red text-dark" data-bs-dismiss="modal">
          Close
        </button>
        <form method="post" action="php/order.php">
          <?php if($is_not_empty): ?>
            <?php foreach($meals_ids as $meal_id): ?>
              <input type="hidden" name="meals_ids[]" value=<?= $meal_id?> >
            <?php endforeach ?>
            <input type="hidden" name="total_price" value=<?= $total_price; ?>>
            <input type="submit" class="btn__custom text-dark" value="Order Now" >
          <?php endif ?>
        </form>
      </div>
    </div>
  </div>
</div>


