<?php

require 'Validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation = Validation::validate([

        'name' => ['required'],
        'email' => ['required', 'email', 'confirmed', 'unique:users'],
        'password' => ['required', 'min:8', 'max:30', 'strong']

    ], $_POST);

    if ($validation->isInvalid('register_validation')) {
        header("Location: /login");

        exit();
    }

    $database->query(

        query: "insert into users (name, email, password) values (:name, :email, :password)",

        params: [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' =>  password_hash($_POST['password'], PASSWORD_BCRYPT)
        ]

    );


    flash()->push('message', 'Registrado com sucesso!');

    header('location: /');

    exit();
};

header('location: /login');

exit();
