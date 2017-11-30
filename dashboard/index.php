<?php
session_start();
ob_start();

require_once '../dbconnect.php';

if(!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit;
}
$userRow=mysql_fetch_array(mysql_query("SELECT * FROM accounts WHERE ID= '".$_SESSION['user']."'"));
?>

<!DOCTYPE html>
<html>

<head>
  <title>Term Project</title>
  <link rel="stylesheet" href="static/semantic.min.css">
  <link rel="stylesheet" href="static/style.css">
  <link rel="stylesheet" href="static/font-awesome.css">
</head>

<body>
  <div>
    <div id="categories"> <!--The left dashboard -->
      <div id="cat-header">
        <h2><img src="static/whtsealm.png" style="width: 30px; height: 30px"></i>    Dashboard</h2>
      </div>
      <div class="container">
        
        <div class="ui list">
          <div class="item clickable">
            <div class="content">
              <a class="item">
   				<i class="icon plus"></i> Submit Forms
  			  </a>
            </div>
          </div>
          <?php if($userRow['accountType'] == 'AD') {  ?>
          <div class="item clickable">
            <div class="content">
              <a class="item">
   				<i class="icon checkmark box"></i> View Forms
  			  </a>
            </div>
          </div>
          <?php } ?>

          <div class="item clickable">
            <div class="content">
              <a class="item">
   				<i class="icon calendar"></i> Calendar
  			  </a>
            </div>
          </div>

          <div class="item clickable">
            <div class="content">
              <a class="item">
   				<i class="icon users"></i> Discussion Board
  			  </a>
            </div>
          </div>
          



        
      </div>
  </div>

  <div id="links-container">  <!-- Right Content Container -->
    <div id="toolbar">
      <div class="ui inverted icon fluid input" style="float: right; padding-top: 5px"> <!-- Profile Container -->
        <a class="ui image label" style="font-size: medium;"> 
  			<img src="static/person.png">
  			<?php echo $userRow['email']; ?>
  			<div class="detail"><?php echo $userRow['accountType']; ?></div>
		</a>
      </div><!-- Top Profile Bar -->
    </div>
    <div class="ui relaxed divided selection list">
      <h1 style="text-align: center; padding-top: 10%">Info Panel</h1>
      <h3 style="text-align: center;">Your Small Events</h3>
      <?php 
      $matches = [];
      $last_entry = mysql_fetch_array(mysql_query("SELECT * FROM small_program_proposals ORDER BY ID DESC LIMIT 1"))['ID'];
      for($i=1; $i<=$last_entry; $i++) {
        $smallFormMatch = mysql_fetch_array(mysql_query("SELECT * FROM small_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
        $count = mysql_num_rows(mysql_query("SELECT * FROM small_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
        if($count >= 1) {
          echo('<p style="text-align: center;">'.$smallFormMatch['title'].' STATUS: '.$smallFormMatch['status'].'</p>');
          array_push($matches, $smallFormMatch);
        }
      }
      ?>
      <h3 style="text-align: center;">Your Large Events</h3>
      <?php 
      $last_entry = mysql_fetch_array(mysql_query("SELECT * FROM big_program_proposals ORDER BY ID DESC LIMIT 1"))['ID'];
      for($i=1; $i<=$last_entry; $i++) {
        $bigFormMatch = mysql_fetch_array(mysql_query("SELECT * FROM big_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
        $count = mysql_num_rows(mysql_query("SELECT * FROM big_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
        if($count >= 1) {
          echo('<p style="text-align: center;">'.$bigFormMatch['title'].' STATUS: '.$bigFormMatch['status'].'</p>');
          array_push($matches, $bigFormMatch);
        }
      }
      ?>
    </div>
  </div>
    
  
  <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
  <script src="static/semantic.min.js"></script>
  <script src="dist/build.js"></script>
</body>

</html>
