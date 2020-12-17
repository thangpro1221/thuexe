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

$dbo = JFactory::getDbo();
$vri_app = VikRentItems::getVriApplication();
//load jQuery lib and navigation
$document = JFactory::getDocument();
$document->addStyleSheet(VRI_SITE_URI.'resources/jquery-ui.min.css');
//load jQuery UI
JHtml::_('script', VRI_SITE_URI.'resources/jquery-ui.min.js');
$navdecl = '
var baseaddrbaselink = "index.php?option=com_vikrentitems&task=validatebaseaddr&tmpl=component";
jQuery(document).ready(function() {
	jQuery(".vrimodal").fancybox({
		type: "iframe",
		iframe: {
			css: {
				width: "75%",
				height: "75%"
			}
		}
	});
	jQuery(".vrimodaliframe").fancybox({
		beforeLoad: function(instance, current) {
			current.src = baseaddrbaselink+"&baseaddress="+jQuery("#deliverybaseaddresscont").val();
		},
		type: "iframe",
		iframe: {
			css: {
				width: "100%",
				height: "500px"
			}
		}
	});
});';
$document->addScriptDeclaration($navdecl);
$tooltipdecl = '
jQuery(document).ready(function() {
	jQuery(".vritooltip").tooltip();
});';
$document->addScriptDeclaration($tooltipdecl);
//
$currencysymb = VikRentItems::getCurrencySymb(true);
$delcalcunit = VikRentItems::getDeliveryCalcUnit(true);

// tax rates
$delivery_tax_id = VikRentItems::getDeliveryTaxId(true);
$ivas = array();
$q = "SELECT * FROM `#__vikrentitems_iva`;";
$dbo->setQuery($q);
$dbo->execute();
if ($dbo->getNumRows() > 0) {
	$ivas = $dbo->loadAssocList();
}
$wiva = "<select name=\"deliverytaxid\">\n<option value=\"\"></option>\n";
foreach ($ivas as $iv) {
	$wiva .= "<option value=\"".$iv['id']."\"".($delivery_tax_id == $iv['id'] ? " selected=\"selected\"" : "").">".(empty($iv['name']) ? $iv['aliq']."%" : $iv['name']."-".$iv['aliq']."%")."</option>\n";
}
$wiva .= "</select>\n";
//
?>

<div class="vri-config-maintab-left">
	<fieldset class="adminform">
		<div class="vri-params-wrap">
			<legend class="adminlegend"><?php echo JText::_('VRPANELFIVE'); ?></legend>
			<div class="vri-params-container">
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELBASEADDR'); ?> <?php echo $vri_app->createPopover(array('title' => JText::_('VRICONFDELBASEADDR'), 'content' => JText::_('VRICONFDELBASEADDREXP'))); ?></div>
					<div class="vri-param-setting">
						<input type="text" name="deliverybaseaddress" id="deliverybaseaddresscont" value="<?php echo VikRentItems::getDeliveryBaseAddress(true); ?>" size="40"/>
						<a href="index.php?option=com_vikrentitems&amp;task=validatebaseaddr&amp;tmpl=component" target="_blank" id="vrivalidatebaseaddr" class="btn vri-config-btn vrimodaliframe">
							<?php VikRentItemsIcons::e('location-arrow'); ?> <?php echo JText::_('VRICONFDELBASEADDRVALIDATE'); ?>
						</a>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELBASELAT'); ?></div>
					<div class="vri-param-setting"><input type="text" name="deliverybaselat" id="deliverybaselat" value="<?php echo VikRentItems::getDeliveryBaseLatitude(true); ?>" readonly/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELBASELNG'); ?></div>
					<div class="vri-param-setting"><input type="text" name="deliverybaselng" id="deliverybaselng" value="<?php echo VikRentItems::getDeliveryBaseLongitude(true); ?>" readonly/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELCALCUNIT'); ?></div>
					<div class="vri-param-setting">
						<select name="deliverycalcunit">
							<option value="km"<?php echo ($delcalcunit == "km" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRICONFDELCALCUNITKM'); ?></option>
							<option value="miles"<?php echo ($delcalcunit == "miles" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRICONFDELCALCUNITMILES'); ?></option>
						</select>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELROUNDDIST'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('deliveryrounddist', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::getDeliveryRoundDistance(true), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELCOSTPERUNIT'); ?> <?php echo $vri_app->createPopover(array('title' => JText::_('VRICONFDELCOSTPERUNIT'), 'content' => JText::_('VRICONFDELCOSTPERUNITHELP'))); ?></div>
					<div class="vri-param-setting"><input type="number" name="deliverycostperunit" value="<?php echo VikRentItems::getDeliveryCostPerUnit(true); ?>" min="0" step="any"/> <?php echo $currencysymb; ?> &nbsp;&nbsp; <?php echo $wiva; ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELROUNDCOST'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('deliveryroundcost', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::getDeliveryRoundCost(true), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELIVPERORD'); ?> <?php echo $vri_app->createPopover(array('title' => JText::_('VRICONFDELIVPERORD'), 'content' => JText::_('VRICONFDELIVPERORDHELP'))); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('deliveryperord', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::isDeliveryPerOrder(true), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELIVPERITUNIT'); ?> <?php echo $vri_app->createPopover(array('title' => JText::_('VRICONFDELIVPERITUNIT'), 'content' => JText::_('VRICONFDELIVPERITUNITHELP'))); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('deliveryperitunit', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::isDeliveryPerItemUnit(true), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELMAXDIST'); ?></div>
					<div class="vri-param-setting"><input type="number" name="deliverymaxunitdist" value="<?php echo VikRentItems::getDeliveryMaxDistance(true); ?>" min="0" step="any"/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELMAXCOST'); ?></div>
					<div class="vri-param-setting"><input type="number" name="deliverymaxcost" value="<?php echo VikRentItems::getDeliveryMaxCost(true); ?>" min="0" step="any"/> <?php echo $currencysymb; ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFDELIVERYNOTES'); ?></div>
					<div class="vri-param-setting"><textarea name="deliverymapnotes" rows="6" cols="40"><?php echo VikRentItems::getDeliveryMapNotes(); ?></textarea></div>
				</div>
			</div>
		</div>
	</fieldset>
</div>
