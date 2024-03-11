<?php if ($this->data['error']) : ?>
    <div class="alert alert-danger col-12">
        <?php $errors = $this->data['error'];
        $errorIds = array_keys($errors);
        
        // print just the first error message
        echo esc($errors[$errorIds[0]]); ?>
    </div>
<?php endif;
