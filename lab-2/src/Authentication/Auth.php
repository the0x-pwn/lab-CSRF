<?php

namespace Src\Authentication;

use PDO;

class Auth
{
    public static function login(string $email, string $password): void
    {
        $db = db()->prepare("SELECT * FROM users WHERE email = :email");
        $db->execute([
            ":email" => trim($email),
        ]);

        $user = $db->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session()->set('login', 'true');
            session()->set('email', $user['email']);
            session()->set('id', $user['id']);
            flash()->set(['type' => 'success', 'message' => 'Welcome back ' . explode('@', session()->get('email'))[0]]);
            response()->redirect('/dashboard');
        }

        flash()->set(['type' => 'error', 'message' => 'invalid email or password']);
        response()->redirect('/login');
    }

    public static function email(): string
    {
        return session()->get('email');
    }

    public static function id(): int
    {
        return session()->get('id');
    }

    public static function checkEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash()->set(['type' => 'error', 'message' => 'Please enter a valid email address']);
            response()->redirect('/dashboard');
        }
    }

    public static function isLoggedIn(): bool
    {
        if (session()->exists('login') && session()->get('login') === 'true') {
            return true;
        }
        return false;
    }

    public function logout()
    {
        session()->destroy();
        response()->redirect('/');
    }
    public static function isValidEmail(string $email): bool
    {
        $stmt = db()->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return (bool) $stmt->fetchColumn();
    }
}
