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
                <form method="POST">
                <table>
                <tr>
                  <td class="tr">Product naam
                  </td>
                  <td class="tr">Product grootte
                  </td>
                  <td class="tr">prijs
                  </td>
                  <td class="tr">Hoeveelheid
                  </td>
                </tr>
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $x = 0;
                $y = 0;
                $totaalbedrag = 0;
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=Sopranos", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch(PDOException $e) {
                }
                $sql = 'SELECT * FROM producten';
                $stmt = $conn->query($sql);
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach( $data as $product){
                    $x++;
                    echo "<tr>";
                    echo "<td>";
                    echo $product["producten_naam"];
                    echo "</td>";
                    echo "<td>";
                    echo $product["producten_grootte"];
                    echo "</td>";
                    echo "<td>";
                    echo $product["producten_prijs"];
                    echo "</td>";
                    echo "<td>";
                    echo "<input type='number' class='hoeveelheid' name='aantalpizzas$x' placeholder='0' value='0'>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                //toevoegen
                if(array_key_exists('Opslaan', $_POST)){
                    $naam = $_POST["naam"];
                    $adres = $_POST["adres"];
                    $tele = $_POST["tele"];
                    $email = $_POST["email"];
                    $toevoegen = "INSERT IGNORE INTO `klanten` (`klanten_ID`, `klanten_naam`, `klanten_adres`, `klanten_telefoon`, `klanten_email`) VALUES (NULL, '$naam', '$adres', '$tele', '$email')";
                    $conn->exec($toevoegen);

                    $_SESSION["naam"] = $naam;
                    $_SESSION["adres"] = $adres;
                    $_SESSION["tele"] = $tele;
                    $_SESSION["email"] = $email;

                    foreach( $data as $product ){
                        $y++;
                        $pizzahoeveelheid = $_POST["aantalpizzas" . $y];
                        $productid = $product["producten_ID"];
                        $query = "SELECT klanten_ID FROM klanten WHERE klanten_email = '$email'";
                        $result = $conn->prepare($query);
                        $result->execute();
                        $result = $result->fetch(PDO::FETCH_ASSOC);
                        $klantid = $result["klanten_ID"];

                        if($pizzahoeveelheid > 1) {
                            $eersteprijs = $product["producten_prijs"];
                            $pizzahoeveelheid2 = $_POST["aantalpizzas" . $y] - 1;
                            $tweedeprijs = $eersteprijs * $pizzahoeveelheid2;
                            $derdeprijs = $tweedeprijs / 2;
                            $vierdeprijs = $derdeprijs + $eersteprijs;
                        }else $vierdeprijs = $product["producten_prijs"] * $pizzahoeveelheid;
                        
                        $totaalbedrag = $totaalbedrag + $vierdeprijs;
                        $_SESSION["totaalbedrag"] = $totaalbedrag;

                        if($pizzahoeveelheid >= 1){
                          $toevoegenbestelling = " INSERT INTO `bestellingen` (`klanten_ID`, `producten_ID`, `bestellingen_hoeveelheid`, `bestellingen_prijs`) VALUES ($klantid, '$productid', '$pizzahoeveelheid', '$vierdeprijs')";
                        $conn->exec($toevoegenbestelling);
                        echo "<script> window.location.href = 'bevestiging.php';</script>";
                        } else{
                          echo NULL;
                        }
                    }
                }
                ?><div id="gegevensform">
                    <label id="gegevensinput" class="gegevens" for="naam">Naam:</label><br>
                    <input class="gegevens" type="text" id="naam" name="naam" value=""><br>
                    <label id="gegevensinput" class="gegevens" for="adres">Adres:</label><br>
                    <input class="gegevens" type="text" id="adres" name="adres" value=""><br>
                    <label id="gegevensinput" class="gegevens" for="tele">Telefoon:</label><br>
                    <input class="gegevens" type="text" id="tele" name="tele" value=""><br>
                    <label id="gegevensinput" class="gegevens" for="email">E-mail:</label><br>
                    <input class="gegevens" type="text" id="email2" name="email" value=""><br><br>
                    <input class="gegevens" id="bestel" name="Opslaan" value="Bestel" type="submit">
                </div>
                </form>
                <div id="openingstijden">Maandag t/m vrijdrag (8:00 tot 22:00)<br>Zaterdag (10:00 tot 22:00)<br>Zondag (Gesloten)</div>
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