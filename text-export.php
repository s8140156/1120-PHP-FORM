<?php
 include "db_export.php";

if(!empty($_POST)){
	$rows=all("202007066"," where `投開票所別` in ('".join("','",$_POST['select']). "')");
	$filename=date("Ymd").rand(100000000,999999999);
	$file=fopen("./doc/{$filename}.csv",'w+');
	fwrite($file, "\xEF\xBB\xBF"); //BOM轉碼編譯 讓文字不會亂碼 big50->utf8
	$chk=false; //使用在要加入第一列欄位名稱的判斷變數
	foreach($rows as $row){
		if(!$chk){
			$cols=array_keys($row); //取鍵值 就是欄位
			fwrite($file,join(",",$cols)."\r\n"); //斷行
			$chk=true; //只做第一次 後面就不再取
		}
		fwrite($file,join(",",$row)."\r\n"); //斷行
	}
	fclose($file);
	echo "<a href='./doc/{$filename}.csv' download>檔案已匯出，請點此連結下載</a>";
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
	<input type="submit" value="送出">
<table>
	<tr>
		<td>
			<input type="checkbox" name="" id="select">
			選取</td>
		<td>村里別</td>
		<td>投開票所別</td>
		<td>候選人1</td>
		<td>候選人1票數</td>
		<td>候選人2</td>
		<td>候選人2票數</td>
		<td>候選人3</td>
		<td>候選人3票數</td>
		<td>有效票數</td>
		<td>無效票數</td>
		<td>投票數</td>
		<td>已領未投票數</td>
		<td>發出票數</td>
		<td>用餘票數</td>
		<td>選舉人數</td>
		<td>投票</td>
	</tr>
<?php
$rows=all('202007066');
foreach($rows as $key=>$row){
	echo "<tr>";
	echo "<td>";
	echo "<input type='checkbox' name='select[]' value='{$row['投開票所別']}'>";
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




