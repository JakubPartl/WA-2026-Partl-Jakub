<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow">
    <a href="<?= BASE_URL ?>/porsche" class="text-sm text-slate-500 hover:text-purple-400 transition-colors uppercase tracking-wider">← Zpět na seznam</a>

    <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl overflow-hidden mt-4">
        <?php if ($model->image): ?>
            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($model->image) ?>"
                 alt="<?= htmlspecialchars($model->name) ?>"
                 class="w-full h-72 object-cover">
        <?php else: ?>
            <div class="w-full h-48 bg-slate-900/50 flex items-center justify-center">
                <span class="text-slate-600 italic">Bez fotky</span>
            </div>
        <?php endif; ?>

        <div class="p-6 md:p-8">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-slate-200 uppercase tracking-wide"><?= htmlspecialchars($model->name) ?></h1>
                    <p class="text-slate-500 italic mt-1"><?= htmlspecialchars($model->generation ?? '') ?></p>
                </div>
                <?php if (isset($_SESSION['user_id']) && ($model->user_id == $_SESSION['user_id'] || $_SESSION['is_admin'])): ?>
                    <div class="flex gap-2">
                        <a href="<?= BASE_URL ?>/porsche/edit/<?= $model->id ?>"
                           class="bg-slate-700 hover:bg-slate-600 text-slate-200 px-4 py-2 rounded-md border border-slate-600 transition-all text-sm uppercase tracking-wider">
                            Upravit
                        </a>
                        <a href="<?= BASE_URL ?>/porsche/delete/<?= $model->id ?>"
                           onclick="return confirm('Opravdu smazat?')"
                           class="bg-rose-900/50 hover:bg-rose-800 text-rose-400 hover:text-white px-4 py-2 rounded-md border border-rose-800 transition-all text-sm uppercase tracking-wider">
                            Smazat
                        </a>
                    </div>
                    <div class="flex items-center gap-3 mt-4">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="<?= BASE_URL ?>/like/toggle/<?= $model->id ?>"
                                class="flex items-center gap-2 px-4 py-2 rounded-md border transition-all text-sm font-bold uppercase tracking-wider
                                    <?= $hasLiked ? 'bg-purple-700 border-purple-500 text-white' : 'bg-slate-800 border-slate-600 text-slate-400 hover:border-purple-500 hover:text-purple-400' ?>">
                                <?= $hasLiked ? '♥ Lajknuto' : '♡ Lajkovat' ?>
                            </a>
                        <?php endif; ?>
                        <span class="text-slate-500 text-sm">
                            <span class="text-purple-400 font-bold"><?= $likeCount ?></span> lajků
                        </span>
                    </div>
                <?php endif; ?>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <div class="bg-slate-900/50 border border-slate-700 rounded-lg p-3">
                    <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Roky výroby</p>
                    <p class="font-semibold text-slate-200">
                        <?= $model->year_from ?>
                        <?= $model->year_to ? ' – ' . $model->year_to : ' – dosud' ?>
                    </p>
                </div>
                <div class="bg-slate-900/50 border border-slate-700 rounded-lg p-3">
                    <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Motor</p>
                    <p class="font-semibold text-slate-200"><?= htmlspecialchars($model->engine ?? '–') ?></p>
                </div>
                <div class="bg-slate-900/50 border border-purple-900/30 rounded-lg p-3">
                    <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Výkon</p>
                    <p class="font-semibold text-purple-400"><?= $model->power_hp ? $model->power_hp . ' HP' : '–' ?></p>
                </div>
                <div class="bg-slate-900/50 border border-slate-700 rounded-lg p-3">
                    <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Karoserie</p>
                    <p class="font-semibold text-slate-200"><?= htmlspecialchars($model->body_type ?? '–') ?></p>
                </div>
            </div>

            <?php if ($model->description): ?>
                <div class="mt-6 border-t border-slate-700 pt-6">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-3">Popis</h2>
                    <p class="text-slate-300 leading-relaxed"><?= nl2br(htmlspecialchars($model->description)) ?></p>
                </div>
            <?php endif; ?>

            <p class="text-xs text-slate-600 mt-6">Přidal: <?= htmlspecialchars($model->username ?? 'Neznámý') ?></p>
        </div>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-light tracking-widest text-slate-300 uppercase mb-4">Komentáře</h2>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form action="<?= BASE_URL ?>/comment/store/<?= $model->id ?>" method="POST" class="mb-6">
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4">
                    <textarea name="content" rows="3" required
                        placeholder="Napište komentář..."
                        class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors text-sm"></textarea>
                    <button type="submit"
                        class="mt-3 bg-purple-700 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded-md border border-purple-500 transition-all uppercase tracking-widest text-sm">
                        Odeslat
                    </button>
                </div>
            </form>
        <?php else: ?>
            <p class="text-sm text-slate-500 mb-6 italic">
                <a href="<?= BASE_URL ?>/auth/login" class="text-purple-400 hover:text-white transition-colors">Přihlaste se</a> pro přidání komentáře.
            </p>
        <?php endif; ?>

        <?php if (empty($comments)): ?>
            <p class="text-slate-600 text-sm italic">Zatím žádné komentáře.</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl p-4 mb-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="font-semibold text-sm text-slate-200"><?= htmlspecialchars($comment->username) ?></span>
                            <span class="text-xs text-slate-500 ml-2"><?= $comment->created_at ?></span>
                        </div>
                        <?php if (isset($_SESSION['user_id']) && ($comment->user_id == $_SESSION['user_id'] || $_SESSION['is_admin'])): ?>
                            <div class="flex gap-3">
                                <a href="<?= BASE_URL ?>/comment/edit/<?= $comment->id ?>"
                                   class="text-xs text-slate-400 hover:text-white transition-colors uppercase tracking-wider">Upravit</a>
                                <a href="<?= BASE_URL ?>/comment/delete/<?= $comment->id ?>"
                                   onclick="return confirm('Smazat komentář?')"
                                   class="text-xs text-rose-500 hover:text-white transition-colors uppercase tracking-wider">Smazat</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="text-sm text-slate-300 mt-2 leading-relaxed"><?= nl2br(htmlspecialchars($comment->content)) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>