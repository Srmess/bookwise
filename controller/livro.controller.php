<?php

$bookId = $_GET['id'];

$book = Book::get($bookId);

$reviews = Review::allBookReviews($bookId);

view('livro', compact('book', 'reviews'));
