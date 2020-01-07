<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/shopForm.css">
        <title>My Shop</title>
        <script src="js/shopForm.js"></script>
    </head>

    <body>
        <form class="formData" id="shippingForm" name="shippingform" action="result.php"
        onsubmit="return submitForm();"  method="POST">
            <table>
                <caption><h1>MY SHOP</h1></caption>
                <tbody id="recieptOutput">
                    <tr>
                        <th><label for="name">Name:</label></th>
                        <td><input type="text" id="name" name="name"></td>
                    </tr>

                    <tr>
                        <th><label for="email">Email:</label></th>
                        <td><input type="text" id="email" name="email"></td> 
                    </tr>

                    <tr>
                        <th><label for="phone">Phone:</label></th>
                        <td><input type="text" id="phone" name="phone" placeholder="123-123-1234"> </td>
                    </tr>

                    <tr>
                        <th><label for="address">Address:</label></th>
                        <td><input type="text" id="address" name="address"></td> 
                    </tr>

                    <tr>
                        <th><label for="city">City:</label></th>
                        <td><input type="text" id="city" name="city"></td>
                    </tr>

                    <tr>
                        <th><label for="postcode">Postal Code:</label></th>
                        <td><input type="text" id="postcode" name="postcode" placeholder="X9X 9X9"></td> 
                    </tr>

                    <tr>
                        <th><label for="province">Province:</label></th>
                        <td><select id="province" name="province">
                            <option value=""></option>
                            <option value="AB">AB</option>
                            <option value="BC">BC</option>
                            <option value="MB">MB</option>
                            <option value="NB">NB</option>
                            <option value="NL">NL</option>
                            <option value="NT">NT</option>
                            <option value="NS">NS</option>
                            <option value="NU">NU</option>
                            <option value="ON">ON</option>
                            <option value="PEI">PEI</option>
                            <option value="QC">QC</option>
                            <option value="SK">SK</option>
                            <option value="YT">YT</option>
                        </select></td>
                    </tr>

                    <tr>
                        <th><label for="product1:">Product1</label></th>
                        <td><input type="text" id="product1" name="product1"></td>
                    </tr>

                    <tr>
                        <th><label for="product2:">Product2</label></th>
                        <td><input type="text" id="product2" name="product2"></td>
                    </tr>

                    <tr>
                        <th><label for="product3:">Product3</label></th>
                        <td><input type="text" id="product3" name="product3"></td>
                    </tr>

                    <tr>
                        <th><label for="deliveryTime">Delivery Time:</label></th>
                        <td><select id="deliveryTime" name="deliveryTime">
                            <option value=""></option>
                            <option value="1">1 Day</option>
                            <option value="2">2 Days</option>
                            <option value="3">3 Days</option>
                            <option value="4">4 Days</option>
                        </select></td>
                    </tr>

                    <tr>
                        <th colspan="2" class="center">
                            <input type="submit" name="placeOrder" id="placeOrder" value="Place Order">
                        </th>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" id ="errorsOutput" class="center"></th>
                    </tr>
                </tfoot>
            </table>
        </form>
    </body>
</html>