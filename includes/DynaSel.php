<?php
function dyna_sel_a($DynaArray, $NameOfElement, $label = '', $Default) 
   {  //echo $Default;
       $menu = '';
    if ($label != '') $menu .= '
        <label for="'.$NameOfElement.'">'.$label.'</label>';
    $menu .= '
    	<select name="'.$NameOfElement.'" id="'.$NameOfElement.'">';
  
    if (!isset($_REQUEST[$NameOfElement])) 
       {$CurrValue = $Default;}
       //echo "a".$CurrValue;
    else 
       {$CurrValue = $_REQUEST[$NameOfElement];
        $CurrValue = $Default;}
        //echo $NameOfElement;
        //echo "b". $CurrValue;
    
    foreach ($DynaArray as $key => $value) 
       {$menu .= '
			<option value="'.$key.'"';            
        if ($key == $CurrValue) $menu .= ' selected="selected"';
        $menu .= '>'.$value.'</option>';
        }
    $menu .= '
    	</select>';
    return $menu;}
    
function dyna_sel($DynaArray, $NameOfElement, $label = '', $Default) 
   {  //echo $Default;
       $menu = '';
    if ($label != '') $menu .= '
        <label for="'.$NameOfElement.'">'.$label.'</label>';
    $menu .= '
    	<select name="'.$NameOfElement.'" id="'.$NameOfElement.'">';
  
    if (!isset($_REQUEST[$NameOfElement])) 
       {$CurrValue = $Default;}
       //echo "a".$CurrValue;
    else 
       {$CurrValue = $_REQUEST[$NameOfElement];}
        //echo $NameOfElement;
        //echo "b". $CurrValue;
    
    foreach ($DynaArray as $key => $value) 
       {$menu .= '
			<option value="'.$key.'"';            
        if ($key == $CurrValue) $menu .= ' selected="selected"';
        $menu .= '>'.$value.'</option>';
        }
    $menu .= '
    	</select>';
    return $menu;}
?>