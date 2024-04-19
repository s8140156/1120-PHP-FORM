<h2>瀏覽資料夾imgs內容</h2>
<style>
    ul{
        list-style-type: none;
        display: flex;
        width:1000px;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        transition: all 0.5s ease;
        transform: scale(1);
    }
    li:hover{
        transition: all 0.5s ease;
        transform: scale(1.1);
    }
</style>
<?php
$dir="./imgs"; //指定檔案目錄
$files=scandir($dir); //瀏覽資料夾裡面內容 取得目錄內的文件列表scandir() 這個函式如果目錄內有值 會以array形式
$filestr='beauty';
echo "<ul>";
 if(!empty($files)){ //如果$files陣列不為空
	foreach($files as $idx=>$file){
		if(str_contains($file,'thumb') && is_file($dir."/".$file)){ //除了判斷目錄裡符合指定的字串,還要是在路徑內的'檔案'
        // str_contains()確認某個'字串'是否有在給出的字串內 回傳true/false
        // strpos()找某個字串在給出字串內的位置 回傳int
            $ext=explode(".",$file)[1]; //把檔案炸開取.後面的副檔名[1]
            $filename='thumb_'.$filestr.sprintf("%04d",$idx+1).".".$ext; //確認檔名更名方式組合
            rename($dir."/".$file,$dir."/".$filename); //把檔案改名 需把完整路徑放上 可以在imgs資料夾中看到被改掉的檔案
            echo "<li>";
            echo "<img src='$dir/$filename'>"; //在畫面上只有呈現縮圖
            echo "</li>";
		}
	}
 }
echo "</ul>";

// 這段是在教php可以直接瀏覽目錄(不是從資料庫),可以讀目錄裡面檔案並依照需要 轉化成可以成網頁上看的形式(html)
// 雲端硬碟的基礎模樣
//使用php file()函式相關
// File_exists(),Fopen,Fwrite,Fclose,Fgets,copy,unlink(**這是用在檔案要刪除的時候)

?>