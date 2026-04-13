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
            <h1 id="homeHeroTitle" class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-black text-white leading-tight">
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
        <div class="relative bg-gradient-to-br from-[#1a1810] via-[#12110a] to-[#1a1810] border border-primary/30 p-6 md:p-8 rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.5)] backdrop-blur-xl overflow-hidden">
            <!-- Decorative gold glow -->
            <div class="absolute -top-20 -right-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-[#25D366]/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="relative">
                <div class="inline-block px-3 py-1 bg-primary/10 border border-primary/30 rounded-full mb-3">
                    <span class="text-primary text-xs font-bold tracking-widest uppercase">✨ VIP Club</span>
                </div>
                <h3 id="homeFormTitle" class="text-3xl md:text-4xl font-black mb-3" style="color:#ffffff !important; text-shadow: 0 2px 10px rgba(0,0,0,0.5);"><?= t('home_form_title') ?></h3>
                <p class="text-base md:text-lg mb-7" style="color:#e2e8f0 !important;"><?= t('home_form_subtitle') ?? 'השאירו פרטים ונחזור אליכם בוואטסאפ' ?></p>

                <form id="leadForm" class="space-y-4">
                    <div class="grid grid-cols-3 gap-3">
                        <div class="col-span-2">
                            <label class="text-sm font-bold uppercase tracking-wider mb-2 block" style="color:#ffffff !important;"><?= t('home_form_name') ?></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">person</span>
                                <input id="fullName" class="w-full bg-white/10 border-2 border-white/25 rounded-xl py-3.5 pr-11 pl-4 text-white text-base focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all placeholder:text-slate-400" placeholder="ישראל ישראלי" type="text" required/>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-bold uppercase tracking-wider mb-2 block" style="color:#ffffff !important;"><?= t('home_form_age') ?></label>
                            <input id="age" class="w-full bg-white/10 border-2 border-white/25 rounded-xl py-3.5 px-3 text-white text-center text-base focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all placeholder:text-slate-400" placeholder="35" type="number" min="18"/>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-bold uppercase tracking-wider mb-2 block" style="color:#ffffff !important;"><?= t('phone') ?? 'טלפון' ?></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[#25D366] text-xl">phone</span>
                            <input id="leadPhone" class="w-full bg-white/10 border-2 border-white/25 rounded-xl py-3.5 pr-11 pl-4 text-white text-base focus:border-[#25D366] focus:ring-2 focus:ring-[#25D366]/30 outline-none transition-all placeholder:text-slate-400" placeholder="050-1234567" type="tel" required dir="ltr"/>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-bold uppercase tracking-wider mb-2 block" style="color:#ffffff !important;"><?= t('home_form_interest') ?></label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">favorite</span>
                            <select id="interest" class="w-full bg-white/10 border-2 border-white/25 rounded-xl py-3.5 pr-11 pl-4 text-white text-base focus:border-primary focus:ring-2 focus:ring-primary/30 outline-none transition-all appearance-none cursor-pointer">
                                <option class="bg-background-dark"><?= t('home_form_interest1') ?></option>
                                <option class="bg-background-dark"><?= t('home_form_interest2') ?></option>
                                <option class="bg-background-dark"><?= t('home_form_interest3') ?></option>
                            </select>
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl pointer-events-none">expand_more</span>
                        </div>
                    </div>

                    <!-- Main CTA -->
                    <button id="submitBtn" class="relative w-full py-4 bg-gradient-to-r from-primary via-[#f9dc12] to-[#b89b06] text-background-dark font-black text-base rounded-xl shadow-[0_8px_30px_rgba(242,208,13,0.4)] hover:shadow-[0_12px_40px_rgba(242,208,13,0.6)] hover:scale-[1.02] transition-all mt-4 overflow-hidden group" type="submit">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined">send</span>
                            <?= t('home_form_submit') ?>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                    </button>

                    <!-- WhatsApp CTA -->
                    <div class="relative flex items-center gap-3 my-3">
                        <div class="flex-1 h-px bg-white/10"></div>
                        <span class="text-xs text-slate-500"><?= t('or') ?? 'או' ?></span>
                        <div class="flex-1 h-px bg-white/10"></div>
                    </div>
                    <a id="leadWhatsappBtn" href="#" class="flex items-center justify-center gap-2 w-full py-3.5 bg-gradient-to-r from-[#25D366] to-[#128C7E] text-white font-black text-base rounded-xl shadow-[0_8px_30px_rgba(37,211,102,0.3)] hover:shadow-[0_12px_40px_rgba(37,211,102,0.5)] hover:scale-[1.02] transition-all">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        <?= t('contact_whatsapp_direct') ?? 'שלח הודעה בוואטסאפ' ?>
                    </a>

                    <div id="formMessage" class="hidden text-center text-sm pt-2 font-bold"></div>
                    <p class="text-center text-xs text-slate-300 pt-2 flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm text-primary">lock</span>
                        <?= t('home_form_disclaimer') ?>
                    </p>
                </form>
            </div>
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
                phone: document.getElementById('leadPhone').value,
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

// Set WhatsApp button link from settings
(async function() {
    try {
        const res = await fetch(BASE + '/api/admin/settings');
        const s = await res.json();
        if (s.whatsapp) {
            const num = s.whatsapp.replace(/[^0-9]/g, '');
            const msg = encodeURIComponent(T.whatsapp_message || 'שלום, אני מעוניין להכיר בחורה');
            const btn = document.getElementById('leadWhatsappBtn');
            if (btn) btn.href = 'https://wa.me/' + num + '?text=' + msg;
        }
    } catch(e) {}
})();

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
        if (s.home_cta_btn1_link) document.getElementById('homeCtaBtn1').href = s.home_cta_btn1_link;
        if (s.home_cta_btn2) document.getElementById('homeCtaBtn2').textContent = s.home_cta_btn2;
        if (s.home_cta_btn2_link) document.getElementById('homeCtaBtn2').href = s.home_cta_btn2_link;
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
        grid.innerHTML = profiles.map(rawP => {
            const p = (typeof translateProfile === 'function') ? translateProfile(rawP, LANG) : rawP;
            const countryName = p.country === 'moldova' ? T.moldova_country : T.ukraine;
            const flag = p.country === 'moldova' ? '🇲🇩' : '🇺🇦';
            const cityT = (typeof autoTranslate === 'function') ? autoTranslate(p.city || '', LANG) : (p.city || '');
            return `
            <a href="${BASE}/profile/${p.id}" class="group relative rounded-2xl overflow-hidden border border-white/5 hover:border-primary/40 transition-all duration-500 block">
                <div class="aspect-[3/4] relative overflow-hidden">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="${p.primary_photo || ''}" alt="${p.name}" loading="lazy" onerror="this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 300 400%22><rect fill=%22%231a1810%22 width=%22300%22 height=%22400%22/><text x=%22150%22 y=%22210%22 text-anchor=%22middle%22 fill=%22%23f2d00d%22 font-size=%2260%22>${p.name[0]}</text></svg>'"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-0 right-0 left-0 p-4 z-10">
                        <h4 class="text-lg font-extrabold text-white drop-shadow-lg">${p.name}, ${p.age}</h4>
                        <p class="text-xs text-white/70 flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-primary" style="font-size:14px;">location_on</span>
                            ${cityT}, ${countryName} ${flag}
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

