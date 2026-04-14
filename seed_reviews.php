<?php
header('Content-Type: text/html; charset=utf-8');

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8mb4");

    // Create table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        client_name VARCHAR(255) NOT NULL,
        client_photo VARCHAR(500) DEFAULT NULL,
        rating INT DEFAULT 5,
        review_text TEXT NOT NULL,
        is_active TINYINT(1) DEFAULT 1,
        sort_order INT DEFAULT 0,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

    // Convert existing table to utf8mb4
    try { $pdo->exec("ALTER TABLE reviews CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"); } catch (\Exception $e) {}

    echo "<h2>Seeding reviews...</h2>";

    // Delete existing
    $pdo->exec("DELETE FROM reviews");

    // Insert 6 reviews with Israeli/Middle-Eastern men photos
    $reviews = [
        [
            'client_name' => 'דוד כהן',
            'client_photo' => 'https://images.unsplash.com/photo-1618077360395-f3068be8e001?w=400&h=400&fit=crop&crop=faces',
            'rating' => 5,
            'review_text' => 'השירות היה מקצועי ויוצא דופן. הכרתי את אשתי דרך הסוכנות ואנחנו נשואים כבר שנתיים. ממליץ בחום!',
        ],
        [
            'client_name' => 'אלון מזרחי',
            'client_photo' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&h=400&fit=crop&crop=faces',
            'rating' => 5,
            'review_text' => 'צוות מקצועי ואנושי. לוו אותי בכל שלב בתהליך. היום אני מאושר עם האישה הנפלאה שלי ממולדובה.',
        ],
        [
            'client_name' => 'יואב שלום',
            'client_photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&h=400&fit=crop&crop=faces',
            'rating' => 5,
            'review_text' => 'דיסקרטיות מוחלטת, מקצועיות בלי פשרות. הכל בוצע בצורה מדויקת. תודה ענקית על הליווי!',
        ],
        [
            'client_name' => 'גיא לוי',
            'client_photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop&crop=faces',
            'rating' => 5,
            'review_text' => 'הרבה מעבר למה שציפיתי. הצוות עזר לי למצוא אהבה אמיתית. ממליץ לכל גבר רציני שמחפש זוגיות.',
        ],
        [
            'client_name' => 'רן אברהם',
            'client_photo' => 'https://images.unsplash.com/photo-1564564321837-a57b7070ac4f?w=400&h=400&fit=crop&crop=faces',
            'rating' => 5,
            'review_text' => 'טיול מאורגן למולדובה, פגישות עם נשים מדהימות, וליווי צמוד. שירות ברמה הגבוהה ביותר!',
        ],
        [
            'client_name' => 'אודי ברקוביץ',
            'client_photo' => 'https://images.unsplash.com/photo-1540569014015-19a7be504e3a?w=400&h=400&fit=crop&crop=faces',
            'rating' => 5,
            'review_text' => 'אחרי 3 חודשים מצאתי את האחת. השירות שלהם איכותי, מסור ויחס אישי. תוכנית ה-VIP שווה כל שקל!',
        ],
    ];

    $stmt = $pdo->prepare("INSERT INTO reviews (client_name, client_photo, rating, review_text, is_active, sort_order, created_at) VALUES (?, ?, ?, ?, 1, ?, NOW())");

    foreach ($reviews as $i => $r) {
        $stmt->execute([$r['client_name'], $r['client_photo'], $r['rating'], $r['review_text'], $i]);
        echo "Added: " . $r['client_name'] . "<br>";
    }

    echo "<br><b style='color:green;'>✓ 6 ביקורות נוספו בהצלחה!</b>";
    echo "<br><a href='/'>חזור לאתר</a>";

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
