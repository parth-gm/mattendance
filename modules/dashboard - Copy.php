<?php
  include 'config1.php';
	$todayYMD = date("Y-m-d");
	$today = date("d/m/Y");
	$todayQuery = date("d-m-Y");
	$todayTimestamp = strtotime($today);
?>

<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Pending Attendance</h3>
  </div>
  <div class="panel-body">
    <p><a href="#">Class DB of <strong>23/02/2017</strong></a></p>
		<p><a href="#">Class Maths of <strong>24/02/2017</strong></a></p>
		
		<?php
			
			for($i = 1; $i < 6; $i++) {
				// print 'Today ---' . $today;
				print strtotime($todayYMD ." -$i day");
				
				$dateCurrent = date('d/m/Y', strtotime($todayYMD ." -$i day"));
				$dateCurrentYMD = date('Y-m-d', strtotime($todayYMD ." -$i day"));
				print "Current Date " . $dateCurrentYMD ."<br />";
				
				$queryTimeStamp = strtotime($dateCurrentYMD);
				print "queryTimeStamp Date " . $queryTimeStamp ."<br />";
				
				$query_attendance = "SELECT subject.name, subject.id, attendance.date from subject INNER JOIN attendance WHERE attendance.id = subject.id AND attendance.uid = {$_SESSION['uid']} AND attendance.date = {$queryTimeStamp} ORDER BY subject.name";
				
				print '----';
				print $query_attendance;
				print '====';
				
				/*
				$subAtt=$conn->query($query_attendance);
				$rsubAtt=$subAtt->fetchAll(PDO::FETCH_ASSOC);
				
				$attFound = count($rsubAtt);
				$resultDate = $rsubAtt[$i]['date'];
				if ($attFound) {
					// print "<p>Great! Attendance Recorded</p>";
					print "<p>Great! Attendance Recorded of <strong>" . $dateCurrent ."</strong></p>";
				}
				else{
					/*for($i = 0; $i<$attFound; $i++) {
						print "<p><a href='index.php?subject=" . $rsubAtt[$i]['id'] . "&date=" . $dateCurrent ."'>Class <strong>" . $rsubAtt[$i]['name'] ."</strong> of <strong>" . $dateCurrent ."</strong></a></p>";
					}
				}
				*/
			}
			
			/*
			for($i = 1; $i < 5; $i++) {
				print 'Today ---' . $today;
				print strtotime($todayYMD ." -$i day");
			
				$dateCurrent = date('d/m/Y', strtotime($todayYMD ." -$i day"));
				print "Current Date " . $dateCurrent ."<br />";
				
				$queryTimeStamp = strtotime($dateCurrent);
				print "queryTimeStamp Date " . $queryTimeStamp ."<br />";
				
				$query_attendance = "SELECT subject.name, subject.id, attendance.date from subject INNER JOIN attendance WHERE attendance.id = subject.id AND attendance.uid = {$_SESSION['uid']} ORDER BY subject.name";
				$subAtt=$conn->query($query_attendance);
				$rsubAtt=$subAtt->fetchAll(PDO::FETCH_ASSOC);
				
				$attFound = count($rsubAtt);
				$resultDate = $rsubAtt[$i]['date'];
				if ($resultDate == $queryTimeStamp) {
					print "<p>Great! Attendance Recorded</p>";
				}
				else{
					for($i = 0; $i<$attFound; $i++) {
						print "<p><a href='index.php?subject=" . $rsubAtt[$i]['id'] . "&date=" . $dateCurrent ."'>Class <strong>" . $rsubAtt[$i]['name'] ."</strong> of <strong>" . $dateCurrent ."</strong></a></p>";
					}
				}
			}*/
		?>
		
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

