<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow">
    <div class="max-w-xl mx-auto">
        <div class="mb-6">
            <h2 class="text-3xl font-light tracking-widest text-slate-300 uppercase">Upravit profil</h2>
        </div>

        <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8 mb-4">
            <form action="<?= BASE_URL ?>/profile/update" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Uživatelské jméno</label>
                    <input type="text" name="username" required value="<?= htmlspecialchars($user->username) ?>"
                           class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Email</label>
                    <input type="email" name="email" required value="<?= htmlspecialchars($user->email) ?>"
                           class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Bio</label>
                    <textarea name="bio" rows="3"
                              class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors"><?= htmlspecialchars($user->bio ?? '') ?></textarea>
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Profilová fotka</label>
                    <?php if ($user->avatar): ?>
                        <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($user->avatar) ?>"
                             class="w-16 h-16 rounded-full object-cover border-2 border-purple-700 mb-2">
                    <?php endif; ?>
                    <input type="file" name="avatar" accept="image/*"
                           class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-slate-700 file:text-slate-200 hover:file:bg-slate-600 transition-colors">
                </div>
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-8 rounded-md border border-purple-500 transition-all uppercase tracking-widest text-sm">
                        Uložit změny
                    </button>
                    <a href="<?= BASE_URL ?>/profile"
                       class="bg-slate-700 hover:bg-slate-600 text-slate-200 font-bold py-3 px-8 rounded-md border border-slate-600 transition-all uppercase tracking-widest text-sm">
                        Zrušit
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8">
            <h2 class="text-xl font-light tracking-widest text-slate-300 uppercase mb-4">Změna hesla</h2>
            <form action="<?= BASE_URL ?>/profile/updatePassword" method="POST">
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Současné heslo</label>
                    <input type="password" name="current_password" required
                           class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Nové heslo</label>
                    <input type="password" name="new_password" required
                           class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                </div>
                <button type="submit"
                        class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-8 rounded-md border border-purple-500 transition-all uppercase tracking-widest text-sm">
                    Změnit heslo
                </button>
            </form>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>