-- ==============================================
-- Moldova & Ukraine Brides - Database Setup
-- הרצה: mysql -u root --default-character-set=utf8mb4 < setup_database.sql
-- ==============================================

SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS moldova_brides
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE moldova_brides;

-- ==============================================
-- טבלת משתמשים (גברים רשומים)
-- ==============================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    age INT,
    city VARCHAR(100),
    country VARCHAR(100) DEFAULT 'ישראל',
    profile_image VARCHAR(500),
    is_vip BOOLEAN DEFAULT FALSE,
    vip_expires_at DATETIME,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ==============================================
-- טבלת פרופילים (נשים)
-- ==============================================
CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100),
    age INT NOT NULL,
    city VARCHAR(100) NOT NULL,
    country ENUM('moldova', 'ukraine') NOT NULL,
    occupation VARCHAR(255),
    education VARCHAR(255),
    languages VARCHAR(255),
    hobbies TEXT,
    bio TEXT,
    quote TEXT,
    height INT,
    marital_status ENUM('single', 'divorced', 'widowed') DEFAULT 'single',
    has_children BOOLEAN DEFAULT FALSE,
    wants_children BOOLEAN DEFAULT TRUE,
    looking_for_age_min INT DEFAULT 28,
    looking_for_age_max INT DEFAULT 45,
    relationship_goal VARCHAR(255) DEFAULT 'נישואין רציניים',
    willing_to_relocate BOOLEAN DEFAULT TRUE,
    is_vip BOOLEAN DEFAULT FALSE,
    is_verified BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    is_online BOOLEAN DEFAULT FALSE,
    last_seen DATETIME,
    main_image VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ==============================================
-- טבלת תמונות פרופיל
-- ==============================================
CREATE TABLE IF NOT EXISTS profile_photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_id INT NOT NULL,
    image_url VARCHAR(500) NOT NULL,
    is_private BOOLEAN DEFAULT FALSE,
    sort_order INT DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);

-- ==============================================
-- טבלת לידים (פניות מדף הנחיתה)
-- ==============================================
CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    age INT,
    email VARCHAR(255) NOT NULL,
    interest VARCHAR(255),
    status ENUM('new', 'contacted', 'converted', 'closed') DEFAULT 'new',
    notes TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- טבלת הודעות
-- ==============================================
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sender_user_id INT,
    receiver_profile_id INT,
    content TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sender_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (receiver_profile_id) REFERENCES profiles(id) ON DELETE SET NULL
);

-- ==============================================
-- טבלת מועדפים
-- ==============================================
CREATE TABLE IF NOT EXISTS favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    profile_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_favorite (user_id, profile_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (profile_id) REFERENCES profiles(id) ON DELETE CASCADE
);

-- ==============================================
-- טבלת סיפורי הצלחה
-- ==============================================
CREATE TABLE IF NOT EXISTS success_stories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    couple_name VARCHAR(255) NOT NULL,
    story_text TEXT NOT NULL,
    image_url VARCHAR(500),
    badge VARCHAR(100) DEFAULT 'סיפור אהבה',
    is_published BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- טבלת אירועים/סיורים
-- ==============================================
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    event_date DATETIME NOT NULL,
    city VARCHAR(100),
    country ENUM('moldova', 'ukraine') NOT NULL,
    max_participants INT DEFAULT 20,
    price DECIMAL(10,2),
    image_url VARCHAR(500),
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ==============================================
-- טבלת רישום לאירועים
-- ==============================================
CREATE TABLE IF NOT EXISTS event_registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    user_id INT NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_registration (event_id, user_id),
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ==============================================
-- טבלת דפים מותאמים
-- ==============================================
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content LONGTEXT,
    show_in_menu BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ==============================================
-- טבלת הגדרות אתר
-- ==============================================
CREATE TABLE IF NOT EXISTS site_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ==============================================
-- טבלת שאלות נפוצות
-- ==============================================
CREATE TABLE IF NOT EXISTS faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(500) NOT NULL,
    answer TEXT NOT NULL,
    sort_order INT DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==============================================
-- טבלת שלבי תהליך השידוך
-- ==============================================
CREATE TABLE IF NOT EXISTS process_steps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    step_number INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(100) DEFAULT 'star',
    image_url VARCHAR(500),
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==============================================
-- טבלת איפוס סיסמה
-- ==============================================
CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    expires_at DATETIME NOT NULL,
    used BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==============================================
