<?php
$this->setVar('title', 'Home');
echo $this->include('_templates/head'); ?>
<main class="flex justify-center place-items-center h-screen">
    <div class="login-wrapper">
        <div class="login-header text-center">
            <img src="" alt="">
            <h1 class="font-bold text-cyan-800">Municipality of Rutenga</h1>
            <p class="mb-4 text-gray-700">Online Requisition System</p>
        </div>
        <form action="/auth/login" method="post">
            <div class="mb-4">
                <label for="username" class="sr-only">Username</label>
                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <button type="submit" class="text-lg bg-cyan-600">Login</button>
            </div>
        </form>
    </div>
</main>