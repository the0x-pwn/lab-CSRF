<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — CSRF Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body
    class="bg-[#090a0f] text-gray-200 min-h-screen flex items-center justify-center p-6 selection:bg-white selection:text-black antialiased">

    <div class="w-full max-w-md bg-[#0e1017] border border-zinc-800/80 rounded-2xl shadow-2xl p-8 space-y-6">

        <div class="space-y-1.5">
            <h2 class="text-xl font-semibold tracking-tight text-white">Sign in to Sandbox</h2>
            <p class="text-sm text-zinc-500 font-normal">Enter your playground instance credentials<br>Email :
                csrf@lab.com<br> Pass : csrf</p>
        </div>

        <form id="form" action="/login" method="POST" class="space-y-4">
            <input type="hidden" name="csrf" value="<?= session()->get('csrf') ?>">
            <div class="space-y-1.5">
                <label class="text-xs font-medium text-zinc-400 tracking-wide block">Email</label>
                <input id="email" type="text" name="email" placeholder="admin@admin.com" autocomplete="off"
                    class="w-full px-3.5 py-2.5 bg-zinc-900/40 border border-zinc-800 rounded-lg text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-zinc-500 focus:bg-zinc-900/80 transition-all">
                <p id="outputEmail"
                    class="text-xs font-medium text-rose-400/90 pt-1.5 min-h-[1.25rem] empty:hidden transition-all duration-150 ease-in-out">
                </p>
            </div>

            <div class="space-y-1.5">
                <label class="text-xs font-medium text-zinc-400 tracking-wide block">Password</label>
                <input id="password" type="password" name="password" placeholder="••••••••"
                    class="w-full px-3.5 py-2.5 bg-zinc-900/40 border border-zinc-800 rounded-lg text-white text-sm placeholder-zinc-600 focus:outline-none focus:border-zinc-500 focus:bg-zinc-900/80 transition-all">
                <p id="outputPassword"
                    class="text-xs font-medium text-rose-400/90 pt-1.5 min-h-[1.25rem] empty:hidden transition-all duration-150 ease-in-out">
                </p>

            </div>

            <button type="submit"
                class="w-full py-2.5 px-4 bg-white hover:bg-zinc-200 text-black font-semibold text-sm rounded-lg shadow-sm transition-colors duration-150 mt-2">
                Continue to Dashboard
            </button>
        </form>
    </div>
    <script>
        const form = document.querySelector('#form');

        form.addEventListener('submit', (e) => {
            e.preventDefault();

            let is_valid = true;

            const email = document.querySelector('#email').value;
            const password = document.querySelector('#password').value;

            const outputEmail = document.querySelector('#outputEmail');

            if (email.length < 1) {
                outputEmail.textContent = "email required";
                is_valid = false;
            } else {
                outputEmail.textContent = "";
            }

            if (password.length < 1) {
                outputPassword.textContent = "password required";
                is_valid = false;
            } else {
                outputPassword.textContent = "";
            }

            if (is_valid) {
                form.submit();
            }
        });
    </script>
</body>

</html>