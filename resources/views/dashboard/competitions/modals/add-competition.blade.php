<div class="modal fade"  role="dialog" id="add-competition-modal" style="display: none;">
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
                                <h3 class="box-title" id="modal-competition-title">@lang('messages.add_competition')</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form class="form-horizontal" role="form" name="add-competition-form" id="add-competition-form" method="POST" action="{{url('/competition')}}" enctype="multipart/form-data" >
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="name">@lang('messages.name')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="@lang('messages.name')"/>
                                            <div class="help-block error_name"></div>
                                        </div>
                                    </div>
                                    <div class="div-hidden">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="type">@lang('messages.type')</label>
                                        <div class="col-sm-9">
                                            <select name="type" class="form-control select2" style="width: 100%;" id="type">
                                                <option value="{{\App\Competition::AMATEUR}}">Amateur</option>
                                                <option value="{{\App\Competition::PROFESSIONAL}}">Professionnelle</option>
                                            </select>
                                            <div class="help-block error_type"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="start_at">@lang('messages.start_at') </label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control datepic"  placeholder="" name="start_at" id="start_at" value="">
                                            </div>
                                            <span class="help-block error_start_at"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="end_at">@lang('messages.end_at') </label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control datepic"  placeholder="" name="end_at" id="end_at" value="">
                                            </div>
                                            <span class="help-block error_end_at"></span>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-9 image-holder">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="image">@lang('messages.image')</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" title="" value="importer une image(jpeg,png,jpg) ? " id="image" name="image" accept="image/*" >
                                            <div class="help-block error_image"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="address">@lang('messages.address')</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="address" name="address" placeholder="@lang('messages.address')"/>
                                            <div class="help-block error_address"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="desc">@lang('messages.desc')</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" rows="3" name="desc" id="desc" placeholder="@lang('messages.desc')"></textarea>
                                            <div class="help-block error_desc"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-lg-offset-3 col-md-3 text-center">
                                            <button type="submit" class="btn btn-default btn-cook" id="save-competition">@lang('messages.save')</button>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <button type="button" data-dismiss="modal" class="btn btn-default close-competition-modal">@lang('messages.cancel')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div><!-- /.modal-content -->
