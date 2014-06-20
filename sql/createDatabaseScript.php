<?php

	//This creates a database finance_app if it does not exists
	//This creates a users table, droppping the old if it exists
	//This adds a example user to the users table
	//This shows how a selection works on the database
	
	//How I ran this using my browser: http://localhost/CodeIgniter_2.2.0/sql/createDatabaseScript.php

	//MySQL Configs:
	$location = "localhost";
	$username = "root";
	$pass = "password";
	$database_name = "financeapp";
	
	//create mysql object
	$link = mysqli_connect(
			$location, 
			$username,
			$pass
		);
		
	if (!$link) die("Could not connect: ". mysqli_error($link));

	//create database
	echo "Creating Database..</br>";
	$query = "create database if not exists $database_name";
	if(!mysqli_query($link, $query)) die("Could not create database: " . mysqli_error($link));
	
	//connect to database
	echo "Connecting To Database..</br>";
	if (!mysqli_select_db($link, $database_name)) die("Could not access database: ". mysqli_error($link));

	//drop table users if it exists, create it using table_user.sql
	echo "Creating Table..</br>";
	$query = file_get_contents("table_user.sql");
	
	if(!mysqli_multi_query($link, $query)) die("Could not create table: " . mysqli_error($link));
	
	//need to close connection and restart after mysqli_multi_query is required
	mysqli_close($link);
	$link = mysqli_connect(
			$location, 
			$username,
			$pass
		);
	if (!$link) die("Could not connect: ". mysqli_error($link));
	if (!mysqli_select_db($link, $database_name)) die("Could not access database: ". mysqli_error($link));

	
	//add example user
	echo "Inserting Example User..</br>";
	$query = "
		insert into user (
			userName, 
			userPassword, 
			userCreatedOn, 
			userEmail, 
			userFirstName, 
			userLastName, 
			userProfileImage
		) 
		
		values (
			'satbirkira',
			'".md5('123456')."',
			'2012-11-23',
			'satbir.kira@gmail.com',
			'Satbir',
			'Saini',
			NULL
		)";
	if(!mysqli_query($link, $query)) die("Could not insert example: " . mysqli_error($link));

	//display all users
	echo "Selecting Users..</br>";
	$query = "select * from user";
	$result = mysqli_query($link, $query);
	if(!$result) die("Could not select users: " . mysqli_error($link));

	$i = 0;
	while ($record = mysqli_fetch_assoc ($result))
    {
		echo "==</br>";
		echo "Person Number $i: ". $record['userName']. "</br>";
		foreach ($record as $column => $data)
		{
			echo "$column : $data</br>";
			//echo "Person Number $i:   ID = ". $record['userID'] .", Name = ". $record['userName']. ", Email = ". $record['userEmail'] ."</br>";
		}
	}
	

?>