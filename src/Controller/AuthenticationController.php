<?php

namespace App\Controller;

use App\Model\User;

class AuthenticationController
{
    public function verifyLoginCredentials(User $user, string $email, string $password, string $confirmPassword): array
    {
        $errors = [];

        if ($user->findOneByEmail($email) !== false && $user->findOneByEmail($email)->getId() !== $_SESSION['user']->getId()) {
            $errors[] = "Cet email est déjà utilisé. Veuillez en choisir un autre.";
        }

        $passwordPattern = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/";
        if (!preg_match($passwordPattern, $password)) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
        }

        if ($password !== $confirmPassword) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }

        return $errors;
    }


    public function register(string $email, string $password, string $confirmPassword): bool
    {
        $user = new User();

        $errors = $this->verifyLoginCredentials($user, $email, $password, $confirmPassword);

        if (empty($errors)) {
            unset($_SESSION['errors']);
            $_SESSION['success'] = "Votre compte a bien été créé.";

            $user->setEmail($email);
            $user->setPassword($password);

            $user->create();

            $_SESSION['user'] = $user;

            return true;
        }else {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_inputs'] = $_POST;

            return false;
        }
    }


    public function login(string $email, string $password): bool
    {
        $user = new User();
        $user = $user->findOneByEmail($email);
        if ($user === false) {
            $_SESSION['error'] = "Les identifiants fournis ne correspondent à aucun utilisateur";
            $_SESSION['old_inputs'] = $_POST;

            return false;
        }else {
            $userpassword = $user->getPassword();
            if ($userpassword == $password) {
                $_SESSION['success'] = "Vous êtes connecté.";

                $user->connect();

                $_SESSION['user'] = $user;

                return true;
            } else {
                $_SESSION['error'] = "Les identifiants fournis ne correspondent à aucun utilisateur";
                $_SESSION['old_inputs'] = $_POST;

                return false;
            }
        }
    }

 
    public function updateProfile(string $email, string $password, string $confirmPassword): bool
    {
        $user = new User();

        $errors = $this->verifyLoginCredentials($user, $email, $password, $confirmPassword);

        if (empty($errors)) {
            unset($_SESSION['errors']);

            $user->setEmail($email);
            $user->setPassword($password);

            $user->update();

            $_SESSION['user'] = $user;

            return true;
        }else {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_inputs'] = $_POST;

            return false;
        }
    }
}