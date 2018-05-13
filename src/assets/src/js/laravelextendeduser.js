import countries from './countries';

$(function () {

	// Profile address: countries dropdown list
	for (let country in countries) {

		let selected = (
			countries[country]["name"] === $('.user-profile select[name="country"]').attr('data-value')
		) ? ' selected' : '';

		$('.user-profile select[name="country"]').append(
			'<option id="'+countries[country]["id"]+'"'+selected+'>'+countries[country]["name"]+'</option>'
		);

	}

	// Profile image
	$('.user-profile-image--button input[name="image"]').on ('change', function (event) {

		let stdWidth = 128;

		let file = event.target.files[0];
		
		let defaultImage = $(this).closest('.user-profile-image')
		.find('.user-profile-image--default');

		let selectedImage = $(this).closest('.user-profile-image')
		.find('.user-profile-image--selection img');

		defaultImage.css('visibility', 'hidden');
		selectedImage.attr('src', URL.createObjectURL(file));

		setTimeout(function () {
			// Set the default image size and position
			selectedImage.css('width', 'auto');
			selectedImage.css('height', 'auto');
			selectedImage.css('margin-top', 0);
			selectedImage.css('margin-left', 0);
		}, 50);

		// Set the new size and position
		setTimeout(function () {
			let w = selectedImage.width();
			let h = selectedImage.height();

			if (w === h || w > h) {
				selectedImage.height(stdWidth);
				let newWidth = selectedImage.width();
				selectedImage.css('margin-left', '-'+((newWidth-stdWidth)/2)+'px');
			} else {
				selectedImage.width(stdWidth);
				let newHeight = selectedImage.height();
				selectedImage.css('margin-top', '-'+((newHeight-stdWidth)/2)+'px');
			}
			
		}, 100);
	});

});