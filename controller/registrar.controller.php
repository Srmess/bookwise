<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $resultado = $database->query(

        query: "insert into users (name, email, password) values (:name, :email, :password)",

        params: [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]

    );

    header('location: /login?mensagem=Registrado com sucesso!');

    exit();
};
