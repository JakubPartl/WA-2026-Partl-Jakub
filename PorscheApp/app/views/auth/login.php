<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow flex items-center justify-center">
    <div class="w-full max-w-md">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-light tracking-widest text-slate-300 uppercase">Přihlášení</h2>
            <p class="text-slate-500 italic mt-2 text-sm">Vítejte zpět v Porsche Katalogu.</p>
        </div>

        <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8">
            <form action="<?= BASE_URL ?>/auth/authenticate" method="post">
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">E-mail</label>
                        <input type="email" name="email" required autofocus
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Heslo</label>
                        <input type="password" name="password" required
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-4 rounded-md shadow-lg border border-purple-500 transition-all uppercase tracking-widest text-sm">
                            Přihlásit se
                        </button>
                    </div>
                    <p class="text-center text-slate-500 text-sm border-t border-slate-700 pt-4">
                        Nemáte ještě účet? <a href="<?= BASE_URL ?>/auth/register" class="text-purple-400 hover:text-white transition-colors">Zaregistrujte se</a>.
                    </p>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>