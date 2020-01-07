<html>
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>List Parts and Vendors</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/assignment4.css">
		<?php
			include("connection.php");

			//This function is to create table header
			function CreatePartsTableHeader()
			{
				$text = "<tr id='tableHeader'>";
				$text .= "<th>Part ID</th>";
				$text .= "<th>Vendor Number</th>";
				$text .= "<th>Description</th>";
				$text .= "<th>On Hand</th>";
				$text .= "<th>On Order</th>";
				$text .= "<th>Cost</th>";
				$text .= "<th>List Price</th>";
				$text .= "</tr>";

				echo $text;
			}

			//This function is to fill the part table
			function FillPartsTable()
			{
				$tableBodyText = "";

				$connection = ConnectToDatabase();
				$querySelect = "SELECT * FROM Parts";
				$preparedQuerySelect = $connection -> prepare($querySelect);
				$preparedQuerySelect -> execute();

				while ($row = $preparedQuerySelect -> fetch())
				{
					$partId = number_format($row['PartID'],0);
					$vendorNumber = number_format($row['VendorNo'],0);
					$description = $row['Description'];
					$onHand = $row['OnHand'];
					$onOrder = $row['OnOrder'];
					$cost = $row['Cost'];
					$listPrice = $row['ListPrice'];

					$tableBodyText .= "<tr>";
					$tableBodyText .= "<td>$partId</td>";
					$tableBodyText .= "<td class='text'>$vendorNumber</td>";
					$tableBodyText .= "<td class='text'>$description</td>";
					$tableBodyText .= "<td class='text'>$onHand</td>";
					$tableBodyText .= "<td class='text'>$onOrder</td>";
					$tableBodyText .= "<td class='text'>$cost</td>";
					$tableBodyText .= "<td class='text'>$listPrice</td>";
					$tableBodyText .= "</tr>";
				}

				echo $tableBodyText;
			}

			//This function is to fill the vendor table
			function FillVendorTable()
			{
				$tableBodyText = "";
				
				$connection = ConnectToDatabase();
				$querySelect = "SELECT * FROM Vendors";
				$preparedQuerySelect = $connection -> prepare($querySelect);
				$preparedQuerySelect -> execute();

				while ($row = $preparedQuerySelect -> fetch())
				{
					$vendorNo = number_format($row['VendorNo'],0);
					$vendorName = $row['VendorName'];
					$address1 = $row['Address1'];
					$address2 = $row['Address2'];
					$city = $row['City'];
					$province = $row['Prov'];
					$postCode = $row['PostCode'];
					$country = $row['Country'];
					$phone = $row['Phone'];
					$fax = $row['Fax'];

					$tableBodyText .= "<tr>";
					$tableBodyText .= "<td>$vendorNo</td>";
					$tableBodyText .= "<td class='text'>$vendorName</td>";
					$tableBodyText .= "<td class='text'>$address1</td>";
					$tableBodyText .= "<td class='text'>$address2</td>";
					$tableBodyText .= "<td class='text'>$city</td>";
					$tableBodyText .= "<td class='text'>$province</td>";
					$tableBodyText .= "<td class='text'>$postCode</td>";
					$tableBodyText .= "<td class='text'>$country</td>";
					$tableBodyText .= "<td class='text'>$phone</td>";
					$tableBodyText .= "<td class='text'>$fax</td>";
					$tableBodyText .= "</tr>";
				}

				echo $tableBodyText;
			}

			//This function is to create vendor table header
			function CreateVendorTableHeader()
			{
				$text = "<tr id='tableHeader'>";
				$text .= "<th>VendorNo</th>";
				$text .= "<th>VendorName</th>";
				$text .= "<th>Address1</th>";
				$text .= "<th>Address2</th>";
				$text .= "<th>City</th>";
				$text .= "<th>Prov</th>";
				$text .= "<th>PostCode</th>";
				$text .= "<th>Country</th>";
				$text .= "<th>Phone</th>";
				$text .= "<th>Fax</th>";
				$text .= "</tr>";

				echo $text;
			}
			?>
	</head>

	<body>
		<br><br>
		<h1>List Parts and Vendors:</h1><br>

		<h1>Parts</h1>
		<table>
			<?php
				CreatePartsTableHeader();
				FillPartsTable();
			?>
		</table>
		<br><br>

		<h1>Vendors</h1>
		<table>
			<?php
				CreateVendorTableHeader();
				FillVendorTable();
			?>
		</table>
		<br><br><br><br>

		<!-- <form name="myform" method="Post" action="index.php" >
			<button type="submit"><h2>Go to the menu</h2></button>
		</form> -->
		<button type="submit" onclick="javascript:location.href='index.php'"><h2>Go to the menu</h2></button>
	</body>
</html>



