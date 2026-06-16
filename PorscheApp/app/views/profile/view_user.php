<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow">
    <a href="<?= BASE_URL ?>/profile/search" class="text-sm text-slate-500 hover:text-purple-400 transition-colors uppercase tracking-wider">← Zpět na hledání</a>

    <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8 mt-4 max-w-xl mb-8">
        <div class="flex items-center gap-5">
            <?php if ($user->avatar): ?>
                <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($user->avatar) ?>"
                     class="w-20 h-20 rounded-full object-cover border-2 border-purple-500">
            <?php else: ?>
                <div class="w-20 h-20 rounded-full bg-slate-700 border-2 border-purple-800 flex items-center justify-center text-2xl text-slate-400">
                    ?
                </div>
            <?php endif; ?>
            <div>
                <h1 class="text-2xl font-bold text-slate-200 uppercase tracking-wide"><?= htmlspecialchars($user->username) ?></h1>
                <?php if ($user->is_admin): ?>
                    <span class="text-xs bg-purple-800 border border-purple-600 text-purple-200 px-2 py-0.5 rounded mt-1 inline-block">Admin</span>
                <?php endif; ?>
                <?php if ($user->bio): ?>
                    <p class="text-slate-400 text-sm mt-2 italic border-l-2 border-purple-700 pl-3"><?= nl2br(htmlspecialchars($user->bio)) ?></p>
                <?php endif; ?>
                <p class="text-xs text-slate-600 mt-2">Člen od: <?= $user->created_at ?></p>
            </div>
        </div>
    </div>

    <h2 class="text-xl font-light tracking-widest text-slate-300 uppercase mb-4">
        Přidané modely (<?= count($models) ?>)
    </h2>

    <?php if (empty($models)): ?>
        <p class="text-slate-500 italic">Tento uživatel zatím nic nepřidal.</p>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($models as $model): ?>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl overflow-hidden hover:border-purple-500/50 transition-all shadow-lg">
                    <?php if ($model->image): ?>
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($model->image) ?>"
                             alt="<?= htmlspecialchars($model->name) ?>"
                             class="w-full h-48 object-cover">
                    <?php else: ?>
                        <div class="w-full h-48 bg-slate-900/50 flex items-center justify-center">
                            <span class="text-slate-600 italic text-sm">Bez fotky</span>
                        </div>
                    <?php endif; ?>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-200 uppercase tracking-wide">
                            <?= htmlspecialchars($model->name) ?>
                        </h3>
                        <p class="text-slate-500 text-sm italic"><?= htmlspecialchars($model->generation ?? '') ?></p>
                        <div class="mt-3 flex flex-wrap gap-2 text-xs">
                            <?php if ($model->power_hp): ?>
                                <span class="bg-purple-900/40 border border-purple-800/50 px-2 py-1 rounded text-purple-400">
                                    <?= $model->power_hp ?> HP
                                </span>
                            <?php endif; ?>
                            <?php if ($model->price): ?>
                                <span class="bg-slate-700 px-2 py-1 rounded text-slate-300">
                                    <?= number_format($model->price, 0, ',', ' ') ?> Kč
                                </span>
                            <?php endif; ?>
                        </div>
                        <a href="<?= BASE_URL ?>/porsche/show/<?= $model->id ?>"
                           class="mt-4 inline-block text-sm font-semibold text-purple-400 hover:text-white transition-colors uppercase tracking-wider">
                            Detail →
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>