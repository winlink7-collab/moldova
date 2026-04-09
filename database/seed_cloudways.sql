SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;
SET collation_connection = 'utf8mb4_unicode_ci';
ALTER DATABASE adhbxejeen CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Default admin user (password: admin123, sha256 hash)
INSERT INTO admin_users (email, password, full_name) VALUES
('admin@moldova.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', 'מנהל ראשי');

-- Sample Profiles
INSERT INTO profiles (name, age, city, country, height, marital_status, children, education, occupation, languages, hobbies, about, looking_for, is_active, views) VALUES
('אלנה', 28, 'קישינב', 'moldova', '170', 'single', 'ללא', 'תואר שני באדריכלות', 'מעצבת פנים ואמנית', 'אנגלית, רומנית, רוסית', 'טיולים, מוזיקה קלאסית, אמנות פלסטית',
 'אני נפש יצירתית שמוצאת יופי בפרטים הקטנים. לאחר שלמדתי עיצוב פנים, אני מעריכה הרמוניה ואיזון בכל מה שמקיף אותי.',
 'גבר בטוח בעצמו, סקרן אינטלקטואלית ומוכן לחקור את העולם', TRUE, 0),

('נטליה', 24, 'קייב', 'ukraine', '165', 'single', 'ללא', 'דוקטור לרפואת שיניים', 'רופאת שיניים', 'אנגלית, אוקראינית, רוסית', 'יוגה, קריאה, בישול',
 'אני מאמינה באהבה אמיתית ובמשפחה חמה. מחפשת גבר רציני עם ערכים.',
 'גבר רציני עם ערכי משפחה', TRUE, 0),

('אולגה', 31, 'אודסה', 'ukraine', '172', 'divorced', 'ללא', 'תואר ראשון במשפטים', 'עורכת דין', 'אנגלית, אוקראינית, רוסית, צרפתית', 'ספורט, נסיעות, צילום',
 'אישה עצמאית ומצליחה שמחפשת שותף לחיים. אני מעריכה כנות, הומור ואינטליגנציה.',
 'שותף לחיים עם חוש הומור', TRUE, 0),

('יקטרינה', 27, 'טירספול', 'moldova', '168', 'single', 'ללא', 'תואר ראשון במדעי המחשב', 'מהנדסת תוכנה', 'אנגלית, רומנית, רוסית', 'טכנולוגיה, מוזיקה, ריקוד',
 'אני משלבת בין העולם הטכנולוגי ליופי הנשי. מחפשת גבר חכם עם חוש הומור.',
 'גבר חכם ומשעשע', TRUE, 0),

('ויקטוריה', 29, 'לבוב', 'ukraine', '175', 'single', 'ללא', 'תואר שני במוזיקה', 'מורה לפסנתר', 'אנגלית, אוקראינית, פולנית', 'מוזיקה, ספרות, טבע',
 'המוזיקה היא השפה שלי. מחפשת מישהו שמבין את הנשמה דרך הצלילים.',
 'מישהו רגיש ואוהב תרבות', TRUE, 0),

('אנה', 25, 'בלץ', 'moldova', '163', 'single', 'ללא', 'בית ספר לקולינריה', 'שפית', 'אנגלית, רומנית, רוסית', 'בישול, אפייה, גינון',
 'הדרך ללב עוברת דרך הבטן, ואני יודעת לבשל את הדרך הזו בצורה מושלמת.',
 'גבר שמעריך אוכל טוב וחיי משפחה', TRUE, 0);

