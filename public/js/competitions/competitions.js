/**
 * Initialize datepicker
 */
$(function () {
    $('.datepic').datepicker ({
        format: "dd-mm-yyyy",
        clearBtn: true,
        language: "fr",
        todayHighlight : true,
        autoclose: true
    });
});

/**
 * initialize select2
 */
$(function () {
    $(".select2").select2();
});

/**
 * init table Competition
 * @type {jQuery}
 */
var competitionsTable = $('#competitions-table').DataTable({
    //searchDelay: 3000,
    "processing": true,
    "serverSide": true,
    "pageLength": 10,
    // "bLengthChange": false,
    "searching": false,
    columns: [
        {name: 'name', data: 'name'},
        {name: 'type', data: 'type'},
        {name: 'date', data: null},
        {name: 'image', data: 'image'},
        {name: 'action', data: null}
    ],
    "columnDefs": [
        {"orderable": false, "targets": '_all'},
        {
            "className": "dt-center",
            "targets": "_all"
        }
    ],
    "language": {
        processing: '<div class="loader loader--snake"></div>',
        "lengthMenu": lengthMenu,
        "zeroRecords": zeroRecords,
        "info": info,
        "infoEmpty": infoEmpty,
        "infoFiltered": infoFiltered,
        "paginate": {
            "previous": paginate_previous,
            "next": paginate_next
        }
    },
    "ajax": {
        url: '',
        "data": function(data){
            data.name = $('#name_search').val();
            data.start_at = $('#start_at_search').val();
            data.end_at = addOneDayDatePicker($('#end_at_search').val());
            data.type = $('#type_search').val();
        },
        type: "get",
        dataType: 'json',
        beforeSend: function () {
            $('#competitions-table').addClass('table-opacity');
        },
        complete: function () {
            $('#competitions-table').removeClass('table-opacity');
        },
        error: function (msg) {
            console.log('error '+JSON.stringify(msg));
        }
    },
    "createdRow": function ( row, data, index ) {
        var dateOptions = { year: 'numeric', month: 'long', day: 'numeric' };
        var date = convertDate(data['start_at'], false).toLocaleDateString('fr-FR', dateOptions).concat(' au ', convertDate(data['end_at'], true).toLocaleDateString('fr-FR', dateOptions));
        var deleteButton = '';
        var current = new Date().getTime() / 1000;
        var start = convertDate(data['start_at'], false).getTime() /1000;
        var end =   convertDate(data['end_at'], true).getTime() /1000 ;
        if (current >= start && current < end) {
            deleteButton = '';
        }else{
           deleteButton ='<a class="btn btn-danger btn-sm delete-competition" ' +
            'data-competition-id="'+data['id']+'" ' +
            'data-toggle="confirmation" ' +
            'data-btn-ok-label="'+supprimer+'" ' +
            'data-btn-ok-icon="fa fa-remove" ' +
            'data-btn-ok-class="btn btn-sm btn-danger" ' +
            'data-btn-cancel-label="'+annuler+'" ' +
            'data-btn-cancel-icon="fa fa-chevron-circle-left" ' +
            'data-btn-cancel-class="btn btn-sm btn-default" ' +
            'data-title="'+deleteMessage+'" ' +
            'data-placement="left" ' +
            'data-singleton="true">' +
            '<i class="fa fa-trash-o"></i>' +
            '</a>';
        }
        var type = 'Amateur';
        if (data['type'] === 2){
            type = 'Professionnelle';
        }
        var image = '<a class="showImage" data-title="'+data['name']+'" data-path="'+data['image']+'" ><img src="'+data['image']+'" class="thumbnail"></a>';
        var editButton = '<a class="btn btn-info btn-sm edit-competition" data-competition-id="'+data['id']+'" ><i class="fa fa-pencil"></i> </a>';
        $('td', row).eq(0).empty().append('<span class="font-blue-steel bold">'+data['name']+'</span>');
        $('td', row).eq(1).empty().append('<span class="font-blue-steel bold">'+type+'</span>');
        $('td', row).eq(2).empty().append('<span class="font-blue-steel bold">'+date+'</span>');
        $('td', row).eq(3).empty().append(image);
        $('td', row).eq(4).empty().append('<span style="font-weight:bold;">'+editButton+' '+deleteButton+'</span>');
    }
});
$( "#competitions-table").on( "click",".showImage", function( event ) {
    $('#modalImage').modal('toggle');
    showImage($(this).data('path'));
});
$('#start_at_search, #end_at_search').on('changeDate', function () {
    reloadDataTable();
});
$('#name_search').on('keyup', function () {
    reloadDataTable();
});
$('#type_search').on('change', function () {
    reloadDataTable();
});
function reloadDataTable (){
    setTimeout(function(){
        competitionsTable.ajax.reload();
    }, 1000);
}

