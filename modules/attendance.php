<?php include 'config.php';?>
<?php
	$updateFlag = 0;
?>


<h1 class="page-header">Take Attendance</h1>  
<form action="index.php" method="get">
	<div class="form-group">
		<label for="select" class="">Subject</label>
		<?php
			$sub=$conn->query('select * from subject ');
			$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
			echo"<select name='subject' class='form-control'>";
			for($i = 0; $i<count($rsub); $i++)
			{
				if ($_GET['subject'] == $rsub[$i]['id']) {
					echo"<option value='". $rsub[$i]['id']."' selected='selected'>".$rsub[$i]['name']."</option>";
				}
				else {
					echo"<option value='". $rsub[$i]['id']."'>".$rsub[$i]['name']."</option>";
				}
			}
			echo"</select>";
		?>									
	</div>

	<div class="form-group input-group date" data-provide="datepicker">
		<label for="select" class="">Date</label>
		<input type="date" class="form-control" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>">
	</div>

	<input type="submit" class="btn btn-default" name="sbt_stn" value="Load Student">
</form>
	


<?php
	if(isset($_GET['date']) && isset($_GET['subject'])) :

?>
<form action="index.php" method="post">
<table class="table table-striped table-hover ">
	<thead>
		<tr>
			<th>Roll No</th>
			<th>Name</th>
			<th><input type="checkbox" class="chk-head" /> isPresent</th>
		</tr>
	</thead>

	<?php
			

		$que= "SELECT sid, aid, ispresent  from attendance  WHERE id  = {$_GET['subject']} ORDER BY sid";
		$ret=$conn->query($que);
		$attData=$ret->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($attData))
		{
			$updateFlag=1;
		}
		else{
			$updateFlag=0;

		}

			$qu = "SELECT student.sid, student.name, student.rollno from student INNER JOIN student_subject WHERE student.sid = student_subject.sid AND student_subject.id  = {$_GET['subject']}  ORDER BY student.sid";
		$stu=$conn->query($qu);
		$rstu=$stu->fetchAll(PDO::FETCH_ASSOC);

		
		echo"<tbody>";
		for($i = 0; $i<count($rstu); $i++)
		{
			echo"<tr>";

			if($updateFlag) {
				echo"<td>".$rstu[$i]['rollno']."<input type='hidden' name='st_sid[]' value='" . $rstu[$i]['sid'] . "'>" ."<input type='hidden' name='att_id[]' value='" . $attData[$i]['aid'] . "'>".  "</td>";
				echo"<td>".$rstu[$i]['name']."</td>";

				
					if(($rstu[$i]['sid'] ==  $attData[$i]['sid']) && ($attData[$i]['ispresent']))
					{

						echo "<td><input class='chk-present' checked type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
					}
					else
					{
						echo "<td><input class='chk-present' type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";
					}
				}
				else {
					echo"<td>".$rstu[$i]['rollno']."<input type='hidden' name='st_sid[]' value='" . $rstu[$i]['sid'] . "'></td>";
					echo"<td>".$rstu[$i]['name']."</td>";
					echo"<td><input class='chk-present' type='checkbox' name='chbox[]' value='" . $rstu[$i]['sid'] . "'></td>";	
				}
				
				
			echo"</tr>";
		}
		echo"</tbody>";
	
	?>
</table> 

<?php if($updateFlag) : ?>
	<input type="hidden" name="updateData" value="1">
<?php else: ?>
	<input type="hidden" name="updateData" value="0">
<?php endif; ?>

<input type="hidden" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>">
<input type="hidden" name="subject" value="<?php print isset($_GET['subject']) ? $_GET['subject'] : ''; ?>">
<input type="submit" class="btn btn-primary" name="sbt_top" value="Save Attendance">

<?php endif;?>
</form>
<?php

	if (isset($_POST['sbt_top'])) {
		if(isset($_POST['updateData']) && ($_POST['updateData'] == 1) ) {
				
			// prepare sql and bind parameters
		    $date = 888;
		    $id = $_POST['subject'];
		    $uid = 1;
		    $p = 0;
		    $st_sid =  $_POST['st_sid'];
		    $attt_aid =  $_POST['att_id'];
		    $ispresent = array();
		    if (isset($_POST['chbox'])) {
		    	$ispresent =  $_POST['chbox'];	
		    }
		    
		    for($j = 0; $j < count($st_sid); $j++)
		    {
		    		echo "hii";
					// UPDATE `attendance` SET `ispresent` = '1' WHERE `attendance`.`aid` = 79;

		    		$stmtInsert = $conn->prepare("UPDATE attendance SET ispresent = :isMarked WHERE aid = :aid"); 
									    
				    if (count($ispresent)) {
				    	$p = (in_array($st_sid[$j], $ispresent)) ? 1 : 0;	
				    }
		    		
				    $stmtInsert->bindParam(':isMarked', $p);
				    $stmtInsert->bindParam(':aid', $attt_aid[$j]); 
				    $stmtInsert->execute();
					echo "data upadted";
			}		


		}
		else {
			
			// prepare sql and bind parameters
		    $date = 888;
		    $id = $_POST['subject'];
		    $uid = 1;
		    $p = 0;
		    $st_sid =  $_POST['st_sid'];
		    $ispresent = array();
		    if (isset($_POST['chbox'])) {
		    	$ispresent =  $_POST['chbox'];	
		    }
		    
		    for($j = 0; $j < count($st_sid); $j++)
		    {
		    		echo "hii";
		    		$stmtInsert = $conn->prepare("INSERT INTO attendance (sid, date, ispresent, uid, id) 
					VALUES (:sid, :date, :ispresent, :uid, :id)");
				    
				    if (count($ispresent)) {
				    	$p = (in_array($st_sid[$j], $ispresent)) ? 1 : 0;	
				    }
		    		

				    $stmtInsert->bindParam(':sid', $st_sid[$j]);
				    $stmtInsert->bindParam(':date', $date);
				    $stmtInsert->bindParam(':ispresent', $p);
				    $stmtInsert->bindParam(':uid', $uid);
				    $stmtInsert->bindParam(':id', $id); 
				    $stmtInsert->execute();
					echo "data upadted".$j;
			}		
		}
	}			




?>