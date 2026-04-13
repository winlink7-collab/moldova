<!DOCTYPE html>
<html class="dark" dir="rtl" lang="he">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>פאנל ניהול - Moldova & Ukraine</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet"/>
<script>
tailwind.config = {
    theme: {
        extend: {
            colors: {
                primary: '#f2d00d',
                bg: '#0f0e08',
                card: '#1a1810',
                'card-hover': '#222012',
                platinum: '#E5E4E2',
                'diamond-blue': '#b9f2ff',
            },
            fontFamily: {
                heebo: ['Heebo', 'sans-serif'],
            }
        }
    }
}
</script>
<style>
body { font-family: 'Heebo', sans-serif; }
.tab-active { border-color: #f2d00d; color: #f2d00d; background: rgba(242,208,13,0.05); }
</style>
</head>
<body class="bg-bg text-white min-h-screen font-heebo">

<script>
const BASE_URL = '<?= BASE_URL ?>';
const API = BASE_URL;
</script>

<!-- Admin Header -->
<header class="sticky top-0 z-50 bg-card border-b border-white/10 px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-primary text-3xl">admin_panel_settings</span>
        <h1 class="text-xl font-bold text-primary">פאנל ניהול</h1>
    </div>
    <div class="flex items-center gap-4">
        <a href="javascript:void(0)" onclick="window.open(BASE_URL || '/', '_blank')" class="text-sm text-white/60 hover:text-primary transition flex items-center gap-1">
            <span class="material-symbols-outlined text-sm">open_in_new</span>
            צפה באתר
        </a>
        <button onclick="adminLogout()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded text-sm transition flex items-center gap-1">
            <span class="material-symbols-outlined text-sm">logout</span>
            התנתק
        </button>
    </div>
</header>

<!-- Tabs Navigation -->
<nav class="bg-card border-b border-white/10 px-4 overflow-x-auto">
    <div class="flex gap-1 min-w-max">
        <button id="btn-profiles" onclick="switchTab('profiles')" class="tab-btn tab-active flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">people</span>
            פרופילים
        </button>
        <button id="btn-users" onclick="switchTab('users')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">group</span>
            משתמשים
        </button>
        <button id="btn-messages" onclick="switchTab('messages')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">chat</span>
            הודעות
        </button>
        <button id="btn-leads" onclick="switchTab('leads')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">contact_mail</span>
            לידים
        </button>
        <button id="btn-pages" onclick="switchTab('pages')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">description</span>
            דפים
        </button>
        <button id="btn-stories" onclick="switchTab('stories')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">auto_stories</span>
            סיפורים
        </button>
        <button id="btn-faqs" onclick="switchTab('faqs')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">quiz</span>
            שאלות נפוצות
        </button>
        <button id="btn-process" onclick="switchTab('process')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">route</span>
            תהליך
        </button>
        <button id="btn-home" onclick="switchTab('home')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">home</span>
            דף הבית
        </button>
        <button id="btn-vip" onclick="switchTab('vip')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">diamond</span>
            VIP
        </button>
        <button id="btn-about" onclick="switchTab('about')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">info</span>
            אודות
        </button>
        <button id="btn-contact" onclick="switchTab('contact')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">call</span>
            צור קשר
        </button>
        <button id="btn-reviews" onclick="switchTab('reviews')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">reviews</span>
            ביקורות
        </button>
        <button id="btn-site" onclick="switchTab('site')" class="tab-btn flex items-center gap-1.5 px-4 py-3 text-sm border-b-2 border-transparent text-white/60 hover:text-primary transition whitespace-nowrap">
            <span class="material-symbols-outlined text-lg">settings</span>
            הגדרות אתר
        </button>
    </div>
</nav>

<!-- Main Content Area -->
<main class="p-6">

<!-- ==================== PROFILES TAB ==================== -->
<div id="tab-profiles" class="tab-content">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול פרופילים</h2>
        <button onclick="openProfileForm()" class="bg-primary text-bg px-4 py-2 rounded font-semibold hover:opacity-90 transition flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            הוסף פרופיל
        </button>
    </div>
    <div id="profilesList" class="grid gap-4"></div>
</div>

<!-- ==================== USERS TAB ==================== -->
<div id="tab-users" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול משתמשים</h2>
    </div>
    <div id="usersList" class="grid gap-4"></div>
</div>

<!-- ==================== MESSAGES TAB ==================== -->
<div id="tab-messages" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול הודעות</h2>
    </div>
    <div id="messagesList" class="grid gap-4"></div>
</div>

<!-- ==================== LEADS TAB ==================== -->
<div id="tab-leads" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול לידים</h2>
    </div>
    <div id="leadsList" class="grid gap-4"></div>
</div>

<!-- ==================== PAGES TAB ==================== -->
<div id="tab-pages" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול דפים</h2>
        <button onclick="openPageForm()" class="bg-primary text-bg px-4 py-2 rounded font-semibold hover:opacity-90 transition flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            דף חדש
        </button>
    </div>
    <div id="pagesList" class="grid gap-4"></div>
</div>

<!-- ==================== STORIES TAB ==================== -->
<div id="tab-stories" class="tab-content hidden">
    <!-- Stories Page Settings -->
    <div class="bg-card border border-white/10 rounded-xl p-6 mb-8">
        <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined">edit_note</span>
            הגדרות דף סיפורים
        </h3>
        <div class="grid md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="text-xs text-slate-400 mb-1 block">כותרת Hero</label>
                <input id="adm_stories_hero_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="סיפורי הצלחה שמתחילים כאן"/>
            </div>
            <div>
                <label class="text-xs text-slate-400 mb-1 block">תת-כותרת Hero</label>
                <input id="adm_stories_hero_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="אנחנו גאים להיות חלק..."/>
            </div>
        </div>
        <div class="grid md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="text-xs text-slate-400 mb-1 block">כותרת CTA</label>
                <input id="adm_stories_cta_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="התחילו את סיפור ההצלחה שלכם"/>
            </div>
            <div>
                <label class="text-xs text-slate-400 mb-1 block">תת-כותרת CTA</label>
                <input id="adm_stories_cta_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="הכלה המושלמת מחכה לך..."/>
            </div>
            <div>
                <label class="text-xs text-slate-400 mb-1 block">טקסט כפתור CTA</label>
                <input id="adm_stories_cta_btn" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="הירשמו עכשיו לפגישת ייעוץ"/>
            </div>
        </div>
        <button onclick="saveStoriesSettings()" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition text-sm">שמור הגדרות דף</button>
    </div>

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול סיפורים</h2>
        <button onclick="openStoryForm()" class="bg-primary text-bg px-4 py-2 rounded font-semibold hover:opacity-90 transition flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            הוסף סיפור
        </button>
    </div>
    <div id="storiesList" class="grid gap-4"></div>
</div>

<!-- ==================== FAQS TAB ==================== -->
<div id="tab-faqs" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול שאלות נפוצות</h2>
        <button onclick="openFaqForm()" class="bg-primary text-bg px-4 py-2 rounded font-semibold hover:opacity-90 transition flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            הוסף שאלה
        </button>
    </div>
    <div id="faqsList" class="grid gap-4"></div>
</div>

<!-- ==================== PROCESS TAB ==================== -->
<div id="tab-process" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול תהליך</h2>
        <button onclick="openStepForm()" class="bg-primary text-bg px-4 py-2 rounded font-semibold hover:opacity-90 transition flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            הוסף שלב
        </button>
    </div>

    <!-- Process Text Settings -->
    <div class="bg-card rounded-lg p-6 border border-white/10 mb-6">
        <h3 class="text-lg font-bold text-primary mb-4">הגדרות טקסט</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm text-white/60 mb-1">כותרת Hero</label>
                <input id="process_hero_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תת כותרת Hero</label>
                <input id="process_hero_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">כותרת שלבים</label>
                <input id="process_steps_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">כותרת CTA</label>
                <input id="process_cta_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm text-white/60 mb-1">תת כותרת CTA</label>
                <input id="process_cta_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
        </div>
        <button onclick="saveProcessTexts()" class="mt-4 bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור הגדרות טקסט</button>
    </div>

    <div id="stepsList" class="grid gap-4"></div>
</div>

<!-- ==================== HOME TAB ==================== -->
<div id="tab-home" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">הגדרות דף הבית</h2>
    </div>
    <form id="homeForm" onsubmit="saveHomeSettings(event)" class="space-y-6">
        <!-- Hero -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">Hero</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">באדג׳</label>
                    <input id="adm_home_hero_badge" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת (HTML מותר)</label>
                    <input id="adm_home_hero_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תת כותרת</label>
                    <textarea id="adm_home_hero_subtitle" rows="2" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תמונת רקע</label>
                    <input id="adm_home_hero_bg_file" type="file" accept="image/*" onchange="uploadHomeImage('home_hero_bg', this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    <input id="adm_home_hero_bg" type="hidden"/>
                    <img id="adm_home_hero_bg_preview" src="" class="mt-2 h-20 rounded hidden"/>
                </div>
            </div>
        </div>

        <!-- Lead Form -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">טופס לידים</h3>
            <div>
                <label class="block text-sm text-white/60 mb-1">כותרת טופס</label>
                <input id="adm_home_form_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
        </div>

        <!-- Why Us Section -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">למה לבחור בנו</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית</label>
                    <input id="adm_home_why_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="adm_home_why_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
            <div class="space-y-4 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm text-white/60 mb-1">יתרון 1 - כותרת</label><input id="adm_home_feat1_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                    <div><label class="block text-sm text-white/60 mb-1">יתרון 1 - טקסט</label><input id="adm_home_feat1_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm text-white/60 mb-1">יתרון 2 - כותרת</label><input id="adm_home_feat2_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                    <div><label class="block text-sm text-white/60 mb-1">יתרון 2 - טקסט</label><input id="adm_home_feat2_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-sm text-white/60 mb-1">יתרון 3 - כותרת</label><input id="adm_home_feat3_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                    <div><label class="block text-sm text-white/60 mb-1">יתרון 3 - טקסט</label><input id="adm_home_feat3_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">סטטיסטיקות</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm text-white/60 mb-1">מספר 1</label><input id="adm_home_stat1_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">תווית 1</label><input id="adm_home_stat1_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">מספר 2</label><input id="adm_home_stat2_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">תווית 2</label><input id="adm_home_stat2_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">מספר 3</label><input id="adm_home_stat3_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">תווית 3</label><input id="adm_home_stat3_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">מספר 4</label><input id="adm_home_stat4_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">תווית 4</label><input id="adm_home_stat4_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
            </div>
        </div>

        <!-- Stories Section -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">סקשן סיפורים</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm text-white/60 mb-1">תווית</label><input id="adm_home_stories_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">כותרת</label><input id="adm_home_stories_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">CTA</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label class="block text-sm text-white/60 mb-1">כותרת</label><input id="adm_home_cta_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
                <div><label class="block text-sm text-white/60 mb-1">תת כותרת</label><input id="adm_home_cta_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/></div>
            </div>
        </div>

        <button type="submit" class="bg-primary text-bg px-8 py-3 rounded font-bold hover:opacity-90 transition text-lg">שמור הגדרות דף הבית</button>
    </form>
</div>

<!-- ==================== VIP TAB ==================== -->
<div id="tab-vip" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">הגדרות VIP</h2>
    </div>
    <form id="vipForm" onsubmit="saveVipSettings(event)" class="space-y-6">
        <!-- Hero -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">Hero</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="vip_hero_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת</label>
                    <input id="vip_hero_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <!-- Silver Package (pkg1) -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-platinum mb-4">חבילת Silver</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">שם חבילה</label>
                    <input id="adm_vip_pkg1_name" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מחיר</label>
                    <input id="adm_vip_pkg1_price" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תקופה</label>
                    <input id="adm_vip_pkg1_period" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טקסט כפתור</label>
                    <input id="adm_vip_pkg1_btn" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תכונות (שורה לכל תכונה, פורמט: אייקון|טקסט)</label>
                    <textarea id="adm_vip_pkg1_features" rows="4" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
            </div>
        </div>

        <!-- Gold Package (pkg2) -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">חבילת Gold</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">שם חבילה</label>
                    <input id="adm_vip_pkg2_name" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מחיר</label>
                    <input id="adm_vip_pkg2_price" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תקופה</label>
                    <input id="adm_vip_pkg2_period" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טקסט כפתור</label>
                    <input id="adm_vip_pkg2_btn" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">באדג׳</label>
                    <input id="adm_vip_pkg2_badge" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תכונות (שורה לכל תכונה, פורמט: אייקון|טקסט)</label>
                    <textarea id="adm_vip_pkg2_features" rows="4" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
            </div>
        </div>

        <!-- Diamond Package (pkg3) -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-diamond-blue mb-4">חבילת Diamond</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">שם חבילה</label>
                    <input id="adm_vip_pkg3_name" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מחיר</label>
                    <input id="adm_vip_pkg3_price" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תקופה</label>
                    <input id="adm_vip_pkg3_period" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טקסט כפתור</label>
                    <input id="adm_vip_pkg3_btn" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תכונות (שורה לכל תכונה, פורמט: אייקון|טקסט)</label>
                    <textarea id="adm_vip_pkg3_features" rows="4" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">למה לבחור בנו</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="adm_vip_why_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת</label>
                    <input id="adm_vip_why_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 1 - אייקון</label>
                        <input id="adm_vip_feat1_icon" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="verified_user"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 1 - כותרת</label>
                        <input id="adm_vip_feat1_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 1 - טקסט</label>
                        <input id="adm_vip_feat1_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 2 - אייקון</label>
                        <input id="adm_vip_feat2_icon" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="diamond"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 2 - כותרת</label>
                        <input id="adm_vip_feat2_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 2 - טקסט</label>
                        <input id="adm_vip_feat2_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 3 - אייקון</label>
                        <input id="adm_vip_feat3_icon" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="support_agent"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 3 - כותרת</label>
                        <input id="adm_vip_feat3_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 3 - טקסט</label>
                        <input id="adm_vip_feat3_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">CTA</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת CTA</label>
                    <input id="adm_vip_cta_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת CTA</label>
                    <input id="adm_vip_cta_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טקסט כפתור</label>
                    <input id="adm_vip_cta_btn" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-primary text-bg px-8 py-3 rounded font-bold hover:opacity-90 transition text-lg">שמור הגדרות VIP</button>
    </form>
</div>

<!-- ==================== ABOUT TAB ==================== -->
<div id="tab-about" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">הגדרות אודות</h2>
    </div>
    <form id="aboutForm" onsubmit="saveAboutSettings(event)" class="space-y-6">
        <!-- Hero -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">Hero</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="about_hero_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת</label>
                    <input id="about_hero_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תמונת Hero</label>
                    <input id="about_hero_image_file" type="file" accept="image/*" onchange="uploadAboutImage('about_hero_image', this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    <input id="about_hero_image" type="hidden"/>
                    <img id="about_hero_image_preview" src="" class="mt-2 h-20 rounded hidden"/>
                </div>
            </div>
        </div>

        <!-- Who We Are -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">מי אנחנו</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="about_who_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תמונה</label>
                    <input id="about_who_image_file" type="file" accept="image/*" onchange="uploadAboutImage('about_who_image', this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    <input id="about_who_image" type="hidden"/>
                    <img id="about_who_image_preview" src="" class="mt-2 h-20 rounded hidden"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">טקסט</label>
                    <textarea id="about_who_text" rows="4" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">סטטיסטיקות</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">מספר 1</label>
                    <input id="adm_about_stat1_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית 1</label>
                    <input id="adm_about_stat1_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מספר 2</label>
                    <input id="adm_about_stat2_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית 2</label>
                    <input id="adm_about_stat2_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מספר 3</label>
                    <input id="adm_about_stat3_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית 3</label>
                    <input id="adm_about_stat3_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מספר 4</label>
                    <input id="adm_about_stat4_num" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית 4</label>
                    <input id="adm_about_stat4_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <!-- Vision Cards -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">כרטיסי חזון</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת סקשן</label>
                    <input id="adm_about_vision_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">כרטיס 1 - כותרת</label>
                        <input id="adm_about_card1_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">כרטיס 1 - טקסט</label>
                        <input id="adm_about_card1_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">כרטיס 2 - כותרת</label>
                        <input id="adm_about_card2_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">כרטיס 2 - טקסט</label>
                        <input id="adm_about_card2_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">כרטיס 3 - כותרת</label>
                        <input id="adm_about_card3_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">כרטיס 3 - טקסט</label>
                        <input id="adm_about_card3_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose Us -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">למה לבחור בנו</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="about_why_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תמונה</label>
                    <input id="about_why_image_file" type="file" accept="image/*" onchange="uploadAboutImage('about_why_image', this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    <input id="about_why_image" type="hidden"/>
                    <img id="about_why_image_preview" src="" class="mt-2 h-20 rounded hidden"/>
                </div>
            </div>
            <div class="space-y-4 mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 1 - כותרת</label>
                        <input id="adm_about_why1_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 1 - טקסט</label>
                        <input id="adm_about_why1_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 2 - כותרת</label>
                        <input id="adm_about_why2_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 2 - טקסט</label>
                        <input id="adm_about_why2_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 3 - כותרת</label>
                        <input id="adm_about_why3_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">יתרון 3 - טקסט</label>
                        <input id="adm_about_why3_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">CTA</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת CTA</label>
                    <input id="about_cta_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת CTA</label>
                    <input id="about_cta_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-primary text-bg px-8 py-3 rounded font-bold hover:opacity-90 transition text-lg">שמור הגדרות אודות</button>
    </form>
</div>

<!-- ==================== CONTACT TAB ==================== -->
<div id="tab-contact" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">הגדרות צור קשר</h2>
    </div>
    <form id="contactForm" onsubmit="saveContactSettings(event)" class="space-y-6">
        <!-- Hero -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">Hero</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="contact_hero_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת</label>
                    <input id="contact_hero_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תמונת Hero</label>
                    <input id="adm_contact_hero_image_file" type="file" accept="image/*" onchange="uploadContactImage(this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    <input id="adm_contact_hero_image" type="hidden"/>
                    <img id="adm_contact_hero_image_preview" src="" class="mt-2 h-20 rounded hidden"/>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">פרטי התקשרות</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית אימייל</label>
                    <input id="contact_email_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">אימייל</label>
                    <input id="contact_email_value" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית טלפון</label>
                    <input id="contact_phone_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טלפון</label>
                    <input id="contact_phone_value" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית כתובת</label>
                    <input id="contact_address_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">כתובת</label>
                    <input id="contact_address_value" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תווית שעות</label>
                    <input id="contact_hours_label" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">שעות</label>
                    <input id="contact_hours_value" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <!-- WhatsApp -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">WhatsApp</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">קישור WhatsApp</label>
                    <input id="contact_whatsapp_url" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טקסט WhatsApp</label>
                    <input id="contact_whatsapp_text" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <!-- Form Settings -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">הגדרות טופס</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת טופס</label>
                    <input id="contact_form_title" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת טופס</label>
                    <input id="contact_form_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טקסט כפתור שליחה</label>
                    <input id="adm_contact_submit_btn" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">הצהרה</label>
                    <input id="adm_contact_disclaimer" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-primary text-bg px-8 py-3 rounded font-bold hover:opacity-90 transition text-lg">שמור הגדרות צור קשר</button>
    </form>
</div>

<!-- ==================== REVIEWS TAB ==================== -->
<div id="tab-reviews" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">ניהול ביקורות</h2>
        <button onclick="openReviewForm()" class="bg-primary text-bg px-4 py-2 rounded font-semibold hover:opacity-90 transition flex items-center gap-2">
            <span class="material-symbols-outlined">add</span>
            הוסף ביקורת
        </button>
    </div>
    <div id="reviewsList" class="grid gap-4"></div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closeReviewForm()"></div>
    <div class="relative z-10 max-w-xl mx-auto mt-20 bg-card rounded-lg border border-white/10 max-h-[80vh] overflow-y-auto">
        <div class="sticky top-0 bg-card border-b border-white/10 px-6 py-4 flex items-center justify-between">
            <h3 id="reviewModalTitle" class="text-lg font-bold text-primary">הוסף ביקורת</h3>
            <button onclick="closeReviewForm()" class="text-white/60 hover:text-white"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form id="reviewForm" onsubmit="saveReview(event)" class="p-6 space-y-4">
            <input type="hidden" id="review_id"/>
            <input type="hidden" id="review_photo"/>
            <div class="flex items-center gap-4">
                <img id="review_photo_preview" src="" class="w-20 h-20 rounded-full object-cover bg-bg border-2 border-primary/30" style="display:none;"/>
                <div class="flex-1">
                    <label class="block text-sm text-white/60 mb-1">תמונת לקוח</label>
                    <input id="review_photo_file" type="file" accept="image/*" onchange="uploadReviewPhoto(this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-xs"/>
                    <p class="text-xs text-white/40 mt-1">או הזן URL:</p>
                    <input id="review_photo_url" type="url" placeholder="https://..." class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-xs mt-1" onchange="document.getElementById('review_photo').value=this.value; document.getElementById('review_photo_preview').src=this.value; document.getElementById('review_photo_preview').style.display=this.value?'block':'none';"/>
                </div>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">שם לקוח</label>
                <input id="review_name" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="יוסי כ."/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">דירוג (1-5)</label>
                <select id="review_rating" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm">
                    <option value="5">★★★★★ (5)</option>
                    <option value="4">★★★★☆ (4)</option>
                    <option value="3">★★★☆☆ (3)</option>
                    <option value="2">★★☆☆☆ (2)</option>
                    <option value="1">★☆☆☆☆ (1)</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">טקסט הביקורת</label>
                <textarea id="review_text" rows="4" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="כתוב את הביקורת כאן..."></textarea>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                <button type="button" onclick="closeReviewForm()" class="px-4 py-2 rounded border border-white/10 text-white/60 hover:text-white transition">ביטול</button>
                <button type="submit" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== SITE SETTINGS TAB ==================== -->
<div id="tab-site" class="tab-content hidden">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">הגדרות אתר</h2>
    </div>
    <form id="siteForm" onsubmit="saveSiteSettings(event)" class="space-y-6">
        <!-- Header -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">Header</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">שם אתר</label>
                    <input id="site_name" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תת כותרת</label>
                    <input id="site_subtitle" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">קישורי תפריט (שורה לכל קישור, פורמט: טקסט|url)</label>
                    <textarea id="site_menu_links" rows="4" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">Footer</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">תיאור</label>
                    <textarea id="site_footer_description" rows="3" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm text-white/60 mb-1">קישורים (שורה לכל קישור, פורמט: טקסט|url)</label>
                    <textarea id="site_footer_links" rows="4" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טלפון</label>
                    <input id="site_footer_phone" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">אימייל</label>
                    <input id="site_footer_email" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">כתובת</label>
                    <input id="site_footer_address" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">זכויות יוצרים</label>
                    <input id="site_footer_copyright" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">רשתות חברתיות</h3>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">אייקון 1</label>
                        <input id="site_social1_icon" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="facebook"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">URL 1</label>
                        <input id="site_social1_url" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">אייקון 2</label>
                        <input id="site_social2_icon" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="instagram"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">URL 2</label>
                        <input id="site_social2_url" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-white/60 mb-1">אייקון 3</label>
                        <input id="site_social3_icon" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="twitter"/>
                    </div>
                    <div>
                        <label class="block text-sm text-white/60 mb-1">URL 3</label>
                        <input id="site_social3_url" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                    </div>
                </div>
            </div>
        </div>

        <!-- SMTP -->
        <div class="bg-card rounded-lg p-6 border border-white/10">
            <h3 class="text-lg font-bold text-primary mb-4">הגדרות SMTP</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">Host</label>
                    <input id="site_smtp_host" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">Port</label>
                    <input id="site_smtp_port" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">User</label>
                    <input id="site_smtp_user" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">Password</label>
                    <input id="site_smtp_password" type="password" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">From Name</label>
                    <input id="site_smtp_from_name" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-primary text-bg px-8 py-3 rounded font-bold hover:opacity-90 transition text-lg">שמור הגדרות אתר</button>
    </form>
</div>

</main>

<!-- ==================== PROFILE MODAL ==================== -->
<div id="profileModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closeProfileForm()"></div>
    <div class="relative z-10 max-w-3xl mx-auto mt-10 mb-10 bg-card rounded-lg border border-white/10 max-h-[85vh] overflow-y-auto">
        <div class="sticky top-0 bg-card border-b border-white/10 px-6 py-4 flex items-center justify-between">
            <h3 id="profileModalTitle" class="text-lg font-bold text-primary">הוסף פרופיל</h3>
            <button onclick="closeProfileForm()" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="profileForm" onsubmit="saveProfile(event)" class="p-6 space-y-4">
            <input type="hidden" id="profile_id"/>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">שם פרטי</label>
                    <input id="profile_name" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">גיל</label>
                    <input id="profile_age" type="number" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">עיר</label>
                    <input id="profile_city" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מדינה</label>
                    <select id="profile_country" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm">
                        <option value="moldova">מולדובה</option>
                        <option value="ukraine">אוקראינה</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">עיסוק</label>
                    <input id="profile_occupation" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">השכלה</label>
                    <input id="profile_education" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">שפות</label>
                    <input id="profile_languages" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תחביבים</label>
                    <input id="profile_hobbies" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מצב משפחתי</label>
                    <select id="profile_marital_status" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm">
                        <option value="single">רווקה</option>
                        <option value="divorced">גרושה</option>
                        <option value="widowed">אלמנה</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">גובה</label>
                    <input id="profile_height" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="165cm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">משקל</label>
                    <input id="profile_weight" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="55kg"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">ילדים</label>
                    <input id="profile_children" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="אין / 1 / 2"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">מזל</label>
                    <input id="profile_zodiac" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="מזל טלה, שור, תאומים..."/>
                </div>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">ביוגרפיה</label>
                <textarea id="profile_bio" rows="3" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">ציטוט</label>
                <input id="profile_quote" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תמונה ראשית</label>
                <input id="profile_main_photo_file" type="file" accept="image/*" onchange="uploadMainImage(this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                <input id="profile_main_photo" type="hidden"/>
                <img id="profile_main_photo_preview" src="" class="mt-2 h-20 rounded hidden"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תמונות גלריה</label>
                <input id="profile_gallery_files" type="file" accept="image/*" multiple onchange="uploadGalleryPhotos(this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                <div id="galleryPreview" class="flex flex-wrap gap-2 mt-2"></div>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">סרטונים</label>
                <input id="profile_video_files" type="file" accept="video/mp4,video/webm,video/quicktime,.mp4,.webm,.mov" multiple onchange="uploadProfileVideos(this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                <span id="profile_video_progress" class="text-sm text-primary hidden">מעלה...</span>
                <div id="videoPreview" class="flex flex-wrap gap-2 mt-2"></div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                <button type="button" onclick="closeProfileForm()" class="px-4 py-2 rounded border border-white/10 text-white/60 hover:text-white transition">ביטול</button>
                <button type="submit" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== PAGE MODAL ==================== -->
<div id="pageModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closePageForm()"></div>
    <div class="relative z-10 max-w-3xl mx-auto mt-10 mb-10 bg-card rounded-lg border border-white/10 max-h-[85vh] overflow-y-auto">
        <div class="sticky top-0 bg-card border-b border-white/10 px-6 py-4 flex items-center justify-between">
            <h3 id="pageModalTitle" class="text-lg font-bold text-primary">דף חדש</h3>
            <button onclick="closePageForm()" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="pageForm" onsubmit="savePage(event)" class="p-6 space-y-4">
            <input type="hidden" id="page_id"/>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="page_title" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">Slug</label>
                    <input id="page_slug" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input id="page_is_active" type="checkbox" checked class="w-4 h-4 accent-primary"/>
                        <span class="text-sm text-white/80">פעיל</span>
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תוכן (HTML)</label>
                <textarea id="page_content" rows="10" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm font-mono"></textarea>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                <button type="button" onclick="closePageForm()" class="px-4 py-2 rounded border border-white/10 text-white/60 hover:text-white transition">ביטול</button>
                <button type="submit" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== STEP MODAL ==================== -->
<div id="stepModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closeStepForm()"></div>
    <div class="relative z-10 max-w-2xl mx-auto mt-10 mb-10 bg-card rounded-lg border border-white/10 max-h-[85vh] overflow-y-auto">
        <div class="sticky top-0 bg-card border-b border-white/10 px-6 py-4 flex items-center justify-between">
            <h3 id="stepModalTitle" class="text-lg font-bold text-primary">הוסף שלב</h3>
            <button onclick="closeStepForm()" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="stepForm" onsubmit="saveStep(event)" class="p-6 space-y-4">
            <input type="hidden" id="step_id"/>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">מספר שלב</label>
                    <input id="step_step_number" type="number" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">כותרת</label>
                    <input id="step_title" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">אייקון</label>
                    <input id="step_icon" type="text" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" placeholder="material icon name"/>
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input id="step_is_active" type="checkbox" checked class="w-4 h-4 accent-primary"/>
                        <span class="text-sm text-white/80">פעיל</span>
                    </label>
                </div>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תיאור</label>
                <textarea id="step_description" rows="3" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תמונה</label>
                <input id="step_image_file" type="file" accept="image/*" onchange="uploadStepImage(this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                <input id="step_image" type="hidden"/>
                <img id="step_image_preview" src="" class="mt-2 h-20 rounded hidden"/>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                <button type="button" onclick="closeStepForm()" class="px-4 py-2 rounded border border-white/10 text-white/60 hover:text-white transition">ביטול</button>
                <button type="submit" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== FAQ MODAL ==================== -->
<div id="faqModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closeFaqForm()"></div>
    <div class="relative z-10 max-w-2xl mx-auto mt-10 mb-10 bg-card rounded-lg border border-white/10 max-h-[85vh] overflow-y-auto">
        <div class="sticky top-0 bg-card border-b border-white/10 px-6 py-4 flex items-center justify-between">
            <h3 id="faqModalTitle" class="text-lg font-bold text-primary">הוסף שאלה</h3>
            <button onclick="closeFaqForm()" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="faqForm" onsubmit="saveFaq(event)" class="p-6 space-y-4">
            <input type="hidden" id="faq_id"/>
            <div>
                <label class="block text-sm text-white/60 mb-1">שאלה</label>
                <input id="faq_question" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תשובה</label>
                <textarea id="faq_answer" rows="4" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">סדר מיון</label>
                    <input id="faq_sort_order" type="number" value="0" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input id="faq_is_active" type="checkbox" checked class="w-4 h-4 accent-primary"/>
                        <span class="text-sm text-white/80">פעיל</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                <button type="button" onclick="closeFaqForm()" class="px-4 py-2 rounded border border-white/10 text-white/60 hover:text-white transition">ביטול</button>
                <button type="submit" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== USER MODAL ==================== -->
<div id="userModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closeUserForm()"></div>
    <div class="relative z-10 max-w-2xl mx-auto mt-10 mb-10 bg-card rounded-lg border border-white/10 max-h-[85vh] overflow-y-auto">
        <div class="sticky top-0 bg-card border-b border-white/10 px-6 py-4 flex items-center justify-between">
            <h3 id="userModalTitle" class="text-lg font-bold text-primary">עריכת משתמש</h3>
            <button onclick="closeUserForm()" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="userForm" onsubmit="saveUser(event)" class="p-6 space-y-4">
            <input type="hidden" id="user_id"/>
            <input type="hidden" id="user_email"/>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">שם מלא</label>
                    <input id="user_name" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">טלפון (WhatsApp)</label>
                    <input id="user_phone" type="tel" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm" dir="ltr"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">רמת VIP</label>
                    <select id="user_vip_level" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm">
                        <option value="none">ללא</option>
                        <option value="silver">Silver</option>
                        <option value="gold">Gold</option>
                        <option value="diamond">Diamond</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                <button type="button" onclick="closeUserForm()" class="px-4 py-2 rounded border border-white/10 text-white/60 hover:text-white transition">ביטול</button>
                <button type="submit" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== STORY MODAL ==================== -->
<div id="storyModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/70" onclick="closeStoryForm()"></div>
    <div class="relative z-10 max-w-2xl mx-auto mt-10 mb-10 bg-card rounded-lg border border-white/10 max-h-[85vh] overflow-y-auto">
        <div class="sticky top-0 bg-card border-b border-white/10 px-6 py-4 flex items-center justify-between">
            <h3 id="storyModalTitle" class="text-lg font-bold text-primary">הוסף סיפור</h3>
            <button onclick="closeStoryForm()" class="text-white/60 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form id="storyForm" onsubmit="saveStory(event)" class="p-6 space-y-4">
            <input type="hidden" id="story_id"/>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-white/60 mb-1">שם הזוג</label>
                    <input id="story_couple_names" type="text" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
                <div>
                    <label class="block text-sm text-white/60 mb-1">תאריך חתונה</label>
                    <input id="story_wedding_date" type="date" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                </div>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">סיפור</label>
                <textarea id="story_story" rows="5" required class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"></textarea>
            </div>
            <div>
                <label class="block text-sm text-white/60 mb-1">תמונה</label>
                <input id="story_image_file" type="file" accept="image/*" onchange="uploadStoryImage(this)" class="w-full bg-bg border border-white/10 rounded px-3 py-2 text-white text-sm"/>
                <input id="story_image" type="hidden"/>
                <img id="story_image_preview" src="" class="mt-2 h-20 rounded hidden"/>
            </div>
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input id="story_is_active" type="checkbox" checked class="w-4 h-4 accent-primary"/>
                    <span class="text-sm text-white/80">מפורסם</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-white/10">
                <button type="button" onclick="closeStoryForm()" class="px-4 py-2 rounded border border-white/10 text-white/60 hover:text-white transition">ביטול</button>
                <button type="submit" class="bg-primary text-bg px-6 py-2 rounded font-semibold hover:opacity-90 transition">שמור</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== JAVASCRIPT ==================== -->
<script>
let galleryPhotos = [];
let profileVideos = [];

// ============ TAB SWITCHING ============
function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('tab-active'));
    document.getElementById('tab-' + tab).classList.remove('hidden');
    document.getElementById('btn-' + tab).classList.add('tab-active');

    switch(tab) {
        case 'profiles': loadProfiles(); break;
        case 'users': loadUsers(); break;
        case 'messages': loadMessages(); break;
        case 'leads': loadLeads(); break;
        case 'pages': loadPages(); break;
        case 'stories': loadStories(); loadStoriesPageSettings(); break;
        case 'faqs': loadFaqs(); break;
        case 'process': loadProcessSteps(); break;
        case 'home': loadHomeSettings(); break;
        case 'vip': loadVipSettings(); break;
        case 'about': loadAboutSettings(); break;
        case 'contact': loadContactSettings(); break;
        case 'reviews': loadReviews(); break;
        case 'site': loadSiteSettings(); break;
    }
}

