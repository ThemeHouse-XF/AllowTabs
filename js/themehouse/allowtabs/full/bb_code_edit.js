/**
 * @author th
 */
/** @param {jQuery} $ jQuery Object */
!function($, window, document, _undefined)
{
	var Super = XenForo.BbCodeWysiwygEditor.prototype;
	
	$.extend(XenForo.BbCodeWysiwygEditor.prototype,
	{
		_superEditorInit: Super.editorInit,
		
		editorInit: function(ed)
		{
			this._superEditorInit(ed);

			var api = this.api,
				$ed = api.$editor;

			$ed.on('keydown', function(e) {
				if (e.keyCode == 9) {
					e.preventDefault();
					span = api.document.createElement("span");
					span.setAttribute('style', 'white-space:pre');
					span.appendChild(api.document.createTextNode('\t'));
					api.insertNodeAtCaret(span);
					api.syncCode();
				}
			});
		},
		
		insertCode: function(e, ed)
		{
			var tag, code, output;

			switch ($('#redactor_code_type').val())
			{
				case 'html': tag = 'HTML'; break;
				case 'php':  tag = 'PHP'; break;
				default:     tag = 'CODE';
			}

			code = $('#redactor_code_code').val();
			code = code.replace(/&/g, '&amp;').replace(/</g, '&lt;')
				.replace(/>/g, '&gt;').replace(/"/g, '&quot;')
				.replace(/\t/g, '<span style="white-space: pre;">\t</span>').replace(/  /g, '&nbsp; ')
				.replace(/\n/g, '</p>\n<p>');

			output = '[' + tag + ']' + code + '[/' + tag + ']';
			if (output.match(/\n/))
			{
				output = '<p>' + output + '</p>';
				output = output.replace(/<p><\/p>/g, '<p>' + (!$.browser.msie ? '<br>' : '&nbsp;') + '</p>');
			}

			ed.restoreSelection();
			ed.execCommand('inserthtml', output);
			ed.modalClose();
		},

		_superPasteCleanUpCallback: Super.pasteCleanUpCallback,
		
		pasteCleanUpCallback: function(e, ed, html)
		{
			var fromRedactor = html.match(/<div[^>]* data-redactor="1"/);

			html = html.replace(/<span[^>]+style="[^"]*white-space:\s*pre[^"]*"[^>]*>([\w\W]+?)<\/span>/g,
				function(match, contents) {
					return contents.replace(/\t/g, '[paste:span style="white-space:pre"]\t[/paste:span]');
				}
			);

			html = this._superPasteCleanUpCallback(e, ed, html);
			
			if (fromRedactor) {
				html = html.replace(/\[paste:([a-zA-Z0-9]+)(.*?)\]([\w\W]*?)\[\/paste:\1]/gi, '<$1$2>$3</$1>');
			}
			
			return html;
		},
	});
}
(jQuery, this, document);