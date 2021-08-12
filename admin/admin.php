<?php

	session_start();
	
	if ( $_SESSION['zalogowany']!= 1){
        
		 header('Location: /Cinema-Reservation/admin/index.php');
		exit();  
	}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kino Arkadia-Admin Dashboard</title>
   
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
<?php if ($_SESSION['zalogowany']== 1) : 


    ?>
    <?php
    $link = mysqli_connect("localhost", "root", "", "cinema_db");
    $sql = "SELECT * FROM bookingtable";
    $sql2 = "SELECT * FROM movietable";
    $titles = mysqli_query($link, "SELECT * FROM movieTable");
    $titlesRows = mysqli_num_rows(mysqli_query($link, "SELECT * FROM movieTable"));
    $bookingsNo=mysqli_num_rows(mysqli_query($link, $sql));
    $moviesNo=mysqli_num_rows(mysqli_query($link, "SELECT * FROM movieTable"));
    
    ?>
    <div class="admin-section-header">
        <div class="admin-logo">
            Kino Arkadia
        </div>
        
        <div class="admin-login-info">
            <i class="far fa-bell admin-notification-button"></i>
            <i class="far fa-comment-alt"></i>
            <a href="#">Cześć Admin !</a>
            <img class="admin-user-avatar" src="../img/avatar.png" alt="">
            <?php
            echo '<p>[ <a href="logout.php">Wyloguj się!</a> ]</p>';
            ?>
        </div>
    </div>
    <div class="">
        <div class=" ">
          
        </div>
        <div class="admin-section admin-section2">
            <div class="admin-section-column">
                <div class="admin-section-panel admin-section-stats">
                    <div class="admin-section-stats-panel">
                        <i class="fas fa-ticket-alt" style="background-color: #cf4545"></i>
                        <h2 style="color: #cf4545"><?php echo $bookingsNo ?></h2>
                        <h3>Rezerwacje</h3>
                    </div>
                    <div class="admin-section-stats-panel">
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                        <h2 style="color: #4547cf"><?php echo $moviesNo ?></h2>
                        <h3>Filmy</h3>
                    </div>
                  
                </div>
                <div class="admin-section-panel admin-section-panel1">
                    <div class="admin-panel-section-header">
                        <h2>Rezerwacje</h2>
                        <i class="fas fa-ticket-alt" style="background-color: #cf4545"></i>
                    </div>
                    <div class="admin-panel-section-content">
                        <?php
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_array($result)){
                                    while($tit = mysqli_fetch_array($titles)){
                                        if($row['movieId']== $tit['movieID']){
                                            $title = $tit['movieTitle'];
                                    };
                                };
                                
                                    echo $title;
                                    
                                    echo "<div class=\"admin-panel-section-booking-item\">\n";
                                    echo "                            <div class=\"admin-panel-section-booking-response\">\n";
                                    echo "                                <i class=\"fas fa-check accept-booking\" title=\"Verify booking\"></i>\n";
                                    
                                    echo "                                <a href='deleteBooking.php?id=".$row['bookingId']."'><i class=\"fas fa-times decline-booking\" title=\"Reject booking\"></i></a>\n";
                                    echo "                            </div>\n";
                                    echo "                            <div class=\"admin-panel-section-booking-info\">\n";
                                    echo "                                <div>\n";
                                    echo 
                                    "                                    <h3>"."Id filmu - ". "</h3>\n";
                                    echo "                                    <h3>". $row['movieId'] ."</h3>\n";
                                    echo "                                    <i class=\"fas fa-circle \"></i>\n";
                                    echo 
                                    "                                    <h3>"."Nr rezerwacji - ". "</h3>\n";
                                    echo "                                    <h4>". $row['bookingId'] ."</h4>\n";
                                    echo "                                    <i class=\"fas fa-circle \"></i>\n";
                                    echo 
                                    "                                    <h3>"."Data - ". "</h3>\n";
                                    echo "                                    <h4>". $row['bookingDate'] ."</h4>\n";
                                    echo "                                    <i class=\"fas fa-circle \"></i>\n";
                                    echo 
                                    "                                    <h3>"."Godz. ". "</h3>\n";
                                    echo "                                    <h4>". $row['bookingTime'] ."</h4>\n";
                                    echo "                                </div>\n";
                                    echo "                                <div>\n";
                                    echo 
                                    "                                    <h3>"."Dane personalne - ". "</h3>\n";
                                    echo "                                    <h4>". $row['bookingFName'] ." ". $row['bookingLName'] ."</h4>\n";
                                    echo "                                    <i class=\"fas fa-circle\"></i>\n";
                                    echo 
                                    "                                    <h3>"."Nr tel. ". "</h3>\n";
                                    echo "                                    <h4>". $row['bookingPNumber'] ."</h4>\n";
                                    echo "                                </div>\n";
                                    echo "                            </div>\n";
                                    echo "                        </div>";
                                }
                                mysqli_free_result($result);
                            } else{
                                echo '<h4 class="no-annot">No Bookings right now</h4>';
                            }
                        } else{
                            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }
                        ?>
                    </div>
                </div>
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Dodaj film</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>
                    <form action="" method="POST">
                        <input placeholder="Tytuł" type="text" name="movieTitle" required>
                        <input placeholder="Gatunek" type="text" name="movieGenre" required>
                        <input placeholder="Długość" type="number" name="movieDuration" required>
                        <input placeholder="Data emisji" type="date" name="movieRelDate" required>
                        <input placeholder="Godzina emisji format DD-MM-RR" type="time" name="seansTime" required>
                        <input placeholder="Nr hali(1-4)" type="number" name="hall" required min="1" max="4">
                        <input placeholder="Kraj wydania" type="text" name="movieCountry" required>
                        <input placeholder="Rok wydania" type="text" name="movieYearofProd" required>
                        <input placeholder="Opis filmu" type="textarea" name="movieDescription" required>
                        
                        <div>w celu umieszczenia zdjęcia na stronie skontaktuj się z działem technicznym</div>
                        <button type="submit" value="submit" name="submit" class="form-btn">Dodaj</button>
                        <?php
                        if(isset($_POST['submit'])){
                            $insert_query = "INSERT INTO 
                            movieTable (  
                                           
                                            movieYearofProd,
                                            seansTime,
                                            hall,
                                            movieTitle,
                                            movieGenre,
                                            movieDuration,
                                            movieRelDate,
                                            movieCountry,
                                            movieDescription)
                            VALUES (        
                                             '".$_POST["movieYearofProd"]."',                         
                                            '".$_POST["seansTime"]."',
                                            '".$_POST["hall"]."',
                                            '".$_POST["movieTitle"]."',
                                            '".$_POST["movieGenre"]."',
                                            '".$_POST["movieDuration"]."',
                                            '".$_POST["movieRelDate"]."',
                                            '".$_POST["movieCountry"]."',
                                            '".$_POST["movieDescription"]."')";
                                           
                                                            
                            mysqli_query($link,$insert_query);
                           
                            $idQuery = 'SELECT MAX(movieID) 
                        FROM movietable';
                        $idResult = mysqli_query($link,$idQuery);
                        $row = $idResult->fetch_row();
                        echo $row[0];
                             
                        $insert_query2 = "INSERT INTO 
                        movie__halls (  
                                        time,
                                        halls,
                                        date,
                                        movieID)
                        VALUES (                                
                                        '".$_POST["seansTime"]."',
                                        '".$_POST["hall"]."',
                                        '".$_POST["movieRelDate"]."',
                                        '$row[0]'
                                        )";
                                        mysqli_query($link,$insert_query2);
                                     
                            
                         
                          echo "<script type=\"text/javascript\">
window.setTimeout(\"window.location.replace('admin.php');\",100);
</script>";
echo '<div style ="color: red">film dodany </div>';
                        }
                        
                        ?>
                    </form>
                </div>
            </div>
            <div class="admin-section-column">
                <div class="admin-section-panel admin-section-panel4">
                <div class="admin-panel-section-header">
                        <h2>Filmy</h2>
                        <i class="fas fa-ticket-alt" style="background-color: #cf4545"></i>
                    </div>
                <div class="admin-panel-section-content">
                        <?php
                        if($result1 = mysqli_query($link, $sql2)){
                            $rows = mysqli_num_rows($result1);
                            

                            if($rows > 0){
                                foreach ($result1 as $row) {
                                                                
                                    
                                    echo "<div class=\"admin-panel-section-booking-item\">\n";
                                    echo "                            <div class=\"admin-panel-section-booking-response\">\n";
                                    echo "                                <i class=\"fas fa-check accept-booking\" title=\"Film zweryfikowany\"></i>\n";
                                    
                                    echo "                                <a href='deleteMovie.php?id=".$row['movieID']."'><i class=\"fas fa-times decline-booking\" title=\"Wykasuj\"></i></a>\n";
                                    echo "                            </div>\n";
                                    echo "                            <div class=\"admin-panel-section-booking-info\">\n";
                                    echo "                                <div>\n";
                                    echo "                                    <h3>". $row['movieTitle'] ."</h3>\n";
                                    echo "                                    <i class=\"fas fa-circle \"></i>\n";
                                    echo 
                                    "                                    <h3>"."ID filmu - ". "</h3>\n";
                                    echo "                                    <h4>". $row['movieID'] ."</h4>\n";
                                    echo "                                    <i class=\"fas fa-circle \"></i>\n";
                                    echo 
                                    "                                    <h3>"."Data - ". "</h3>\n";
                                    echo "                                    <h4>". $row['movieRelDate'] ."</h4>\n";
                                    echo "                                    <i class=\"fas fa-circle \"></i>\n";
                                    echo 
                                    "                                    <h3>"."Godz. ". "</h3>\n";
                                    echo "                                    <h4>". $row['seansTime'] ."</h4>\n";
                                    echo "                                </div>\n";
                                    echo "                                <div>\n";
                                    echo 
                                    "                                    <h3>"."Sala - ". "</h3>\n";
                                    echo "                                    <h4>". $row['hall'] ."</h4>\n";
                                   
                                    echo "                                </div>\n";
                                    echo "                            </div>\n";
                                    echo "                        </div>";
                                }
                                
                            } else{
                                echo '<h4 class="no-annot">Brak filmów</h4>';
                            }
                        } else{
                            echo "Błąd $sql. " . mysqli_error($link);
                        }
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script src="../scripts/jquery-3.3.1.min.js "></script>
    <script src="../scripts/owl.carousel.min.js "></script>
    <script src="../scripts/script.js "></script>
</body>

</html>

  

