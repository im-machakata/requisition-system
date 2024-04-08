<?php
extract($this->data);
$this->setVar('title', 'Add New User');
echo $this->include('_templates/head'); ?>
<main class="container-fluid">
    <div class="row" style="min-height: 100vh;">
        <div class="col-lg-6 bg-white h-full pt-2">
            <div class="container-fluid mt-4">
                <form action="/auth/add-user" method="post" class="col-12 row mx-auto mt-2 h-full">
                    <div class="col-12">
                        <nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add New User</li>
                            </ol>
                        </nav>
                        <h1 class="text-body h2 fw-bold">Register User</h1>
                        <div class="text-body mb-4">
                            Create an account for a new user
                        </div>
                    </div>
                    <?= $this->include('_templates/alerts'); ?>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="Name" value="<?= $old('Name') ?>" id="name" class="form-control" placeholder="John" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="surname" class="form-label">Surname</label>
                            <input type="surname" name="Surname" value="<?= $old('Surname') ?>" id="surname" class="form-control" placeholder="Doe" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="Email" id="email" value="<?= $old('Email') ?>" class="form-control" placeholder="john.doe@example.com" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" name="Phone" id="phone" value="<?= $old('Phone') ?>" class="form-control" placeholder="26371234567" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="Username" id="username" value="<?= $old('Username') ?>" class="form-control" placeholder="john.doe" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="Password" id="password" class="form-control" placeholder="john cena" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="department" class="form-label">Department</label>
                            <select name="DepartmentID" id="department" class="form-control" required>
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $department) : ?>
                                    <option value="<?= $department->ID ?>"><?= $department->Name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="Gender" id="gender" class="form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-4 col-12">
                        <button class="btn btn-primary btn-lg w-100" type="submit">Add User</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6 bg-light border-start border-4">
            <div class="container-fluid">
                <div class="header mt-5 mb-4 pt-lg-4">
                    <h2 class="text-body fw-bold">Registered Users</h2>
                    <p>Here's a list of all registered users.</p>
                </div>
                <div class="row">
                    <?php foreach ($users as $user) : ?>
                        <div class="col-lg-6">
                            <div class="border bg-white my-3 card">
                                <div class="card-body">
                                    <div class="icon">
                                        <i class="fa-solid fa-user-circle fa-2x text-muted"></i>
                                    </div>
                                    <div class="fw-bold">
                                        <?= $user->Username ?>
                                    </div>
                                    <div class="mb-2">
                                        <?= $user->Names ?>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-muted">
                                        Joined: <?= $user->CreatedAt->toLocalizedString('MMM d, yyyy') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?= $pager ? $pager->links() : '' ?>
            </div>
        </div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>