<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=sopranos", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
$sql = 'SELECT * FROM Klanten';
$stmt = $conn->query($sql);
$data = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>
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
                <div id="text1"> Welkom bij Sopranos pizza kom langs of bestel één van onze heerlijke pizzas<br><br>
                    50% Korting Na De Eerste Pizza!!!!
                </div>
                <div class="pizzafotos" id="afbeelding2"><img src="fotos/pizza tonno3.jpg"
                        style='height: 100%; width: 100%; object-fit: contain' /></div>
                <div class="pizzafotos" id="afbeelding3"><img src="fotos/pizza vegetariano.jpg"
                        style='height: 100%; width: 100%; object-fit: contain' /></div>
                <div class="pizzafotos" id="afbeelding4"><img src="fotos/pizza quattro.jpg"
                        style='height: 100%; width: 100%; object-fit: contain' /></div>
                <div class="pizzafotos" id="afbeelding5"><img src="fotos/pizza sopranos deluxe.jpg"
                        style='height: 100%; width: 100%; object-fit: contain' /></div>
            </div>
        </div>
        <footer id="footer">
            <div id="copyright">Copyright 2022 ©️ Sopranos</div>
            <div id="email">
                E-mail: SopranosPizza@gmail.com
            </div>
        </footer>
    </div>
</body>
</html>