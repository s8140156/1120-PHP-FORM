<?php

include_once "../db.php";

$id=$_GET['id'];
// 從GET先取得id
$file=find('files',$id)['name'];
// 再去資料庫找該id對應的檔案名

del('files',$id);
// 這是刪除資料庫檔案名

unlink('../imgs/'.$file);
// 這是刪除硬碟的文件實物

header("location:../manage.php");
// 然後再轉址回manage.php