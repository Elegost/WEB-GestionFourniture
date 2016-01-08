<?php
    $handle = fopen("liste_eleve.csv", "w");
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
    $sql = "SELECT Nom, Mail FROM Eleve ORDER BY NOM";
    $result = $conn->query($sql);
    if (!$result) die('Couldn\'t fetch records');
    $num_fields = mysql_num_fields($result);
    $headers = array();
    for ($i = 0; $i < $num_fields; $i++) {
        $headers[] = mysql_field_name($result , $i);
    }
    $fp = fopen('php://output', 'w');
    if ($fp && $result) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename('liste_eleve.csv'));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('liste_eleve.csv'));
        readfile('liste_eleve.csv');
        fputcsv($fp, $headers);
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            fputcsv($fp, array_values($row));
        }
        die;
    }
    
    $conn->close();
    fwrite($handle, $fp);
    fclose($handle);

    
    exit;
?>