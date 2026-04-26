<?php
$pageTitle = t('vip_title') . ' - Moldova & Ukraine Luxury Brides';
$pageDescription = t('vip_hero_subtitle');
$currentPage = 'vip';
require BASE_PATH . '/app/views/layouts/header.php';
?>

<style>
.gold-gradient { background: linear-gradient(135deg, #f2d00d 0%, #b59b09 100%); color: #12110a; }
.silver-gradient { background: linear-gradient(135deg, #e5e7eb 0%, #9ca3af 50%, #4b5563 100%); }
.diamond-gradient { background: linear-gradient(135deg, #b9f2ff 0%, #3b82f6 50%, #1d4ed8 100%); }
</style>

<!-- Hero -->
<section class="relative py-24 md:py-32 px-6 text-center overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[300px] h-[300px] md:w-[600px] md:h-[600px] bg-primary/5 rounded-full blur-[150px] hidden md:block"></div>
    <div class="relative z-10 max-w-4xl mx-auto">
        <span id="vipHeroBadge" class="text-primary font-bold tracking-[0.2em] uppercase text-sm mb-4 block"><?= t('vip_hero_badge') ?></span>
        <h2 id="vipHeroTitle" class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight leading-tight"><?= t('vip_hero_title') ?></h2>
        <p id="vipHeroSubtitle" class="text-slate-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto"><?= t('vip_hero_subtitle') ?></p>
    </div>
</section>

<!-- Packages -->
<section class="max-w-7xl mx-auto px-6 pb-20 -mt-10 relative z-30">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">

        <!-- Silver -->
        <div class="rounded-2xl overflow-hidden flex flex-col transition-all hover:-translate-y-2 shadow-2xl" style="background:#f8f8f5;border:2px solid #c0c0c0;">
            <div class="py-6 px-8 text-center" style="background:linear-gradient(135deg,#c0c0c0 0%,#8a8a8a 100%);">
                <span class="material-symbols-outlined text-white text-4xl mb-2 block">workspace_premium</span>
                <h3 id="vipPkg1Name" class="text-2xl font-black text-white uppercase tracking-wide">חבילת Silver</h3>
            </div>
            <div class="flex-1 p-8 flex flex-col">
                <p id="vipPkg1Desc" class="text-gray-700 text-base leading-relaxed mb-6" style="color:#333 !important;">4 מפגשים, 2 דייטים, 14 פרופילים מומלצים בחו"ל, הכנה אישית למפגשים, ליווי אישי צמוד בתקופת המפגשים.</p>
                <div class="flex-1"></div>
                <div id="vipPkg1PriceRow" class="border-t border-gray-200 pt-6 mt-4 text-center">
                    <span class="text-gray-500 text-sm" style="color:#666 !important;">מחיר:</span>
                    <span id="vipPkg1Price" class="text-3xl font-black mr-2" style="color:#333 !important;">₪5,900</span>
                    <span id="vipPkg1Period" class="text-gray-400 text-sm" style="color:#999 !important;">(4 מפגשים)</span>
                </div>
                <button id="vipPkg1Btn" onclick="openModal('registerModal')" class="w-full mt-6 py-4 rounded-xl font-black text-white text-sm uppercase tracking-widest shadow-lg hover:scale-[1.02] transition-all" style="background:linear-gradient(135deg,#c0c0c0 0%,#8a8a8a 100%);">
                    <?= t('vip_pkg1_btn') ?>
                </button>
            </div>
        </div>

        <!-- Gold -->
        <div class="rounded-2xl overflow-hidden flex flex-col relative transition-all hover:-translate-y-2 shadow-2xl scale-105 z-10" style="background:#f8f8f5;border:3px solid #f2d00d;">
            <div id="vipPkg2Badge" class="absolute -top-0 left-1/2 -translate-x-1/2 px-6 py-1 rounded-b-lg text-xs font-black uppercase tracking-widest shadow-md z-20" style="background:#f2d00d;color:#12110a;">
                <?= t('vip_most_popular') ?>
            </div>
            <div class="py-6 px-8 text-center" style="background:linear-gradient(135deg,#f2d00d 0%,#b59b09 100%);">
                <span class="material-symbols-outlined text-4xl mb-2 block" style="color:#12110a;">star</span>
                <h3 id="vipPkg2Name" class="text-2xl font-black uppercase tracking-wide" style="color:#12110a;">חבילת Gold</h3>
            </div>
            <div class="flex-1 p-8 flex flex-col">
                <p id="vipPkg2Desc" class="text-gray-700 text-base leading-relaxed mb-6" style="color:#333 !important;">4 מפגשים, 3 דייטים, ביקור מותאם אישית של 3-4 ימים, הכנה והכוונה למפגשים אישיים, ליווי צמוד בכל שלב כולל תרגום.</p>
                <div class="flex-1"></div>
                <div id="vipPkg2PriceRow" class="border-t border-gray-200 pt-6 mt-4 text-center">
                    <span class="text-gray-500 text-sm" style="color:#666 !important;">מחיר:</span>
                    <span id="vipPkg2Price" class="text-3xl font-black mr-2" style="color:#b59b09 !important;">₪7,500</span>
                    <span id="vipPkg2Period" class="text-gray-400 text-sm" style="color:#999 !important;">(4 מפגשים)</span>
                </div>
                <button id="vipPkg2Btn" onclick="openModal('registerModal')" class="w-full mt-6 py-4 rounded-xl font-black text-sm uppercase tracking-widest shadow-lg hover:scale-[1.02] transition-all" style="background:linear-gradient(135deg,#f2d00d 0%,#b59b09 100%);color:#12110a;">
                    <?= t('vip_pkg2_btn') ?>
                </button>
            </div>
        </div>

        <!-- VIP -->
        <div class="rounded-2xl overflow-hidden flex flex-col transition-all hover:-translate-y-2 shadow-2xl" style="background:#f8f8f5;border:2px solid #2563eb;">
            <div class="py-6 px-8 text-center" style="background:linear-gradient(135deg,#3b82f6 0%,#1d4ed8 100%);">
                <span class="material-symbols-outlined text-white text-4xl mb-2 block">diamond</span>
                <h3 id="vipPkg3Name" class="text-2xl font-black text-white uppercase tracking-wide">חבילת VIP</h3>
            </div>
            <div class="flex-1 p-8 flex flex-col">
                <p id="vipPkg3Desc" class="text-gray-700 text-base leading-relaxed mb-6" style="color:#333 !important;">4 מפגשים מעמיקים, 4-5 דייטים, 5 פרופילים מותאמים אישית ובלעדי, מסלולים בנויים בהתאמה אישית, ליווי VIP אישי מלא כולל תרגום, אפשרות למפגשים נוספים.</p>
                <div class="flex-1"></div>
                <div id="vipPkg3PriceRow" class="border-t border-gray-200 pt-6 mt-4 text-center">
                    <span class="text-gray-500 text-sm" style="color:#666 !important;">מחיר:</span>
                    <span id="vipPkg3Price" class="text-3xl font-black mr-2" style="color:#1d4ed8 !important;">₪10,000</span>
                    <span id="vipPkg3Period" class="text-gray-400 text-sm" style="color:#999 !important;">(4 מפגשים)</span>
                </div>
                <button id="vipPkg3Btn" onclick="openModal('registerModal')" class="w-full mt-6 py-4 rounded-xl font-black text-white text-sm uppercase tracking-widest shadow-lg hover:scale-[1.02] transition-all" style="background:linear-gradient(135deg,#3b82f6 0%,#1d4ed8 100%);">
                    <?= t('vip_pkg3_btn') ?>
                </button>
            </div>
        </div>

    </div>
</section>

<!-- Why Choose Us -->
<section class="max-w-7xl mx-auto px-6 py-24 bg-zinc-900/40 rounded-[3rem] mb-20 border border-primary/10 backdrop-blur-sm">
    <div class="text-center mb-20">
        <h2 id="vipWhyTitle" class="text-4xl md:text-5xl font-black text-white mb-6"><?= t('vip_why_title') ?></h2>
        <div class="w-24 h-1 gold-gradient mx-auto mb-6 rounded-full"></div>
        <p id="vipWhySubtitle" class="text-xl text-slate-400 max-w-2xl mx-auto font-light"><?= t('vip_why_subtitle') ?></p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
        <div class="text-center flex flex-col items-center group">
            <div class="w-20 h-20 rounded-full border border-primary/20 flex items-center justify-center mb-8 transition-all group-hover:border-primary/60 group-hover:shadow-[0_0_20px_rgba(242,208,13,0.2)]">
                <span id="vipFeat1Icon" class="material-symbols-outlined text-primary text-4xl">shield_person</span>
            </div>
            <h4 id="vipFeat1Title" class="text-2xl font-bold text-white mb-4"><?= t('vip_feat1_title') ?></h4>
            <p id="vipFeat1Text" class="text-slate-400 text-lg leading-relaxed font-light"><?= t('vip_feat1_text') ?></p>
        </div>
        <div class="text-center flex flex-col items-center group">
            <div class="w-20 h-20 rounded-full border border-primary/20 flex items-center justify-center mb-8 transition-all group-hover:border-primary/60 group-hover:shadow-[0_0_20px_rgba(242,208,13,0.2)]">
                <span id="vipFeat2Icon" class="material-symbols-outlined text-primary text-4xl">handshake</span>
            </div>
            <h4 id="vipFeat2Title" class="text-2xl font-bold text-white mb-4"><?= t('vip_feat2_title') ?></h4>
            <p id="vipFeat2Text" class="text-slate-400 text-lg leading-relaxed font-light"><?= t('vip_feat2_text') ?></p>
        </div>
        <div class="text-center flex flex-col items-center group">
            <div class="w-20 h-20 rounded-full border border-primary/20 flex items-center justify-center mb-8 transition-all group-hover:border-primary/60 group-hover:shadow-[0_0_20px_rgba(242,208,13,0.2)]">
                <span id="vipFeat3Icon" class="material-symbols-outlined text-primary text-4xl">encrypted</span>
            </div>
            <h4 id="vipFeat3Title" class="text-2xl font-bold text-white mb-4"><?= t('vip_feat3_title') ?></h4>
            <p id="vipFeat3Text" class="text-slate-400 text-lg leading-relaxed font-light"><?= t('vip_feat3_text') ?></p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-accent-dark relative overflow-hidden border-t border-white/5 mb-0">
    <div class="absolute top-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <span class="material-symbols-outlined text-primary text-6xl mb-6">workspace_premium</span>
        <h2 id="vipCtaTitle" class="text-4xl md:text-5xl font-black text-white mb-8"><?= t('vip_cta_title') ?></h2>
        <p id="vipCtaSubtitle" class="text-xl text-gold-muted mb-10 leading-relaxed"><?= t('vip_cta_subtitle') ?></p>
        <button id="vipCtaBtn" onclick="openModal('registerModal')" class="px-12 py-5 gold-gradient rounded-2xl font-black text-xl hover:scale-105 transition-all shadow-2xl shadow-primary/30 active:scale-95">
            <?= t('vip_cta_btn') ?>
        </button>
    </div>
</section>

<script>
(async function loadVipPage() {
    try {
        const res = await fetch(BASE + '/api/panel/settings?t=' + Date.now());
        const s = await res.json();
        console.log('[VIP] Settings loaded, total keys:', Object.keys(s).length,
            'pkg1_price:', JSON.stringify(s.vip_pkg1_price),
            'pkg1_name:', JSON.stringify(s.vip_pkg1_name));
        if (s.vip_hero_badge) document.getElementById('vipHeroBadge').textContent = s.vip_hero_badge;
        if (s.vip_hero_title) document.getElementById('vipHeroTitle').textContent = s.vip_hero_title;
        if (s.vip_hero_subtitle) document.getElementById('vipHeroSubtitle').textContent = s.vip_hero_subtitle;
        if (s.vip_pkg1_name) document.getElementById('vipPkg1Name').textContent = s.vip_pkg1_name;
        if (s.vip_pkg1_price) { if (s.vip_pkg1_price === 'hide' || s.vip_pkg1_price === 'הסתר') { document.getElementById('vipPkg1PriceRow').style.display = 'none'; } else { document.getElementById('vipPkg1Price').textContent = s.vip_pkg1_price; } }
        if (s.vip_pkg1_period !== undefined) { if (!s.vip_pkg1_period || s.vip_pkg1_period === 'hide' || s.vip_pkg1_period === 'הסתר') { document.getElementById('vipPkg1Period').style.display = 'none'; } else { document.getElementById('vipPkg1Period').textContent = s.vip_pkg1_period; } }
        if (s.vip_pkg1_btn) document.getElementById('vipPkg1Btn').textContent = s.vip_pkg1_btn;
        if (s.vip_pkg1_desc) document.getElementById('vipPkg1Desc').textContent = s.vip_pkg1_desc;
        if (s.vip_pkg2_name) document.getElementById('vipPkg2Name').textContent = s.vip_pkg2_name;
        if (s.vip_pkg2_price) { if (s.vip_pkg2_price === 'hide' || s.vip_pkg2_price === 'הסתר') { document.getElementById('vipPkg2PriceRow').style.display = 'none'; } else { document.getElementById('vipPkg2Price').textContent = s.vip_pkg2_price; } }
        if (s.vip_pkg2_period !== undefined) { if (!s.vip_pkg2_period || s.vip_pkg2_period === 'hide' || s.vip_pkg2_period === 'הסתר') { document.getElementById('vipPkg2Period').style.display = 'none'; } else { document.getElementById('vipPkg2Period').textContent = s.vip_pkg2_period; } }
        if (s.vip_pkg2_btn) document.getElementById('vipPkg2Btn').textContent = s.vip_pkg2_btn;
        if (s.vip_pkg2_badge) document.getElementById('vipPkg2Badge').textContent = s.vip_pkg2_badge;
        if (s.vip_pkg2_desc) document.getElementById('vipPkg2Desc').textContent = s.vip_pkg2_desc;
        if (s.vip_pkg3_name) document.getElementById('vipPkg3Name').textContent = s.vip_pkg3_name;
        if (s.vip_pkg3_price) { if (s.vip_pkg3_price === 'hide' || s.vip_pkg3_price === 'הסתר') { document.getElementById('vipPkg3PriceRow').style.display = 'none'; } else { document.getElementById('vipPkg3Price').textContent = s.vip_pkg3_price; } }
        if (s.vip_pkg3_period !== undefined) { if (!s.vip_pkg3_period || s.vip_pkg3_period === 'hide' || s.vip_pkg3_period === 'הסתר') { document.getElementById('vipPkg3Period').style.display = 'none'; } else { document.getElementById('vipPkg3Period').textContent = s.vip_pkg3_period; } }
        if (s.vip_pkg3_btn) document.getElementById('vipPkg3Btn').textContent = s.vip_pkg3_btn;
        if (s.vip_pkg3_desc) document.getElementById('vipPkg3Desc').textContent = s.vip_pkg3_desc;
        if (s.vip_why_title) document.getElementById('vipWhyTitle').textContent = s.vip_why_title;
        if (s.vip_why_subtitle) document.getElementById('vipWhySubtitle').textContent = s.vip_why_subtitle;
        if (s.vip_feat1_icon) document.getElementById('vipFeat1Icon').textContent = s.vip_feat1_icon;
        if (s.vip_feat1_title) document.getElementById('vipFeat1Title').textContent = s.vip_feat1_title;
        if (s.vip_feat1_text) document.getElementById('vipFeat1Text').textContent = s.vip_feat1_text;
        if (s.vip_feat2_icon) document.getElementById('vipFeat2Icon').textContent = s.vip_feat2_icon;
        if (s.vip_feat2_title) document.getElementById('vipFeat2Title').textContent = s.vip_feat2_title;
        if (s.vip_feat2_text) document.getElementById('vipFeat2Text').textContent = s.vip_feat2_text;
        if (s.vip_feat3_icon) document.getElementById('vipFeat3Icon').textContent = s.vip_feat3_icon;
        if (s.vip_feat3_title) document.getElementById('vipFeat3Title').textContent = s.vip_feat3_title;
        if (s.vip_feat3_text) document.getElementById('vipFeat3Text').textContent = s.vip_feat3_text;
        if (s.vip_cta_title) document.getElementById('vipCtaTitle').textContent = s.vip_cta_title;
        if (s.vip_cta_subtitle) document.getElementById('vipCtaSubtitle').textContent = s.vip_cta_subtitle;
        if (s.vip_cta_btn) document.getElementById('vipCtaBtn').textContent = s.vip_cta_btn;
        console.log('[VIP] Settings applied OK');
    } catch(err) {
        console.error('[VIP] Settings load FAILED:', err);
    }
})();
</script>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>
