<?php include './includes/title.php'; ?>
<?php require './includes/DynaSel.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Q Shift Scheduler<?= $title ?></title>
    <link href="styles/sft.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <h1>Q Shifter</h1>
</header>
<div id="wrapper">
   <?php require './includes/menu.php'; ?>
    <main>
        <h2></h2>
        <div id="mainContainer">
<div id="content">

<form action="" method="post">
<?php require './includes/connDB.php'; ?>
<?php

$emid = "Qing";
$workt = 0;
$wweek = 1;
$years =array("2018","2019","2020","2021");
$corp="Qing";
echo "<h2>".$corp ."'s Shifter </h2>";
$projects =array("P18N01","P18N02","P18N03","P18N04",
                 "P19N01","P19N02","P19N03","P19N04",
                 "P20N01","P20N02","P20N03","P20N04",
                 "P21N01","P21N02","P21N03","P21N04");
$ddate = "20190101";
$iid = 2;
$mmonth = 1;
//$wday0 = "TUE";
$curr_guy = "Neol";
$guys = array (1=>"Alex", "Bent", "Creg", "Dick", "Emma", "Fion", "Geog", "Henr","None","Xxxx");
$days = array(1=>"MON", "TUE", "WED", "THU", "FRI", "SAT","SUN" ); 

$weeks = array(1=>
            "01","02","03","04","05","06","07","08","09","10",
            "11","12","13","14","15","16","17","18","19","20",
            "21","22","23","24","25","26","27","28","29","30",
            "31","32","33","34","35","36","37","38","39","40",
            "41","42","43","44","45","46","47","48","49","50",
            "51","52","53","54",
            "101","102","103","104","105","106","107","108","109","100");
            
$curr_pattern = 9;

$hours = array (1=>"00","01","02","03","04","05","06","07",
              "08","09","10","11","12","13","14","15",
              "16","17","18","19","20","21","22","23");
$curYear = date('Y');
$currYearKey=array_search($curYear, $years );
$curWeek = date('W');
$curWeekKey=array_search($curWeek, $weeks );
$curMonth = date('M');
$curMonthKey=array_search($curWeek, $weeks );



echo '<input type="submit" name="load" value="Load Project">';
echo  dyna_sel($projects, 'project_load', '',8)."  ";
echo  dyna_sel($years, 'year_load', '',$currYearKey);
echo  dyna_sel($weeks, 'pattern_load', '',$curWeekKey);
echo '<input type="submit" name="assign" value="Save As">';
echo  dyna_sel($projects, 'project_save', '',8)."  ";
echo  dyna_sel($years, 'year_save', '',$currYearKey);     
echo  dyna_sel($weeks, 'week_save', '',$curWeekKey+1) ;

  
echo "<br>";
 
        
if(isset($_POST['load'])) 
  {$wweek = $weeks[$_POST["pattern_load"]];
   $yyear = $years[$_POST["year_load"]];
   $pproject = $projects[$_POST["project_load"]];
        //$guy = $guys[$_POST["guy"]];
        //echo $guy;        //echo $wweek;        //echo $yyear;        //echo $pproject;
    
// show "MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"
        echo "<table border =\"1\" style='border-collapse: collapse'>";
        echo "<tr> \n";
        echo "<td height=30px width=30px bgcolor=#eee7e0>$pproject</td>";
        foreach ($days as $p)
		  {echo "<td height=30px width=64px bgcolor=#eee800>$p</td>\n";}
	  	echo "</tr>";
		echo "</table>";
        
    echo "<table border =\"1\" style='border-collapse: collapse'>";
    echo "<tr> \n";
    echo "<td height=30px width=30px bgcolor=#eee7e0>- -Wk/Yr- -M-D- Time:::</td>";
    foreach ($days as $dkey=>$dday)
       {//$dday="tuesday";
         //echo "$dkey";
         $t0="$yyear"."W"."$wweek"."$dkey";//$dday;
         //echo strtotime($t0);
        $p=date("W/y M-d", strtotime("0 day", strtotime($t0)))." ";
	    echo "<td height=30px width=64px bgcolor=#eee800>$p</td>\n";}
	echo "</tr>";
	echo "</table>";
          
   foreach ($hours as $hhour)            
     {echo str_repeat('&nbsp;', 3). $hhour."  ::: ";
           foreach ($days as $dday) 
              { $HourID=$yyear.$wweek.$dday.$hhour; //echo "$HourID";
                $sql = "SELECT employee_Code FROM shift 
                      WHERE HourID = '$HourID' and project='$pproject'"; 
                    //WHERE wday = '$dday' and worktime = $hhour and week= $wweek";
                    //$sql = "UPDATE shift SET lastname='Doe' WHERE id=2";
                    //$sql = "INSERT INTO shift (employee_Code,worktime,week,year,date,month,wday)
                    //VALUES ('$emid', '$workt', '$wweek', '$yyear', '$ddate', '$mmonth', '$dayvalue')";year=$yyear 
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) > 0) 
                   { //echo "yes";// output data of each row
                     $row = mysqli_fetch_assoc($result); //echo $row["employee_Code"];
                     $curr_guy = array_search($row["employee_Code"], $guys ); } //echo $curr_guy;
                else 
                   {$curr_guy=10;}
                $shift="shift" . $hhour .$dday;    
                //echo $curr_guy;                   
                echo dyna_sel_a($guys, $shift, '', $curr_guy);} //echo $q++ ;
            echo "<br>";}       
         echo "<br>";
        
        echo "<br>";}
       
