$('input[type="button"]').click(function(e){
   $(this).closest('tr').remove()
})
$('#attachbugimage').live('change', function() {
	$(this).closest("#attachbugimageform").ajaxForm({
		data: {description: $('#bugdescription').html()},
		dataType: 'json',
        beforeSubmit: function() {
			if($.trim($('#bugdescription').html()) == '')
			{
				alert('Invalid description');
				return false;
			}
		},
        success: function(responseText, statusText) {
			var error = parseInt(responseText.error)
			if(error)
				alert(responseText.html);
			else
			{
				$('#bugdescription').html('');
				$('#bugtableheader').after(responseText.html);
        		$('#nodata').remove();
			}
        }
    }).submit();
});
