<?php include './includes/title.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Q Shift Scheduler<?= $title ?></title>
    <link href="styles/sft.css" rel="stylesheet" type="text/css">
</head>
<body>
<header>
    <h1> Q Shift Scheduler</h1>
</header>
<div id="wrapper">
   <?php require './includes/menu.php'; ?>
    <main>
        <h2>Q Scheduler</h2>
        <div id="mainContainer">
<div id="content">

<form action="" method="post">

<?php
//connect DB
$servername = "localhost";
$username = "root";
$password = "qing";
$dbname0 = "myDB";
$dbname = "sft";
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
   {die("Connection failed: " . $conn->connect_error);} 
   //echo "Connected successfully";

if (!$conn) 
   {die("Connection failed: " . mysqli_connect_error());}

//set defaults of pattern 
$emid = "Qing";
$workt = 0;
$wweek = 1;
$years =array("2018","2019","2020");
$ddate = "20190101";
$iid = 2;
$mmonth = 1;
$wday0 = "TUE";
$curr_guy = "None";
$guys = array (1=>"Adam", "Bent", "Chin", "Dick", "Emma", "Fion", "Geog", "None");
$days = array(1=>"MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"); 
//$patterns = array(1=>"P1","P2","P3","P4","P5",
//                 "P6","P7","P8","P9","P0");
$weeks = array(1=>"00",
            "01","02","03","04","05","06","07","08","09","10",
            "11","12","13","14","15","16","17","18","19","20",
            "21","22","23","24","25","26","27","28","29","30",
            "31","32","33","34","35","36","37","38","39","40",
            "41","42","43","44","45","46","47","48","49","50",
            "51","52","53","54",
            "101","102","103","104","105","106","107","108","109","100");
            
//$curr_pattern = 2;

$hours = array (1=>"00","01","02","03","04","05","06","07",
              "08","09","10","11","12","13","14","15",
              "16","17","18","19","20","21","22","23");
 
echo '<form method="post" action="">';

