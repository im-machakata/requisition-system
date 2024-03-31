$(function () {
    // change background color on hover menu card
    $('.menu .card').on('mouseenter', function () {
        $(this).addClass('bg-primary');
        $(this).find('a').addClass('text-white');
    }).on('mouseleave', function () {
        $(this).removeClass('bg-primary');
        $(this).find('a').removeClass('text-white');
    });

    $("#OutFrom, #OutTo").on('change', function () {
        var toDate = $("#OutTo").val();
        var fromDate = $("#OutFrom").val();
        const toggleSubmitButton = (days) => {
            $('#Submit').attr('disabled', (days == 0));
        }

        // do not attempt to calculate date differences when one of the dates if missing
        if (!toDate || !fromDate) {
            toggleSubmitButton(0);
            return
        };

        // Parse the input date string into a Date object
        var dates = [
            new Date(fromDate),
            new Date(toDate),
        ];

        var diffInDays = Math.floor((dates[1] - dates[0]) / (1000 * 60 * 60 * 24));
        toggleSubmitButton(diffInDays);
        $("#Days").val(diffInDays);
    });
});