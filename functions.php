<?php

function createPsw($charsnum, $huge_array){
  $repetition=$_GET['repetition'];
  if($repetition=='false'){
    $my_temp_array=[];
    while(count($my_temp_array) <= $charsnum){
      $my_rdm_var=array_rand(array_flip($huge_array),1);
      if(!in_array($my_rdm_var,$my_temp_array)){
        $my_temp_array[] =$my_rdm_var;
     }
  }$password=implode($my_temp_array);
  }else{
    $password=(str_shuffle(implode(array_rand(array_flip($huge_array),$charsnum))));
  }
  return $password;  
}


?>