<?php
$pageTitle = 'Moldova & Ukraine Luxury Brides - ' . t('hero_title_1') . ' ' . t('hero_title_2');
$pageDescription = t('hero_subtitle');
$currentPage = 'home';
require BASE_PATH . '/app/views/layouts/header.php';
?>

<!-- JSON-LD MatchmakingService Schema -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "MatchmakingService",
    "name": "Moldova & Ukraine Luxury Brides",
    "description": "<?= t('hero_subtitle') ?>",
    "url": "<?= BASE_URL ?>/",
    "areaServed": ["IL", "MD", "UA"],
    "availableLanguage": ["he", "en", "ru", "ro", "uk"]
}
</script>

<!-- Hero Section -->
<section class="relative min-h-[90vh] flex items-center pt-10 pb-20 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-l from-background-dark/20 via-background-dark/80 to-background-dark z-10"></div>
        <div id="homeHeroBg" class="w-full h-full bg-cover bg-center" data-alt="Stunning elegant woman in a luxury evening dress portrait" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuB2pWepEAWT8Z_x8ALk_BfWs1S5xkxSy7A0IaTOU4H4_ldVUks5I_zsoUqz0vdrt3Gm7sOx7PyS6nWtjyovUv1MSFOgBCQqf5rVthtwjwBJEjSWMUYFzRt2PzfYvOzDCQ0w7Af6_rSTjbS8kMFUQrcV-m1q5vgYfWCME6mSF2T7_8-RDP787bfGAAYWdm9NA_cxP9PIpUD7tjLD0Z_2SJNSJBaA6rZYofgAWCBL9zf9FbAlYi9Uh-wUePG6vqPvR3lAaYmsfOZ9ZLQt');"></div>
    </div>
    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
        <div class="flex flex-col gap-8 text-right">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-primary/30 bg-primary/10 w-fit">
                <span class="size-2 rounded-full bg-primary animate-pulse"></span>
                <span id="homeHeroBadge" class="text-primary text-xs font-bold tracking-widest uppercase"><?= t('hero_badge') ?></span>
            </div>
            <h1 id="homeHeroTitle" class="text-5xl md:text-7xl font-black text-white leading-tight">
                <?= t('hero_title_1') ?> <span class="text-primary italic"><?= t('hero_title_2') ?></span><br/>
                <?= t('hero_title_3') ?>
            </h1>
            <p id="homeHeroSubtitle" class="text-lg text-slate-300 max-w-xl leading-relaxed">
                <?= t('hero_subtitle') ?>
            </p>
            <div class="flex flex-wrap gap-4 mt-4">
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 p-3 rounded-xl">
                    <div class="w-10 h-7 bg-blue-600 rounded-sm relative overflow-hidden shadow-lg border border-white/20">
                        <div class="absolute bottom-0 w-full h-1/2 bg-yellow-400"></div>
                    </div>
                    <span class="text-white text-sm font-medium"><?= t('ukraine') ?></span>
                </div>
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 p-3 rounded-xl">
                    <div class="w-10 h-7 flex shadow-lg border border-white/20 overflow-hidden">
                        <div class="w-1/3 bg-blue-800 h-full"></div>
                        <div class="w-1/3 bg-yellow-400 h-full"></div>
                        <div class="w-1/3 bg-red-600 h-full"></div>
                    </div>
                    <span class="text-white text-sm font-medium"><?= t('moldova_country') ?></span>
                </div>
            </div>
        </div>

        <!-- Lead Form -->
        <div class="bg-accent-dark/95 border border-primary/20 p-8 md:p-10 rounded-2xl shadow-2xl backdrop-blur-xl">
            <h3 id="homeFormTitle" class="text-2xl font-bold text-white mb-6"><?= t('home_form_title') ?></h3>
            <form id="leadForm" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gold-muted uppercase tracking-wider"><?= t('home_form_name') ?></label>
                        <input id="fullName" class="w-full bg-white/5 border-white/10 rounded-lg py-3 px-4 text-white focus:ring-primary focus:border-primary" placeholder="" type="text" required/>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gold-muted uppercase tracking-wider"><?= t('home_form_age') ?></label>
                        <input id="age" class="w-full bg-white/5 border-white/10 rounded-lg py-3 px-4 text-white focus:ring-primary focus:border-primary" placeholder="35+" type="number"/>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gold-muted uppercase tracking-wider"><?= t('home_form_email') ?></label>
                    <input id="email" class="w-full bg-white/5 border-white/10 rounded-lg py-3 px-4 text-white focus:ring-primary focus:border-primary" placeholder="email@example.com" type="email" required/>
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gold-muted uppercase tracking-wider"><?= t('home_form_interest') ?></label>
                    <select id="interest" class="w-full bg-white/5 border-white/10 rounded-lg py-3 px-4 text-white focus:ring-primary focus:border-primary appearance-none">
                        <option><?= t('home_form_interest1') ?></option>
                        <option><?= t('home_form_interest2') ?></option>
                        <option><?= t('home_form_interest3') ?></option>
                    </select>
                </div>
                <button id="submitBtn" class="w-full py-4 bg-primary text-background-dark font-black text-lg rounded-lg shadow-[0_4px_20px_rgba(242,208,13,0.3)] hover:translate-y-[-2px] transition-all" type="submit">
                    <?= t('home_form_submit') ?>
                </button>
                <div id="formMessage" class="hidden text-center text-sm pt-2 font-bold"></div>
                <p class="text-center text-[11px] text-gold-muted pt-2 italic">
                    <?= t('home_form_disclaimer') ?>
                </p>
            </form>
        </div>
    </div>
