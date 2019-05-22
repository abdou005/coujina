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
            <div class="box-tools pull-right">
                <b><a href="" class="pull-right btn btn-sm btn-default btn-cook" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#add-competition-modal"><i class="fa fa-plus"> @lang('messages.add')</i></a></b>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <form role="form">
                        <div class="box-body">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="name_search" class="control-label">@lang('messages.name')</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="" name="name_search" id="name_search" value="">
                                    </div>
                                    <span class="help-block name_search"></span>
                                </div>
                            </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="start_at_search" class="control-label">Du</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control datepic"  placeholder="" name="start_at_search" id="start_at_search" value="">
                                        </div>
                                        <span class="help-block start_at_search"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="end_at_search" class="control-label">Au</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control datepic"  placeholder="" name="end_at_search" id="end_at_search" value="">
                                        </div>
                                        <span class="help-block end_at_search"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="type_search" class="control-label">Type</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-pencil"></i>
                                            </div>
                                            <select name="type_search" class="form-control select2" style="width: 100%;" id="type_search">
                                                <option value="0">Tous</option>
                                                <option value="{{\App\Competition::AMATEUR}}">Amateur</option>
                                                <option value="{{\App\Competition::PROFESSIONAL}}">Professionnelle</option>
                                            </select>                                    </div>
                                        <span class="help-block type_search"></span>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
            <table id="competitions-table" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                    <th style="width: 20%">@lang('messages.name')</th>
                    <th style="width: 15%">@lang('messages.type')</th>
                    <th style="width: 30%">@lang('messages.date')</th>
                    <th style="width: 15%">@lang('messages.image')</th>
                    <th style="width: 20%">@lang('messages.actions')</th>
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

