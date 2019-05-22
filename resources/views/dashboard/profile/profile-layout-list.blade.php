@extends('dashboard.dashboard')
@section('title')
    @lang('messages.profile')
@endsection
@section('contentPage')
    @include('dashboard.profile.pages.profile-list')
@endsection
@section('profile','active')
@prepend('stylesForAc')
<link rel="stylesheet" href="{{asset('plugins/Select2/select2.min.css')}}">
<style>
    .image-user-comment{
        float: left;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
        margin-top: 5px;
    }
    .image-recipe-comment{
        width: 60px;
        height: 60px;
        margin-left: 10px;
        background-color: #fff;
        border: 3px solid #fff;
        border-radius: 4px;
    }
    .nav-tabs-custom > .nav-tabs > li.active {
        border-top-color: #8BC34A;
    }
    .profile-user-img {
        border: 3px solid #8BC34A;
    }
</style>
@endprepend
@prepend('scriptsForAc')
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('plugins/Select2/select2.full.min.js')}}"></script>
@if(Config::get('app.locale')=='fr')
    <script src="{{asset('plugins/Select2/fr.js')}}"></script>
@else
    <script src="{{asset('plugins/Select2/en.js')}}"></script>
@endif
<script src="{{asset('js/global.js')}}"></script>
<script>
    var deleteMessage = '{{trans('messages.delete_recipe')}}';
    var addRecipeMessage = '{{trans('messages.add_recipe')}}';
    var editRecipeMessage = '{{trans('messages.edit_recipe')}}';
    var supprimer ='{{trans('messages.delete')}}';
    var annuler = '{{trans('messages.cancel')}}';
    var urlRecipes = '{{url('/get-recipes')}}';
    //TRANS Jquery DataTable
    var lengthMenu = '{{trans('messages.LengthMenu')}}';
    var zeroRecords = '{{trans('messages.ZeroRecords')}}';
    var info = '{{trans('messages.Info')}}';
    var infoEmpty = '{{trans('messages.InfoEmpty')}}';
    var infoFiltered = '{{trans('messages.InfoFiltered')}}';
    var paginate_previous = '{{trans('messages.Paginate_previous')}}';
    var paginate_next = '{{trans('messages.Paginate_next')}}';
    var editRecipe = 0;
    var contentComment = $('.content-comment');

    /**
     * initialize select2
     */
    $(function () {
        $(".select2").select2();
    });

    /**
     * when user click confirmation YES delete Slider
     */
    $('body').confirmation({
        rootSelector: 'body',
        selector: '[data-toggle=confirmation]',
        onConfirm: function (event, element) {
            deleteRecipe($(this).data('recipeId'));
        }
    });
    /**
     * ajax function
     * @param recipeId
     */
    function deleteRecipe(recipeId) {
        $.ajax({
            method : 'DELETE',
            url : '/recipe/'+recipeId
        }).done(function(data){
            displayMessage(data.message, 'panelSuccess', 1000);
            recipesTable.ajax.reload();
        }).error(function (data) {
            console.log(data);
            displayMessage(data.responseJSON.message, 'panelError', 2000);
        });
    }

    /**
     * display image in modal
     * @param image
     * @param title
     */
    function showImage(image, title) {
        $('#modalImage .modal-body').html('<img src="'+image+'" class="img-responsive" style="margin: 0 auto; height: 400px">');
        $('#modalImage #modal-image-title').text(title);
    }
    $( "#recipes-table, #comments").on( "click",".showImage", function( event ) {
        event.preventDefault();
        console.log($(this).data('path'));
        $('#modalImage').modal('toggle');
        showImage($(this).data('path'), $(this).data('title'));
    });
    $( "#comments").on( "click",".delete-comment", function( event ) {
        event.preventDefault();
        $('#section-plus-comments').addClass('loader loader--snake');
        var commentId = $(this).data('commentId');
        var $this = $(this).parent().parent().parent();
        $this.remove();
        $.ajax({
            method : 'DELETE',
            url : '/comment/'+commentId
        }).done(function(data){
            $('#section-plus-comments').removeClass('loader loader--snake');
            displayMessage(data.message, 'panelSuccess', 1000);
        }).error(function (data) {
            $('#section-plus-comments').removeClass('loader loader--snake');
            displayMessage(data.responseJSON.message, 'panelError', 2000);
        });
    });
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
            {name: 'competition_id', data: 'competition_id' },
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
            url: urlRecipes,
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
            var ImageCompetition = '';
            var countLike = data['likes_count'];
            var countComment = data['comments_count'];
            if (data['competition_id']){
                ImageCompetition = '<a class="showImage"  data-path="'+data['competition']['image']+'" data-title="'+data['competition']['title']+'"><img src="'+data['competition']['image']+'" class="thumbnail"></a>';
            }
            var deleteButton='<a class="btn btn-danger btn-sm deletePlayer" style="margin: 2px;" ' +
                'data-recipe-id="'+data['id']+'" ' +
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
            var editButton = '<a class="btn btn-info btn-sm edit-recipe" style="margin: 2px;" data-recipe-id="'+data['id']+'" ><i class="fa fa-pencil"></i> </a>';
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
            $('td', row).eq(3).empty().append('<span class="font-blue-steel bold">'+ImageCompetition+'</span>');
            $('td', row).eq(4).empty().append('<span style="font-weight: bold">'+editButton+' '+deleteButton+'</span>');

        }
    });

    /**
     * Clear add-edit-recipe-modal form ,clear inputs when the user close the modal window
     */
    $("#add-edit-recipe-modal").on("hidden.bs.modal", function () {
        $('.form-group div').removeClass('has-error');
        $('.help-block').empty();
        $('#submit-form').prop('disabled',false);
        $('#add-edit-recipe-form').attr('action','');
        $('#add-edit-recipe-modal form').attr('action','');
        $('#add-edit-recipe-form .image-holder').html('');
        $('#modal-recipe-title').html(addRecipeMessage);
        $(this).find(".select2")
            .val('')
            .change();
        $(this).find("input")
            .val('')
            .end();
        $(this).find("textarea")
            .val('')
            .end();
        $('#add-edit-recipe-form').attr('action', '/recipe');
        editRecipe = 0;
    });
    /**
     * create Recipe ajax
     */
    $(function () {
        $('#add-edit-recipe-form').submit(function (event) {
            event.preventDefault();
            $('#submit-form').prop('disabled', true);
            var url = $('#add-edit-recipe-form')[0].action;
            var formData = new FormData($('#add-edit-recipe-form')[0]);
            $.ajax({
                method: 'POST',
                url: url ,
                data: formData,
                contentType: false,
                processData: false
            }).done(function (data) {
                displayMessage(data.message, 'panelSuccess', 1000);
                $('#add-edit-recipe-modal').modal('hide');
                recipesTable.ajax.reload();
            }).error(function (data) {
                $('#submit-form').prop('disabled', false);
                var errors = data.responseJSON.errors;
                console.log(errors);
                $('.form-group, .form-group div').removeClass('has-error');
                $('.help-block').empty();
                $.each(errors, function (index, value) {
                    console.log(index+' => '+value);
                    $(".error_" + index).append("<strong>" + value.join('<br/>') + "</strong>");
                    $(".error_" + index).parent().addClass('has-error');
                })
            });
        });
    });
    // show modal edit recipe
    $(function () {
        $( "#recipes-table").on( "click",".edit-recipe", function( event ) {
            event.preventDefault();
            var recipeId = ($(this).data('recipeId'));
            $('#add-edit-recipe-form').attr('action', '/recipe/'+recipeId);
            $('#modal-recipe-title').html(editRecipeMessage);
            $('#recipes-table').addClass('table-opacity');
            onEditRecipeClick(recipeId);
        });
    });
    /**
     * Ajax function edit recipe
     */
    function onEditRecipeClick(recipeId){
        $.ajax({
            method : 'GET',
            url : '/recipe/'+recipeId,
            data : {}
        }).done(function (data) {
            $('#title').val(data.title);
            $('#desc_recipe').val(data.desc);
            $('#ingredients').val(data.ingredients);
            $('#add-edit-recipe-modal .image-holder').html('<input type="hidden" name="image" value="'+data.image+'" /> <img src="'+data.image+'">');
            $('#recipes-table').removeClass('table-opacity');
            $('#add-edit-recipe-modal').modal('toggle');
            editRecipe = recipeId;
        }).error(function (data) {
        });
    }
    /**
     * load tags
     */
    $(function () {
        $("#tags").select2({
            //placeholder: select_entity_placeholder,
            ajax: {
                url: '/tags',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        is_edit_recipe : editRecipe
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 15) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: function formatRepo (repo) {
                if (repo.loading) return repo.text;
                var markup = "<div><span class='fa fa-pencil fa-3'></span>&nbsp;&nbsp;<b>" + repo.text + "</b></div>";
                //return markup;
                return markup;
            }, // omitted for brevity, see the source of this pages
            templateSelection: function formatRepoSelection (repo) {
                return repo.text;
            }// omitted for brevity, see the source of this pagesl


        });
    });
    loadCommentsRecipes($('#page-comment').val());

    function loadCommentsRecipes(page){
        $('#section-plus-comments').addClass('loader loader--snake');
        $('#plus-comments').hide();
        $('#load-comment').remove();
        $.ajax({
            method : 'GET',
            url : '/comments-recipes',
            data: {page:page}
        }).done(function (pagination) {
            $('#page-comment').val(pagination.current_page+1);
            $('#section-plus-comments').removeClass('loader loader--snake');
            $('#count-comment').text(pagination.total);
            if (pagination.next_page_url){
                $('#plus-comments').show();
            }else{
                $('#plus-comments').hide();
            }
            var html = '';
            $.each(pagination.data, function( index, comment ) {
                var nameUser = comment.user.first_name+' '+comment.user.last_name;
                var titleRecipe = comment.recipe.title;
                var imageRecipe = comment.recipe.image;
                var imageUser = comment.user.image;
                html+='<li>\n' +
                    '                                <i class="fa fa-comments bg-yellow"></i>\n' +
                    '                                <div class="timeline-item">\n' +
                    '                                    <span class="time"><i class="fa fa-clock-o"></i> il y a '+comment.elapsed+'</span>\n' +
                    '                                    <h3 class="timeline-header"><a href="#"><img src="'+imageUser+'" class="image-user-comment" alt=""> '+nameUser+'</a> a commenté votre recette \n' +
                    '                                        <a class="showImage" data-path="'+imageRecipe+'" data-title="'+titleRecipe+'"> <img src="'+imageRecipe+'" class="image-recipe-comment"></a></h3>\n' +
                    '                                    <div class="timeline-body">\n' +
                    '                                        <p>'+comment.comment+'</p>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="timeline-footer">\n' +
                    '                                        <a class="btn btn-warning btn-flat btn-xs">Voir le commentaire</a> <a class="btn btn-danger btn-xs delete-comment" data-comment-id="'+comment.id+'">Effacer</a>\n' +
                    '                                    </div>\n' +
                    '                                </div>\n' +
                    ' </li>';
            });
            contentComment.append(html);
            if (pagination.next_page_url){
                var loadComment = '<li><i class="fa fa-clock-o bg-gray" id="load-comment"></i></li>';
                contentComment.append(loadComment);
            }
        }).error(function (data) {
            $('#section-plus-comments').removeClass('loader loader--snake');
        });
    }
</script>
@endprepend
@prepend('modals')
@include('dashboard.profile.modal.add-edit-recipe')
@endprepend
