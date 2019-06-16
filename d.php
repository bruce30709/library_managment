<?php
	@$action=$_POST[del];
	$DBNAME = "library";
	$servername = "localhost";
	$username = "root";
	$password = "root";
	
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
	$sql ="delete from book where 書名='$action'";
	//echo $sql;
	$result = mysqli_query($conn, $sql);
	echo"<script>alert('刪書成功');window.location.href=document.referrer;</script>";
?>