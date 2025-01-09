/*
* 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0).
*
*  @author Andrey <byalonovich@bk.ru>
*  @copyright  2015-2020 Andrey & co
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*/
function tinySetup(config)
{
	if(!config)
		config = {};

	//var editor_selector = 'rte';

	if (typeof config.editor_selector != 'undefined')
		config.selector = '.'+config.editor_selector;

	default_config = {
		selector: ".rte" ,
		plugins : "colorpicker link image paste pagebreak table contextmenu filemanager table code media autoresize textcolor anchor fontellico",
		browser_spellcheck : true,
		toolbar1 : "fontellico,code,|,bold,italic,underline,strikethrough,|,alignleft,aligncenter,alignright,alignfull,formatselect,|,blockquote,colorpicker,pasteword,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,anchor,|,media,image",
		toolbar2: "",
		external_filemanager_path: ad+"/filemanager/",
		filemanager_title: "File manager" ,
		external_plugins: { "filemanager" : ad+"/filemanager/plugin.min.js"},
		language: iso,
		skin: "prestashop",
		statusbar: false,
		relative_urls : false,
		convert_urls: false,
		entity_encoding: "raw",
		extended_valid_elements : "em[class|name|id]",
		valid_children : "+*[*]",
		valid_elements:"*[*]",
		menu: {
			edit: {title: 'Edit', items: 'undo redo | cut copy paste | selectall'},
			insert: {title: 'Insert', items: 'media image link | pagebreak'},
			view: {title: 'View', items: 'visualaid'},
			format: {title: 'Format', items: 'bold italic underline strikethrough superscript subscript | formats | removeformat'},
			table: {title: 'Table', items: 'inserttable tableprops deletetable | cell row column'},
			tools: {title: 'Tools', items: 'code'}
		}
	};

	$.each(default_config, function(index, el)
	{
		if (config[index] === undefined )
			config[index] = el;
	});

	tinyMCE.init(config);
}
