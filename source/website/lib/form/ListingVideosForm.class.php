<?php

/**
 * ListingVideos form.
 *
 * @package    SWINESTATE
 * @subpackage form
 * @author     Paul Van de Vreede
 */
class ListingVideosForm extends BaseListingVideosForm {

    public function configure() {

        $this->widgetSchema['url'] = new sfWidgetFormTextarea(array(
            'label' => 'YouTube Embed code'
        ), array(
            'cols' => 70,
            'rows' => 6
        ));

        $this->useFields(array(
            'caption',
            'url'
        ));
    }

}
