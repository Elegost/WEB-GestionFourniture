<?php
	  session_start();
	  // Insert the path where you unpacked log4php
	  include('log4php/Logger.php');
	   
	  // Tell log4php to use our configuration file.
	  Logger::configure('config.xml');
	   
	  // Fetch a logger, it will inherit settings from the root logger
	  $log = Logger::getLogger('myLogger');
	   
	  // Start logging
	  $log->trace("My first message.");   // Not logged because TRACE < WARN
	  $log->debug("My second message.");  // Not logged because DEBUG < WARN
	  $log->info("My third message.");    // Not logged because INFO < WARN
	  $log->warn("My fourth message.");   // Logged because WARN >= WARN
	  $log->error("My fifth message.");   // Logged because ERROR >= WARN
	  $log->fatal("My sixth message.");   // Logged because FATAL >= WARN
?>
<html>

<head>
<meta charset="utf-8" />
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
    </div>
</body>



</html>