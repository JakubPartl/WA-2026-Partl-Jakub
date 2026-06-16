<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow">
    <div class="max-w-xl mx-auto">
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="bg-purple-900/30 border-l-4 border-purple-500 text-purple-300 p-4 rounded-r-lg mb-4">
                <p class="text-sm font-semibold italic"><?= htmlspecialchars($_SESSION['flash']) ?></p>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8">
            <div class="flex items-center gap-5 mb-6">
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
                    <p class="text-slate-500 text-sm"><?= htmlspecialchars($user->email) ?></p>
                    <?php if ($user->is_admin): ?>
                        <span class="text-xs bg-purple-800 border border-purple-600 text-purple-200 px-2 py-0.5 rounded mt-1 inline-block">Admin</span>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ($user->bio): ?>
                <p class="text-slate-400 text-sm mb-4 leading-relaxed italic border-l-2 border-purple-700 pl-3"><?= nl2br(htmlspecialchars($user->bio)) ?></p>
            <?php endif; ?>

            <p class="text-xs text-slate-600 mb-6">Člen od: <?= $user->created_at ?></p>

            <div class="flex gap-3">
                <a href="<?= BASE_URL ?>/profile/edit"
                   class="bg-purple-700 hover:bg-purple-600 text-white px-5 py-2 rounded-md border border-purple-500 transition-all text-sm uppercase tracking-wider font-bold">
                    Upravit profil
                </a>
                <?php if ($_SESSION['is_admin']): ?>
                    <a href="<?= BASE_URL ?>/profile/users"
                       class="bg-slate-700 hover:bg-slate-600 text-slate-200 px-5 py-2 rounded-md border border-slate-600 transition-all text-sm uppercase tracking-wider font-bold">
                        Správa uživatelů
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h2 class="text-xl font-light tracking-widest text-slate-300 uppercase mb-4">
            Moje modely (<?= count($models) ?>)
        </h2>

        <?php if (empty($models)): ?>
            <p class="text-slate-500 italic">Zatím jsi nic nepřidal.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($models as $model): ?>
                    <div class="bg-slate-800/50 border border-slate-700 rounded-xl overflow-hidden hover:border-purple-500/50 transition-all shadow-lg">
                        <?php if ($model->image): ?>
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($model->image) ?>"
                                 alt="<?= htmlspecialchars($model->name) ?>"
                                 class="w-full h-40 object-cover">
                        <?php else: ?>
                            <div class="w-full h-40 bg-slate-900/50 flex items-center justify-center">
                                <span class="text-slate-600 italic text-sm">Bez fotky</span>
                            </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="text-md font-bold text-slate-200 uppercase tracking-wide">
                                <?= htmlspecialchars($model->name) ?>
                            </h3>
                            <p class="text-slate-500 text-xs italic"><?= htmlspecialchars($model->generation ?? '') ?></p>
                            <div class="mt-2 flex flex-wrap gap-2 text-xs">
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
                               class="mt-3 inline-block text-sm font-semibold text-purple-400 hover:text-white transition-colors uppercase tracking-wider">
                                Detail →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-10">
        <h2 class="text-xl font-light tracking-widest text-slate-300 uppercase mb-4">
            Oblíbené modely (<?= count($likedModels) ?>)
        </h2>

        <?php if (empty($likedModels)): ?>
            <p class="text-slate-500 italic">Zatím jsi nic nelajkoval.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($likedModels as $model): ?>
                    <div class="bg-slate-800/50 border border-purple-900/40 rounded-xl overflow-hidden hover:border-purple-500/50 transition-all shadow-lg">
                        <?php if ($model->image): ?>
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($model->image) ?>"
                                 alt="<?= htmlspecialchars($model->name) ?>"
                                 class="w-full h-40 object-cover">
                        <?php else: ?>
                            <div class="w-full h-40 bg-slate-900/50 flex items-center justify-center">
                                <span class="text-slate-600 italic text-sm">Bez fotky</span>
                            </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="text-md font-bold text-slate-200 uppercase tracking-wide">
                                <?= htmlspecialchars($model->name) ?>
                            </h3>
                            <p class="text-slate-500 text-xs italic"><?= htmlspecialchars($model->generation ?? '') ?></p>
                            <div class="mt-2 flex flex-wrap gap-2 text-xs">
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
                               class="mt-3 inline-block text-sm font-semibold text-purple-400 hover:text-white transition-colors uppercase tracking-wider">
                                Detail →
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>