-- Profile photos (primary photos for each profile)
INSERT INTO profile_photos (profile_id, photo_url, is_primary) VALUES
(1, 'https://lh3.googleusercontent.com/aida-public/AB6AXuDvsj9FnH_K35JOESEHnqKoap0OLLVgxzkddpZrMqqLqpWqJZqT933Inzzu3qV5YE0NW-HtPPLmEkFYTvWZg8h9dAiDrTV6BjIg64bV_S6S45PZnYQ6Zk9QcBCL3sYYlnac8vTWfaOyGMCVTnH4JiZcMg6L1sn0_YvHFambzYuVVTmWhZCu68pFoaN0K74pdXPW18Inr-kYqPPMlHvd4Hh0Z4r3sfxxMSyOg-mwKBhDJtYosqCK5HhqpOgLHZrnaJViyCkFlPHtFdAt', TRUE),
(2, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCnjW8L3jezwRRhzjimP3FhBWoUwHsnwe1Qi37Tis-uFEcDsojWMyuQSCYsPVYSvE6XzCYhl8SHTn7fJ5C4nBBeY-BAgcogSSZNqwhkyTn902iX4KUmGfurgQcKeyx8Mdyb1P5PBLgFjZTZ8uU4VG8x1f7ef7lahbyO52xaRaRoNcWGaTZtxh06qg8VoSt0pHDL5Ah_DZF0vifQ5MNJ_lmabHLVNPH2Yq6nL98CMptPr7G_NhB-Kxap3qkbxiC_x-e1Zv5G2WsDjrdV', TRUE),
(3, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCrRWBDTK1_hq2bKqz_GUv5BfnDswVTw2dDGdGkSFPmPHyKW7gbk8PLHhBhq-m9Cm4OlwRUacGAB2b2UJlg_t0ic1-TYzJo1wldVPg-hwNhwqrdCI1i08mUWyIRxWv1n4Z46ijqxxlJu_aCoZliP-g_3L2757Cb1dY2seZ1ODY_u-Z_SK6WBDG9607_3BK7eDvA-RH4Ybc3srtCMZXf4BUU_SxdWTvK8eMI_63PGn2TPmmkha-MlaGSltT4HJZlfbuHDOwDnySLDIEd', TRUE),
(4, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCkbHafqZjnOYpQiY79MjMzfiVxPeHspXl2Ctcitg6i10orqo5_5TGzrioAycG2HTCOnTM3ExjubbHbszqRHXjHVAUwYrOD5ZA42-A56-DS8t0zpTkxdWl2gMos0eJ31h676kLbKQwvNmIi3in9As8FXpUbkULfsThyKhMEVToc_wb9NQmzYOoL0mt1HVFXrbi2ZbJjWBEtOLMlyq2u-axVADr0WhokhMtDdaEM9Ic6ZT0g-kQsCM2BBbZKhNpLhsQQZl1i_6ZLxWdy', TRUE),
(5, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCuX72IPS9fYgDVzDDziMyazkBx8npfVZlUrwT6_Yn3SPpXJk3xswk_tF51vi7o3f-_4d5Y-wWsBfFgJ9YTgdUiAUn5YbWXCOQp-9mwHUG4-UZkZOR3mHZhLbt6AdYVdVOepGWETToSOfUf5Q0knJnlJyniILdUPRpoBCgveT7EsyF5Kv-rWZe_YF4hj3YE9DXeTKPOK4LFIpBapoUFPKsKSGeo8YABTpmSOFR0MCbUKIFqgoHVe9jEtscqYIls8utsAiCZXel4hEaR', TRUE),
(6, 'https://lh3.googleusercontent.com/aida-public/AB6AXuCU1gRIDup8tO0aByJ_bGGpn9BwY0PljLQ3q1auy_tHIB-TkyjEM6lrMwr9LxveOkyWZ0GJDadOQ2YOUgBDTfhZcIFzHpYk3DpX1QlykAAfAXtsi2nzR-5OuItY6SOFOR5Ejv851-hvaHNuhcse3oAUQXgWbmUkcgi4g6Q08X0e7AvibvaosPtH__syx_epqUyJUgZO8gPKsNaBBUXYj9HXQIlA1YguQvGpGg_8eFyDadTWUEYYoDSdjmeBBm0MqBlSZMSnhsxxn5KV', TRUE);

-- Success Stories
INSERT INTO success_stories (title, couple_names, story, image_url, is_active) VALUES
('דוד ואולגה - אהבה ממבט ראשון', 'דוד ואולגה',
 'חשבתי שכבר לא אמצא אהבה כזו. השירות היה מקצועי, דיסקרטי ומדויק להפליא. היום אנחנו חיים יחד בתל אביב.',
 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRl8m3xCKcuaz8TUFEUX-F4g-FdiHONlkHeT5NQzGfQBp_qxKdKhhjG8pJR_a88IFki41XCwxiCYVlHa6IJp2SnY75wn7l_IjJjKA8Mf2kMMcKqU4NfxDivHvkarldQd028psN1yMyVDEunPp-g7dZe_cPWzS5MjE72nPTDIvphnhYc_pk_LuS-Kk0_mNrEUQx-LICl7fOVQzX0yuVwEdD-DAjDTD5yQB7eh8HFBv2sQhrAsk1_Om6SkvRGnJ9jTF4glctIa7dRi5Q', TRUE),

('איתן ויוליה - שידוך VIP', 'איתן ויוליה',
 'הליווי של הצוות במולדובה היה יוצא מן הכלל. הם דאגו לכל פרט וגרמו לי להרגיש בבית. יוליה היא בדיוק מה שחיפשתי.',
 'https://lh3.googleusercontent.com/aida-public/AB6AXuDXlo-gZ5PCyhKp9FmvV-ztLSrQDD5dujR-Veyk50aI8GhpQn_fZt32SM4ZZsxA7nrGPaHqzBs0N7SB6QpTF7fHY30T2h9mp7CdEuEF-lw5c-4gkUSYz0wevvP_8fs8S4dDtdGPn4-StpFsqRCTXYCKx2wevd2pYAy7dLMX7LlqgOniKjbpitcW_CRoEjuVtsmCMV9MzGgKP9Vp6sbXxOKcXQ_b3TQMb6VCUuAlgIDmaQ6bA8UwvwGSb2y6nPHqVsjB0kfX8yiI6pLh', TRUE),

('רון ונטליה - סיפור אהבה', 'רון ונטליה',
 'תהליך הסינון שלהם עובד. הכרתי אישה אינטליגנטית עם ערכי משפחה מדהימים. תודה על הכל!',
 'https://lh3.googleusercontent.com/aida-public/AB6AXuBRauqP-EVXn2W_0PWxvqQvHWwly8zTFQTZcLyJ2XCeYP7qaaRWmDjQLdMljqJntd2VaDYYpRJReZ7pZX5MemNFi7apgdsYdg2aw79djeh745CjlSzPYbPXhbFJL2bdx8vNiCmg1Gd9UKSpG7WL9UCQEkKhxCIIEHJTGUeSJkvFn-jns2tERas1Qtpgq75vHW03U1fQoRPgtAn5We9i58zavtQB1dsTkJ-zHZ38T4BNKyLhsQS-XdrTmPJiisprls1_d88wm10aUanj', TRUE);

-- FAQs
INSERT INTO faqs (question, answer, sort_order) VALUES
('איך אנחנו מאמתים את הפרופילים במערכת?', 'תהליך האימות שלנו הוא הקפדני ביותר בתחום. כל מועמדת עוברת ראיון וידאו אישי, אימות תעודות מזהות ובדיקת רקע מקיפה. אנחנו מוודאים שכל המידע המוצג, כולל מצב משפחתי וכוונות לקשר רציני, הוא אמיתי ומעודכן ב-100%.', 1),
('האם השירות דיסקרטי לחלוטין?', 'בהחלט. דיסקרטיות היא ערך עליון עבורנו. המידע האישי שלך מאובטח ברמה הגבוהה ביותר ואינו נחשף לצדדים שלישיים ללא אישור מפורש ממך.', 2),
('מהו אימות ה-Live Hello המפורסם שלכם?', 'מנגנון Live Hello הוא הדרך שלנו להבטיח שאין הפתעות במפגש הראשון. לפני שאתה טס או קובע פגישה, אנחנו מארגנים שיחת וידאו קצרה ובלתי אמצעית.', 3),
('איך מתחילים את התהליך למציאת זוגיות?', 'הצעד הראשון הוא שיחת ייעוץ ראשונית ללא התחייבות. בשיחה זו נכיר את הציפיות שלך, הערכים שחשובים לך והפרופיל האידיאלי שאתה מחפש.', 4),
('האם יש לכם נציגות מקומית במולדובה ובאוקראינה?', 'כן, יש לנו צוותים מקומיים הפועלים בשטח בקישינב, קייב ובערים נוספות.', 5);

-- Process Steps
INSERT INTO process_steps (step_number, title, description, icon) VALUES
(1, 'ייעוץ ראשוני', 'נפתח בשיחת עומק אישית כדי להבין את השאיפות, הערכים ומה שאתה מחפש בבת זוג לחיים.', 'forum'),
(2, 'יצירת פרופיל ואימות', 'אנו בונים לך פרופיל יוקרתי המציג אותך באור הטוב ביותר. במקביל, אנו מבצעים אימות נתונים קפדני.', 'verified_user'),
(3, 'התאמה אישית', 'השדכניות המומחיות שלנו סורקות את מאגרי הנתונים האקסקלוסיביים שלנו כדי למצוא עבורך התאמות מדויקות.', 'favorite'),
(4, 'הכרות וידאו (Live Hello)', 'אנו מארגנים שיחת וידאו חיה ומאובטחת שבה תוכל להתרשם ולהרגיש את החיבור האמיתי.', 'video_call'),
(5, 'פגישה במציאות', 'הרגע המרגש מכל. אנו נדאג לכל הלוגיסטיקה עבור הפגישה הפרונטלית.', 'flight_takeoff');

-- Default settings
INSERT INTO settings (setting_key, setting_value) VALUES
('site_name', 'Moldova & Ukraine Luxury Brides'),
('site_phone', '+972-50-000-0000'),
('site_email', 'info@moldovabrides.co.il'),
('site_address', 'תל אביב, ישראל'),
('whatsapp', '972500000000'),
('facebook_url', '#'),
('instagram_url', '#'),
('footer_text', 'שירות שידוכים יוקרתי לגברים ישראלים המחפשים זוגיות רצינית עם נשים ממולדובה ואוקראינה');
