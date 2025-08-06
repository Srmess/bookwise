<?= $book->title; ?>

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