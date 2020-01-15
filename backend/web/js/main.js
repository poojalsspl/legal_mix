$('#pages-page_cr_date').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});

$('#modalButton').click(function() {
		$('#modal').modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});

