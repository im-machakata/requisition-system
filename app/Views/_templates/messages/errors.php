<?php if ($this->data['error']) : ?>
    <div class="col-12">
        <div class="text-white bg-danger p-2 mb-4 rounded">
            <strong>Error:</strong>
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
