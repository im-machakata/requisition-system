<?php
$this->setVar('title', 'Not Authorised!');
echo $this->include('_templates/head'); ?>
<main class="d-flex flex-column justify-content-center align-items-center bg-light" style="height: 100vh">
    <div class="justify-content-center border border-danger border-4 rounded-4 p-3 px-lg-4 bg-white mx-2" style="max-width: 400px;">
        <h1 class="text-center text-danger fw-bold">Error #401</h1>
        <div class="text-sm text-danger text-center mb-3 text-capitalize">You're Not Authorised to View this page</div>
        <div><a href="/" class="btn btn-primary d-block">Return Home</a></div>
    </div>
</main>
<?php echo $this->include('_templates/footer'); ?>