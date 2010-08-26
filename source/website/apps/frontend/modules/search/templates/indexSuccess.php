
<?php include_partial('search', array(
    'form' => $form,
    'listing_type' => $listing_type
        )); ?>


<?php if (isset($show_results)) : ?>

<?php include_partial('results', array(
    'pager' => $pager,
    'module_link' => $module_link,
    'page_url' => $page_url
        )); ?>

<?php endif; ?>