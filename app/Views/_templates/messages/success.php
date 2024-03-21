<?php if ($this->data['success']) : ?>
    <div class="col-12">
        <div class="text-white bg-success p-2 mb-4 rounded">
            <?= esc($this->data['success']); ?>
        </div>
    </div>
<?php endif;
