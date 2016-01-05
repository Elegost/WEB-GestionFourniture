 <html>

<head>
   <title>Graphique admin</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="graphique.css" type="text/css" rel="stylesheet" />  
</head>

<body>
   <div class="BlocHeader">
		 <img id="logo" src="Image/logo.jpg" >
		 <form action="Acceuil.php" method="post">
			  <input id="ButtonSeDeconnecter" type="submit" value="Se déconnecter">
		 </form>
		<label id="IdUser" for="IdUser">Bonjour [MAIL] </label>
	</div>
   
   <div class="BlocAffGraphique">
   <a href="GestionListeAdmin.php"><button id="BtnRetour" type="button">Retour</button></a>

    <table class="graph" cellspacing="6" cellpadding="0">
      <thead>
        <tr><th colspan="3">Graphique (Nombre de fournitures par matières)</th></tr>
      </thead>
      <tbody>
        <tr>
          <td >Anglais</td><td class="bar"><div style="width: 13%"></div>1</td><td>12%</td>
        </tr>
        <tr>
          <td>Espagnol</td><td class="bar"><div style="width: 50%"></div>5</td><td>58%</td>
        </tr>
        <tr>
          <td>Allemand</td><td class="bar"><div style="width: 0%"></div>0</td><td>0%</td>
        </tr>
        <tr>
          <td>Informatique</td><td class="bar"><div style="width: 0%"></div>0</td><td>0%</td>
        </tr>
        <tr>
          <td>EPS</td><td class="bar"><div style="width: 0%"></div>0</td><td>0%</td>
        </tr>
        <tr>
          <td>Philosophie</td><td class="bar"><div style="width: 13%"></div>1</td><td>13%</td>
        </tr>
      </tbody>
    </table>
	</div>

</body>

</html>