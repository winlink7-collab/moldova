<?php
$pageTitle = 'אודות - Moldova & Ukraine Luxury Brides';
$pageDescription = 'אודות סוכנות שידוכי היוקרה Moldova & Ukraine Brides - מובילים את עולם השידוכים הבינלאומי עם סטנדרטים של יוקרה ודיסקרטיות';
$currentPage = 'about';
require BASE_PATH . '/app/views/layouts/header.php';
?>

<!-- Hero -->
<section class="relative py-24 md:py-32 px-6 text-center overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-primary/5 rounded-full blur-[150px]"></div>
    <div class="relative z-10 max-w-4xl mx-auto">
        <span class="text-primary font-bold tracking-[0.2em] uppercase text-sm mb-4 block">PREMIUM MATCHMAKING</span>
        <h2 id="aboutHeroTitle" class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight leading-tight">אודות הסוכנות שלנו</h2>
        <p id="aboutHeroSubtitle" class="text-slate-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto">מובילים את עולם השידוכים הבינלאומי עם סטנדרטים של יוקרה, דיסקרטיות והתאמה אישית מדויקת.</p>
    </div>
</section>

<!-- Who We Are -->
<section class="py-20 px-6 lg:px-20">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
        <div class="order-2 md:order-1">
            <h3 id="aboutWhoTitle" class="text-primary text-3xl font-bold mb-6">מי אנחנו</h3>
            <div id="aboutWhoText" class="space-y-6 text-slate-300 text-lg leading-relaxed">
                <p>סוכנות "Moldova & Ukraine Brides" הוקמה מתוך חזון לחבר בין גברים המחפשים זוגיות אמיתית לבין נשים איכותיות ומשכילות ממזרח אירופה. אנחנו לא עוד אתר היכרויות, אלא סוכנות בוטיק VIP המעניקה ליווי אישי צמוד.</p>
                <p>המומחיות שלנו טמונה בהיכרות העמוקה עם התרבות המקומית במולדובה ובאוקראינה, ובבניית רשת קשרים ענפה המאפשרת לנו לסנן ולהציע רק את ההתאמות הטובות ביותר עבור הלקוחות שלנו.</p>
            </div>
        </div>
        <div class="order-1 md:order-2">
            <div class="relative">
                <div class="absolute -inset-4 border-2 border-primary/30 rounded-xl"></div>
                <img id="aboutWhoImage" alt="Our Team" class="relative rounded-xl shadow-2xl z-10 w-full aspect-[4/3] object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAxgoX3C_Hhmbfv176C4wD7e8jbwG4eavuanBVUPa4uH2lsS2QiWLqiogT_W9IK9EyziRjwo6_op_l_6UhEM01qXLwIkCIt8KBDQWC1cLN4iClYOSiuIDyi83GOavRErmgH9Gz2Qa0zMhjfnI7ajShe4YyDM_oHka8f0KlInijIfXJqIKyvzl1LMhEPg7dFe3vSbg02iOwuyYoxvUf5s8-9q8ZcFkpjFQD2P77MRYmUs0iliS2V51lQNKwqqEX-SsdKWjkJnbWAeL98"/>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="bg-surface py-16 px-6 lg:px-20">
    <div id="statsContainer" class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="text-center p-6 border-l border-primary/10">
            <div class="text-primary text-4xl font-black mb-2" id="aboutStat1Num">15+</div>
            <div class="text-slate-400 text-sm uppercase tracking-wide" id="aboutStat1Label">שנות ניסיון</div>
        </div>
        <div class="text-center p-6 border-l border-primary/10">
            <div class="text-primary text-4xl font-black mb-2" id="aboutStat2Num">500+</div>
            <div class="text-slate-400 text-sm uppercase tracking-wide" id="aboutStat2Label">זוגות נשואים</div>
        </div>
        <div class="text-center p-6 border-l border-primary/10">
            <div class="text-primary text-4xl font-black mb-2" id="aboutStat3Num">100%</div>
            <div class="text-slate-400 text-sm uppercase tracking-wide" id="aboutStat3Label">דיסקרטיות מלאה</div>
        </div>
        <div class="text-center p-6">
            <div class="text-primary text-4xl font-black mb-2" id="aboutStat4Num">VIP</div>
            <div class="text-slate-400 text-sm uppercase tracking-wide" id="aboutStat4Label">שירות יוקרתי</div>
        </div>
    </div>
</section>

