<?php
    $servername = "localhost";
    $username = "AllUser";
    $password = "";
    $dbname = "GestionFourniture";						
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO FOURNITURE (Intitule, Description, Quantite, IDClasse, IDProfesseur)
            Values ('$_POST[Intitule]', '$_POST[Description]', $_POST[Quantite], 0, (SELECT IDProfesseur FROM Professeur WHERE MAIL='hrodiot@u-psud.fr' AND IDClasse=0))";
    if(!mysqli_query($conn, $sql))
    {
        echo("Description erreur : " . mysqli_error($conn));
        echo($sql);
    }
    $conn->close();
?>