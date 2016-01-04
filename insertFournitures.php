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
            Values ('Pied', 'Pied gauche de martin lavoisier', 2, 0, 0)";
    $conn->query($sql);
    $conn->close();
?>