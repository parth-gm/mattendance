<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	$present=0;
	$absent=0;
	$nottaken=0;
	$ttaken=0;
	include 'config.php';
	$strno=$_POST['rollno'];

	$sql = "SELECT name,sid FROM student where $strno=rollno";
	$stmt = $conn->prepare($sql); 

   	 $stmt->execute();
   	 $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
   	 //print_r($result);
   	 $tempnm=$result[0]['name'];
   	 $tempid=$result[0]['sid'];
   	 echo"<center>";
   	 echo "<table border='2'>";
   	 echo "<tr><strong><th colspan='3'>&nbsp&nbspRoll NO:". $strno ."&nbsp&nbsp</th><th colspan='3'>&nbsp&nbspName:". $tempnm ."&nbsp&nbsp</th><strong></tr>";
   	 echo "</table>";
   	echo"</center>";
   	echo"<br>";
   	 $sq= "SELECT DISTINCT date FROM attendance ORDER BY date";
   	 $stmt2 = $conn->prepare($sq);
   	 $stmt2->execute();
 	 $result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC); 
	   	 //print_r($result2);
	   	 //echo count($result2);
		     
		echo "<table border='2'>";
	     echo"<tr><th colspan='2'>SUBJECT</th>";
	     	for($k=0;$k<count($result2);$k++)
	     	{
	     		$tmdat=$result2[$k]['date'];
	     		echo"<th colspan='2'>$tmdat</th>";
	     	}
	     	 	
	     	echo"<th colspan='2'>TOTAL</th><th colspan='2'>PER%</th></tr>";
	    
	     $ssql = "SELECT id FROM student_subject where $tempid=sid";
	     $stmt3 = $conn->prepare($ssql);
		 $stmt3->execute();
	     $result3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);	
	     
	     for($nosub=0;$nosub<count($result3);$nosub++)
	     {
	     	$dpresent=0;
			$dabsent=0;
			$dnottaken=0;
			$dttaken=0;
	     	echo"<tr>";
	     	$sub=$result3[$nosub]['id'];
	     	echo"<td colspan='2'>$sub</td>";
		    for($i=0;$i<count($result2);$i++)
		   	 {
		   	 	$tmdat=$result2[$i]['date'];
		   	 	$sql1= "SELECT ispresent FROM attendance where sid=$tempid 		AND id=$sub AND date=$tmdat ORDER BY date";
		   	 	$stmt1 = $conn->prepare($sql1);	
		   	 	$stmt1->execute();
				$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);	 
				$ttaken++;
				$dttaken++;
				 if (empty($result1)) {
				 		echo " <td colspan='2'>NT</td>";
				 		$nottaken++;
				 		$dnottaken++;
				 }else
				 {
				 	$res=$result1[0]['ispresent'];
				 	if($res==1)
				 	{
						echo " <td colspan='2'>P</td>";
						$present++;
						$dpresent++;	
				 	}
		   	 		else
		   	 		{
		   	 			echo "<td colspan='2'>A</td>";
		   	 			$absent++;
		   	 			$dabsent++;
		   	 		}
				 }
				
		   	 }
		   	 	$dtlec=$dttaken-$dnottaken;
		   	 	if($dtlec!=0)
		   	 		$dtper=(100*$dpresent)/$dtlec;
		   	 	else
		   	 		$dtper=0;
		   	 	echo"<td colspan='2'>".$dpresent."/".$dtlec."</td>";
		   	 	echo"<td colspan='2'>".$dtper."</td>";
		   	 	echo"</tr>";

		 	
		  } 	 
		  echo "</table>";
		  $tlec=$ttaken-$nottaken;
		  $tper=(100*$present)/$tlec;
		  echo "<br>your present dayes out of working days:".$present."/".$tlec;
		  echo "<br>your attandance:".$tper."<br>";
		
		 
		  

?>
</body>
</html>