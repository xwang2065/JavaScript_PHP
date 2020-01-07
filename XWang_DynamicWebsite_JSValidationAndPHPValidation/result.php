<?php
    //fetch all the inputs value, and captalize some of the values's words
    $errors = '';
    $name = $_POST['name'];
    $name = ucwords($name);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $address = ucwords($address);
    $city = $_POST['city'];
    $city = ucwords($city);
    $postcode = $_POST['postcode'];
    $postcode = strtoupper($postcode);
    $province = $_POST['province'];
    $product1 = $_POST['product1'];
    $product2 = $_POST['product2'];
    $product3 = $_POST['product3'];
    $deliveryTime = $_POST['deliveryTime'];  

    //Function name: validateRequiredField
    //This function is for validating if the input is empty 
    //Parameters: $value, $fieldName
    function validateRequiredField($value, $fieldName){
        global $errors;

        if(trim($value) == ''){
            $errors .= "$fieldName is required <br>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/shopForm.css">
        <title>My Shop</title>
    </head>

    <body>
        <div class="formData">
            <?php
                //call the related functions to validate the required fields
                validateRequiredField($name, "Name");
                validateRequiredField($email, "Email");
                validateRequiredField($phone, "Phone Number");
                validateRequiredField($address, "Address");
                validateRequiredField($city, "City");
                validateRequiredField($postcode, "Post Code");
                validateRequiredField($province, "Province");

                if(!is_numeric($product1) && !trim($product1) == '') {
                    $errors .= "Product1 should the number you want to buy the product1. <br>";
                }
                if(!is_numeric($product2) && !trim($product2) == '') {
                    $errors .= "Product2 should the number you want to buy the product1. <br>";
                }
                if(!is_numeric($product3) && !trim($product3) == '') {
                    $errors .= "Product3 should the number you want to buy the product1. <br>";
                }
                
                if($product1 == 0 && $product2 == 0 && $product3 == 0){
                    $errors .= "At least one product should be bought. <br>";
                }
                                
                validateRequiredField($deliveryTime, "Delivery Time");

                //if there is any errors, print the errors. Otherwise, print the invoice.
                if($errors != ''){
                    echo "<h1 style='color:red;'>Error!</h1>";
                    echo "<p style='font-size:1.5em;'>$errors<p>";
                }
                else{
                    $formatedPhone = substr_replace($phone, '-',3, 0);
                    $formatedPhone = substr_replace($formatedPhone, "-", 7, 0);

                    $product1Rate = 10;
                    $product2Rate = 20;
                    $product3Rate = 30;
                    if(trim($product1) == ''){
                        $product1 = 0;
                    }
                    if(trim($product2) == ''){
                        $product2 = 0;
                    }
                    if(trim($product3) == ''){
                        $product3 = 0;
                    }
                    $product1Price = $product1 * $product1Rate;
                    $product2Price = $product2 * $product2Rate;
                    $product3Price = $product3 * $product3Rate;

                    $shippingChareges = array("1"=>30, "2"=>25, "3"=>20, "4"=>15);

                    $subTotal = $product1Price + $product2Price + $product3Price + $shippingChareges[$deliveryTime];

                    $taxRates = array("AB"=>5, "BC"=>12, "MB"=>13, "NB"=>15, "NL"=>15, "NS"=>15, "NT"=>5, 
                                    "NU"=>5, "ON"=>13, "PEI"=>15, "QC"=>14.975, "SK"=>11, "YT"=>5);
                    $taxTotal = $subTotal * $taxRates[$province] / 100;

                    $totalPrice = $subTotal + $taxTotal;

                    $taxTotal = round($taxTotal, 2);
                    $totalPrice = round($totalPrice, 2);

                    echo "<table><caption><h1>My Shop's Invoice</h1></caption>";
                    echo "<tr>
                            <th>Name:</th>
                            <td>$name</td>
                          </tr>
                          <tr>
                            <th>Email:</th>
                            <td>$email</td>                       
                          </tr>
                          <tr>
                            <th>Phone:</th>
                            <td>$formatedPhone</td>                       
                          </tr>
                          <tr>
                            <th>Delivery Address:</th>
                            <td>$address,<br>$city,<br>$province, $postcode</td>                       
                          </tr>
                          <tr>
                            <th>$product1 Product1 @ $$product1Rate:</th>
                            <td>$$product1Price</td>                       
                          </tr>
                          <tr>
                            <th>$product2 Product2 @ $$product2Rate:</th>
                            <td>$$product2Price</td>                       
                          </tr>
                          <tr>
                            <th>$product3 Product3 @ $$product3Rate:</th>
                            <td>$$product3Price</td>                       
                          </tr>
                          <tr>
                            <th>Shipping Charges:</th>
                            <td>$$shippingChareges[$deliveryTime]</td>                       
                          </tr>
                          <tr>
                            <th>Sub Total:</th>
                            <td>$$subTotal</td>                       
                          </tr>        
                          <tr>
                            <th>Taxes @ $taxRates[$province]%:</th>
                            <td>$$taxTotal</td>                       
                          </tr>        
                          <tr>
                            <th>TOTAL:</th>
                            <td>$$totalPrice</td>                       
                          </tr>
                        </table>";
                }
            ?>
        </div>
    </body>
</html>