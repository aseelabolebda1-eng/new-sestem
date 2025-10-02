<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'news_sestem');

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من وجود الـ news_id في الرابط
if (isset($_GET['news_id'])) {
    $news_id = intval($_GET['news_id']);  // تأكد من تحويل المعرف إلى عدد صحيح
    
    // استعلام لجلب بيانات الخبر بناءً على المعرف
    $sql = "SELECT * FROM news WHERE id = $news_id";
    $result = $conn->query($sql);
    
    // إذا تم العثور على الخبر
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "الخبر غير موجود";
        exit();
    }
} else {
    echo "المعرف غير موجود";
    exit();
}

// إغلاق الاتصال بعد استخدامه
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل الخبر</title>
</head>
<body>

    <h2>تعديل الخبر</h2>
    
    <!-- فورم لتعديل الخبر -->
    <form method="POST" action="update_news.php">
        <input type="hidden" name="news_id" value="<?php echo $row['id']; ?>" />
        
        <label for="title">العنوان:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required /><br>

        <label for="category">الفئة:</label>
        <input type="text" name="category" value="<?php echo htmlspecialchars($row['category']); ?>" required /><br>

        <label for="details">التفاصيل:</label>
        <textarea name="details" required><?php echo htmlspecialchars($row['details']); ?></textarea><br>

        <button type="submit">تحديث الخبر</button>
    </form>

</body>
</html>