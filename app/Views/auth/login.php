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
        <?php if (isset($this->data['error'])) :
            $this->setVar('error', $this->data['error']);
            echo $this->include('_templates/errors');
        endif; ?>
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
                <button class="btn" type="submit">Login</button>
            </div>
        </form>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>