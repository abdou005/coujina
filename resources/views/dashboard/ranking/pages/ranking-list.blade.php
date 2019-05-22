<div class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
        <li><a href="#">@lang('messages.competitions')</a></li>
        <li class="active">@lang('messages.list')</li>
    </ol>
</div>
<!-- Main content -->
<section class="content">
    <div class="box box-default">
        <div id="panelSuccess" style="display:none;">
            <div class="alert alert-success">
            </div>
        </div>
        <div id="panelError" style="display:none;">
            <div class="alert alert-error">
            </div>
        </div>
        <div class="box-header">
            <i class="ion-ios-list-outline"></i>
            <h3 class="box-title"><b><i>@lang('messages.competitions')</i></b></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="competitions-table" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                    <th style="width: 20%">@lang('messages.name')</th>
                    <th style="width: 10%">@lang('messages.type')</th>
                    <th style="width: 30%">@lang('messages.date')</th>
                    <th style="width: 20%">@lang('messages.count_participate')</th>
                    <th style="width: 10%">@lang('messages.image')</th>
                    <th style="width: 10%">@lang('messages.ranking')</th>
                </tr>
                </thead>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
        </div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->