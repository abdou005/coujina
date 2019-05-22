<div class="modal fade" id="add-edit-recipe-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="box-title" id="modal-recipe-title">@lang('messages.add_recipe')</h3>
                            </div>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{url('/recipe')}}" name="add-edit-recipe-form" id="add-edit-recipe-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="title">@lang('messages.title')</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title" name="title" placeholder="@lang('messages.title')"/>
                                    <div class="help-block error_title"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="desc_recipe">@lang('messages.desc')</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" name="desc_recipe" id="desc_recipe" placeholder="@lang('messages.desc')"></textarea>
                                    <div class="help-block error_desc_recipe"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="ingredients">@lang('messages.ingredients')</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" rows="3" name="ingredients" id="ingredients" placeholder="@lang('messages.ingredients')"></textarea>
                                    <div class="help-block error_ingredients"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" for="tags">@lang('messages.tags')</label>
                                <div class="col-sm-9">
                                    <select name="tags[]" id="tags" class="form-control selectpicker select2" multiple="multiple" style="width:100%;">
                                    </select>
                                    <div class="help-block error_tags"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9 image-holder">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="image_recipe" class="control-label col-sm-3">@lang('messages.image')</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" title="" value="importer une image(jpeg,png,jpg) ? " id="image_recipe" name="image_recipe" accept="image/*" >
                                    <div class="help-block error_image_recipe"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="submit-form" type="submit" class="btn btn-primary left btn-cook">
                                    @lang('messages.save')
                                </button>
                                <button type="submit" class="btn btn-default"
                                        data-dismiss="modal">
                                    @lang('messages.cancel')
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
        </div>
    </div>
</div>