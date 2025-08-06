<?php

$book = $database->query(
    query: "select * from books where id = :id",
    class: Book::class,
    params: ['id' => $_GET['id']]
)->fetch();

view('livro', compact('book'));
