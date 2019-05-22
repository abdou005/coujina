<div class="modal fade" role="dialog" id="list-user-modal" style="display: none;">
    <div class="modal-dialog modal-lg" role="">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="box-title" id="modal-competition-title"
                                    style="margin-left: 45%;">@lang('messages.ranking')</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                        <tr>
                                            <th>@lang('messages.first_name')</th>
                                            <th>@lang('messages.last_name')</th>
                                            <th>@lang('messages.image')</th>
                                            <th>@lang('messages.ranking')</th>
                                        </tr>
                                        </thead>
                                        <tbody id="ranking-table-body">

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</div>
