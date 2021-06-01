	<?php

	$conn=new mysqli("localhost","root","","crud_vue");

	if ($conn->connect_error) {
		die("Connection Failed!".$conn->connect_error);
	}

	$result= array('error' => false );

	$action='';

	if (isset($_GET['action'])) {
		$action=$_GET['action'];
	}

	if ($action=='read') {
		$sql=$conn->query("select * from users");
		$users = array();
		while ($row=$sql->fetch_assoc()) {
			array_push($users, $row);
		}
		$result['users']=$users;
	}

	if ($action=='create') {

		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];

		$sql=$conn->query("insert into users (name,email,phone) values ('$name','$email','$phone')");

	if ($sql) {
		$result['message']="User added successfully!";
	}
	else
	{
		$result['error']=true;
		$result['message']="Failed to add user!";
	}
	}

	if ($action=='update') {

		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];

		$sql=$conn->query("update users set name='$name',email='$email',phone='$phone' where id='$id'");

	if ($sql) {
		$result['message']="User Update successfully!";
	}
	else
	{
		$result['error']=true;
		$result['message']="Failed to Update user!";
	}
	}

	if ($action=='delete') {

		$id=$_POST['id'];

		$sql=$conn->query("delete from users where id='$id'");

	if ($sql) {
		$result['message']="User delete successfully!";
	}
	else
	{
		$result['error']=true;
		$result['message']="Failed to delete user!";
	}
	}

	$conn->close();

	echo json_encode($result);
	?>