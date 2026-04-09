<?php require BASE_PATH . '/app/views/layouts/header.php'; ?>

<!-- Hero Section -->
<section class="relative overflow-hidden py-16 md:py-20 px-6">
    <div class="absolute inset-0 bg-gradient-to-b from-primary/5 via-transparent to-transparent"></div>
    <div class="max-w-[960px] mx-auto text-center md:text-right relative z-10">
        <h1 class="text-slate-100 text-5xl font-black leading-tight tracking-[-0.033em] font-display mb-4"><?= t('faq_title') ?></h1>
        <p class="text-gold-muted text-lg font-normal leading-normal max-w-2xl"><?= t('faq_full_subtitle') ?></p>
    </div>
</section>

<!-- FAQ List -->
<section class="px-6 pb-16">
<div class="max-w-[960px] mx-auto">
    <div id="faqList" class="flex flex-col gap-4">
        <p class="text-gold-muted text-center py-8"><?= t('loading_questions') ?></p>
    </div>

    <!-- CTA Box -->
    <div class="mt-16 bg-border-gold/20 border border-primary/30 rounded-2xl p-8 @container">
        <div class="flex flex-col @[600px]:flex-row items-center justify-between gap-8">
            <div class="flex flex-col gap-2 text-center @[600px]:text-right">
                <h3 class="text-slate-100 text-2xl font-bold font-display"><?= t('need_help') ?></h3>
                <p class="text-gold-muted text-base"><?= t('experts_here') ?></p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 shrink-0">
                <a href="tel:" class="bg-primary text-background-dark px-8 py-3 rounded-lg font-bold text-base hover:bg-primary/90 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">call</span>
                    <?= t('free_consultation') ?>
                </a>
                <a href="<?= BASE_URL ?>/contact" class="border border-primary text-primary px-8 py-3 rounded-lg font-bold text-base hover:bg-primary/10 transition-all flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">mail</span>
                    <?= t('send_us_message') ?>
                </a>
            </div>
        </div>
    </div>
</div>
</section>

<script>
async function loadFaqs() {
    const el = document.getElementById('faqList');
    try {
        const res = await fetch(BASE + '/api/faqs');
        const faqs = await res.json();
        if (!faqs.length) {
            el.innerHTML = `<p class="text-gold-muted text-center py-8">${T.no_faqs_yet}</p>`;
            return;
        }
        el.innerHTML = faqs.map((f, i) => `
            <details class="group flex flex-col rounded-xl border border-border-gold bg-background-dark/50 hover:bg-background-dark transition-all duration-300 px-6 py-4" ${i === 0 ? 'open' : ''}>
                <summary class="flex cursor-pointer items-center justify-between gap-6 py-2 list-none">
                    <span class="text-slate-100 text-lg font-bold leading-normal font-display">${f.question}</span>
                    <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                </summary>
                <div class="pt-4 border-t border-border-gold/30 mt-2">
                    <p class="text-gold-muted text-base font-normal leading-relaxed">${f.answer}</p>
                </div>
            </details>
        `).join('');
    } catch {
        el.innerHTML = `<p class="text-red-400 text-center py-8">${T.error_loading}</p>`;
    }
}
loadFaqs();
</script>

<?php if (!empty($isAdmin)): ?>
<!-- FAQ Edit Modal -->
<div id="faqEditModal" class="fixed inset-0 z-[10001] hidden items-center justify-center bg-black/70 backdrop-blur-sm">
<div class="relative w-full max-w-[500px] mx-4 bg-[#1c1a0e] border border-primary/30 p-8 rounded-2xl shadow-2xl" dir="rtl">
    <button onclick="closeFaqModal()" class="absolute top-4 left-4 text-slate-400 hover:text-white"><span class="material-symbols-outlined">close</span></button>
    <h3 class="text-xl font-bold text-primary mb-6" id="faqModalTitle"><?= t('add_question') ?></h3>
    <form id="faqEditForm" class="space-y-4">
        <input type="hidden" id="faqEditId"/>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('question') ?></label>
            <input id="faqEditQuestion" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" placeholder=""/>
        </div>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('answer') ?></label>
            <textarea id="faqEditAnswer" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white resize-none" rows="4" placeholder=""></textarea>
        </div>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('sort_order') ?></label>
            <input id="faqEditOrder" type="number" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" value="0"/>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="flex-1 bg-primary text-background-dark py-3 rounded-xl font-bold text-lg"><?= t('save') ?></button>
            <button type="button" onclick="closeFaqModal()" class="px-6 bg-white/10 text-slate-300 py-3 rounded-xl font-bold"><?= t('cancel') ?></button>
        </div>
    </form>
</div>
</div>

<script>
let allFaqs = [];

