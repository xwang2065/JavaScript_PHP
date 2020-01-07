<html>
<head>
	<link rel="stylesheet" href="css/assignment4.css" />
</head>

<body>
<div class="content">
	<h1>Menu Page</h1>
	<h2>This Webpage is for putting information to Database of parts or vendors and show the database.</h2>
	<p>
		<ul>
			<li>Click "Add Info to Parts" to enter and save the infomations about part to the Parts table in database.</li>
			<li>Click "Add Info to Vendors" to enter and save the infomations about vendor to the Vendors table in database.</li>
			<li>Click "List Parts And Vendors" to display the Parts and the Vendors table in database.</li>
		</ul>
	</p>
	<div class="formData">
		<!-- <form name="myform" method="Post" action="Parts.php" >
			<button type="submit"><h2>Add Info to Parts</h2></button>
		</form> -->
		<button type="submit" onclick="javascript:location.href='Parts.php'"><h2>Add Info to Parts</h2></button>
		<br><br>

		<!-- <form name="myform" method="Post" action="Vendors.php" >
			<button type="submit"><h2>Add Info to Vendors</h2></button>
		</form> -->
		<button type="submit" onclick="javascript:location.href='Vendors.php'"><h2>Add Info to Vendors</h2></button>
		<br><br>

		<!-- <form name="myform" method="Post" action="List.php" >
			<button type="submit"><h2>List Parts And Vendors</h2></button>
		</form> -->
		<button type="submit" onclick="javascript:location.href='List.php'"><h2>List Parts And Vendors</h2></button>
	</div> 
</div>
</body>
</html>



