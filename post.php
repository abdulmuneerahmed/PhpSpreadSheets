<?php 
$names=$_POST['names'];
$amount =$_POST['values'];
$today_date = date('Y-m-d');
// $generate_arrays=array();
foreach (array_combine($names, $amount) as $name => $value) {
        $generate_arrays[$name] =array($today_date,$value);
}
if(file_exists('realexceldata.json')){
$json_file=file_get_contents('realexceldata.json');
$json_data=json_decode($json_file,true);
$json_data[]=$generate_arrays;
$final_data=json_encode($json_data,true);

file_put_contents('realexceldata.json',$final_data);
}
include 'test.php';
?>