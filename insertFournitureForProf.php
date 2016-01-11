<?php
	  session_start();
?>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "GestionFourniture";						
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $mail = $_SESSION["Email"];
    $cbClasse = $_POST["cbclasse"];
    foreach($cbClasse as $idClasse)
    {
        $sql = "INSERT INTO FOURNITURE (Intitule, Description, Quantite, IDClasse, IDProfesseur)
                Values ('$_POST[Intitule]', '$_POST[Description]', $_POST[Quantite], $idClasse, (SELECT IDProfesseur FROM Professeur WHERE MAIL='$mail' AND IDClasse=$idClasse))";
        if(!mysqli_query($conn, $sql))
        {
            echo("Description erreur : " . mysqli_error($conn));
            echo($sql);
            echo "</br>";
        }
    }
    $conn->close();
?>