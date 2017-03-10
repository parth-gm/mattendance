
<div class="container">
	
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-lg-6">
			<img src="images/mattendance_logo_small.png" alt="mAttendance">
			<h4>Teacher's Section</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-lg-6>
			<form class="form-horizontal" action="modules/verify.php" method="post">
				<div class="form-group">
					<label for="inputEmail3" class="control-label">Username</label>
					<input type="text" class="form-control" id="inputEmail3" name="name" placeholder="Username">
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="control-label">Password</label>
					<input type="password" class="form-control" id="inputPassword3"  name="pass" placeholder="Password">
				</div>

				<div class="form-group">
					<button type="submit" name="submit" class="btn btn-default">Sign in</button>
				</div>
			</form>
		</div>
	</div>
	<hr class="col-md-offset-3 col-md-6" />
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-lg-6">
			<h4>Student's Section</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3 col-lg-6>
			<form class="form-horizontal" action="modules/studentdata.php" method="post">
				<div class="form-group">
					<label for="rollno" class="control-label">Roll No.</label>
					<input type="text" class="form-control" id="rollno"  name="rollno" placeholder="Roll No.">
				</div>
			</form>
		</div>	
	</div>
</div>