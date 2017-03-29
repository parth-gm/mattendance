<?php
	include 'config1.php';
	
	$present=0;
	$absent=0;
	$nottaken=0;
	$ttaken=0;
	$strno=$_POST['rollno'];
	
	// Student data collection
	$sql = "SELECT name,sid,rollno FROM student where $strno=rollno";
	$stmt = $conn->prepare($sql); 
	$stmt->execute();
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?>

<?php if (count($result)) : ?>
	
		<?php
			$tempnm=$result[0]['name'];
			$tempid=$result[0]['sid'];
			$rollno=$result[0]['rollno'];
		?>

		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<h1 class="page-header"><?php print $tempnm . '<span>' . $rollno . '</span>'; ?>'s Attendance</h1>  
				</div>
			</div>
			<div class="row">
			<div class="col-md-12 col-lg-12">
			<?php
				if ($_POST['student'] === 'y' && isset($_POST['rollno'])) {
			
				 $sq= "SELECT DISTINCT date FROM attendance ORDER BY date";
				 $stmt2 = $conn->prepare($sq);
				 $stmt2->execute();
					$result2 = $stmt2->fetchAll(PDO::FETCH_ASSOC); 
					 //print_r($result2);
					 //echo count($result2);
						 
				echo "<table class='table table-striped table-hover'>";
					 echo"<tr><th>SUBJECT</th>";
						for($k=0;$k<count($result2);$k++)
						{
							$tmdat=$result2[$k]['date'];
							echo"<th>".date("d-m-Y",$tmdat)."</th>";
						}//echo(date("Y-m-d",$t));
							
						echo"<th>TOTAL</th><th colspan='2'>PER%</th></tr>";
					
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
						$subid=$result3[$nosub]['id'];
						$sqql = "SELECT name FROM subject where $subid=id";
						 $stmt4 = $conn->prepare($sqql);
					$stmt4->execute();
						$result4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);	
						$sub=$result4[0]['name'];
						echo "<td>$sub</td>";
						for($i=0;$i<count($result2);$i++)
						 {
							$tmdat=$result2[$i]['date'];
							$sql1= "SELECT ispresent FROM attendance where sid=$tempid 		AND id=$subid AND date=$tmdat ORDER BY date";
							$stmt1 = $conn->prepare($sql1);	
							$stmt1->execute();
						$result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);	 
						$ttaken++;
						$dttaken++;
						 if (empty($result1)) {
								echo " <td>NT</td>";
								$nottaken++;
								$dnottaken++;
						 }else
						 {
							$res=$result1[0]['ispresent'];
							if($res==1)
							{
								echo " <td>P</td>";
								$present++;
								$dpresent++;	
							}
								else
								{
									echo "<td>A</td>";
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
							echo"<td>".$dpresent."/".$dtlec."</td>";
							echo"<td>".$dtper."</td>";
							echo"</tr>";

					
					} 	 
					echo "</table>";
					$tlec=$ttaken-$nottaken;
					$tper=(100*$present)/$tlec;
					echo "<br>your present dayes out of working days:".$present."/".$tlec;
					echo "<br>your attandance:".$tper."<br>";
				
				 
					
				}
				else {
					header("location:../index.php");
				}

		?>
				</div>
			</div>
		</div>
<?php else: ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<h1>Sorry!</h1>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<p class="text-danger lead">Invalid Student Roll No.</p>
				<p><a href="index.php">Try Again</a></p>
			</div>
		</div>
	</div>
<?php endif; ?>