function initializeDataTable(tableId) {
    $(document).ready(function () {
        $(tableId).DataTable({
            responsive: true,
            pagingType: "simple",
            searching: true // Enable the search functionality
        });
    });
}
