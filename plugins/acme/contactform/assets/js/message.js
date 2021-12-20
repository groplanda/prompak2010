$('form').on('ajaxSuccess', function(event) {
  event.currentTarget.reset();
});
$(window).on('ajaxInvalidField', function(event, fieldElement, fieldName, errorMsg, isFirst) {
  $(fieldElement).closest('.valid').addClass('has-error');
});

$(document).on('ajaxPromise', '[data-request]', function() {
  $(this).closest('form').find('.valid.has-error').removeClass('has-error');
});