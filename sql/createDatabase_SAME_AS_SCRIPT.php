<?php

	//This creates a database finance_app if it does not exists
	//This creates a users table, droppping the old if it exists
	//This adds a example user to the users table
	//This shows how a selection works on the database
	
	//How I ran this using my browser: http://localhost/CodeIgniter_2.2.0/sql/createDatabase.php

	//Add to this visual comment so we know if additions to the tables have been made
	/* Database: finance_app
		Tables:
			- Users(id int, name string, email string)
	
	
	
	*/

	//create mysql object
	$link = mysql_connect(
			'localhost', 
			'root',
			'password'
		);
		
	if (!$link) die("Could not connect: ". mysql_error());

	//create database
	$query = "create database if not exists finance_app";
	if(!mysql_query($query, $link)) die("Could not execute query: " . mysql_error());
	
	//connect to database
	if (!mysql_select_db('finance_app', $link)) die("Could not access database: ". mysql_error());

	//drop table users if it exists
	$query = "drop table if exists users";
	if(!mysql_query($query, $link)) die("Could not execute query: " . mysql_error());

	//create fresh users table
	$query = "create table users (
			id int NOT NULL, 
			name text NOT NULL,
			email text NOT NULL,
			primary key (id)
		)";
	if(!mysql_query($query, $link)) die("Could not execute query: " . mysql_error());
	
	//add example user
	$query = "insert into users (id, name, email) values (1, 'satbir', 'satbir.kira@gmail.com')";
	if(!mysql_query($query, $link)) die("Could not execute query: " . mysql_error());

	//display all users
	$query = "select * from users";
	$result = mysql_query($query, $link);
	if(!$result) die("Could not execute query: " . mysql_error());

	$i = 0;
	while ($record = mysql_fetch_assoc ($result))
    {
		echo "Person Number $i:   ID = ". $record['id'] .", Name = ". $record['name']. ", Email = ". $record['email'] ."</br>";
    }

?>