<!-- Vision Cards -->
<section class="py-20 px-6 lg:px-20">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h3 id="aboutVisionTitle" class="text-white text-4xl font-bold mb-4">החזון והשליחות שלנו</h3>
            <div class="h-1 w-24 bg-primary mx-auto rounded-full"></div>
        </div>
        <div id="visionCards" class="grid md:grid-cols-3 gap-8">
            <!-- Card 1: Integrity -->
            <div class="bg-card border border-white/10 p-8 rounded-xl hover:border-primary/40 transition-all group">
                <span class="material-symbols-outlined text-primary text-4xl mb-6 group-hover:scale-110 transition-transform block">verified_user</span>
                <h4 id="aboutCard1Title" class="text-white text-xl font-bold mb-4">אמינות ויושרה</h4>
                <p id="aboutCard1Text" class="text-slate-400">אנו מאמינים בשקיפות מלאה. כל המועמדות עוברות תהליך אימות קפדני ואישי כדי להבטיח כוונות רציניות בלבד.</p>
            </div>
            <!-- Card 2: Quality -->
            <div class="bg-card border border-white/10 p-8 rounded-xl hover:border-primary/40 transition-all group">
                <span class="material-symbols-outlined text-primary text-4xl mb-6 group-hover:scale-110 transition-transform block">diamond</span>
                <h4 id="aboutCard2Title" class="text-white text-xl font-bold mb-4">איכות ללא פשרות</h4>
                <p id="aboutCard2Text" class="text-slate-400">אנחנו מתמקדים באיכות ולא בכמות. כל התאמה מבוצעת לאחר ניתוח מעמיק של ערכים, סגנון חיים ושאיפות עתידיות.</p>
            </div>
            <!-- Card 3: Personal Guidance -->
            <div class="bg-card border border-white/10 p-8 rounded-xl hover:border-primary/40 transition-all group">
                <span class="material-symbols-outlined text-primary text-4xl mb-6 group-hover:scale-110 transition-transform block">favorite</span>
                <h4 id="aboutCard3Title" class="text-white text-xl font-bold mb-4">ליווי אישי</h4>
                <p id="aboutCard3Text" class="text-slate-400">התהליך לא מסתיים בהכרות. אנו מלווים אתכם בכל שלבי בניית הקשר, כולל סיוע לוגיסטי ותרבותי במדינות היעד.</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-20 px-6 lg:px-20 bg-surface/30">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-wrap items-center gap-12">
            <div class="flex-1 min-w-[300px]">
                <h3 id="aboutWhyTitle" class="text-primary text-3xl font-bold mb-8">למה לבחור בנו?</h3>
                <div id="aboutWhyList">
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-primary mt-1">check_circle</span>
                            <div>
                                <h5 id="aboutWhy1Title" class="text-white font-bold">גישה למאגר בלעדי</h5>
                                <p id="aboutWhy1Text" class="text-slate-400">נשים שאינן מופיעות באפליקציות הסטנדרטיות ומחפשות קשר רציני בלבד.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-primary mt-1">check_circle</span>
                            <div>
                                <h5 id="aboutWhy2Title" class="text-white font-bold">סניפים מקומיים</h5>
                                <p id="aboutWhy2Text" class="text-slate-400">צוותים פיזיים במולדובה ואוקראינה המכירים כל מועמדת באופן אישי.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <span class="material-symbols-outlined text-primary mt-1">check_circle</span>
                            <div>
                                <h5 id="aboutWhy3Title" class="text-white font-bold">התאמה תרבותית</h5>
                                <p id="aboutWhy3Text" class="text-slate-400">גישור על פערים שפתיים ותרבותיים ליצירת חיבור חלק וטבעי.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex-1 min-w-[300px]">
                <img id="aboutWhyImage" alt="Why Choose Us" class="rounded-xl shadow-2xl w-full aspect-[4/3] object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCm6jtPi3mVhqoVkuZhpmggeOtBBFXFdgeUVxX9oZv8KYSKA41m2mvsQ3SS5znKJUsvQFNbgxhVKhMkWDeDLrLJ4fPD_Taawd2PLgKoubEBQc2YUoIvlBoulRLW76WqHTO8qDhtHNv2CcIJm5p2ogjR2nEOqASTK2UV8R6s9Wi4TljGhWtjjPumXh1jNZHfxZw_hugz75clGm02va_GcXfMI36tDPGvRRpRCaT6bt4tfmPnus9JJpBSJ2fPF458IZemcMnXZZ1L-dJR"/>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 px-6" style="background: linear-gradient(135deg, #f2d00d 0%, #b89b06 100%);">
    <div class="max-w-4xl mx-auto text-center">
        <h3 id="aboutCtaTitle" class="text-3xl md:text-5xl font-black text-background-dark mb-8">מוכנים להתחיל את המסע?</h3>
        <p id="aboutCtaSubtitle" class="text-background-dark/80 text-lg md:text-xl mb-12 font-medium">צרו קשר עוד היום וגלו כיצד נוכל לעזור לכם למצוא את האהבה האמיתית.</p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a id="aboutCtaBtn1" href="<?= BASE_URL ?>/?login=1" class="bg-background-dark text-primary px-12 py-5 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all inline-block">הצטרף עכשיו</a>
            <a id="aboutCtaBtn2" href="<?= BASE_URL ?>/process" class="border-2 border-background-dark text-background-dark px-12 py-5 rounded-2xl font-bold text-xl hover:bg-background-dark/10 transition-all inline-block">תהליך השידוך</a>
        </div>
    </div>
</section>

<!-- Dynamic Settings JS -->
<script>
(async function loadAboutSettings() {
    try {
        const res = await fetch(BASE + '/api/admin/settings');
        const s = await res.json();
        // About page texts
        if (s.about_hero_title) document.getElementById('aboutHeroTitle').textContent = s.about_hero_title;
        if (s.about_hero_subtitle) document.getElementById('aboutHeroSubtitle').textContent = s.about_hero_subtitle;
        if (s.about_who_title) document.getElementById('aboutWhoTitle').textContent = s.about_who_title;
        if (s.about_who_text) document.getElementById('aboutWhoText').innerHTML = s.about_who_text.split('\n\n').map(p => `<p>${p}</p>`).join('');
        if (s.about_who_image) document.getElementById('aboutWhoImage').src = s.about_who_image;
        if (s.about_vision_title) document.getElementById('aboutVisionTitle').textContent = s.about_vision_title;
        // Vision cards
        if (s.about_card1_title) document.getElementById('aboutCard1Title').textContent = s.about_card1_title;
        if (s.about_card1_text) document.getElementById('aboutCard1Text').textContent = s.about_card1_text;
        if (s.about_card2_title) document.getElementById('aboutCard2Title').textContent = s.about_card2_title;
        if (s.about_card2_text) document.getElementById('aboutCard2Text').textContent = s.about_card2_text;
        if (s.about_card3_title) document.getElementById('aboutCard3Title').textContent = s.about_card3_title;
        if (s.about_card3_text) document.getElementById('aboutCard3Text').textContent = s.about_card3_text;
        // Stats
        if (s.about_stat1_num) document.getElementById('aboutStat1Num').textContent = s.about_stat1_num;
        if (s.about_stat1_label) document.getElementById('aboutStat1Label').textContent = s.about_stat1_label;
        if (s.about_stat2_num) document.getElementById('aboutStat2Num').textContent = s.about_stat2_num;
        if (s.about_stat2_label) document.getElementById('aboutStat2Label').textContent = s.about_stat2_label;
        if (s.about_stat3_num) document.getElementById('aboutStat3Num').textContent = s.about_stat3_num;
        if (s.about_stat3_label) document.getElementById('aboutStat3Label').textContent = s.about_stat3_label;
        if (s.about_stat4_num) document.getElementById('aboutStat4Num').textContent = s.about_stat4_num;
        if (s.about_stat4_label) document.getElementById('aboutStat4Label').textContent = s.about_stat4_label;
        // Why choose us
        if (s.about_why_title) document.getElementById('aboutWhyTitle').textContent = s.about_why_title;
        if (s.about_why_image) document.getElementById('aboutWhyImage').src = s.about_why_image;
        if (s.about_why1_title) document.getElementById('aboutWhy1Title').textContent = s.about_why1_title;
        if (s.about_why1_text) document.getElementById('aboutWhy1Text').textContent = s.about_why1_text;
        if (s.about_why2_title) document.getElementById('aboutWhy2Title').textContent = s.about_why2_title;
        if (s.about_why2_text) document.getElementById('aboutWhy2Text').textContent = s.about_why2_text;
        if (s.about_why3_title) document.getElementById('aboutWhy3Title').textContent = s.about_why3_title;
        if (s.about_why3_text) document.getElementById('aboutWhy3Text').textContent = s.about_why3_text;
        // CTA
        if (s.about_cta_title) document.getElementById('aboutCtaTitle').textContent = s.about_cta_title;
        if (s.about_cta_subtitle) document.getElementById('aboutCtaSubtitle').textContent = s.about_cta_subtitle;
        if (s.about_cta_btn1) document.getElementById('aboutCtaBtn1').textContent = s.about_cta_btn1;
        if (s.about_cta_btn2) document.getElementById('aboutCtaBtn2').textContent = s.about_cta_btn2;
    } catch(e) {
        // Settings API unavailable - use defaults
    }
})();
</script>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>
