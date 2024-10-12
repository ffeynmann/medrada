/* SORTING */
if (jQuery('.show_album_content').size() > 0) {
	var $container = jQuery('.portfolio_grid_isotope');
} else if (jQuery('.portfolio_packery').size() > 0) {
	var $container = jQuery('.portfolio_packery');
}

jQuery(function () {
	if (jQuery('.show_album_content').size() > 0) {
		$container.isotope({
			itemSelector: '.element'
		});
	} else if (jQuery('.portfolio_packery').size() > 0) {
		$container.isotope({
			itemSelector: '.packery_item',
			percentPosition: true,
			masonry: {
				columnWidth: 1
			}
		});
	}

	if (jQuery('.show_album_content').size() > 0 || jQuery('.portfolio_packery').size() > 0) {
		var $optionSets = jQuery('.optionset'),
			$optionLinks = $optionSets.find('a'),
			$showAll = jQuery('.show_all');
	
		$optionLinks.on('click', function () {
			var $this = jQuery(this);
			// don't proceed if already selected
			if ($this.parent('li').hasClass('selected')) {
				return false;
			}
			var $optionSet = $this.parents('.optionset');
			$optionSet.find('.selected').removeClass('selected');
			$this.parent('li').addClass('selected');
			if ($this.attr('data-option-value') == "*") {
				$container.removeClass('now_filtering');
			} else {
				$container.addClass('now_filtering');
			}
	
			// make option object dynamically, i.e. { filter: '.my-filter-class' }
			var options = {},
				key = $optionSet.attr('data-option-key'),
				value = $this.attr('data-option-value');
			// parse 'false' as false boolean
			value = value === 'false' ? false : value;
			options[key] = value;
			if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
				// changes in layout modes need extra logic
				changeLayoutMode($this, options)
			} else {
				// otherwize, apply new options
				$container.isotope(options);
			}
			return false;
		});	
	}
});

jQuery(window).load(function () {
    if (jQuery('.show_album_content').size() > 0) {
        jQuery('.portfolio_grid_isotope').isotope('layout');
    } else if (jQuery('.portfolio_packery').size() > 0) {
		$container.isotope('layout');
		setTimeout("$container.isotope('layout')", 500);
	}
});
jQuery(window).resize(function () {
	if (jQuery('.show_album_content').size() > 0) {
		jQuery('.portfolio_grid_isotope').isotope('layout');
    } else if (jQuery('.portfolio_packery').size() > 0) {
		$container.isotope('layout');
	}
});