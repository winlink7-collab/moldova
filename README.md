# Moldova & Ukraine Luxury Brides

אתר שידוכים יוקרתי בינלאומי - מחבר בין גברים מצליחים לנשים יפות וערכיות ממולדובה ואוקראינה.

## 🌐 כתובת האתר

**Production:** https://phpstack-679104-6338346.cloudwaysapps.com/

## 🛠️ טכנולוגיות

- **Backend:** PHP 7+ (Custom MVC Framework)
- **Database:** MySQL / MariaDB (utf8mb4)
- **Frontend:** Tailwind CSS, Vanilla JavaScript
- **Hosting:** Cloudways (DigitalOcean)
- **Deployment:** Git (GitHub)

## 📁 מבנה הפרויקט

```
/moldova/
├── index.php                    # Router ראשי
├── .htaccess                    # Apache rewrite rules
├── config/
│   ├── database.php            # הגדרות מסד נתונים
│   └── translations.php        # מערכת תרגומים (he/ru/en)
├── app/
│   ├── controllers/            # Controllers
│   │   ├── HomeController.php
│   │   ├── PageController.php
│   │   ├── ProfileController.php
│   │   ├── DashboardController.php
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   └── ApiController.php
│   ├── models/
│   │   └── Database.php        # Singleton PDO wrapper
│   ├── services/
│   │   └── MailService.php     # שירות שליחת מיילים
│   └── views/                  # Views
│       ├── layouts/            # Header/Footer משותף
│       ├── home/, about/, search/, profile/, vip/
│       ├── stories/, process/, faq/, contact/
│       ├── dashboard/, login/, admin/, page/
├── public/
│   ├── css/
│   ├── js/
│   │   └── auto-translate.js   # תרגום אוטומטי לתוכן דינמי
│   └── uploads/                # תמונות וסרטונים
├── uploads/                    # אחסון נוסף
├── database/
│   ├── schema.sql             # סכמת DB
│   ├── schema_cloudways.sql   # סכמה ל-Cloudways
│   └── seed.sql               # נתוני התחלה
└── fix_hebrew.php             # סקריפט תיקון עברית
```

## 🗺️ Routes

### דפים ציבוריים
- `/` - דף הבית
- `/about` - אודות
- `/search` - חיפוש פרופילים
- `/process` - תהליך השידוך
- `/vip` - חבילות VIP
- `/stories` - סיפורי הצלחה
- `/faq` - שאלות נפוצות
- `/contact` - צור קשר
- `/profile/{id}` - צפייה בפרופיל
- `/login` - כניסה
- `/dashboard` - אזור אישי
- `/admin` - פאנל ניהול

### API Endpoints
```
POST /api/register           הרשמת משתמש
POST /api/login              התחברות
POST /api/verify-email       אימות מייל
POST /api/resend-verification שליחה מחדש של מייל אימות
POST /api/forgot-password    בקשת איפוס סיסמה
POST /api/reset-password     איפוס סיסמה
GET  /api/profiles           רשימת פרופילים
GET  /api/profiles/{id}      פרופיל בודד
POST /api/leads              יצירת ליד
POST /api/contact            טופס צור קשר
POST /api/messages           שליחת הודעה
POST /api/upload             העלאת קובץ
GET  /api/faqs               שאלות נפוצות
GET  /api/settings           הגדרות אתר

# Admin (דורש התחברות)
POST /api/admin/login        התחברות מנהל
POST /api/admin/logout       התנתקות
GET  /api/admin/settings     הגדרות
POST /api/admin/settings     שמירת הגדרות
CRUD /api/admin/profiles     ניהול פרופילים
CRUD /api/admin/photos       ניהול תמונות
CRUD /api/admin/videos       ניהול סרטונים
CRUD /api/admin/stories      סיפורי הצלחה
CRUD /api/admin/faqs         שאלות נפוצות
CRUD /api/admin/process-steps שלבי תהליך
CRUD /api/admin/blocks       בלוקי תוכן דינמיים
```

## 🗄️ מסד נתונים

**Database:** `adhbxejeen` (Cloudways)

