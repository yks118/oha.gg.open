<?php
if (isset($pager) && $pager instanceof \CodeIgniter\Pager\PagerRenderer)
{
    $pager->setSurroundCount(2);
    ?>
<ul class="pagination">
    <li class="page-item <?php echo $pager->hasPrevious() ? '' : 'disabled'; ?>">
        <a class="page-link" href="<?php echo $pager->getFirst(); ?>">
            <!-- Download SVG icon from https://tabler.io/icons/icon/chevrons-left -->
            <i class="ti ti-chevrons-left"></i>
        </a>
    </li>

    <li class="page-item <?php echo $pager->hasPrevious() ? '' : 'disabled'; ?>">
        <a class="page-link" href="<?php echo $pager->getPrevious(); ?>">
            <!-- Download SVG icon from https://tabler.io/icons/icon/chevron-left -->
            <i class="ti ti-chevron-left"></i>
        </a>
    </li>

    <?php
    if (count($pager->links()) > 0)
    {
        foreach ($pager->links() as $link)
        {
            ?>
    <li class="page-item <?php echo $link['active'] ? 'active' : ''; ?>">
        <a class="page-link" href="<?php echo $link['uri']; ?>"><?php echo $link['title']; ?></a>
    </li>
            <?php
        }
    }
    else
    {
        ?>
    <li class="page-item active">
        <a class="page-link" href="<?php echo current_url(true)->addQuery('page', 1); ?>">1</a>
    </li>
        <?php
    }
    ?>

    <li class="page-item <?php echo $pager->hasNext() ? '' : 'disabled'; ?>">
        <a class="page-link" href="<?php echo $pager->getNext(); ?>">
            <!-- Download SVG icon from https://tabler.io/icons/icon/chevron-right -->
            <i class="ti ti-chevron-right"></i>
        </a>
    </li>

    <li class="page-item <?php echo $pager->hasNext() ? '' : 'disabled'; ?>">
        <a class="page-link" href="<?php echo $pager->getLast(); ?>">
            <!-- Download SVG icon from https://tabler.io/icons/icon/chevrons-right -->
            <i class="ti ti-chevrons-right"></i>
        </a>
    </li>
</ul>
    <?php
}
