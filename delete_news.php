<?php
// تفعيل عرض الأخطاء
ini_set('display_errors', 1);
error_reporting(E_ALL);

// بيانات الاتصال
$host = 'localhost';
$dbname = 'news_sestem';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من وجود معرف الخبر
if (isset($_GET['news_id_delete'])) {
    $news_id = intval($_GET['news_id_delete']); 
    // حدف
  $sql = "UPDATE news SET deleted = 1 WHERE id = $news_id";
   //echo $news_id;
    if ($conn->query($sql) === TRUE) {
     header("Location: view_news.php"); 
     exit();
    } else {
     echo "خطأ في الحذف: " . $conn->error;
    }
} else {
    echo "معرف الخبر مفقود!";
}

$conn->close();
?>