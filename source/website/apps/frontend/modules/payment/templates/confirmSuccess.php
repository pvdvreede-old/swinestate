<h2>Confirm Payment</h2>

<p>Here are the details of the purchase you are about to make:</p>

<table class="payment_confirm">
    <tr>
        <td>
            Listing:
        </td>
        <td>
            <?php echo $ListingTime->getListing(); ?>
        </td>
    </tr>
     <tr>
        <td>
            Start date:
        </td>
        <td>
            <?php echo $ListingTime->getStartDate(); ?>
        </td>
    </tr>
     <tr>
        <td>
            End Date:
        </td>
        <td>
            <?php echo $ListingTime->getEndDate(); ?>
        </td>
    </tr>
     <tr>
        <td>
            Total duration:
        </td>
        <td>
            <?php echo $ListingTime->getTotalDays(); ?>
        </td>
    </tr>
    <tr>
        <td>
            Cost per day:
        </td>
        <td>
           $<?php echo sfConfig::get('app_daily_ad_cost'); ?>
        </td>
    </tr>
     <tr>
        <td>
            <strong>Total cost:</strong>
        </td>
        <td>
            <strong>$<?php echo $ListingTime->getTotalDays() * sfConfig::get('app_daily_ad_cost'); ?></strong>
        </td>
    </tr>

</table>

<p>Enter your paypal details below to make payment: </p>

<?php include_partial('form', array(
    'form' => $form
));