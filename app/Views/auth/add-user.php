<?php
extract($this->data);
$this->setVar('title', 'Add New User');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center bg-primary py-5" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-2 p-3 bg-white my-lg-2" style="width: 900px;">
        <?= $this->include('_templates/header'); ?>
        <form action="/auth/add-user" method="post" class="col-12 row mt-2">
            <?php if (isset($this->data['error'])) :
                $this->setVar('error', $this->data['error']);
                echo $this->include('_templates/errors');
            endif; ?>
            <div class="col-lg-4">
                <div class="mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="Name" value="<?= $old('Name') ?>" id="name" class="form-control" placeholder="John" autocomplete="off" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-4">
                    <label for="surname" class="form-label">Surname</label>
                    <input type="surname" name="Surname" value="<?= $old('Surname') ?>" id="surname" class="form-control" placeholder="Doe" autocomplete="off" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="Phone" id="phone" value="<?= $old('Phone') ?>" class="form-control" placeholder="26371234567" autocomplete="off" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="Username" id="username" value="<?= $old('Username') ?>" class="form-control" placeholder="john.doe" autocomplete="off" required>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="Email" id="email" value="<?= $old('Email') ?>" class="form-control" placeholder="john.doe@example.com" autocomplete="off" required>
                </div>
            </div>
            <div class="col-lg-4">
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
</main>
<?php echo $this->include('_templates/footer'); ?>