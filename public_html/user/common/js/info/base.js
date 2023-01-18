function setWysiwyg(elm, slug) {

	ClassicEditor
		.create(document.querySelector(elm), {
			'alignment': {
				options: [
					{ name: 'left', className: 'text-left' },
					{ name: 'right', className: 'text-right' },
					{ name: 'center', className: 'text-center' }
				]
			},

			// removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
			toolbar: {
				items: [
					'fontColor', 'fontBackgroundColor',
					'|',
					'bold', 'italic', 'underline', 'strikethrough',
					'|',
					'bulletedList', 'alignment',
					'|',
					'link', 'insertTable', 'MediaEmbed'
				],
			},
			mediaEmbed: {
				previewsInData: true
			},
			table: {
				contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
			},
			language: "jp",

			list: {
				properties: { styles: false, startIndex: false, reversed: false }
			},

			// a タグの設定
			link: {
				// attr target＝＿blank
				addTargetToExternalLinks: true,

			},

		}).catch((error) => {
			console.error(error);
		});
	return;
}


function chooseFileUpload(e) {
	var $this = $(e);
	$this.parents('.td_parent').find('.error-message').remove();

	var files = $this[0].files;
	var types = $this.attr('data-type');
	var types = types.split(",");

	var is_file_type = false;


	for (let i = 0; i < files.length; i++) {
		const __type = files[i].type;
		if ($.inArray(__type, types) === -1) {
			is_file_type = true;
			break;
		}
	}
	if (is_file_type) {
		$this.parents('.td_parent').append(`<div class="error-message"><div class="error-message">指定されたファイルを選択してください</div></div>`);
		$this.val('');
		return false;
	}
}


function preview_img_action(e, is_back_old_image) {
	$(e)
		.parents('.preview_img')
		.addClass('dpl_none')
		.siblings('input')
		.val('')
		.siblings('.thumbImg')
		.removeClass('dpl_none');

	if (is_back_old_image)
		$(e)
			.parents('.preview_img')
			.siblings('.thumbImg')
			.removeClass('dpl_none');
}

function matchYoutubeUrl(url) {
	var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
	var matches = url.match(p);
	return matches ? matches[1] : false;
}

function getVideoYT(e) {
	var inp_val = $(e).val();
	if (inp_val != '') {
		var id = matchYoutubeUrl(inp_val) ? matchYoutubeUrl(inp_val) : inp_val;
		$('.yt').removeClass('dpl_none').find('iframe').attr('src', `https://www.youtube.com/embed/${id}`);
	} else $('.yt').addClass('dpl_none').find('iframe').attr('src', '');
}