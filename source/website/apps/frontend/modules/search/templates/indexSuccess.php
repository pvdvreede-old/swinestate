
<?php if (!isset($suburb_text)) $suburb_text = null; ?>

<?php include_partial('search', array(
    'form' => $form,
    'listing_type' => $listing_type,
    'listing_type_id' => $listing_type_id,
    'suburb_text' => $suburb_text,
    'module_link' => $module_link
        )); ?>


<?php if (isset($show_results)) : ?>

<?php include_partial('results', array(
    'pager' => $pager,
    'module_link' => $module_link,
    'page_url' => $page_url,
    'get_string' => $get_string
        )); ?>

<?php endif; ?>