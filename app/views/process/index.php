<?php
$pageTitle = t('process_title') . ' - Moldova & Ukraine Luxury Brides';
$pageDescription = t('process_hero_subtitle');
$currentPage = 'process';
require BASE_PATH . '/app/views/layouts/header.php';
?>

<style>
.gold-gradient { background: linear-gradient(135deg, #f2d00d 0%, #b89b06 100%); color: #12110a; }
</style>

<!-- Hero -->
<section class="relative py-24 md:py-32 px-6 text-center overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[300px] h-[300px] md:w-[600px] md:h-[600px] bg-primary/5 rounded-full blur-[150px] hidden md:block"></div>
    <div class="relative z-10 max-w-4xl mx-auto">
        <span class="text-primary font-bold tracking-[0.2em] uppercase text-sm mb-4 block"><?= t('process_art') ?></span>
        <h2 id="processHeroTitle" class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight leading-tight"><?= t('process_hero_title') ?></h2>
        <p id="processHeroSubtitle" class="text-slate-400 text-lg md:text-xl mb-10 max-w-2xl mx-auto"><?= t('process_hero_subtitle') ?></p>
        <a id="processHeroBtn" href="<?= BASE_URL ?>/?login=1" class="inline-block gold-gradient text-[#12110a] px-10 py-4 rounded-xl font-extrabold text-lg hover:scale-105 transition-transform shadow-xl shadow-primary/20"><?= t('process_hero_btn') ?></a>
    </div>
</section>

<!-- Steps -->
<section class="py-20 px-6 lg:px-20">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-20">
            <h3 id="processStepsTitle" class="text-3xl md:text-5xl font-bold text-white mb-6"><?= t('process_steps_title') ?></h3>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
        </div>
        <div id="stepsContainer" class="relative space-y-20">
            <div class="hidden lg:block absolute right-1/2 top-0 bottom-0 w-[2px] bg-gradient-to-b from-primary/50 via-primary/20 to-transparent transform translate-x-1/2"></div>
            <p class="text-slate-500 text-center py-12"><?= t('loading') ?></p>
        </div>
    </div>
</section>

<script>
async function loadSteps() {
    const el = document.getElementById('stepsContainer');
    try {
        const res = await fetch(BASE + '/api/process-steps?lang=' + LANG);
        const steps = await res.json();
        if (!steps.length) { el.innerHTML = `<p class="text-slate-500 text-center py-12">${T.no_steps}</p>`; return; }

        let html = '<div class="hidden lg:block absolute right-1/2 top-0 bottom-0 w-[2px] bg-gradient-to-b from-primary/50 via-primary/20 to-transparent transform translate-x-1/2"></div>';

        steps.forEach((s, i) => {
            const isEven = i % 2 === 1;
            const hasImage = s.image_url && s.image_url.trim();

            html += `
            <div class="relative flex flex-col lg:flex-row items-center gap-12 group">
                ${isEven ? `
                <div class="lg:w-1/2 order-1">
                    ${hasImage ? `<div class="rounded-3xl overflow-hidden border border-white/10 aspect-[4/3] relative shadow-2xl">
                        <img class="w-full h-full object-cover grayscale-[30%] group-hover:grayscale-0 transition-all duration-500" src="${s.image_url}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#12110a]/60 to-transparent"></div>
                    </div>` : ''}
                </div>` : ''}

                ${!isEven ? `<div class="lg:w-1/2 order-2 lg:order-1 text-center lg:text-left">` : `<div class="lg:w-1/2 order-2 text-center lg:text-right">`}
                    <div class="inline-flex items-center justify-center size-16 rounded-2xl bg-primary/10 border border-primary/30 text-primary mb-6 transition-all group-hover:scale-110">
                        <span class="material-symbols-outlined text-4xl">${s.icon || 'star'}</span>
                    </div>
                    <h4 class="text-2xl font-bold text-white mb-4">${s.step_number}. ${s.title}</h4>
                    <p class="text-slate-400 leading-relaxed text-lg max-w-md ${!isEven ? 'ml-auto' : 'mr-auto'}">${s.description}</p>
                </div>

                <div class="absolute right-1/2 transform translate-x-1/2 hidden lg:flex items-center justify-center size-10 rounded-full bg-[#12110a] border-4 border-primary z-20">
                    <span class="text-primary font-bold text-sm">${s.step_number}</span>
                </div>

                ${!isEven && hasImage ? `
                <div class="lg:w-1/2 order-1 lg:order-2">
                    <div class="rounded-3xl overflow-hidden border border-white/10 aspect-[4/3] relative shadow-2xl">
                        <img class="w-full h-full object-cover grayscale-[30%] group-hover:grayscale-0 transition-all duration-500" src="${s.image_url}"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-[#12110a]/60 to-transparent"></div>
                    </div>
                </div>` : (!isEven ? '<div class="lg:w-1/2 order-1 lg:order-2"></div>' : '')}
            </div>`;
        });
        el.innerHTML = html;
    } catch { el.innerHTML = `<p class="text-red-400 text-center py-12">${T.error_loading}</p>`; }
}

async function loadPageSettings() {
    try {
        const res = await fetch(BASE + '/api/panel/settings');
        const s = await res.json();
        if (s.process_hero_title) document.getElementById('processHeroTitle').textContent = s.process_hero_title;
        if (s.process_hero_subtitle) document.getElementById('processHeroSubtitle').textContent = s.process_hero_subtitle;
        if (s.process_steps_title) document.getElementById('processStepsTitle').textContent = s.process_steps_title;
        if (s.process_cta_title) document.getElementById('processCtaTitle').textContent = s.process_cta_title;
        if (s.process_cta_subtitle) document.getElementById('processCtaSubtitle').textContent = s.process_cta_subtitle;
        if (s.process_hero_btn) document.getElementById('processHeroBtn').textContent = s.process_hero_btn;
        if (s.process_hero_btn_link) document.getElementById('processHeroBtn').closest('a').href = s.process_hero_btn_link;
        if (s.process_cta_btn1) document.getElementById('processCtaBtn1').textContent = s.process_cta_btn1;
        if (s.process_cta_btn1_link) document.getElementById('processCtaBtn1').closest('a').href = s.process_cta_btn1_link;
        if (s.process_cta_btn2) document.getElementById('processCtaBtn2').textContent = s.process_cta_btn2;
        if (s.process_cta_btn2_link) document.getElementById('processCtaBtn2').closest('a').href = s.process_cta_btn2_link;
    } catch {}
}

loadSteps();
loadPageSettings();
</script>

<!-- CTA -->
<section class="py-20 px-6 gold-gradient">
    <div class="max-w-4xl mx-auto text-center">
        <h3 id="processCtaTitle" class="text-3xl md:text-5xl font-black text-[#12110a] mb-8"><?= t('process_cta_title') ?></h3>
        <p id="processCtaSubtitle" class="text-[#12110a]/80 text-lg md:text-xl mb-12 font-medium"><?= t('process_cta_subtitle') ?></p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a id="processCtaBtn1" href="<?= BASE_URL ?>/?login=1" class="bg-[#12110a] text-primary px-12 py-5 rounded-2xl font-bold text-xl hover:shadow-2xl transition-all"><?= t('process_cta_btn1') ?></a>
            <a id="processCtaBtn2" href="<?= BASE_URL ?>/faq" class="border-2 border-[#12110a] text-[#12110a] px-12 py-5 rounded-2xl font-bold text-xl hover:bg-[#12110a]/10 transition-all"><?= t('process_cta_btn2') ?></a>
        </div>
    </div>
</section>

<?php if (!empty($isAdmin)): ?>
<script>
(function() {
    const origLoad = loadSteps;
    loadSteps = async function() {
        await origLoad();
        if (!document.body.classList.contains('aie-editing')) return;
        addStepEditButtons();
    };

    function addStepEditButtons() {
        const container = document.getElementById('stepsContainer');
        const addBtn = document.createElement('div');
        addBtn.className = 'text-center py-6';
        addBtn.innerHTML = `<button onclick="aieAddStep()" class="bg-primary text-background-dark px-8 py-3 rounded-xl font-bold text-lg hover:scale-105 transition-transform">${T.add_new_step}</button>`;
        container.appendChild(addBtn);
    }

    const observer = new MutationObserver(() => {
        if (document.body.classList.contains('aie-editing')) addStepEditButtons();
    });
    observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
})();

window.aieAddStep = async function() {
    const title = prompt(T.step_title_prompt);
    if (!title) return;
    const desc = prompt(T.step_desc_prompt);
    const icon = prompt(T.step_icon_prompt, 'star');
    try {
        const res = await fetch(BASE + '/api/panel/process-steps', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ title, description: desc || '', icon: icon || 'star' })
        });
        if (res.ok) { aieToast(T.step_added); loadSteps(); }
        else { const d = await res.json(); aieToast(d.error || T.error, 'error'); }
    } catch(e) { aieToast(T.error + ': ' + e.message, 'error'); }
};
</script>
<?php endif; ?>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>

