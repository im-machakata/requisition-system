$(function () {
    // edit requisition status
    $('.requisition .edit-status').on('click', function (e) {
        e.preventDefault();
        const requisition = $(this).parent().parent().parent().parent();
        $('#Amount').text(requisition.find('.amount').text());
        $('#Reason').text(requisition.find('.reason').text().trim());
        $('#ID').val(requisition.find('.id').val().trim());
    })

    // change background color on hover menu card
    $('.menu .card').on('mouseenter', function () {
        $(this).addClass('bg-primary');
        $(this).find('a').addClass('text-white');
    }).on('mouseleave', function () {
        $(this).removeClass('bg-primary');
        $(this).find('a').removeClass('text-white');
    });

    // calculate date differences
    $("#OutFrom, #OutTo").on('change', function () {
        const toDate = $("#OutTo").val();
        const fromDate = $("#OutFrom").val();
        const toggleSubmitButton = (days) => {
            $('#Submit').attr('disabled', (days == 0));
        }

        // do not attempt to calculate date differences when one of the dates if missing
        if (!toDate || !fromDate) {
            toggleSubmitButton(0);
            return
        };

        // Parse the input date string into a Date object
        const dates = [
            new Date(fromDate),
            new Date(toDate),
        ];

        const diffInDays = Math.floor((dates[1] - dates[0]) / (1000 * 60 * 60 * 24));
        toggleSubmitButton(diffInDays);
        $("#Days").val(diffInDays);
    });
});