<?php

require 'Validation.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('location: /');
    exit();
}

$user = auth();

$payload = [
    'review' => $_POST['review'],
    'rating' => $_POST['rating'],
    'bookId' => $_POST['bookId'],
    'userId' => $user->id,
];

$validation = Validation::validate([
    'review' => ['required'],
    'rating' => ['required']
], $_POST);

if ($validation->isInvalid('review_validation')) {
    header("location: /livro?id=" . $payload['bookId']);
    exit();
}



$database->query(
    query: 'insert into reviews(review, rating, user_id, book_id) values (:review, :rating, :userId, :bookId)',
    params: $payload,

);

header("location: /livro?id=" . $payload['bookId']);
exit();
