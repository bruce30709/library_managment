<font color="orange" size="100">新增書 & send email</font>
<form action="e.php" method="post">
書名<input type='test' name='book'>
編號<input type='test' name='id'>
<br>
作者<input type='test' name='auth'>
關鍵字<input type='test' name='key'>
<input type="submit" value="送出並寄信給所有使用者">
</form>

<font color="orange" size="100">查書</font>
<form action="index.php" method="post">
　<select name="choose">
  <option value="書名">書名</option>
  <option value="編號">編號</option>
  <option value="作者">作者</option>
  <option value="關鍵字">關鍵字</option>
</select>
 <input type="test" name="YourName">
　<input type="submit" value="送出">
</form>

<?php
@$type=$_POST[choose];
@$name=$_POST[YourName];
$DBNAME = "library";
$servername = "localhost";
$username = "root";
$password = "root";

// 创建连接
$conn = mysqli_connect($servername, $username, $password);
// 检测连接
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "连接成功";

if( !mysqli_select_db($conn, $DBNAME)) {
  die ("無法選擇資料庫");
}
// 設定連線編碼
mysqli_query( $conn, "SET NAMES 'utf8'");
$sql ="select * from book where $type='$name'";
$result = mysqli_query($conn, $sql);
if($name)
{
	if ($result->num_rows > 0) {
    	// 输出数据
    	while($row = $result->fetch_assoc()) {
        	echo "關鍵字: " . $row["關鍵字"]. " 書名: " . $row["書名"]. " 編號" . $row["編號"]." 作者 " . $row["作者"] ;
			$temp=$row["書名"];
			$sql2 = "select * from 紀錄 where 書名='$temp'";
			
			$result2 = mysqli_query($conn, $sql2);
			echo "<br>";
			if ($result2->num_rows == 0)
			{
				$temp2="http://www.google.com";
				echo"<form style='margin:0px;display:inline;' action='a.php' method='post'><br>輸入email<input type='test' name='page2'>\t<input type='submit' name='SB' value='借書'><input type='hidden' value=$temp name='page'></form>";				
			}
			else
			{
			echo "<form style='margin:0px;display:inline;' action='b.php' method='post'><br><input type='submit' name='SB' value='寄email'><input type='hidden' value=$temp name='page2'></form>\t<form style='margin:0px;display:inline;' action='c.php' method='post'><input type='submit' name='SB2' value='還書'><input type='hidden' value=$temp name='back'></form>";
			}
			echo "\t<form style='margin:0px;display:inline;' action='d.php' method='post'><input type='submit' name='SB2' value='刪除'><input type='hidden' value=$temp name='del'></form><br>";
    	}
	
	} else {
    	echo "0 结果";
	
	}
	
}
  

?>
