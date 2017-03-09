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
	<input type="submit" class="btn btn-primary" name="sbt_top" value="Save Attendance">

<table class="table table-striped table-hover ">
	<thead>
		<tr>
			<th>Roll No</th>
			<th>Name</th>
			<th>isPresent</th>
		</tr>
	</thead>

	<?php
	
			
		$st=$conn->query('select * from student');
		$r=$st->fetchAll(PDO::FETCH_ASSOC);
		echo"<tbody>";
		for($i = 0; $i<count($r); $i++)
		{
			echo"<tr>";
				echo"<td>".$r[$i]['rollno']."</td>";
				echo"<td>".$r[$i]['name']."</td>";
				echo"<td><input type='checkbox' name='chbox[]' value='" . $r[$i]['sid'] . "'></td>";
			echo"</tr>";
		}
		echo"</tbody>";
	
	?>
</table> 

<input type="submit" class="btn btn-primary" name="sbt_top" value="Save Attendance">