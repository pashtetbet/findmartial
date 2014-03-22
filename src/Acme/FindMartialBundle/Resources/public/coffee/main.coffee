class App.AjaxForm.Customized extends App.AjaxForm.Default

	enableArtsForm: (content) ->
		master = JSON.parse content
		$('#acme_findmartialbundle_masterarttype_master').val master.master
		showBlockForm("block2")

	callbackMasterArtSave: (content) ->
		masterArts = JSON.parse content
		list = $('<ul />', {class: 'masterArtListHtml'})
		@artAppend list, masterArt for masterArt in masterArts
		$('.masterArtListBlock .masterArtListHtml').replaceWith list

	artAppend: (@list, art) ->

		formName		= $('#masterartForm').attr('name')
		liBlock 		= $('<li />', {class : 'masterArtListBlock'})
		liItem 			= $('<div />', {class : 'masterArtListItem'})
		liForm			= $('<div />', {class : 'masterArtListForm', style: 'display:none;'})


		iconAdd			= $('<i />', {class: 'fa fa-plus fa-fw'})
		iconEdit 		= $('<i />', {class: 'fa fa-edit fa-fw'})
		iconDel 		= $('<i />', {class: 'fa fa-trash-o fa-fw'})
		iconExp 		= $('<i />', {class: 'fa fa-user fa-fw'})
		iconTrExp 		= $('<i />', {class: 'fa fa-users fa-fw'})
		iconCheck 		= $('<i />', {class: 'fa fa-check fa-fw'})
		iconCancel 		= $('<i />', {class: 'fa fa-times fa-fw'})

		buttonEdit 		= $('<a />', {class : 'buttonEdit', href: '#'}).append iconEdit.clone false


		buttonDelete 	= $('<a />', {class : 'buttonDelete', href: '#'}).append iconDel.clone false
		formDelete		= $('<form />', {class : 'buttonDelete', href: '#'})



		spanTools 		= $('<span />', {class : 'artListItemAcc'})
		spanTools.append buttonEdit
		spanTools.append '&nbsp;'
		spanTools.append buttonDelete

		buttonSave 		= $('<a />', {class : 'buttonSave', href: '#'}).append iconCheck.clone false
		buttonClose 	= $('<a />', {class : 'buttonClose', href: '#'}).append iconCancel.clone false
		spanFormTools 	= $('<span />', {class : 'artListItemAcc'})
		spanFormTools.append buttonSave
		spanFormTools.append '&nbsp;'
		spanFormTools.append buttonClose



		liBlock
			.append $('<div />', {class : 'artCol'})
			.append $('<span />', {class : 'artListItemAcc', html: art.art})

		liItem
			.append $('<div />', {class : 'expirienceCol'})
			.append $('<span />', {class : 'artListItemAcc', html: art.expirience})
		liItem
			.append $('<div />', {class : 'trainingExpCol'})
			.append $('<span />', {class : 'artListItemAcc', html: art.training_exp})
		liItem
			.append $('<div />', {class : 'descriptionCol'})
			.append $('<span />', {class : 'artListItemAcc', html: art.description})
		liItem
			.append $('<div />', {class : 'toolsCol'})
			.append spanTools


		liForm
			.append $('<div />', {class : 'expirienceCol'})
			.append $('<span />', {class : 'artListItemAcc'})
			.append $('<input />', {type : 'number', name: formName+'[expirience]'})
		liForm
			.append $('<div />', {class : 'trainingExpCol'})
			.append $('<span />', {class : 'artListItemAcc'})
			.append $('<input />', {type : 'number', name: formName+'[training_exp]'})
		liForm
			.append $('<div />', {class : 'descriptionCol'})
			.append $('<span />', {class : 'artListItemAcc'})
			.append $('<input />', {type : 'text', name: formName+'[description]'})
		liForm
			.append $('<div />', {class : 'toolsCol'})
			.append spanFormTools

		liBlock.append liItem
		liBlock.append liForm

		list.append liBlock

new App.AjaxForm.Customized '.ajax-form'