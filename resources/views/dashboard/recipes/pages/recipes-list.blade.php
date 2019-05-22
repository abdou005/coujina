<!-- Content Header (Page header) -->
<div class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
        <li><a href="#">@lang('messages.recipes')</a></li>
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
        <div class="box-header">
            <i class="ion-ios-list-outline"></i>
            <h3 class="box-title"><b><i>@lang('messages.recipes')</i></b></h3>
            <div class="box-tools pull-right">

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-body">
                        <div class="col-sm-6 col-sm-offset-3">
                                <div class="form-group">
                                    <label for="name" class="control-label"></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="@lang('messages.search_recipes')" name="name" id="name_search" />
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 scrollable">
                    <table id="recipes-table" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th width="30%">@lang('messages.information')</th>
                            <th width="20%">@lang('messages.image')</th>
                            <th width="25%">@lang('messages.tags')</th>
                            <th width="20%">@lang('messages.desc')</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
        </div>
    </div>

    <!-- /.row -->
</section>
<!-- /.content -->

