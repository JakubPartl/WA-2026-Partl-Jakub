<?php require_once '../app/views/layout/header.php'; ?>

<main class="container mx-auto px-6 py-10 flex-grow">
    <div class="max-w-2xl mx-auto">
        <div class="mb-6">
            <h2 class="text-3xl font-light tracking-widest text-slate-300 uppercase">Upravit model</h2>
            <p class="text-slate-500 italic mt-2 text-sm">Upravte informace o modelu.</p>
        </div>

        <div class="bg-slate-800/50 border border-slate-700 rounded-xl shadow-2xl p-6 md:p-8">
            <form action="<?= BASE_URL ?>/porsche/update/<?= $model->id ?>" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <h3 class="text-purple-400 text-xs font-bold uppercase tracking-widest border-b border-slate-700 pb-2 mb-2">Základní informace</h3>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Název modelu <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($model->name) ?>"
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Generace</label>
                        <input type="text" name="generation" value="<?= htmlspecialchars($model->generation ?? '') ?>"
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Rok od</label>
                        <input type="number" name="year_from" min="1948" max="2099" value="<?= $model->year_from ?>"
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Rok do</label>
                        <input type="number" name="year_to" min="1948" max="2099" value="<?= $model->year_to ?>"
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div class="md:col-span-2">
                        <h3 class="text-purple-400 text-xs font-bold uppercase tracking-widest border-b border-slate-700 pb-2 mb-2 mt-2">Technické údaje</h3>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Motor</label>
                        <input type="text" name="engine" value="<?= htmlspecialchars($model->engine ?? '') ?>"
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Výkon (HP)</label>
                        <input type="number" name="power_hp" min="0" value="<?= $model->power_hp ?>"
                               class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Cena (Kč)</label>
                        <input type="number" name="price" min="0"
                            value="<?= $model->price ?>"
                            class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Typ karoserie</label>
                        <select name="body_type"
                                class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                            <option value="">-- Vyberte --</option>
                            <?php foreach (\PorscheModel::getBodyTypes() as $bt): ?>
                                <option value="<?= $bt ?>" <?= $model->body_type == $bt ? 'selected' : '' ?>><?= $bt ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Kategorie</label>
                        <select name="category_id"
                                class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors">
                            <option value="">-- Vyberte --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat->id ?>" <?= $cat->id == $model->category_id ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Popis</label>
                        <textarea name="description" rows="4"
                                  class="w-full bg-slate-900/50 border border-slate-600 rounded-md px-4 py-2 text-slate-200 focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-colors"><?= htmlspecialchars($model->description ?? '') ?></textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-semibold text-slate-400 mb-1 uppercase tracking-wider">Fotka</label>
                        <?php if ($model->image): ?>
                            <img src="<?= BASE_URL ?>/uploads/<?= htmlspecialchars($model->image) ?>"
                                 class="h-24 rounded mb-2 object-cover">
                        <?php endif; ?>
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-slate-700 file:text-slate-200 hover:file:bg-slate-600 transition-colors">
                        <p class="text-xs text-slate-500 mt-1">Ponech prázdné pro zachování stávající fotky</p>
                    </div>
                    <div class="md:col-span-2 mt-2 flex gap-3">
                        <button type="submit"
                                class="bg-purple-700 hover:bg-purple-600 text-white font-bold py-3 px-8 rounded-md shadow-lg border border-purple-500 transition-all uppercase tracking-widest text-sm">
                            Uložit změny
                        </button>
                        <a href="<?= BASE_URL ?>/porsche/show/<?= $model->id ?>"
                           class="bg-slate-700 hover:bg-slate-600 text-slate-200 font-bold py-3 px-8 rounded-md border border-slate-600 transition-all uppercase tracking-widest text-sm">
                            Zrušit
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require_once '../app/views/layout/footer.php'; ?>