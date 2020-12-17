<?php
/** 
 * @package   	VikRentItems - Libraries
 * @subpackage 	html.system
 * @author    	E4J s.r.l.
 * @copyright 	Copyright (C) 2018 E4J s.r.l. All Rights Reserved.
 * @license  	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link 		https://vikwp.com
 */

// No direct access
defined('ABSPATH') or die('No script kiddies please!');

// fix [tmpl component] and [admin.php] issues on wordpress
JHtml::_('behavior.component');

$html = !empty($displayData['html']) ? $displayData['html'] : '';

?>

<div class="wrap">

	<?php VikRentItemsLayoutHelper::renderToolbar(); ?>

	<?php
	/**
	 * In order to avoid issues with the PHP Session, we no longer render the system messages here,
	 * we rather do it in the process() method of the VikRentItemsBody class.
	 * 
	 * @since 	1.0.7
	 */
	// VikRentItemsLayoutHelper::renderSystemMessages();
	?>

	<?php echo $html; ?>

</div>