</section>

<!-- Latest Profiles -->
<section class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="text-right">
                <h2 id="homeProfilesLabel" class="text-primary font-bold text-sm tracking-[0.3em] uppercase mb-4"><?= t('home_profiles_label') ?></h2>
                <h3 id="homeProfilesTitle" class="text-4xl font-black text-white"><?= t('home_profiles_title') ?></h3>
            </div>
            <a href="<?= BASE_URL ?>/search" class="flex items-center gap-2 text-primary font-bold border-b-2 border-primary/30 pb-1 hover:border-primary transition-all">
                <span><?= t('all_profiles') ?></span>
                <span class="material-symbols-outlined">arrow_left_alt</span>
            </a>
        </div>
        <div id="homeProfilesGrid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">
            <p class="text-slate-500 text-center col-span-full py-12"><?= t('loading_profiles') ?></p>
        </div>
    </div>
</section>

<!-- Why Us Section -->
<section class="py-24 bg-background-light dark:bg-accent-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 id="homeWhyLabel" class="text-primary font-bold text-sm tracking-[0.3em] uppercase mb-4"><?= t('home_why_label') ?></h2>
            <h3 id="homeWhyTitle" class="text-4xl md:text-5xl font-black text-white"><?= t('home_why_title') ?></h3>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="group p-8 rounded-2xl border border-white/5 bg-white/5 hover:bg-primary/5 hover:border-primary/20 transition-all text-center">
                <div class="size-16 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-background-dark transition-all">
                    <span class="material-symbols-outlined text-4xl">verified_user</span>
                </div>
                <h4 id="homeFeat1Title" class="text-xl font-bold text-white mb-4"><?= t('home_feat1_title') ?></h4>
                <p id="homeFeat1Text" class="text-gold-muted leading-relaxed">
                    <?= t('home_feat1_text') ?>
                </p>
            </div>
            <!-- Feature 2 -->
            <div class="group p-8 rounded-2xl border border-white/5 bg-white/5 hover:bg-primary/5 hover:border-primary/20 transition-all text-center">
                <div class="size-16 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-background-dark transition-all">
                    <span class="material-symbols-outlined text-4xl">travel_explore</span>
                </div>
                <h4 id="homeFeat2Title" class="text-xl font-bold text-white mb-4"><?= t('home_feat2_title') ?></h4>
                <p id="homeFeat2Text" class="text-gold-muted leading-relaxed">
                    <?= t('home_feat2_text') ?>
                </p>
            </div>
            <!-- Feature 3 -->
            <div class="group p-8 rounded-2xl border border-white/5 bg-white/5 hover:bg-primary/5 hover:border-primary/20 transition-all text-center">
                <div class="size-16 mx-auto mb-6 flex items-center justify-center rounded-2xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-background-dark transition-all">
                    <span class="material-symbols-outlined text-4xl">psychology_alt</span>
                </div>
                <h4 id="homeFeat3Title" class="text-xl font-bold text-white mb-4"><?= t('home_feat3_title') ?></h4>
                <p id="homeFeat3Text" class="text-gold-muted leading-relaxed">
                    <?= t('home_feat3_text') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="py-16 bg-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-background-dark">
            <div class="text-center">
                <div id="homeStat1Num" class="text-4xl md:text-5xl font-black mb-2">1,200+</div>
                <div id="homeStat1Label" class="text-sm font-bold uppercase tracking-wider"><?= t('home_stat1_label') ?></div>
            </div>
            <div class="text-center">
                <div id="homeStat2Num" class="text-4xl md:text-5xl font-black mb-2">15</div>
                <div id="homeStat2Label" class="text-sm font-bold uppercase tracking-wider"><?= t('home_stat2_label') ?></div>
            </div>
            <div class="text-center">
                <div id="homeStat3Num" class="text-4xl md:text-5xl font-black mb-2">98%</div>
                <div id="homeStat3Label" class="text-sm font-bold uppercase tracking-wider"><?= t('home_stat3_label') ?></div>
            </div>
            <div class="text-center">
                <div id="homeStat4Num" class="text-4xl md:text-5xl font-black mb-2">VIP</div>
                <div id="homeStat4Label" class="text-sm font-bold uppercase tracking-wider"><?= t('home_stat4_label') ?></div>
            </div>
        </div>
    </div>
