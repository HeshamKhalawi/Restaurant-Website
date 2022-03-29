<?php
    require_once 'meal_db.php';
    $db = new Meal_db();
    $method = $_SERVER["REQUEST_METHOD"];
    if($method == "GET"){
        echo json_encode($db->getMealById($_GET["id"]))
    }
    else{
        $data = file_get_contents("php://input");
        echo json_encode($db->addMealReview(json_decode($data, true)));
    }
?>