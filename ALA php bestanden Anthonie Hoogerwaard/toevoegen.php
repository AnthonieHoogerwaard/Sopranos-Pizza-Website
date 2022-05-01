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
              <table>
                <tr>
                  <td class="tr">Product id
                  </td>
                  <td class="tr">Product naam
                  </td>
                  <td class="tr">Product grootte
                  </td>
                  <td class="tr">prijs
                  </td>
                </tr>
                <?php
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
  
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
                    echo "<tr>";
                    echo "<td>";
                    echo $product["producten_ID"];
                    echo "</td>";
                    echo "<td>";
                    echo $product["producten_naam"];
                    echo "</td>";
                    echo "<td>";
                    echo $product["producten_grootte"];
                    echo "</td>";
                    echo "<td>";
                    echo $product["producten_prijs"];
                    echo "</td>";
                    echo "</tr>";
                  }
                  echo "</table>";
                ?>
                <div id="formulieren">
                  Toevoegen van een Product
                <form id="toevoegen" method='post'>
                  <input type='text' name='toevoegennaam' class='toevoegenknop' placeholder="Product Naam" value=''/>
                  <input type='text' name='toevoegengroote' class='toevoegenknop' placeholder="Grootte" value=''/>
                  <input type='text' name='toevoegenprijs' class='toevoegenknop' placeholder="Prijs" value=''/>
                  <input type='submit' value='Voeg Product toe' class='buttonToevoegen'/>
                </form><br>
                  Updaten van een Product
                <form id="update" method='post'>
                  <input type='text' name='aanpassenid' class='toevoegenknop2' placeholder="ID" value=''/>
                  <input type='text' name='aanpassennaam' class='toevoegenknop2' placeholder="Product Naam" value=''/>
                  <input type='text' name='aanpassengroote' class='toevoegenknop2' placeholder="Grootte" value=''/>
                  <input type='text' name='aanpassenprijs' class='toevoegenknop2' placeholder="Prijs" value=''/>
                  <input type='submit' value='Aanpassen' class='toevoegenknop2' id='aanpassenButton'/>
                </form><br>
                  Verwijderen van een Product
                <form id="verwijder" method='post'>
                  <input type='text' name='verwijderSubmit' class='toevoegenknop3' id='verwijderSubmit' placeholder="ID" value=''/>
                  <input type='submit' value='Verwijder' class='toevoegenknop3' id='verwijderButton'/>
                </form>
                <?php
                //verwijderen
                if(array_key_exists('verwijderSubmit', $_POST)) {
                  $inputNumber = $_POST["verwijderSubmit"];
                  $delete = "DELETE FROM producten WHERE producten_ID=$inputNumber";
                  $conn->exec($delete);
                  header("Refresh:0");
                }
                //toevoegen
                if(array_key_exists('toevoegennaam', $_POST)) {
                  $nieuwenaam = $_POST["toevoegennaam"];
                  $nieuwegroote = $_POST["toevoegengroote"];
                  $nieuweprijs = $_POST["toevoegenprijs"];
                  $toevoegen = "INSERT INTO `producten` (`producten_ID`, `producten_naam`, `producten_grootte`, `producten_prijs`) VALUES (NULL, '$nieuwenaam', '$nieuwegroote', '$nieuweprijs')";
                  $conn->exec($toevoegen);
                  header("Refresh:0");
                }
                //aanpassen
                if(array_key_exists('aanpassennaam', $_POST)) {
                  $aanpassenid = $_POST["aanpassenid"];
                  $aanpassennaam = $_POST["aanpassennaam"];
                  $aanpassengroote = $_POST["aanpassengroote"];
                  $aanpassenprijs = $_POST["aanpassenprijs"];
                  $aanpassen = "UPDATE `producten` SET `producten_naam` = '$aanpassennaam', `producten_grootte` = '$aanpassengroote', `producten_prijs` = '$aanpassenprijs' WHERE `producten`.`producten_ID` = $aanpassenid;";
                  $conn->exec($aanpassen);
                  header("Refresh:0");
                }
                $conn = null;  
                ?>
                </div>
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
