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

	/*
	
		Create database
	
	*/
	
	
	echo "Deleting Old Database..</br>";
	$query = "drop database if exists $database_name";
	if(!mysqli_query($link, $query)) die("Could not delete database: " . mysqli_error($link));
	$query = "create database if not exists $database_name";
	if(!mysqli_query($link, $query)) die("Could not create database: " . mysqli_error($link));
	
	//connect to database
	echo "Connecting To Database..</br>";
	if (!mysqli_select_db($link, $database_name)) die("Could not access database: ". mysqli_error($link));

	/*
	
		Create users table
	
	*/
	
	
	echo "Creating User Table..</br>";
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
	
	
	
	
	/*
	
		Create account table
	    [NO LONGER NEEDED, INFORMATION MOVED TO USER TABLE]
	*/
	
	/*
	echo "Creating Account..</br>";
	$query = file_get_contents("table_account.sql");
	
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
	
	*/
	
	
	/*
	
		Create goal table
	
	*/

	

	echo "Creating Goal..</br>";
	$query = file_get_contents("table_goal.sql");
	
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

	
	
	/*
	
		Create History table
	
	*/
	
	

	echo "Creating History..</br>";
	$query = file_get_contents("table_history.sql");
	
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
	
	
	/*
	
		Insert example user
	
	*/
	
	
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

	/*
	
		Insert example goal
	
	*/

	echo "Inserting Example Goal..</br>";
	$query = "
		insert into goal (
			userID, 
			goalName, 
			startDate, 
			targetDate, 
			totalCost, 
			monthlyDepot,
			interestRate, 
			currentlySaved, 
			goalStatus
		) 
		
		values (
			'". mysqli_insert_id($link) ."',
			'Buying A Toyota Tercel',
			'2012-11-23',
			'2015-11-23',
			'5000',
			'5',
			'0',
			'0',
			false
		)";
	if(!mysqli_query($link, $query)) die("Could not insert example: " . mysqli_error($link));
	
	/*
	
		Display table datas
	
	*/
	
	
	echo "Displaying Tables..</br>";
	
	
	echo "-------------------------------</br>";
	echo "Displaying Users Table</br>";
	echo "-------------------------------</br>";
	
	$query = "select * from user";
	$result = mysqli_query($link, $query);
	if(!$result) die("Could not select users: " . mysqli_error($link));

	$i = 0;
	while ($record = mysqli_fetch_assoc ($result))
    {
		echo "Person Number $i: ". $record['userName']. "</br>";
		foreach ($record as $column => $data)
		{
			echo "$column : $data</br>";
		}
		echo "==</br>";
	}
	
	
	echo "-------------------------------</br>";
	echo "Displaying Goal Table</br>";
	echo "-------------------------------</br>";
	
	$query = "select * from goal";
	$result = mysqli_query($link, $query);
	if(!$result) die("Could not select goals: " . mysqli_error($link));

	$i = 0;
	while ($record = mysqli_fetch_assoc ($result))
    {
		echo "Goal Number $i by : ". $record['userID']. "</br>";
		foreach ($record as $column => $data)
		{
			echo "$column : $data</br>";
		}
		echo "==</br>";
	}
	
	/*
	echo "-------------------------------</br>";
	echo "Displaying Account Table</br>";
	echo "-------------------------------</br>";
	
	$query = "select * from account";
	$result = mysqli_query($link, $query);
	if(!$result) die("Could not select accounts: " . mysqli_error($link));

	$i = 0;
	while ($record = mysqli_fetch_assoc ($result))
    {
		echo "Account Number $i by : ". $record['userID']. "</br>";
		foreach ($record as $column => $data)
		{
			echo "$column : $data</br>";
		}
		echo "==</br>";
	}
	*/
	
	
	echo "-------------------------------</br>";
	echo "Displaying History Table</br>";
	echo "-------------------------------</br>";
	
	$query = "select * from history";
	$result = mysqli_query($link, $query);
	if(!$result) die("Could not select accounts: " . mysqli_error($link));

	$i = 0;
	while ($record = mysqli_fetch_assoc ($result))
    {
		echo "Account Number $i by : ". $record['userID']. "</br>";
		foreach ($record as $column => $data)
		{
			echo "$column : $data</br>";
		}
		echo "==</br>";
	}

?>
