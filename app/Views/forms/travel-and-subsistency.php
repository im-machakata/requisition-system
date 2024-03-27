<?php

use CodeIgniter\I18n\Time;

$this->setVar('title', 'Travel &amp; Subsistency');
echo $this->include('_templates/head'); ?>
<main class="bg-primary">
    <div class="container-fluid" style="min-width: 100%;">
        <div class="row" style="min-height: 100vh;">
            <div class="col-lg-6 bg-white">
                <div class="container-fluid">
                    <div class="row mt-5 mb-4">
                        <nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Travel &amp; Subsistencies</li>
                            </ol>
                        </nav>
                        <h1 class="text-body h2 fw-bold">Travel &amp; Subsistencies Requisition</h1>
                        <div class="text-body mb-4">
                            Submit a new travel and subsistence requisition
                        </div>
                        <form action="/requests/travel-and-subsistencies" method="post" class="col-12 row mt-2">
                            <?= $this->include('_templates/alerts') ?>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="Amount" class="form-label">Amount</label>
                                    <input type="number" min="1" name="Amount" id="Amount" class="form-control" placeholder="50.00" value="<?= $old('Amount') ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="Reason" class="form-label">Reason</label>
                                    <textarea type="text" name="Reason" id="Reason" class="form-control" placeholder="I want to buy a new phone..." rows="4" required><?= $old('Reason') ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-4">
                                    <label for="OutFrom" class="form-label">From</label>
                                    <input type="date" name="OutFrom" id="OutFrom" class="form-control" placeholder="50.00" min="<?= Time::parse('now')->format('Y-m-d') ?>" value="<?= $old('OutFrom') ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-4">
                                    <label for="OutTo" class="form-label">To</label>
                                    <input type="date" name="OutTo" id="OutTo" value="<?= $old('OutTo') ?>" class="form-control" min="<?= Time::parse('tomorrow')->format('Y-m-d') ?>" placeholder="50.00" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-4">
                                    <label for="Days" class="form-label">Days</label>
                                    <input type="number" name="Days" id="Days" class="form-control" value="0" placeholder="5" value="<?= $old('Days') ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-2 col-12">
                                <button class="btn btn-primary btn-lg w-100" id="Submit" type="submit" disabled>Submit Requisition</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="container-fluid">
                    <div class="mt-5 mb-4 pt-lg-4">
                        <h2 class="text-white h2 fw-bold">My Requisitions</h2>
                        <div class="text-white">
                            <?php if ($requisitions) : ?>
                                You have <?= count($requisitions) ?> travel and subsistencies
                            <?php elseif (!$requisitions) : ?>
                                You have not made any travel and subsistencies requisitions.
                            <?php endif; ?>
                        </div>
                        <?php foreach ($requisitions as $requisition) : ?>
                            <div class="card border-0 my-3">
                                <div class="card-header bg-dark border-dark text-white">
                                    <div class="d-flex">
                                        <div class="flex-fill">
                                            Amount: $<?= number_format($requisition->Amount, 2) ?> USD
                                        </div>
                                        <div class="float-end">
                                            <span class="badge bg-primary"><?= str_replace('_', ' ', $requisition->Status) ?></span>
                                            <span class="badge bg-primary">Delete</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text mb-0">
                                        <?= $requisition->Reason ?>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-body-secondary">Last Updated: <?= $requisition->UpdatedAt->humanize() ?></small>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?= $pager ? $pager->links() : '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>