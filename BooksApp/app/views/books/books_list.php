<?php require_once '../app/views/layout/header.php'; ?>

    <main class="container mx-auto px-6 py-10">
        
        <?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
            <div class="notifications-container">
                
                <?php foreach ($_SESSION['messages'] as $type => $messages): ?>
                    <?php 
                        // Jednoduché určení barvy podle typu zprávy
                        $color = 'black';
                        if ($type === 'success') $color = 'green';
                        if ($type === 'error') $color = 'red';
                        if ($type === 'notice') $color = 'orange';
                    ?>
                    
                    <?php foreach ($messages as $message): ?>
                        <div style="color: <?= $color ?>; border: 1px solid <?= $color ?>; padding: 10px; margin-bottom: 10px;">
                            <strong><?= htmlspecialchars($message) ?></strong>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                
            </div>
            
            <?php 
                // ZÁSADNÍ KROK: Po vypsání musíme zprávy ze session vymazat, 
                // aby se nezobrazovaly při každém dalším obnovení stránky!
                unset($_SESSION['messages']); 
            ?>
        <?php endif; ?>

        <div class="flex justify-between items-end mb-6">
            <h2 class="text-3xl font-light tracking-widest text-slate-400 uppercase">Dostupné knihy</h2>
        </div>
        
        <div class="bg-slate-800/50 border border-slate-700 rounded-xl overflow-hidden shadow-2xl backdrop-blur-sm">
            <?php if (empty($books)): ?>
                <div class="p-10 text-center text-slate-500 italic">
                    V databázi se zatím nenachází žádné knihy.
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-700/50 border-b border-slate-600">
                                <th class="px-6 py-4 font-semibold uppercase text-xs text-slate-400 tracking-wider text-center">ID</th>
                                <th class="px-6 py-4 font-semibold uppercase text-xs text-slate-400 tracking-wider">Název knihy</th>
                                <th class="px-6 py-4 font-semibold uppercase text-xs text-slate-400 tracking-wider">Autor</th>
                                <th class="px-6 py-4 font-semibold uppercase text-xs text-slate-400 tracking-wider">Rok</th>
                                <th class="px-6 py-4 font-semibold uppercase text-xs text-slate-400 tracking-wider text-right">Cena</th>
                                <th class="px-6 py-4 font-semibold uppercase text-xs text-slate-400 tracking-wider text-center">Akce</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700">
                            <?php foreach ($books as $book): ?>
                                <tr class="hover:bg-slate-700/30 transition-colors group">
                                    <<td class="px-6 py-4 text-center">
                                        <div class="flex justify-center space-x-3 text-sm">
                                            
                                            <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="text-blue-400 hover:text-white transition-colors underline decoration-blue-800 underline-offset-4">Detail</a>
                                            
                                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $book['created_by']): ?>
                                                <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="text-emerald-400 hover:text-white transition-colors underline decoration-emerald-800 underline-offset-4">Upravit</a>
                                                <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="text-rose-400 hover:text-white transition-colors underline decoration-rose-800 underline-offset-4">Smazat</a>
                                            <?php endif; ?>
                                            
                                        </div>
                                    </td>
                                        <div class="flex justify-center space-x-3 text-sm">
                                            <a href="<?= BASE_URL ?>/index.php?url=book/show/<?= $book['id'] ?>" class="text-blue-400 hover:text-white transition-colors underline decoration-blue-800 underline-offset-4">Detail</a>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/edit/<?= $book['id'] ?>" class="text-emerald-400 hover:text-white transition-colors underline decoration-emerald-800 underline-offset-4">Upravit</a>
                                            <a href="<?= BASE_URL ?>/index.php?url=book/delete/<?= $book['id'] ?>" onclick="return confirm('Opravdu chcete tuto knihu smazat?')" class="text-rose-400 hover:text-white transition-colors underline decoration-rose-800 underline-offset-4">Smazat</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>

<?php require_once '../app/views/layout/footer.php'; ?>