<?php

require '../Validation.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: /meus-livros');
    exit();
}

$user = auth();

if (!$user->id) {
    abort(403);
}

$dir =  "data/uploads/";
$extension = pathinfo($_FILES['book_cover']['name'], PATHINFO_EXTENSION);
$encriptedName = md5(rand());

$uploadPath = $dir . $encriptedName . ".$extension";

move_uploaded_file($_FILES['book_cover']['tmp_name'], $uploadPath);

$payload = [
    'title' => $_POST['title'],
    'author' => $_POST['author'],
    'description' => $_POST['description'],
    'released_year' => $_POST['released_year'],
    'book_cover' => $uploadPath,
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
    query: 'insert into books(title, author, description, released_year, book_cover, user_Id) 
    values (:title, :author, :description, :released_year, :book_cover, :userId)',
    params: $payload,
);

flash()->push('message', 'Livro cadastrado com sucesso!');

header("location: /meus-livros");
exit();
