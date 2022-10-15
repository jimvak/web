<?php

session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "activity"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


$mytime="";

$avg_waits=array();





	
//dimourgoume ta antistoixa conditions etsi wste
//stin sinexeia na valoume tis antistoixes sinthikes sto where 

if(isset($_POST['day']))
{  
//condition gia tin imera  
$condition_day = " and entries.day_request in(";

//flag to opoio mas deixnei an exei epileksei kai alles imeres o xristis
$flag_cond=0;

//gia kathe mia apo tis imeres pou exei epileksei o xristis
foreach ($_POST['day'] as $myday)

{
	//an den exoun mpei alles pio prin
	if($flag_cond==0)
	{
		//den vazoume komma
	$condition_day = $condition_day . "'". $myday. "'";
	$flag_cond=1;
	}
	//alliws tha valoume komma 
	else
		
	{
		$condition_day = $condition_day . ",'". $myday. "'";
	}
	
}

$condition_day = $condition_day . ")";

}

if(isset($_POST['contype_selected']))
{
	//akolouthoume paromoia diadikasia gia to content type
$condition_content = " and header.con_type in(";
$flag_content=0;

foreach ($_POST['contype_selected'] as $mycontent)

{
	//an den exoun mpei alles pio prin
	if($flag_content==0)
	{
		//den vazoume komma
	$condition_content = $condition_content . "'". $mycontent. "'";
	$flag_content=1;
	}
	//alliws tha valoume komma 
	else
		
	{
		$condition_content = $condition_content . ",'". $mycontent. "'";
	}
	
}

$condition_content = $condition_content . ")";

}
//idia diadikasia gia to method type 


if(isset($_POST['method_selected']))
{

$condition_method = " and request.method in(";
$flag_method=0;

foreach ($_POST['method_selected'] as $mymethod)

{
	//an den exoun mpei alles pio prin
	if($flag_method==0)
	{
		//den vazoume komma
	$condition_method = $condition_method . "'". $mymethod. "'";
	$flag_method=1;
	}
	//alliws tha valoume komma 
	else
		
	{
		$condition_method = $condition_method . ",'". $mymethod. "'";
	}
	
}

$condition_method = $condition_method . ")";
}

if(isset($_POST['isp_selected']))
{
//idia diadikasia kai gia ton isp
$condition_isp= " and entries.paroxos in(";
$flag_isp=0;

foreach ($_POST['isp_selected'] as $myisp)

{
	//an den exoun mpei alles pio prin
	if($flag_isp==0)
	{
		//den vazoume komma
	$condition_isp = $condition_isp . "'". $myisp. "'";
	$flag_isp=1;
	}
	//alliws tha valoume komma 
	else
		
	{
		$condition_isp = $condition_isp . ",'". $myisp. "'";
	}
	
}

$condition_isp = $condition_isp . ")";
}

$condition="";

//elegxw olous tous dynatous sindyasmous apo filtra
//pou mporei na exei dwsei o xristis(admin)
//einai 16 diaforetikoi sindiasmoi

//analoga me tin periptwsi enimeronetai kai i antistoixi 

//metavliti condition h opoia tha mpei san sinthiki sto where
//etsi wste na filtraroume ta apotelesmata
if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
		$condition = $condition. $condition_day;
	}
	
else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
		$condition = $condition. $condition_content;
	
	}
	
else if(!isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	   $condition = $condition. $condition_method;
	}


else if(!isset($_POST["day"]) && !isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
		$condition = $condition. $condition_isp;
		
	}
	
else if(isset($_POST["day"]) && isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	$condition = $condition. $condition_day. $condition_content;
	}	

else if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	$condition = $condition. $condition_day. $condition_method;

	}
	
else if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	
	 $condition = $condition. $condition_day. $condition_isp;

	}	
	
	
else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	 $condition = $condition. $condition_content. $condition_method;

	}	

else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	   $condition = $condition. $condition_conent. $condition_isp;
	
	}
	
else if(!isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	 
	 $condition = $condition. $condition_method. $condition_isp;

	}

else if(isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	 $condition = $condition. $condition_day. $condition_content. $condition_method;

	}
	
else if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	
	$condition = $condition. $condition_day. $condition_method. $condition_isp;

	}

else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	 
	 $condition = $condition. $condition_content. $condition_method. $condition_isp;

	}


else if(isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
		
	
	$condition = $condition.$condition_day. $condition_content. $condition_method. $condition_isp;

		
	}

else

{
  $condition = "";

}
//gia kathe diaforetiki ora tis imeras 
for($i=0;$i<24;$i++)

{
	//diamorfono katalila to alfarithmitiko pou
	//tha xrisimopoieithei sto select gia na filtrarw me vasi tin ora 
  if($i<10)
  {	  
  $mytime  = "%T0".$i.'%';	
  }
  
  else
	  
  
  {
	    $mytime  = "%T".$i.'%';	

	  
  }
  //an den exei dwsei kapoio filtro, tote ektelw to select xwris kapoia epipleon sinthiki
  if($condition=="")
	  
	  {
  
 $sql = "SELECT AVG(wait) as mesos FROM entries  WHERE entries.st_date_time LIKE '$mytime'  HAVING AVG(wait)>0";
 
	  }
	  
else

//diaforetika prosthetw tin sinthiki me vasi to dinamiko condition pou eftiaksa proigoumenws
//alla tha xreiastei na sindesw kai ton pinaka entry me ton header kai ton request
//etsi wste na leitoyrgisoun ta pollapla filtra
{
  $sql = "SELECT AVG(entries.wait) as mesos FROM entries INNER JOIN request on request.kodikos_entry = entries.kodikos INNER JOIN header ON header.r_id = request.kodikos  WHERE entries.st_date_time LIKE '$mytime' $condition  HAVING AVG(wait)>0";

}

 $result = $con->query($sql);


if($result->num_rows >0)

 {
		$row = $result->fetch_assoc();
		array_push($avg_waits, $row['mesos']);


 }
 
 else
	 
	 {
	
	     array_push($avg_waits, 0);
 
		 
	 }

}	


echo json_encode($avg_waits);


?>