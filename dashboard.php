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
    <title>الصفحة الرئيسية</title>
</head>
<body>
    <h1>الصفحة الرئيسية للنظام</h1>

    <ul>
        <li><a href="add_category.php">إضافة فئة</a></li>
        <li><a href="view_categories.php">عرض الفئات</a></li>
        <li><a href="view_news.php">عرض جميع الأخبار</a></li>
        <li><a href="view_deleted_news.php">عرض الأخبار المحذوفة</a></li>
    </ul>

    <h2>عرض الأخبار</h2>
    <?php
    $sql = "SELECT * FROM news WHERE deleted = 0"; 
    $result = $conn->query($sql);

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
                    <td>" . $row['category'] . "</td>
                    <td>" . $row['details'] . "</td>
                    <td><img src='" . $row['image'] . "' width='100' height='100'></td>
                    <td><a href='edit_news.php?id=" . $row['id'] . "'>تعديل</a></td>
                    <td><a href='delete_news.php?id=" . $row['id'] . "'>حذف</a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "لا توجد أخبار لعرضها.";
    }

    $conn->close();
    ?>

</body>
</html>