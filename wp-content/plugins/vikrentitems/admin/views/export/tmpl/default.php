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

$oids = $this->oids;
$locations = $this->locations;

JHtml::_('behavior.calendar');
$nowdf = VikRentItems::getDateFormat(true);
if ($nowdf=="%d/%m/%Y") {
	$df = 'd/m/Y';
} elseif ($nowdf=="%m/%d/%Y") {
	$df = 'm/d/Y';
} else {
	$df = 'Y/m/d';
}
$optlocations = '';
if (is_array($locations) && count($locations) > 0) {
	foreach ($locations as $loc) {
		$optlocations .= '<option value="'.$loc['id'].'">'.$loc['name'].'</option>';
	}
}
?>
<script type="text/javascript">
function vriExportSetType(val) {
	if (val == 'csv') {
		jQuery('#vriexpdateftr').fadeIn();
	} else {
		jQuery('#vriexpdateftr').fadeOut();
	}
}
</script>
<form name="adminForm" id="adminForm" action="index.php" method="post">
	<div class="vri-admin-container">
		<div class="vri-config-maintab-left vri-config-customer">
			<fieldset class="adminform">
				<div class="vri-params-wrap">
					<legend class="adminlegend"><?php echo !count($oids) ? JText::_('VRMAINORDERSEXPORT') : JText::sprintf('VREXPORTNUMORDS', count($oids)); ?></legend>
					<div class="vri-params-container">
					<?php
					if (!count($oids)) {
						?>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VREXPORTDATETYPE'); ?></div>
							<div class="vri-param-setting">
								<select name="datetype">
									<option value="ritiro"><?php echo JText::_('VREXPORTDATETYPEPICK'); ?></option>
									<option value="ts"><?php echo JText::_('VREXPORTDATETYPETS'); ?></option>
								</select>
							</div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VREXPORTONE'); ?></div>
							<div class="vri-param-setting"><?php echo JHTML::_('calendar', '', 'from', 'from', $nowdf, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VREXPORTTWO'); ?></div>
							<div class="vri-param-setting"><?php echo JHTML::_('calendar', '', 'to', 'to', $nowdf, array('class'=>'', 'size'=>'10',  'maxlength'=>'19', 'todayBtn' => 'true')); ?></div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VREXPORTELEVEN'); ?></div>
							<div class="vri-param-setting">
								<select name="location">
									<option value="">--------</option>
									<?php echo $optlocations; ?>
								</select>
							</div>
						</div>
						<?php
					} else {
						foreach ($oids as $oid) {
							echo '<input type="hidden" name="cid[]" value="'.$oid.'"/>'."\n";
						}
					}
					?>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VREXPORTTHREE'); ?></div>
							<div class="vri-param-setting">
								<select name="type" id="vritype" onchange="vriExportSetType(this.value);">
									<option value="csv"><?php echo JText::_('VREXPORTFOUR'); ?></option>
									<option value="ics"><?php echo JText::_('VREXPORTFIVE'); ?></option>
								</select>
							</div>
						</div>
						<div class="vri-param-container" id="vriexpdateftr">
							<div class="vri-param-label"><?php echo JText::_('VREXPORTTEN'); ?></div>
							<div class="vri-param-setting">
								<select name="dateformat">
									<option value="Y/m/d"<?php echo $df == 'Y/m/d' ? " selected=\"selected\"" : ""; ?>>Y/m/d</option>
									<option value="m/d/Y"<?php echo $df == 'm/d/Y' ? " selected=\"selected\"" : ""; ?>>m/d/Y</option>
									<option value="d/m/Y"<?php echo $df == 'd/m/Y' ? " selected=\"selected\"" : ""; ?>>d/m/Y</option>
									<option value="Y-m-d">Y-m-d</option>
									<option value="m-d-Y">m-d-Y</option>
									<option value="d-m-Y">d-m-Y</option>
									<option value="ts">Unix Timestamp</option>
								</select>
							</div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label"><?php echo JText::_('VREXPORTSIX'); ?></div>
							<div class="vri-param-setting">
								<select name="status">
									<option value="C"><?php echo JText::_('VREXPORTSEVEN'); ?></option>
									<option value="CP"><?php echo JText::_('VREXPORTEIGHT'); ?></option>
								</select>
							</div>
						</div>
						<div class="vri-param-container">
							<div class="vri-param-label">&nbsp;</div>
							<div class="vri-param-setting">
								<button type="submit" class="btn vri-config-btn"><i class="vriicn-cloud-download"></i> <?php echo JText::_('VREXPORTNINE'); ?></button>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<input type="hidden" name="task" value="doexport">
	<input type="hidden" name="option" value="com_vikrentitems" />
</form>
