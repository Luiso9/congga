function initializeDataTable(tableId) {
    $(document).ready(function () {
        $(tableId).DataTable({
            responsive: true, 
            pagingType: "simple"
        });
    });
}