<?php
class Meal_db 
{
    private $meals;
    private $_connection;
    

    public function getAllMeals(){
        $sql = "SELECT * FROM meal";
        $result = mysqli_query($this->_connection, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    public function getMealById($id): ?array
    {  
        $sql = "SELECT * FROM meal WHERE id like '%$id%'";
        $result = mysqli_query($this->_connection, $sql);
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    


    public function getMealReviews($id){
        $sql = "SELECT * FROM reviews WHERE meal_id like '%$id%'";
        $result = mysqli_query($this->_connection, $sql);
        return mysqli_fetch_array($result, MYSQLI_ASSOC);
    }
    
    public function addMealReview($data){
        $target_file = "./assets/reviewImages/". basename($data["image"]["name"]);
        if($this->move_uploaded_file($data["image"]["tmp_name"], $target_file)){
            $name = mysqli_real_escape_string($this->_connection, $data["name"]);
            $city = mysqli_real_escape_string($this->_connection, $data["city"]);
            $rating = $data["rate"];
            $image = $data["image"]["name"];
            $review = mysqli_real_escape_string($this->_connection, $data["review"]);
            $meal_id = $data["meal_id"];
            $sql = "insert into reviews values ('NULL','$name','$city','$rating','$image','$review','$meal_id')";
            mysqli_query($this->_connection, $sql);
            
        }
    }
    public function getTotalPrice($temp_meals){
        $total = 0;
        foreach($temp_meals as $meal_id => $meal_quantity){
            $meal = $this->getMealById($meal_id);
            // $total = $meal["price"] * $meal_quantity + $total;
        }
        return $total;
    }
    public function __construct()
    {      
        $this->_connection = mysqli_connect('localhost', 'root', '', 'resturant');
        if ($this->_connection === false) {  
            die("Connection failed: " . mysqli_connect_error());
            }
}
}
?>