</section>

<!-- Client Reviews -->
<section class="py-24 bg-accent-dark relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-[150px]"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 id="homeReviewsLabel" class="text-primary font-bold text-sm tracking-[0.3em] uppercase mb-4"><?= t('home_reviews_label') ?></h2>
            <h3 id="homeReviewsTitle" class="text-4xl md:text-5xl font-black text-white"><?= t('home_reviews_title') ?></h3>
        </div>
        <div id="reviewsGrid" class="grid md:grid-cols-3 gap-8">
            <p class="text-slate-500 text-center col-span-full py-12"><?= t('loading') ?></p>
        </div>
    </div>
</section>

<!-- Success Stories Preview -->
<section class="py-24 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div class="text-right">
                <h2 id="homeStoriesLabel" class="text-primary font-bold text-sm tracking-[0.3em] uppercase mb-4"><?= t('home_stories_label') ?></h2>
                <h3 id="homeStoriesTitle" class="text-4xl font-black text-white"><?= t('home_stories_title') ?></h3>
            </div>
            <a href="<?= BASE_URL ?>/stories" class="flex items-center gap-2 text-primary font-bold border-b-2 border-primary/30 pb-1 hover:border-primary transition-all">
                <span><?= t('all_stories') ?></span>
                <span class="material-symbols-outlined">arrow_left_alt</span>
            </a>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Story 1 -->
            <a href="<?= BASE_URL ?>/stories" class="flex flex-col gap-6 group cursor-pointer">
                <div class="relative aspect-[3/4] overflow-hidden rounded-2xl border border-white/10">
                    <img id="homeStory1Img" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Happy elegant couple on their wedding day" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRl8m3xCKcuaz8TUFEUX-F4g-FdiHONlkHeT5NQzGfQBp_qxKdKhhjG8pJR_a88IFki41XCwxiCYVlHa6IJp2SnY75wn7l_IjJjKA8Mf2kMMcKqU4NfxDivHvkarldQd028psN1yMyVDEunPp-g7dZe_cPWzS5MjE72nPTDIvphnhYc_pk_LuS-Kk0_mNrEUQx-LICl7fOVQzX0yuVwEdD-DAjDTD5yQB7eh8HFBv2sQhrAsk1_Om6SkvRGnJ9jTF4glctIa7dRi5Q"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 right-6">
                        <div id="homeStory1Badge" class="bg-primary px-3 py-1 rounded text-background-dark text-xs font-black uppercase"><?= t('home_story1_badge') ?></div>
                    </div>
                </div>
                <div class="text-right">
                    <h4 id="homeStory1Name" class="text-xl font-bold text-white mb-2"><?= t('home_story1_name') ?></h4>
                    <p id="homeStory1Text" class="text-gold-muted text-sm leading-relaxed">
                        "<?= t('home_story1_text') ?>"
                    </p>
                </div>
            </a>
            <!-- Story 2 -->
            <a href="<?= BASE_URL ?>/stories" class="flex flex-col gap-6 group cursor-pointer">
                <div class="relative aspect-[3/4] overflow-hidden rounded-2xl border border-white/10">
                    <img id="homeStory2Img" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Elegant couple holding hands at luxury event" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDXlo-gZ5PCyhKp9FmvV-ztLSrQDD5dujR-Veyk50aI8GhpQn_fZt32SM4ZZsxA7nrGPaHqzBs0N7SB6QpTF7fHY30T2h9mp7CdEuEF-lw5c-4gkUSYz0wevvP_8fs8S4dDtdGPn4-StpFsqRCTXYCKx2wevd2pYAy7dLMX7LlqgOniKjbpitcW_CRoEjuVtsmCMV9MzGgKP9Vp6sbXxOKcXQ_b3TQMb6VCUuAlgIDmaQ6bA8UwvwGSb2y6nPHqVsjB0kfX8yiI6pLh"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 right-6">
                        <div id="homeStory2Badge" class="bg-primary px-3 py-1 rounded text-background-dark text-xs font-black uppercase"><?= t('home_story2_badge') ?></div>
                    </div>
                </div>
                <div class="text-right">
                    <h4 id="homeStory2Name" class="text-xl font-bold text-white mb-2"><?= t('home_story2_name') ?></h4>
                    <p id="homeStory2Text" class="text-gold-muted text-sm leading-relaxed">
                        "<?= t('home_story2_text') ?>"
                    </p>
                </div>
            </a>
            <!-- Story 3 -->
            <a href="<?= BASE_URL ?>/stories" class="flex flex-col gap-6 group cursor-pointer">
                <div class="relative aspect-[3/4] overflow-hidden rounded-2xl border border-white/10">
                    <img id="homeStory3Img" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Beautiful couple on vacation in Europe" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBRauqP-EVXn2W_0PWxvqQvHWwly8zTFQTZcLyJ2XCeYP7qaaRWmDjQLdMljqJntd2VaDYYpRJReZ7pZX5MemNFi7apgdsYdg2aw79djeh745CjlSzPYbPXhbFJL2bdx8vNiCmg1Gd9UKSpG7WL9UCQEkKhxCIIEHJTGUeSJkvFn-jns2tERas1Qtpgq75vHW03U1fQoRPgtAn5We9i58zavtQB1dsTkJ-zHZ38T4BNKyLhsQS-XdrTmPJiisprls1_d88wm10aUanj"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-background-dark via-transparent to-transparent opacity-60"></div>
                    <div class="absolute bottom-6 right-6">
                        <div id="homeStory3Badge" class="bg-primary px-3 py-1 rounded text-background-dark text-xs font-black uppercase"><?= t('home_story3_badge') ?></div>
                    </div>
                </div>
                <div class="text-right">
                    <h4 id="homeStory3Name" class="text-xl font-bold text-white mb-2"><?= t('home_story3_name') ?></h4>
                    <p id="homeStory3Text" class="text-gold-muted text-sm leading-relaxed">
                        "<?= t('home_story3_text') ?>"
                    </p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-accent-dark relative overflow-hidden border-t border-white/5">
    <div class="absolute top-0 left-0 w-64 h-64 bg-primary/10 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <span class="material-symbols-outlined text-primary text-6xl mb-6">workspace_premium</span>
        <h2 id="homeCtaTitle" class="text-4xl md:text-5xl font-black text-white mb-8"><?= t('home_cta_title') ?></h2>
        <p id="homeCtaSubtitle" class="text-xl text-gold-muted mb-10 leading-relaxed">
            <?= t('home_cta_subtitle') ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a id="homeCtaBtn1" href="<?= BASE_URL ?>/contact" class="w-full sm:w-auto px-10 py-4 bg-primary text-background-dark font-black text-lg rounded-xl shadow-lg transition-transform hover:scale-105 inline-block text-center">
                <?= t('home_cta_btn1') ?>
            </a>
            <a id="homeCtaBtn2" href="<?= BASE_URL ?>/contact" class="w-full sm:w-auto px-10 py-4 bg-transparent border-2 border-white/20 text-white font-bold text-lg rounded-xl hover:bg-white/5 transition-all inline-block text-center">
                <?= t('home_cta_btn2') ?>
            </a>
        </div>
    </div>
