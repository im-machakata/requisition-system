<?php
$this->setVar('title', 'Travel &amp; Subsistency');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center bg-primary" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-2 p-3 bg-white" style="width: 500px;">
        <?= $this->include('_templates/header'); ?>
        <?= $this->include('_templates/alerts'); ?>
        <form action="/auth/add-user" method="post" class="col-12 row mt-2">
            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" min="1" name="amount" id="amount" class="form-control" placeholder="50.00" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="reason" class="form-label">Reason</label>
                    <textarea type="text" name="reason" id="reason" class="form-control" placeholder="I want to buy a new phone..." required></textarea>
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
</main>
<?php echo $this->include('_templates/footer'); ?>