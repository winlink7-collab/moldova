<?php require BASE_PATH . '/app/views/layouts/header.php'; ?>

<style>
    .gold-glow { box-shadow: 0 0 40px rgba(242, 208, 13, 0.08); }
</style>

<!-- Hero Section -->
<section class="relative overflow-hidden py-20 md:py-28 px-6">
    <div class="absolute inset-0 bg-gradient-to-b from-primary/5 via-transparent to-transparent"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10">
        <div class="inline-block p-3 rounded-full bg-primary/10 border border-primary/20 mb-6">
            <span class="material-symbols-outlined text-primary text-4xl">support_agent</span>
        </div>
        <h2 id="contactHeroTitle" class="text-4xl md:text-6xl font-black mb-6"><?= t('contact_hero_title') ?></h2>
        <p id="contactHeroSubtitle" class="text-xl text-slate-400 font-light max-w-2xl mx-auto leading-relaxed">
            <?= t('contact_hero_subtitle') ?>
        </p>
    </div>
</section>

<!-- Contact Info Cards + Form -->
<section class="px-6 md:px-20 pb-20">
<div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12">

    <!-- Contact Info Side -->
    <div class="lg:col-span-5 flex flex-col gap-6 order-2 lg:order-1">
        <div class="flex items-start gap-5 p-6 rounded-xl bg-surface border border-border-gold/30 gold-glow">
            <div class="bg-primary/10 p-3 rounded-lg shrink-0">
                <span class="material-symbols-outlined text-primary text-2xl">mail</span>
            </div>
            <div>
                <p class="text-slate-400 text-sm font-medium mb-1" id="contactEmailLabel"><?= t('contact_email_label') ?></p>
                <p class="text-white text-xl font-bold" id="contactEmailValue">office@moldova-ukraine.co.il</p>
            </div>
        </div>

        <div class="flex items-start gap-5 p-6 rounded-xl bg-surface border border-border-gold/30 gold-glow">
            <div class="bg-primary/10 p-3 rounded-lg shrink-0">
                <span class="material-symbols-outlined text-primary text-2xl">call</span>
            </div>
            <div>
                <p class="text-slate-400 text-sm font-medium mb-1" id="contactPhoneLabel"><?= t('contact_phone_label') ?></p>
                <p class="text-white text-xl font-bold" id="contactPhoneValue">03-1234-567</p>
            </div>
        </div>

        <div class="flex items-start gap-5 p-6 rounded-xl bg-surface border border-border-gold/30 gold-glow">
            <div class="bg-primary/10 p-3 rounded-lg shrink-0">
                <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
            </div>
            <div>
                <p class="text-slate-400 text-sm font-medium mb-1" id="contactAddressLabel"><?= t('contact_address_label') ?></p>
                <p class="text-white text-xl font-bold" id="contactAddressValue"><?= t('contact_address_default') ?></p>
            </div>
        </div>

        <div class="flex items-start gap-5 p-6 rounded-xl bg-surface border border-border-gold/30 gold-glow">
            <div class="bg-primary/10 p-3 rounded-lg shrink-0">
                <span class="material-symbols-outlined text-primary text-2xl">schedule</span>
            </div>
            <div>
                <p class="text-slate-400 text-sm font-medium mb-1" id="contactHoursLabel"><?= t('contact_hours_label') ?></p>
                <p class="text-white text-lg font-bold" id="contactHoursValue"><?= t('contact_hours_default') ?></p>
            </div>
        </div>

        <a id="contactWhatsapp" class="flex items-center justify-center gap-4 w-full py-5 bg-[#25D366] hover:bg-[#128C7E] text-white rounded-xl font-bold text-xl shadow-lg transition-all hover:scale-[1.01]" href="https://wa.me/972312345678">
            <span class="material-symbols-outlined text-3xl">chat</span>
            <span id="contactWhatsappText"><?= t('contact_whatsapp_text') ?></span>
        </a>
    </div>

    <!-- Form Side -->
    <div class="lg:col-span-7 bg-surface p-8 md:p-12 rounded-2xl border border-border-gold/30 shadow-2xl gold-glow order-1 lg:order-2">
        <h3 id="contactFormTitle" class="text-2xl font-black text-primary mb-2"><?= t('contact_form_title') ?></h3>
        <p id="contactFormSubtitle" class="text-slate-400 mb-8"><?= t('contact_form_subtitle') ?></p>
        <form id="contactForm" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-slate-300 text-sm font-bold block"><?= t('full_name') ?> *</label>
                    <input id="cfName" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none" placeholder="" type="text" required/>
                </div>
                <div class="space-y-2">
                    <label class="text-slate-300 text-sm font-bold block"><?= t('phone_number') ?> *</label>
                    <input id="cfPhone" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none text-left" dir="ltr" placeholder="050-0000000" type="tel" required/>
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-slate-300 text-sm font-bold block"><?= t('email_address') ?></label>
                <input id="cfEmail" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none text-left" dir="ltr" placeholder="example@email.com" type="email"/>
            </div>
            <div class="space-y-2">
                <label class="text-slate-300 text-sm font-bold block"><?= t('message_optional') ?></label>
                <textarea id="cfMessage" class="w-full bg-background-dark border border-border-gold/40 text-white rounded-lg px-5 py-4 focus:ring-2 focus:ring-primary focus:border-transparent placeholder:text-slate-600 transition-all outline-none resize-none" placeholder="<?= t('message_placeholder') ?>" rows="4"></textarea>
            </div>
            <button id="contactSubmitBtn" class="w-full py-5 bg-primary text-background-dark font-black text-xl rounded-xl hover:brightness-110 shadow-[0_0_20px_rgba(242,208,13,0.3)] transition-all" type="submit">
                <?= t('contact_submit_btn') ?>
            </button>
            <p id="contactDisclaimer" class="text-center text-slate-500 text-xs">
                <?= t('contact_disclaimer') ?>
            </p>
        </form>
        <div id="contactSuccess" class="hidden text-center py-12">
            <span class="material-symbols-outlined text-primary text-6xl mb-4">check_circle</span>
            <h3 class="text-2xl font-bold text-white mb-2"><?= t('contact_success_title') ?></h3>
            <p class="text-slate-400"><?= t('contact_success_text') ?></p>
        </div>
    </div>
