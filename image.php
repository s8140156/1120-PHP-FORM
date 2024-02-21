<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳圖案機制
 * 3.取得圖檔資源
 * 4.進行圖形處理
 *   ->圖形縮放
 *   ->圖形加邊框
 *   ->圖形驗證碼
 * 5.輸出檔案
 */

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],'./imgs/'.$_FILES['img']['name']);
    $source_path='./imgs/'.$_FILES['img']['name'];
    $type=$_FILES['img']['type'];
    switch($type){
        case 'image/jpeg':
            $source=imagecreatefromjpeg($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
        case 'image/png':
            $source=imagecreatefrompng($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
        case 'image/gif':
            $source=imagecreatefromgif($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
        case 'image/bmp':
            $source=imagecreatefrombmp($source_path);
            list($width,$height)=getimagesize($source_path);
        break;
    }
    $dst_path='./imgs/small_'.$_FILES['img']['name'];
    $dst_width=150;
    $dst_height=200;
    $dst_source=imagecreatetruecolor($dst_width,$dst_height);
    imagecopyresampled($dst_source,$source,0,0,0,0,$dst_width,$dst_height,$width,$height);
    switch($type){
        case 'image/jpeg':
            imagejpeg($dst_source,$dst_path);
        break;
        case 'image/png':
            imagepng($dst_source,$dst_path);
        break;
        case 'image/gif':
            imagegif($dst_source,$dst_path);
        break;
        case 'image/bmp':
            imagebmp($dst_source,$dst_path);
        break;
    }

    imagedestroy($source);
    imagedestroy($dst_source);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>圖形檔案處理</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<h1 class="header">圖形處理練習</h1>
<!---建立檔案上傳機制--->
<form action="?" method="post" enctype="multipart/form-data">

<div class="col-3 mb-3">
  <!-- <label for="formFile" class="form-label">Default file input example</label> -->
  <input class="form-control" type="file" name="img" id="formFile">
  <input class="btn btn-warning mt-3" type="submit" value="上傳">
</div>
    <!-- <label for="">選擇檔案:</label>
    <input type="file" name="img" id=""> -->
</form>



<!----縮放圖形----->

<img src="<?=$dst_path;?>" alt="">


<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>