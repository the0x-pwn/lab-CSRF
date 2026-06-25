<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSRF Lab Infrastructure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .bg-hacker-image {
            position: fixed;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .bg-hacker-image img {
            width: min(700px, 80vw);
            height: auto;
            opacity: 0.04;
            filter: blur(0.5px) saturate(0.5);
            mix-blend-mode: screen;
            animation: breathe 8s ease-in-out infinite;
            user-select: none;
            pointer-events: none;
        }

        @keyframes breathe {

            0%,
            100% {
                opacity: 0.04;
                transform: scale(1);
            }

            50% {
                opacity: 0.07;
                transform: scale(1.03);
            }
        }

        /* طبقة glow خلف الصورة */
        .bg-glow {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                radial-gradient(ellipse 55% 55% at 50% 50%, rgba(74, 222, 128, 0.055) 0%, transparent 70%),
                radial-gradient(ellipse 40% 40% at 30% 60%, rgba(56, 189, 248, 0.04) 0%, transparent 70%);
            animation: glow-shift 10s ease-in-out infinite alternate;
        }

        @keyframes glow-shift {
            0% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .cursor-blink {
            animation: blink 1s step-end infinite;
        }
    </style>
</head>

<body
    class="bg-[#090a0f] text-gray-200 min-h-screen flex flex-col justify-between selection:bg-white selection:text-black antialiased">

    <!-- Grid pattern -->
    <div
        class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#16171d_1px,transparent_1px),linear-gradient(to_bottom,#16171d_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] pointer-events-none">
    </div>

    <div class="bg-glow"></div>

    <div class="bg-hacker-image">
        <img src="img/hacker.png" alt="">
    </div>

    <header class="relative z-10 max-w-7xl w-full mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-xl font-semibold tracking-widest text-green-400 font-mono">LAB-CSRF-3</div>
        <div class="flex items-center justify-end">
            <img src="img/hacker.png" alt="Logo" class="block h-14 w-auto object-contain">
        </div>
    </header>

    <main class="relative z-10 max-w-3xl w-full mx-auto px-6 text-center my-auto space-y-8">
        <div
            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-zinc-900 border border-zinc-800 text-zinc-400 text-xs font-medium tracking-wide">
            <span class="w-1.5 h-1.5 rounded-full bg-zinc-400 animate-pulse"></span>
            Cross-Site Request Forgery Environment
        </div>

        <h1 class="text-4xl sm:text-6xl font-bold tracking-tight text-white max-w-2xl mx-auto leading-[1.1]">
            Master web security through execution.
        </h1>

        <p class="text-zinc-400 text-base sm:text-lg max-w-xl mx-auto font-normal leading-relaxed">
            A refined, minimalist dark sandbox housing 5 tactical deployment scenarios engineered to analyze, exploit,
            and mitigate CSRF vulnerabilities.
        </p>

        <?php if (!session()->exists('login') && session()->get('login') !== 'true'): ?>
            <div class="pt-2">
                <a href="/login"
                    class="inline-flex items-center justify-center px-6 py-3 bg-white hover:bg-zinc-200 text-black font-semibold text-sm rounded-lg shadow-sm transition-all duration-150">
                    Launch Environment
                </a>
            </div>
        <?php endif; ?>

        <?php if (session()->exists('login') && session()->get('login') === 'true'): ?>
            <div class="pt-2">
                <a href="/dashboard"
                    class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-500 text-white font-semibold text-sm rounded-lg shadow-sm transition-all duration-150">
                    Dashboard
                </a>
            </div>
        <?php endif; ?>
    </main>

    <footer class="relative z-10 py-6 flex items-center justify-center">
        <div class="font-mono text-xs flex flex-col items-start gap-1" style="width: fit-content;">

            <div class="flex items-center gap-2 text-zinc-600">
                <span class="text-green-500">the0x@csrf-lab</span>
                <span class="text-zinc-500">:</span>
                <span class="text-blue-400">~</span>
                <span class="text-zinc-500">$</span>
                <span id="cmd-text" class="text-zinc-300 ml-1"></span>
                <span id="cursor1" class="text-green-400 opacity-0">█</span>
            </div>

            <div id="output-line" class="flex items-center gap-2 opacity-0">
                <span class="text-green-400">✔</span>
                <span id="output-text" class="text-green-400/70"></span>
                <span id="cursor2" class="text-green-400 opacity-0 animate-pulse">█</span>
            </div>

        </div>
    </footer>
    <script>
        function typeText(elementId, text, speed, callback) {
            const el = document.getElementById(elementId);
            let i = 0;
            const interval = setInterval(() => {
                el.textContent += text[i];
                i++;
                if (i >= text.length) {
                    clearInterval(interval);
                    if (callback) callback();
                }
            }, speed);
        }

        window.addEventListener('load', () => {
            setTimeout(() => {

                const cursor1 = document.getElementById('cursor1');
                cursor1.classList.remove('opacity-0');
                cursor1.classList.add('cursor-blink');

                setTimeout(() => {
                    typeText('cmd-text', 'cat csrf.sh', 80, () => {

                        setTimeout(() => {
                            cursor1.classList.add('opacity-0');

                            const outputLine = document.getElementById('output-line');
                            outputLine.classList.remove('opacity-0');

                            typeText('output-text', 'Isolated Instance // Academic Security Infrastructure', 45, () => {
                                const cursor2 = document.getElementById('cursor2');
                                cursor2.classList.remove('opacity-0');
                            });
                        }, 400);
                    });
                }, 300);

            }, 2000);
        });
    </script>

</body>

</html>