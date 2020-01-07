<?php
require_once './zip.php';
header("Content-type:text/html;charset=utf-8");
//$periodsDate=$_POST['periodsDate'];
 $periodsDate='b';
 $dir=getcwd();
 $path=$dir.'/ups/'.$periodsDate.'/';
  if (!file_exists($path)){
            mkdir ($path,0777,true);
   }
 $tmpname=$_FILES['file']['tmp_name'];
 $filename=$_FILES['file']['name'];
 //获取当前目录的绝对路径
 $filepath=$path.'/'.$filename; 
 
 if(move_uploaded_file($tmpname,$filepath)){
    $z = new Unzip();
    $z->unzip($filepath,$path, true, false);
     @unlink($filepath);
     $result['status'] = 1;
     $result['message'] = "文件上传成功";
 }else{
      $result['status'] = 0;
      $result['message'] = "文件上传失败";
 }
 
 echo json_encode($result);
