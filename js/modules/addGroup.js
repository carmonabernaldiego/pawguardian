/*-------------------------------------------
  addgroupjs
  By CBDX
-------------------------------------------*/

$(document).ready(function () {
    $("#selectgroupsubject").select2({
        minimumResultsForSearch: Infinity
    });
    $("#selectgroupteacher").select2({
        minimumResultsForSearch: Infinity
    });
    $('#selectgroupstudents').select2({
        placeholder: 'Seleccione alumnos...',
        allowClear: true // Adds a clear button
    });
});