$("#add-competition-modal").on("hidden.bs.modal", function () {
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#save-competition').prop('disabled',false);
    $('.datepic').datepicker('update', new Date());
    $('.datepic').datepicker('update', '');
    $('#add-competition-form').attr('action','');
    $('#add-competition-form .image-holder').html('');
    $('#modal-competition-title').html(addCompetitionMessageTitle);
    $('.div-hidden').show();
    $(this).find("input")
        .val('')
        .end();
    $(this).find("textarea")
        .val('')
        .end();
});

/**
 * ajax function when user submit form
 * Add new Competition
 */
$(function(){
    $('#add-competition-form').submit(function (event) {
        event.preventDefault();
        $('#save-competition').prop('disabled',true);
        var formData = new FormData($('#add-competition-form')[0]);
        if (formData.get('end_at')) {
            var endDate = $('#end_at').datepicker('getDate');
            endDate.setDate(endDate.getDate() + 1);
            formData.set('end_at', ('0'+endDate.getDate()).slice(-2)+'-'+('0'+(endDate.getMonth()+1)).slice(-2)+'-'+endDate.getFullYear());
        }
        var url = $('#add-competition-form')[0].action;
        $.ajax({
            method : 'POST',
            url : url,
            data : formData,
            contentType: false,
            processData: false
        }).done(function (data) {
            displayMessage(data.message, 'panelSuccess', 1000);
            competitionsTable.ajax.reload();
            $('#add-competition-modal').modal('toggle');
        }).error(function (data) {
            $('#save-competition').prop('disabled',false);
            console.log(data);
            var errors = data.responseJSON.errors;
            console.log(errors);
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $.each(errors, function( index, value ) {
                $(".error_"+index).append("<strong>"+value+"</strong>");
                $(".error_"+index).parent().parent().addClass('has-error');
            })
        });
    });
});
/**
 *Attach Click event to edit-competition class using delegation
 */
$(function () {
    $( "#competitions-table" ).on( "click",".edit-competition", function( event ) {
        event.preventDefault();
        var competitionId = ($(this).data('competitionId'));
        $('#add-competition-form').attr('action', window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +competitionId);
        $('#modal-competition-title').html(editCompetitionMessageTitle);
        onEditCompetitionClick();
    });
});


/**
 * Ajax function edit Competition
 */
function onEditCompetitionClick(){
    var url = $('#add-competition-form')[0].action;
    $.ajax({
        method : 'GET',
        url : url,
        data : {}
    }).done(function (competition) {
        $('input[name=start_at]').datepicker('update', convertDate(competition.start_at, false));
        $('input[name=end_at]').datepicker('update', convertDate(competition.end_at, true));
        $('#type').val(competition.type).change();
        $('#name').val(competition.name);
        $('#address').val(competition.address);
        $('#desc').val(competition.desc);
        $('#add-competition-form .image-holder').html('<input type="hidden" name="old_image" value="'+competition.image+'" /> <img src="'+competition.image+'">');
        $('.div-hidden').hide();
        $('#add-competition-modal').modal('toggle');
    }).error(function (data) {
        console.log(data);
    });
}
/**
 * when user click confirmation YES delete Competition
 */
$('body').confirmation({
    rootSelector: 'body',
    selector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
        deleteCompetition($(this).data('competitionId'));
    }
});
/**
 * ajax function
 * @param competitionId
 */
function deleteCompetition(competitionId) {
    var urlDelete = window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +competitionId;
    $.ajax({
        method : 'DELETE',
        url : urlDelete
    }).done(function(data){
        displayMessage(data.message, 'panelSuccess', 1000);
        competitionsTable.ajax.reload();
    }).error(function (data) {
        console.log(data);
        displayMessage(data.responseJSON.message, 'panelError', 2000);
    });
}