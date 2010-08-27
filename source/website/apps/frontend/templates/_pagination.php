<?php if (!isset($get_string)) $get_string = ''; ?>

<br />
<?php if ($pager->haveToPaginate()): ?>

  <div class="pagination">
    <a href="<?php echo url_for($page_url).'?'.$get_string.'page=1'; ?>">
      <<
    </a>

    <a href="<?php echo url_for($page_url).'?'.$get_string.'page='.$pager->getPreviousPage(); ?>">
      <
    </a>

    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <?php echo $page ?>
      <?php else: ?>
        <a href="<?php echo url_for($page_url).'?'.$get_string.'page='.$page; ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>

    <a href="<?php echo url_for($page_url).'?'.$get_string.'page='.$pager->getNextPage(); ?>">
      >
    </a>

    <a href="<?php echo url_for($page_url).'?'.$get_string.'page='.$pager->getLastPage(); ?>">
      >>
    </a>
  </div>
<?php endif; ?>

<div class="pagination_desc">
  <strong><?php echo count($pager) ?></strong> items 

  <?php if ($pager->haveToPaginate()): ?>
    - page <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
  <?php endif; ?>
</div>
<br />