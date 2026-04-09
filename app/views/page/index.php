<?php require BASE_PATH . '/app/views/layouts/header.php'; ?>

<div class="max-w-5xl mx-auto px-4 py-16">
    <h1 class="text-4xl font-bold text-white mb-8"><?= htmlspecialchars($customPage['title']) ?></h1>
    <div class="prose prose-invert prose-lg max-w-none text-slate-300 leading-relaxed">
        <?= $customPage['content'] ?>
    </div>
</div>

<?php require BASE_PATH . '/app/views/layouts/footer.php'; ?>
