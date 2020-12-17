<?php
/** 
 * @package   	VikWP - Libraries
 * @subpackage 	adapter.editor
 * @author    	E4J s.r.l.
 * @copyright 	Copyright (C) 2020 E4J s.r.l. All Rights Reserved.
 * @license  	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link 		https://vikwp.com
 */

// No direct access
defined('ABSPATH') or die('No script kiddies please!');

JLoader::import('adapter.editor.editor');

/**
 * Editor class to handle a Code Mirror editor.
 *
 * @since 10.0
 */
class JEditorCodeMirror extends JEditor
{
	/**
	 * @override
	 * Renders the editor area.
	 *
	 * @param   string   $name     The control name.
	 * @param   string   $html     The contents of the text area.
	 * @param   string   $width    The width of the text area (px or %).
	 * @param   string   $height   The height of the text area (px or %).
	 * @param   integer  $col      The number of columns for the textarea.
	 * @param   integer  $row      The number of rows for the textarea.
	 * @param   boolean  $buttons  True and the editor buttons will be displayed.
	 * @param   string   $id       An optional ID for the textarea (note: since 10.1.20).
	 *
	 * @return  string 	 The editor.
	 *
	 * @link 	https://developer.wordpress.org/reference/functions/wp_enqueue_code_editor/
	 */
	protected function render($name, $html, $width, $height, $col, $row, $buttons, $id)
	{
		?>

		<textarea
			name="<?php echo $name; ?>"
			id="<?php echo $id; ?>"
			rows="<?php echo $row; ?>"
			cols="<?php echo $col; ?>"
		><?php echo htmlentities($html); ?></textarea>

		<?php

		// Make sure codemirror is supported by this version of WordPress (4.9.0 >).
		// If not, a plain textarea will be shown.
		if (function_exists('wp_enqueue_code_editor'))
		{
			// enqueue code editor
			wp_enqueue_code_editor(array('type' => 'php'));

			/**
			 * Inject CodeMirror instance within Joomla.editors pool.
			 *
			 * @since 10.1.17
			 */
			JFactory::getDocument()->addScriptDeclaration(
<<<JS
jQuery(document).ready(function() {
	var editor = wp.codeEditor.initialize('$name');

	Joomla.editors.instances['$id'] = {
		id: 	  '$name',
		element:  editor,
		getValue: function () {	
			return editor.codemirror.getValue();
		},
		setValue: function (text) {
			return editor.codemirror.setValue(text);
		},
	};
});
JS
			);
		}
	}
}
