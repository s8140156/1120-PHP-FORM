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

//圖形處理需要使用PHP GD(graphics drawing)庫
//記得要"啟用"GD函式庫(在php.ini底下 找extension=gd 拿掉;打開) 記得要重新開啟apache

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],'./imgs/'.$_FILES['img']['name']);
    //創造縮略圖 source_path(來源), destination_path(目標)
    $source_path='./imgs/'.$_FILES['img']['name']; //來源路徑
    $type=$_FILES['img']['type']; //取得圖片類型(副檔名)(先使用$_FILES['type'])
    switch($type){ //然後用switch case對應各種型態(副檔名)
        case 'image/jpeg': //MIME type(可以google找檔案類型的寫法)
            $source=imagecreatefromjpeg($source_path); //建立原始(來源)圖的資源(source)
            list($width,$height)=getimagesize($source_path); //getimagesixe()取得原始(來源)圖片的寬高(取得的資料是陣列)
            // list()解構賦值語法(解構陣列)
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
    $dst_path='./imgs/small_'.$_FILES['img']['name']; //目標路徑
    $dst_width=150; //目標寬高
    $dst_height=200;
    $dst_source=imagecreatetruecolor($dst_width,$dst_height); //建立目標圖的資源(source)(全彩圖片)
    imagecopyresampled($dst_source,$source,0,0,0,0,$dst_width,$dst_height,$width,$height);
    //將來源圖片複製並重新取樣到目的圖片
    switch($type){
        case 'image/jpeg':
            imagejpeg($dst_source,$dst_path); //保存縮略圖(目標檔案的圖形資源,目標檔案的路徑) 資料從存在電腦伺服器的記憶體裡類似印出來
        break;
        case 'image/png':
            imagepng($dst_source,$dst_path);
        break;
        case 'image/gif':
            imagegif($dst_source,$dst_path); //gif動畫 這邊的保存只會有第一格
        break;
        case 'image/bmp':
            imagebmp($dst_source,$dst_path);
        break;
    }

    imagedestroy($source); //釋放資源(將在記憶體裡面的檔案資源取消(釋放destroy)掉)
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

<img src="<?=$dst_path;?>" style="margin-left:10px">


<!----圖形加邊框----->


<!----產生圖形驗證碼----->



</body>
</html>