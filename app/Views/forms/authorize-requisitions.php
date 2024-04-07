<?php
extract($this->data);
$this->setVar('title', 'Authorize Requisitions');
echo $this->include('_templates/head'); ?>
<main class="bg-primary">
    <div class="container-fluid" style="min-width: 100%">
        <div class="row" style="min-height: 100vh; ">
            <div class="col-lg-6 bg-white">
                <div class="container-fluid">
                    <div class="mt-5 mb-4">
                        <nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Authorize Requisitions</li>
                            </ol>
                        </nav>
                        <h1 class="text-body h2 fw-bold">Recent Requisitions</h1>
                        <div class="text-body mb-4">
                            Here's a list of the recent requisitions requiring your attention.
                            <?= !$requisitions ? '<br> No new requisitions were found.' : '' ?>
                        </div>
                        <div class="row">
                            <?php foreach ($requisitions as $requisition) : ?>
                                <div class="col-lg-6 mb-4">
                                    <div class="card requisition border-dark h-100">
                                        <div class="card-header bg-dark text-white">
                                            <div class="d-flex">
                                                <div class="flex-fill fw-bold">
                                                    <i class="fa-solid fa-dollar-sign"></i>
                                                    <span class="amount">
                                                        <?= number_format($requisition->Amount, 2) ?>
                                                    </span> USD
                                                </div>
                                                <div class="float-end">
                                                    <span data-bs-title="<?= $requisition->Names ?>" class="badge bg-white text-body user" data-bs-toggle="tooltip">
                                                        <i class="fa-solid fa-user"></i>
                                                    </span>
                                                    <a href="#edit-status" class="badge bg-white text-body edit-status">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text mb-0 reason">
                                                <?= esc($requisition->Reason) ?>
                                            </p>
                                            <p class="card-text">
                                                <small class="text-body-secondary">Last Updated: <?= $requisition->UpdatedAt->humanize() ?></small>
                                            </p>
                                            <input type="hidden" class="id" value="<?= $requisition->ReqID ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?= $pager ? $pager->links() : '' ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="container-fluid">
                    <div class="mt-5 mb-4 pt-lg-4">
                        <h2 class="text-white h2 fw-bold">Update Requisition Status</h2>
                        <div class="text-white mb-2">
                            Approve / Cancel a submitted requisition
                        </div>
                        <?= $this->include('_templates/alerts'); ?>
                        <form action="/authorize-requisitions" method="post" class="mt-2">
                            <input type="hidden" id="ID" name="ID" value="" required>
                            <div class="card border-0 mt-4">
                                <div class="card-body row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="Amount" class="form-label">Amount</label>
                                            <p id="Amount" class="form-control bg-light">None</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="User" class="form-label">User</label>
                                            <p id="User" class="form-control bg-light">None</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="Reason" class="form-label">Reason</label>
                                            <p id="Reason" class="form-control bg-light">None</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="btn-group mb-4" role="group" aria-label="Vertical radio toggle button group">
                                            <input type="radio" class="btn-check" name="Status" id="StatusSubmitted" value="" autocomplete="off" disabled checked>
                                            <label class="btn btn-outline-primary" for="StatusSubmitted">Submitted</label>
                                            <input type="radio" class="btn-check" name="Status" value="<?= $statuses['Approve'] ?>" id="StatusApprove" autocomplete="off">
                                            <label class="btn btn-outline-primary" for="StatusApprove">Approve Requisition</label>
                                            <?php if ($statuses['CanReject']) : ?>
                                                <input type="radio" class="btn-check" name="Status" id="StatusDismiss" value="Rejected" autocomplete="off">
                                                <label class="btn btn-outline-primary" for="StatusDismiss">Reject Requisition</label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="mb-2 col-12">
                                        <button id="UpdateRequisition" class="btn btn-primary btn-lg w-100" type="submit">Update Requisition</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>