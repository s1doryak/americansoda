(function(window,$){
    window.LaravelDataTables = window.LaravelDataTables||{};
    window.LaravelDataTables["%1$s"] = $("#%1$s")
        .on('processing.dt', function (e, settings, show) {
            if (show) {
                $.showLoader();
            } else {
                $.hideLoader();
            }
        })
        .DataTable(%2$s);
})(window,jQuery);
