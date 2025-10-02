<?php
$host = 'localhost';
$dbname = 'news_sestem';
$username = 'root'; 
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض الفئات</title>
</head>
<body>
    <h1>الصفحة الرئيسية للنظام</h1>

    <ul>
        <li><a href="add_category.php">إضافة فئة</a></li>
        <li><a href="view_news.php">عرض جميع الأخبار</a></li>
        <li><a href="view_deleted_news.php">عرض الأخبار المحذوفة</a></li>
    </ul>

    <h2>عرض الفئات</h2>
    <?php
    $sql = "SELECT * FROM categories"; 
    $result = $conn->query($sql);

    if ($result) {  // تحقق من نجاح الاستعلام
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>اسم الفئة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['name'] . "</td>
                        <td><a href='edit_category.php?id=" . $row['id'] . "'>تعديل</a></td>
                        <td><a href='delete_category.php?id=" . $row['id'] . "'>حذف</a></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "لا توجد فئات لعرضها.";
        }
    } else {
        echo "خطأ في الاستعلام: " . $conn->error;  // طباعة خطأ الاستعلام
    }

    $conn->close();
    ?>

</body>
</html>