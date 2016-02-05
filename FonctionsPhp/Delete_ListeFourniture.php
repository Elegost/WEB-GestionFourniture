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
    $email=$_SESSION['Email'];
    $email=$conn->real_escape_string($email);
    $cbClasse = null;
	if(isset($_POST['cbclasse']))
    {
        $cbClasse = $_POST['cbclasse'];
    }
	if ($cbClasse)
	{
	  foreach($cbClasse as $idClasse)
	  {
        $sql = "DELETE FROM Fourniture Where IDclasse = $idClasse AND IDProfesseur = (SELECT IDProfesseur FROM Professeur WHERE MAIL = '$email' AND IDClasse = $idClasse)";
        if(!mysqli_query($conn, $sql))
        {
            echo("Description erreur : " . mysqli_error($conn));
            echo "</br>";
            echo($sql);
            echo "</br>";
        }
      }
    }
	  
	  
	  $conn->close();
?>