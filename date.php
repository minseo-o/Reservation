<?php
include('./db_conn.php');
$reg = date('Y-m-d');
echo $reg;
$sql = "insert into test(reg_date) values ('$reg')";
$result = mysqli_query($conn, $sql);

if($result){
    echo "성공";
}else {
    echo "오류";
}






?>