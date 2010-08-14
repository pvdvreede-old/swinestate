<?php
    $add = $listing->getAddress();
    $address = $add->getStreetNumber().' '.$add->getStreetName().'\n';
    $address .= $add->getSuburb()->getName().' '.$add->getSuburb()->getPostcode();

 ?>



<h3><?php echo $listing->getName(); ?></h3>


<p>Address: <?php echo $address; ?></p>

