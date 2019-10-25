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
<?php require './includes/ReadProjects.php'; ?>
<?php array_push($Projects,"NewProject");?>  
 
<p> <?php echo $CorpID ?></p>

<main>
 
<?php
//print_r($Projects);   
echo '<form method="post" action="">';
echo '<p>';
      echo '<label for="name">Select a Project:</label>' . dyna_sel($Projects, 'Project_Selected', '',1)."  ";
      echo '<input type="submit" name="Edit" value="Edit Project">';
echo '</p>';    

$ProjectCode=$Projects[0];
$ProjectName="The Projet: Name";
$ProjectDescription="Project Description:";

if(isset($_POST['Edit'])) 
    { $ProjectCode=$Projects[$_POST["Project_Selected"]];
      //echo $ProjectCode;
      if ($ProjectCode<>"NewProject")
         {$sql = "SELECT * FROM project WHERE ProjectCode = '$ProjectCode' and corpID='$CorpID'"; 
           if ($result = $conn->query($sql)) 
              {while ($row = mysqli_fetch_assoc($result))
                  {$ProjectCode=$row["ProjectCode"];
                   //echo $ProjectCode;
                   $ProjectName=$row['ProjectName'];
                   $ProjectDescription=$row["ProjectDescription"];}
            mysqli_free_result($result); 
        } }
                     
     else 
        { $ProjectCode="GiveNewProjectCode(within 6 letters)";
          $ProjectName="The Projet: Name";
          $ProjectDescription=$ProjectName."Project Description:"; }}
    
?>

<?php  
if(isset($_POST['Save'])) 
    {   $ProjectCode=$_POST["Pcode"];
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
          
          
 
    $result = $conn->query($sql);  }   
         
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
  <?php include './includes/footer.php'; 
   mysqli_close($conn);?>
</div>
</body>
</html>
