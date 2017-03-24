<?php 
//===========================================================================================================
//this page introduces PHP and show you how to process an HTML form and save the info on the db
//also, it shows you how to run SELECT and Update/Delete querries
//==================================================================================================================
///steps for MySQL database design
/*
1- create a db user with strong username and password
2- Give user the right access privilege
3- Create a db
4- Create a table called users with 6 columns: pk, name, email, phone_no, date_inserted, and status one Primary Key (PK)
//PK versus Unique key versus indexed key
5- Decide the length, type and whether column can be null====also, PK should be auto_increment & set default value if needed. 
//most common column types are varchar, int, timestamp, and text 
//SQL data types: Numeric, Character String, Date/Datetime, Binary 
//------------------------------------------------------------------------------------------------------------------
*/
//db connection------------------------------------------------------------------------------------------------------------------
# FileName=""
# Type="MYSQL"
# HTTP="true"
$hostname = "localhost";
//It is suggested to change the below info for more security
$database = "test_db";
$username = "test_user";
$password = "test_pass";
$db_link = mysqli_connect($hostname, $username, $password) or trigger_error('No result found.'); 
//---------------------------------------------------------------------------------------------------------------------------------------------
//php db insertion
//if form action attribute was get, we use $_GET[] array instead of $_POST[] array....
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) 
{ 
	if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone_no']) && !empty($_POST['status']) && !empty($_POST['email'])){
//dump to text file
$name=$_POST['first_name']." ".$_POST['last_name'];
  $_POST['email']=str_replace("||","",$_POST['email']); //clean up -----remove any ||
  $phone=$_POST['phone_no'];
  $status=$_POST['status'];
  $email=$_POST['email'];
	// $now=time(); //timestamp of form record insertion....
	  $insertSQL ="INSERT INTO users (name,phone_no,status, email) VALUES ('$name','$phone','$status','$email')";
	  
	  mysqli_select_db($db_link,$database); //first connection===mysqli_select_db(connection,dbname);
	  $Result1 = mysqli_query($db_link,$insertSQL) or trigger_error('No result found.');
//you can store the data on db too....
$success="We received your info. ";
	}//endof not-empty
	else {$error="Pls fill up form info!";}


}//end of isset
//---------------------------------------------------------------------------------------------------------------------
//very similar to insert querries.....
	  $updateSQL ="UPDATE `users` SET `name`='test name',`phone`='3434444',`status`='3',`email`='t@t.com' WHERE pk='3' ";
	  
	  $deleteSQL="DELETE FROM `users` WHERE pk=1";//is removed for good...
//--------------------------------------------------------------------------------------------------------
/*
====================================================================================================================================================
notes on db elements naming-------------------------
Naming Database Elements

Before you start working with databases, you have to identify your needs. The purpose of the application (or Web site, in this case) dictates how the database should be designed.

When creating databases and tables, you should come up with names (formally called identifiers) that are clear, meaningful, and easy to type. Also, identifiers

    Should only contain letters, numbers, and the underscore (no spaces)
    Should not be the same as an existing keyword (like an SQL term or a function name)
    Should be treated as case-sensitive
    Cannot be longer than 64 characters (approximately)
    Must be unique within its realm

This last rule means that a table cannot have two columns with the same name and a database cannot have two tables with the same name. You can, however, use the same column name in two different tables in the same database.<br />

To name a database's elements

    //Determine the database's name.
    This is the easiest and, arguably, least important step. Just make sure that the database name is unique for that MySQL server.

   // Determine the table names.
    The table names just need to be unique within this database, which shouldn't be a problem. For this example, which stores user registration information, the only table will be called users.<br />

    //Determine the column names for each table.
    The users table will have columns to store a user ID, a first name, a last name, an email address, a password, and the registration date.
=================================================================================================================================================================	
//top SQL Commands [visit http://www.1keydata.com/sql/sql-commands.html for more info]
    SQL SELECT
    SQL DISTINCT
    SQL WHERE
    SQL AND OR
    SQL IN
    SQL BETWEEN
    SQL Wildcard
    SQL LIKE
    SQL ORDER BY
    SQL GROUP BY
    SQL HAVING
    SQL ALIAS
    SQL AS
    SQL SELECT UNIQUE
    SQL INSERT INTO
    SQL INSERT INTO SELECT
    SQL UPDATE
    SQL DELETE FROM
---------------------------------------------------------------------------------------------------------------------------------
Ensuring Secure SQL:
1- Protecting the database access information
2- Being cautious when running queries, particular those involving user-submitted data.......using SSL.....not showing querries to the site visitors......sanitizing the data before db insertion 
///--------------------------------------------------------------------------------------------------------------------------------------------------
*/
//assignement=====create 3 pages: details, update, and remove for processing action columns of table
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<h2> PHP and MySQL- Insertion</h2>
<p> Here is an example of DB data insertion via HTML form</p>

