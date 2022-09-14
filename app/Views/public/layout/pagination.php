<?php $pager->setSurroundCount(2); ?>
<br />
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="&laquo;">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="Prev">
                <span aria-hidden="true">Prev</span>
            </a>
        </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
        <li class="page-item <?= $link['active'] ? 'active"' : '' ?>">
            <a class="page-link" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                <span aria-hidden="true"><?= lang('Pager.next') ?></span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="&raquo;">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
        <?php endif ?>
    </ul>
</nav>