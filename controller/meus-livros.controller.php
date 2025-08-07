<?php

if (!auth()->id) {
    header('location: /');
}

$books = $database->query(
    query: '
        select
  b.id,
  b.title,
  b.author,
  b.description,
  b.released_year,
  count(r.id) as review_amount,
  round(sum(r.rating) / 5) as review_avarange
from
  books b
  left join reviews r on r.book_id = b.id
where
  b.user_id = :id
group by
  b.id,
  b.title,
  b.author,
  b.description,
  b.released_year',
    class: Book::class,
    params: ['id' => auth()->id]
)->fetchAll();

view('meus-livros', compact('books'));