</section>

<!-- Lead Form JavaScript -->
<script>
document.getElementById('leadForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = document.getElementById('submitBtn');
    const msg = document.getElementById('formMessage');
    btn.disabled = true;
    btn.textContent = T.sending;
    msg.classList.add('hidden');

    try {
        const res = await fetch(BASE + '/api/leads', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                message: (document.getElementById('interest').value || '') + (document.getElementById('age').value ? ' | ' + T.age_label_prefix + ': ' + document.getElementById('age').value : ''),
                source: 'hero_form'
            })
        });
        const data = await res.json();
        if (res.ok) {
            msg.textContent = T.home_form_success;
            msg.className = 'text-center text-sm pt-2 font-bold text-green-400';
            e.target.reset();
        } else {
            msg.textContent = data.error || T.home_form_error;
            msg.className = 'text-center text-sm pt-2 font-bold text-red-400';
        }
    } catch (err) {
        msg.textContent = T.server_error;
        msg.className = 'text-center text-sm pt-2 font-bold text-red-400';
    }
    btn.disabled = false;
    btn.textContent = T.home_form_submit;
});

// Load home page settings
(async function loadHomeSettings() {
    try {
        const res = await fetch(BASE + '/api/admin/settings');
        const s = await res.json();
        if (s.home_hero_badge) document.getElementById('homeHeroBadge').textContent = s.home_hero_badge;
        if (s.home_hero_title) document.getElementById('homeHeroTitle').innerHTML = s.home_hero_title;
        if (s.home_hero_subtitle) document.getElementById('homeHeroSubtitle').textContent = s.home_hero_subtitle;
        if (s.home_hero_bg) document.getElementById('homeHeroBg').style.backgroundImage = `url('${s.home_hero_bg}')`;
        if (s.home_form_title) document.getElementById('homeFormTitle').textContent = s.home_form_title;
        // Why us
        if (s.home_why_label) document.getElementById('homeWhyLabel').textContent = s.home_why_label;
        if (s.home_why_title) document.getElementById('homeWhyTitle').textContent = s.home_why_title;
        if (s.home_feat1_title) document.getElementById('homeFeat1Title').textContent = s.home_feat1_title;
        if (s.home_feat1_text) document.getElementById('homeFeat1Text').textContent = s.home_feat1_text;
        if (s.home_feat2_title) document.getElementById('homeFeat2Title').textContent = s.home_feat2_title;
        if (s.home_feat2_text) document.getElementById('homeFeat2Text').textContent = s.home_feat2_text;
        if (s.home_feat3_title) document.getElementById('homeFeat3Title').textContent = s.home_feat3_title;
        if (s.home_feat3_text) document.getElementById('homeFeat3Text').textContent = s.home_feat3_text;
        // Stats
        if (s.home_stat1_num) document.getElementById('homeStat1Num').textContent = s.home_stat1_num;
        if (s.home_stat1_label) document.getElementById('homeStat1Label').textContent = s.home_stat1_label;
        if (s.home_stat2_num) document.getElementById('homeStat2Num').textContent = s.home_stat2_num;
        if (s.home_stat2_label) document.getElementById('homeStat2Label').textContent = s.home_stat2_label;
        if (s.home_stat3_num) document.getElementById('homeStat3Num').textContent = s.home_stat3_num;
        if (s.home_stat3_label) document.getElementById('homeStat3Label').textContent = s.home_stat3_label;
        if (s.home_stat4_num) document.getElementById('homeStat4Num').textContent = s.home_stat4_num;
        if (s.home_stat4_label) document.getElementById('homeStat4Label').textContent = s.home_stat4_label;
        // Stories section
        if (s.home_stories_label) document.getElementById('homeStoriesLabel').textContent = s.home_stories_label;
        if (s.home_stories_title) document.getElementById('homeStoriesTitle').textContent = s.home_stories_title;
        // Story cards
        if (s.home_story1_img) document.getElementById('homeStory1Img').src = s.home_story1_img;
        if (s.home_story1_badge) document.getElementById('homeStory1Badge').textContent = s.home_story1_badge;
        if (s.home_story1_name) document.getElementById('homeStory1Name').textContent = s.home_story1_name;
        if (s.home_story1_text) document.getElementById('homeStory1Text').textContent = s.home_story1_text;
        if (s.home_story2_img) document.getElementById('homeStory2Img').src = s.home_story2_img;
        if (s.home_story2_badge) document.getElementById('homeStory2Badge').textContent = s.home_story2_badge;
        if (s.home_story2_name) document.getElementById('homeStory2Name').textContent = s.home_story2_name;
        if (s.home_story2_text) document.getElementById('homeStory2Text').textContent = s.home_story2_text;
        if (s.home_story3_img) document.getElementById('homeStory3Img').src = s.home_story3_img;
        if (s.home_story3_badge) document.getElementById('homeStory3Badge').textContent = s.home_story3_badge;
        if (s.home_story3_name) document.getElementById('homeStory3Name').textContent = s.home_story3_name;
        if (s.home_story3_text) document.getElementById('homeStory3Text').textContent = s.home_story3_text;
        // CTA
        if (s.home_cta_title) document.getElementById('homeCtaTitle').textContent = s.home_cta_title;
        if (s.home_cta_subtitle) document.getElementById('homeCtaSubtitle').textContent = s.home_cta_subtitle;
        if (s.home_cta_btn1) document.getElementById('homeCtaBtn1').textContent = s.home_cta_btn1;
        if (s.home_cta_btn2) document.getElementById('homeCtaBtn2').textContent = s.home_cta_btn2;
        // Profiles section
        if (s.home_profiles_label) document.getElementById('homeProfilesLabel').textContent = s.home_profiles_label;
        if (s.home_profiles_title) document.getElementById('homeProfilesTitle').textContent = s.home_profiles_title;
        // Reviews section
        if (s.home_reviews_label) document.getElementById('homeReviewsLabel').textContent = s.home_reviews_label;
        if (s.home_reviews_title) document.getElementById('homeReviewsTitle').textContent = s.home_reviews_title;
    } catch {}
})();

