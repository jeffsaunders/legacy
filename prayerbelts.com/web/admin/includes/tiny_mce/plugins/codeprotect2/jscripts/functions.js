var action, element;

function init() {
	tinyMCEPopup.resizeToInnerSize();

	var formObj = document.forms[0];
	var inst = tinyMCE.getInstanceById(tinyMCE.getWindowArg('editor_id'));
	var elm = inst.getFocusElement();
	var action = "insert";
	var html = new String(tinyMCE.getAttrib(elm, 'alt'));
	//html = html.replace(/\'\s/g,"'\n");
	if (elm != null && elm.nodeName == "IMG")
		action = "update";
	formObj.insert.value = tinyMCE.getLang('lang_' + action, 'Insert', true); 
	if (action == "update") {

		formObj.alt.value    = html
		window.focus();
	} 
}
function setAttrib(elm, attrib, value) {
	var formObj = document.forms[0];
	var valueElm = formObj.elements[attrib];

	if (typeof(value) == "undefined" || value == null) {
		value = "";

		if (valueElm)
			value = valueElm.value;
	}

	if (value != "") {
		elm.setAttribute(attrib, value);

		eval('elm.' + attrib + "=value;");
	} else
		elm.removeAttribute(attrib);
}
function insertAction() {
	var inst = tinyMCE.getInstanceById(tinyMCE.getWindowArg('editor_id'));
	var name = document.forms[0].alt.value;
	var elm = inst.getFocusElement();

	name = name.replace(/\"/g, "'");
	//name = name.replace(/\n/g, " ");
	name = name.replace(/\s+/g, " ");
	//name = name.replace(/</g, '&lt;');
	//name = name.replace(/>/g, '&gt;');
	
	tinyMCEPopup.execCommand("mceBeginUndoLevel");

	if (elm != null && elm.nodeName == "IMG") {
		setAttrib(elm, 'alt', name);
		if (elm.nodeName == "IMG")
			elm.setAttribute("alt", name);
	} else {
		var rng = inst.getRng();

		if (rng.collapse)
			rng.collapse(false);


		// Fix for bug #1447335
		/*if (tinyMCE.isGecko)
			html = '<a id="mceNewAnchor" name="' + name + '"></a>';
		else
			html = '{{' + name + '}}';
		*/
		
		html = '<img width="11" height="11"';
		html += ' src="' + (tinyMCE.getParam("theme_href") + '/../../plugins/codeprotect/images/codeprotect_symbol.gif') +'"';
		html += ' alt="' + name + '" class="mceCodeProtect" />';
		
		tinyMCEPopup.execCommand("mceInsertContent", false, html);

		// Fix for bug #1447335 force cursor after the anchor element
		/*if (tinyMCE.isGecko) {
			e = inst.getDoc().getElementById('mceNewAnchor');

			if (e) {
				inst.selection.selectNode(e, true, false, false);
				e.removeAttribute('id');
			}
		}*/

		tinyMCE.handleVisualAid(inst.getBody(), true, inst.visualAid, inst);
	}

	tinyMCEPopup.execCommand("mceEndUndoLevel");

	tinyMCE.triggerNodeChange();
	tinyMCEPopup.close();
}
