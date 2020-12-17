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

$row = $this->row;
$wsel = $this->wsel;

$vri_app = VikRentItems::getVriApplication();
$vri_app->loadSelect2();
if (strlen($wsel) > 0) {
	$wfromh = "<select name=\"fromh\">\n";
	for ($i = 0; $i < 24; $i++) {
		$sayv = $i < 10 ? '0'.$i : $i;
		$wfromh .= "<option value=\"".$i."\"".(count($row) && $i == $row['fromh'] ? " selected=\"selected\"" : "").">".$sayv."</option>\n";
	}
	$wfromh .= "</select>\n";
	$wfromm = "<select name=\"fromm\">\n";
	for ($i = 0; $i < 60; $i+=15) {
		$sayv = $i < 10 ? '0'.$i : $i;
		$wfromm .= "<option value=\"".$i."\"".(count($row) && $i == $row['fromm'] ? " selected=\"selected\"" : "").">".$sayv."</option>\n";
	}
	$wfromm .= "</select>\n";
	$wtoh = "<select name=\"toh\">\n";
	for ($i = 0; $i < 24; $i++) {
		$sayv = $i < 10 ? '0'.$i : $i;
		$wtoh .= "<option value=\"".$i."\"".(count($row) && $i == $row['toh'] ? " selected=\"selected\"" : "").">".$sayv."</option>\n";
	}
	$wtoh .= "</select>\n";
	$wtom = "<select name=\"tom\">\n";
	for ($i = 0; $i < 60; $i+=15) {
		$sayv = $i < 10 ? '0'.$i : $i;
		$wtom .= "<option value=\"".$i."\"".(count($row) && $i == $row['tom'] ? " selected=\"selected\"" : "").">".$sayv."</option>\n";
	}
	$wtom .= "</select>\n";
	?>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#iditems').select2();
		jQuery('.vri-select-all').click(function() {
			var nextsel = jQuery(this).next("select");
			nextsel.find("option").prop('selected', true);
			nextsel.trigger('change');
		});
	});
</script>
<form name="adminForm" id="adminForm" action="index.php" method="post" enctype="multipart/form-data">
	<div class="vri-admin-container">
		<div class="vri-config-maintab-left">
			<fieldset class="adminform">
				<div class="vri-params-wrap">
					<legend class="adminlegend"><?php echo JText::_('VRIADMINLEGENDDETAILS'); ?></legend>
					<div class="vri-params-container">
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VRITIMESLOTNAME'); ?> </div>
							<div class="vri-param-setting"><input type="text" name="tname" value="<?php echo count($row) ? htmlspecialchars($row['tname']) : ''; ?>" size="30"/></div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VRINEWTIMESLOTFROM'); ?> </div>
							<div class="vri-param-setting"><?php echo $wfromh.' : '.$wfromm; ?> &nbsp;<?php echo $vri_app->createPopover(array('title' => JText::_('VRITIMESLOTSTITLETXT'), 'content' => JText::_('VRITIMESLOTSHELP'))); ?></div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VRINEWTIMESLOTTO'); ?> </div>
							<div class="vri-param-setting"><?php echo $wtoh.' : '.$wtom; ?></div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VRITIMESLOTDAYS'); ?> </div>
							<div class="vri-param-setting"><input type="number" min="0" name="days" value="<?php echo count($row) ? $row['days'] : '0'; ?>" /></div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
		<div class="vri-config-maintab-right">
			<fieldset class="adminform">
				<div class="vri-params-wrap">
					<legend class="adminlegend"><?php echo JText::_('VRIADMINLEGENDSETTINGS'); ?></legend>
					<div class="vri-params-container">
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VRINEWTIMESLOTITEMS'); ?> </div>
							<div class="vri-param-setting">
								<span class="vri-select-all"><?php echo JText::_('VRISELECTALL'); ?></span>
								<?php echo $wsel; ?>
							</div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VRINEWTIMESLOTGLOBAL'); ?> </div>
							<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('global', JText::_('VRYES'), JText::_('VRNO'), (count($row) && intval($row['global']) == 1 ? 1 : 0), 1, 0); ?></div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
		<input type="hidden" name="task" value="">
		<input type="hidden" name="option" value="com_vikrentitems" />
	<?php
	if (count($row)) {
		?>
		<input type="hidden" name="where" value="<?php echo $row['id']; ?>">
		<?php
	}
	?>
	</form>
	<?php
} else {
	?>
	<p class="err"><a href="index.php?option=com_vikrentitems&amp;task=newitem"><?php echo JText::_('VRNOITEMSFOUNDSEASONS'); ?></a></p>
	<form action="index.php?option=com_vikrentitems" method="post" name="adminForm" id="adminForm">
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="option" value="com_vikrentitems" />
	</form>
	<?php
}
