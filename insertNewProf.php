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
	
	  switch( $_POST['submit'] ) {
			case 'ButtonValiderProf':
			echo "Prof";
			$sql = "INSERT INTO Professeur (Nom, Matiere, Mail, IDClasse)
			Values ('$_POST[NomProf]', '$_POST[MatiereProf]', '$_POST[EmailProf]', 0)";
			if(!mysqli_query($conn, $sql))
			{
				echo("Description erreur : " . mysqli_error($conn));
				echo($sql);
				echo "</br>";
			}
			$conn->close();break;
			
			case 'ButtonValiderClasse':
			echo "Prof";
			;break;
	  }
    
?>