### טבלאות עיקריות
- `users` - משתמשים רשומים (עם אימות מייל)
- `admin_users` - מנהלים
- `profiles` - פרופילים של נשים
- `profile_photos` - תמונות פרופיל
- `profile_videos` - סרטוני פרופיל
- `leads` - לידים מטופס צור קשר
- `messages` - הודעות בין משתמשים
- `success_stories` - סיפורי הצלחה
- `events` - אירועים וטיולים
- `event_registrations` - הרשמות לאירועים
- `favorites` - מועדפים
- `pages` - דפי תוכן CMS
- `page_blocks` - בלוקי תוכן דינמיים
- `settings` - הגדרות גלובליות
- `faqs` - שאלות נפוצות
- `process_steps` - שלבי תהליך השידוך

## 🌍 מערכת תרגום

### תרגום סטטי
`config/translations.php` מכיל תרגומים עבור:
- עברית (he) - ברירת מחדל
- רוסית (ru)
- אנגלית (en)

שימוש: `<?= t('key') ?>` בקוד PHP, `T.key` ב-JavaScript

### תרגום דינמי
`public/js/auto-translate.js` מתרגם אוטומטית:
- שמות (עם טרנסליטרציה אוטומטית לשמות חדשים)
- ערים, מקצועות, השכלה, שפות, תחביבים
- טקסט ביוגרפיה

## 📧 מערכת אימיילים

`app/services/MailService.php` שולח:
- **מייל אימות** - בעת הרשמה
- **מייל ברוכים הבאים** - אחרי אימות מייל
- **מייל איפוס סיסמה** - עם קישור מאובטח (תקף שעה)
- **התראות למנהל** - הרשמות חדשות, לידים, הודעות

## 🎨 תכונות עיצוב

- **ערכות נושא:** כהה (ברירת מחדל) / בהיר
- **בחירת פונט:** 7 פונטים ל-Google Fonts (אדמין)
- **Responsive:** מותאם למובייל, טאבלט, דסקטופ
- **RTL/LTR:** אוטומטי לפי שפה

## 🔐 אבטחה

- סיסמאות מוצפנות SHA256
- Session + Cookie based authentication
- CSRF protection דרך SameSite cookies
- Prepared statements (PDO)
- Escape XSS ב-output
- Varnish cache disabled עבור API/Admin

## 📱 אזור אישי

**תכונות:**
- פרטים אישיים + תמונת פרופיל
- שינוי סיסמה
- הודעות אישיות
- 3 כפתורי פעולה מהירה:
  - חיפוש פרופילים
  - וואטסאפ לתמיכה
  - שדרוג ל-VIP

## 🚀 פריסה

### Cloudways
```
Server: saar1 (DigitalOcean Amsterdam)
IP: 64.225.73.226
App: moldova → /home/master/applications/adhbxejeen/public_html
```

### פריסה דרך Git
1. ערוך קבצים ב-VS Code
2. `git add -A && git commit -m "..."`
3. `git push origin main`
4. Cloudways → **Deployment via GIT** → **Pull**
5. Cloudways → **Application Settings** → **Purge** (cache)

### GitHub
**Repo:** https://github.com/winlink7-collab/moldova

## 🔑 גישה

### אדמין
- **URL:** `/admin`
- **Email:** `admin@moldova.com`
- **Password:** `admin123`

### בסיס נתונים
- **Host:** localhost
- **DB:** adhbxejeen
- **User:** adhbxejeen

## 🛠️ פאנל ניהול

### תכונות
- ניהול פרופילים (CRUD עם תמונות וסרטונים)
- ניהול משתמשים
- לידים והודעות
- סיפורי הצלחה
- שאלות נפוצות
- שלבי תהליך
- דפי CMS
- הגדרות אתר (כותרות, טקסטים, קישורים, צבעים)
- **עריכה פנימית (Inline Editing)** - עריכה ישירה בדף עם לחיצה

### Inline Editor
כפתור "הפעל עריכה" בהדר מפעיל מצב עריכה:
- לחץ על כל טקסט לעריכה
- שינוי צבעים (טקסט + רקע)
- קישורים לכפתורים (tel:, https://wa.me, URL)
- החלפת תמונות

## 📝 הערות

- כל הרשמה חדשה דורשת אימות מייל לפני כניסה
- המיילים נשלחים דרך PHP mail() - כדאי להגדיר SMTP חיצוני ב-Cloudways
- תמונות מאוחסנות ב-`/public/uploads/`
- Varnish cache פעיל - צריך Purge אחרי שינויים
