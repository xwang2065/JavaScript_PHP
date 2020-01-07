<?php 
    include('connection.php');
    $dbConnection = ConnectToDatabase();

    if ( ! empty($_POST)) {
        $vendorNumber = $_POST['vendorNumber'];
        $vendorName = $_POST['vendorName'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $postCode = strtoupper($_POST['postCode']);
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        $fax = $_POST['fax'];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vendors</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/assignment4.css">
</head>
<body>
<div class="formData">
    <form name="myform" method="Post" action="" >

        <h1>Vendors</h1> <br><br>

        <label>Vendor Number :</label>
        <input id="vendorNumber" type="text" name="vendorNumber"><br/>

        <label>Vendor Name :</label>
        <input id="vendorName" type="text" name="vendorName"><br/>

        <label>Address1 :</label>
        <input id="address1" type="text" name="address1"><br/>

        <label>Address2 :</label>
        <input id="address2" type="text" name="address2"><br/>

        <label>City :</label>
        <input id="city" type="text" name="city"><br/>

        <label>Province :</label>
        <select name="province" id="province">
            <option value=""></option>
            <option value="ON">ONTARIO</option>
            <option value="BC">BRITISH COLUMBIA</option>
            <option value="NS">NOVA SCOTIA</option>
            <option value="AB">ALBERTA</option>
            <option value="MB">MANITOBA</option>
            <option value="NB">NEW BRUNSWICK</option>
            <option value="NL">NL</option>
            <option value="NT">NT</option>
            <option value="NU">NU</option>
            <option value="PEI">PEI</option>
            <option value="QC">QC</option>
            <option value="SK">SK</option>
            <option value="YT">YT</option>
        </select><br/>

        <label>Post Code :</label>
        <input id="postCode" type="text" placeholder="X9X X9X" name="postCode"><br/>

        <label>Country :</label>
        <input id="country" type="text" name="country"><br/>

        <label>Phone :</label>
        <input id="phone" type="text" placeholder="123-123-1234" name="phone"><br/>

        <label>Fax :</label>
        <input id="fax" type="text" name="fax"><br/>
        <br/><br/>

        <input id="submit" type="submit" value="Submit">
        <p id="errors"></p>
    </form>  
  
    <?php if ( ! empty($_POST)): ?>
    <?php
        $errors = '';  

        //Validations of fields
        if(trim($vendorNumber) == '' || !is_numeric($vendorNumber)){
            $errors .= 'Vendor Number is required and should be a number <br>';
        }

        $sql = "SELECT * FROM Vendors";
        $preparedSQL = $dbConnection->prepare($sql);
        $preparedSQL -> execute();
        while ($row = $preparedSQL -> fetch()){
            if ($vendorNumber == $row['VendorNo']){
                $errors .= 'Vendor Number has already existed. <br>';
            }
        }
        

        if(trim($vendorName) == ''){
            $errors .= 'Vendor Name is required <br>';
        }

        if(trim($address1) == ''){
            $errors .= 'Address1 is required <br>';
        }

        if(trim($city) == ''){
            $errors .= 'City is required <br>';
        }

        if(trim($province) == ''){
            $errors .= 'Province is required <br>';
        }

        $postcodeRegex = '/[A-Z][0-9][A-Z]\s[0-9][A-Z][0-9]/';
        if(trim($postCode) == ''|| !preg_match($postcodeRegex, $postCode)){
            $errors .= 'Post Code is in a wrong format (X9X X9X format required) <br>';
        }

        if(trim($country) == ''){
            $errors .= 'Country is required <br>';
        }

        $phoneRegex = '/(\d{3})[\-\s]?(\d{3})[\-\s]?(\d{4})/';

        if(trim($phone) == '' || !preg_match($phoneRegex, $phone)){
            $errors .= 'Phone is in a wrong format (123-123-1234 format required) <br>';
        }

        if($errors != ''){
            echo "<div id='errors'><h2>errors:</h2>$errors</div>";//show errors if there are any errors
            echo '<br><br>';
        }
        else{
            //Inserting into database
           if ($address2 != null && $fax != null)
            {
                $sql = "INSERT INTO Vendors ( VendorNo, VendorName, Address1, Address2, City, Prov, PostCode, Country, Phone, Fax) 
                        VALUES ('$vendorNumber', '$vendorName', '$address1', '$address2', '$city', '$province', '$postCode', '$country', '$phone', '$fax')";
            }
            elseif($address2 == null && $fax != null){
                $sql = "INSERT INTO Vendors ( VendorNo, VendorName, Address1, City, Prov, PostCode, Country, Phone, Fax) 
                        VALUES ('$vendorNumber', '$vendorName', '$address1', '$city', '$province', '$postCode', '$country', '$phone', '$fax')";
            }
            elseif ($address2 != null && $fax == null)
            {
                $sql = "INSERT INTO Vendors ( VendorNo, VendorName, Address1, Address2, City, Prov, PostCode, Country, Phone) 
                        VALUES ('$vendorNumber', '$vendorName', '$address1', '$address2', '$city', '$province', '$postCode', '$country', '$phone')";
            }
            else {
                $sql = "INSERT INTO Vendors ( VendorNo, VendorName, Address1, City, Prov, PostCode, Country, Phone) 
                        VALUES ('$vendorNumber', '$vendorName', '$address1', '$city', '$province', '$postCode', '$country', '$phone')";
            }
            $preparedSQL = $dbConnection->prepare($sql);
            $preparedSQL->execute();

            echo "
                <div id='formResult'>
                <h2>Data Result:</h2>
                Vendor Number: $vendorNumber <br>
                Vendor Name: $vendorName <br>
                Address1: $address1 <br>
                Address2: $address2 <br>
                City: $city <br>
                Province: $province <br>
                Post Code: $postCode <br>
                Country: $country <br>
                Phone: $phone <br>
                Fax: $fax <br><br>
                *********************<br>
                Data inserted!<br>
                *********************<br>
                <br><br>
                </div>
                ";//format and show the output
        }
    ?>

    <?php endif; ?>

  <!-- <form name="myform" method="Post" action="index.php" >
        <button type="submit"><h2>Go to the menu</h2></button>
  </form> -->
  <button type="submit" onclick="javascript:location.href='index.php'"><h2>Go to the menu</h2></button>
</div>
</body>
</html>




