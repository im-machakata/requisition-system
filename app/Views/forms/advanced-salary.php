<?php
$this->setVar('title', 'Advanced Salary');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center bg-primary" style="min-height: 100vh">
    <div class="row justify-content-center shadow rounded-2 p-3 bg-white" style="width: 500px;">
        <?= $this->include('_templates/header'); ?>
        <?php if (isset($this->data['error'])) :
            $this->setVar('error', $this->data['error']);
            echo $this->include('_templates/errors');
        endif; ?>
        <form action="/requests/advanced-salaries" method="post" class="col-12 row mt-2">
            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" min="1" name="amount" id="amount" class="form-control" placeholder="50.00" autocomplete="off" required>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="mb-4">
                    <label for="reason" class="form-label">Reason</label>
                    <textarea type="text" name="reason" id="reason" class="form-control" placeholder="I want to buy a new phone..." required></textarea>
                </div>
            </div>
            <div class="mb-2 col-12">
                <button class="btn btn-primary btn-lg w-100" type="submit">Submit Requisition</button>
            </div>
        </form>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>