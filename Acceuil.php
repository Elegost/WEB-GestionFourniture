<html>

<head>
   <title>Acceuil</title>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="description" content="Squelette" />
   <meta name="keywords" content="Squelette,html,documentation" />
   <meta name="author" content="Marcellus Wallace" />
   <link href="Acceuil.css" type="text/css" rel="stylesheet" />
   
</head>
<body>
	<img id="logo" src="Image/logo.jpg" >
   
   <div class="BlocLogin" align='center'>
    	<form method="get" action="connect.php">
		<label for="login" class="LabelLogin" >login : </label><input type="text" name="login"><br>
    	<label for="password" id="LabelPassword">password : </label><input type="password" name="Password"><br>
		
			<INPUT  id="btnSeConnecter" class="BtnSeConnecter" TYPE="submit" VALUE="Se connecter">
		</FORM>
		<FORM METHOD="LINK" ACTION="AffichageListe(Prof).php">
			<INPUT  id="btnSeConnecter(PROF)" class="BtnSeConnecter" TYPE="submit" VALUE="Se connecter (PROF)">
		</FORM>
		<FORM METHOD="LINK" ACTION="GestionListeAdmin.php">
			<INPUT  id="btnSeConnecter(ADMIN)" class="BtnSeConnecter" TYPE="submit" VALUE="Se connecter (ADMIN)">
		</FORM>
    </div>
</body>



</html>