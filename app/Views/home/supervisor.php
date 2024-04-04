<?php
$this->setVar('title', 'Home');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center container-fluid bg-light" style="min-height: 100vh">
    <div class="row justify-content-center container-fluid p-3">
        <?= $this->include('_templates/header'); ?>
        <?= $this->include('_templates/user-type'); ?>
        <?= $this->include('_templates/alerts'); ?>
        <div class="col-12 row g-4 mb-4 menu">
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-primary border-0">
                    <div class="card-body">
                        <a href="advanced-salaries" class="text-decoration-none text-center">
                            <i class="fa-thin fa-money-check-dollar-pen fa-6x my-0 d-block"></i>
                            <h3 class="card-title h5 mb-3">Advanced Salary</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-primary border-0">
                    <div class="card-body">
                        <a href="travel-and-subsistencies" class="text-decoration-none text-center">
                            <i class="fa-thin fa-plane-departure fa-6x my-0 d-block"></i>
                            <h3 class="card-title h5 mb-3">Travel &amp; Subsistences</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-primary border-0">
                    <div class="card-body">
                        <a href="petty-cash" class="text-decoration-none text-center">
                            <i class="fa-thin fa-money-bill-1 fa-6x my-0 d-block"></i>
                            <h3 class="card-title h5 mb-3">Petty Cash</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-primary border-0">
                    <div class="card-body">
                        <a href="user-reports" class="text-decoration-none text-center">
                            <i class="fa-thin fa-file-user fa-6x my-0 d-block"></i>
                            <h3 class="card-title h5 mb-3">View User Report</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-primary border-0">
                    <div class="card-body">
                        <a href="#" class="text-decoration-none text-center">
                            <i class="fa-thin fa-signature fa-6x my-0 d-block"></i>
                            <h3 class="card-title h5 mb-3">Authorization</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-primary border-0">
                    <div class="card-body">
                        <a href="auth/change-password" class="text-decoration-none text-center">
                            <i class="fa-thin fa-unlock-keyhole fa-6x my-0 d-block"></i>
                            <h3 class="card-title h5 mb-3">Change Password</h3>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-primary border-0">
                    <div class="card-body">
                        <a href="/auth/logout" class="text-decoration-none text-center">
                            <i class="fa-thin fa-arrow-right-from-bracket fa-6x my-0 d-block"></i>
                            <h3 class="card-title h5 mb-3">Logout</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>