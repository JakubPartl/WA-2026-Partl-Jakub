<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow">
    <div class="mb-8">
        <h2 class="text-3xl font-light tracking-widest text-slate-300 uppercase">Hledat uživatele</h2>
    </div>

    <form action="<?= BASE_URL ?>/profile/search" method="GET" class="mb-8">
        <div class="flex gap-3 max-w-xl">
            <input type="text" name="q" value="<?= htmlspecialchars($query) ?>"
                   placeholder="Zadejte uživatelské jméno..."
                   class="flex-1 bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 placeholder-slate-600 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
            <button type="submit"
                    class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-2 px-6 rounded-md border border-purple-500 transition-all uppercase tracking-widest text-sm">
                Hledat
            </button>
        </div>
    </form>

    <?php if (!empty($query)): ?>
        <?php if (empty($users)): ?>
            <p class="text-slate-500 italic">Žádný uživatel nenalezen.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($users as $u): ?>
                    <a href="<?= BASE_URL ?>/profile/view_user/<?= $u->id ?>"
                       class="bg-slate-800/50 border border-slate-700 hover:border-purple-500/50 rounded-xl p-5 transition-all flex items-center gap-4">
                        <?php if ($u->avatar): ?>
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($u->avatar) ?>"
                                 class="w-12 h-12 rounded-full object-cover border-2 border-purple-700">
                        <?php else: ?>
                            <div class="w-12 h-12 rounded-full bg-slate-700 border-2 border-purple-800 flex items-center justify-center text-slate-400">
                                ?
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-bold text-slate-200 uppercase tracking-wide"><?= htmlspecialchars($u->username) ?></p>
                            <?php if ($u->is_admin): ?>
                                <span class="text-xs bg-purple-800 border border-purple-600 text-purple-200 px-2 py-0.5 rounded">Admin</span>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>