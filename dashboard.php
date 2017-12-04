<?php
session_start();
ob_start();

require_once 'dbconnect.php';

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
  <link rel="stylesheet" href="resources/static/semantic.min.css">
  <link rel="stylesheet" href="resources/static/style.css">
  <link rel="stylesheet" href="resources/static/font-awesome.css">
</head>

<body>
  <div>
    <div id="categories"> <!--The left dashboard -->
      <div id="cat-header">
        <h2><img src="resources/static/whtsealm.png" style="width: 30px; height: 30px"></i>    Dashboard</h2>
      </div>
      <div class="container">
        
        <div class="ui list">
          <div class="item clickable">
            <div class="content">
              <a class="item">
                <?php
                if($userRow['accountType'] != 'AD') { //RA code
                  echo('<div class="ui left dropdown item" style="padding-bottom: 0 !important;"> ');
                  echo('<i class="icon plus"></i> Submit forms'); 
                  echo('<div class="menu">');
                  echo('<div class="item" onclick="location.href='."'small_form.php';");
                  echo('"><i class="write square icon"></i>Small Community Form</div>');
                  echo('<div class="item" onclick="location.href='."'big_community_form.php';");
                  echo('"><i class="write square icon"></i>Big Community Form</div>');
                  echo('<div class="item" onclick="location.href='."'program_assessment.php';");
                  echo('"><i class="write square icon"></i>Program Assessment Form</div>');
                  echo('</div>');
                  echo('</div>');
                } else { //AD code 
                  echo('<i class="icon check"></i> View Forms');
                }
                ?>
  			      </a>
            </div>
          </div>

          <div class="item clickable">
            <div class="content">
              <a class="item">
   				<i class="icon calendar"></i> Calendar
  			  </a>
            </div>
          </div>

      </div>
    </div>
  </div>

  <div id="links-container">  <!-- Right Side Content Container -->
    <div id="toolbar">
      <div class="ui inverted icon fluid input" style="float: right; padding-top: 5px"> <!-- Profile Container -->
        <div class="ui inline dropdown" style=" padding-top: 7px">
            <div class="text">
              <a class="ui image label" style="font-size: medium;"> 
               <img src="resources/static/person.png">
               <?php echo $userRow['email']; ?>
              <div class="detail"><?php echo $userRow['accountType']; ?></div>
              </a>
            </div>
            <i class="dropdown icon"></i>
            <div class="menu">
              
              <div class="item" onclick="location.href='logout.php'"> <!--Instead of using 'a' tag, assign onclick to div would solve that problem -->
                 Sign Out
              </div>
            </div>
        </div>        

      </div><!-- Top Profile Bar -->
    </div>
