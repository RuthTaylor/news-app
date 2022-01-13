(function ($) {
	$(document).ready(function() {
		
		$('.searchForm input').on('input', function() {
			
			var $form = $(this).parents('.searchForm');
			var url = $form.attr('action');
			var $ajaxDiv = $('.ajaxResults').first();	

			$.ajax({
				type: "POST",
				url: url,
				data: $form.serialize(), // serializes the form's elements.
			})
			.done(function(data){
				//console.log('Success! ' + data);
				$ajaxDiv.html(data);
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				//console.log(textStatus);
				//console.log(errorThrown);
				$ajaxDiv.html('<p>Sorry, we could not get results at this time. Please try again later.</p>');
			});
		});

		$('body').on('click', '.searchResults_button', function() {
			var $this = $(this);
			var url = $this.attr('data-ajax-url');
			$.ajax({
				url: url,
			})
			.done(function(data){
				if (data == 'pin') {
					$this.parents('.searchResults__item').addClass('-pinned');
				}
				else if (data == 'unpin') {
					$this.parents('.searchResults__item').removeClass('-pinned');
				}
			});
		});

	});
})(jQuery);
