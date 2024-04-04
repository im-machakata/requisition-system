<?php
extract($this->data);
$this->setVar('title', 'User Reports');
echo $this->include('_templates/head'); ?>
<main class="container-fluid">
    <div class="container-fluid">
        <nav class="mb-0 mt-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Reports</li>
            </ol>
        </nav>
        <h1 class="text-body h2 fw-bold">Registered Users</h1>
        <div class="text-body">
            There are <?= count($users) ?> registered users
        </div>
        <div>
            <?php foreach ($users as $user) : ?>
                <div class="blockquote bg-primary text-white my-3 p-2 px-3 rounded">
                    <div class="fw-bold small"><?= $user->Username ?> </div>
                    <div class="h6 font-sm mb-2"><?= $user->Name . ' ' . $user->Surname ?></div>
                </div>
            <?php endforeach; ?>
            <?= $pager ? $pager->links() : '' ?>
        </div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>