<!-- Right Side Container below toolbar -->
    <div class="ui relaxed divided selection list">
      <!-- Annoucement Section -->
      <div class="ui blue message" style="margin:auto;"><!-- Welcome Section -->        
        Welcome to RPI ResLife Management System!        
      </div> 

      <div class="ui feed" id="TrackStatus" style="display:;"> <!-- Summanry php requires-->
        <div class="event"> 
          <div class="label">
            <i class="alarm outline icon"></i>
          </div>
          <div class="content"> <!-- small events-->
            <div class="summary">
              <?php if($userRow['accountType'] != 'AD') { ?>
              Your Small Events.
              <?php } else { ?>
              Unapproved small forms
              <?php } ?>

            </div>
            <div class="extra text">
              <div class="ui grid"> <!-- grid layout-->
            <?php
            if($userRow['accountType'] != 'AD') { //RA code
              $matches = [];
              $last_entry = mysql_fetch_array(mysql_query("SELECT * FROM small_program_proposals ORDER BY ID DESC LIMIT 1"))['ID'];
              for($i=1; $i<=$last_entry; $i++) {
                $smallFormMatch = mysql_fetch_array(mysql_query("SELECT * FROM small_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
                $count = mysql_num_rows(mysql_query("SELECT * FROM small_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
                if($count >= 1) {
                  echo('<div class="six wide column">');
                  echo('<a class="title">'.$smallFormMatch['title'].'</a>');
                  echo('</div>');
                  echo('<div class="six wide column">');
                  echo('STATUS: <a>'.$smallFormMatch['status']);
                  if ($smallFormMatch['status'] == "Unapproved") { //font-awesome
                    echo('<i class="hourglass start icon"></i>');
                  }
                  echo('</a><br></div>');
                  array_push($matches, $smallFormMatch);
                }
              }
            } else { //AD code 
              $last_entry = mysql_fetch_array(mysql_query("SELECT * FROM small_program_proposals ORDER BY ID DESC LIMIT 1"))['ID'];
              for($i=1; $i<=$last_entry; $i++) {
                $smallFormMatch = mysql_fetch_array(mysql_query("SELECT * FROM small_program_proposals WHERE ID='$i' AND status= 'Unapproved'"));
                $count = mysql_num_rows(mysql_query("SELECT * FROM small_program_proposals WHERE ID='$i' AND status= 'Unapproved'"));
                if($count >= 1) {
                  echo('<div class="ten wide column"><form action="view_small_forms.php" method="POST"');
                  echo('<a class="title">'.$smallFormMatch['title'].'</a>');
                  echo(' From: <a>'.$smallFormMatch['name'].'</a>');
                  echo('<input type="hidden" value="'.$smallFormMatch['ID'].'"  name="data"/>');
                  echo('<input type="submit" value="view event" name="view"/>');
                  echo('<br></form></div>');
                }
              }
            }
            ?>
            </div>
           </div>
          </div>
        </div>
        <div class="event"> 
          <div class="label">
            <i class="alarm outline icon"></i>
          </div>
          <div class="content"> <!-- large events-->
            <div class="summary">
              <?php if($userRow['accountType'] != 'AD') { ?>
              Your Large Events.
              <?php }else { ?>
              Unapproved large forms
              <?php } ?>
            </div>
            <div class="extra text">
              <div class="ui grid"> <!-- grid layout-->
            <?php
            if($userRow['accountType'] != 'AD') {
              $last_entry = mysql_fetch_array(mysql_query("SELECT * FROM big_program_proposals ORDER BY ID DESC LIMIT 1"))['ID'];
              for($i=1; $i<=$last_entry; $i++) {
                $bigFormMatch = mysql_fetch_array(mysql_query("SELECT * FROM big_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
                $count = mysql_num_rows(mysql_query("SELECT * FROM big_program_proposals WHERE ID='$i' AND email= '".$userRow['email']."'"));
                if($count >= 1) {
                  echo('<div class="six wide column">');
                  echo('<a class="title">'.$bigFormMatch['title'].'</a>');
                  echo('</div>');
                  echo('<div class="six wide column">');
                  echo('STATUS: <a>'.$bigFormMatch['status']);
                  if ($bigFormMatch['status'] == "Unapproved") { //font-awesome
                    echo('<i class="hourglass start icon"></i>');
                  }
                  echo('</a><br></div>');
                  array_push($matches, $bigFormMatch);
                }
              }
            } else {
              $last_entry = mysql_fetch_array(mysql_query("SELECT * FROM big_program_proposals ORDER BY ID DESC LIMIT 1"))['ID'];
              for($i=1; $i<=$last_entry; $i++) {
                $bigFormMatch = mysql_fetch_array(mysql_query("SELECT * FROM big_program_proposals WHERE ID='$i' AND status= 'Unapproved'"));
                $count = mysql_num_rows(mysql_query("SELECT * FROM big_program_proposals WHERE ID='$i' AND status= 'Unapproved'"));
                if($count >= 1) {
                  echo('<div class="ten wide column"><form action="view_big_forms.php" method="POST"');
                  echo('<a class="title">'.$bigFormMatch['title'].'</a>');
                  echo(' name: <a>'.$bigFormMatch['name'].'</a>');
                  echo('<input type="hidden" value="'.$bigFormMatch['ID'].'"  name="data"/>');
                  echo('<input type="submit" value="view event" name="view"/>');
                  echo('<br></form></div>');
                }
              }
            }
            ?>
            </div>
           </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
    
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="resources/static/semantic.min.js"></script>
  <script src="resources/static/main.js"></script>
</body>

</html>
