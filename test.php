<?php 
//===========================================================================================================
//this page introduces PHP and show you how to process an HTML form and save the info on a text file. 
//==================================================================================================================
///starting tag
//single line comment
/*
this is 
multiple line
comments
*/
//outputing contents to browser 
//echo 'helo <br>';
//print"Hi there"; //either single or dounble quotations
//-----------------------------------------------------
//all php variables start with dollar sign or $
$first="good day"; //one string
$b=12; //one numerical variable
$second="  Monday";
$cont=true; //true and false values
//Concatenating strings
//echo $first." is ".$second;
//php constant varilable
define("good", 100); //or define("name", "value");
//echo good;
$new=good.$second;
//------------------------------------------------------------------
//common debugging issues: syntax errors like missing quotation, ;, or $ or calling a function or variable that is not defined...or passing the wroing parameters to a function...
//------------------------------------------------------------------------------------------------------------------
//---------------------------------basics of Conditionals and Operators
if ($b>13)
		{
			echo "yes";
			
		}
		else
		{
			//echo "No";
		}
//-----------------------------------------------------------------------
if (!$cont){echo "stop here!";} //how to call true and false variables
//--------------------------------------------------------------------------------------------------
if ($second=="Monday" || $b>13){echo "successs";}
if ($second=="Monday" && $b==13){echo "successs";}
//------------------------------------------------------------------------------------------------------
$my_array=array(); //here you define an empty array
//An array is a special variable, which can hold more than one value at a time.
//Indexed arrays-----index no begins with zero
$index=array();
$index[0]='mon';
$index[1]='tue';
$index[2]='wed';
//echo $index[1];
$x=NULL; //or '';  =====to define a null value or empty varilable
$my_array['a']=3;//associate array....key=> value   //key values must ne uniques...no space...
$my_array['b']=4;
//echo $my_array['b'];
//////////////////////////////////////////////////////////
//anonymous array=====it is an indexed array whose index numbers are are added automatically....
$val[]=1;
$val[]=2;
$val[]=3;
//Multidimensional arrays - Arrays containing one or more arrays  [more complex forms of arrays]
// 
//Global arrays===============all of them are associate arrays============they are very important!!!!
//$_GET, $_POST,$_FILES, $_SESSION, and $_SERVER;
//-------------------------------------------------------------------------------------------
//PHP loops.....repeating an action over and over until a condition is met....
//three common loops: for, foreach, and while
//for loop
for ($i=1; $i<=4; $i++) 
{
  //echo $i;
  //if ($i>3){echo "Hello. ";}	
}//end of loop
//---------------------------------------
foreach($my_array as $key=>$value)
{
	//if ($val>3){echo $key;}
}
//whiie loop is mainly used with db data fetching.....
//while(condition that should be met){}
//
//----------------------------------------------------------------------------
//how to process query string in a url
$id=$value="";
if (!empty($_GET['id'])){$id=$_GET['id'];}
if (!empty($_GET['val'])){$value=$_GET['val'];}
echo $id." <br>".$value;
//create a function....
function get_info($a,$b) //parameters are optional
{
	$c=$a+$b;
	$res=$c*100;
	//echo $res;
	return $res;
	
}
////
$wanted=get_info(2,7); //call the function and store the return value in a variable...
//echo $wanted;
//end of php code?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php //if form action attribute was get, we use $_GET[] array instead of $_POST[] array....
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) 
{ 
	if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone_no']) && !empty($_POST['status']) && !empty($_POST['email'])){
//dump to text file
$name=$_POST['first_name']." ".$_POST['last_name'];
  $_POST['email']=str_replace("||","",$_POST['email']); //clean up -----remove any ||
	 $now=time(); //timestamp of form record insertion....
	 //dump 
  $res=$name."||".$_POST['status']."||".$_POST['email']."||".$_POST['phone_no']."||".$now.",";
  //we put info in the text file
  //IMPORTANT: instand of url address(http://localhost/test_php/form_info.txt) use the root file address like C:/xampp/htdocs/test_php/form_info.txt
  $mc_address="C:/xampp/htdocs/test_php/form_info.txt"; 
//store data on a local file
file_put_contents($mc_address,$res,FILE_APPEND | LOCK_EX); //we append to the end of previous insertion
//you can store the data on db too....
$success="We received your info. ";
	}//endof not-empty
	else {$error="Pls fill up form info!";}


}//end of isset
?>
<?php if (!empty($success)){echo $success;} else if (!empty($error)){echo $error;}?>
<!-----below is a basic contact form----->
<div align="center" style="margin-top:150px;">
<h3><a href="index.html">Go Home</a></h3>

<h3> HTML form processing with PHP</h3>
<p> After a form submission, its contents are save on a text file on your project root directory called form_info.txt</p>
<p> Note that this page contains lots of coding hints for php, so practice the source codes by yourself. </p>
<form action="test.php" method="post" name="form1" id="form1" style="border:none;" align="center">
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
<div>
<a href="test.php?id=1&val=phpisgood">This is for URL query string</a>
</div>

</body>
</html>