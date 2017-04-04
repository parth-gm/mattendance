<?php include 'config1.php';?>
<?php
	//echo"Take a view here";
	$suid = $_SESSION['uid'];
	//echo $suid;
?>

<div class="container">
  <div class="row">
    <div class="col-md-12 col-lg-12">
			<h1 class="page-header">Reports</h1>  
		</div>
	</div>

	<div class="row">
		<div class="col-md-12 col-lg-12">
			<form action="" method="GET" class="form-inline" data-toggle="validator">
				<div class="form-group">
					<label for="select" class="control-label">Subject:</label>
					<?php
						$query_subject = "SELECT subject.name, subject.id from subject 
					INNER JOIN user_subject WHERE user_subject.id = subject.id AND user_subject.uid = $suid  ORDER BY subject.name";
						$sub=$conn->query($query_subject);
						$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
						//print_r($rsub);
						$subnm=$rsub[0]['name'];
						$subid=$rsub[0]['id'];
						//echo "<h3>".$subnm." ".$subid."</h3>";
					
						echo "<select name='subject' class='form-control' required='required'>";
						for($i = 0; $i<count($rsub); $i++)
						{
							if ($_GET['subject'] == $rsub[$i]['id']) {
								echo"<option value='". $rsub[$i]['id']."' selected='selected'>".$rsub[$i]['name']."</option>";
							}
							else {
								echo"<option value='". $rsub[$i]['id']."'>".$rsub[$i]['name']."</option>";
							}
						}
						echo "</select><br>";
					?>
				</div>
				
				<div class="form-group" data-provide="datepicker">
					<label for="select" class="control-label">From:</label>
					<input type="date" name="sdate" class="form-control" required>
				</div>
				
				<div class="form-group" data-provide="datepicker">
					<label for="select" class="control-label">To:</label>
					<input type="date" name="edate" class="form-control" required>
				</div>
				
				<input type="hidden" name="page" value="reports">
				<input type="submit" class="btn btn-info" name="submit" value="Load Student">
			</form>
		</div>	
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="report-data">
			<?php

				
				$t=time();

				if(isset($_GET['submit']) && !empty($_GET['sdate']) && !empty($_GET['edate']) && ($_GET['edate'] > $_GET['sdate']) && ($_GET['sdate']<$t) && ($_GET['edate']<$t))
				{
					$sdat = $_GET['sdate'];
					$edat= $_GET['edate'];

					$selsub=$_GET['subject'];
					
					$sdate = strtotime($sdat);
					
					$edate = strtotime($edat);
					// echo "sub id".$selsub."<br>";
					// echo "user id".$suid."<br>";
					// echo "starting date:".$sdat." "."ending date:".$edat."<br>";
					// $query_student="SELECT * from student ";
					$query_student = "SELECT student.sid, student.name, student.rollno from student INNER JOIN student_subject WHERE student.sid = student_subject.sid AND student_subject.id  = {$selsub}  ORDER BY student.sid";
					$stu=$conn->query($query_student);
					$rstu=$stu->fetchAll(PDO::FETCH_ASSOC);
				//	print_r($rstu);
				//	echo "<br><br>--------------<br>";
					echo "<table class='table table-striped table-hover'>";
					echo "<thead>";
					echo "<tr>";
					echo "<th>Roll No</th>";
					echo "<th>Name</th>";
					for($k=$sdate;$k<=$edate;$k=$k+86400)
					{
						$thisDate = date( 'd-m-Y', $k );
						$weekday= date("l", $k );
						$normalized_weekday = strtolower($weekday);
						if(($normalized_weekday!="saturday") && ($normalized_weekday!="sunday"))
						{
							echo "<th>".$thisDate."</th>";
						}
					}
					echo "<th>pres/total</th>";
					echo "<th>percent</th>";;
					echo "</tr>";
					echo "</thead>";
					echo "</tbody>";
					for($i=0;$i<count($rstu);$i++)
					{
						//echo $i."--"."<br>";
						$present=0;
						$absent=0;
						$totlec=0;
						$perc=0;
						echo"<tr><td>".$rstu[$i]['rollno']."</td>";
						echo "<td>".$rstu[$i]['name']."</td>";
						$dsid=$rstu[$i]['sid'];
						
						for($j=$sdate;$j<=$edate;$j=$j+86400)
						{
							 //$thisDate = date( 'Y-m-d', $j );
							 //echo "$j"."=".$thisDate."<br>";
				
							$weekday= date("l", $j );
							$currentDate = date('Y-m-d', $j);
							$normalized_weekday = strtolower($weekday);
							 if(($normalized_weekday!="saturday") && ($normalized_weekday!="sunday"))
							 {


								 $sql = "SELECT sid ,ispresent FROM attendance WHERE sid=$dsid AND
								 id=$selsub AND date=$j AND $suid=uid " ;
								$stmt = $conn->prepare($sql); 
								$stmt->execute();
								$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
								if(!empty($result)){
								//print_r($result);
									$totlec++;
									if($result[0]['ispresent']==1)
									{
										$present++;
										echo"<td>Present</td>";
									}
									else
									{
										echo"<td>Absent</td>";
										$absent++;
									}
								}else
								{
									echo "<td><a href='index.php?subject=" . $selsub . "&date=" . $currentDate . "'>TakeAttendance</a></td>";
								}
							}
						}
						$perc=(($present*100)/$totlec);
						echo"<td>".$present."/".$totlec."</td>";
						echo"<td>".$perc."</td>";
						echo"</tr>";
						
					}		
					echo "</tbody>";
					echo "</table>";

				}else{
					// echo"<h3>Please enter detail</h3>";
				}



			?>
			</div>
		</div>
	</div>
</div>