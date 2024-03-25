<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination ">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item <?= $pager->hasPrevious() ? '' : 'disabled' ?>">
                <a class="page-link border" href="<?= str_replace('/index.php','',$pager->getFirst()) ?>" aria-label="<?= lang('Pager.first') ?>">
                    <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link border" href="<?= str_replace('/index.php','',$pager->getPrevious()) ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item<?= $link['active'] ? ' active' : '' ?>">
                <a class="page-link border" href="<?= str_replace('/index.php','',$link['uri']) ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link border" href="<?= str_replace('/index.php','',$pager->getNext()) ?>" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link border" href="<?= str_replace('/index.php','',$pager->getLast()) ?>" aria-label="<?= lang('Pager.last') ?>">
                    <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>