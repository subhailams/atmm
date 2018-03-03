$("#DepartmentID").on("change", function (event, r) {
    LastUrl = "";
    AjaxCall("index.php/Administrator/FetchFaculty", "id=" + $(this).val(), "FacultyID", "id");
});
