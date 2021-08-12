<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/styles.css">
    <title>Rezerwacja biletu</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<header></header>

<body>

    <?php

        require 'includes/config.php';

    ?>


    <?php
    
    /* $id=$_GET['id'];
    echo $id; */
        $sql = "    SELECT DISTINCT
                        date
                    FROM
                        movietable,
                        movie__halls
                    WHERE
                        movietable.movieID = movie__halls.movieID
                    ORDER BY
                        date ASC";
    ?>


    <div class="schedule-section">
        <h1>Zarezerwuj bilet</h1>
        <div class="schedule-dates">
            <?php
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        for ($i = 0; $i < mysqli_num_rows($result); $i++){
                            $row = mysqli_fetch_array($result);
                            echo '<a href="schedule.php?date='. $row['date'] . '">';
                            if ($_GET['date'] == $row['date']) {
                                echo '<div class="schedule-item schedule-item-selected">';
                            }
                            else {
                                echo '<div class="schedule-item">';
                            }
                            echo $row['date'];
                            
                            echo '</div>';
                            echo '</a>';

                        }
                        mysqli_free_result($result);
                    }
                }
            ?>
        </div>



        <?php

            $sql = '    SELECT DISTINCT
                            movietable.movieID AS movieID,
                            movietable.movieTitle AS movieTitle,
                            movietable.movieImg AS movieImg,
                            movietable.movieDuration AS movieDuration,
                            movietable.movieDescription AS movieDescription
                        FROM
                            movietable,
                            movie__halls
                        WHERE
                            movietable.movieID = movie__halls.movieID AND
                            movie__halls.date = "' . $_GET['date'] . '"';
        ?>



        <div class="schedule-table">
            <table>

                <tr>
                    <th>Filmy</th>
                    <th>Harmonogram</th>
                </tr>



                <?php

                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        for ($i = 0; $i < mysqli_num_rows($result); $i++){
                            $row = mysqli_fetch_array($result);

                            echo '

                            <tr class="fade-scroll">
                                <td>
                                    <h2>' . $row['movieTitle'] . '</h2>
                                    <i class="far fa-clock"></i> ' . $row['movieDuration'] . '
                                    <p>' . '</p>
                                    </div>
                                </td>
                                <td>
                                     ' . movieDateHall($row['movieID'], $_GET['date']) . ' 
                                </td>
                            </tr>

                            ';



                        }
                        mysqli_free_result($result);
                    }

                }


                ?>


                

            </table>
        </div>


    </div>
    <footer></footer>

    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/owl.carousel.min.js "></script>
    <script src="scripts/script.js "></script>
</body>

</html>

<?php






function movieDateHall($movie, $date) {

    global $link; $html = '';

    #1 pobieramy sale w jakich jest wyswietlany

    $sql = '    SELECT DISTINCT
                    halls.id AS hallId,
                     halls.name AS hallName 
                FROM
                    movie__halls,
                     halls 
                WHERE
                    movie__halls.halls = halls.id AND 
                    date = "' . $date . '" AND
                    movieID = ' . $movie . ' ORDER BY halls.name';

//    echo $sql . '<br />';

        if ($result = mysqli_query($link, $sql)) {

            if (mysqli_num_rows($result) > 0) {

                for ($i = 0; $i < mysqli_num_rows($result); $i++) {

                    $row = mysqli_fetch_array($result);

                    $sql = '       SELECT
                                            movie__halls.halls AS hall,
                                            movie__halls.timeId AS id,
                                            movie__halls.time AS time
                                        FROM
                                            movietable,
                                            movie__halls,
                                            halls
                                        WHERE
                                            movietable.movieID = movie__halls.movieID AND
                                            halls.id = movie__halls.halls AND 
                                            movie__halls.date = "' . $date . '" AND
                                            movietable.movieID = ' . $movie . ' AND
                                            movie__halls.halls = ' . $row['hallId'] . '
                                        ORDER BY
                                            movie__halls.time ASC';

                    $tmp = '';
                    if ($result2 = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result2) > 0) {
                            for ($j = 0; $j < mysqli_num_rows($result2); $j++) {
                                $row2 = mysqli_fetch_array($result2);
                                $tmp .= '<a href="booking.php?movie=' . $movie . '&date=' . $date . '&timeId=' . $row2['id'] . '"><div class="schedule-item">' . $row2['time'] . '</div></a>';
                            }
                        }
                    }

                    $html .= '  <div class="hall-type">
                                <h3>' . $row['hallName'] . '</h3>
                                <div>
                                    <div class="schedule-item"><i class="far fa-clock"></i></div>
                                    ' . $tmp . '
                                </div>
                            </div>';

                }

            }

        }

        return $html;


}



?>