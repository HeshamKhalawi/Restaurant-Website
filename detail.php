<?php 
  require_once "php/meal_db.php";
  $meals_obj = new Meal_db();
  $id = $_GET['id'];
  $temp_meal_detail = $meals_obj->getMealById($id);
  $reviews = $meals_obj->getMealReviews($id);
  $back = $_SERVER['REQUEST_URI'];
  $amount = 1;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require "./include/inc.head_links.php"; ?>
    <title>Burger Time | Details Page</title>
  </head>
  <body>
    <?php include "include/inc.header.php"; ?>
    <main>
      <!-- Best Sandwich Section -->
      <div class="container-fluid">
        <div class="row best-sandwich-section px-5">
          <div class="col-lg-6 col-md-12 ">
            <img src=<?php echo './assets/images/'. $temp_meal_detail["Image"];?> alt=<?php echo 'Meal '.$temp_meal_detail["ID"];?> class="img-fluid rounded-top m-0"/> 
          </div>
          <div class="col-lg-6 col-md-12 m-0">
            <h1 class="m-0"><?php echo $temp_meal_detail["Title"];?></h1>
            <p class="m-0"><?php echo $temp_meal_detail["Price"].' SAR';?></p>
            <!--  echo '&#11088; '.$temp_meal_detail["rating"]; -->
            <p class="m-0">
                &#11088;
              <span><?php echo $temp_meal_detail['Rating']?></span>
            </p>
            <p class="m-0">
              <?php echo $temp_meal_detail["Description"];?>
            </p>
            <section class="best-sandwich-btns m-0">
              <section>
                <button id="decrement" class="bs-btn">-</button>
                <button id="changeAmount" class="bs-btn">1</button>
                <button id="increment" class="bs-btn">+</button>
              </section>
              <section>
              <button
                    class="custom-btn py-2 px-3 mx-2 text-white h6 rounded-pill"
                    type="button"
                  >
                    <a class="nav-link p-1 text-white" href=<?php echo "php/cart.php?id={$temp_meal_detail['ID']}&back=$back&amount=$amount";?> >add to cart</a> 
                  </button>
              </section>
            </section>
          </div>
        </div>
      </div>
      <div class="container-fluid px-5">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <button class="nav-link active" id="display-description-button" onclick="displayDescription()" type="button"  aria-selected="true">description</button>
          </li>
          <li class="nav-item">
            <button class="nav-link" id="display-review-button" onclick="displayReview(); showReviews('<?php echo $temp_meal_detail['ID'] ?>');" type="button" aria-selected="false">Review</button>
          </li>
        </ul>
      </div>
      <div class="description-container">
        <section class="px-5">        
          <p>
          <?php echo $temp_meal_detail["Description"];?>
          </p>
        </section>
      </div>
      <!--Reviews Section-->         
      <section class="Review-Container container-fluid">
        <p><b>There are no reviews. Be the first to add one!</b></p>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"> 
          <div class="carousel-inner p-5" id="reviewRow2">
          </div>
        </div>
          <button class="reviewButton" type="button" onclick="unlockReview()">
            Add Your Review
          </button>
          <form class="" method="post" action="" onsubmit="return !!(validateReview() & sendForm(this));" id="reviewForm" enctype="multipart/form-data">       
            <label for="reviewFile">Image</label><br />
            <input type="file" id="reviewFile" name="reviewFile" />
            <section class="Review-Container__ReviewSlider">
              <!--Rate slider-->
              <label for="rate">Rate the food</label><br />
              <input type="range" list="tickmarks" name="rate" id="rate" />
              <datalist id="tickmarks">
                <option value="20"></option>
                <option value="40"></option>
                <option value="60"></option>
                <option value="80"></option>
                <option value="100"></option>
              </datalist>
            </section>
            <!--Add name-->
            <section class="Review-Container__NameBox">
              <label for="fullName">Name</label><br />
              <input
                type="text"
                id="fullName"
                name="fullName"
                placeholder="First and Last name"
              />
            </section>
            <section class="Review-Container__CityBox">
              <label for="City">City</label><br />
              <input
                type="text"
                id="City"
                name="City"
                placeholder="Your City"
              />
            </section>
            <section class="Review-Container__ReviewBox ">
              <label for="review">Review</label><br />
              <span id="reviewError"></span>
              <textarea
                id="review"
                maxlength="500"
                oninput="incrementCharacter(this.value)"
                name="review"
                rows="7"
                cols="35"
                placeholder="Type your review here max 500 characters"
              ></textarea
              ><br /><br />
              <p id="charCounter"><span id="characterCounter">0</span> / 500</p>
              <br />
              <input class="reviewBox-btn" type="submit" value="Submit" />
            </section>
          </form>
      </section>
    </main>
    <?php 
      include "include/inc.footer.php"; 
      require "include/inc.script_links.php"; 
    ?>
  </body>