// Load client reviews
(async function loadHomeReviews() {
    try {
        const res = await fetch(BASE + '/api/reviews');
        const reviews = await res.json();
        const grid = document.getElementById('reviewsGrid');
        if (!reviews.length) {
            grid.innerHTML = `<p class="text-slate-500 text-center col-span-full py-12">${T.no_reviews_yet}</p>`;
            return;
        }
        grid.innerHTML = reviews.slice(0, 6).map(r => {
            const stars = '★'.repeat(r.rating) + '☆'.repeat(5 - r.rating);
            const initials = r.client_name.split(' ').map(w => w[0]).join('');
            return `
            <div class="bg-surface border border-white/5 rounded-2xl p-8 hover:border-primary/20 transition-all relative group">
                <div class="absolute top-6 left-6 text-primary/10 text-6xl font-black leading-none select-none">"</div>
                <div class="relative z-10">
                    <div class="text-primary text-lg mb-4 tracking-wider">${stars}</div>
                    <p class="text-slate-300 leading-relaxed mb-6 text-[15px]">"${r.review_text}"</p>
                    <div class="flex items-center gap-3 pt-4 border-t border-white/5">
                        ${r.client_photo
                            ? `<img src="${r.client_photo}" class="w-11 h-11 rounded-full object-cover border-2 border-primary/30"/>`
                            : `<div class="w-11 h-11 rounded-full bg-primary/15 flex items-center justify-center text-primary font-bold text-sm border-2 border-primary/30">${initials}</div>`
                        }
                        <div>
                            <p class="text-white font-bold text-sm">${r.client_name}</p>
                            <p class="text-slate-500 text-xs">${T.verified_client}</p>
                        </div>
                        <span class="material-symbols-outlined text-primary/30 text-xl mr-auto" style="font-variation-settings:'FILL' 1;">verified</span>
                    </div>
                </div>
            </div>`;
        }).join('');
    } catch {
        document.getElementById('reviewsGrid').innerHTML = '';
    }
})();

