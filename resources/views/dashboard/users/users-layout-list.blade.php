@extends('dashboard.dashboard')
@section('title')
    @lang('messages.users')
@endsection
@section('contentPage')
    @include('dashboard.users.pages.users-list')
@endsection
@section('users','active')
@prepend('stylesForAc')
@endprepend
@prepend('scriptsForAc')
<!-- DataTables -->
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<script>
    var deleteMessage = '{{trans('messages.delete_user')}}';
    var supprimer ='{{trans('messages.delete')}}';
    var annuler = '{{trans('messages.cancel')}}';
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
<script src="{{asset('js/users/users.js')}}"></script>
@endprepend
