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
    <title>عرض الأخبار</title>
</head>
<body>
    <h1>الصفحة الرئيسية للنظام</h1>

    <ul>
        <li><a href="add_category.php">إضافة فئة</a></li>
        <li><a href="view_categories.php">عرض الفئات</a></li>
        <li><a href="view_deleted_news.php">عرض الأخبار المحذوفة</a></li>
    </ul>

    <h2>عرض الأخبار</h2>
    <?php
    $sql = "SELECT news.id, news.title, categories.name AS category_name, news.details, news.image FROM news JOIN categories ON news.category_id = categories.id WHERE news.deleted = 0"; 
    $result = $conn->query($sql);

    if ($result) {  // تحقق من نجاح الاستعلام
        if ($result->num_rows > 0) {
            echo "<table border='1'>
                    <tr>
                        <th>عنوان الخبر</th>
                        <th>الفئة</th>
                        <th>التفاصيل</th>
                        <th>الصورة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                    </tr>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['category_name'] . "</td>
                        <td>" . $row['details'] . "</td>
                        <td><img src='" . $row['image'] . "' width='100' height='100'></td>
                        <td><a href='edit_news.php?news_id_update=" . $row['id'] . "'>تعديل</a></td>
                        <td><a href='delete_news.php?news_id_delete=" . $row['id'] . "'>حذف</a></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "لا توجد أخبار لعرضها.";
        }
    } else {
        echo "خطأ في الاستعلام: " . $conn->error;  //  رسالة الخطأ
    }

    $conn->close();
    ?>

</body>
</html>