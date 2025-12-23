$(document).ready(function () {
   
    try {
        $('#summernote').summernote();
        
    } catch (error) {
        
    }
   
   $('.js-example-basic').select2();
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
           language: {
               paginate: {
                   previous: "<i class='fas fa-angle-left'>",
                   next: "<i class='fas fa-angle-right'>"
               }
           },
        buttons: [{
            extend: 'copyHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'excelHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'csvHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'pdfHtml5',
            title: new Date().toISOString()
        },
        ]
    });

    $("#users").select2();
    $("#providers").select2();

    $("#usersSelectAll").click(function () {
        $("#users > option").prop("selected", "selected");
        $("#users").trigger("change");
    });
    $("#usersSelectDeAll").click(function () {
        $("#users > option").prop("selected", '');
        $("#users").trigger("change");

    });

});
function copyToClipboard(id) {
    var $body = document.getElementsByTagName('body')[0];
    var secretInfo = document.getElementById(id).innerHTML;
    var $tempInput = document.createElement('INPUT');
    $body.appendChild($tempInput);
    $tempInput.setAttribute('value', secretInfo)
    $tempInput.select();
    document.execCommand('copy');
    $body.removeChild($tempInput);
    alert('tag copy.')
}
 function toggleInput(name) {
     var x = document.getElementsByName(name);
     var x = x[0];
     if (x.type === "password") {
         x.type = "text";
     } else {
         x.type = "password";
     }
 }
 