-- טבלת מנהלי מערכת
-- ==============================================
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==============================================
-- דאטה לדוגמה - פרופילים
-- ==============================================
INSERT INTO profiles (first_name, age, city, country, occupation, education, languages, hobbies, bio, quote, marital_status, is_vip, is_verified, is_online, main_image) VALUES
('אלנה', 28, 'קישינב', 'moldova', 'מעצבת פנים ואמנית', 'תואר שני באדריכלות', 'אנגלית, רומנית, רוסית', 'טיולים, מוזיקה קלאסית, אמנות פלסטית',
 'אני נפש יצירתית שמוצאת יופי בפרטים הקטנים. לאחר שלמדתי עיצוב פנים, אני מעריכה הרמוניה ואיזון בכל מה שמקיף אותי. אני מחפשת גבר בטוח בעצמו, סקרן אינטלקטואלית ומוכן לחקור את העולם.',
 'החיים הם קנבס, ואני מאמינה במילוי שלו בחוויות היפות ביותר, קשרים אותנטיים ורגעים משמעותיים.',
 'single', TRUE, TRUE, TRUE,
 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvsj9FnH_K35JOESEHnqKoap0OLLVgxzkddpZrMqqLqpWqJZqT933Inzzu3qV5YE0NW-HtPPLmEkFYTvWZg8h9dAiDrTV6BjIg64bV_S6S45PZnYQ6Zk9QcBCL3sYYlnac8vTWfaOyGMCVTnH4JiZcMg6L1sn0_YvHFambzYuVVTmWhZCu68pFoaN0K74pdXPW18Inr-kYqPPMlHvd4Hh0Z4r3sfxxMSyOg-mwKBhDJtYosqCK5HhqpOgLHZrnaJViyCkFlPHtFdAt'),

('נטליה', 24, 'קייב', 'ukraine', 'רופאת שיניים', 'דוקטור לרפואת שיניים', 'אנגלית, אוקראינית, רוסית', 'יוגה, קריאה, בישול',
 'אני מאמינה באהבה אמיתית ובמשפחה חמה. מחפשת גבר רציני עם ערכים.',
 'האושר הוא לא יעד, אלא דרך חיים.',
 'single', FALSE, TRUE, FALSE,
 'https://lh3.googleusercontent.com/aida-public/AB6AXuCnjW8L3jezwRRhzjimP3FhBWoUwHsnwe1Qi37Tis-uFEcDsojWMyuQSCYsPVYSvE6XzCYhl8SHTn7fJ5C4nBBeY-BAgcogSSZNqwhkyTn902iX4KUmGfurgQcKeyx8Mdyb1P5PBLgFjZTZ8uU4VG8x1f7ef7lahbyO52xaRaRoNcWGaTZtxh06qg8VoSt0pHDL5Ah_DZF0vifQ5MNJ_lmabHLVNPH2Yq6nL98CMptPr7G_NhB-Kxap3qkbxiC_x-e1Zv5G2WsDjrdV'),

('אולגה', 31, 'אודסה', 'ukraine', 'עורכת דין', 'תואר ראשון במשפטים', 'אנגלית, אוקראינית, רוסית, צרפתית', 'ספורט, נסיעות, צילום',
 'אישה עצמאית ומצליחה שמחפשת שותף לחיים. אני מעריכה כנות, הומור ואינטליגנציה.',
 'הדבר הכי חשוב הוא למצוא מישהו שגורם לך לצחוק.',
 'divorced', FALSE, TRUE, TRUE,
 'https://lh3.googleusercontent.com/aida-public/AB6AXuCrRWBDTK1_hq2bKqz_GUv5BfnDswVTw2dDGdGkSFPmPHyKW7gbk8PLHhBhq-m9Cm4OlwRUacGAB2b2UJlg_t0ic1-TYzJo1wldVPg-hwNhwqrdCI1i08mUWyIRxWv1n4Z46ijqxxlJu_aCoZliP-g_3L2757Cb1dY2seZ1ODY_u-Z_SK6WBDG9607_3BK7eDvA-RH4Ybc3srtCMZXf4BUU_SxdWTvK8eMI_63PGn2TPmmkha-MlaGSltT4HJZlfbuHDOwDnySLDIEd'),

('יקטרינה', 27, 'טירספול', 'moldova', 'מהנדסת תוכנה', 'תואר ראשון במדעי המחשב', 'אנגלית, רומנית, רוסית', 'טכנולוגיה, מוזיקה, ריקוד',
 'אני משלבת בין העולם הטכנולוגי ליופי הנשי. מחפשת גבר חכם עם חוש הומור.',
 'הקוד הכי יפה הוא זה שמחבר בין שני לבבות.',
 'single', TRUE, TRUE, TRUE,
 'https://lh3.googleusercontent.com/aida-public/AB6AXuCkbHafqZjnOYpQiY79MjMzfiVxPeHspXl2Ctcitg6i10orqo5_5TGzrioAycG2HTCOnTM3ExjubbHbszqRHXjHVAUwYrOD5ZA42-A56-DS8t0zpTkxdWl2gMos0eJ31h676kLbKQwvNmIi3in9As8FXpUbkULfsThyKhMEVToc_wb9NQmzYOoL0mt1HVFXrbi2ZbJjWBEtOLMlyq2u-axVADr0WhokhMtDdaEM9Ic6ZT0g-kQsCM2BBbZKhNpLhsQQZl1i_6ZLxWdy'),

('ויקטוריה', 29, 'לבוב', 'ukraine', 'מורה לפסנתר', 'תואר שני במוזיקה', 'אנגלית, אוקראינית, פולנית', 'מוזיקה, ספרות, טבע',
 'המוזיקה היא השפה שלי. מחפשת מישהו שמבין את הנשמה דרך הצלילים.',
 'כל אדם הוא מנגינה, צריך רק למצוא את ההרמוניה.',
 'single', FALSE, TRUE, FALSE,
 'https://lh3.googleusercontent.com/aida-public/AB6AXuCuX72IPS9fYgDVzDDziMyazkBx8npfVZlUrwT6_Yn3SPpXJk3xswk_tF51vi7o3f-_4d5Y-wWsBfFgJ9YTgdUiAUn5YbWXCOQp-9mwHUG4-UZkZOR3mHZhLbt6AdYVdVOepGWETToSOfUf5Q0knJnlJyniILdUPRpoBCgveT7EsyF5Kv-rWZe_YF4hj3YE9DXeTKPOK4LFIpBapoUFPKsKSGeo8YABTpmSOFR0MCbUKIFqgoHVe9jEtscqYIls8utsAiCZXel4hEaR'),

('אנה', 25, 'בלץ', 'moldova', 'שפית', 'בית ספר לקולינריה', 'אנגלית, רומנית, רוסית', 'בישול, אפייה, גינון',
 'הדרך ללב עוברת דרך הבטן, ואני יודעת לבשל את הדרך הזו בצורה מושלמת.',
 'אוכל טוב הוא אהבה שאפשר לטעום.',
 'single', TRUE, TRUE, TRUE,
 'https://lh3.googleusercontent.com/aida-public/AB6AXuCU1gRIDup8tO0aByJ_bGGpn9BwY0PljLQ3q1auy_tHIB-TkyjEM6lrMwr9LxveOkyWZ0GJDadOQ2YOUgBDTfhZcIFzHpYk3DpX1QlykAAfAXtsi2nzR-5OuItY6SOFOR5Ejv851-hvaHNuhcse3oAUQXgWbmUkcgi4g6Q08X0e7AvibvaosPtH__syx_epqUyJUgZO8gPKsNaBBUXYj9HXQIlA1YguQvGpGg_8eFyDadTWUEYYoDSdjmeBBm0MqBlSZMSnhsxxn5KV');

-- ==============================================
-- דאטה לדוגמה - סיפורי הצלחה
-- ==============================================
INSERT INTO success_stories (couple_name, story_text, badge, image_url) VALUES
('דוד ואולגה',
 'חשבתי שכבר לא אמצא אהבה כזו. השירות היה מקצועי, דיסקרטי ומדויק להפליא. היום אנחנו חיים יחד בתל אביב.',
 'נשואים באושר',
 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRl8m3xCKcuaz8TUFEUX-F4g-FdiHONlkHeT5NQzGfQBp_qxKdKhhjG8pJR_a88IFki41XCwxiCYVlHa6IJp2SnY75wn7l_IjJjKA8Mf2kMMcKqU4NfxDivHvkarldQd028psN1yMyVDEunPp-g7dZe_cPWzS5MjE72nPTDIvphnhYc_pk_LuS-Kk0_mNrEUQx-LICl7fOVQzX0yuVwEdD-DAjDTD5yQB7eh8HFBv2sQhrAsk1_Om6SkvRGnJ9jTF4glctIa7dRi5Q'),

('איתן ויוליה',
 'הליווי של הצוות במולדובה היה יוצא מן הכלל. הם דאגו לכל פרט וגרמו לי להרגיש בבית. יוליה היא בדיוק מה שחיפשתי.',
 'שידוך VIP',
 'https://lh3.googleusercontent.com/aida-public/AB6AXuDXlo-gZ5PCyhKp9FmvV-ztLSrQDD5dujR-Veyk50aI8GhpQn_fZt32SM4ZZsxA7nrGPaHqzBs0N7SB6QpTF7fHY30T2h9mp7CdEuEF-lw5c-4gkUSYz0wevvP_8fs8S4dDtdGPn4-StpFsqRCTXYCKx2wevd2pYAy7dLMX7LlqgOniKjbpitcW_CRoEjuVtsmCMV9MzGgKP9Vp6sbXxOKcXQ_b3TQMb6VCUuAlgIDmaQ6bA8UwvwGSb2y6nPHqVsjB0kfX8yiI6pLh'),

('רון ונטליה',
 'תהליך הסינון שלהם עובד. הכרתי אישה אינטליגנטית עם ערכי משפחה מדהימים. תודה על הכל!',
 'סיפור אהבה',
 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRauqP-EVXn2W_0PWxvqQvHWwly8zTFQTZcLyJ2XCeYP7qaaRWmDjQLdMljqJntd2VaDYYpRJReZ7pZX5MemNFi7apgdsYdg2aw79djeh745CjlSzPYbPXhbFJL2bdx8vNiCmg1Gd9UKSpG7WL9UCQEkKhxCIIEHJTGUeSJkvFn-jns2tERas1Qtpgq75vHW03U1fQoRPgtAn5We9i58zavtQB1dsTkJ-zHZ38T4BNKyLhsQS-XdrTmPJiisprls1_d88wm10aUanj');
