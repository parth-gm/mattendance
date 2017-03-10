<?php include 'config.php';?>
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
			<th>isPresent</th>
		</tr>
	</thead>

	<?php
			
			$qu = "SELECT student.sid, student.name, student.rollno from student INNER JOIN student_subject WHERE student.sid = student_subject.sid AND student_subject.id  = {$_GET['subject']}";
		$st=$conn->query($qu);
		$r=$st->fetchAll(PDO::FETCH_ASSOC);
		echo"<tbody>";
		for($i = 0; $i<count($r); $i++)
		{
			echo"<tr>";
				echo"<td>".$r[$i]['rollno']."</td>";
				echo"<td>".$r[$i]['name']."</td>";
				/*if ($_GET['chbox[]'] == $r[$i]['id']) {
					echo"<option value='". $r[$i]['id']."' selected='selected'>".$r[$i]['name']."</option>";
				}*/
				echo"<td><input type='checkbox' name='chbox[]' value='" . $r[$i]['sid'] . "'></td>";
			echo"</tr>";
		}
		echo"</tbody>";
	
	?>
</table> 

<input type="hidden" name="saveData" value="1">
<input type="hidden" name="date" value="<?php print isset($_GET['date']) ? $_GET['date'] : ''; ?>">
<input type="hidden" name="subject" value="<?php print isset($_GET['subject']) ? $_GET['subject'] : ''; ?>">
<input type="submit" class="btn btn-primary" name="sbt_top" value="Save Attendance">

<?php endif;?>
</form>
<?php

	if(isset($_POST['saveData']) ) {
	
		// prepare sql and bind parameters
	    $stmtInsert = $conn->prepare("INSERT INTO attendance (sid, date, ispresent, uid, id) 
	    VALUES (:sid, :date, :ispresent, :uid, :id)");
	    $stmtInsert->bindParam(':sid', $sid);
	    $stmtInsert->bindParam(':date', $date);
	    $stmtInsert->bindParam(':ispresent', $ispresent);
	    $stmtInsert->bindParam(':uid', $uid);
	    $stmtInsert->bindParam(':id', $id);

	    $sid = 3;
	    $date = 664;
	    $ispresent = 1;
	    $uid = 3;
	    $id = 1;
	    $stmtInsert->execute();
		
	}
	




?>