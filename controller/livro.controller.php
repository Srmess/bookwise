<?php

$book = $database->query(
    query: "select
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
  b.id = :id
group by
  b.id,
  b.title,
  b.author,
  b.description,
  b.released_year",
    class: Book::class,
    params: ['id' => $_GET['id']]
)->fetch();

$reviews = $database->query(
    query: "select * from reviews where book_id = :id",
    class: Review::class,
    params: ['id' => $_GET['id']]
)->fetchAll();

view('livro', compact('book', 'reviews'));
