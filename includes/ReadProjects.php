<?php
    $Projects=array();
    $CorpID="Qing AB";
    $sql = "SELECT ProjectCode FROM project WHERE corpID = '$CorpID'" ; 
    $result = $conn->query($sql);
    if (mysqli_num_rows($result) > 0) 
        { //echo "yes";// output data of each row
        $row = mysqli_fetch_assoc($result); //echo $row["ProjectCode"];
        array_push($Projects,$row["ProjectCode"]);}    
?>  