</div>
</section>

<script>
(async function loadContactSettings() {
    try {
        const res = await fetch(BASE + '/api/admin/settings');
        const s = await res.json();
        if (s.contact_hero_title) document.getElementById('contactHeroTitle').textContent = s.contact_hero_title;
        if (s.contact_hero_subtitle) document.getElementById('contactHeroSubtitle').textContent = s.contact_hero_subtitle;
        if (s.contact_email_label) document.getElementById('contactEmailLabel').textContent = s.contact_email_label;
        if (s.contact_email_value) document.getElementById('contactEmailValue').textContent = s.contact_email_value;
        if (s.contact_phone_label) document.getElementById('contactPhoneLabel').textContent = s.contact_phone_label;
        if (s.contact_phone_value) document.getElementById('contactPhoneValue').textContent = s.contact_phone_value;
        if (s.contact_address_label) document.getElementById('contactAddressLabel').textContent = s.contact_address_label;
        if (s.contact_address_value) document.getElementById('contactAddressValue').textContent = s.contact_address_value;
        if (s.contact_hours_label) document.getElementById('contactHoursLabel').textContent = s.contact_hours_label;
        if (s.contact_hours_value) document.getElementById('contactHoursValue').textContent = s.contact_hours_value;
        if (s.contact_whatsapp_url) document.getElementById('contactWhatsapp').href = s.contact_whatsapp_url;
        if (s.contact_whatsapp_text) document.getElementById('contactWhatsappText').textContent = s.contact_whatsapp_text;
        if (s.contact_form_title) document.getElementById('contactFormTitle').textContent = s.contact_form_title;
        if (s.contact_form_subtitle) document.getElementById('contactFormSubtitle').textContent = s.contact_form_subtitle;
        if (s.contact_submit_btn) document.getElementById('contactSubmitBtn').textContent = s.contact_submit_btn;
        if (s.contact_disclaimer) document.getElementById('contactDisclaimer').textContent = s.contact_disclaimer;
    } catch {}
})();

document.getElementById('contactForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const btn = document.getElementById('contactSubmitBtn');
    btn.disabled = true;
    btn.textContent = T.sending;
    try {
        const res = await fetch(BASE + '/api/contact', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                name: document.getElementById('cfName').value,
                phone: document.getElementById('cfPhone').value,
                email: document.getElementById('cfEmail').value,
                message: document.getElementById('cfMessage').value,
            })
        });
        const data = await res.json();
        if (res.ok) {
            document.getElementById('contactForm').classList.add('hidden');
            document.getElementById('contactSuccess').classList.remove('hidden');
        } else {
            alert(data.error || T.send_error);
            btn.disabled = false;
            btn.textContent = T.contact_submit_btn;
        }
    } catch {
        alert(T.send_error);
        btn.disabled = false;
        btn.textContent = T.contact_submit_btn;
    }
});
</script>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>
