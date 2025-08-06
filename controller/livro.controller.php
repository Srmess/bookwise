<?php

$book = $database->query(
    query: "select * from books where id = :id",
    class: Book::class,
    params: ['id' => $_GET['id']]
)->fetch();

$reviews = $database->query(
    query: "select * from reviews where book_id = :id",
    class: Review::class,
    params: ['id' => $_GET['id']]
)->fetchAll();

view('livro', compact('book', 'reviews'));
