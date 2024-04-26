<?php
 include "db_export.php";

if(!empty($_POST)){
	$rows=all("20200706"," where `投票所編號` in ('".join("','",$_POST['select']). "')");
	// 針對不連續資料撈出 使用sql in(依你選定條件放帶出)
	// 這邊是把選定的資料 然後全部(全欄位)列出來
	$filename=date("Ymd").rand(100000000,999999999);
	$file=fopen("./doc/{$filename}.csv",'w+'); // fopen() w+:開啟可讀/可寫的檔案(我覺得是產生檔案);如果檔案不存在會建立新檔案
	fwrite($file, "\xEF\xBB\xBF"); //BOM轉碼編譯 讓文字不會亂碼 big50->utf8 一樣用fwrite()寫入
	$chk=false; //使用在要加入"第一列欄位名稱"的判斷變數
	foreach($rows as $row){
		if(!$chk){ //欄位只做一次 而且只做第一次 如果沒有這個判斷及寫入 匯出的資料沒有表頭
			$cols=array_keys($row); //取鍵值 就是欄位
			fwrite($file,join(",",$cols)."\r\n"); // \r\n斷行 寫入$file這個檔案 使用join把欄位串接起來形式
			$chk=true; //只做第一次 後面就不再取
			// 另一種寫法是foreach $idx($key) 設定idx=0執行 其他不做
		}
		fwrite($file,join(",",$row)."\r\n"); //斷行
	}
	fclose($file); // 寫完檔案後要將檔案關閉
	echo "<a href='./doc/{$filename}.csv' download>檔案已匯出，請點此連結下載</a>";
	// a tag裡面要加download 是檔案可以被下載 如果不加  選定好的資料會直接在html打開
}
?>
<style>
    table{
        border-collapse: collapse;
    }
    td{
        border:1px solid #666;
        padding:5px 12px;
    }
    th{
        border:1px solid #666;
        padding:5px 12px;
        background-color: black;
        color:white;
    }
</style>
<script src="./jquery-3.4.1.min.js"></script>
<form action="?" method="post">
	<input type="submit" value="匯出選擇的資料">
<table>
	<tr>
		<th>
			<input type="checkbox" name="" id="select"><!--這個是全部選取-->
			選取</th>
		<th>投票所編號</th>
		<th>投票所</th>
		<th>候選人1</th>
		<th>候選人1票數</th>
		<th>候選人2</th>
		<th>候選人2票數</th>
		<th>候選人3</th>
		<th>候選人3票數</th>
		<th>有效票數</th>
		<th>無效票數</th>
		<th>投票數</th>
		<th>已領未投票數</th>
		<th>發出票數</th>
		<th>用餘票數</th>
		<th>選舉人數</th>
		<th>投票率</th>
	</tr>
<?php
$rows=all('20200706');
foreach($rows as $key=>$row){
	echo "<tr>";
	echo "<td>";
	echo "<input type='checkbox' name='select[]' value='{$row['投票所編號']}'>";
	echo "</td>";
	foreach($row as $value){ //這邊要注意
		echo "<td>";
		echo $value;
		echo "</td>";
	}
	echo "</tr>";
}
?>
</table>
</form>
<script>
	$('#select').on("change",function(){
		if($(this).prop('checked')){
			$("input[name='select[]']").prop('checked',true);
		}else{
			$("input[name='select[]']").prop('checked',false);
		}
	})

</script>




