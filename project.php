<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Qing's Machine</title>
    <link href="styles/sft.css" rel="stylesheet" type="text/css">
</head>

<body>
<header>
    <h1>Project </h1>
</header>
<div id="wrapper">

<?php require './includes/menu.php'; ?>
<?php require './includes/connDB.php'; ?>
<?php require './includes/DynaSel.php'; ?>
<?php
    $Projects=array();
    $Projects[]="NewProject";
    $CorpID="Qing AB";
    $sql = "SELECT ProjectCode FROM project WHERE corpID = '$CorpID'" ; 
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) 
        { //echo "yes";// output data of each row
        $row = mysqli_fetch_assoc($result); //echo $row["ProjectCode"];
        array_push($Projects,$row["ProjectCode"]);}
        
?>  
 
 <p> <?php echo $CorpID ?></p>

<main>
 
<?php
//print_r($Projects);

   
echo '<form method="post" action="">';
echo '<p>';
      echo '<label for="name">Select a Project:</label>' . dyna_sel($Projects, 'Project_Selected', '',0)."  ";
      echo '<input type="submit" name="Edit" value="Edit Project">';
echo '</p>';    

$ProjectCode=$Projects[0];
$ProjectName="New Projet Name";
$ProjectDescription="New Project Description:";

if(isset($_POST['Edit'])) 
    { 

     $ProjectCode=$Projects[$_POST["Project_Selected"]];
     //echo $pproject;
     
     
     if ($ProjectCode<>"NewProject")
        { $sql = "SELECT * FROM project WHERE ProjectCode = $ProjectCode"; 
          $result = $conn->query($sql);
            if ($conn->query($sql) === TRUE) 
               { $row = mysqli_fetch_assoc($result); 
                 $ProjectCode=$row["ProjectCode"];
                 $ProjectName=$row["ProjectNme"];
                 $ProjectDescription=$row["ProjectDescription"];}}         
                       
     else 
        { $ProjectCode="GiveNewProjectCode(within 6 letters)";
          $ProjectName="New Projet Name";
          $ProjectDescription="New Project Description:"; }}
    
    
?>

<?php  

if(isset($_POST['Save'])) 
    {
        
 
        $ProjectCode=$_POST["Pcode"];
        $ProjectName=$_POST["Pname"];
        $ProjectDescription=$_POST["Pdesc"]; 
        //print_r($Projects);
    if (!in_array($ProjectCode,$Projects) and strlen($ProjectCode)==6 )
        {//generate new record
              $sql = "INSERT INTO project 
                    (corpID,ProjectCode,ProjectName,ProjectDescription)
        VALUES ('$CorpID','$ProjectCode','$ProjectCode','$ProjectDescription')";}
              
              //echo "here";}
              
    if (in_array($ProjectCode,$Projects) and strlen($ProjectCode)==6 )
         {$sql = "UPDATE project SET 
          corpID='$CorpID', ProjectName='$ProjectName', ProjectDescription='$ProjectDescription' 
          WHERE ProjectCode='$ProjectCode'";}
            
           
    else 
         {echo 'Try another ProjectCode ';}        
 
    $result = $conn->query($sql);
   if ($conn->query($sql) === TRUE) 
               {$last_id = $conn->insert_id;
                  //echo "New record created successfully, Last inserted ID is: " . $last_id;
                       } 
                    else 
                       {//echo "Error: " . $sql . "<br>" . $conn->error;
                       }
      
        

      //echo $ProjectCode;
        //print_r($Projects);
        //echo $ProjectName;
        //echo $ProjectDecription; 
 
    }   
         
?>
        
      <p>
      <label for="Pname">Project Name:</label>
      <input name="Pname" id="Project_Name" type="text" value="<?php echo $ProjectName; ?>" >
       </p>

         
      <p>
     <label for="Pcode">Project Code</label>
     <input name="Pcode" id="Project_Code" type="text" value="<?php echo $ProjectCode; ?>">
      </p>
       

     <p>
      <label for="Pdesc">Project Description</label>
      <textarea name="Pdesc" id="Project_Descripion" type="text" value=""><?php echo $ProjectDescription; ?></textarea>
     </p>
            
     <p>
     <input name="Save" type="submit" value="Save Project">
     </p>  
   
 </form>
 

 </main>
  <?php include './includes/footer.php'; ?>
   mysqli_close($conn);
</div>
</body>
</html>
