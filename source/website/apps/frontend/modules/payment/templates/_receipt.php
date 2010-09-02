
<table class="reciept">
    <tr>
        <td>
            Receipt Number:
        </td>
        <td>
            <?php echo $receiptObject->getId(); ?>
        </td>
    </tr>
    <tr>
        <td>
            Payment date:
        </td>
        <td>
            <?php echo $receiptObject->getPaymentDate(); ?>
        </td>
    </tr>
    <tr>
        <td>
            Total amount:
        </td>
        <td>
            $<?php echo $receiptObject->getTotalPaid(); ?>
        </td>
    </tr>

    <tr>
        <td>
            Paypal account:
        </td>
        <td>
            <?php echo $receiptObject->getPayerAccountName(); ?>
        </td>
    </tr>
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


</table>