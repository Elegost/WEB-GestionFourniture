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
    
    $cbClasse = null;
	if(isset($_POST['cbclasse']))
    {
        $cbClasse = $_POST['cbclasse'];
    }
	if ($cbClasse)
	{
	  foreach($cbClasse as $idClasse)
	  {
        $sql = "DELETE FROM Classe Where IDclasse = $idClasse";
        if(!mysqli_query($conn, $sql))
        {
            echo("Description erreur : " . mysqli_error($conn));
            echo($sql);
            echo "</br>";
        }
        
        $sql = "DELETE FROM Professeur Where IDclasse = $idClasse";
        if(!mysqli_query($conn, $sql))
        {
            echo("Description erreur : " . mysqli_error($conn));
            echo($sql);
            echo "</br>";
        }
        
        $sql = "DELETE FROM Eleve Where IDclasse = $idClasse";
        if(!mysqli_query($conn, $sql))
        {
            echo("Description erreur : " . mysqli_error($conn));
            echo($sql);
            echo "</br>";
        }     
      }
    }
	  
	  
	  $conn->close();
?>