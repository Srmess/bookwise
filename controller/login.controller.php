<?php

require '../Validation.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validation = Validation::validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ], $_POST);

    if ($validation->isInvalid('login_validation')) {
        header("Location: /login");

        exit();
    }

    $user = $database->query(

        query: "select * from users where email = :email",
        class: User::class,
        params: ['email' => $_POST['email']]

    )->fetch();

    if ($user) {

        $payloadPassword = $_POST['password'];
        $dbPassword = $user->password;

        $passwordVerification = password_verify($payloadPassword, $dbPassword);

        if (!$passwordVerification) {
            flash()->push('login_validation', ["Usuário ou senha incorretos"]);

            header("Location: /login");

            exit();
        }


        $_SESSION['auth'] = $user;

        flash()->push('message', "Seja bem-vindo(a) " . $user->name . " !");


        header("Location: /");

        exit();
    }
}

view('login');
