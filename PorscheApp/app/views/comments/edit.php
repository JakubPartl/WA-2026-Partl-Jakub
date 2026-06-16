<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow flex items-center justify-center">
    <div class="w-full max-w-2xl">
        <div class="mb-6">
            <h2 class="text-3xl font-light tracking-widest text-slate-300 uppercase">Upravit komentář</h2>
        </div>
        <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8">
            <form action="<?= BASE_URL ?>/comment/update/<?= $comment->id ?>" method="POST">
                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Komentář</label>
                    <textarea name="content" rows="4" required
                              class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors"><?= htmlspecialchars($comment->content) ?></textarea>
                </div>
                <div class="mt-4 flex gap-3">
                    <button type="submit"
                            class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-8 rounded-md border border-purple-500 transition-all uppercase tracking-widest text-sm">
                        Uložit
                    </button>
                    <a href="<?= BASE_URL ?>/porsche/show/<?= $comment->porsche_model_id ?>"
                       class="bg-slate-700 hover:bg-slate-600 text-slate-200 font-bold py-3 px-8 rounded-md border border-slate-600 transition-all uppercase tracking-widest text-sm">
                        Zrušit
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>