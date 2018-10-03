<?php
$name = $_POST['name'];
 if(file_exists('names.json')){
$json_file=file_get_contents('names.json');
$json_data=json_decode($json_file,true);
$json_data[]=$name;
$final_data=json_encode($json_data,true);
if(file_put_contents('names.json',$final_data)){ 
        echo 'success';
}
 }
?>