// ============ PROFILES ============
async function loadProfiles() {
    try {
        const res = await fetch(API + '/api/admin/profiles?page=1&per_page=100');
        const data = await res.json();
        const profiles = data.data || data.profiles || data || [];
        const list = document.getElementById('profilesList');
        if (!Array.isArray(profiles) || profiles.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין פרופילים</div>';
            return;
        }
        list.innerHTML = profiles.map(p => `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div class="flex items-center gap-4">
                    <img src="${p.primary_photo || ''}" class="w-12 h-12 rounded-full object-cover bg-white/10" onerror="this.src=''"/>
                    <div>
                        <div class="font-semibold">${p.name || ''}</div>
                        <div class="text-sm text-white/60">${p.age || ''} | ${p.city || ''}, ${p.country || ''}</div>
                    </div>
                    <div class="flex gap-2">
                        ${p.is_active ? '<span class="bg-green-500/20 text-green-400 text-xs px-2 py-0.5 rounded">פעיל</span>' : '<span class="bg-red-500/20 text-red-400 text-xs px-2 py-0.5 rounded">לא פעיל</span>'}
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="editProfile(${p.id})" class="text-white/60 hover:text-primary transition p-1">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </button>
                    <button onclick="deleteProfile(${p.id})" class="text-white/60 hover:text-red-500 transition p-1">
                        <span class="material-symbols-outlined text-xl">delete</span>
                    </button>
                </div>
            </div>
        `).join('');
    } catch(e) {
        console.error('Error loading profiles:', e);
    }
}

