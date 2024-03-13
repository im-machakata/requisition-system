<?php if ($this->data['error']) : ?>
    <div class="ol-12">
        <div class="alert alert-danger border-danger">
            <?php
            $errors = $this->data['error'];
            if (is_array($errors)) {
                $errorIds = array_keys($errors);
                $error = $errors[$errorIds[0]];
            } else if (is_string($errors)) {
                $error = $errors;
            }
            // print just the first error message
            echo esc($error); ?>
        </div>
    </div>
<?php endif;