// Load latest 6 profiles
(async function loadHomeProfiles() {
    try {
        const res = await fetch(BASE + '/api/profiles?page=1&per_page=6');
        const data = await res.json();
        const profiles = data.profiles || [];
        const grid = document.getElementById('homeProfilesGrid');
        if (!profiles.length) {
            grid.innerHTML = `<p class="text-slate-500 text-center col-span-full py-12">${T.no_profiles_yet}</p>`;
            return;
        }
        grid.innerHTML = profiles.map(p => {
            const countryName = p.country === 'moldova' ? T.moldova_country : T.ukraine;
            const flag = p.country === 'moldova' ? '🇲🇩' : '🇺🇦';
            return `
            <a href="${BASE}/profile/${p.id}" class="group relative rounded-2xl overflow-hidden border border-white/5 hover:border-primary/40 transition-all duration-500 block">
                <div class="aspect-[3/4] relative overflow-hidden">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="${p.primary_photo || ''}" alt="${p.name}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 300 400%22><rect fill=%22%231a1810%22 width=%22300%22 height=%22400%22/><text x=%22150%22 y=%22210%22 text-anchor=%22middle%22 fill=%22%23f2d00d%22 font-size=%2260%22>${p.name[0]}</text></svg>'"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 right-0 left-0 p-4 z-10">
                        <h4 class="text-lg font-extrabold text-white drop-shadow-lg">${p.name}, ${p.age}</h4>
                        <p class="text-xs text-white/70 flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-primary" style="font-size:14px;">location_on</span>
                            ${p.city}, ${countryName} ${flag}
                        </p>
                    </div>
                    <div class="absolute inset-0 bg-primary/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
            </a>`;
        }).join('');
    } catch {
        document.getElementById('homeProfilesGrid').innerHTML = `<p class="text-red-400 text-center col-span-full py-8">${T.error_loading}</p>`;
    }
})();
</script>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>

