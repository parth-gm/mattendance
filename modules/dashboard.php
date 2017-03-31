<?php
  include 'config1.php';
?>

<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Pending Attendance</h3>
  </div>
  <div class="panel-body">
    <p><a href="#">Class DB of <strong>23/02/2017</strong></a></p>
		<p><a href="#">Class Maths of <strong>24/02/2017</strong></a></p>
  </div>
</div>

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Today's Attendance</h3>
  </div>
  <div class="panel-body">
		<?php
			$query_subject = "SELECT subject.name, subject.id from subject INNER JOIN user_subject WHERE user_subject.id = subject.id AND user_subject.uid = {$_SESSION['uid']}  ORDER BY subject.name";
			$sub=$conn->query($query_subject);
			$rsub=$sub->fetchAll(PDO::FETCH_ASSOC);
			$today = date("d/m/Y");
			$todayQuery = date("d-m-Y");
			$noOfSubject = count($rsub);
			for($i = 0; $i<$noOfSubject; $i++) {
				print "<p><a href='index.php?subject=" . $rsub[$i]['id'] . "&date=" . $todayQuery ."'>Class <strong>" . $rsub[$i]['name'] ."</strong> of <strong>Today's</strong> (" . $today .")</a></p>";
			}
		?>
  </div>
</div>

<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">You have</h3>
  </div>
  <div class="panel-body">
    <p><i class="fa fa-book"></i> <a href="/class/list"><strong>2</strong> Subjects</a></p>
		<p><i class="fa fa-users"></i> <a href="/student/list"><strong>65</strong> Students</a></p>
  </div>
</div>

