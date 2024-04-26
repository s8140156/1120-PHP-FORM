<style>
    table{
        border-collapse: collapse;
        margin-left: 10px;

    }
    td{
        border:1px solid #666;
        padding:5px 12px; /*視覺上padding比例 長寬:1:2*/
    }
    th{
        border:1px solid #666;
        padding:5px 12px;
        background-color: black;
        color:white;
    }
    .outside{
        margin-left: 10px;
    }
</style>
<?php
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳檔案機制
 * 3.取得檔案資源
 * 4.取得檔案內容
 * 5.建立SQL語法
 * 6.寫入資料庫
 * 7.結束檔案
 */
// echo 1234;
 if(!empty($_FILES['text']['tmp_name'])){
    $filename=$_FILES['text']['name'];
    $filesize=$_FILES['text']['size'];
    echo "檔案上傳成功!檔名為:".$filename;
    echo "<br>檔案大小:".$filesize ." byte";
    echo "<br>";
    $file=fopen($_FILES['text']['tmp_name'],'r'); //fopen()打開檔案 用唯讀(r)的方式
    $line=fgets($file); //這是第一列!! fgets()讀取檔案 如下echo 會讀出第一列而已喔(檔案第一列是欄位名)!!
    // echo $line; // 出現的格式會是csv裡面所有格式 包含,
    // echo "<br>";
    // $line=fgets($file);
    // echo $line; //可以用這樣方式一行一行讀出來
    // 如遇到亂碼csv可以在取得第一列時 先做php檢查及轉換字串編碼 ex. mb_detect_encoding($line), iconv('BIGS','UTF-8','BIG5 文字')(從big5轉成utf8)

    $cols=explode(",",$line); // explode()先炸開by"," 然後分拆每個字
    echo "<table>";
    echo "<tr>";
    foreach($cols as $col){ //先做"第一列"格式 取出第一列每個欄位的字 單獨做第一列(因為要設定格式) 而不一起while取出
        echo "<th>";
        echo $col;
        echo "</th>";
    }
    echo "</tr>";
    while(!feof($file)){ //如果不是最後一行, 因為不知道最後一行所以使用while + feof()(end of file)
        $line=fgets($file); //這是"第二列"!!開始
        $cols=explode(",",$line);
        echo "<tr>";
        foreach($cols as $col){
            echo "<td>";
            echo $col;
            echo "</td>";
        }
        echo "</tr>";
    }
    // echo "</table>";
 }

 // feof() EOF(end of life) 檔案(媒體)其實是儲存在硬碟的 但執行處理檔案是在記憶體處理 所以要有開頭(開始沒特定函式 因為每個檔案的開始都一樣)跟結束點 要知道結束點才能做結束動作 才能把這段東西再搬到硬碟存放
 // fgets() 只能讀取英文字串(英文每個單字是用空白區隔)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1 class="header">文字檔案匯入練習</h1>
<!---建立檔案上傳機制--->
<div class="outside">
    <form action="?" method="post" enctype="multipart/form-data">
        <input type="file" name="text" id="text">
        <input type="submit" value="上傳">
    </form>
</div>

<!----讀出匯入完成的資料----->



</body>
</html>