<?php
	function sanitizeString($var)
	{
		$var = stripslashes($var);
		$var = strip_tags($var);
		$var = htmlentities($var);
		return $var;	
	}
	
	function santitizeMySQL($connection, $var)
	{
		$var = $connection->real_escape_string($var);
		$var = sanitizeString($var);
		return $var;
	}
	
	$my_email_address = 'tim@octane-photo.com';
	
	function TSS_MySQL ($sql_statement, $host, $user, $pw, $db)
	{
		/* 
			Executes a SQL statement and prints errors, if any.
			Usage:  $result = TSS_MySQL ($select_statement, $hostname, $username, $password, $database);
		*/
		$mysql_connection = new mysqli($host, $user, $pw, $db);
		/* display error message if login fails. */
		if ($mysql_connection->connect_error) die ($mysql_connection->connect_error);
		
		if ($mysql_result = $mysql_connection->query($sql_statement)) 
		{				
			return $mysql_result;
			printf("Records selected: %d\n", mysql_affected_rows($mysql_connection));	
		}
		else
		{
			echo $mysql_connection->error;
		}	
	}
	function updateStats()
	{
		/*require_once 'login.php';*/
		$conn = new mysqli($hostname, $username, $password, $database);
		
		if (mysqli_connect_errno()) {
			printf("MySQL Connection Failed: %s\n", mysqli_connect_error());
			exit();
		}
		if(isset($_SERVER["PHP_SELF"]))
		{
			$php_self = $_SERVER["PHP_SELF"];
		}
		else
		{
			$php_self = 'Not Defined';
		}
		if(isset($_SERVER["HTTP_REFERER"]))
		{
			$http_referer = $_SERVER["HTTP_REFERER"];
		}
		else
		{
			$http_referer = 'Not Defined';
		}
		if(isset($_SERVER["HTTP_USER_AGENT"]))
		{
			$http_user_agent = $_SERVER["HTTP_USER_AGENT"];
		}
		else
		{
			$http_user_agent = 'Not Defined';
		}
		if(isset($_SERVER["REMOTE_ADDR"]))
		{
			$remote_addr = $_SERVER["REMOTE_ADDR"];
		}
		else
		{
			$remote_addr = 'Not Defined';
		}					
			
		$sql = 	"insert into stats(php_self, http_referer, http_user_agent, remote_addr) values('$php_self', '$http_referer', '$http_user_agent', '$remote_addr')";
				
		/*echo '<hr>' . $sql . '<hr>';*/
		
		$result = $conn->query($sql);
		
		$conn->close();
	}
?>