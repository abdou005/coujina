@extends('dashboard.dashboard')
@section('title')
    @lang('messages.recipes')
@endsection
@section('contentPage')
    @include('dashboard.recipes.pages.recipes-list')
@endsection
@section('recipes','active')
@prepend('stylesForAc')
@endprepend
@prepend('scriptsForAc')
<!-- DataTables -->
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<script>
    //TRANS Jquery DataTable
    var lengthMenu = '{{trans('messages.LengthMenu')}}';
    var zeroRecords = '{{trans('messages.ZeroRecords')}}';
    var info = '{{trans('messages.Info')}}';
    var infoEmpty = '{{trans('messages.InfoEmpty')}}';
    var infoFiltered = '{{trans('messages.InfoFiltered')}}';
    var paginate_previous = '{{trans('messages.Paginate_previous')}}';
    var paginate_next = '{{trans('messages.Paginate_next')}}';
</script>
<script src="{{asset('js/global.js')}}"></script>
<script>
    var recipesTable = $('#recipes-table').DataTable({
        //searchDelay: 3000,
        "processing": true,
        "serverSide": true,
        "pageLength": 10,
        // "bLengthChange": false,
        "searching": false,
        columns: [
            {name: 'title', data: 'title'},
            {name: 'image', data: 'image' },
            {name: 'tags', data: 'tags' },
            {name: 'desc', data: 'desc' },

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
            },
            type: "get",
            dataType: 'json',
            beforeSend: function () {
                $('#recipes-table').addClass('table-opacity');
            },
            complete: function () {
                $('#recipes-table').removeClass('table-opacity');
            },
            error: function (msg) {
                console.log('error '+JSON.stringify(msg));
            }
        },
        "createdRow": function ( row, data, index ) {
            var tags = '';
            $.each(data['tags'], function( index, tag ) {
                tags +=tag.name+'<br>';
            });
            var countLike = data['likes_count'];
            var countComment = data['comments_count'];
            var image = '<a class="showImage" data-path="'+data['image']+'" data-title="'+data['title']+'"><img src="'+data['image']+'" class="thumbnail"></a>';
            $('td', row).eq(0).empty().append('<a class="btn btn-app" style="min-width: 40px; height: 40px;">\n' +
                '                <span class="badge bg-red">'+countLike+'</span>\n' +
                '                <i class="fa fa-heart-o" style="font-size: 15px;"></i>\n' +
                '              </a> <a class="btn btn-app" style="min-width: 40px; height: 40px;">\n' +
                '                <span class="badge bg-red">'+countComment+'</span>\n' +
                '                <i class="fa fa-commenting-o" style="font-size: 15px;"></i>\n' +
                '              </a><br><span class="font-blue-steel bold">'+data['title']+' </span>');
            $('td', row).eq(1).empty().append(image);
            $('td', row).eq(2).empty().append('<span class="font-blue-steel bold">'+tags+'</span>');
            $('td', row).eq(3).empty().append('<span class="font-blue-steel bold">'+data['desc']+'</span>');
        }
    });
    function reloadDataTable (){
        setTimeout(function(){
            recipesTable.ajax.reload();
        }, 1000);
    }
    $('#name_search').on('keyup', function () {
        reloadDataTable();
    });
    function showImage(image, title) {
        $('#modalImage .modal-body').html('<img src="'+image+'" class="img-responsive" style="margin: 0 auto; height: 400px">');
        $('#modalImage #modal-image-title').text(title);
    }
    $( "#recipes-table").on( "click",".showImage", function( event ) {
        event.preventDefault();
        $('#modalImage').modal('toggle');
        showImage($(this).data('path'), $(this).data('title'));
    });
</script>
@endprepend
