@extends('dashboard.dashboard')
@section('title')
    @lang('messages.ranking')
@endsection
@section('contentPage')
    @include('dashboard.ranking.pages.ranking-list')
@endsection
@section('ranking','active')
@prepend('stylesForAc')
@endprepend
@prepend('scriptsForAc')
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('js/global.js')}}"></script>
<script>
    //TRANS Jquery DataTable
    var lengthMenu = '{{trans('messages.LengthMenu')}}';
    var zeroRecords = '{{trans('messages.ZeroRecords')}}';
    var info = '{{trans('messages.Info')}}';
    var infoEmpty = '{{trans('messages.InfoEmpty')}}';
    var infoFiltered = '{{trans('messages.InfoFiltered')}}';
    var paginate_previous = '{{trans('messages.Paginate_previous')}}';
    var paginate_next = '{{trans('messages.Paginate_next')}}';
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
            {name: 'count_participate', data: 'count_participate'},
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
            var type = 'Amateur';
            if (data['type'] === 2){
                type = 'Professionnelle';
            }
            var image = '<a class="showImage" data-title="'+data['name']+'" data-path="'+data['image']+'" ><img src="'+data['image']+'" class="thumbnail"></a>';
            var editButton = '<a class="btn btn-info btn-sm list-ranking" data-competition-id="'+data['id']+'" ><i class="fa fa-eye"></i> </a>';
            $('td', row).eq(0).empty().append('<span class="font-blue-steel bold">'+data['name']+'</span>');
            $('td', row).eq(1).empty().append('<span class="font-blue-steel bold">'+type+'</span>');
            $('td', row).eq(2).empty().append('<span class="font-blue-steel bold">'+date+'</span>');
            $('td', row).eq(3).empty().append('<span class="font-blue-steel bold">'+data['count_participate']+'</span>');
            $('td', row).eq(4).empty().append(image);
            $('td', row).eq(5).empty().append('<span style="font-weight:bold;">'+editButton+'</span>');
        }
    });

    /**
     *Attach Click event to see ranking class using delegation
     */
    $(function () {
        $( "#competitions-table" ).on( "click",".list-ranking", function( event ) {
            event.preventDefault();
            var competitionId = ($(this).data('competitionId'));
            getRanking(competitionId);
        });
    });

    /**
     * Ajax function edit Competition
     */
    function getRanking(competitionId){

        $.ajax({
            method : 'GET',
            url : '/ranking/'+competitionId,
            data : {}
        }).done(function (ranking) {
            $('#ranking-table-body').html('');
            var htmlRanking = '';
            $.each(ranking ,function(index, rank){
                //'<br>'+rank.email+'<br>'+rank.id+'
                htmlRanking+='<tr>\n' +
                    '                                            <td class="dt-center">'+rank.first_name+'</td>\n' +
                    '                                            <td class="dt-center">'+rank.last_name+'</td>\n' +
                    '                                            <td class="dt-center"><a href="#"><img src="'+rank.image+'" class="thumbnail" alt=""></a></td>\n' +
                    '                                            <td class="dt-center">\n' +
                    '                                                    <span class="badge bg-red">'+rank.count_like+'</span>\n' +
                    '                                                </a>\n' +
                    '                                            </td>\n' +
                    '        </tr>';
               console.log(index, ' => '+rank);
            });
            $('#ranking-table-body').append(htmlRanking);
            $('#list-user-modal').modal('toggle');
        }).error(function (data) {
            console.log(data);
        });
    }
</script>
@endprepend
@prepend('modals')
@include('dashboard.ranking.modals.list-users-ranking')
@endprepend