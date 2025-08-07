<?php

if (!auth()->id) {
  header('location: /');
}

$books = Book::allMyBooks(auth()->id);

view('meus-livros', compact('books'));
