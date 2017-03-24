<?php //this page contains 10 sample SELECT statement that you can use....
//select only one column & show all results
$query = "SELECT email FROM users";
//select multiple columns
$query = "SELECT email, phone_no FROM users";
//select all columns with filtering condition
$query = "SELECT * FROM users where pk>0 ";
//sorting data DESC=====latest date show up first
$query = "SELECT * FROM users where pk>0  ORDER BY date_inserted DESC";
//only seeing the first 3 records
$query = "SELECT * FROM users where pk>0  ORDER BY date_inserted DESC LIMIT 0,3";
//adding As and mysql function: DATE_FORMAT
$query = "SELECT *, DATE_FORMAT(date_inserted,'%W %M %D') As nice_date FROM users where pk>0  ORDER BY date_inserted DESC LIMIT 0,3";
//using IN function.....also, you can use NOT IN()
$query = "SELECT  * FROM users where pk IN(1,2)";
//using OR condition
$query = "SELECT * FROM users where (pk=3) OR (pk=4)";
//using and condition
$query = "SELECT * FROM users where pk>0 AND name='matt' ";
//using BETWEEN
$query = "SELECT * FROM users where pk BETWEEN 1 AND 5 ";
//----------------------------------------------------------------------------------------------------------
echo "This page contains 10 sample SELECT statement that you can use....view source file for queries<br>";

?><h3><a href="index.html">Go Home</a></h3>