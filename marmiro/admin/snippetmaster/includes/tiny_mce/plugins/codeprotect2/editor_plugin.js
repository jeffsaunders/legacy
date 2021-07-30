/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('codeprotect', 'en'); // <- Add a comma separated list of all supported languages

/****
 * 
 * I'm not even gonna copyright this, that's just silly.
 *
 * Feel free to improve on this code and re-upload it.
 * 
 * Tijmen Schep, Holland, 9-10-2005
 * 
 * 
 ****/
 
/****
 * I created this for my PCMS system (PC=Programmable Content)
 * 
 * Special Thank to Tijmen Schep
 *
 * Vorapoap Lohwongwatana, Thailand, 12-04-2006
 * 
 ****/
var codeLeftDelim = '{{';
var codeRightDelim = '}}';
var TinyMCE_codeprotectPlugin = {
	/**
	 * Returns information about the plugin as a name/value array.
	 * The current keys are longname, author, authorurl, infourl and version.
	 *
	 * @returns Name/value array containing information about the plugin.
	 * @type Array 
	 */
	getInfo : function() {
		return {
			longname : 'Code Protect Ex',
			author : 'Vorapoap (creator:unfold)',
			version : "0.9.2"
		};
	},
	getControlHTML : function(cn) {
		switch (cn) {
			case "codeprotect":
				return tinyMCE.getButtonHTML(cn, 'lang_codeprotect_button_desc', '{$pluginurl}/images/codeprotect.gif', 'mceCodeProtect');
		}

		return "";
	},
	execCommand : function(editor_id, element, command, user_interface, value) {
		// Handle commands
		switch (command) {
			// Remember to have the "mce" prefix for commands so they don't intersect with built in ones in the browser.
			case "mceCodeProtect":
				// Do your custom command logic here.
				var template = new Array();

				template['file'] = '../../plugins/codeprotect/codeprotect.htm';
				template['width'] = 640;
				template['height'] = 420;

				template['width'] += tinyMCE.getLang('lang_theme_advanced_anchor_delta_width', 0);
				template['height'] += tinyMCE.getLang('lang_theme_advanced_anchor_delta_height', 0);

				tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes"});
				return true;
		}

		// Pass to next handler in chain
		return false;
	},
	handleNodeChange : function(editor_id, node, undo_index, undo_levels, visual_aid, any_selection) {
		if (node == null)
			return;

		do {
			if (node.nodeName == "IMG" && tinyMCE.getAttrib(node, 'class').indexOf('mceCodeProtect') == 0) {
				tinyMCE.switchClass(editor_id + '_codeprotect', 'mceButtonSelected');
				return true;
			}
		} while ((node = node.parentNode));

		tinyMCE.switchClass(editor_id + '_codeprotect', 'mceButtonNormal');
	},

	cleanup : function(type, content) {
	switch (type) {
		case "get_from_editor":
			var startPos = -1;

			while ((startPos = content.indexOf('<img', startPos+1)) != -1) {
				var endPos = content.indexOf('/>', startPos);
				var attribs = TinyMCE_codeprotectPlugin._parseAttributes(content.substring(startPos + 4, endPos));

				// Is not flash, skip it
				if (attribs['class'] != "mceCodeProtect")
					continue;

				endPos += 2;

				// Insert embed/object chunk
				chunkBefore = content.substring(0, startPos);
				chunkAfter = content.substring(endPos);
				content = chunkBefore + codeLeftDelim + attribs['alt'] + codeRightDelim + chunkAfter;
			}
			break;

		case "insert_to_editor":
					
			var startPos = 0;
			
			while ((startPos = content.indexOf(codeLeftDelim, startPos)) != -1) {
				
				
				ep = content.indexOf('>', startPos + 2);
				sp = content.indexOf('<', startPos + 2);
				if (ep < sp) {
					startPos++;
					continue;
				}
				// Find end of object
				endPos = content.indexOf(codeRightDelim, startPos);
				var codeStr = content.substring(startPos + 2, endPos);
				endPos += 2;

				// Insert image
				var contentAfter = content.substring(endPos);

				content = content.substring(0, startPos);
				content += '<img width="11" height="11"';
				content += ' src="' + (tinyMCE.getParam("theme_href") + '/../../plugins/codeprotect/images/codeprotect_symbol.gif') +'"';
				content += ' alt="' + codeStr + '" class="mceCodeProtect" />';
				content += contentAfter;
				startPos++;
			}

			break;

		case "get_from_editor_dom":

			// Do custom cleanup code here. THIS PLUGIN DOESN'T USE THIS

			break;

		case "insert_to_editor_dom":

			// Do custom cleanup code here. BUT I LEFT IT IN ANYWAY..

			break;
		}

		return content;
	},
	_parseAttributes : function(attribute_string) {
		var attributeName = "";
		var attributeValue = "";
		var withInName;
		var withInValue;
		var attributes = new Array();
		var whiteSpaceRegExp = new RegExp('^[ \n\r\t]+', 'g');

		if (attribute_string == null || attribute_string.length < 2)
			return null;

		withInName = withInValue = false;

		for (var i=0; i<attribute_string.length; i++) {
			var chr = attribute_string.charAt(i);

			if ((chr == '"' || chr == "'") && !withInValue)
				withInValue = true;
			else if ((chr == '"' || chr == "'") && withInValue) {
				withInValue = false;

				var pos = attributeName.lastIndexOf(' ');
				if (pos != -1)
					attributeName = attributeName.substring(pos+1);
				attributeValue = attributeValue.replace(/&#39;/g,"'");
				attributeValue = attributeValue.replace(/&lt;/g,"<");
				attributeValue = attributeValue.replace(/&gt;/g,">");
				attributes[attributeName.toLowerCase()] = attributeValue.substring(1);

				attributeName = "";
				attributeValue = "";
			} else if (!whiteSpaceRegExp.test(chr) && !withInName && !withInValue)
				withInName = true;

			if (chr == '=' && withInName)
				withInName = false;

			if (withInName)
				attributeName += chr;

			if (withInValue)
				attributeValue += chr;
		}

		return attributes;
	}
}
tinyMCE.addPlugin("codeprotect", TinyMCE_codeprotectPlugin);