echo dynamic_select($weeks, 'pattern_number', 'Select a pattern or week to edit:',56);
echo dynamic_select($years, 'year_number', 'of the year',3) ;
echo "  ";
echo '<input type="submit" name="load" value="Load">';
echo "<br>";


    if(isset($_POST['load'])) 
       {$wweek = $weeks[$_POST["pattern_number"]];
        $yyear = $years[$_POST["year_number"]];
        //$guy = $guys[$_POST["guy"]];
        //echo $guy;
        echo $wweek;
        echo $yyear;
        echo "<br>";
        //echo "Step 2: Edit the pattern for a weekly shift schedule";
        //echo $_POST["name"];
        echo "<br>";

        
        // show "MON", "TUE", "WED", "THU", "FRI", "SAT", "SUN"
        echo "<table border =\"1\" style='border-collapse: collapse'>";
        echo "<tr> \n";
        echo "<td height=30px width=9px bgcolor=#eef800>H</td>";
        foreach ($days as $p)
		  {echo "<td height=30px width=64px bgcolor=#ffff00>$p</td>\n";}
	  	echo "</tr>";
		echo "</table>";


        
        echo "<br>";        
            foreach ($hours as $hhour)            
               { echo $hhour ;
                foreach ($days as $dday) 
                 { $HourID=$yyear.$wweek.$dday.$hhour;
                   //echo "$HourID";
                   $sql = "SELECT employee_Code FROM shift 
                      WHERE HourID = '$HourID' "; 
                       //WHERE wday = '$dday' and worktime = $hhour and week= $wweek";
                     
                      
                        //$sql = "UPDATE shift SET lastname='Doe' WHERE id=2";
                        //$sql = "INSERT INTO shift (employee_Code,worktime,week,year,date,month,wday)
                        //VALUES ('$emid', '$workt', '$wweek', '$yyear', '$ddate', '$mmonth', '$dayvalue')";year=$yyear //and
                   $result = $conn->query($sql);
                   if (mysqli_num_rows($result) > 0) 
                      { echo "yes";
                        // output data of each row
                        $row = mysqli_fetch_assoc($result);
                         //echo $row["employee_Code"];
                         $curr_guy = array_search($row["employee_Code"], $guys ); 
                       
                        //echo $curr_guy;
                       }
                       
                   else 
                       {$curr_guy=2;}
                      
                        
                $shift="shift" . $hhour .$dday;    
                echo $curr_guy;                   
                echo dynamic_select($guys, $shift, '', $curr_guy);
                //echo $q++ ;
                }
                   
        
                 echo "<br>";
               }
           
        
        echo "<br>";
        echo "------------------------------------------";
        echo "<br>";
        echo "Step 3: Assign the pattern to a week";
        echo "<br>";
        echo dynamic_select($weeks, 'week_number', 'Select a week :',$curr_pattern) ;
        echo '<input type="submit" name="assign" value="Assign">';
        echo "<br>";}
       
        if(isset($_POST['assign'])) 
        {
        //echo $_POST["week_number"];
        $wweek = $weeks[$_POST["week_number"]];
        $yyear = $years[$_POST["year_number"]];
        //echo "I am Here";
        $guy = $guys[$_POST["shift01TUE"]];
        //echo $_POST['shift05SAT'];
        //echo $_POST['shift01TUE'];
        //echo $guy;
        echo "<br>";
        
        //echo $_POST["name"];
        echo "<br>";
        // Enter the code you want to execute after the form has been submitted
        // Display Success or Failure message (if any) 
        
        echo " Time --    Mon     Tue      Wed       Thu       Fri        Sat        Sun   .<br>"; 
        echo "<br>";        
            foreach ($hours as $hhour)            
               {echo $hhour;
                foreach ($days as $dday) 
                   {$shift="shift" . $hhour .$dday;
                     //echo $shift;
                    $HourID=$yyear.$wweek.$dday.$hhour;
                    $emid = $guys[$_POST[$shift]];
                    $t="$yyear"."W"."$wweek"."$dday";
                    //echo date("Y-m-d", strtotime($t));
                    
                    $ddate = date("Y-m-d", strtotime($t));
                   
                    $mmonth = date("m",strtotime($ddate));      
                     $sql = "SELECT employee_Code FROM shift 
                      WHERE HourID = '$HourID' "; 
                       
                   $result = $conn->query($sql);
                   if (mysqli_num_rows($result) > 0) 
                      { echo "ywwwwes";
                        //echo $emid;
                        $sql = "UPDATE shift SET employee_Code='$emid' WHERE HourID='$HourID'";
                        echo $sql;
                       }
                       
                   else 
                                              
                      {$sql = "INSERT INTO shift (employee_Code,worktime,week,year,date,month,wday,HourID)
                      VALUES ('$emid', '$hhour', '$wweek', '$yyear', '$ddate', '$mmonth', '$dday','$HourID')";}
                      
                   echo dynamic_select($guys, $shift, '', $emid);
                    
                    if ($conn->query($sql) === TRUE) 
                      {$last_id = $conn->insert_id;
                       //echo "New record created successfully, Last inserted ID is: " . $last_id;
                       } 
                    else 
                       {echo "Error: " . $sql . "<br>" . $conn->error;}}
        
                                            
                
                echo "<br>";}
        echo "------------------------------------------";
        echo "<br>";       
       
        echo "<br>";
        echo "Step 3: Assign the pattern to a week";
        echo "<br>";
        echo dynamic_select($weeks, 'week_number', 'Select a week :',$curr_pattern) ;
        echo '<input type="submit" name="assign" value="Assign">';
        echo "<br>";}
          
          //$conn->close();        
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

//echo dynamic_select($wk, 'week', 'Step2: assign the pattern to week :') ."<br>";
?>

</div> <!-- end mainContainer -->
</div> <!-- end container -->
    </main>
    <?php include './includes/footer.php'; ?>
</div>
</body>
</html>