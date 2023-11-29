<?php
/**
 * 1.建立資料庫及資料表來儲存檔案資訊
 * 2.建立上傳表單頁面
 * 3.取得檔案資訊並寫入資料表
 * 4.製作檔案管理功能頁面
 */

include_once "./db.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案管理功能</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">檔案管理練習</h1>
<!----建立上傳檔案表單及相關的檔案資訊存入資料表機制----->

<h3><a href="upload.php">上傳檔案</a></h3>



<!----透過資料表來顯示檔案的資訊，並可對檔案執行更新或刪除的工作----->
<?php

$files=all('files');
// dd($files);
?>

<table>
    <tr>
        <td>id</td>
        <td>檔名</td>
        <td>類型</td>
        <td>大小</td>
        <td>描述</td>
        <td>上傳時間</td>
        <td>操作</td>
    </tr>
<?php
foreach($files as $file){
    // 注意php包的範圍 用foreach取出陣列放在表格內
    // 使用$files 指定資料???
    switch($file['type']){
        case "image/webp":
        case "image/jpeg":
        case "image/png":
        case "image/gif":
        case "image/bmp":
            $imgname="./imgs/".$file['name'];
        break;
        case "msword":
            $imgname="./icon/msword.png";
        break;
        case "msexcel":
            $imgname="./icon/msexcel.png";
        break;
        case "msppt":
            $imgname="./icon/msppt.png";
        break;
        case "pdf":
            $imgname="./icon/pdf.png";
        break;
        default:
            $imgname="./icon/other.png";

    }

    ?>

<tr>
    <td><?=$file['id']?></td>
    <td><?=$file['name']?><img class='thumbs' src="<?=$imgname?>" alt=""></td>
    <td><?=$file['type']?></td>
    <td><?=$file['size'] ." bytes"?></td>
    <td><?=$file['desc']?></td>
    <td><?=$file['create_at']?></td>
    <td>
        <button class="btn btn-danger" onclick="location.href='./edit_file.php?id=<?=$file['id'];?>'">編輯</button>    
        <!-- <button class="btn btn-info">編輯</button> -->
        <!-- <button class="btn btn-danger"><a href='./api/del_file.php?id=<?=$file['id'];?>'>刪除</a></button> -->
        <!-- 使用a tag做button動作 -->
        <button class="btn btn-danger" onclick="location.href='./api/del_file.php?id=<?=$file['id'];?>'">刪除</button>
    </td>
</tr>
<?php
}
?>

</table>


</body>
</html>