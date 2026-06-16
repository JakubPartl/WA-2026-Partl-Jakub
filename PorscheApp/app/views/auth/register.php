<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow flex items-center justify-center">
    <div class="w-full max-w-2xl">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-light tracking-widest text-slate-300 uppercase">Nová registrace</h2>
            <p class="text-slate-500 italic mt-2 text-sm">Vytvořte si účet pro správu Porsche katalogu.</p>
        </div>

        <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8">
            <form action="<?= BASE_URL ?>/auth/storeUser" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <h3 class="text-purple-400 text-xs font-bold uppercase tracking-widest border-b border-slate-700 pb-2 mb-4">Přihlašovací údaje</h3>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Uživatelské jméno <span class="text-rose-500">*</span></label>
                        <input type="text" name="username" required
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">E-mail <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" required
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Heslo <span class="text-rose-500">*</span></label>
                        <input type="password" name="password" required
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Potvrzení hesla <span class="text-rose-500">*</span></label>
                        <input type="password" name="password_confirm" required
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div class="md:col-span-2 mt-4">
                        <button type="submit"
                                class="w-full bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-4 rounded-md shadow-lg border border-purple-500 transition-all uppercase tracking-widest text-sm">
                            Vytvořit účet
                        </button>
                        <p class="text-center text-slate-500 text-sm mt-4">
                            Už máte účet? <a href="<?= BASE_URL ?>/auth/login" class="text-purple-400 hover:text-white transition-colors">Přihlaste se zde</a>.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>