<?php include './includes/title.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Q Shift Scheduler<?= $title ?></title>
    <link href="styles/journey.css" rel="stylesheet" type="text/css">
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

//set defaults of pattern 
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
$monthss =array(0=>"   ",
                   "Jan","Feb","Mar","Apr",
                   "May","Jun","Jul","Aug",
                   "Sep","Oct","Nov","Dec");

$mmonth = 1;

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
            

$hours = array (1=>"00","01","02","03","04","05","06","07",
              "08","09","10","11","12","13","14","15",
              "16","17","18","19","20","21","22","23");
$curYear = date('Y');
$curYearKey=array_search($curYear, $years );
$curWeek = date('W');
$curWeekKey=array_search($curWeek, $weeks );
$curMonth = date('M');
$curMonthKey=array_search($curWeek, $weeks );

echo '<input type="submit" name="load" value="Create Report">';
echo  dynamic_select($projects, 'project_load', '',8)."  ";
//echo  dynamic_select($monthss, 'monthly_load', '',0)."  ";
echo  dynamic_select($years, 'year_start', '',$curYearKey);
echo  dynamic_select($weeks, 'week_start', '',$curWeekKey)."-";
echo  dynamic_select($years, 'year_stop', '',$curYearKey);     
echo  dynamic_select($weeks, 'week_stop', '',$curWeekKey+2) ;
//echo  dynamic_select($guys, 'guy_load', '',10)."  ";


  
echo "<br>";
 
        
if(isset($_POST['load'])) 
  {//$monthly=$monthss[$_POST["monthly_load"]];
   $stWeek = $weeks[$_POST["week_start"]];
   $stYear = $years[$_POST["year_start"]];
   $spWeek = $weeks[$_POST["week_stop"]];
   $spYear = $years[$_POST["year_stop"]];
   $pproject = $projects[$_POST["project_load"]];
   $wweek=$stWeek;
   $yyear=$stYear;
   $selW=array();
   
   //echo "$selW";
   
   if ($_POST["year_start"]>=$_POST["year_stop"])
     { for ($w=$_POST["week_start"];$w<=$_POST["week_stop"];$w++)
         {   $T="$stYear"."W". "$weeks[$w]";
             
             $T1="$stYear". "$weeks[$w]";
             $selW[]=array($T,$T1);
             
             }
     }
   else 
     { $y=$_POST["year_start"];
       for ($w=$_POST["week_start"];$w<=53;$w++)
           { //echo '/'. $w;
             //echo '/'. $y;
             $T="$years[$y]"."W". "$weeks[$w]";
             $selW[]=$T;
             $T1="$years[$y]". "$weeks[$w]";
             $selW[]=array($T,$T1);
             //echo $T;
              
             
            }    
        //print_r($selW);
        $y++;
        while ($y<$_POST["year_stop"])
          { //echo"here";
            for ($w=1;$w<=53;$w++)
              {$T="$years[$y]"."W". "$weeks[$w]";
               $T1="$years[$y]". "$weeks[$w]";
               $selW[]=array($T,$T1);           
              }         
               $y++;
               //print_r($selW); 
           }
                   
        for ($w=1;$w<=$_POST["week_stop"];$w++)
               { $T="$years[$y]"."W". "$weeks[$w]";
                 $T1="$years[$y]"."$weeks[$w]";
                 $selW[]=array($T,$T1); 
                
                } 
          //print_r($selW); 
      }
    
foreach ($selW as $r)
 {   //print_r($selW); 
    // echo $r[1];
     // show "MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN" first row
     echo "<table border =\"1\" style='border-collapse: collapse'>";
     echo "<tr> \n";
     echo "<td height=30px width=30px bgcolor=#eee7e0>$pproject</td>";
     foreach ($days as $p)
	   {echo "<td height=30px width=64px bgcolor=#eee800>$p</td>\n";}
	  	echo "</tr>";
		echo "</table>";    
     // show second row     
     echo "<table border =\"1\" style='border-collapse: collapse'>";
     echo "<tr> \n";
     echo "<td height=30px width=30px bgcolor=#eee7e0>/Date/ /Time/</td>";
      
    foreach ($days as $dkey=>$dday)
       { //print_r($days);
         $t0="$r[0]"."$dkey";//$dday;
         //echo strtotime($t0);
        $p=date("W/y M-d", strtotime("0 day", strtotime($t0)))." ";
	    echo "<td height=30px width=64px bgcolor=#0fe600>$p</td>\n";}
	echo "</tr>";
	echo "</table>";
          
   foreach ($hours as $hhour)            
     { $h=str_repeat('&nbsp;', 5). $hhour."::";  
      //echo str_repeat('&nbsp;', 3). $hhour."::";           
      echo "<table border =\"1\" style='border-collapse: collapse'>";
      echo "<tr>";
      echo "<td height=30px width=30px bgcolor=#1ee7e0>$h</td>";              
           foreach ($days as $dday) 
              { $HourID=$r[1].$dday.$hhour; //echo "$HourID";
                $sql = "SELECT employee_Code FROM shift 
                      WHERE HourID = '$HourID' and project='$pproject'"; 
                   
                $result = $conn->query($sql);
                if (mysqli_num_rows($result) > 0) 
                   {$row = mysqli_fetch_assoc($result); //echo $row["employee_Code"];
                    $p=$row["employee_Code"];}
                else 
                   {$p='----';}
                
	         if ($hhour%2==1)
                   {echo "<td height=30px width=64px bgcolor=#63eccc>$p</td>";}
              else
                   {echo "<td height=30px width=64px bgcolor=#8eec7c>$p</td>";}
             }
                
	  echo "</tr>";
 echo "</table>";}}
}

echo '</form>';  //this form is used to set a pattern 
    
mysqli_close($conn);
    
   
function dynamic_select($the_array, $element_name, $label = '', $init_value) 
   {  //echo $init_value;
       $menu = '';
    if ($label != '') $menu .= '
        <label for="'.$element_name.'">'.$label.'</label>';
    $menu .= '
    	<select name="'.$element_name.'" id="'.$element_name.'">';
  
    if (!isset($_REQUEST[$element_name])) 
       {$curr_val = $init_value;}
       //echo "a".$curr_val;
    else 
       {$curr_val = $_REQUEST[$element_name];}
        //echo $element_name;
        //echo "b". $curr_val;
    
    foreach ($the_array as $key => $value) 
       {$menu .= '
			<option value="'.$key.'"';            
        if ($key == $curr_val) $menu .= ' selected="selected"';
        $menu .= '>'.$value.'</option>';
        }
    $menu .= '
    	</select>';
    return $menu;}
    

?>

</div> <!-- end mainContainer -->
</div> <!-- end container -->
    </main>
    <?php include './includes/footer.php'; ?>
</div>
</body>
</html>