<?php

$searchparam = $_REQUEST['searchparam'] ?? '';

$books = $database->query(
    query: "select * from books where title like :search",
    class: Book::class,
    params: ['search' => "%$searchparam%"]
)->fetchAll();


view('index', compact('books'));
