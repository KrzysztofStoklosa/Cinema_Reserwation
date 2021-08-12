<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Kino Arkadia</title>
</head>

<body>

    <?php
    require 'includes/config.php';
    $sql = "SELECT * FROM movietable";
    ?>

    <header></header>
    <div id="home-section-1" class="movie-show-container">
        <h1>Aktualnie wyświetlane</h1>
        <h3>Sprawdź repertuar</h3>

        <div class="movies-container">

            <?php

                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        for ($i = 0; $i < $rows = mysqli_num_rows($result); $i++){
                            $row = mysqli_fetch_array($result);
                            echo '<div class="movie-box">';
                            if($row['movieImg'] ){echo '<img src="'. $row['movieImg'] .'" alt=" " >';
                            }else{
                            echo '<img src="img/replace.jpg" alt=" ">';
                            echo '<div style="margin-top: -60px;  z-index: 1; color: white; text-align: center; font-size: 25px">'.$row['movieTitle']. "</div>";
                            
                            };
                            
                            
                            echo '<div class="movie-info ">';
                            echo '<h3>'. $row['movieTitle'] .'</h3>';
                            echo '<a href="schedule.php?id='.$row['movieID'] . '&date=' . date('Y-m-d') . '"><i class="fas fa-ticket-alt"></i> Book a seat</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                        mysqli_free_result($result);
                    } else{
                        echo '<h4 class="no-annot">No Booking to our movies right now</h4>';
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

                mysqli_close($link);

            ?>
        </div>
    </div>
    <div id="home-section-2" class="services-section">
        <h1>Jak to działa?</h1>
        <h3>Wykonaj trzy proste kroki.</h3>

        <div class="services-container">
            <div class="service-item">
                <div class="service-item-icon">
                    <i class="fas fa-4x fa-video"></i>
                </div>
                <h2>1. Wybierz film</h2>
                <p>Sprawdź opisy i wybierz interesujący Cię film</p>
            </div>
            <div class="service-item">
                <div class="service-item-icon">
                    <i class="fas fa-4x fa-credit-card"></i>
                </div>
                <h2>2. Wybierz wygodny dla Ciebie termin</h2>
                <p>Wybierz datę i godzinę seansu</p>
            </div>
            <div class="service-item">
                <div class="service-item-icon">
                    <i class="fas fa-4x fa-theater-masks"></i>
                </div>
                <h2>3. Wybierz miejsce</h2>
                <p>Zarezerwuj miejsce i ciesz się seansem</p>
            </div>
            <div class="service-item"></div>
            <div class="service-item"></div>
        </div>
    </div>
    
    <footer></footer>

    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>
</body>

</html>