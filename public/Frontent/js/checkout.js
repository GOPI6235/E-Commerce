// $(document).ready(function() {
//     $('#paymentForm').click(function(event) {
//         event.preventDefault();

//         var firstname = $('.firstname').val(); 
//         var lastname = $('.lastname').val(); 
//         var email = $('.email').val(); 
//         var phone = $('.phone').val(); 
//         var address1 = $('.address1').val(); 
//         var address2 = $('.address2').val(); 
//         var city = $('.city').val(); 
//         var state = $('.state').val(); 
//         var country = $('.country').val(); 
//         var pincode = $('.pincode').val(); 

//         if(!firstname)
//         {
//             fname_error = " first name is required."
//             $('#fname_error').html('');
//             $('#fname_error').html(fname_error);
//         }
//         else{
//             fname_error = "";
//             $('#fname_error').html('');
//         }
//         if(!lastname)
//         {
//             lastname_error = " last name is required."
//             $('#lastname_error').html('');
//             $('#lastname_error').html(lastname_error);
//         }
//         else{
//             lastname_error = "";
//             $('#lastname_error').html('');
//         }
//         if(!email)
//         {
//             email_error = " email is required."
//             $('#email_error').html('');
//             $('#email_error').html(email_error);
//         }
//         else{
//             email_error = "";
//             $('#email_error').html('');
//         }
//         if(!phone)
//         {
//             phone_error = " phone is required."
//             $('#phone_error').html('');
//             $('#phone_error').html(phone_error);
//         }
//         else{
//             phone_error = "";
//             $('#phone_error').html('');
//         }
//         if(!address1)
//         {
//             address1_error = " address1 is required."
//             $('#address1_error').html('');
//             $('#address1_error').html(address1_error);
//         }
//         else{
//             address1_error = "";
//             $('#address1_error').html('');
//         }
//         if(!address2)
//         {
//             address2_error = " address2 is required."
//             $('#address2_error').html('');
//             $('#address2_error').html(address2_error);
//         }
//         else{
//             address2_error = "";
//             $('#address2_error').html('');
//         }
//         if(!city)
//         {
//             city_error = " city is required."
//             $('#city_error').html('');
//             $('#city_error').html(city_error);
//         }
//         else{
//             city_error = "";
//             $('#city_error').html('');
//         }
//         if(!state)
//         {
//             state_error = " state is required."
//             $('#state_error').html('');
//             $('#state_error').html(state_error);
//         }
//         else{
//             state_error = "";
//             $('#state_error').html('');
//         }
//         if(!country)
//         {
//             country_error = " country is required."
//             $('#country_error').html('');
//             $('#country_error').html(country_error);
//         }
//         else{
//             country_error = "";
//             $('#country_error').html('');
//         }
//         if(!pincode)
//         {
//             pincode_error = " pincode is required."
//             $('#pincode_error').html('');
//             $('#pincode_error').html(pincode_error);
//         }
//         else{
//             pincode_error = "";
//             $('#pincode_error').html('');
//         }

//         if(fname_error != '' || lname_error != '' || email_error != '' || phone_error != '' || address1_error != '' || city_error != '' || state_error != '' || country_error != '' || pincode_error != '')
//         {
//             return false;
//         }
//         else{

//             var data = {
//                 'firstname':firstname,
//                 'lastname':lastname,
//                 'email':email,
//                 'phone':phone,
//                 'address1':address1,
//                 'address2':address2,
//                 'city':city,
//                 'state':state,
//                 'country':country,
//                 'pincode':pincode
//             }

//             $.ajax({
//                 method: "POST",
//                 url: "/proceed-to-pay",
//                 data: data,
//                 success: function (response) {
//                     // console.log(response.total_price);
//                     var options = {
//                         "key": "rzp_test_Go9PIqla5kN7vt", // Enter the Key ID generated from the Dashboard
//                         "amount": response.total_price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
//                         "currency": "INR",
//                         "name": response.firstname+' '+response.lastname, 
//                         "description": "Thank you for using us",
//                         "image": "https://example.com/your_logo",
//                         // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
//                         "handler": function (responsea){
//                             alert(responsea.razorpay_payment_id);

//                             $.ajax({
//                                 method: "POST",
//                                 url: "/place-order",
//                                 data: {
//                                     'fname' : response.firstname,
//                                     'lname' : response.lastname,
//                                     'email' : response.email,
//                                     'phone' : response.phone,
//                                     'address1' : response.address1,
//                                     'address2' : response.address2,
//                                     'city' : response.city,
//                                     'state' : response.state,
//                                     'country' : response.country,
//                                     'pincode' : response.pincode,
//                                     'payment_mode' : "Paid by Razorpay",
//                                     'payment_id' : responsea.razorpay_payment_id,
//                                 },
//                                 success: function (responseb) {
//                                     alert(responseb.status)
                                    
//                                 }
//                             });
//                         },
//                         "prefill": { 
//                             "name": response.firstname+' '+response.lastname, 
//                             "email": response.email, 
//                             "contact": response.phone   
//                         },
//                         "theme": {
//                             "color": "#3399cc"
//                         }
//                     };
//                     var rzp1 = new Razorpay(options);
//                     rzp1.open();                    
//                 }
                
//             });
//         }

//     });
// });