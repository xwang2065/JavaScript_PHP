<?php 
    include('connection.php');
    $dbConnection = ConnectToDatabase();

    if ( ! empty($_POST)) {
    $partId = $_POST['partId'];
    $vendorNumber = isset($_POST['vendorNumber']) ? $_POST['vendorNumber'] : '';
    $description = $_POST['description'];
    $onHand = $_POST['onHand'];
    $onOrder = $_POST['onOrder'];
    $cost = $_POST['cost'];
    $listPrice = $_POST['listPrice'];
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Parts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/assignment4.css">
</head>
<body>
<div class="formData">
    <form name="myform" method="Post" action="" >
        <h1>PARTS</h1> <br><br>

        <label>Part ID :</label>
        &nbsp&nbsp<input id="partId" readonly type="text" placeholder= "Auto Number" name="partId" ><br/>

        <label>Vendor Number :</label>
        &nbsp&nbsp
        <select name="vendorNumber" id="vendorNumber">
            <option value=""></option>
            <?php

                $sql = "SELECT * FROM Vendors";

                $dbConnection = ConnectToDatabase();
                $preparedSQL = $dbConnection->prepare($sql);
                $preparedSQL->execute();

                while ($row = $preparedSQL -> fetch()){
                    $vn = round($row['VendorNo']);
                    echo "<option value='$vn'>$vn</option>";
                }
            ?>
        </select><br/>

        <label>Description :</label>
        &nbsp&nbsp<input id="description" type="text" name="description"><br/>

        <label>On Hand :</label>
        &nbsp&nbsp<input id="onHand" type="text" name="onHand"><br/>

        <label>On Order :</label>
        &nbsp&nbsp<input id="onOrder" type="text" name="onOrder"><br/>

        <label>Cost :</label>
        <b>$</b><input id="cost" type="text" name="cost"><br/>

        <label>List Price :</label>
        <b>$</b><input id="listPrice" type="text" name="listPrice"><br/>

        <br/><br/>

        <input id="submit" type="submit" value="Submit">
        <p id="errors"></p>
    </form>  
  
    <?php if ( ! empty($_POST)): ?>
    <?php
        $errors = '';  

        //Validations
        if(trim($vendorNumber) == ''){
            $errors .= 'Vendor Number is required<br>';
        }

        if(trim($description) == ''){
            $errors .= 'Description is required <br>';
        }

        if(trim($onHand) == '' || !is_numeric($onHand)){
            $errors .= 'On Hand is required and should be a number<br>';
        }

        if(trim($onOrder) == '' || !is_numeric($onOrder)){
            $errors .= 'On Order is required and should be a number <br>';
        }

        if(trim($cost) == '' || !is_numeric($cost)){
            $errors .= 'Cost is required and should be a number <br>';
        }

        if(trim($listPrice) == '' || !is_numeric($listPrice)){
            $errors .= 'List Price is required and should be a number <br>';
        }      

        if($errors != ''){
            echo "<div id='errors'><h2>errors:</h2>$errors</div>";//show errors if there are any errors
            echo '<br><br>';
        }
        else{
            $sql = "INSERT INTO Parts ( VendorNo, Description, OnHand, OnOrder, Cost, ListPrice) VALUES ('$vendorNumber', '$description', '$onHand', '$onOrder', '$cost', '$listPrice')";

            $preparedSQL = $dbConnection->prepare($sql);
            $preparedSQL->execute();

            $sql2 = "SELECT * FROM Parts WHERE PartID=(SELECT MAX(PartID) FROM Parts)";
            $preparedSQL2 = $dbConnection->prepare($sql2);
            $preparedSQL2->execute();

            while ($row = $preparedSQL2 -> fetch())
            {
                $partId = $row['PartID'];
                $vendorNumber = $row['VendorNo'];
                $description = $row['Description'];
                $onHand = $row['OnHand'];
                $onOrder = $row['OnOrder'];
                $cost = $row['Cost'];
                $listPrice = $row['ListPrice'];
            }

            echo "
                <div id='formResult'>
                <h2>Data Result:</h2>
                Part ID: $partId <br>
                Vendor Number: $vendorNumber <br>
                Description: $description <br>
                On Hand: $onHand <br>
                On Order: $onOrder <br>
                Cost: $$cost <br>
                List Price: $listPrice <br>

                *********************<br>
                Data inserted!<br>
                *********************<br>
                </div>
            ";//format and show the output
        }
    ?>

    <?php endif; ?>
 
    <!-- <form name="myform" method="Post" action="index.php" >
        <button type="submit"><h2>Go to the menu</h2></button>
    </form>  -->
    <button type="submit" onclick="javascript:location.href='index.php'"><h2>Go to the menu</h2></button>
</div>
</body>
</html>