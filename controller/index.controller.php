<?php

$searchparam = $_REQUEST['searchparam'] ?? '';

$books =  Book::all($searchparam);


view('index', compact('books'));
