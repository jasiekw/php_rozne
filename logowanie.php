<?php
	session_start();
	$db_obj = new mysqli ("127.0.0.1","login","haslo","nazwa_bazy_danych");
	error_reporting(1);
?>

<div id="logowanie" style="width: 300px; text-align:center; padding: 100px; margin-left: 30%">
	<form method="POST" action="log.php">
		<b>Login:</b> <input type="text" name="login"><br>
		<b>Hasło:</b> <input type="password" name="haslo"><br><br>
		<input type="submit" value="Zaloguj" name="loguj">
	</form>


<?php

if((isset($_POST['login']) && strlen($_POST['login']) > 20 ))
{
	echo "login maksymalnie może zawierać 20 znaków;<br>";
}
if((isset($_POST['haslo']) && strlen($_POST['haslo']) > 20 ))
{
	echo "haslo maksymalnie może zawierać 20 znaków;<br>";
}

   $login = ($_POST['login']);
   $haslo = ($_POST['haslo']);

   $login = $db_obj->real_escape_string($login);
   $haslo = $db_obj->real_escape_string($haslo);


   $odp = $db_obj->query("SELECT haslo FROM uzytkownicy WHERE login = '$login' ");
   
   $haslo_db = $odp->fetch_assoc();

   if (isset($_POST['loguj'])) 
   {	
		if ($haslo_db['haslo'] == MD5($haslo))
   		{

     	 $_SESSION['zalogowany'] = true;
     	 $_SESSION['login'] = $login;
      	 echo $login.	" zostałeś zalogowany";
   		}
   
   		else echo "zaloguj się";

   		$db_obj = null;
   	}	
?>


	<br><br><br>
	<form>
		<input type="button" value="Wyloguj" onclick="location.href='./log_out.php'" />
	</form>
</div>






