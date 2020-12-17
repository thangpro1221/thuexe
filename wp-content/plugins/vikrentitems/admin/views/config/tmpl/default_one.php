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

JHtml::_('jquery.framework');
JHtml::_('script', VRI_SITE_URI.'resources/jquery-ui.sortable.min.js');

JHtml::_('behavior.calendar');

$vri_app = VikRentItems::getVriApplication();
$timeopst = VikRentItems::getTimeOpenStore(true);

$openat   = array(0, 0);
$closeat  = array(0, 0);
$alwopen  = true;
if (is_array($timeopst) && $timeopst[0] != $timeopst[1]) {
	$openat  = VikRentItems::getHoursMinutes($timeopst[0]);
	$closeat = VikRentItems::getHoursMinutes($timeopst[1]);
	$alwopen = false;
}
$calendartype = VikRentItems::calendarType(true);
$aehourschbasp = VikRentItems::applyExtraHoursChargesBasp();
$nowdf = VikRentItems::getDateFormat(true);
$nowtf = VikRentItems::getTimeFormat(true);
$forcedpickdroptimes = VikRentItems::getForcedPickDropTimes(true);
$forcepickupthsel = "<select name=\"forcepickupth\" style=\"float: none;\">\n";
for($i=0; $i <= 23; $i++) {
	$in = $i < 10 ? "0".$i : $i;
	$forcepickupthsel.="<option value=\"".$i."\"".(is_array($forcedpickdroptimes[0]) && count($forcedpickdroptimes[0]) > 0 && intval($forcedpickdroptimes[0][0]) == $i ? ' selected="selected"' : '').">".$in."</option>\n";
}
$forcepickupthsel .= "</select>\n";
$forcepickuptmsel = "<select name=\"forcepickuptm\" style=\"float: none;\">\n";
for($i=0; $i <= 59; $i++) {
	$in = $i < 10 ? "0".$i : $i;
	$forcepickuptmsel.="<option value=\"".$i."\"".(is_array($forcedpickdroptimes[0]) && count($forcedpickdroptimes[0]) > 0 && intval($forcedpickdroptimes[0][1]) == $i ? ' selected="selected"' : '').">".$in."</option>\n";
}
$forcepickuptmsel .= "</select>\n";
$forcedropoffthsel = "<select name=\"forcedropoffth\" style=\"float: none;\">\n";
for($i=0; $i <= 23; $i++) {
	$in = $i < 10 ? "0".$i : $i;
	$forcedropoffthsel.="<option value=\"".$i."\"".(is_array($forcedpickdroptimes[1]) && count($forcedpickdroptimes[1]) > 0 && intval($forcedpickdroptimes[1][0]) == $i ? ' selected="selected"' : '').">".$in."</option>\n";
}
$forcedropoffthsel .= "</select>\n";
$forcedropofftmsel = "<select name=\"forcedropofftm\" style=\"float: none;\">\n";
for($i=0; $i <= 59; $i++) {
	$in = $i < 10 ? "0".$i : $i;
	$forcedropofftmsel.="<option value=\"".$i."\"".(is_array($forcedpickdroptimes[1]) && count($forcedpickdroptimes[1]) > 0 && intval($forcedpickdroptimes[1][1]) == $i ? ' selected="selected"' : '').">".$in."</option>\n";
}
$forcedropofftmsel .= "</select>\n";
$globclosingdays = VikRentItems::getGlobalClosingDays();
$currentglobclosedays = '';
if (is_array($globclosingdays)) {
	if (count($globclosingdays['singleday']) > 0) {
		foreach ($globclosingdays['singleday'] as $kgcs => $gcdsd) {
			$currentglobclosedays .= '<div id="curglobcsday'.$kgcs.'"><span class="vriconfspanclosed">'.date('Y-m-d', $gcdsd).' ('.JText::_('VRICONFIGCLOSESINGLED').')</span><input type="hidden" name="globalclosingdays[]" value="'.date('Y-m-d', $gcdsd).':1"/><i class="' . VikRentItemsIcons::i('times-circle', 'vri-confrm-icn-small') . '" onclick="removeClosingDay(\'curglobcsday'.$kgcs.'\');"></i></div>'."\n";
		}
	}
	if (count($globclosingdays['weekly']) > 0) {
		$weekdaysarr = array(0 => JText::_('VRISUNDAY'), 1 => JText::_('VRIMONDAY'), 2 => JText::_('VRITUESDAY'), 3 => JText::_('VRIWEDNESDAY'), 4 => JText::_('VRITHURSDAY'), 5 => JText::_('VRIFRIDAY'), 6 => JText::_('VRISATURDAY'));
		foreach ($globclosingdays['weekly'] as $kgcw => $gcdwd) {
			$moregcdinfo = getdate($gcdwd);
			$currentglobclosedays .= '<div id="curglobcwday'.$kgcw.'"><span class="vriconfspanclosed">'.date('Y-m-d', $gcdwd).' ('.$weekdaysarr[$moregcdinfo['wday']].')</span><input type="hidden" name="globalclosingdays[]" value="'.date('Y-m-d', $gcdwd).':2"/><i class="' . VikRentItemsIcons::i('times-circle', 'vri-confrm-icn-small') . '" onclick="removeClosingDay(\'curglobcwday'.$kgcw.'\');"></i></div>'."\n";
		}
	}
}

