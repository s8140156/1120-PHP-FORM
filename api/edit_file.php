<?php

include_once "../db.php";

// echo $_POST['name'];
// echo "<br>";
if(!empty($_FILES['img']['tmp_name'])){
// 從xampp tmp資料夾確認檔案是否有存在(存在就是上傳成功)
// 有些檔案上傳判別是用tmp_name, 有些則是用error code去判別
	// echo $_FILES['img']['tmp_name'];
	// echo "<br>";
	// echo $_FILES['img']['name'];
	// echo "<br>";
	// echo $_FILES['img']['type'];
	// echo "<br>";
	// echo $_FILES['img']['size']." bytes";
	$tmp=explode(".",$_FILES['img']['name']);
	$subname=".".end($tmp);
	// $subname=explode(".",$_FILES['img']['name'])[end(explode(".",$_FILES['img']['name']))];
	// 取副檔名, 用explode分割字串 並用end函數取陣列最後一個元素
	// 記得副檔名前要加. ex .jpg
	$filename=date("YmdHis").rand(10000,999999) .$subname;
	// 上傳進來的檔案還是要改名, 這邊使用日期年月日時分秒+亂數(從10000~999999間)(命名長度一致)+副檔名 以免檔案名重複
	move_uploaded_file($_FILES['img']['tmp_name'],"../imgs/".$filename);
	// 如果確認暫存檔裡有資料就表示上傳成成功, 就把檔案從暫存檔移至imgs夾下 以字串形式寫入; 因為有改過檔名記得要改成新的變數$filename

	// 檔案類型
	    /**
     * application/vnd.openxmlformats-officedocument.wordprocessingml.document - word
     * application/vnd.openxmlformats-officedocument.spreadsheetml.sheet-excel
     * application/vnd.openxmlformats-officedocument.presentationml.presentation-ppt
     * application/pdf - pdf
     */

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


	$file=['name'=>$filename,
		   'type'=>$type,
		   'size'=>$_FILES['img']['size'],
			'desc'=>$_POST['desc']];

	insert('files',$file);


	header("location:../manage.php");
	// 使用傳值方式將圖片及檔名轉到外層的upload.php
	// 目前會使用get, cookie, session也可以 但這種一次性傳值session做完還需要unset; post在這邊不適用

}else{
	header("location:../edit_file.php?err=上傳失敗");
	// 若上傳失敗就顯示err訊息

}
// 不能將上傳失敗header寫在這個外圈外, 因為上面程式執行後又遇到這個指令 會以這個指令為主 所以要寫else條件


?>