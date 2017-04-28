jQuery.noConflict();
(function ($) {
	$(function () {
		
		$(document).ready(function () {

			fp_car_catalogue = fp_car_catalogue || {};


			var buildApiRequest = function (formSelector, apiEndpoint) {

				return $.ajax({
					url: fp_car_catalogue.rest_api_root + apiEndpoint,
					method: 'POST',
					beforeSend: function (xhr) {
						xhr.setRequestHeader('X-WP-Nonce', fp_car_catalogue.rest_api_nonce);
					},
					data: $(formSelector).serializeArray()

				});
			};

			var reloadListOfPosts = function (replace, successCallback, context, apiEndpoint, formSelector, templateId, nextEntitiesSelector, moreButtonSelector, responseDataFieldName) {

				buildApiRequest(formSelector, apiEndpoint).done(function (response) {

					if (replace) {
						$('#' + templateId).nextAll(nextEntitiesSelector).remove();
					}

					var source = $('#' + templateId).html();
					var template = Handlebars.compile(source);
					for (var itemIndex in response[responseDataFieldName]) {
						var html = template(response[responseDataFieldName][itemIndex]);
						$('#' + templateId).parent().append(html);
					}

					//	hide or show the "load more" button depending on the page number
					var currentPage = parseInt($(formSelector + ' input[name=page]').val());
					if (currentPage == response.total_pages || response[responseDataFieldName].length == 0) {
						$(moreButtonSelector).closest('.row').hide();
					} else {
						$(moreButtonSelector).closest('.row').show();
					}

					successCallback && typeof (successCallback) === "function" && successCallback(context);
				});
			};

			var activateFilterFormHandlers = function (wrapperBlockSelector, moreButtonSelector, filterFormSelector, reloadHandler) {

				if ($(moreButtonSelector).length) {

					//	load more button
					$(wrapperBlockSelector).on('click', moreButtonSelector, function (e) {

						var currentPage = parseInt($(filterFormSelector + ' input[name=page]').val());
						$(filterFormSelector + ' input[name=page]').val(currentPage + 1);
						reloadHandler(false);
						return false;
					});

				}

				//	filter controls
				$(filterFormSelector).on('click', 'button[data-name]', function (e) {

					var filterAttr = $(this).attr('data-name');
					$(filterFormSelector + ' input[name=' + $(this).data('name') + ']').val($(this).data('value'));
					$(filterFormSelector + ' input[name=page]').val(1);
					reloadHandler(true, function (context) {
						$(context).closest('.ordering').find('button.active[data-name="' + filterAttr + '"]').removeClass('active');
						$(context).addClass('active');//.find('button[data-name]').blur();
						$(context).closest('.ordering').find('button[data-name]').blur();
					}, $(this));
				});

				$(filterFormSelector).on('change', 'select', function (e) {

					var fieldName = $(this).attr('name');
					var value = $(this).val();
					var isChecked = $(this).is(':checked');
					var form = $(this).closest('form');
					if (value == 'all') {
						form.find('input[type=checkbox][name="' + fieldName + '"]:not(:first)').prop('checked', isChecked);
					} else {
						if (!isChecked) {
							form.find('input[type=checkbox][name="' + fieldName + '"][value="all"]').prop('checked', false);
						} else {
							var checkedElements = form.find('input[type=checkbox][name="' + fieldName + '"]:not([value="all"]):checked').length;
							var allElementsCount = form.find('input[type=checkbox][name="' + fieldName + '"]:not([value="all"])').length;
							if (checkedElements == allElementsCount) {
								form.find('input[type=checkbox][name="' + fieldName + '"][value="all"]').prop('checked', true);
							}
						}

					}

					$(filterFormSelector + ' input[name=page]').val(1);
					reloadHandler(true);
				});
			};

			activateFilterFormHandlers('.car-list-wrapper', '.load-more', 'form.car-filter-form', function (replace, successCallback, context) {
				reloadListOfPosts(replace, successCallback, context, 'foundationpress/v1/cars', 'form.car-filter-form', 'car-template', '.blogpost-entry', '.load-more', 'cars');
			});


		});
	});
})(jQuery);

