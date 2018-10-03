<?php
$json_file=file_get_contents('names.json');
$json_data=json_decode($json_file,true);
 if(!empty($json_data)){
         foreach($json_data as $data){
                 echo "<tr class='row-ctrl'><td class='names' name='names[]'>".$data."</td><td class='input-group control-group'><input type='text' class='form-control input' id='input-label-remove' name='empnames[]' autocomplete='off'></td></tr>";
         }
         
 }
     
?>