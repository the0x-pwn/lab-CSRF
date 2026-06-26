<div id="loader" class="fixed inset-0 z-[9999] bg-[#090a0f] flex items-center justify-center overflow-hidden">

    <!-- Grid Background -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#16171d_1px,transparent_1px),linear-gradient(to_bottom,#16171d_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)]"></div>

    <!-- Glow -->
    <div class="absolute inset-0 pointer-events-none"
        style="background: radial-gradient(ellipse 55% 55% at 50% 50%, rgba(74,222,128,0.055) 0%, transparent 70%), radial-gradient(ellipse 40% 40% at 30% 60%, rgba(56,189,248,0.04) 0%, transparent 70%);">
    </div>

    <!-- صورة الخلفية الشفافة -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <img src="img/hacker.png" alt=""
            style="width: min(600px, 75vw); opacity: 0.05; filter: blur(0.5px) saturate(0.4); mix-blend-mode: screen; animation: breathe 8s ease-in-out infinite;">
    </div>

    <!-- المحتوى -->
    <div class="relative z-10 flex flex-col items-center gap-6">
        <div class="w-14 h-14 border-2 border-zinc-800 border-t-white rounded-full animate-spin"></div>
        <div class="text-center">
            <div class="text-xs font-semibold tracking-[0.3em] text-zinc-500">LAB-CSRF</div>
            <div class="mt-2 text-sm text-zinc-400">Initializing Environment...</div>
        </div>
    </div>

</div>

<style>
    @keyframes breathe {

        0%,
        100% {
            opacity: 0.05;
            transform: scale(1);
        }

        50% {
            opacity: 0.09;
            transform: scale(1.03);
        }
    }
</style>

<script>
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('content').style.display = 'block';
        }, 2000);
    });
</script>


<?php if (flash()->exists('type') && flash()->get('type') === 'success'): ?>
    <div class="fixed top-6 right-6 z-50 max-w-sm w-full p-4 bg-[#0e1017] border border-emerald-900/40 rounded-xl shadow-2xl flex items-center gap-3 animate-fade-in animate-duration-300">
        <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_#10b981] shrink-0"></span>
        <p class="text-sm font-medium text-emerald-400/90 tracking-wide leading-relaxed">
            Success: <?= flash()->get('message'); ?>
        </p>
    </div>
<?php endif; ?>
<?php if (flash()->exists('type') && flash()->get('type') === 'error'): ?>
    <div class="fixed top-6 right-6 z-50 max-w-sm w-full p-4 bg-[#0e1017] border border-rose-950 rounded-xl shadow-2xl flex items-center gap-3 animate-fade-in animate-duration-300">
        <span class="w-2 h-2 rounded-full bg-rose-500 shadow-[0_0_8px_#f43f5e] shrink-0"></span>
        <p class="text-sm font-medium text-rose-400/90 tracking-wide leading-relaxed">
            Error: <?= flash()->get('message'); ?>
        </p>
    </div>
<?php endif; ?>
<?php flash()->clear() ?>

{{content}}