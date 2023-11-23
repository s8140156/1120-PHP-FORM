<?php

include_once "../db.php";
$file=find('files',$_GET['id']);
// 在執行編輯前先拿到原先的資料
if(!empty($_FILES['img']['tmp_name'])){

	$tmp=explode(".",$_FILES['img']['name']);
	$subname=".".end($tmp);
	$file['name']=date("YmdHis").rand(10000,999999) .$subname;
	// 
	move_uploaded_file($_FILES['img']['tmp_name'],"../imgs/".$file['name']);

	switch($_FILES['img']['type']){
		case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
			$type="msword";
		break;
		case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
			$type="msexcel";
		break;
		case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
			$type="msppt";
		break;
		case "application/pdf":
			$type="pdf";
		break;
		case "image/webp":
		case "image/jpeg":
		case "image/png":
		case "image/gif":
		case "image/bmp":
			$type=$_FILES['img']['type'];
		break;
		default:
			$type="other";

	}

	$file['type']=$type;
	$file['size']


	$file=['name'=>$filename,
		   'type'=>$type,
		   'size'=>$_FILES['img']['size'],
			'desc'=>$_POST['desc']];



	update('files',$file);

	header("location:../manage.php");

	header("location:../edit_file.php?err=上傳失敗");





?>