if(isset($_POST['assign'])) 
    {$wweek = $weeks[$_POST["week_save"]];
     $yyear = $years[$_POST["year_save"]];
     $pproject = $projects[$_POST["project_save"]]; //$guy = $guys[$_POST["shift01TUE"]]; 
     //echo $pproject;
        //echo $_POST['shift05SAT'];    //echo $_POST['shift01TUE'];        //echo $guy;
        // show "MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"
     echo "<table border =\"1\" style='border-collapse: collapse'>";
     echo "<tr> \n";
     echo "<td height=30px width=30px bgcolor=#eee7e0>$pproject</td>";
     foreach ($days as $p)
		  {echo "<td height=30px width=64px bgcolor=#eee800>$p</td>\n";}
	 echo "</tr>";
	 echo "</table>";        
     echo "<table border =\"1\" style='border-collapse: collapse'>";
     echo "<tr> \n";
     echo "<td height=30px width=30px bgcolor=#eee7e0>/Date/ /Time/</td>";
     foreach ($days as $dkey=>$dday)
         {$t0="$yyear"."W"."$wweek"."$dkey";
          $p=date("W/y-M-d", strtotime($t0))." ";
	      echo "<td height=30px width=64px bgcolor=#eee800>$p</td>\n";}
	 echo "</tr>";
	 echo "</table>";      
        //echo $_POST["name"];
     foreach ($hours as $hhour)            
       {echo str_repeat('&nbsp;', 3). $hhour."  ::";
        foreach ($days as $dday) 
           {$shift="shift" . $hhour .$dday;
            //echo $shift;
            $HourID=$yyear.$wweek.$dday.$hhour;
            $emid = $guys[$_POST[$shift]];          //echo $emid;
            $t="$yyear"."W"."$wweek"."$dday";
            //echo date("Y-m-d", strtotime($t));
            $ddate = date("Y-m-d", strtotime($t));
            $mmonth = date("m",strtotime($ddate));
            $sql = "SELECT employee_Code FROM shift 
                      WHERE HourID = '$HourID' and project='$pproject'"; 
            $result = $conn->query($sql);
            if (mysqli_num_rows($result) > 0) 
               {//echo $emid;
                        $sql = "UPDATE shift SET employee_Code='$emid' 
                        WHERE HourID='$HourID'and project='$pproject'";
                        //echo $sql;
                       }
                       
                   else 
                                              
                      {$sql = "INSERT INTO shift 
                        (employee_Code,worktime,week,year,date,month,wday,HourID,project,company)
                      VALUES 
                       ('$emid', '$hhour', '$wweek', '$yyear', '$ddate', 
                  '$mmonth', '$dday','$HourID','$pproject','$corp')";}
                      
                   echo dyna_sel($guys, $shift, '', $emid);
                    
                    if ($conn->query($sql) === TRUE) 
                      {$last_id = $conn->insert_id;
                       //echo "New record created successfully, Last inserted ID is: " . $last_id;
                       } 
                    else 
                       {echo "Error: " . $sql . "<br>" . $conn->error;}}
      
                echo "<br>";}
      
        echo "<br>";       
       
        echo "<br>";}
       
          //$conn->close();        
       echo '</form>';  //this form is used to set a pattern 
    
     mysqli_close($conn);
    
  
?>

</div> <!-- end mainContainer -->
</div> <!-- end container -->
    </main>
    <?php include './includes/footer.php'; ?>
</div>
</body>
</html>