$maxdatefuture = VikRentItems::getMaxDateFuture(true);
$maxdate_val = intval(substr($maxdatefuture, 1, (strlen($maxdatefuture) - 1)));
$maxdate_interval = substr($maxdatefuture, -1, 1);

$vrisef = file_exists(VRI_SITE_PATH.DS.'router.php');
?>

<script type="text/javascript">
var _DAYS = new Array();
_DAYS.push('<?php echo addslashes(JText::_('VRISUNDAY')); ?>');
_DAYS.push('<?php echo addslashes(JText::_('VRIMONDAY')); ?>');
_DAYS.push('<?php echo addslashes(JText::_('VRITUESDAY')); ?>');
_DAYS.push('<?php echo addslashes(JText::_('VRIWEDNESDAY')); ?>');
_DAYS.push('<?php echo addslashes(JText::_('VRITHURSDAY')); ?>');
_DAYS.push('<?php echo addslashes(JText::_('VRIFRIDAY')); ?>');
_DAYS.push('<?php echo addslashes(JText::_('VRISATURDAY')); ?>');

var daysindxcount = 0;

function addClosingDay() {
	var dayadd = document.getElementById('globdayclose').value;
	var frequency = document.getElementById('vrifrequencyclose').value;
	var freqexpl = '';
	if ( dayadd.length > 0 ) {
		if ( parseInt(frequency) == 1 ) {
			freqexpl = '<?php echo addslashes(JText::_('VRICONFIGCLOSESINGLED')); ?>';
		} else {
			var dateparts = dayadd.split("-");
			var anlzdate = new Date( dateparts[0], (dateparts[1] - 1), dateparts[2] );
			freqexpl = _DAYS[anlzdate.getDay()];
		}
		addHiddenClosingDay(dayadd, frequency, freqexpl);
	}
}

function addHiddenClosingDay(cday, cfreq, cfreqexpl) {
	var ni = document.getElementById('vriglobclosedaysdiv');
	var num = (daysindxcount -1)+ 2;
	daysindxcount = num;
	var newdiv = document.createElement('div');
	var divIdName = 'cday'+num+'Div';
	newdiv.setAttribute('id',divIdName);
	newdiv.innerHTML = '<span class=\'vriconfspanclosed\'>'+cday+' ('+cfreqexpl+')</span><input type=\'hidden\' name=\'globalclosingdays[]\' value=\''+cday+':'+cfreq+'\'/><i class=\'<?php echo VikRentItemsIcons::i('times-circle', 'vri-confrm-icn-small'); ?>\' onclick=\'removeClosingDay("'+divIdName+'");\'></i>';
	ni.appendChild(newdiv);
}

function removeClosingDay(idtorm) {
	return (elem=document.getElementById(idtorm)).parentNode.removeChild(elem);
}

function toggleForcePickup() {
	if (jQuery('input[name="forcepickupt"]').is(':checked')) {
		jQuery('#forcepickuptdiv').show();
	} else {
		jQuery('#forcepickuptdiv').hide();
	}
}

function toggleForceDropoff() {
	if (jQuery('input[name="forcedropofft"]').is(':checked')) {
		jQuery('#forcedropofftdiv').show();
	} else {
		jQuery('#forcedropofftdiv').hide();
	}
}
</script>

