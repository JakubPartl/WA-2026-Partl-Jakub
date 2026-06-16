<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow">
    <div class="mb-6">
        <h2 class="text-3xl font-light tracking-widest text-slate-300 uppercase">Správa uživatelů</h2>
        <p class="text-slate-500 italic mt-1 text-sm">Pouze administrátor může mazat uživatele.</p>
    </div>

    <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="border-b border-slate-700">
                <tr class="text-xs text-slate-400 uppercase tracking-widest">
                    <th class="text-left px-6 py-4">Uživatel</th>
                    <th class="text-left px-6 py-4">Email</th>
                    <th class="text-left px-6 py-4">Registrován</th>
                    <th class="text-left px-6 py-4">Role</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr class="border-b border-slate-700/50 hover:bg-slate-700/30 transition-colors">
                        <td class="px-6 py-4 font-semibold text-slate-200"><?= htmlspecialchars($u->username) ?></td>
                        <td class="px-6 py-4 text-slate-400"><?= htmlspecialchars($u->email) ?></td>
                        <td class="px-6 py-4 text-slate-500 text-xs"><?= $u->created_at ?></td>
                        <td class="px-6 py-4">
                            <?php if ($u->is_admin): ?>
                                <span class="bg-purple-800 border border-purple-600 text-purple-200 text-xs px-2 py-0.5 rounded">Admin</span>
                            <?php else: ?>
                                <span class="bg-slate-700 border border-slate-600 text-slate-400 text-xs px-2 py-0.5 rounded">Uživatel</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <?php if ($u->id != $_SESSION['user_id']): ?>
                                <a href="<?= BASE_URL ?>/profile/delete/<?= $u->id ?>"
                                   onclick="return confirm('Opravdu smazat uživatele <?= htmlspecialchars($u->username) ?>?')"
                                   class="text-rose-500 hover:text-white transition-colors text-xs uppercase tracking-wider">
                                    Smazat
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>