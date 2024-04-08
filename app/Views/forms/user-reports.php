<?php
extract($this->data);
$this->setVar('title', 'User Reports');
echo $this->include('_templates/head'); ?>
<main class="bg-light">
    <div class="container-fluid" style="min-width: 100%">
        <div class="row" style="min-height: 100vh; ">
            <div class="col-lg-6 bg-white">
                <div class="container-fluid">
                    <div class="mt-5 mb-4">
                        <nav class="mb-0" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Reports</li>
                            </ol>
                        </nav>
                        <h1 class="text-body h2 fw-bold">User Reports</h1>
                        <div class="text-body mb-4">
                            <?php if ($account->Username) : ?>
                                Showing search results for <?= $account->Names ?>
                            <?php else : ?>
                                Please select a username to search
                            <?php endif ?>
                        </div>
                        <form action="/user-reports" method="get" class="col-12 row mt-2">
                            <?= $this->include('_templates/alerts'); ?>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <select name="Username" id="User" class="form-control">
                                        <?php foreach ($usernames as $users) : ?>
                                            <option value="<?= $users->Username ?>" <?= $account->Username == $users->Username ? 'selected' : '' ?>><?= $users->Names ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-12">
                                <button class="btn btn-primary btn-lg w-100" type="submit">Find Submittions</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 border-start border-4">
                <div class="container-fluid">
                    <div class="mt-5 mb-4 pt-lg-4">
                        <h2 class="text-body h2 fw-bold">User Requisitions</h2>
                        <div class="text-body">
                            <?php if ($results && $account->Username) : ?>
                                Showing you <?= count($results) ?> submittions by <?= $account->Names ?>
                            <?php elseif (!$results && $account->Username) : ?>
                                <?= $account->Names ?> has not made any requisition submittions.
                            <?php else : ?>
                                Please select a user to filter from
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <?php foreach ($results as $requisition) : ?>
                                <div class="col-12">
                                    <div class="card border-dark my-3">
                                        <div class="card-header bg-dark border-dark text-white">
                                            <div class="d-flex">
                                                <div class="flex-fill fw-bold">
                                                    $<?= number_format($requisition->Amount, 2) ?> USD
                                                </div>
                                                <div class="float-end">
                                                    <span class="badge bg-primary"><?= str_replace('_', ' ', $requisition->Status) ?></span>
                                                    <!-- <span class="badge bg-primary">Delete</span> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text mb-0">
                                                <?= esc($requisition->Reason) ?>
                                            </p>
                                            <p class="card-text">
                                                <small class="text-body-secondary">Last Updated: <?= $requisition->UpdatedAt->humanize() ?></small>
                                            </p>
                                        </div>
                                        <div class="card-footer border-dark">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <small>From: <?= $requisition->OutFrom ? $requisition->OutFrom : 'N/A' ?>
                                                    </small>
                                                </div>
                                                <div class="col-lg-4">
                                                    <small>To: <?= $requisition->OutTo ? $requisition->OutTo : 'N/A' ?></small>
                                                </div>
                                                <div class="col-lg-4">
                                                    <small>Type: <?= str_replace('_', ' ', $requisition->Type) ?></small>
                                                </div>
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
        </div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>