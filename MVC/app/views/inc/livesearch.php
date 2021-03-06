<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "repas";
// $conn = new mysqli($servername, $username, $password, $dbname);
// https://www.tutorialrepublic.com/php-tutorial/php-mysql-ajax-live-search.php

echo "<script>
var img = document.querySelectorAll('.img-circle')
for(var i=0; i<img.length;i++){
    if(img[i].src.endsWith('/')){
        img[i].src = 'images/avatar.png'
    }
}
</script>
<style>
.user{position:relative}
.msg{
    text-decoration: none;
    color: #2a718e;
    position:absolute;
    right: 1.5rem;
    top: 1.2rem;
}
</style>
";

if(isset($_POST["term"])){
    // Prepare a select statement
    //$sql = "SELECT * FROM `Meals` AND Username LIKE '%".$_POST["term"]."%'";
    $this->dbh->query("SELECT * FROM `Meals` Where Meal_Name LIKE '%".$_POST["term"]."%'");
         
    // $record = $this->dbh->single();
    // if($stmt = mysqli_prepare($conn, $sql)){
        
        // Attempt to execute the prepared statement
        // if(mysqli_stmt_execute($stmt)){
        if($this->dbh->execute()){

            $result = $this->dbh->single();
            // $result = mysqli_stmt_get_result($stmt);
            
            // Check number of rows in the result set
            // if(mysqli_num_rows($result) > 0){
            if($this->dbh->rowCount() > 0){    
                // Fetch result rows as an associative array
                // while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                while($row = $this->dbh->resultSet()){    
                    ?>
                    <div class='bg-light user mb-3 rounded p-3'>
                 <!-- <img src = "images/=$row['Profile_Picture']?>" class="img-circle" width = "40"/> -->
        <?=$row['Meal_Name']?>
        <a class='msg fs-5' href="<?php echo URLROOT . 'users/allmeals'; ?>">Meal<i class="fas fa-comment"></i></a>
        </div>
                    <?php
                }
            } else{
                echo "<div class='alert alert-warning'>No matches found</div>";
            }
        // } 
        // else{
        //     echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
        // }
    }
     
    // Close statement
    // mysqli_stmt_close($stmt);
}

?>