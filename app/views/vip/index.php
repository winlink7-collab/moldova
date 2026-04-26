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
        <div class="bg-zinc-900/80 border border-[#E5E4E2]/20 rounded-2xl p-10 flex flex-col transition-all hover:-translate-y-2 hover:shadow-[0_0_40px_rgba(229,228,226,0.1)] group">
            <div class="mb-10">
                <div class="w-12 h-12 rounded-full silver-gradient flex items-center justify-center mb-4 shadow-lg">
                    <span class="material-symbols-outlined text-background-dark font-bold">workspace_premium</span>
                </div>
                <h3 id="vipPkg1Name" class="text-3xl font-black text-[#E5E4E2] mb-2 uppercase tracking-wide">Silver VIP</h3>
                <div id="vipPkg1PriceRow" class="flex items-baseline gap-1">
                    <span id="vipPkg1Price" class="text-4xl font-black text-[#E5E4E2]">&#8362;2,900</span>
                    <span id="vipPkg1Period" class="text-slate-400 text-sm"><?= t('vip_per_month') ?></span>
                </div>
            </div>
            <ul id="vipPkg1Features" class="flex-1 space-y-5 mb-12">
                <li class="flex items-start gap-3 text-slate-300">
                    <span class="material-symbols-outlined text-[#E5E4E2] text-xl">verified_user</span>
                    <span id="vipPkg1Feat1" class="text-lg"><?= t('vip_pkg1_feat1') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-300">
                    <span class="material-symbols-outlined text-[#E5E4E2] text-xl">database</span>
                    <span id="vipPkg1Feat2" class="text-lg"><?= t('vip_pkg1_feat2') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-300">
                    <span class="material-symbols-outlined text-[#E5E4E2] text-xl">chat</span>
                    <span id="vipPkg1Feat3" class="text-lg"><?= t('vip_pkg1_feat3') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-300">
                    <span class="material-symbols-outlined text-[#E5E4E2] text-xl">filter_list</span>
                    <span id="vipPkg1Feat4" class="text-lg"><?= t('vip_pkg1_feat4') ?></span>
                </li>
            </ul>
            <button id="vipPkg1Btn" onclick="openModal('registerModal')" class="w-full py-5 bg-gradient-to-r from-[#E5E4E2] to-[#bdbdbd] text-background-dark rounded-xl font-black hover:scale-[1.02] hover:shadow-xl hover:shadow-[#E5E4E2]/30 transition-all uppercase tracking-widest text-sm shadow-lg">
                <?= t('vip_pkg1_btn') ?>
            </button>
        </div>

        <!-- Gold -->
        <div class="bg-zinc-900/90 border-2 border-primary/40 rounded-2xl p-10 flex flex-col relative scale-105 z-10 shadow-2xl shadow-primary/20 transition-all hover:shadow-primary/30">
            <div id="vipPkg2Badge" class="absolute -top-5 left-1/2 -translate-x-1/2 px-6 py-1.5 rounded-full text-sm font-black uppercase tracking-widest shadow-xl" style="background:linear-gradient(135deg,#f2d00d 0%,#b59b09 100%);color:#12110a;">
                <?= t('vip_most_popular') ?>
            </div>
            <div class="mb-10">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4 shadow-lg" style="background:linear-gradient(135deg,#f2d00d 0%,#b59b09 100%);">
                    <span class="material-symbols-outlined text-background-dark font-bold">star</span>
                </div>
                <h3 id="vipPkg2Name" class="text-3xl font-black text-primary mb-2 uppercase tracking-wide">Gold VIP</h3>
                <div id="vipPkg2PriceRow" class="flex items-baseline gap-1">
                    <span id="vipPkg2Price" class="text-5xl font-black text-primary drop-shadow-md">&#8362;5,500</span>
                    <span id="vipPkg2Period" class="text-slate-400 text-sm"><?= t('vip_per_month') ?></span>
                </div>
            </div>
            <ul id="vipPkg2Features" class="flex-1 space-y-5 mb-12">
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-primary text-xl">video_call</span>
                    <span id="vipPkg2Feat1" class="text-lg font-bold"><?= t('vip_pkg2_feat1') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-primary text-xl">person_pin</span>
                    <span id="vipPkg2Feat2" class="text-lg"><?= t('vip_pkg2_feat2') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-primary text-xl">ads_click</span>
                    <span id="vipPkg2Feat3" class="text-lg"><?= t('vip_pkg2_feat3') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-primary text-xl">translate</span>
                    <span id="vipPkg2Feat4" class="text-lg"><?= t('vip_pkg2_feat4') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-primary text-xl">add_circle</span>
                    <span id="vipPkg2Feat5" class="text-lg"><?= t('vip_pkg2_feat5') ?></span>
                </li>
            </ul>
            <button id="vipPkg2Btn" onclick="openModal('registerModal')" class="w-full py-5 rounded-xl font-black hover:scale-[1.02] transition-transform uppercase tracking-widest text-sm shadow-lg shadow-primary/20" style="background:linear-gradient(135deg,#f2d00d 0%,#b59b09 100%);color:#12110a;">
                <?= t('vip_pkg2_btn') ?>
            </button>
        </div>

        <!-- Diamond -->
        <div class="bg-zinc-900/80 border-2 border-blue-400/20 rounded-2xl p-10 flex flex-col transition-all hover:-translate-y-2 hover:shadow-[0_0_50px_rgba(59,130,246,0.2)] group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 blur-3xl rounded-full"></div>
            <div class="mb-10 relative z-10">
                <div class="w-12 h-12 rounded-full diamond-gradient flex items-center justify-center mb-4 shadow-lg shadow-blue-500/40">
                    <span class="material-symbols-outlined text-white font-bold">diamond</span>
                </div>
                <h3 id="vipPkg3Name" class="text-3xl font-black text-[#b9f2ff] mb-2 uppercase tracking-wide">Diamond VIP</h3>
                <div id="vipPkg3PriceRow" class="flex items-baseline gap-1">
                    <span id="vipPkg3Price" class="text-4xl font-black text-[#b9f2ff]">&#8362;9,900</span>
                    <span id="vipPkg3Period" class="text-slate-400 text-sm"><?= t('vip_per_month') ?></span>
                </div>
            </div>
            <ul id="vipPkg3Features" class="flex-1 space-y-5 mb-12 relative z-10">
                <li class="flex items-start gap-3 text-slate-100">
                    <span class="material-symbols-outlined text-[#b9f2ff] text-xl">flight_takeoff</span>
                    <span id="vipPkg3Feat1" class="text-lg font-bold"><?= t('vip_pkg3_feat1') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-[#b9f2ff] text-xl">concierge</span>
                    <span id="vipPkg3Feat2" class="text-lg"><?= t('vip_pkg3_feat2') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-[#b9f2ff] text-xl">all_inclusive</span>
                    <span id="vipPkg3Feat3" class="text-lg"><?= t('vip_pkg3_feat3') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-[#b9f2ff] text-xl">airport_shuttle</span>
                    <span id="vipPkg3Feat4" class="text-lg"><?= t('vip_pkg3_feat4') ?></span>
                </li>
                <li class="flex items-start gap-3 text-slate-200">
                    <span class="material-symbols-outlined text-[#b9f2ff] text-xl">lock</span>
                    <span id="vipPkg3Feat5" class="text-lg"><?= t('vip_pkg3_feat5') ?></span>
                </li>
            </ul>
            <button id="vipPkg3Btn" onclick="openModal('registerModal')" class="w-full py-5 bg-gradient-to-r from-[#b9f2ff] to-[#3b82f6] text-white rounded-xl font-black hover:scale-[1.02] hover:shadow-xl hover:shadow-blue-500/30 transition-all uppercase tracking-widest text-sm shadow-lg relative z-10">
                <?= t('vip_pkg3_btn') ?>
            </button>
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
        if (s.vip_pkg1_period) document.getElementById('vipPkg1Period').textContent = s.vip_pkg1_period;
        if (s.vip_pkg1_btn) document.getElementById('vipPkg1Btn').textContent = s.vip_pkg1_btn;
        if (s.vip_pkg1_feat1) document.getElementById('vipPkg1Feat1').textContent = s.vip_pkg1_feat1;
        if (s.vip_pkg1_feat2) document.getElementById('vipPkg1Feat2').textContent = s.vip_pkg1_feat2;
        if (s.vip_pkg1_feat3) document.getElementById('vipPkg1Feat3').textContent = s.vip_pkg1_feat3;
        if (s.vip_pkg1_feat4) document.getElementById('vipPkg1Feat4').textContent = s.vip_pkg1_feat4;
        if (s.vip_pkg1_features) {
            const lines = s.vip_pkg1_features.split('\n').filter(l => l.trim());
            document.getElementById('vipPkg1Features').innerHTML = lines.map(l => {
                const [icon, text] = l.includes('|') ? l.split('|').map(x=>x.trim()) : ['check_circle', l.trim()];
                return `<li class="flex items-start gap-3 text-slate-300"><span class="material-symbols-outlined text-[#E5E4E2] text-xl">${icon}</span><span class="text-lg">${text}</span></li>`;
            }).join('');
        }
        if (s.vip_pkg2_name) document.getElementById('vipPkg2Name').textContent = s.vip_pkg2_name;
        if (s.vip_pkg2_price) { if (s.vip_pkg2_price === 'hide' || s.vip_pkg2_price === 'הסתר') { document.getElementById('vipPkg2PriceRow').style.display = 'none'; } else { document.getElementById('vipPkg2Price').textContent = s.vip_pkg2_price; } }
        if (s.vip_pkg2_period) document.getElementById('vipPkg2Period').textContent = s.vip_pkg2_period;
        if (s.vip_pkg2_btn) document.getElementById('vipPkg2Btn').textContent = s.vip_pkg2_btn;
        if (s.vip_pkg2_badge) document.getElementById('vipPkg2Badge').textContent = s.vip_pkg2_badge;
        if (s.vip_pkg2_feat1) document.getElementById('vipPkg2Feat1').textContent = s.vip_pkg2_feat1;
        if (s.vip_pkg2_feat2) document.getElementById('vipPkg2Feat2').textContent = s.vip_pkg2_feat2;
        if (s.vip_pkg2_feat3) document.getElementById('vipPkg2Feat3').textContent = s.vip_pkg2_feat3;
        if (s.vip_pkg2_feat4) document.getElementById('vipPkg2Feat4').textContent = s.vip_pkg2_feat4;
        if (s.vip_pkg2_feat5) document.getElementById('vipPkg2Feat5').textContent = s.vip_pkg2_feat5;
        if (s.vip_pkg2_features) {
            const lines = s.vip_pkg2_features.split('\n').filter(l => l.trim());
            document.getElementById('vipPkg2Features').innerHTML = lines.map(l => {
                const [icon, text] = l.includes('|') ? l.split('|').map(x=>x.trim()) : ['check_circle', l.trim()];
                return `<li class="flex items-start gap-3 text-slate-200"><span class="material-symbols-outlined text-primary text-xl">${icon}</span><span class="text-lg">${text}</span></li>`;
            }).join('');
        }
        if (s.vip_pkg3_name) document.getElementById('vipPkg3Name').textContent = s.vip_pkg3_name;
        if (s.vip_pkg3_price) { if (s.vip_pkg3_price === 'hide' || s.vip_pkg3_price === 'הסתר') { document.getElementById('vipPkg3PriceRow').style.display = 'none'; } else { document.getElementById('vipPkg3Price').textContent = s.vip_pkg3_price; } }
        if (s.vip_pkg3_period) document.getElementById('vipPkg3Period').textContent = s.vip_pkg3_period;
        if (s.vip_pkg3_btn) document.getElementById('vipPkg3Btn').textContent = s.vip_pkg3_btn;
        if (s.vip_pkg3_feat1) document.getElementById('vipPkg3Feat1').textContent = s.vip_pkg3_feat1;
        if (s.vip_pkg3_feat2) document.getElementById('vipPkg3Feat2').textContent = s.vip_pkg3_feat2;
        if (s.vip_pkg3_feat3) document.getElementById('vipPkg3Feat3').textContent = s.vip_pkg3_feat3;
        if (s.vip_pkg3_feat4) document.getElementById('vipPkg3Feat4').textContent = s.vip_pkg3_feat4;
        if (s.vip_pkg3_feat5) document.getElementById('vipPkg3Feat5').textContent = s.vip_pkg3_feat5;
        if (s.vip_pkg3_features) {
            const lines = s.vip_pkg3_features.split('\n').filter(l => l.trim());
            document.getElementById('vipPkg3Features').innerHTML = lines.map(l => {
                const [icon, text] = l.includes('|') ? l.split('|').map(x=>x.trim()) : ['check_circle', l.trim()];
                return `<li class="flex items-start gap-3 text-slate-200"><span class="material-symbols-outlined text-[#b9f2ff] text-xl">${icon}</span><span class="text-lg">${text}</span></li>`;
            }).join('');
        }
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