function openProfileForm(profile = null) {
    document.getElementById('profileModal').classList.remove('hidden');
    document.getElementById('profileForm').reset();
    document.getElementById('profile_id').value = '';
    document.getElementById('profile_main_photo').value = '';
    document.getElementById('profile_main_photo_preview').classList.add('hidden');
    galleryPhotos = [];
    profileVideos = [];
    renderGallery();
    renderVideoPreview();
    document.getElementById('profileModalTitle').textContent = 'הוסף פרופיל';

    if (profile) {
        document.getElementById('profileModalTitle').textContent = 'עריכת פרופיל';
        document.getElementById('profile_id').value = profile.id;
        document.getElementById('profile_name').value = profile.name || '';
        document.getElementById('profile_age').value = profile.age || '';
        document.getElementById('profile_city').value = profile.city || '';
        document.getElementById('profile_country').value = profile.country || 'moldova';
        document.getElementById('profile_occupation').value = profile.occupation || '';
        document.getElementById('profile_education').value = profile.education || '';
        document.getElementById('profile_languages').value = profile.languages || '';
        document.getElementById('profile_hobbies').value = profile.hobbies || '';
        document.getElementById('profile_height').value = profile.height || '';
        document.getElementById('profile_weight').value = profile.weight || '';
        document.getElementById('profile_children').value = profile.children || '';
        document.getElementById('profile_zodiac').value = profile.zodiac || '';
        document.getElementById('profile_bio').value = profile.about || '';
        document.getElementById('profile_quote').value = profile.looking_for || '';
        document.getElementById('profile_marital_status').value = profile.marital_status || 'single';
        // Extract primary photo from photos array
        const primaryPhoto = profile.photos && profile.photos.find(ph => ph.is_primary == 1 || ph.is_primary === true);
        const mainPhotoUrl = primaryPhoto ? primaryPhoto.photo_url : (profile.primary_photo || '');
        if (mainPhotoUrl) {
            document.getElementById('profile_main_photo').value = mainPhotoUrl;
            document.getElementById('profile_main_photo_preview').src = mainPhotoUrl;
            document.getElementById('profile_main_photo_preview').classList.remove('hidden');
        }
        if (profile.photos && profile.photos.length) {
            galleryPhotos = profile.photos.filter(ph => !(ph.is_primary == 1 || ph.is_primary === true)).map(ph => ph.photo_url);
            renderGallery();
        }
        if (profile.videos && profile.videos.length) {
            profileVideos = profile.videos.map(v => ({ id: v.id, url: v.video_url, title: v.title || '' }));
            renderVideoPreview();
        }
    }
}

