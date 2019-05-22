@extends('dashboard.dashboard')
@section('title')
    @lang('messages.competitions')
@endsection
@section('contentPage')
    @include('dashboard.competitions.pages.competitions-list')
@endsection
@section('competitions','active')
@prepend('stylesForAc')
<link rel="stylesheet" href="{{asset('plugins/Select2/select2.min.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('plugins/Datepicker/datepicker.css')}}">
@endprepend
@prepend('scriptsForAc')
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('plugins/Datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('plugins/Datepicker/bootstrap-datepicker.fr.min.js')}}"></script>
<script src="{{asset('plugins/Select2/select2.full.min.js')}}"></script>
@if(Config::get('app.locale')=='fr')
    <script src="{{asset('plugins/Select2/fr.js')}}"></script>
@else
    <script src="{{asset('plugins/Select2/en.js')}}"></script>
@endif
<script>
    var addCompetitionMessageTitle = '{{trans('messages.add_competition')}}';
    var editCompetitionMessageTitle = '{{trans('messages.edit_competition')}}';
    //TRANS Jquery DataTable
    var lengthMenu = '{{trans('messages.LengthMenu')}}';
    var zeroRecords = '{{trans('messages.ZeroRecords')}}';
    var info = '{{trans('messages.Info')}}';
    var infoEmpty = '{{trans('messages.InfoEmpty')}}';
    var infoFiltered = '{{trans('messages.InfoFiltered')}}';
    var paginate_previous = '{{trans('messages.Paginate_previous')}}';
    var paginate_next = '{{trans('messages.Paginate_next')}}';
    var deleteMessage = '{{trans('messages.delete_competition')}}';
    var supprimer = '{{trans('messages.delete')}}';
    var annuler = '{{trans('messages.cancel')}}';
</script>
<script src="{{asset('js/global.js')}}"></script>
<script src="{{asset('js/competitions/competitions.js')}}"></script>
@endprepend

@prepend('modals')
@include('dashboard.includes.modal.image')
@include('dashboard.competitions.modals.add-competition')
@endprepend

