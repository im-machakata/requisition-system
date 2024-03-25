$(function () {
    $("#OutFrom, #OutTo").on('change', function () {
        var toDate = $("#OutTo").val();
        var fromDate = $("#OutFrom").val();

        // Parse the input date string into a Date object
        var dates = [
            new Date(fromDate),
            new Date(toDate),
        ];

        var diffInDays = Math.floor((dates[1] - dates[0]) / (1000 * 60 * 60 * 24));
        $("#Days").val(diffInDays);
    });
});