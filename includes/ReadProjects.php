<?php
    $Projects=array();
    //$Projects[]="NewProject";
    $CorpID="Qing AB";
    $sql = "SELECT ProjectCode FROM project WHERE corpID = '$CorpID'" ; 
    $result = $conn->query($sql);
    
    while ($row = mysqli_fetch_assoc($result))
    {$Projects[]=$row['ProjectCode'];}
        
?>  