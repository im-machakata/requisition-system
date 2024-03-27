<?php
$this->setVar('title', 'Home');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center container-fluid bg-light" style="min-height: 100vh">
    <div class="row justify-content-center container-fluid p-3">
        <?= $this->include('_templates/header'); ?>
        <?= $this->include('_templates/user-type'); ?>
        <div class="col-12 row g-4 mb-4">
            <div class="col-sm-6 col-lg-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title">Advanced Salary</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="/requests/advanced-salaries" class="btn btn-primary w-100">New Salary Requisition</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title">Petty Cash</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="/requests/petty-cash" class="btn btn-primary w-100">New Petty Cash Requisition</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title">Travel &amp; Subsistencies</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="/requests/travel-and-subsistencies" class="btn btn-primary w-100">Travel & Subsistencies Requisition</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title">View User Report</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary w-100">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title">Authorization</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary w-100">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="/auth/change-password" class="btn btn-primary w-100">Change Password</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <h5 class="card-title">Logout</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="/auth/logout" class="btn btn-primary w-100">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>