<?php if (!empty($success)){echo $success;}
else if (!empty($error)){echo $error;}?>
<div align="center" style="margin-top:150px;">
<h3> HTML form and MySQL database processing with PHP</h3>
<p> After a form submission, its contents are saved on users table on test_db database. Download and import the users.sql file located on the root directory</p>
<p> Note that this page contains lots of coding hints for php, so practice the source codes by yourself. </p>

<h3><a href="index.html">Go Home</a></h3>

<form action="db.php" method="post" name="form1" id="form1" style="border:none;" align="center">
                   <div class="contact-text" >
                    
                          <input type="text" name="first_name" placeholder=" First Name*" value="" size="32" required />
                          
                     </div>
                     <div>     
                          <input type="text" name="last_name" value="" placeholder=" Last Name*" size="32"  required/>
                     </div>
                     <div>     
                        <input name="email" type="text" id="email" value="" placeholder="Email*" size="32" required />
                 
                    </div>
                        <div>
                   <select style="display:block; margin-bottom:10px;"  name="status"  required="required">
                                   <option value="" required> Please select your status*...</option>
                
                                                                        <option value="1"  >Middle School Student</option>
                                                                        <option value="2"  >High School Student </option>
                                                                        <option value="3"  >College Student </option>
                                                                        <option value="4"  >Others </option>
                           </select>
                    </div>
                    <div>      
                          <input type="text" name="phone_no" placeholder="Phone Number*:" value="" size="32" required />
                    </div>
                        <div>
                  <input type="submit" value="Contact Now" class="btn" id="continue_button" />
                                      
                       </div>       
                      
                      <input type="hidden" name="MM_insert" value="form1" />
                      
                      
                    </form>
</div>
<section style="clear:both; height:30px;"></section>

<h2> PHP and MySQL- View</h2>
<h4 style="color:red;"> After above form insertion, the data will show up in the below table</h4>
<p> Here is an example of DB record viewing</p>
<?php 
//DATE_FORMAT(column,'') is a MySQL function....
//as a reminder, we use MySQLi which is OOP for db connections
mysqli_select_db($db_link,$database);
$query = "SELECT *, DATE_FORMAT(date_inserted,'%W %M %D') As nice_date FROM users where pk>0  ORDER BY date_inserted DESC LIMIT 0,3";
$res = mysqli_query($db_link,$query) or trigger_error('No result found.'); //the 2ed part is optional...for error handling....
$totalRows = mysqli_num_rows($res);  //Counting Returned Records
//substr($row['subject'],0,50);

?>
 <table border="1">
          <tr>
            <td>Pk</td>
            <td>Name</td>
            <td>Status</td>
            <td>Date</td>
            <td>Phone</td>
            <td>Email</td>
                        <td>Action 1</td>
            <td>Action 2</td>
            <td>Action 3</td>

          </tr>
          <?php while ($row = mysqli_fetch_assoc($res)) { //loop through all db table  records?>
          <tr>
            <td><?php echo $row['pk']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['nice_date']; ?></td>
            <td><?php echo $row['phone_no']; ?></td>
             <td><?php echo $row['email']; ?></td>
     
             <td><a href="db.php?id=<?php echo $row['pk']; ?>">Details</a></td>  
                   <td><!---<a href="edit_db.php?id=<?php //echo $row['pk']; ?>">Edit</a>----> Edit</td>
                       <td><!---<a href="manage_db.php?id_r=<?php //echo $row['pk']; ?>">Remove</a>----> Remove</td>

          </tr>
          <?php }//end of while loop ?>
        </table>




</body>
</html>