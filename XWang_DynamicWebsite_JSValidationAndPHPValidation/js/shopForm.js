function submitForm(){
    var errorsInfo = '';
    var errorsArray = new Array();
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var phone = document.getElementById('phone').value;
    var regexPhone = /^(\d{3})[\-\s]?(\d{3})[\-\s]?(\d{4})$/;
    var address = document.getElementById('address').value;
    var city = document.getElementById('city').value;
    var postcode = document.getElementById('postcode').value;
    var regexPostcode = /^[A-Za-z][0-9][A-Za-z]\s[0-9][A-Za-z][0-9]$/;
    var province = document.getElementById('province').value;
    var product1Number = document.getElementById('product1').value;
    var product2Number = document.getElementById('product2').value;
    var product3Number = document.getElementById('product3').value;
    var deliveryTime = document.getElementById('deliveryTime').value; 

    // Validation if the input is empty or invalid and place focus 
    // on the wrong input textbox. Validate order is reversal order of the form,
    // in order to give the focus on the first error input.
    // However, use array.unshift() to add the errors to the errorsArray first,
    // and then add the array elements to the errorsInfo one by one.
    // This is for the order of errors output is still the order of the form
    if(deliveryTime.trim() == '')
    {
        errorsArray.unshift('<li>Delivery Time: Your delevery time option can not be empty.</li>');
        document.getElementById('deliveryTime').focus();
    }

    if(product1Number.trim() == 0 && product2Number.trim() == 0 && product3Number.trim() == 0)
    {
        errorsArray.unshift('<li>Product1 / Product2 / Product3: You should enter at least one product to buy.</li>');
        document.getElementById('product1').focus();
    }
    else
    {
        if(isNaN(product3Number))
        {
            errorsArray.unshift('<li>Product3: Please only enter the number you want to buy.</li>');
            document.getElementById('product3').focus();
        }
        if(isNaN(product2Number))
        {
            errorsArray.unshift('<li>Product2: Please only enter the number you want to buy.</li>');;
            document.getElementById('product2').focus();
        }
        if(isNaN(product1Number))
        {
           errorsArray.unshift('<li>Product1: Please only enter the number you want to buy.</li>'); 
           document.getElementById('product1').focus();
        }       
    }

    if(province.trim() == '')
    {
        errorsArray.unshift('<li>Province: Your option can not be empty.</li>');
        document.getElementById('province').focus();
    }

    if(!regexPostcode.test(postcode))
    {
        errorsArray.unshift('<li>Postal Code: Your input is invalid.</li>');
        document.getElementById('postcode').focus();
    }

    if(city.trim() == '')
    {
        errorsArray.unshift('<li>City: Your input can not be empty.</li>');
        document.getElementById('city').focus();
    }

    if(address.trim() == '')
    {
        errorsArray.unshift('<li>Address: Your input can not be empty.</li>');
        document.getElementById('address').focus();
    }

    if(!regexPhone.test(phone))
    {
        errorsArray.unshift('<li>Phone: Your input is invalid.</li>');
        document.getElementById('phone').focus();
    }

    if(!regexEmail.test(email))
    {
        errorsArray.unshift('<li>Email: Your input is invalid.</li>');
        document.getElementById('email').focus();
    }
    
    if(name.trim() == '')
    {
        errorsArray.unshift('<li>Name: Your input can not be empty.</li>');
        document.getElementById('name').focus();
    }
    
    if(errorsArray.length != 0)
    {
        errorsArray.forEach(element => {
            errorsInfo += `${element} <br>`;
        });
        document.getElementById('errorsOutput').innerHTML = errorsInfo;
    }
    else
    {
        document.getElementById('errorsOutput').innerHTML = '';
        return true;
    }

    return false;
}