// Override FAQ rendering with edit/delete buttons
const origLoadFaqs = loadFaqs;
loadFaqs = async function() {
    const el = document.getElementById('faqList');
    try {
        const res = await fetch(BASE + '/api/faqs');
        allFaqs = await res.json();
        if (!allFaqs.length) {
            el.innerHTML = `<p class="text-gold-muted text-center py-8">${T.no_faqs_yet}</p>`;
        } else {
            el.innerHTML = allFaqs.map((f, i) => `
                <details class="group flex flex-col rounded-xl border border-border-gold bg-background-dark/50 hover:bg-background-dark transition-all duration-300 px-6 py-4 relative" ${i === 0 ? 'open' : ''} data-faq-id="${f.id}">
                    <div class="aie-faq-actions absolute top-3 left-3 z-10 hidden gap-2">
                        <button onclick="event.stopPropagation(); editFaq(${f.id})" class="bg-primary text-background-dark p-1.5 rounded-lg shadow-lg hover:scale-110 transition-transform"><span class="material-symbols-outlined text-sm">edit</span></button>
                        <button onclick="event.stopPropagation(); deleteFaq(${f.id})" class="bg-red-500 text-white p-1.5 rounded-lg shadow-lg hover:scale-110 transition-transform"><span class="material-symbols-outlined text-sm">delete</span></button>
                    </div>
                    <summary class="flex cursor-pointer items-center justify-between gap-6 py-2 list-none">
                        <span class="text-slate-100 text-lg font-bold leading-normal font-display">${f.question}</span>
                        <span class="material-symbols-outlined text-primary group-open:rotate-180 transition-transform">expand_more</span>
                    </summary>
                    <div class="pt-4 border-t border-border-gold/30 mt-2">
                        <p class="text-gold-muted text-base font-normal leading-relaxed">${f.answer}</p>
                    </div>
                </details>
            `).join('');
        }

        // Add "new FAQ" button
        const addBtn = document.createElement('div');
        addBtn.className = 'aie-faq-add hidden text-center py-6';
        addBtn.innerHTML = `<button onclick="openFaqModal()" class="bg-primary text-background-dark px-8 py-3 rounded-xl font-bold text-lg hover:scale-105 transition-transform">${T.add_new_question}</button>`;
        el.appendChild(addBtn);

        toggleFaqEditUI();
    } catch {
        el.innerHTML = `<p class="text-red-400 text-center py-8">${T.error_loading}</p>`;
    }
};

function toggleFaqEditUI() {
    const isEdit = document.body.classList.contains('aie-editing');
    document.querySelectorAll('.aie-faq-actions').forEach(el => el.style.display = isEdit ? 'flex' : 'none');
    document.querySelectorAll('.aie-faq-add').forEach(el => el.style.display = isEdit ? 'block' : 'none');
}

new MutationObserver(toggleFaqEditUI).observe(document.body, { attributes: true, attributeFilter: ['class'] });

function openFaqModal(faq = null) {
    document.getElementById('faqEditId').value = faq ? faq.id : '';
    document.getElementById('faqEditQuestion').value = faq ? faq.question : '';
    document.getElementById('faqEditAnswer').value = faq ? faq.answer : '';
    document.getElementById('faqEditOrder').value = faq ? (faq.sort_order || 0) : allFaqs.length;
    document.getElementById('faqModalTitle').textContent = faq ? T.edit_question : T.add_question;
    const m = document.getElementById('faqEditModal');
    m.classList.remove('hidden'); m.classList.add('flex');
}

function closeFaqModal() {
    const m = document.getElementById('faqEditModal');
    m.classList.add('hidden'); m.classList.remove('flex');
}

function editFaq(id) {
    const faq = allFaqs.find(f => f.id == id);
    if (faq) openFaqModal(faq);
}

async function deleteFaq(id) {
    if (!confirm(T.delete_question_confirm)) return;
    try {
        const res = await fetch(BASE + '/api/admin/faqs/' + id, { method: 'DELETE' });
        if (res.ok) { aieToast(T.question_deleted); loadFaqs(); }
        else { aieToast(T.delete_error, 'error'); }
    } catch(e) { aieToast(T.error, 'error'); }
}

document.getElementById('faqEditForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('faqEditId').value;
    const payload = {
        question: document.getElementById('faqEditQuestion').value,
        answer: document.getElementById('faqEditAnswer').value,
        sort_order: parseInt(document.getElementById('faqEditOrder').value) || 0
    };
    try {
        const url = id ? BASE + '/api/admin/faqs/' + id : BASE + '/api/admin/faqs';
        const method = id ? 'PUT' : 'POST';
        const res = await fetch(url, { method, headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(payload) });
        if (res.ok) {
            aieToast(id ? T.question_updated : T.question_added);
            closeFaqModal();
            loadFaqs();
        } else { const d = await res.json(); aieToast(d.error || T.error, 'error'); }
    } catch(e) { aieToast(T.error + ': ' + e.message, 'error'); }
});

document.getElementById('faqEditModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeFaqModal(); });

// Reload FAQs with edit capability
loadFaqs();
</script>
<?php endif; ?>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>
