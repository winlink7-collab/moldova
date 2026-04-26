<?php
$pageTitle = t('stories_title') . ' - Moldova & Ukraine Luxury Brides';
$pageDescription = t('stories_hero_subtitle');
$currentPage = 'stories';
require BASE_PATH . '/app/views/layouts/header.php';
?>

<style>
.gold-gradient-text { background: linear-gradient(to right, #f2d00d, #b89b06); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
.premium-border { border: 1px solid rgba(242, 208, 13, 0.2); }
</style>

<!-- Hero Section -->
<section class="py-16 md:py-24 px-6 text-center">
    <div class="max-w-4xl mx-auto">
        <h2 id="storiesHeroTitle" class="text-4xl md:text-6xl font-black mb-6 gold-gradient-text"><?= t('stories_hero_title') ?></h2>
        <p id="storiesHeroSubtitle" class="text-xl text-slate-400 font-light max-w-2xl mx-auto">
            <?= t('stories_hero_subtitle') ?>
        </p>
    </div>
</section>

<!-- Stories Grid -->
<section class="px-6 md:px-20 pb-20">
    <div id="storiesGrid" class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <p class="text-slate-500 text-center col-span-full py-12"><?= t('loading_stories') ?></p>
    </div>
</section>

<script>
async function loadStories() {
    const grid = document.getElementById('storiesGrid');
    try {
        const res = await fetch(BASE + '/api/stories?lang=' + LANG);
        const stories = await res.json();
        if (!stories.length) {
            grid.innerHTML = `<p class="text-slate-500 text-center col-span-full py-12">${T.no_stories_yet}</p>`;
            return;
        }
        grid.innerHTML = stories.map(s => `
            <div class="group bg-surface premium-border rounded-xl overflow-hidden transition-transform hover:scale-[1.02]">
                <div class="h-[400px] w-full bg-cover bg-center transition-transform group-hover:scale-110 duration-500" style="background-image: url('${s.image_url || ''}'); background-color: #1c1a0e;">
                    ${!s.image_url ? '<div class="h-full flex items-center justify-center"><span class="material-symbols-outlined text-primary text-7xl">favorite</span></div>' : ''}
                </div>
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-3">
                        <h3 class="text-2xl font-bold text-primary" data-translate data-translate-src="${(s.couple_names||'').replace(/"/g,'&quot;')}">${s.couple_names}</h3>
                        ${s.badge ? `<span class="text-[10px] bg-primary/20 text-primary px-2 py-0.5 rounded-full font-bold" data-translate data-translate-src="${(s.badge||'').replace(/"/g,'&quot;')}">${s.badge}</span>` : ''}
                    </div>
                    <p class="text-slate-300 leading-relaxed italic mb-6" data-translate data-translate-src="${(s.story||'').replace(/"/g,'&quot;')}">"${s.story}"</p>
                </div>
            </div>
        `).join('');
        if (typeof applyRemoteTranslations === 'function') applyRemoteTranslations(grid);
    } catch (err) {
        grid.innerHTML = `<p class="text-red-400 text-center col-span-full py-12">${T.error_loading_stories}</p>`;
    }
}
loadStories();

(async function loadStoriesSettings() {
    try {
        const res = await fetch(BASE + '/api/panel/settings');
        const s = await res.json();
        if (s.stories_hero_title) document.getElementById('storiesHeroTitle').textContent = s.stories_hero_title;
        if (s.stories_hero_subtitle) document.getElementById('storiesHeroSubtitle').textContent = s.stories_hero_subtitle;
        if (s.stories_cta_title) document.getElementById('storiesCtaTitle').textContent = s.stories_cta_title;
        if (s.stories_cta_subtitle) document.getElementById('storiesCtaSubtitle').textContent = s.stories_cta_subtitle;
        if (s.stories_cta_btn) document.getElementById('storiesCtaBtn').textContent = s.stories_cta_btn;
    } catch {}
})();
</script>

<!-- CTA Section -->
<section class="bg-surface py-20 px-6 border-y border-border-gold">
    <div class="max-w-4xl mx-auto text-center">
        <h2 id="storiesCtaTitle" class="text-3xl md:text-5xl font-extrabold text-slate-100 mb-8 leading-tight"><?= t('stories_cta_title') ?></h2>
        <p id="storiesCtaSubtitle" class="text-lg text-slate-400 mb-10">
            <?= t('stories_cta_subtitle') ?>
        </p>
        <button id="storiesCtaBtn" onclick="openModal('registerModal')" class="bg-primary text-background-dark text-xl font-black px-12 py-5 rounded-full shadow-[0_0_30px_rgba(242,208,13,0.3)] hover:shadow-[0_0_50px_rgba(242,208,13,0.5)] transition-all transform hover:-translate-y-1">
            <?= t('stories_cta_btn') ?>
        </button>
    </div>
</section>

<?php if (!empty($isAdmin)): ?>
<!-- Story Edit Modal -->
<div id="storyEditModal" class="fixed inset-0 z-[10001] hidden items-center justify-center bg-black/70 backdrop-blur-sm">
<div class="relative w-full max-w-[550px] mx-4 bg-[#1c1a0e] border border-primary/30 p-8 rounded-2xl shadow-2xl max-h-[90vh] overflow-y-auto" dir="rtl">
    <button onclick="closeStoryModal()" class="absolute top-4 left-4 text-slate-400 hover:text-white"><span class="material-symbols-outlined">close</span></button>
    <h3 class="text-xl font-bold text-primary mb-6" id="storyModalTitle"><?= t('add_story') ?></h3>
    <form id="storyEditForm" class="space-y-4">
        <input type="hidden" id="storyEditId"/>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('couple_names') ?></label>
            <input id="storyEditNames" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" placeholder=""/>
        </div>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('story_title') ?></label>
            <input id="storyEditTitle" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white" placeholder=""/>
        </div>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('the_story') ?></label>
            <textarea id="storyEditText" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white resize-none" rows="4" placeholder=""></textarea>
        </div>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('image') ?></label>
            <div class="flex gap-3 items-center">
                <input id="storyEditImage" class="flex-1 bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white text-sm" placeholder="URL"/>
                <button type="button" onclick="uploadStoryImage()" class="bg-primary/20 text-primary px-4 py-3 rounded-lg font-bold text-sm hover:bg-primary/30"><?= t('upload') ?></button>
            </div>
            <input type="file" id="storyImageFile" accept="image/*" class="hidden"/>
        </div>
        <div class="space-y-1">
            <label class="text-sm text-slate-300 font-bold"><?= t('wedding_date') ?></label>
            <input id="storyEditDate" type="date" class="w-full bg-white/5 border border-white/15 rounded-lg px-4 py-3 text-white"/>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="flex-1 bg-primary text-background-dark py-3 rounded-xl font-bold text-lg"><?= t('save') ?></button>
            <button type="button" onclick="closeStoryModal()" class="px-6 bg-white/10 text-slate-300 py-3 rounded-xl font-bold"><?= t('cancel') ?></button>
        </div>
    </form>
</div>
</div>

<script>
const origLoadStories = loadStories;
loadStories = async function() {
    const grid = document.getElementById('storiesGrid');
    try {
        const res = await fetch(BASE + '/api/stories?lang=' + LANG);
        const stories = await res.json();
        if (!stories.length) {
            grid.innerHTML = `<p class="text-slate-500 text-center col-span-full py-12">${T.no_stories_yet}</p>`;
        } else {
            grid.innerHTML = stories.map(s => `
                <div class="group bg-surface premium-border rounded-xl overflow-hidden transition-transform hover:scale-[1.02] relative" data-story-id="${s.id}">
                    <div class="aie-story-actions absolute top-3 right-3 z-20 hidden gap-2">
                        <button onclick="editStory(${s.id})" class="bg-primary text-background-dark p-2 rounded-lg shadow-lg hover:scale-110 transition-transform"><span class="material-symbols-outlined text-sm">edit</span></button>
                        <button onclick="deleteStory(${s.id})" class="bg-red-500 text-white p-2 rounded-lg shadow-lg hover:scale-110 transition-transform"><span class="material-symbols-outlined text-sm">delete</span></button>
                    </div>
                    <div class="h-[400px] w-full bg-cover bg-center transition-transform group-hover:scale-110 duration-500" style="background-image: url('${s.image_url || ''}'); background-color: #1c1a0e;">
                        ${!s.image_url ? '<div class="h-full flex items-center justify-center"><span class="material-symbols-outlined text-primary text-7xl">favorite</span></div>' : ''}
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-3">
                            <h3 class="text-2xl font-bold text-primary" data-translate data-translate-src="${(s.couple_names||'').replace(/"/g,'&quot;')}">${s.couple_names}</h3>
                        </div>
                        <p class="text-slate-300 leading-relaxed italic mb-6" data-translate data-translate-src="${(s.story||'').replace(/"/g,'&quot;')}">"${s.story}"</p>
                    </div>
                </div>
            `).join('');
        }

        const addCard = document.createElement('div');
        addCard.className = 'aie-story-add hidden bg-surface/50 premium-border rounded-xl flex items-center justify-center min-h-[300px] cursor-pointer hover:bg-surface transition-all border-2 border-dashed border-primary/30 hover:border-primary/60';
        addCard.innerHTML = `<div class="text-center"><span class="material-symbols-outlined text-primary text-5xl mb-3">add_circle</span><p class="text-primary font-bold text-lg">${T.add_new_story}</p></div>`;
        addCard.onclick = () => openStoryModal();
        grid.appendChild(addCard);
        if (typeof applyRemoteTranslations === 'function') applyRemoteTranslations(grid);

        toggleStoryEditUI();
    } catch (err) {
        grid.innerHTML = `<p class="text-red-400 text-center col-span-full py-12">${T.error_loading_stories}</p>`;
    }
};

function toggleStoryEditUI() {
    const isEdit = document.body.classList.contains('aie-editing');
    document.querySelectorAll('.aie-story-actions').forEach(el => el.style.display = isEdit ? 'flex' : 'none');
    document.querySelectorAll('.aie-story-add').forEach(el => el.style.display = isEdit ? 'flex' : 'none');
}

new MutationObserver(toggleStoryEditUI).observe(document.body, { attributes: true, attributeFilter: ['class'] });

let allStories = [];
async function fetchStories() {
    const res = await fetch(BASE + '/api/stories?lang=' + LANG);
    allStories = await res.json();
    return allStories;
}

function openStoryModal(story = null) {
    document.getElementById('storyEditId').value = story ? story.id : '';
    document.getElementById('storyEditNames').value = story ? story.couple_names : '';
    document.getElementById('storyEditTitle').value = story ? (story.title || '') : '';
    document.getElementById('storyEditText').value = story ? story.story : '';
    document.getElementById('storyEditImage').value = story ? (story.image_url || '') : '';
    document.getElementById('storyEditDate').value = story ? (story.wedding_date || '') : '';
    document.getElementById('storyModalTitle').textContent = story ? T.edit_story : T.add_story;
    const m = document.getElementById('storyEditModal');
    m.classList.remove('hidden'); m.classList.add('flex');
}

function closeStoryModal() {
    const m = document.getElementById('storyEditModal');
    m.classList.add('hidden'); m.classList.remove('flex');
}

async function editStory(id) {
    if (!allStories.length) await fetchStories();
    const story = allStories.find(s => s.id == id);
    if (story) openStoryModal(story);
}

async function deleteStory(id) {
    if (!confirm(T.delete_story_confirm)) return;
    try {
        const res = await fetch(BASE + '/api/panel/stories/' + id, { method: 'DELETE' });
        if (res.ok) { aieToast(T.story_deleted); loadStories(); }
        else { aieToast(T.delete_error, 'error'); }
    } catch(e) { aieToast(T.error, 'error'); }
}

window.uploadStoryImage = function() {
    const fileInput = document.getElementById('storyImageFile');
    fileInput.onchange = async function() {
        if (!fileInput.files[0]) return;
        const fd = new FormData(); fd.append('file', fileInput.files[0]);
        try {
            const res = await fetch(BASE + '/api/upload', { method: 'POST', body: fd });
            const data = await res.json();
            if (res.ok) document.getElementById('storyEditImage').value = data.url;
            else aieToast(data.error || T.error, 'error');
        } catch(e) { aieToast(T.upload_error, 'error'); }
    };
    fileInput.click();
};

document.getElementById('storyEditForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('storyEditId').value;
    const payload = {
        couple_names: document.getElementById('storyEditNames').value,
        title: document.getElementById('storyEditTitle').value,
        story: document.getElementById('storyEditText').value,
        image_url: document.getElementById('storyEditImage').value,
        wedding_date: document.getElementById('storyEditDate').value || null
    };
    try {
        const url = id ? BASE + '/api/panel/stories/' + id : BASE + '/api/panel/stories';
        const method = id ? 'PUT' : 'POST';
        const res = await fetch(url, { method, headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(payload) });
        if (res.ok) {
            aieToast(id ? T.story_updated : T.story_added);
            closeStoryModal();
            await fetchStories();
            loadStories();
        } else { const d = await res.json(); aieToast(d.error || T.error, 'error'); }
    } catch(e) { aieToast(T.error + ': ' + e.message, 'error'); }
});

document.getElementById('storyEditModal').addEventListener('click', e => { if (e.target === e.currentTarget) closeStoryModal(); });

fetchStories().then(() => loadStories());
</script>
<?php endif; ?>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>
