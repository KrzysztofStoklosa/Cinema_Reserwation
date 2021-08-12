<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Contact Us</title>
    <link rel="icon" type="image/png" href="img/logo.png">
</head>

<body>

    <?php
        require 'includes/config.php';
    ?>

    <?php
    if (isset($_POST['submit'])) {

        $insert_query = "INSERT INTO 
        feedbacktable ( senderfName,
                        senderlName,
                        sendereMail,
                        senderfeedback)
        VALUES (        '".$_POST["fName"]."',
                        '".$_POST["lName"]."',
                        '".$_POST["eMail"]."',
                        '".$_POST["feedback"]."')";

        mysqli_query($link, $insert_query);

        header('Location: contact.php?status=ok&id=' . mysqli_insert_id($link));
        exit;

    }
    ?>

    <header></header>
    <div class="gmap_canvas"><<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d76812.26029511748!2d18.531509357793198!3d53.013475255938715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sul.%20Majowa%2033%2087-100%20Toru%C5%84!5e0!3m2!1sen!2scz!4v1625339107803!5m2!1sen!2scz" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <div class="contact-us-container">
        <div class="contact-us-section contact-us-section1">
            <h1>Kontakt</h1>

            <?php
            if (!isset($_GET['status'])) {
            ?>

            <form action="contact.php" method="POST">
                <input placeholder="Imię" name="fName" required><br>
                <input placeholder="Nazwisko" name="lName" ><br>
                <input placeholder="Adres e-mail" name="eMail" required><br>
                <textarea placeholder="Twoja wiadomość" name="feedback" rows="10" cols="30" required></textarea><br>
                <button type="submit" name="submit" value="submit">Wyślij</button>
            </form>

            <?php
            }
            ?>

            <?php
            if (isset($_GET['status']) && $_GET['status'] == 'ok') {
                echo 'Dziękujemy, zgłoszenie przyjęte. Numer zgłoszenia: ' . $_GET['id'];
                echo '<br /><br />';
                echo '<a href="index.php">Powrót do strony głównej</a>';
            }
            ?>

        </div>
        <div class="contact-us-section contact-us-section2">
            <h1>Dane kontaktowe</h1>
            <h3>Numer telefonu</h3>
            <p><a href="tel:800110110">800 110 110</a></p>
            <h3>Adres</h3>
            <p>ul. Majowa 33<br />87-100 Toruń</p>
            <h3>E-mail</h3>
            <p><a href="mailto:maol3@wp.pl">maol3@wp.pl</a></p>
        </div>
    </div>
    <footer></footer>
    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/owl.carousel.min.js "></script>
    <script src="scripts/script.js "></script>
</body>

</html>