<?php

require 'Validation.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: /meus-livros');
    exit();
}

$user = auth();

if (!$user->id) {
    abort(403);
}


$payload = [
    'title' => $_POST['title'],
    'author' => $_POST['author'],
    'description' => $_POST['description'],
    'released_year' => $_POST['released_year'],
    'userId' => $user->id,
];

$validation = Validation::validate([
    'title' => ['required'],
    'author' => ['required'],
    'description' => ['required'],
    'released_year' => ['required'],
], $_POST);

if ($validation->isInvalid('my_books_validation')) {
    header("location: /meus-livros");
    exit();
}

$database->query(
    query: 'insert into books(title, author, description, released_year, user_Id) 
    values (:title, :author, :description, :released_year, :userId)',
    params: $payload,
);

flash()->push('message', 'Livro cadastrado com sucesso!');

header("location: /meus-livros");
exit();
