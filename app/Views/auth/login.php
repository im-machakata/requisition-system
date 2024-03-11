<?php
$this->setVar('title', 'Login');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center bg-light" style="height: 100vh">
    <div class="row justify-content-center shadow rounded-4 p-3 bg-white mx-2" style="max-width: 400px;">
        <?php echo $this->include('_templates/header'); ?>
        <?php if (isset($this->data['error'])) :
            echo $this->include('_templates/errors');
        endif; ?>
        <form action="/auth/login" method="post" class="d-block col-12">
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Username" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off" required>
            </div>
            <div class="mb-2">
                <button class="btn btn-lg btn-primary rounded-0 mt-2 w-100" type="submit">Login</button>
            </div>
        </form>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>