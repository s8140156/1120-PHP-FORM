<?php

include_once "db.php";

if(isset($_GET['id'])){

    $file=find('files',$_GET['id']);
}else{
    exit();
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編輯檔案</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
 <h1 class="header">編輯檔案</h1>
 <!----建立你的表單及設定編碼----->

 <?php

if(isset($_GET['err'])){
    echo $_GET['err'];
}
?>

 <form action="./api/edit_file.php" method="post" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td>媒體</td>
            <td><input type="file" name="img" id="" value=""></td>
        </tr>
        <tr>
            <td>檔名</td>
            <td><input type="text" name="name" id="" value=""></td>
        </tr>
        <tr>
            <td>說明</td>
            <td><textarea name="" style="width:"id="" cols="30" rows="10"></textarea></td>
        </tr>
    </table>
    <input type="file" name="img" id="">
    <input type="text" name="name" id="">
    <input type="text" name="desc" value="描述" placeholder="請輸入檔案描述">
    <input type="submit" value="更新">
 </form>





<!----建立一個連結來查看上傳後的圖檔---->  
<?php

if(isset($_GET['img'])){
    echo "<img src='./imgs/{$_GET['img']}'>";
}
?>


</body>
</html>