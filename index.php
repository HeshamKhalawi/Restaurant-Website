<?php 
  require_once "php/meal_db.php";
  $meals_obj = new Meal_db();
  $meals = $meals_obj->getAllMeals();
  $back = $_SERVER['REQUEST_URI'];
  $recent_bought = FALSE;
  if(isset($_COOKIE['recent_bought'])){
    $recent_bought = json_decode($_COOKIE['recent_bought']);
  }
?>

<!DOCTYPE html5>
<html>
  <head>
    <?php require "./include/inc.head_links.php"; ?>
    <title>Burger Time | Home Page </title>
  </head>

  <body>
    <?php
      include "include/inc.header.php"; 
    ?>
    <header class="header__background_image vh-100 text-white">
      <section class="header__clip--width">
        <h4 class="align-self-start h1 py-4">Party Time</h4>
        <div class="header__clip h1 p-5 m-4">
          <p class="h2 mx-4 px-2" style="color: black">Buy any 2 burgers and get 1.5 L Pepsi Free</p>
        </div>
        <button class="btn__custom" data-bs-toggle="modal" data-bs-target="#exampleModal">
          Order Now
        </button>
      </section>
    </header>

    <!-- Recent Bought Section -->
      <?php if($recent_bought): ?>
        <section class="p-4 d-flex flex-column">
          <h2 class="align-self-center section__header fw-bold h1">
            Your Recent Bought Products
          </h2>
          <section class="continer-fluid">
            <section class="row">
              <?php foreach($recent_bought as $meal_id): 
                $temp_recent_meal = $meals_obj->getMealById($meal_id);  
              ?>
                <section class="card col-12 col-md-4 col-lg-3">
                  <a href=<?= "detail.php?id={$temp_recent_meal['ID']}";?>>
                    <img
                      class="card-img-top"
                      src=<?= './assets/images/'. $temp_recent_meal["Image"];?>
                      alt=<?= 'meal '. $temp_recent_meal["ID"];?>
                    />
                  </a>
                  <!--Item Information-->
                  <p class="card-text"><?= '&#11088; '.$temp_recent_meal["Rating"];?></p>
                  <p class="fw-bold"><?= $temp_recent_meal["Title"];?></p>
                  <p><?= $temp_recent_meal["Description"];?></p>
                  <p>
                    <button
                      class="custom-btn py-2 px-3 mx-2 text-white h6 rounded-pill"
                      type="button"
                    >
                      <a class="nav-link p-1 text-white" href=<?php echo "php/cart.php?id={$temp_recent_meal['ID']}&back=$back";?> >Buy Again</a> 
                    </button>
                    <?php echo $temp_recent_meal["Price"].' SAR';?>
                  </p>
                </section>
              <?php endforeach ?>
            </section>
          </section>
        </section>
      <?php endif ?>

    <main>
      <section class="d-flex flex-column w-100 justify-content-between pt-5">
        <h2 class="align-self-center section__header fw-bold h1">
            Want To Eat
        </h2>s
        <p class="section__lead h5 mx-5 text-center fw-fold">
            Try our most delicious food and usally take minutes to deliver
        </p>
          <!--Menu list-->
        <ul class="d-flex justify-content-center nav text-secondary">
          <li class="nav-item">
            <a class="text-dark nav-link" href="">pizza</a>
          </li>
          <li class="nav-item">
            <a href="" class="text-dark nav-link">fast food</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link text-dark">cupcake</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link text-dark">sandwich</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link text-dark">spaghetti</a>
          </li>
          <li class="nav-item">
            <a href="" class="nav-link text-dark">burger</a>
          </li>
        </ul>
        <div class="main-section__img-container d-flex flex-column flex-lg-row">
          <img
            class="main-section__img"
            src="./assets/images/delivery.png"
            alt="Delivery Person"
          />
          <section>
            <div class="mx-4 text-white p-5 main-section__clip">
              <h1 class="main-section__clip--text h1">
                We guarantee 30 minutes delivery
              </h1>
            </div>
            <p class="text-center h1 p-5 mx-auto" >
              if you are having a meeting, working late at night and need an
              extra push
            </p>
          </section>
        </div>
      </section>

      <!--Gallery Section-->
      <section class="p-4 d-flex flex-column">
        <h2 class="align-self-center section__header fw-bold h1">
          Our Most Popular Recipes
        </h2>
        <p class="h5 mx-auto p-4 text-center">
          Try our most delicious food and usally take minutes to deliver
        </p>
        <!-- NOTE: "<"?= ?">"  is the same as "<"?php echo ?">" -->
        <section id="gallery" class="container-fluid">
          <section class="row">
            <?php foreach($meals as $meal): ?>
              <section class="card col-12 col-md-4 col-lg-3">
                <a href=<?php echo "detail.php?id={$meal['ID']}";?>>
                  <img
                    class="card-img-top"
                    src=<?= './assets/images/'. $meal["Image"];?>
                    alt=<?= 'meal '. $meal["ID"];?>
                  />
                </a>
                <!--Item Information-->
                <p class="card-text"><?= '&#11088; '.$meal["Rating"];?></p>
                <p class="fw-bold"><?= $meal["Title"];?></p>
                <p>
                  <?php
                  if(strlen($meal["Description"]) > 120){
                    echo substr($meal["Description"], 0, 120)."...";
                  }
                  ?>
                </p>
                <p>
                  <button
                    class="custom-btn py-2 px-3 mx-2 text-white h6 rounded-pill"
                    type="button"
                  >
                    <a class="nav-link p-1 text-white" href=<?php echo "php/cart.php?id={$meal['ID']}&back=$back";?> >add to cart</a> 
                  </button>
                  <?php echo $meal["Price"].' SAR';?>
                </p>
              </section>
            <?php endforeach ?>
          </section>
        </section>
      </section>
      
      <!--Testomonials Section-->
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner p-5">
          <div class="carousel-item active">
            <section class="d-block w-100 d-flex align-items-center flex-lg-row flex-column">
                <img
                  src="./assets/images/man-eating-burger.png"
                  class="mx-100"
                  alt="man eating burger"
                />
                <div >
                  <p class="p-2">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Cupiditate exercitationem tenetur reprehenderit vel soluta!
                    Numquam, iure deserunt optio inventore similique voluptatibus
                    voluptates laboriosam enim voluptatem exercitationem vero quis
                    totam voluptate, dignissimos officiis nostrum nesciunt
                    eligendi corporis eum earum tempore? Consequuntur animi sequi
                    eligendi eos quisquam nobis excepturi neque alias voluptates.
                  </p>
                </div>
            </section>
          </div>
          <div class="carousel-item">
            <section class="d-block w-100 d-flex align-items-center flex-lg-row flex-column">
              <img
                src="./assets/images/man-eating-burger.png"
                class="mx-100"
                alt="man eating burger"
              />
              <div >
                <p class="p-2">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Cupiditate exercitationem tenetur reprehenderit vel soluta!
                  Numquam, iure deserunt optio inventore similique voluptatibus
                  voluptates laboriosam enim voluptatem exercitationem vero quis
                  totam voluptate, dignissimos officiis nostrum nesciunt
                  eligendi corporis eum earum tempore? Consequuntur animi sequi
                  eligendi eos quisquam nobis excepturi neque alias voluptates.
                </p>
              </div>
            </section>
          </div>
          <div class="carousel-item">
            <section class="d-block w-100 d-flex align-items-center flex-lg-row flex-column">
              <img
                src="./assets/images/man-eating-burger.png"
                class="mx-100"
                alt="man eating burger"
              />
              <div>
                <p class="p-2">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit.
                  Cupiditate exercitationem tenetur reprehenderit vel soluta!
                  Numquam, iure deserunt optio inventore similique voluptatibus
                  voluptates laboriosam enim voluptatem exercitationem vero quis
                  totam voluptate, dignissimos officiis nostrum nesciunt
                  eligendi corporis eum earum tempore? Consequuntur animi sequi
                  eligendi eos quisquam nobis excepturi neque alias voluptates.
                </p>
              </div>
            </section>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </main>
    <!--footer-->
    <?php 
      include "include/inc.footer.php"; 
      require "include/inc.script_links.php"; 
    ?>
  </body>
</html>
