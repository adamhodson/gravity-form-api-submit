# Simple Gravity Form API Submit
### A basic setup to allow for designers to submit any custom form through the Gravity Forms API 

Gravity Forms is a powerful plugin for Wordpress, however the form output and styling can sometimes be difficult to work with when it comes to custom page designs.  Instead of trying to re-style the Gravity Forms native forms, this script will allow for you to simply submit your custom forms to the Gravity Forms API allowing you to get all of the benefits from both your custom forms and Gravity Forms storage and reporting.

### Setup

#### Form Setup
To start, include the class "gform-submit" on your form. This will allow our AJAX script to identify your form as a Gravity Form.  In addition add the data element, "data-form-id", to your form and include the Gravity Form ID as the value. For exmaple, for Form ID 2, it would be data-form-id="2".


#### Functions Setup
Once you have your forms setup, open the gform_submit.php file and copy all of this code in to your functions.php file. 


#### Javascript Setup
Finally, open the file gform-submit.js and include this AJAX call in to your themes primary JS file.  It does rely on jQuery so make sure you have jQuery included as well. 


#### Form Setup
The most important part of this setup is the actual form setup.  When setting up your Gravity Form you must ensure two separate things:
1) The Gravity Form fields are in the same order as your custom form.  For example, if the inputs on your form are in the following order - Name, Email, Phone, Message - then your Gravity Form inputs should be in the same exact order.
2) The Field IDs for each field should be increment in order and not skip and numbers.  For example, if the input order is Name, Email, Phone, Message the IDs for each input should be 1,2,3 and 4.  If at any point you delete or move an input, this will likely cause the ID's to skip a number during incrementation which will cause your form submission to save improperly. If this happens, you must delete your form fields and start over to ensure ID's are in the proper order. 