<div class="vri-config-maintab-left">
	<fieldset class="adminform">
		<div class="vri-params-wrap">
			<legend class="adminlegend"><?php echo JText::_('VRICONFIGBOOKINGPART'); ?></legend>
			<div class="vri-params-container">
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONEFIVE'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('allowrent', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::allowRent(), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONESIX'); ?></div>
					<div class="vri-param-setting"><textarea name="disabledrentmsg" rows="5" cols="50"><?php echo VikRentItems::getDisabledRentMsg(); ?></textarea></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONETENSIX'); ?></div>
					<div class="vri-param-setting"><input type="text" name="adminemail" value="<?php echo VikRentItems::getAdminMail(); ?>" size="30"/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRISENDEREMAIL'); ?></div>
					<div class="vri-param-setting"><input type="text" name="senderemail" value="<?php echo VikRentItems::getSenderMail(); ?>" size="30"/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONESEVEN'); ?></div>
					<div class="vri-param-setting">&nbsp;</div>
				</div>
				<div class="vri-param-container vri-param-nested">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONEONE'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('timeopenstorealw', JText::_('VRYES'), JText::_('VRNO'), ($alwopen ? 'yes' : 0), 'yes', 0); ?></div>
				</div>
				<div class="vri-param-container vri-param-nested">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONETWO'); ?></div>
					<div class="vri-param-setting">
						<div style="display: block; margin-bottom: 3px;">
							<span class="vrirestrdrangesp"><?php echo JText::_('VRIONFIGONETHREE'); ?></span>
							<select name="timeopenstorefh">
							<?php
							for ($i = 0; $i <= 23; $i++) {
								$in = $i < 10 ? ("0" . $i) : $i;
								?>
								<option value="<?php echo $i; ?>"<?php echo $openat[0] == $i ? ' selected="selected"' : ''; ?>><?php echo $in; ?></option>
								<?php
							}
							?>
							</select>
							&nbsp;
							<select name="timeopenstorefm">
							<?php
							for ($i = 0; $i <= 59; $i++) {
								$in = $i < 10 ? ("0" . $i) : $i;
								?>
								<option value="<?php echo $i; ?>"<?php echo $openat[1] == $i ? ' selected="selected"' : ''; ?>><?php echo $in; ?></option>
								<?php
							}
							?>
							</select>
						</div>
						<div style="display: block; margin-bottom: 3px;">
							<span class="vrirestrdrangesp"><?php echo JText::_('VRIONFIGONEFOUR'); ?></span>
							<select name="timeopenstoreth">
							<?php
							for ($i = 0; $i <= 23; $i++) {
								$in = $i < 10 ? ("0" . $i) : $i;
								?>
								<option value="<?php echo $i; ?>"<?php echo $closeat[0] == $i ? ' selected="selected"' : ''; ?>><?php echo $in; ?></option>
								<?php
							}
							?>
							</select>
							&nbsp;
							<select name="timeopenstoretm">
							<?php
							for ($i = 0; $i <= 59; $i++) {
								$in = $i < 10 ? ("0" . $i) : $i;
								?>
								<option value="<?php echo $i; ?>"<?php echo $closeat[1] == $i ? ' selected="selected"' : ''; ?>><?php echo $in; ?></option>
								<?php
							}
							?>
							</select>
						</div>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRCONFIGFORCEPICKUP'); ?></div>
					<div class="vri-param-setting">
						<?php echo $vri_app->printYesNoButtons('forcepickupt', JText::_('VRYES'), JText::_('VRNO'), (is_array($forcedpickdroptimes[0]) && count($forcedpickdroptimes[0]) ? 1 : 0), 1, 0, 'toggleForcePickup();'); ?>
						<div id="forcepickuptdiv" style="display: <?php echo (is_array($forcedpickdroptimes[0]) && count($forcedpickdroptimes[0]) > 0 ? 'block' : 'none'); ?>;">
							<?php echo $forcepickupthsel.' : '.$forcepickuptmsel; ?>
						</div>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRCONFIGFORCEDROPOFF'); ?></div>
					<div class="vri-param-setting">
						<?php echo $vri_app->printYesNoButtons('forcedropofft', JText::_('VRYES'), JText::_('VRNO'), (is_array($forcedpickdroptimes[1]) && count($forcedpickdroptimes[1]) ? 1 : 0), 1, 0, 'toggleForceDropoff();'); ?>
						<div id="forcedropofftdiv" style="display: <?php echo (is_array($forcedpickdroptimes[1]) && count($forcedpickdroptimes[1]) > 0 ? 'block' : 'none'); ?>;">
							<?php echo $forcedropoffthsel.' : '.$forcedropofftmsel; ?>
						</div>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONEELEVEN'); ?></div>
					<div class="vri-param-setting">
						<select name="dateformat">
							<option value="%d/%m/%Y"<?php echo ($nowdf == "%d/%m/%Y" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRIONFIGONETWELVE'); ?></option>
							<option value="%Y/%m/%d"<?php echo ($nowdf == "%Y/%m/%d" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRIONFIGONETENTHREE'); ?></option>
							<option value="%m/%d/%Y"<?php echo ($nowdf == "%m/%d/%Y" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRIONFIGUSDATEFORMAT'); ?></option>
						</select>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFIGTIMEFORMAT'); ?></div>
					<div class="vri-param-setting">
						<select name="timeformat">
							<option value="h:i A"<?php echo ($nowtf=="h:i A" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRICONFIGTIMEFUSA'); ?></option>
							<option value="H:i"<?php echo ($nowtf=="H:i" ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRICONFIGTIMEFEUR'); ?></option>
							<option value=""<?php echo (empty($nowtf) ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRICONFIGTIMEFNONE'); ?></option>
						</select>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONEEIGHT'); ?></div>
					<div class="vri-param-setting"><input type="number" step="any" name="hoursmorerentback" value="<?php echo VikRentItems::getHoursMoreRb(); ?>" min="0"/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGEHOURSBASP'); ?></div>
					<div class="vri-param-setting">
						<select name="ehourschbasp">
							<option value="1"<?php echo ($aehourschbasp == true ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRIONFIGEHOURSBEFORESP'); ?></option>
							<option value="0"<?php echo ($aehourschbasp == false ? " selected=\"selected\"" : ""); ?>><?php echo JText::_('VRIONFIGEHOURSAFTERSP'); ?></option>
						</select>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONENINE'); ?></div>
					<div class="vri-param-setting"><input type="number" name="hoursmoreitemavail" value="<?php echo VikRentItems::getHoursItemAvail(); ?>" min="0"/> <?php echo JText::_('VRIONFIGONETENEIGHT'); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIPICKONDROP'); ?> <?php echo $vri_app->createPopover(array('title' => JText::_('VRIPICKONDROP'), 'content' => JText::_('VRIPICKONDROPHELP'))); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('pickondrop', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::allowPickOnDrop(true), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRITODAYBOOKINGS'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('todaybookings', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::todayBookings(), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONECOUPONS'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('enablecoupons', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::couponsEnabled(), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRCONFIGENABLECUSTOMERPIN'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('enablepin', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::customersPinEnabled(), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONETENFIVE'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('tokenform', JText::_('VRYES'), JText::_('VRNO'), (VikRentItems::tokenForm() ? 'yes' : 0), 'yes', 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGREQUIRELOGIN'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('requirelogin', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::requireLogin(), 1, 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIICALKEY'); ?></div>
					<div class="vri-param-setting"><input type="text" name="icalkey" value="<?php echo VikRentItems::getIcalSecretKey(); ?>" size="10"/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONETENSEVEN'); ?></div>
					<div class="vri-param-setting"><input type="number" name="minuteslock" value="<?php echo VikRentItems::getMinutesLock(); ?>" min="0"/></div>
				</div>
			</div>
		</div>
	</fieldset>
</div>

<div class="vri-config-maintab-right">
	<fieldset class="adminform">
		<div class="vri-params-wrap">
			<legend class="adminlegend"><?php echo JText::_('VRICONFIGSEARCHPART'); ?></legend>
			<div class="vri-params-container">
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRCONFIGONEDROPDPLUS'); ?></div>
					<div class="vri-param-setting"><input type="number" name="setdropdplus" value="<?php echo VikRentItems::setDropDatePlus(true); ?>" min="0"/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRCONFIGMINDAYSADVANCE'); ?></div>
					<div class="vri-param-setting"><input type="number" name="mindaysadvance" value="<?php echo VikRentItems::getMinDaysAdvance(true); ?>" min="0"/></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRCONFIGMAXDATEFUTURE'); ?></div>
					<div class="vri-param-setting"><input type="number" name="maxdate" value="<?php echo $maxdate_val; ?>" min="0" style="float: none; vertical-align: top; max-width: 50px;"/> <select name="maxdateinterval" style="float: none; margin-bottom: 0;"><option value="d"<?php echo $maxdate_interval == 'd' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEDAYS'); ?></option><option value="w"<?php echo $maxdate_interval == 'w' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEWEEKS'); ?></option><option value="m"<?php echo $maxdate_interval == 'm' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEMONTHS'); ?></option><option value="y"<?php echo $maxdate_interval == 'y' ? ' selected="selected"' : ''; ?>><?php echo JText::_('VRCONFIGMAXDATEYEARS'); ?></option></select></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFIGGLOBCLOSEDAYS'); ?></div>
					<div class="vri-param-setting"><?php echo JHTML::_('calendar', '', 'globdayclose', 'globdayclose', '%Y-%m-%d', array('class'=>'', 'size'=>'8',  'maxlength'=>'8', 'todayBtn' => 'true')); ?> <select style="float: none;" id="vrifrequencyclose"><option value="1"><?php echo JText::_('VRICONFIGCLOSESINGLED'); ?></option><option value="2"><?php echo JText::_('VRICONFIGCLOSEWEEKLY'); ?></option></select> <button type="button" class="btn vri-config-btn" onclick="addClosingDay();" style="margin-bottom: 9px;"><?php echo JText::_('VRICONFIGADDCLOSEDAY'); ?></button><div id="vriglobclosedaysdiv" style="display: block;"><?php echo $currentglobclosedays; ?></div></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONETEN'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('placesfront', JText::_('VRYES'), JText::_('VRNO'), (VikRentItems::showPlacesFront(true) ? 'yes' : 0), 'yes', 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONETENFOUR'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('showcategories', JText::_('VRYES'), JText::_('VRNO'), (VikRentItems::showCategoriesFront(true) ? 'yes' : 0), 'yes', 0); ?></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIPREFCOUNTRIESORD'); ?> <?php echo $vri_app->createPopover(array('title' => JText::_('VRIPREFCOUNTRIESORD'), 'content' => JText::_('VRIPREFCOUNTRIESORDHELP'))); ?></div>
					<div class="vri-param-setting">
						<ul class="vri-preferred-countries-sortlist">
						<?php
						$preferred_countries = VikRentItems::preferredCountriesOrdering(true);
						foreach ($preferred_countries as $ccode => $langname) {
							?>
							<li class="vri-preferred-countries-elem">
								<span><?php VikRentItemsIcons::e('ellipsis-v'); ?> <?php echo $langname; ?></span>
								<input type="hidden" name="pref_countries[]" value="<?php echo $ccode; ?>" />
							</li>
							<?php
						}
						?>
						</ul>
						<script type="text/javascript">
						jQuery(document).ready(function() {
							jQuery('.vri-preferred-countries-sortlist').sortable();
							jQuery('.vri-preferred-countries-sortlist').disableSelection();
						});
						</script>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset class="adminform">
		<div class="vri-params-wrap">
			<legend class="adminlegend"><?php echo JText::_('VRICONFIGSYSTEMPART'); ?></legend>
			<div class="vri-params-container">
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFIGCRONKEY'); ?></div>
					<div class="vri-param-setting"><input type="text" name="cronkey" value="<?php echo VikRentItems::getCronKey(); ?>" size="6" /></div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRICONFENMULTILANG'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('multilang', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::allowMultiLanguage(), 1, 0); ?></div>
				</div>
				<!-- @wponly  we cannot display the setting for the SEF Router -->
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRILOADFA'); ?></div>
					<div class="vri-param-setting"><?php echo $vri_app->printYesNoButtons('usefa', JText::_('VRYES'), JText::_('VRNO'), (int)VikRentItems::isFontAwesomeEnabled(true), 1, 0); ?></div>
				</div>
				<!-- @wponly  jQuery main library should not be loaded as it's already included by WP -->
				<div class="vri-param-container">
					<div class="vri-param-label"><?php echo JText::_('VRIONFIGONECALENDAR'); ?></div>
					<div class="vri-param-setting">
						<select name="calendar">
							<option value="jqueryui"<?php echo ($calendartype == "jqueryui" ? " selected=\"selected\"" : ""); ?>>jQuery UI</option>
						</select>
					</div>
				</div>
				<div class="vri-param-container">
					<div class="vri-param-label">Google Maps API Key</div>
					<div class="vri-param-setting"><input type="text" name="gmapskey" value="<?php echo VikRentItems::getGoogleMapsKey(); ?>" size="30" /></div>
				</div>
			</div>
		</div>
	</fieldset>
</div>
