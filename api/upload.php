<?php

echo $_POST['name'];

if(!empty($_FILES['img']['tmp_name'])){
// 從xampp tmp資料夾確認檔案是否有存在(存在就是上傳成功)
	echo $_FILES['img']['tmp_name'];
	echo "<br>";
	echo $_FILES['img']['name'];
	move_uploaded_file($_FILES['img']['tmp_name'],"../imgs/".$_FILES['img']['name']);

}



?>