function closeProfileForm() {
    document.getElementById('profileModal').classList.add('hidden');
}

async function editProfile(id) {
    try {
        const res = await fetch(API + '/api/admin/profiles/' + id);
        const profile = await res.json();
        openProfileForm(profile.data || profile);
    } catch(e) {
        console.error('Error loading profile:', e);
    }
}

async function deleteProfile(id) {
    if (!confirm('האם למחוק את הפרופיל?')) return;
    try {
        await fetch(API + '/api/admin/profiles/' + id, { method: 'DELETE' });
        loadProfiles();
    } catch(e) {
        console.error('Error deleting profile:', e);
    }
}

async function saveProfile(e) {
    e.preventDefault();
    const id = document.getElementById('profile_id').value;
    const body = {
        name: document.getElementById('profile_name').value,
        age: parseInt(document.getElementById('profile_age').value),
        city: document.getElementById('profile_city').value,
        country: document.getElementById('profile_country').value,
        occupation: document.getElementById('profile_occupation').value,
        education: document.getElementById('profile_education').value,
        languages: document.getElementById('profile_languages').value,
        hobbies: document.getElementById('profile_hobbies').value,
        height: document.getElementById('profile_height').value,
        weight: document.getElementById('profile_weight').value,
        children: document.getElementById('profile_children').value,
        zodiac: document.getElementById('profile_zodiac').value,
        about: document.getElementById('profile_bio').value,
        looking_for: document.getElementById('profile_quote').value,
        marital_status: document.getElementById('profile_marital_status').value,
        is_active: true,
    };
    try {
        const url = id ? API + '/api/admin/profiles/' + id : API + '/api/admin/profiles';
        const method = id ? 'PUT' : 'POST';
        const res = await fetch(url, { method, headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        const result = await res.json();
        if (!res.ok) { alert('שגיאה בשמירת פרופיל: ' + (result.error || JSON.stringify(result))); return; }
        const profileId = id || (result.profile && result.profile.id);

        if (profileId) {
            // Delete existing photos if editing
            if (id) {
                const delRes = await fetch(API + '/api/admin/photos?profile_id=' + profileId, { method: 'DELETE' });
                console.log('Delete photos:', await delRes.json());
            }
            // Add main photo
            const mainPhotoUrl = document.getElementById('profile_main_photo').value;
            if (mainPhotoUrl) {
                const mainRes = await fetch(API + '/api/admin/photos', {
                    method: 'POST',
                    headers: {'Content-Type':'application/json'},
                    body: JSON.stringify({ profile_id: parseInt(profileId), photo_url: mainPhotoUrl, is_primary: true })
                });
                const mainResult = await mainRes.json();
                console.log('Main photo save:', mainResult);
                if (!mainRes.ok) alert('שגיאה בשמירת תמונה ראשית: ' + (mainResult.error || ''));
            }
            // Add gallery photos
            console.log('Gallery photos to save:', galleryPhotos);
            for (const photoUrl of galleryPhotos) {
                if (photoUrl && photoUrl !== mainPhotoUrl) {
                    const galRes = await fetch(API + '/api/admin/photos', {
                        method: 'POST',
                        headers: {'Content-Type':'application/json'},
                        body: JSON.stringify({ profile_id: parseInt(profileId), photo_url: photoUrl, is_primary: false })
                    });
                    const galResult = await galRes.json();
                    console.log('Gallery photo save:', galResult);
                    if (!galRes.ok) alert('שגיאה בשמירת תמונת גלריה: ' + (galResult.error || ''));
                }
            }

            // Delete existing videos if editing, then re-add
            if (id) {
                try {
                    const existingRes = await fetch(API + '/api/profiles/' + profileId);
                    const existingProfile = await existingRes.json();
                    if (existingProfile.videos) {
                        for (const v of existingProfile.videos) {
                            await fetch(API + '/api/admin/videos/' + v.id, { method: 'DELETE' });
                        }
                    }
                } catch(ve) { console.error('Video delete error:', ve); }
            }
            // Add videos
            console.log('Videos to save:', profileVideos);
            for (const v of profileVideos) {
                const vidRes = await fetch(API + '/api/admin/videos', {
                    method: 'POST',
                    headers: {'Content-Type':'application/json'},
                    body: JSON.stringify({ profile_id: parseInt(profileId), video_url: v.url, title: v.title || '' })
                });
                const vidResult = await vidRes.json();
                console.log('Video save:', vidResult);
            }
        }

        alert('הפרופיל נשמר בהצלחה!');
        closeProfileForm();
        loadProfiles();
    } catch(e) {
        console.error('Error saving profile:', e);
        alert('שגיאה בשמירת הפרופיל: ' + e.message);
    }
}

// ============ GALLERY MANAGEMENT ============
function renderGallery() {
    const container = document.getElementById('galleryPreview');
    container.innerHTML = galleryPhotos.map((photo, i) => `
        <div class="relative">
            <img src="${photo}" class="w-16 h-16 object-cover rounded"/>
            <button type="button" onclick="removeGalleryPhoto(${i})" class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">&times;</button>
        </div>
    `).join('');
}

function removeGalleryPhoto(index) {
    galleryPhotos.splice(index, 1);
    renderGallery();
}

async function uploadGalleryPhotos(input) {
    const files = input.files;
    for (let i = 0; i < files.length; i++) {
        const formData = new FormData();
        formData.append('file', files[i]);
        try {
            const res = await fetch(API + '/api/upload', { method: 'POST', body: formData });
            const data = await res.json();
            if (data.url || data.path) {
                galleryPhotos.push(data.url || data.path);
            }
        } catch(e) {
            console.error('Error uploading gallery photo:', e);
        }
    }
    renderGallery();
    input.value = '';
}

// ============ IMAGE UPLOADS ============
async function uploadMainImage(input) {
    const formData = new FormData();
    formData.append('file', input.files[0]);
    try {
        const res = await fetch(API + '/api/upload', { method: 'POST', body: formData });
        const data = await res.json();
        const url = data.url || data.path;
        if (url) {
            document.getElementById('profile_main_photo').value = url;
            document.getElementById('profile_main_photo_preview').src = url;
            document.getElementById('profile_main_photo_preview').classList.remove('hidden');
        }
    } catch(e) {
        console.error('Error uploading image:', e);
    }
}

// ============ VIDEO MANAGEMENT ============
function renderVideoPreview() {
    const container = document.getElementById('videoPreview');
    container.innerHTML = profileVideos.map((v, i) => `
        <div class="relative bg-black rounded overflow-hidden" style="width:120px;height:80px;">
            <video src="${v.url}" class="w-full h-full object-cover" preload="metadata"></video>
            <button type="button" onclick="removeProfileVideo(${i})" class="absolute -top-1 -right-1 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">&times;</button>
            <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-[9px] text-center truncate px-1">${v.title || 'סרטון'}</div>
        </div>
    `).join('');
}

function removeProfileVideo(index) {
    profileVideos.splice(index, 1);
    renderVideoPreview();
}

async function uploadProfileVideos(input) {
    const prog = document.getElementById('profile_video_progress');
    prog.classList.remove('hidden');
    const files = input.files;
    for (let i = 0; i < files.length; i++) {
        prog.textContent = `מעלה סרטון ${i + 1} מתוך ${files.length}...`;
        const formData = new FormData();
        formData.append('file', files[i]);
        try {
            const res = await fetch(API + '/api/upload', { method: 'POST', body: formData });
            const data = await res.json();
            if (data.url || data.path) {
                profileVideos.push({ url: data.url || data.path, title: files[i].name.replace(/\.[^.]+$/, '') });
            }
        } catch(e) {
            console.error('Error uploading video:', e);
        }
    }
    renderVideoPreview();
    prog.textContent = 'הועלו בהצלחה!';
    setTimeout(() => prog.classList.add('hidden'), 2000);
    input.value = '';
}

async function uploadAboutImage(fieldId, input) {
    const formData = new FormData();
    formData.append('file', input.files[0]);
    try {
        const res = await fetch(API + '/api/upload', { method: 'POST', body: formData });
        const data = await res.json();
        const url = data.url || data.path;
        if (url) {
            document.getElementById(fieldId).value = url;
            const preview = document.getElementById(fieldId + '_preview');
            if (preview) {
                preview.src = url;
                preview.classList.remove('hidden');
            }
        }
    } catch(e) {
        console.error('Error uploading image:', e);
    }
}

async function uploadStepImage(input) {
    const formData = new FormData();
    formData.append('file', input.files[0]);
    try {
        const res = await fetch(API + '/api/upload', { method: 'POST', body: formData });
        const data = await res.json();
        const url = data.url || data.path;
        if (url) {
            document.getElementById('step_image').value = url;
            document.getElementById('step_image_preview').src = url;
            document.getElementById('step_image_preview').classList.remove('hidden');
        }
    } catch(e) {
        console.error('Error uploading image:', e);
    }
}

async function uploadStoryImage(input) {
    const formData = new FormData();
    formData.append('file', input.files[0]);
    try {
        const res = await fetch(API + '/api/upload', { method: 'POST', body: formData });
        const data = await res.json();
        const url = data.url || data.path;
        if (url) {
            document.getElementById('story_image').value = url;
            document.getElementById('story_image_preview').src = url;
            document.getElementById('story_image_preview').classList.remove('hidden');
        }
    } catch(e) {
        console.error('Error uploading image:', e);
    }
}

// ============ USERS ============
async function loadUsers() {
    try {
        const res = await fetch(API + '/api/admin/users');
        const data = await res.json();
        const users = data.data || data.users || data || [];
        const list = document.getElementById('usersList');
        if (!Array.isArray(users) || users.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין משתמשים</div>';
            return;
        }
        list.innerHTML = users.map(u => `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div class="flex items-center gap-4">
                    <div>
                        <div class="font-semibold">${u.name || ''}</div>
                        <div class="text-sm text-white/60">${u.email || ''} | ${u.phone || ''}</div>
                    </div>
                    <div class="flex gap-2">
                        ${u.vip_level && u.vip_level !== 'none' ? '<span class="bg-primary/20 text-primary text-xs px-2 py-0.5 rounded">VIP ' + u.vip_level + '</span>' : ''}
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="editUser(${u.id})" class="text-white/60 hover:text-primary transition p-1" title="ערוך">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </button>
                    <button onclick="viewUserMessages(${u.id})" class="text-white/60 hover:text-blue-400 transition p-1" title="הודעות">
                        <span class="material-symbols-outlined text-xl">chat</span>
                    </button>
                    <button onclick="deleteUser(${u.id})" class="text-white/60 hover:text-red-500 transition p-1" title="מחק">
                        <span class="material-symbols-outlined text-xl">delete</span>
                    </button>
                </div>
            </div>
        `).join('');
    } catch(e) {
        console.error('Error loading users:', e);
    }
}

async function editUser(id) {
    try {
        const res = await fetch(API + '/api/admin/users/' + id);
        const user = await res.json();
        const u = user.data || user;
        document.getElementById('userModal').classList.remove('hidden');
        document.getElementById('userForm').reset();
        document.getElementById('user_id').value = u.id;
        document.getElementById('user_name').value = u.name || '';
        document.getElementById('user_email').value = u.email || '';
        document.getElementById('user_phone').value = u.phone || '';
        document.getElementById('user_vip_level').value = u.vip_level || 'none';
    } catch(e) {
        console.error('Error loading user:', e);
    }
}

function closeUserForm() {
    document.getElementById('userModal').classList.add('hidden');
}

async function saveUser(e) {
    e.preventDefault();
    const id = document.getElementById('user_id').value;
    const phone = document.getElementById('user_phone').value;
    const body = {
        name: document.getElementById('user_name').value,
        email: document.getElementById('user_email').value || (phone.replace(/[^\d]/g, '') + '@whatsapp.local'),
        phone: phone,
        vip_level: document.getElementById('user_vip_level').value,
    };
    try {
        await fetch(API + '/api/admin/users/' + id, { method: 'PUT', headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        closeUserForm();
        loadUsers();
    } catch(e) {
        console.error('Error saving user:', e);
    }
}

async function deleteUser(id) {
    if (!confirm('האם למחוק את המשתמש?')) return;
    try {
        await fetch(API + '/api/admin/users/' + id, { method: 'DELETE' });
        loadUsers();
    } catch(e) {
        console.error('Error deleting user:', e);
    }
}

async function viewUserMessages(userId) {
    switchTab('messages');
}

// ============ MESSAGES ============
async function loadMessages() {
    try {
        const res = await fetch(API + '/api/admin/messages');
        const data = await res.json();
        const messages = data.data || data.messages || data || [];
        const list = document.getElementById('messagesList');
        if (!Array.isArray(messages) || messages.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין הודעות</div>';
            return;
        }
        list.innerHTML = messages.map(m => `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div>
                    <div class="font-semibold text-sm">${m.sender_name || ''} (${m.sender_email || ''}) ${m.profile_id ? '&rarr; פרופיל #' + m.profile_id : ''}</div>
                    <div class="text-white/60 text-sm mt-1">${m.message || ''}</div>
                    <div class="text-white/40 text-xs mt-1">${m.created_at || ''} ${m.is_read ? '' : '<span class="text-primary font-bold">חדש</span>'}</div>
                </div>
                <button onclick="deleteMessage(${m.id})" class="text-white/60 hover:text-red-500 transition p-1">
                    <span class="material-symbols-outlined text-xl">delete</span>
                </button>
            </div>
        `).join('');
    } catch(e) {
        console.error('Error loading messages:', e);
    }
}

async function deleteMessage(id) {
    if (!confirm('האם למחוק את ההודעה?')) return;
    try {
        await fetch(API + '/api/admin/messages/' + id, { method: 'DELETE' });
        loadMessages();
    } catch(e) {
        console.error('Error deleting message:', e);
    }
}

// ============ LEADS ============
async function loadLeads() {
    try {
        const res = await fetch(API + '/api/admin/leads');
        const data = await res.json();
        const leads = data.data || data.leads || data || [];
        const list = document.getElementById('leadsList');
        if (!Array.isArray(leads) || leads.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין לידים</div>';
            return;
        }
        list.innerHTML = leads.map(l => `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div>
                    <div class="font-semibold">${l.name || ''}</div>
                    <div class="text-sm text-white/60">${l.email || ''} | ${l.phone || ''}</div>
                    <div class="text-sm text-white/40 mt-1">${l.message || ''}</div>
                    <div class="flex gap-2 mt-1">
                        <span class="text-xs text-white/40">${l.source || ''}</span>
                        ${l.package_type ? '<span class="bg-primary/20 text-primary text-xs px-2 py-0.5 rounded">' + l.package_type + '</span>' : ''}
                        <span class="text-xs ${l.status === 'new' ? 'text-green-400' : 'text-white/40'}">${l.status || ''}</span>
                    </div>
                    <div class="text-white/40 text-xs mt-1">${l.created_at || ''}</div>
                </div>
                <button onclick="deleteLead(${l.id})" class="text-white/60 hover:text-red-500 transition p-1">
                    <span class="material-symbols-outlined text-xl">delete</span>
                </button>
            </div>
        `).join('');
    } catch(e) {
        console.error('Error loading leads:', e);
    }
}

async function deleteLead(id) {
    if (!confirm('האם למחוק את הליד?')) return;
    try {
        await fetch(API + '/api/admin/leads/' + id, { method: 'DELETE' });
        loadLeads();
    } catch(e) {
        console.error('Error deleting lead:', e);
    }
}

// ============ PAGES ============
async function loadPages() {
    try {
        const res = await fetch(API + '/api/admin/pages');
        const data = await res.json();
        const pages = data.data || data.pages || data || [];
        const list = document.getElementById('pagesList');
        if (!Array.isArray(pages) || pages.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין דפים</div>';
            return;
        }
        list.innerHTML = pages.map(p => `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div>
                    <div class="font-semibold">${p.title || ''}</div>
                    <div class="text-sm text-white/60">/${p.slug || ''}</div>
                    <div class="flex gap-2 mt-1">
                        ${p.is_active ? '<span class="bg-green-500/20 text-green-400 text-xs px-2 py-0.5 rounded">פעיל</span>' : '<span class="bg-red-500/20 text-red-400 text-xs px-2 py-0.5 rounded">לא פעיל</span>'}
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="${BASE_URL}/page/${p.slug || ''}" target="_blank" class="text-white/60 hover:text-blue-400 transition p-1" title="צפה">
                        <span class="material-symbols-outlined text-xl">visibility</span>
                    </a>
                    <button onclick="editPage(${p.id})" class="text-white/60 hover:text-primary transition p-1" title="ערוך">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </button>
                    <button onclick="deletePage(${p.id})" class="text-white/60 hover:text-red-500 transition p-1" title="מחק">
                        <span class="material-symbols-outlined text-xl">delete</span>
                    </button>
                </div>
            </div>
        `).join('');
    } catch(e) {
        console.error('Error loading pages:', e);
    }
}

function openPageForm(page = null) {
    document.getElementById('pageModal').classList.remove('hidden');
    document.getElementById('pageForm').reset();
    document.getElementById('page_id').value = '';
    document.getElementById('pageModalTitle').textContent = 'דף חדש';
    document.getElementById('page_is_active').checked = true;

    if (page) {
        document.getElementById('pageModalTitle').textContent = 'עריכת דף';
        document.getElementById('page_id').value = page.id;
        document.getElementById('page_title').value = page.title || '';
        document.getElementById('page_slug').value = page.slug || '';
        document.getElementById('page_is_active').checked = page.is_active !== 0;
        document.getElementById('page_content').value = page.content || '';
    }
}

function closePageForm() {
    document.getElementById('pageModal').classList.add('hidden');
}

async function editPage(id) {
    try {
        const res = await fetch(API + '/api/admin/pages/' + id);
        const page = await res.json();
        openPageForm(page.data || page);
    } catch(e) {
        console.error('Error loading page:', e);
    }
}

async function deletePage(id) {
    if (!confirm('האם למחוק את הדף?')) return;
    try {
        await fetch(API + '/api/admin/pages/' + id, { method: 'DELETE' });
        loadPages();
    } catch(e) {
        console.error('Error deleting page:', e);
    }
}

async function savePage(e) {
    e.preventDefault();
    const id = document.getElementById('page_id').value;
    const body = {
        title: document.getElementById('page_title').value,
        slug: document.getElementById('page_slug').value,
        is_active: document.getElementById('page_is_active').checked ? 1 : 0,
        content: document.getElementById('page_content').value,
    };
    try {
        const url = id ? API + '/api/admin/pages/' + id : API + '/api/admin/pages';
        const method = id ? 'PUT' : 'POST';
        await fetch(url, { method, headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        closePageForm();
        loadPages();
    } catch(e) {
        console.error('Error saving page:', e);
    }
}

// ============ STORIES PAGE SETTINGS ============
async function loadStoriesPageSettings() {
    try {
        const res = await fetch(API + '/api/admin/settings');
        const s = await res.json();
        document.getElementById('adm_stories_hero_title').value = s.stories_hero_title || '';
        document.getElementById('adm_stories_hero_subtitle').value = s.stories_hero_subtitle || '';
        document.getElementById('adm_stories_cta_title').value = s.stories_cta_title || '';
        document.getElementById('adm_stories_cta_subtitle').value = s.stories_cta_subtitle || '';
        document.getElementById('adm_stories_cta_btn').value = s.stories_cta_btn || '';
    } catch(e) { console.error('Error loading stories settings:', e); }
}

async function saveStoriesSettings() {
    const fields = {
        stories_hero_title: document.getElementById('adm_stories_hero_title').value,
        stories_hero_subtitle: document.getElementById('adm_stories_hero_subtitle').value,
        stories_cta_title: document.getElementById('adm_stories_cta_title').value,
        stories_cta_subtitle: document.getElementById('adm_stories_cta_subtitle').value,
        stories_cta_btn: document.getElementById('adm_stories_cta_btn').value,
    };
    try {
        for (const [key, value] of Object.entries(fields)) {
            await fetch(API + '/api/admin/settings', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ key, value })
            });
        }
        showToast('הגדרות דף סיפורים נשמרו!');
    } catch(e) { showToast('שגיאה בשמירה', 'error'); }
}

// ============ STORIES ============
async function loadStories() {
    try {
        const res = await fetch(API + '/api/admin/stories');
        const data = await res.json();
        const stories = data.data || data.stories || data || [];
        const list = document.getElementById('storiesList');
        if (!Array.isArray(stories) || stories.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין סיפורים</div>';
            return;
        }
        list.innerHTML = stories.map(s => `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div class="flex items-center gap-4">
                    <img src="${s.image_url || ''}" class="w-16 h-12 rounded object-cover bg-white/10" onerror="this.src=''"/>
                    <div>
                        <div class="font-semibold">${s.couple_names || ''}</div>
                        <div class="flex gap-2 mt-1">
                            ${s.wedding_date ? '<span class="bg-primary/20 text-primary text-xs px-2 py-0.5 rounded">' + s.wedding_date + '</span>' : ''}
                            ${s.is_active ? '<span class="bg-green-500/20 text-green-400 text-xs px-2 py-0.5 rounded">מפורסם</span>' : '<span class="bg-red-500/20 text-red-400 text-xs px-2 py-0.5 rounded">טיוטה</span>'}
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="editStory(${s.id})" class="text-white/60 hover:text-primary transition p-1">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </button>
                    <button onclick="deleteStory(${s.id})" class="text-white/60 hover:text-red-500 transition p-1">
                        <span class="material-symbols-outlined text-xl">delete</span>
                    </button>
                </div>
            </div>
        `).join('');
    } catch(e) {
        console.error('Error loading stories:', e);
    }
}

function openStoryForm(story = null) {
    document.getElementById('storyModal').classList.remove('hidden');
    document.getElementById('storyForm').reset();
    document.getElementById('story_id').value = '';
    document.getElementById('story_image').value = '';
    document.getElementById('story_image_preview').classList.add('hidden');
    document.getElementById('storyModalTitle').textContent = 'הוסף סיפור';
    document.getElementById('story_is_active').checked = true;

    if (story) {
        document.getElementById('storyModalTitle').textContent = 'עריכת סיפור';
        document.getElementById('story_id').value = story.id;
        document.getElementById('story_couple_names').value = story.couple_names || '';
        document.getElementById('story_story').value = story.story || '';
        document.getElementById('story_wedding_date').value = story.wedding_date || '';
        document.getElementById('story_is_active').checked = !!story.is_active;
        if (story.image_url) {
            document.getElementById('story_image').value = story.image_url;
            document.getElementById('story_image_preview').src = story.image_url;
            document.getElementById('story_image_preview').classList.remove('hidden');
        }
    }
}

function closeStoryForm() {
    document.getElementById('storyModal').classList.add('hidden');
}

async function editStory(id) {
    try {
        const res = await fetch(API + '/api/admin/stories/' + id);
        const story = await res.json();
        openStoryForm(story.data || story);
    } catch(e) {
        console.error('Error loading story:', e);
    }
}

async function deleteStory(id) {
    if (!confirm('האם למחוק את הסיפור?')) return;
    try {
        await fetch(API + '/api/admin/stories/' + id, { method: 'DELETE' });
        loadStories();
    } catch(e) {
        console.error('Error deleting story:', e);
    }
}

async function saveStory(e) {
    e.preventDefault();
    const id = document.getElementById('story_id').value;
    const body = {
        title: document.getElementById('story_couple_names').value,
        couple_names: document.getElementById('story_couple_names').value,
        story: document.getElementById('story_story').value,
        image_url: document.getElementById('story_image').value,
        wedding_date: document.getElementById('story_wedding_date').value || null,
        is_active: document.getElementById('story_is_active').checked ? 1 : 0,
    };
    try {
        const url = id ? API + '/api/admin/stories/' + id : API + '/api/admin/stories';
        const method = id ? 'PUT' : 'POST';
        await fetch(url, { method, headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        closeStoryForm();
        loadStories();
    } catch(e) {
        console.error('Error saving story:', e);
    }
}

// ============ FAQS ============
async function loadFaqs() {
    try {
        const res = await fetch(API + '/api/admin/faqs');
        const data = await res.json();
        const faqs = data.data || data.faqs || data || [];
        const list = document.getElementById('faqsList');
        if (!Array.isArray(faqs) || faqs.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין שאלות נפוצות</div>';
            return;
        }
        list.innerHTML = faqs.map(f => `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div>
                    <div class="font-semibold">${f.question || ''}</div>
                    <div class="flex gap-2 mt-1">
                        ${f.is_active ? '<span class="bg-green-500/20 text-green-400 text-xs px-2 py-0.5 rounded">פעיל</span>' : '<span class="bg-red-500/20 text-red-400 text-xs px-2 py-0.5 rounded">לא פעיל</span>'}
                        <span class="text-white/40 text-xs">סדר: ${f.sort_order || 0}</span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="editFaq(${f.id})" class="text-white/60 hover:text-primary transition p-1">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </button>
                    <button onclick="deleteFaq(${f.id})" class="text-white/60 hover:text-red-500 transition p-1">
                        <span class="material-symbols-outlined text-xl">delete</span>
                    </button>
                </div>
            </div>
        `).join('');
    } catch(e) {
        console.error('Error loading FAQs:', e);
    }
}

function openFaqForm(faq = null) {
    document.getElementById('faqModal').classList.remove('hidden');
    document.getElementById('faqForm').reset();
    document.getElementById('faq_id').value = '';
    document.getElementById('faqModalTitle').textContent = 'הוסף שאלה';
    document.getElementById('faq_is_active').checked = true;

    if (faq) {
        document.getElementById('faqModalTitle').textContent = 'עריכת שאלה';
        document.getElementById('faq_id').value = faq.id;
        document.getElementById('faq_question').value = faq.question || '';
        document.getElementById('faq_answer').value = faq.answer || '';
        document.getElementById('faq_sort_order').value = faq.sort_order || 0;
        document.getElementById('faq_is_active').checked = faq.is_active !== 0;
    }
}

function closeFaqForm() {
    document.getElementById('faqModal').classList.add('hidden');
}

async function editFaq(id) {
    try {
        const res = await fetch(API + '/api/admin/faqs/' + id);
        const faq = await res.json();
        openFaqForm(faq.data || faq);
    } catch(e) {
        console.error('Error loading FAQ:', e);
    }
}

async function deleteFaq(id) {
    if (!confirm('האם למחוק את השאלה?')) return;
    try {
        await fetch(API + '/api/admin/faqs/' + id, { method: 'DELETE' });
        loadFaqs();
    } catch(e) {
        console.error('Error deleting FAQ:', e);
    }
}

async function saveFaq(e) {
    e.preventDefault();
    const id = document.getElementById('faq_id').value;
    const body = {
        question: document.getElementById('faq_question').value,
        answer: document.getElementById('faq_answer').value,
        sort_order: parseInt(document.getElementById('faq_sort_order').value) || 0,
        is_active: document.getElementById('faq_is_active').checked ? 1 : 0,
    };
    try {
        const url = id ? API + '/api/admin/faqs/' + id : API + '/api/admin/faqs';
        const method = id ? 'PUT' : 'POST';
        await fetch(url, { method, headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        closeFaqForm();
        loadFaqs();
    } catch(e) {
        console.error('Error saving FAQ:', e);
    }
}

// ============ PROCESS STEPS ============
async function loadProcessSteps() {
    try {
        // Load steps
        const res = await fetch(API + '/api/admin/process-steps');
        const data = await res.json();
        const steps = data.data || data.steps || data || [];
        const list = document.getElementById('stepsList');
        if (!Array.isArray(steps) || steps.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין שלבים</div>';
        } else {
            list.innerHTML = steps.map(s => `
                <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                    <div class="flex items-center gap-4">
                        <span class="material-symbols-outlined text-primary text-2xl">${s.icon || 'circle'}</span>
                        <div>
                            <div class="font-semibold">${s.step_number || ''}. ${s.title || ''}</div>
                            <div class="text-sm text-white/60">${s.description || ''}</div>
                            <div class="flex gap-2 mt-1">
                                ${s.is_active ? '<span class="bg-green-500/20 text-green-400 text-xs px-2 py-0.5 rounded">פעיל</span>' : '<span class="bg-red-500/20 text-red-400 text-xs px-2 py-0.5 rounded">לא פעיל</span>'}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="editStep(${s.id})" class="text-white/60 hover:text-primary transition p-1">
                            <span class="material-symbols-outlined text-xl">edit</span>
                        </button>
                        <button onclick="deleteStep(${s.id})" class="text-white/60 hover:text-red-500 transition p-1">
                            <span class="material-symbols-outlined text-xl">delete</span>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Load process text settings
        const settingsRes = await fetch(API + '/api/admin/settings');
        const settingsData = await settingsRes.json();
        const settings = settingsData.data || settingsData.settings || settingsData || {};
        document.getElementById('process_hero_title').value = settings.process_hero_title || '';
        document.getElementById('process_hero_subtitle').value = settings.process_hero_subtitle || '';
        document.getElementById('process_steps_title').value = settings.process_steps_title || '';
        document.getElementById('process_cta_title').value = settings.process_cta_title || '';
        document.getElementById('process_cta_subtitle').value = settings.process_cta_subtitle || '';
    } catch(e) {
        console.error('Error loading process steps:', e);
    }
}

function openStepForm(step = null) {
    document.getElementById('stepModal').classList.remove('hidden');
    document.getElementById('stepForm').reset();
    document.getElementById('step_id').value = '';
    document.getElementById('step_image').value = '';
    document.getElementById('step_image_preview').classList.add('hidden');
    document.getElementById('stepModalTitle').textContent = 'הוסף שלב';
    document.getElementById('step_is_active').checked = true;

    if (step) {
        document.getElementById('stepModalTitle').textContent = 'עריכת שלב';
        document.getElementById('step_id').value = step.id;
        document.getElementById('step_step_number').value = step.step_number || '';
        document.getElementById('step_title').value = step.title || '';
        document.getElementById('step_description').value = step.description || '';
        document.getElementById('step_icon').value = step.icon || '';
        document.getElementById('step_is_active').checked = step.is_active !== 0;
        if (step.image_url) {
            document.getElementById('step_image').value = step.image_url;
            document.getElementById('step_image_preview').src = step.image_url;
            document.getElementById('step_image_preview').classList.remove('hidden');
        }
    }
}

function closeStepForm() {
    document.getElementById('stepModal').classList.add('hidden');
}

async function editStep(id) {
    try {
        const res = await fetch(API + '/api/admin/process-steps/' + id);
        const step = await res.json();
        openStepForm(step.data || step);
    } catch(e) {
        console.error('Error loading step:', e);
    }
}

async function deleteStep(id) {
    if (!confirm('האם למחוק את השלב?')) return;
    try {
        await fetch(API + '/api/admin/process-steps/' + id, { method: 'DELETE' });
        loadProcessSteps();
    } catch(e) {
        console.error('Error deleting step:', e);
    }
}

async function saveStep(e) {
    e.preventDefault();
    const id = document.getElementById('step_id').value;
    const body = {
        step_number: parseInt(document.getElementById('step_step_number').value) || 1,
        title: document.getElementById('step_title').value,
        description: document.getElementById('step_description').value,
        icon: document.getElementById('step_icon').value,
        is_active: document.getElementById('step_is_active').checked ? 1 : 0,
        image_url: document.getElementById('step_image').value,
    };
    try {
        const url = id ? API + '/api/admin/process-steps/' + id : API + '/api/admin/process-steps';
        const method = id ? 'PUT' : 'POST';
        await fetch(url, { method, headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        closeStepForm();
        loadProcessSteps();
    } catch(e) {
        console.error('Error saving step:', e);
    }
}

async function saveProcessTexts() {
    const body = {
        process_hero_title: document.getElementById('process_hero_title').value,
        process_hero_subtitle: document.getElementById('process_hero_subtitle').value,
        process_steps_title: document.getElementById('process_steps_title').value,
        process_cta_title: document.getElementById('process_cta_title').value,
        process_cta_subtitle: document.getElementById('process_cta_subtitle').value,
    };
    try {
        await fetch(API + '/api/admin/settings', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        alert('הגדרות טקסט נשמרו בהצלחה');
    } catch(e) {
        console.error('Error saving process texts:', e);
    }
}

// ============ HOME SETTINGS ============
async function uploadHomeImage(key, input) {
    if (!input.files[0]) return;
    const fd = new FormData(); fd.append('file', input.files[0]);
    try {
        const res = await fetch(API + '/api/upload', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.url) {
            document.getElementById('adm_' + key).value = data.url;
            const prev = document.getElementById('adm_' + key + '_preview');
            if (prev) { prev.src = data.url; prev.classList.remove('hidden'); }
        }
    } catch(e) { console.error('Upload error:', e); }
}

async function loadHomeSettings() {
    try {
        const res = await fetch(API + '/api/admin/settings');
        const data = await res.json();
        const s = data.data || data.settings || data || {};
        document.getElementById('adm_home_hero_badge').value = s.home_hero_badge || '';
        document.getElementById('adm_home_hero_title').value = s.home_hero_title || '';
        document.getElementById('adm_home_hero_subtitle').value = s.home_hero_subtitle || '';
        if (s.home_hero_bg) {
            document.getElementById('adm_home_hero_bg').value = s.home_hero_bg;
            document.getElementById('adm_home_hero_bg_preview').src = s.home_hero_bg;
            document.getElementById('adm_home_hero_bg_preview').classList.remove('hidden');
        }
        document.getElementById('adm_home_form_title').value = s.home_form_title || '';
        document.getElementById('adm_home_why_label').value = s.home_why_label || '';
        document.getElementById('adm_home_why_title').value = s.home_why_title || '';
        document.getElementById('adm_home_feat1_title').value = s.home_feat1_title || '';
        document.getElementById('adm_home_feat1_text').value = s.home_feat1_text || '';
        document.getElementById('adm_home_feat2_title').value = s.home_feat2_title || '';
        document.getElementById('adm_home_feat2_text').value = s.home_feat2_text || '';
        document.getElementById('adm_home_feat3_title').value = s.home_feat3_title || '';
        document.getElementById('adm_home_feat3_text').value = s.home_feat3_text || '';
        document.getElementById('adm_home_stat1_num').value = s.home_stat1_num || '';
        document.getElementById('adm_home_stat1_label').value = s.home_stat1_label || '';
        document.getElementById('adm_home_stat2_num').value = s.home_stat2_num || '';
        document.getElementById('adm_home_stat2_label').value = s.home_stat2_label || '';
        document.getElementById('adm_home_stat3_num').value = s.home_stat3_num || '';
        document.getElementById('adm_home_stat3_label').value = s.home_stat3_label || '';
        document.getElementById('adm_home_stat4_num').value = s.home_stat4_num || '';
        document.getElementById('adm_home_stat4_label').value = s.home_stat4_label || '';
        document.getElementById('adm_home_stories_label').value = s.home_stories_label || '';
        document.getElementById('adm_home_stories_title').value = s.home_stories_title || '';
        document.getElementById('adm_home_cta_title').value = s.home_cta_title || '';
        document.getElementById('adm_home_cta_subtitle').value = s.home_cta_subtitle || '';
    } catch(e) {
        console.error('Error loading home settings:', e);
    }
}

async function saveHomeSettings(e) {
    e.preventDefault();
    const body = {
        home_hero_badge: document.getElementById('adm_home_hero_badge').value,
        home_hero_title: document.getElementById('adm_home_hero_title').value,
        home_hero_subtitle: document.getElementById('adm_home_hero_subtitle').value,
        home_hero_bg: document.getElementById('adm_home_hero_bg').value,
        home_form_title: document.getElementById('adm_home_form_title').value,
        home_why_label: document.getElementById('adm_home_why_label').value,
        home_why_title: document.getElementById('adm_home_why_title').value,
        home_feat1_title: document.getElementById('adm_home_feat1_title').value,
        home_feat1_text: document.getElementById('adm_home_feat1_text').value,
        home_feat2_title: document.getElementById('adm_home_feat2_title').value,
        home_feat2_text: document.getElementById('adm_home_feat2_text').value,
        home_feat3_title: document.getElementById('adm_home_feat3_title').value,
        home_feat3_text: document.getElementById('adm_home_feat3_text').value,
        home_stat1_num: document.getElementById('adm_home_stat1_num').value,
        home_stat1_label: document.getElementById('adm_home_stat1_label').value,
        home_stat2_num: document.getElementById('adm_home_stat2_num').value,
        home_stat2_label: document.getElementById('adm_home_stat2_label').value,
        home_stat3_num: document.getElementById('adm_home_stat3_num').value,
        home_stat3_label: document.getElementById('adm_home_stat3_label').value,
        home_stat4_num: document.getElementById('adm_home_stat4_num').value,
        home_stat4_label: document.getElementById('adm_home_stat4_label').value,
        home_stories_label: document.getElementById('adm_home_stories_label').value,
        home_stories_title: document.getElementById('adm_home_stories_title').value,
        home_cta_title: document.getElementById('adm_home_cta_title').value,
        home_cta_subtitle: document.getElementById('adm_home_cta_subtitle').value,
    };
    try {
        await fetch(API + '/api/admin/settings', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        alert('הגדרות דף הבית נשמרו בהצלחה');
    } catch(e) {
        console.error('Error saving home settings:', e);
    }
}

// ============ VIP SETTINGS ============
async function loadVipSettings() {
    try {
        const res = await fetch(API + '/api/admin/settings');
        const data = await res.json();
        const s = data.data || data.settings || data || {};
        document.getElementById('vip_hero_title').value = s.vip_hero_title || '';
        document.getElementById('vip_hero_subtitle').value = s.vip_hero_subtitle || '';
        document.getElementById('adm_vip_pkg1_name').value = s.vip_pkg1_name || '';
        document.getElementById('adm_vip_pkg1_price').value = s.vip_pkg1_price || '';
        document.getElementById('adm_vip_pkg1_period').value = s.vip_pkg1_period || '';
        document.getElementById('adm_vip_pkg1_btn').value = s.vip_pkg1_btn || '';
        document.getElementById('adm_vip_pkg1_features').value = s.vip_pkg1_features || '';
        document.getElementById('adm_vip_pkg2_name').value = s.vip_pkg2_name || '';
        document.getElementById('adm_vip_pkg2_price').value = s.vip_pkg2_price || '';
        document.getElementById('adm_vip_pkg2_period').value = s.vip_pkg2_period || '';
        document.getElementById('adm_vip_pkg2_btn').value = s.vip_pkg2_btn || '';
        document.getElementById('adm_vip_pkg2_badge').value = s.vip_pkg2_badge || '';
        document.getElementById('adm_vip_pkg2_features').value = s.vip_pkg2_features || '';
        document.getElementById('adm_vip_pkg3_name').value = s.vip_pkg3_name || '';
        document.getElementById('adm_vip_pkg3_price').value = s.vip_pkg3_price || '';
        document.getElementById('adm_vip_pkg3_period').value = s.vip_pkg3_period || '';
        document.getElementById('adm_vip_pkg3_btn').value = s.vip_pkg3_btn || '';
        document.getElementById('adm_vip_pkg3_features').value = s.vip_pkg3_features || '';
        document.getElementById('adm_vip_why_title').value = s.vip_why_title || '';
        document.getElementById('adm_vip_why_subtitle').value = s.vip_why_subtitle || '';
        document.getElementById('adm_vip_feat1_icon').value = s.vip_feat1_icon || '';
        document.getElementById('adm_vip_feat1_title').value = s.vip_feat1_title || '';
        document.getElementById('adm_vip_feat1_text').value = s.vip_feat1_text || '';
        document.getElementById('adm_vip_feat2_icon').value = s.vip_feat2_icon || '';
        document.getElementById('adm_vip_feat2_title').value = s.vip_feat2_title || '';
        document.getElementById('adm_vip_feat2_text').value = s.vip_feat2_text || '';
        document.getElementById('adm_vip_feat3_icon').value = s.vip_feat3_icon || '';
        document.getElementById('adm_vip_feat3_title').value = s.vip_feat3_title || '';
        document.getElementById('adm_vip_feat3_text').value = s.vip_feat3_text || '';
        document.getElementById('adm_vip_cta_title').value = s.vip_cta_title || '';
        document.getElementById('adm_vip_cta_subtitle').value = s.vip_cta_subtitle || '';
        document.getElementById('adm_vip_cta_btn').value = s.vip_cta_btn || '';
    } catch(e) {
        console.error('Error loading VIP settings:', e);
    }
}

async function saveVipSettings(e) {
    e.preventDefault();
    const body = {
        vip_hero_title: document.getElementById('vip_hero_title').value,
        vip_hero_subtitle: document.getElementById('vip_hero_subtitle').value,
        vip_pkg1_name: document.getElementById('adm_vip_pkg1_name').value,
        vip_pkg1_price: document.getElementById('adm_vip_pkg1_price').value,
        vip_pkg1_period: document.getElementById('adm_vip_pkg1_period').value,
        vip_pkg1_btn: document.getElementById('adm_vip_pkg1_btn').value,
        vip_pkg1_features: document.getElementById('adm_vip_pkg1_features').value,
        vip_pkg2_name: document.getElementById('adm_vip_pkg2_name').value,
        vip_pkg2_price: document.getElementById('adm_vip_pkg2_price').value,
        vip_pkg2_period: document.getElementById('adm_vip_pkg2_period').value,
        vip_pkg2_btn: document.getElementById('adm_vip_pkg2_btn').value,
        vip_pkg2_badge: document.getElementById('adm_vip_pkg2_badge').value,
        vip_pkg2_features: document.getElementById('adm_vip_pkg2_features').value,
        vip_pkg3_name: document.getElementById('adm_vip_pkg3_name').value,
        vip_pkg3_price: document.getElementById('adm_vip_pkg3_price').value,
        vip_pkg3_period: document.getElementById('adm_vip_pkg3_period').value,
        vip_pkg3_btn: document.getElementById('adm_vip_pkg3_btn').value,
        vip_pkg3_features: document.getElementById('adm_vip_pkg3_features').value,
        vip_why_title: document.getElementById('adm_vip_why_title').value,
        vip_why_subtitle: document.getElementById('adm_vip_why_subtitle').value,
        vip_feat1_icon: document.getElementById('adm_vip_feat1_icon').value,
        vip_feat1_title: document.getElementById('adm_vip_feat1_title').value,
        vip_feat1_text: document.getElementById('adm_vip_feat1_text').value,
        vip_feat2_icon: document.getElementById('adm_vip_feat2_icon').value,
        vip_feat2_title: document.getElementById('adm_vip_feat2_title').value,
        vip_feat2_text: document.getElementById('adm_vip_feat2_text').value,
        vip_feat3_icon: document.getElementById('adm_vip_feat3_icon').value,
        vip_feat3_title: document.getElementById('adm_vip_feat3_title').value,
        vip_feat3_text: document.getElementById('adm_vip_feat3_text').value,
        vip_cta_title: document.getElementById('adm_vip_cta_title').value,
        vip_cta_subtitle: document.getElementById('adm_vip_cta_subtitle').value,
        vip_cta_btn: document.getElementById('adm_vip_cta_btn').value,
    };
    try {
        await fetch(API + '/api/admin/settings', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        alert('הגדרות VIP נשמרו בהצלחה');
    } catch(e) {
        console.error('Error saving VIP settings:', e);
    }
}

// ============ ABOUT SETTINGS ============
async function loadAboutSettings() {
    try {
        const res = await fetch(API + '/api/admin/settings');
        const data = await res.json();
        const s = data.data || data.settings || data || {};
        document.getElementById('about_hero_title').value = s.about_hero_title || '';
        document.getElementById('about_hero_subtitle').value = s.about_hero_subtitle || '';
        if (s.about_hero_image) {
            document.getElementById('about_hero_image').value = s.about_hero_image;
            document.getElementById('about_hero_image_preview').src = s.about_hero_image;
            document.getElementById('about_hero_image_preview').classList.remove('hidden');
        }
        document.getElementById('about_who_title').value = s.about_who_title || '';
        document.getElementById('about_who_text').value = s.about_who_text || '';
        if (s.about_who_image) {
            document.getElementById('about_who_image').value = s.about_who_image;
            document.getElementById('about_who_image_preview').src = s.about_who_image;
            document.getElementById('about_who_image_preview').classList.remove('hidden');
        }
        document.getElementById('adm_about_stat1_num').value = s.about_stat1_num || '';
        document.getElementById('adm_about_stat1_label').value = s.about_stat1_label || '';
        document.getElementById('adm_about_stat2_num').value = s.about_stat2_num || '';
        document.getElementById('adm_about_stat2_label').value = s.about_stat2_label || '';
        document.getElementById('adm_about_stat3_num').value = s.about_stat3_num || '';
        document.getElementById('adm_about_stat3_label').value = s.about_stat3_label || '';
        document.getElementById('adm_about_stat4_num').value = s.about_stat4_num || '';
        document.getElementById('adm_about_stat4_label').value = s.about_stat4_label || '';
        document.getElementById('adm_about_vision_title').value = s.about_vision_title || '';
        document.getElementById('adm_about_card1_title').value = s.about_card1_title || '';
        document.getElementById('adm_about_card1_text').value = s.about_card1_text || '';
        document.getElementById('adm_about_card2_title').value = s.about_card2_title || '';
        document.getElementById('adm_about_card2_text').value = s.about_card2_text || '';
        document.getElementById('adm_about_card3_title').value = s.about_card3_title || '';
        document.getElementById('adm_about_card3_text').value = s.about_card3_text || '';
        document.getElementById('about_why_title').value = s.about_why_title || '';
        if (s.about_why_image) {
            document.getElementById('about_why_image').value = s.about_why_image;
            document.getElementById('about_why_image_preview').src = s.about_why_image;
            document.getElementById('about_why_image_preview').classList.remove('hidden');
        }
        document.getElementById('adm_about_why1_title').value = s.about_why1_title || '';
        document.getElementById('adm_about_why1_text').value = s.about_why1_text || '';
        document.getElementById('adm_about_why2_title').value = s.about_why2_title || '';
        document.getElementById('adm_about_why2_text').value = s.about_why2_text || '';
        document.getElementById('adm_about_why3_title').value = s.about_why3_title || '';
        document.getElementById('adm_about_why3_text').value = s.about_why3_text || '';
        document.getElementById('about_cta_title').value = s.about_cta_title || '';
        document.getElementById('about_cta_subtitle').value = s.about_cta_subtitle || '';
    } catch(e) {
        console.error('Error loading about settings:', e);
    }
}

async function saveAboutSettings(e) {
    e.preventDefault();
    const body = {
        about_hero_title: document.getElementById('about_hero_title').value,
        about_hero_subtitle: document.getElementById('about_hero_subtitle').value,
        about_hero_image: document.getElementById('about_hero_image').value,
        about_who_title: document.getElementById('about_who_title').value,
        about_who_text: document.getElementById('about_who_text').value,
        about_who_image: document.getElementById('about_who_image').value,
        about_stat1_num: document.getElementById('adm_about_stat1_num').value,
        about_stat1_label: document.getElementById('adm_about_stat1_label').value,
        about_stat2_num: document.getElementById('adm_about_stat2_num').value,
        about_stat2_label: document.getElementById('adm_about_stat2_label').value,
        about_stat3_num: document.getElementById('adm_about_stat3_num').value,
        about_stat3_label: document.getElementById('adm_about_stat3_label').value,
        about_stat4_num: document.getElementById('adm_about_stat4_num').value,
        about_stat4_label: document.getElementById('adm_about_stat4_label').value,
        about_vision_title: document.getElementById('adm_about_vision_title').value,
        about_card1_title: document.getElementById('adm_about_card1_title').value,
        about_card1_text: document.getElementById('adm_about_card1_text').value,
        about_card2_title: document.getElementById('adm_about_card2_title').value,
        about_card2_text: document.getElementById('adm_about_card2_text').value,
        about_card3_title: document.getElementById('adm_about_card3_title').value,
        about_card3_text: document.getElementById('adm_about_card3_text').value,
        about_why_title: document.getElementById('about_why_title').value,
        about_why_image: document.getElementById('about_why_image').value,
        about_why1_title: document.getElementById('adm_about_why1_title').value,
        about_why1_text: document.getElementById('adm_about_why1_text').value,
        about_why2_title: document.getElementById('adm_about_why2_title').value,
        about_why2_text: document.getElementById('adm_about_why2_text').value,
        about_why3_title: document.getElementById('adm_about_why3_title').value,
        about_why3_text: document.getElementById('adm_about_why3_text').value,
        about_cta_title: document.getElementById('about_cta_title').value,
        about_cta_subtitle: document.getElementById('about_cta_subtitle').value,
    };
    try {
        await fetch(API + '/api/admin/settings', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        alert('הגדרות אודות נשמרו בהצלחה');
    } catch(e) {
        console.error('Error saving about settings:', e);
    }
}

// ============ CONTACT SETTINGS ============
async function uploadContactImage(input) {
    if (!input.files[0]) return;
    const fd = new FormData(); fd.append('file', input.files[0]);
    try {
        const res = await fetch(API + '/api/upload', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.url) {
            document.getElementById('adm_contact_hero_image').value = data.url;
            document.getElementById('adm_contact_hero_image_preview').src = data.url;
            document.getElementById('adm_contact_hero_image_preview').classList.remove('hidden');
        }
    } catch(e) { console.error('Upload error:', e); }
}

async function loadContactSettings() {
    try {
        const res = await fetch(API + '/api/admin/settings');
        const data = await res.json();
        const s = data.data || data.settings || data || {};
        document.getElementById('contact_hero_title').value = s.contact_hero_title || '';
        document.getElementById('contact_hero_subtitle').value = s.contact_hero_subtitle || '';
        if (s.contact_hero_image) {
            document.getElementById('adm_contact_hero_image').value = s.contact_hero_image;
            document.getElementById('adm_contact_hero_image_preview').src = s.contact_hero_image;
            document.getElementById('adm_contact_hero_image_preview').classList.remove('hidden');
        }
        document.getElementById('contact_email_label').value = s.contact_email_label || '';
        document.getElementById('contact_email_value').value = s.contact_email_value || '';
        document.getElementById('contact_phone_label').value = s.contact_phone_label || '';
        document.getElementById('contact_phone_value').value = s.contact_phone_value || '';
        document.getElementById('contact_address_label').value = s.contact_address_label || '';
        document.getElementById('contact_address_value').value = s.contact_address_value || '';
        document.getElementById('contact_hours_label').value = s.contact_hours_label || '';
        document.getElementById('contact_hours_value').value = s.contact_hours_value || '';
        document.getElementById('contact_whatsapp_url').value = s.contact_whatsapp_url || '';
        document.getElementById('contact_whatsapp_text').value = s.contact_whatsapp_text || '';
        document.getElementById('contact_form_title').value = s.contact_form_title || '';
        document.getElementById('contact_form_subtitle').value = s.contact_form_subtitle || '';
        document.getElementById('adm_contact_submit_btn').value = s.contact_submit_btn || '';
        document.getElementById('adm_contact_disclaimer').value = s.contact_disclaimer || '';
    } catch(e) {
        console.error('Error loading contact settings:', e);
    }
}

async function saveContactSettings(e) {
    e.preventDefault();
    const body = {
        contact_hero_title: document.getElementById('contact_hero_title').value,
        contact_hero_subtitle: document.getElementById('contact_hero_subtitle').value,
        contact_hero_image: document.getElementById('adm_contact_hero_image').value,
        contact_email_label: document.getElementById('contact_email_label').value,
        contact_email_value: document.getElementById('contact_email_value').value,
        contact_phone_label: document.getElementById('contact_phone_label').value,
        contact_phone_value: document.getElementById('contact_phone_value').value,
        contact_address_label: document.getElementById('contact_address_label').value,
        contact_address_value: document.getElementById('contact_address_value').value,
        contact_hours_label: document.getElementById('contact_hours_label').value,
        contact_hours_value: document.getElementById('contact_hours_value').value,
        contact_whatsapp_url: document.getElementById('contact_whatsapp_url').value,
        contact_whatsapp_text: document.getElementById('contact_whatsapp_text').value,
        contact_form_title: document.getElementById('contact_form_title').value,
        contact_form_subtitle: document.getElementById('contact_form_subtitle').value,
        contact_submit_btn: document.getElementById('adm_contact_submit_btn').value,
        contact_disclaimer: document.getElementById('adm_contact_disclaimer').value,
    };
    try {
        await fetch(API + '/api/admin/settings', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        alert('הגדרות צור קשר נשמרו בהצלחה');
    } catch(e) {
        console.error('Error saving contact settings:', e);
    }
}

// ============ REVIEWS ============
async function loadReviews() {
    try {
        const res = await fetch(API + '/api/admin/reviews');
        const reviews = await res.json();
        const list = document.getElementById('reviewsList');
        if (!Array.isArray(reviews) || reviews.length === 0) {
            list.innerHTML = '<div class="text-white/40 text-center py-8">אין ביקורות</div>';
            return;
        }
        list.innerHTML = reviews.map(r => {
            const stars = '★'.repeat(r.rating) + '☆'.repeat(5 - r.rating);
            return `
            <div class="bg-card border border-white/10 rounded-lg p-4 flex items-center justify-between hover:bg-card-hover transition">
                <div class="flex items-center gap-4 flex-1">
                    <div class="w-10 h-10 rounded-full bg-primary/15 flex items-center justify-center text-primary font-bold text-sm flex-shrink-0">${r.client_name.split(' ').map(w => w[0]).join('')}</div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="font-semibold">${r.client_name}</span>
                            <span class="text-primary text-sm">${stars}</span>
                        </div>
                        <div class="text-sm text-white/50 truncate">${r.review_text}</div>
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button onclick="editReview(${r.id})" class="text-white/60 hover:text-primary transition p-1">
                        <span class="material-symbols-outlined text-xl">edit</span>
                    </button>
                    <button onclick="deleteReview(${r.id})" class="text-white/60 hover:text-red-500 transition p-1">
                        <span class="material-symbols-outlined text-xl">delete</span>
                    </button>
                </div>
            </div>`;
        }).join('');
    } catch(e) { console.error('Error loading reviews:', e); }
}

let allReviews = [];
async function fetchAllReviews() {
    const res = await fetch(API + '/api/admin/reviews');
    allReviews = await res.json();
}

function openReviewForm(review = null) {
    document.getElementById('reviewModal').classList.remove('hidden');
    document.getElementById('reviewForm').reset();
    document.getElementById('review_id').value = '';
    document.getElementById('review_photo').value = '';
    document.getElementById('review_photo_preview').style.display = 'none';
    document.getElementById('reviewModalTitle').textContent = 'הוסף ביקורת';
    if (review) {
        document.getElementById('reviewModalTitle').textContent = 'עריכת ביקורת';
        document.getElementById('review_id').value = review.id;
        document.getElementById('review_name').value = review.client_name || '';
        document.getElementById('review_rating').value = review.rating || 5;
        document.getElementById('review_text').value = review.review_text || '';
        if (review.client_photo) {
            document.getElementById('review_photo').value = review.client_photo;
            document.getElementById('review_photo_url').value = review.client_photo;
            document.getElementById('review_photo_preview').src = review.client_photo;
            document.getElementById('review_photo_preview').style.display = 'block';
        }
    }
}

function closeReviewForm() {
    document.getElementById('reviewModal').classList.add('hidden');
}

async function editReview(id) {
    if (!allReviews.length) await fetchAllReviews();
    const review = allReviews.find(r => r.id == id);
    if (review) openReviewForm(review);
}

async function deleteReview(id) {
    if (!confirm('למחוק ביקורת זו?')) return;
    try {
        await fetch(API + '/api/admin/reviews/' + id, { method: 'DELETE' });
        loadReviews();
        fetchAllReviews();
    } catch(e) { console.error(e); }
}

async function uploadReviewPhoto(input) {
    if (!input.files[0]) return;
    const fd = new FormData();
    fd.append('file', input.files[0]);
    try {
        const res = await fetch(API + '/api/upload', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.url) {
            document.getElementById('review_photo').value = data.url;
            document.getElementById('review_photo_url').value = data.url;
            document.getElementById('review_photo_preview').src = data.url;
            document.getElementById('review_photo_preview').style.display = 'block';
        }
    } catch(e) { alert('שגיאה בהעלאת תמונה'); }
}

async function saveReview(e) {
    e.preventDefault();
    const id = document.getElementById('review_id').value;
    const body = {
        client_name: document.getElementById('review_name').value,
        client_photo: document.getElementById('review_photo').value || document.getElementById('review_photo_url').value || null,
        rating: parseInt(document.getElementById('review_rating').value),
        review_text: document.getElementById('review_text').value,
    };
    try {
        const url = id ? API + '/api/admin/reviews/' + id : API + '/api/admin/reviews';
        const method = id ? 'PUT' : 'POST';
        await fetch(url, { method, headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        closeReviewForm();
        loadReviews();
        fetchAllReviews();
    } catch(e) { console.error(e); alert('שגיאה בשמירה'); }
}

// ============ SITE SETTINGS ============
async function loadSiteSettings() {
    try {
        const res = await fetch(API + '/api/admin/settings');
        const data = await res.json();
        const s = data.data || data.settings || data || {};
        document.getElementById('site_name').value = s.site_name || '';
        document.getElementById('site_subtitle').value = s.site_subtitle || '';
        document.getElementById('site_menu_links').value = s.site_menu_links || '';
        document.getElementById('site_footer_description').value = s.site_footer_description || '';
        document.getElementById('site_footer_links').value = s.site_footer_links || '';
        document.getElementById('site_footer_phone').value = s.site_footer_phone || '';
        document.getElementById('site_footer_email').value = s.site_footer_email || '';
        document.getElementById('site_footer_address').value = s.site_footer_address || '';
        document.getElementById('site_footer_copyright').value = s.site_footer_copyright || '';
        document.getElementById('site_social1_icon').value = s.site_social1_icon || '';
        document.getElementById('site_social1_url').value = s.site_social1_url || '';
        document.getElementById('site_social2_icon').value = s.site_social2_icon || '';
        document.getElementById('site_social2_url').value = s.site_social2_url || '';
        document.getElementById('site_social3_icon').value = s.site_social3_icon || '';
        document.getElementById('site_social3_url').value = s.site_social3_url || '';
        document.getElementById('site_smtp_host').value = s.site_smtp_host || '';
        document.getElementById('site_smtp_port').value = s.site_smtp_port || '';
        document.getElementById('site_smtp_user').value = s.site_smtp_user || '';
        document.getElementById('site_smtp_password').value = s.site_smtp_password || '';
        document.getElementById('site_smtp_from_name').value = s.site_smtp_from_name || '';
    } catch(e) {
        console.error('Error loading site settings:', e);
    }
}

async function saveSiteSettings(e) {
    e.preventDefault();
    const body = {
        site_name: document.getElementById('site_name').value,
        site_subtitle: document.getElementById('site_subtitle').value,
        site_menu_links: document.getElementById('site_menu_links').value,
        site_footer_description: document.getElementById('site_footer_description').value,
        site_footer_links: document.getElementById('site_footer_links').value,
        site_footer_phone: document.getElementById('site_footer_phone').value,
        site_footer_email: document.getElementById('site_footer_email').value,
        site_footer_address: document.getElementById('site_footer_address').value,
        site_footer_copyright: document.getElementById('site_footer_copyright').value,
        site_social1_icon: document.getElementById('site_social1_icon').value,
        site_social1_url: document.getElementById('site_social1_url').value,
        site_social2_icon: document.getElementById('site_social2_icon').value,
        site_social2_url: document.getElementById('site_social2_url').value,
        site_social3_icon: document.getElementById('site_social3_icon').value,
        site_social3_url: document.getElementById('site_social3_url').value,
        site_smtp_host: document.getElementById('site_smtp_host').value,
        site_smtp_port: document.getElementById('site_smtp_port').value,
        site_smtp_user: document.getElementById('site_smtp_user').value,
        site_smtp_password: document.getElementById('site_smtp_password').value,
        site_smtp_from_name: document.getElementById('site_smtp_from_name').value,
    };
    try {
        await fetch(API + '/api/admin/settings', { method: 'POST', headers: {'Content-Type':'application/json'}, body: JSON.stringify(body) });
        alert('הגדרות אתר נשמרו בהצלחה');
    } catch(e) {
        console.error('Error saving site settings:', e);
    }
}

// ============ LOGOUT ============
async function adminLogout() {
    try {
        await fetch(API + '/api/admin/logout', { method: 'POST' });
    } catch(e) {
        // ignore
    }
    window.location.href = BASE_URL + '/admin';
}

// ============ INIT ============
document.addEventListener('DOMContentLoaded', function() {
    loadProfiles();
});
</script>

</body>
</html>