<form class="w-full flex space-x-2 mt-6">

    <input
        type="text"
        class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 w-full"
        placeholder="Pesquisar..."
        name="searchparam">

    <button type="submit">🔎</button>

</form>

<section class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

    <?php foreach ($books as $book): ?>

        <div class="p-2 rounded border-stone-800 border-2 bg-stone-900">

            <div class="flex">

                <div class="w-1/3">Imagem</div>

                <div class="space-y-1">

                    <a href="/livro?id=<?= $book->id ?>" class="font-semibold hover:underline"><?= $book->title ?></a>
                    <div class="text-xs italic"><?= $book->author ?></div>
                    <div class="text-xs italic">⭐⭐⭐⭐⭐(3 Avaliações)</div>

                </div>

            </div>

            <div class="text-sm mt-2"><?= $book->description ?></div>

        </div>

    <?php endforeach; ?>

</section>