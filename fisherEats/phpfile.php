<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World</p>'; ?> 
 </body>
 <?php
 function ExtendedAddslash(&$params)
{ 
        foreach ($params as &$var) {
            // check if $var is an array. If yes, it will start another ExtendedAddslash() function to loop to each key inside.
            is_array($var) ? ExtendedAddslash($var) : $var=addslashes($var);
        }
}

     // Initialize ExtendedAddslash() function for every $_POST variable
    ExtendedAddslash($_POST);      

?>
<?php
$submission_id = $_POST['submission_id']; 
$formID = $_POST['formID'];
$ip = $_POST['ip'];
$name = $_POST['name'];
$email = $_POST['email'];
$phonenumber = $_POST['phonenumber13'][0] ."-". $_POST['phonenumber13'][1];
$subject = $_POST['subject7'];
$message = $_POST['message6'];

$db_host = 'db hostname here';
$db_username = 'db username here';
$db_password = 'db password here';
$db_name = 'name of your database';
mysql_connect( $db_host, $db_username, $db_password) or die(mysql_error());
mysql_select_db($db_name);

$query = "SELECT * FROM `table_name` WHERE `submission_id` = '$submission_id'";
$sqlsearch = mysql_query($query);
$resultcount = mysql_numrows($sqlsearch);

if ($resultcount > 0) {
 
    mysql_query("UPDATE `table_name` SET 
                                `name` = '$name',
                                `email` = '$email',
                                `phone` = '$phonenumber',
                                `subject` = '$subject',
                                `message` = '$message'        
                             WHERE `submission_id` = '$submission_id'") 
     or die(mysql_error());
    
} else {

    mysql_query("INSERT INTO `table_name` (submission_id, formID, IP, 
                                                                          name, email, phone, subject, message) 
                               VALUES ('$submission_id', '$formID', '$ip', 
                                                 '$name', '$email', '$phonenumber', '$subject', '$message') ") 
    or die(mysql_error());  

} 
</html>