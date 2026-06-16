<!DOCTYPE html>
<html lang="cs" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Porsche Katalog</title>
    <style>
        :root {
            --accent: #a855f7;
            --accent-dark: #7e22ce;
        }
    </style>
</head>
<body class="bg-[#0f0f12] text-slate-200 min-h-screen font-sans flex flex-col">

<header class="sticky top-0 z-50 bg-gradient-to-b from-[#1a1a2e] to-[#0f0f12] border-b border-purple-900/50 shadow-xl">
    <div class="container mx-auto px-6 py-4 flex flex-col md:flex-row justify-between items-center">
        <a href="<?= BASE_URL ?>/porsche">
            <img src="<?= BASE_URL ?>/img/logo.svg" alt="Porsche Katalog" class="h-25 transition-all duration-300">
        </a>
        <nav class="mt-4 md:mt-0">
            <ul class="flex items-center space-x-6">
                <li>
                    <a href="<?= BASE_URL ?>/porsche" class="hover:text-purple-400 transition-colors font-medium">
                        Modely
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/profile/search" class="hover:text-purple-400 transition-colors font-medium">
                        Uživatelé
                    </a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <li>
                        <a href="<?= BASE_URL ?>/porsche/create"
                           class="bg-purple-700 hover:bg-purple-600 text-white px-4 py-2 rounded-md transition-all border border-purple-500">
                            + Přidat model
                        </a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/profile" class="hover:text-purple-400 transition-colors text-sm">
                            <span class="text-white font-semibold"><?= htmlspecialchars($_SESSION['username']) ?></span>
                        </a>
                    </li>
                    <?php if ($_SESSION['is_admin']): ?>
                        <li>
                            <a href="<?= BASE_URL ?>/profile/users"
                               class="text-amber-400 hover:text-white transition-colors text-sm font-medium">
                                Uživatelé
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?= BASE_URL ?>/auth/logout"
                           class="text-rose-400 hover:text-white transition-colors text-sm uppercase tracking-wider font-medium">
                            Odhlásit
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?= BASE_URL ?>/auth/login"
                           class="hover:text-purple-400 transition-colors font-medium">Přihlásit</a>
                    </li>
                    <li>
                        <a href="<?= BASE_URL ?>/auth/register"
                           class="bg-[#1a1a2e] hover:bg-purple-900/50 text-white px-4 py-2 rounded-md transition-all border border-purple-800">
                            Registrace
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <script>
        const header = document.querySelector('header');
        const logo = document.querySelector('header img');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('py-2');
                header.classList.remove('py-4');
                logo.classList.remove('h-25');
                logo.classList.add('h-12');
            } else {
                header.classList.remove('py-2');
                header.classList.add('py-4');
                logo.classList.add('h-25');
                logo.classList.remove('h-12');
            }
        });
    </script>
</header>

<div class="container mx-auto px-6 pt-6">
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="bg-purple-900/30 border-l-4 border-purple-500 text-purple-300 p-4 rounded-r-lg mb-4">
            <p class="text-sm font-semibold italic"><?= htmlspecialchars($_SESSION['flash']) ?></p>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['flash_error'])): ?>
        <div class="bg-rose-900/30 border-l-4 border-rose-500 text-rose-400 p-4 rounded-r-lg mb-4">
            <p class="text-sm font-semibold italic"><?= htmlspecialchars($_SESSION['flash_error']) ?></p>
        </div>
        <?php unset($_SESSION['flash_error']); ?>
    <?php endif; ?>
</div>