SET NAMES utf8mb4;
USE moldova_brides;

CREATE TABLE IF NOT EXISTS process_steps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    step_number INT NOT NULL DEFAULT 1,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(100) DEFAULT 'star',
    image_url VARCHAR(500),
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO process_steps (step_number, title, description, icon, image_url) VALUES
(1, 'ייעוץ ראשוני', 'נפתח בשיחת עומק אישית כדי להבין את השאיפות, הערכים ומה שאתה מחפש בבת זוג לחיים. המטרה שלנו היא דיוק מקסימלי מהרגע הראשון.', 'forum', ''),
(2, 'יצירת פרופיל ואימות', 'אנו בונים לך פרופיל יוקרתי המציג אותך באור הטוב ביותר. במקביל, אנו מבצעים אימות נתונים קפדני לכל המועמדות כדי להבטיח ביטחון ויושרה מלאה.', 'verified_user', ''),
(3, 'התאמה אישית', 'השדכניות המומחיות שלנו במולדובה ואוקראינה סורקות את מאגרי הנתונים האקסקלוסיביים שלנו כדי למצוא עבורך התאמות מדויקות העונות על הקריטריונים שלך.', 'favorite', ''),
(4, 'הכרות וידאו (Live Hello)', 'הכימיה הראשונית חשובה. אנו מארגנים שיחת וידאו חיה ומאובטחת שבה תוכל להתרשם, לשוחח ולהרגיש את החיבור האמיתי לפני שאתה מתחייב לנסיעה.', 'video_call', ''),
(5, 'פגישה במציאות', 'הרגע המרגש מכל. אנו נדאג לכל הלוגיסטיקה עבור הפגישה הפרונטלית במולדובה או במקום נייטרלי, כולל אירוח יוקרתי וליווי מקצועי של השדכנית.', 'flight_takeoff', '');
