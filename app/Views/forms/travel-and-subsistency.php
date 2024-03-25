<?php
$this->setVar('title', 'Travel &amp; Subsistency');
echo $this->include('_templates/head'); ?>
<main class="bg-primary">
    <div class="container-fluid" style="min-width: 100%">
        <div class="row" style="min-height: 100vh; ">
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
                        <form action="/auth/add-user" method="post" class="col-12 row mt-2">
                            <?= $this->include('_templates/alerts') ?>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="amount" class="form-label">Amount</label>
                                    <input type="number" min="1" name="amount" id="amount" class="form-control" placeholder="50.00" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="reason" class="form-label">Reason</label>
                                    <textarea type="text" name="reason" id="reason" class="form-control" placeholder="I want to buy a new phone..." rows="4" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-4">
                                    <label for="from" class="form-label">From</label>
                                    <input type="date" name="from" id="from" class="form-control" placeholder="50.00" required>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="mb-4">
                                    <label for="to" class="form-label">To</label>
                                    <input type="date" name="to" id="to" class="form-control" placeholder="50.00" required>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="mb-4">
                                    <label for="from" class="form-label">Days</label>
                                    <input type="number" name="from" id="from" class="form-control" value="0" placeholder="5" readonly required>
                                </div>
                            </div>
                            <div class="mb-2 col-12">
                                <button class="btn btn-primary btn-lg w-100" type="submit">Submit Requisition</button>
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
                                You have <?= count($requisitions) ?> petty cash submittions
                            <?php elseif (!$requisitions) : ?>
                                You have not made any petty cash requisitions.
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