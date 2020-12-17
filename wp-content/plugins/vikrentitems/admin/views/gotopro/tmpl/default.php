<?php
/**
 * @package     VikRentItems
 * @subpackage  com_vikrentitems
 * @author      Alessio Gaggii - e4j - Extensionsforjoomla.com
 * @copyright   Copyright (C) 2018 e4j - Extensionsforjoomla.com. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * @link        https://vikwp.com
 */

defined('ABSPATH') or die('No script kiddies please!');

$lic_key = $this->lic_key;
$lic_date = $this->lic_date;
$is_pro = $this->is_pro;

$nowdf = VikRentItems::getDateFormat();
if ($nowdf == "%d/%m/%Y") {
	$df = 'd/m/Y';
} elseif ($nowdf == "%m/%d/%Y") {
	$df = 'm/d/Y';
} else {
	$df = 'Y/m/d';
}

?>
<div class="viwppro-cnt">
	<div class="vikwp-alreadypro"><?php echo JText::_('VRIPROALREADYHAVEPRO'); ?></div>
	<div class="vikwppro-header">
		<div class="vikwppro-header-inner">
			<div class="vikwppro-header-text">
				<h2><?php echo JText::_('VRIPROINCREASEORDERS'); ?></h2>
				<h3><?php echo JText::_('VRIPROCREATEOWNRENTSYS'); ?></h3>
				<h4><?php echo JText::_('VRIPROMOSTTRUSTED'); ?></h4>
				<ul>
					<li><?php VikRentItemsIcons::e('check'); ?> <?php echo JText::_('VRIPROEASYANYONE'); ?></li>
					<li><?php VikRentItemsIcons::e('check'); ?> <?php echo JText::_('VRIPROFULLRESPONSIVE'); ?></li>
					<li><?php VikRentItemsIcons::e('check'); ?> <?php echo JText::_('VRIPROPOWERPRICING'); ?></li>
				</ul>
				<a href="https://vikwp.com/plugin/vikrentitems?utm_source=free_version&utm_medium=vri&utm_campaign=gotopro" target="_blank" id="vikwpgotoget" class="vikwp-btn-link"><?php VikRentItemsIcons::e('rocket'); ?> <?php echo JText::_('VRIGOTOPROBTN'); ?></a>
			</div>
			<div class="vikwppro-header-img">
				<img src="<?php echo VRI_SITE_URI . 'resources/images/main.png' ?>" alt="Vik Rent Items Pro" />
			</div>
		</div>
	</div>
	<div class="viwppro-feats-cnt">
		<div class="viwppro-feats-row vikwppro-even viwppro-row-heightsmall">
			<div class="viwppro-feats-text">
				<h4><?php echo JText::_('VRIPRORENTMULTIUNITS'); ?></h4>
				<p><?php echo JText::_('VRIPRORENTMULTIUNITSDESC'); ?></p>
			</div>
			<div class="viwppro-feats-img">
				<img src="<?php echo VRI_SITE_URI . 'resources/images/multiple-items-timeslot.jpg' ?>" alt="Allow rentals of multiple items with multiple units" />
			</div>
		</div>
		<div class="viwppro-feats-row vikwppro-odd viwppro-row-heightsmall">
			<div class="viwppro-feats-img">
				<img src="<?php echo VRI_SITE_URI . 'resources/images/rental-items-promo.jpg' ?>" alt="Full Rates Management" />
			</div>
			<div class="viwppro-feats-text">
				<h4><?php echo JText::_('VRIPROSEASONSONECLICK'); ?></h4>
				<p><?php echo JText::_('VRIPROWHYRATESDESC'); ?></p>
			</div>
		</div>
		
		<div class="viwppro-feats-row vikwppro-even">
			<div class="viwppro-feats-text">
				<h4><?php echo JText::_('VRIPROCONFIGOPTIONS'); ?></h4>
				<p><?php echo JText::_('VRIPROWHYOPTIONSDESC'); ?></p>
			</div>
			<div class="viwppro-feats-img">
				<img src="<?php echo VRI_SITE_URI . 'resources/images/item-options.jpg' ?>" alt="Options and Extra Services" />
			</div>
		</div>

		<div class="viwppro-feats-row vikwppro-odd">
			<div class="viwppro-feats-img">
				<img src="<?php echo VRI_SITE_URI . 'resources/images/edit-order.jpg' ?>" alt="Orders Management" />
			</div>
			<div class="viwppro-feats-text">
				<h4><?php echo JText::_('VRIPROWHYBOOKINGS'); ?></h4>
				<p><?php echo JText::_('VRIPROWHYBOOKINGSDESC'); ?></p>
			</div>
		</div>
	</div>
	<div class="viwppro-extra">
		<h3><?php echo JText::_('VRIPROWHYUNLOCKF'); ?></h3>
		<div class="viwppro-extra-inner">
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('users'); ?>
						<h4><?php echo JText::_('VRIPROWHYCUSTOMERS'); ?></h4>
						<p><?php echo JText::_('VRIPROWHYCUSTOMERSDESC'); ?></p>
					</div>
				</div>
			</div>
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('credit-card'); ?>
						<h4><?php echo JText::_('VRIPROWHYPAYMENTS'); ?></h4>
						<p><?php echo JText::_('VRIPROWHYPAYMENTSDESC'); ?></p>
					</div>
				</div>
			</div>
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('certificate'); ?>
						<h4><?php echo JText::_('VRIPROPROMOCOUPONS'); ?></h4>
						<p><?php echo JText::_('VRIPROPROMOCOUPONSDESC'); ?></p>
					</div>
				</div>
			</div>
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('stopwatch'); ?>
						<h4><?php echo JText::_('VRIPROTIMESLOTS'); ?></h4>
						<p><?php echo JText::_('VRIPROTIMESLOTSDESC'); ?></p>
					</div>
				</div>
			</div>
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('cubes'); ?>
						<h4><?php echo JText::_('VRIPROGROUPSITEMS'); ?></h4>
						<p><?php echo JText::_('VRIPROGROUPSITEMSDESC'); ?></p>
					</div>
				</div>
			</div>
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('tags'); ?>
						<h4><?php echo JText::_('VRIPRODISCQUANT'); ?></h4>
						<p><?php echo JText::_('VRIPRODISCQUANTDESC'); ?></p>
					</div>
				</div>
			</div>
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('business-time'); ?>
						<h4><?php echo JText::_('VRIPROCRONJOBS'); ?></h4>
						<p><?php echo JText::_('VRIPROCRONJOBSDESC'); ?></p>
					</div>
				</div>
			</div>
			<div class="viwppro-extra-item">
				<div class="viwppro-extra-item-inner">
					<div class="viwppro-extra-item-text">
						<?php VikRentItemsIcons::e('compass'); ?>
						<h4><?php echo JText::_('VRIPROWHYLOCOOHFEES'); ?></h4>
						<p><?php echo JText::_('VRIPROWHYLOCOOHFEESDESC'); ?></p>
					</div>
				</div>
			</div>
		</div>
		<div class="vikwp-extra-more"><?php echo JText::_('VRIPROWHYMOREEXTRA'); ?></div>
		<a name="upgrade"></a>
	</div>
	<div class="vikwppro-licencecnt">
		<div class="col col-md-6 col-sm-12 vikwppro-licencetext">
			<div>
				<h3><?php echo JText::_('VRIPROREADYINCREASE'); ?></h3>
			<?php
			if ($lic_date > 0) {
				$valid_until = date($df, $lic_date);
				?>
				<h4 class="vikwppro-lickey-expired"><?php echo JText::sprintf('VRILICKEYEXPIREDON', $valid_until); ?></h4>
				<?php
			}
			?>
				<h4 class="vikwppro-licencecnt-get"><?php echo JText::_('VRIPROREADYINCREASEDESC'); ?></h4>
				<a href="https://vikwp.com/plugin/vikrentitems?utm_source=free_version&utm_medium=vri&utm_campaign=gotopro" target="_blank" class="vikwp-btn-link" target="_blank"><?php VikRentItemsIcons::e('rocket'); ?> <?php echo JText::_('VRIGOTOPROBTN'); ?></a>
			</div>
			<span class="icon-background"><?php VikRentItemsIcons::e('rocket'); ?></span>
		</div>
		<div class="col col-md-6 col-sm-12 vikwppro-licenceform">
			<form>
				<div class="vikwppro-licenceform-inner">
					<h4><?php echo JText::_('VRIPROALREADYHAVEKEY'); ?></h4>
					<span class="vikwppro-inputspan"><?php VikRentItemsIcons::e('key'); ?><input type="text" name="key" id="lickey" value="" class="licence-input" autocomplete="off" /></span>
					<button type="button" class="btn vikwp-btn-green" id="vikwpvalidate" onclick="vikWpValidateLicenseKey();"><?php echo JText::_('VRIPROVALNINST'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
var vikwp_running = false;
function vikWpValidateLicenseKey() {
	if (vikwp_running) {
		// prevent double submission until request is over
		return;
	}
	// start running
	vikWpStartValidation();

	// request
	var lickey = document.getElementById('lickey').value;
	jQuery.ajax({
		type: "POST",
		url: "admin.php",
		data: { option: "com_vikrentitems", task: "license.validate", key: lickey }
	}).done(function(res) {
		if (res.indexOf('e4j.error') >= 0) {
			// stop the request
			vikWpStopValidation();
			alert(res.replace("e4j.error.", ""));
			return;
		}
		var obj_res = JSON.parse(res);
		document.location.href = 'admin.php?option=com_vikrentitems&view=getpro';
	}).fail(function() {
		// stop the request
		vikWpStopValidation();
		alert("Request Failed");
	});

}
function vikWpStartValidation() {
	vikwp_running = true;
	jQuery('#vikwpvalidate').prepend('<?php VikRentItemsIcons::e('refresh', 'fa-spin'); ?>');
}
function vikWpStopValidation() {
	vikwp_running = false;
	jQuery('#vikwpvalidate').find('i').remove();
}
jQuery(document).ready(function() {
	jQuery('.vikwp-alreadypro a').click(function(e) {
		e.preventDefault();
		jQuery('html,body').animate({ scrollTop: (jQuery('.vikwppro-licencecnt').offset().top - 50) }, { duration: 'fast' });
	});
	jQuery('#lickey').keyup(function() {
		jQuery(this).val(jQuery(this).val().trim());
	});
	jQuery('#lickey').keypress(function(e) {
		if (e.which == 13) {
			// enter key code pressed, run the validation
			vikWpValidateLicenseKey();
			return false;
		}
	});
});
</script>
