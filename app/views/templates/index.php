   <!DOCTYPE html>
   <html lang="en" class="h-full">

   <head>
       <?php include_once __DIR__ . '/partials/_head.php'; ?>
   </head>

   <body class="relative min-h-screen flex flex-col bg-gradient-to-br from-[var(--color-neutral)] via-gray-50 to-[var(--color-secondary)]/10 overflow-x-hidden">
       <!-- Animated background shapes -->
       <div class="pointer-events-none select-none fixed top-0 left-0 w-full h-full z-0">
           <div class="absolute top-[-80px] left-[-80px] w-96 h-96 bg-[var(--color-primary)] opacity-10 rounded-full blur-3xl animate-pulse-slow"></div>
           <div class="absolute bottom-[-100px] right-[-100px] w-[28rem] h-[28rem] bg-[var(--color-secondary)] opacity-10 rounded-full blur-3xl animate-pulse-slow"></div>
           <div class="absolute top-1/2 left-1/2 w-72 h-72 bg-[var(--color-accent)] opacity-5 rounded-full blur-2xl animate-pulse"></div>
       </div>

       <div class="relative z-10 flex flex-col min-h-screen">
           <?php include_once __DIR__ . '/partials/_header.php'; ?>

           <?php include_once __DIR__ . '/partials/_main.php'; ?>

           <?php include_once __DIR__ . '/partials/_footer.php'; ?>
       </div>

       <!-- Custom JS -->
       <style>
           @keyframes pulse-slow {
               0%, 100% { opacity: 0.1; transform: scale(1); }
               50% { opacity: 0.2; transform: scale(1.08); }
           }
           .animate-pulse-slow {
               animation: pulse-slow 8s cubic-bezier(0.4, 0, 0.6, 1) infinite;
           }
       </style>
   </body>

   </html>