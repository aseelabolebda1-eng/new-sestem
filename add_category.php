
<?php
$conn = new mysqli('localhost', 'root', '', 'news_sestem');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category_name = $conn->real_escape_string($_POST['category_name']);

    $sql = "INSERT INTO categories (name) VALUES ('$category_name')";

    if ($conn->query($sql) === TRUE) {
        echo "تم إضافة الفئة بنجاح";
        header("Location: view_categories.php");
    } else {
        echo "حدث خطأ أثناء إضافة الفئة: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة فئة</title>
</head>
<body>

<h2>إضافة فئة جديدة</h2>

<form method="POST">
    <label for="category_name">اسم الفئة:</label>
    <input type="text" name="category_name" required /><br>
    <button type="submit">إضافة الفئة</button>
</form>

</body>
</html>
