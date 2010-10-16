<?php
/* 
 * This file contains the html and code for the body of the email alert that is sent
 * The following are the variables available for use inside this file:
 *  $listing = the listing that is the subject of the alert
 *  $alert = the alert that this email is fired from
 *  $user = the details of the user this email is being sent to
 */

?>


<p>The alert <?php echo $alert->getName(); ?> that you created has found a listing that matches its criteria. Click on the link below to be taken to the listing:</p>

<p><?php echo link_to(url_for($module.'/show?id='.$listing->getId()), $module.'/show?id='.$listing->getId()); ?></p>
