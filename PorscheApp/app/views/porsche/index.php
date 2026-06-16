<?php require_once '../app/views/layout/header.php'; ?>

<div class="border-b border-purple-900/30 bg-[#0f0f12]">
    <div class="container mx-auto px-6 py-12">
        <div class="max-w-2xl">
            <h1 class="text-5xl font-bold text-white uppercase tracking-wider mb-2">
                Porsche <span class="text-purple-400">Katalog</span>
            </h1>
            <p class="text-slate-500 italic mb-8">Databáze nejlepších Porsche modelů všech dob.</p>

            <form action="<?= BASE_URL ?>/porsche" method="GET" class="flex gap-3 max-w-xl">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>"
                       placeholder="Hledat model, generaci, karoserii..."
                       class="flex-1 bg-slate-900/80 border border-slate-700 rounded-md px-4 py-3 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                <button type="submit"
                        class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-6 rounded-md border border-purple-500 transition-all uppercase tracking-widest text-sm">
                    Hledat
                </button>
                <?php if (!empty($search)): ?>
                    <a href="<?= BASE_URL ?>/porsche"
                       class="bg-slate-700 hover:bg-slate-600 text-slate-300 font-bold py-3 px-4 rounded-md border border-slate-600 transition-all text-sm">
                        ✕
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-10">
            <div class="bg-slate-900/50 border border-purple-900/40 rounded-xl p-4 text-center">
                <p class="text-3xl font-bold text-purple-400"><?= $stats->total_models ?></p>
                <p class="text-xs text-slate-500 uppercase tracking-widest mt-1">Modelů</p>
            </div>
            <div class="bg-slate-900/50 border border-purple-900/40 rounded-xl p-4 text-center">
                <p class="text-3xl font-bold text-purple-400"><?= $stats->total_users ?></p>
                <p class="text-xs text-slate-500 uppercase tracking-widest mt-1">Uživatelů</p>
            </div>
            <div class="bg-slate-900/50 border border-purple-900/40 rounded-xl p-4 text-center">
                <p class="text-3xl font-bold text-purple-400"><?= $stats->total_comments ?></p>
                <p class="text-xs text-slate-500 uppercase tracking-widest mt-1">Komentářů</p>
            </div>
            <div class="bg-slate-900/50 border border-purple-900/40 rounded-xl p-4 text-center">
                <p class="text-3xl font-bold text-purple-400"><?= $stats->max_hp ? number_format($stats->max_hp, 0, ',', ' ') : '–' ?></p>
                <p class="text-xs text-slate-500 uppercase tracking-widest mt-1">Max HP</p>
            </div>
        </div>
    </div>
</div>

<main class="container mx-auto px-6 py-8 flex-grow">
    <div class="flex justify-between items-center mb-6">
        <div>
            <?php if (!empty($search)): ?>
                <p class="text-slate-400 text-sm">Výsledky pro: <span class="text-purple-400 font-semibold">"<?= htmlspecialchars($search) ?>"</span> — <?= count($models) ?> modelů</p>
            <?php else: ?>
                <p class="text-slate-500 text-sm"><?= count($models) ?> modelů celkem</p>
            <?php endif; ?>
        </div>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= BASE_URL ?>/porsche/create"
               class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded-md shadow-lg border border-purple-500 transition-all uppercase tracking-widest text-sm">
                + Přidat model
            </a>
        <?php endif; ?>
    </div>

    <div class="flex gap-2 mb-6 flex-wrap">
        <?php
        $sorts = [
            'name|ASC'       => 'Název A→Z',
            'name|DESC'      => 'Název Z→A',
            'price|ASC'      => 'Cena ↑',
            'price|DESC'     => 'Cena ↓',
            'power_hp|DESC'  => 'Výkon ↓',
            'power_hp|ASC'   => 'Výkon ↑',
            'year_from|DESC' => 'Nejnovější',
            'year_from|ASC'  => 'Nejstarší',
        ];
        foreach ($sorts as $key => $label):
            [$s, $o] = explode('|', $key);
            $active = ($sort === $s && $order === $o);
        ?>
            <a href="?sort=<?= $s ?>&order=<?= $o ?><?= !empty($search) ? '&search=' . urlencode($search) : '' ?>"
               class="text-xs px-3 py-1.5 rounded-md border transition-all uppercase tracking-wider font-bold
                      <?= $active ? 'bg-purple-700 border-purple-500 text-white' : 'bg-slate-800 border-slate-600 text-slate-400 hover:border-purple-500 hover:text-purple-400' ?>">
                <?= $label ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if (empty($models)): ?>
        <div class="text-center py-20 text-slate-500 italic">
            <?= !empty($search) ? 'Žádné modely neodpovídají hledání.' : 'Zatím žádné modely. Přidejte první!' ?>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($models as $model): ?>
                <div class="bg-slate-800/50 border border-slate-700 rounded-xl overflow-hidden hover:border-purple-500/50 transition-all shadow-lg hover:shadow-purple-900/20">
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
                        <div class="mt-3 flex flex-wrap gap-2 text-xs text-slate-400">
                            <?php if ($model->year_from): ?>
                                <span class="bg-slate-700 px-2 py-1 rounded">
                                    <?= $model->year_from ?><?= $model->year_to ? '–' . $model->year_to : '' ?>
                                </span>
                            <?php endif; ?>
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
                            <?php if ($model->body_type): ?>
                                <span class="bg-slate-700 px-2 py-1 rounded">
                                    <?= htmlspecialchars($model->body_type) ?>
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