<!DOCTYPE html>
<html lang="pl">
<?php


    require 'includes/config.php';


    $id = $_GET['movie'];
    $sql = "SELECT * FROM movietable WHERE movieID = $id"; 
    $result = mysqli_query($link, $sql);
    $movieData = mysqli_fetch_array($result);

    $sql = '    SELECT
                    halls.name AS hallName,
                    halls.places AS places,
                    movie__halls.date AS date,
                    movie__halls.time AS time
                FROM
                    halls,
                    movietable,
                    movie__halls
                WHERE
                    movie__halls.timeId = ' . $_GET['timeId'] . ' AND
                    halls.id = movie__halls.halls AND
                    movietable.movieID = movie__halls.movieId'; 

    $result = mysqli_query($link, $sql);
    $schedule = mysqli_fetch_array($result);


    $sql = 'SELECT place FROM bookingtable WHERE timeId = ' . $_GET['timeId']; 
    $result = mysqli_query($link, $sql);

    $zajeteMiejsca = array(); $z = 0;
    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
        $row = mysqli_fetch_array($result);
        $zajeteMiejsca[$z] = $row['place']; $z++;
    }

    $ileMiejsc = $schedule['places'];


//    echo '<pre>'; var_export($miejscaZajete); echo '</pre>';
//    echo '<pre>'; var_export($schedule); echo '</pre>';

?>


<?php
$fNameErr = $pNumberErr= "";
$fName = $pNumber = "";

if (isset($_POST['submit'])) {

    $sql = 'SELECT timeId, halls, date, time FROM movie__halls WHERE timeId = ' . $_GET['timeId']; 
    $result = mysqli_query($link, $sql);
    $booking = mysqli_fetch_array($result);

    $insert_query = "INSERT INTO 
    bookingtable (       timeid,
                    movieId,
                    hallId,
                    bookingDate,
                    bookingTime,
                    bookingFName,
                    bookingLName,
                    bookingPNumber,
                    place)
    VALUES (        '". $booking["timeId"] . "',
                    '". $_GET['movie'] . "',
                    '". $booking["halls"] . "',
                    '". $booking["date"] . "',
                    '". $booking["time"] . "',
                    '". $_POST["fName"] . "',
                    '". $_POST["lName"] . "',
                    '". $_POST["pNumber"] . "',
                    '". $_POST["place"] . "')";

    mysqli_query($link, $insert_query);

    header('Location: booking.php?status=ok&movie=' . $_GET['movie'] . '&date=' . $_GET['date'] . '&timeId=' . $_GET['timeId'] . '&id=' . mysqli_insert_id($link));
    exit;

}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Book <?php echo $row['movieTitle']; ?> Now</title>
    <link rel="icon" type="image/png" href="img/logo.png">
</head>

<body style="background-color:#6e5a11;">
    <div class="booking-panel">
        <div class="booking-panel-section booking-panel-section1">
            <h1>Zarezerwuj bilet</h1>
        </div>
        <div class="booking-panel-section booking-panel-section2">
            
        </div>
        <div class="booking-panel-section booking-panel-section3">
            <div class="movie-box">
                <?php
                    echo '<img src="'. $movieData['movieImg'].'" alt="">';
                ?>
            </div>
        </div>
        <div class="booking-panel-section booking-panel-section4">
            <div class="title"><?php echo $movieData['movieTitle']; ?></div>

            <div class="movie-information">
                <table>
                    <tr>
                        <td><?php echo $movieData['movieDescription']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="booking-form-container">
                
                <p>Sala: <strong><?php echo $schedule['hallName']; ?></strong></p>
                <p>Data: <strong><?php echo $schedule['date']; ?></strong></p>
                <p>Godzina: <strong><?php echo $schedule['time']; ?></strong></p>
                
                <br />

                <?php
                if (!isset($_GET['status'])) {
                ?>

                <form action="booking.php?movie=<?php echo $_GET['movie']; ?>&date=<?php echo $_GET['date']; ?>&timeId=<?php echo $_GET['timeId']; ?>" method="POST">

                    <p>Miejsce:</p>
                    <select name="place">
                        <?php
                        for ($i = 0; $i < $ileMiejsc; $i++) {
                            $miejsce = ($i + 1);
                            if (in_array($miejsce, $zajeteMiejsca) == false) {
                                echo '<option value="' . ($i + 1) . '">' . ($i + 1) . '</option>';
                            }
                        }
                        ?>
                    </select>

                    <input placeholder="Imię" type="text" name="fName" required>
                    <input placeholder="Nazwisko" type="text" name="lName" required>
                    <input placeholder="Numer telefonu" type="text" name="pNumber" required>
                    <button type="submit" value="submit" name="submit" class="form-btn">Zarezerwuj</button>

                </form>

                <?php
                }
                ?>

                <?php
                if (isset($_GET['status']) && $_GET['status'] == 'ok') {
                    echo 'Dziękujemy, rezerwacja zrobiona. Numer rezerwacji: ' . $_GET['id'];
                    echo '<br /><br />';
                    echo '<a href="index.php">Powrót do strony głównej</a>';
                }
                ?>

            </div>
        </div>
    </div>

    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>
</body>

</html>