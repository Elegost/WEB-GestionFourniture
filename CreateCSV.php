<?php
    $handle = fopen("liste_eleve.csv", "w");
    //ECRIRE ICI LE CONTENU DE LA TABLE ELEVE
    fwrite($handle, "test");
    fclose($handle);

    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('liste_eleve.csv'));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('liste_eleve.csv'));
    readfile('liste_eleve.csv');
    exit;
?>