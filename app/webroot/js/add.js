$(function () {
    $('#datepicker_birthday').datepicker({

        changeMonth: true,
        changeYear: true,
        maxDate: 'new Date()',
        defaultDate: '2000-4-1',
        hideIfNoPrevNext: true,
        dateFormat: 'yy-mm-dd',

    });
    $('#datepicker_hire_date').datepicker({

        changeMonth: true,
        changeYear: true,
        maxDate: 'new Date()',
        defaultDate: '2010-4-1',
        hideIfNoPrevNext: true,
        dateFormat: 'yy-mm-dd',

    });
});