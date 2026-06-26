<?php

namespace App\Controllers;

use Src\Authentication\Auth;

class DashboardController
{
    public function index()
    {
        view('dashboard');
    }

    public function update_email()
    {
        if (!Auth::isLoggedIn()) {
            response()->responseJSON('Please log in to continue.', 401);
        }

        $email = trim(request()->input('email'));
        Auth::checkEmail($email);

        if (Auth::isValidEmail($email)) {
            flash()->set(['type' => 'error', 'message' => 'Email already exists']);
            response()->redirect('/dashboard');
        }

        $stmt = db()->prepare('UPDATE users SET email = :email WHERE id = :id');
        $stmt->execute([
            ':email' => $email,
            ':id' => Auth::id(),
        ]);

        if ($stmt) {
            flash()->set(['type' => 'success', 'message' => 'Email updated successfully']);
            session()->set('email', $email);
            response()->redirect('/dashboard');
        }

        flash()->set(['type' => 'error', 'message' => 'Failed to update email address']);
        response()->redirect('/dashboard');
    }
}
