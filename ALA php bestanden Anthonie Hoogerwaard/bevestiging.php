<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href=style/style.css?v=<?php echo time(); ?>">   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <div id="page-container">
        <div id="content-wrap">
            <div id="header">
                Sopranos Pizza
                <div id="logo"></div>
            </div>
            <div id="nav">
                <button class="buttons" id="button1" onclick="location.href='index.php'">Home</button>
                <button class="buttons" id="button2" onclick="location.href='bestellen.php'">Bestellen</button>
                <button class="buttons" id="button3" onclick="location.href='toevoegen.php'">Toevoegen</button>
            </div>
            <div id="main">
                <div id="bon">
                    <h2>Bestelling is Gelukt!!</h2>
                <?php
                    echo "----------------------------------------------------------------------------------------------";
                    echo "<br>" . $_SESSION['naam'];
                    echo "<br>" . $_SESSION['adres'];
                    echo "<br>" . $_SESSION['tele'];
                    echo "<br>" . $_SESSION['email'];
                    echo "<br>----------------------------------------------------------------------------------------------";
                    echo "<br>" . $_SESSION["totaalbedrag"];
                ?>
                </div>
            </div>
            <footer id="footer2">
            <div id="copyright">Copyright 2022 ©️ Sopranos</div>
            <div id="email">
                E-mail: SopranosPizza@gmail.com
            </div>
        </footer>
    </div>
</body>


</html>