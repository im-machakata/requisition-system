<div class="col-12 text-center">
    <div class="h5 mb-2">
        <?php if (session()->get('user')) : ?>
            <div class="badge bg-primary"><?= session()->get('user')->department ?></div>
        <?php endif; ?>
    </div>
</div>