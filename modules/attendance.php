<?php include 'config.php';?>
<h1 class="page-header">Take Attendance</h1>  
<form action="attendance.php" method="post">
	<div class="form-group">
		<label for="select" class="">Subject</label>
		<?php
			$sub=$conn->query('select * from subject ');
			$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
			echo"<select class='form-control'>";
			for($i = 0; $i<count($rsub); $i++)
			{
				echo"<option value='". $rsub[$i]['id']."'>".$rsub[$i]['name']."</option>";
			}
			echo"</select>";
		?>									
	</div>

	<div class="form-group input-group date" data-provide="datepicker">
		<label for="select" class="">Date</label>
		<input type="date" class="form-control">
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
	if(false)
	{

	}
	else
	{
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
	}
	?>
</table> 

<input type="submit" class="btn btn-primary" name="sbt_top" value="Save Attendance">