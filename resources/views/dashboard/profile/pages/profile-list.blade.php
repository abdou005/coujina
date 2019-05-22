<!-- Content Header (Page header) -->
<div class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
        <li><a href="#">@lang('messages.user')</a></li>
        <li class="active">@lang('messages.profile')</li>
    </ol>
</div>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-default">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->image}}" alt="User profile picture">
                    <h3 class="profile-username text-center @if(Auth::user()->role === \App\User::LEADER) {{'leader'}}@endif ">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h3>
                    <p class="text-muted text-center">
                        @switch(Auth::user()->role)
                            @case(\App\User::ADMIN)
                            {{'Administrateur'}}
                            @break

                            @case(\App\User::VISITOR)
                            {{'Visiteur'}}
                            @break
                            @case(\App\User::SUBSCRIBER)
                            {{'Abonné'}}
                            @break
                            @case(\App\User::LEADER)
                            {{'Chef'}}
                            @break
                            @default
                            {{'Visiteur'}}
                        @endswitch
                    </p>
                    @if(Auth::user()->role !== \App\User::ADMIN)
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>abonnements</b> <a class="pull-right">{{Auth::user()->myFollowing()->count()}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>abonnés</b> <a class="pull-right">{{Auth::user()->myFollowers()->count()}}</a>
                            </li>
                        </ul>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- About Me Box -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">À propos de moi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> description</strong>
                    <p class="text-muted">
                        {{ Auth::user()->desc}}
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> emplacement</strong>
                    <p class="text-muted">{{ Auth::user()->address}}</p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> téléphone</strong>
                    <p class="text-muted">{{ Auth::user()->tel}}</p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div id="panelSuccess" style="display:none;">
                <div class="alert alert-success">
                </div>
            </div>
            <div id="panelError" style="display:none;">
                <div class="alert alert-error">
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Réglages</a></li>
                    <li><a href="#recipes" @if(Auth::user()->role === \App\User::ADMIN) style="display: none;" @endif data-toggle="tab">Mes recettes <small class="label bg-green" style="background-color: #8BC34A !important;">{{Auth::user()->recipes()->count()}}</small></a> </li>
                    <li><a href="#comments" @if(Auth::user()->role === \App\User::ADMIN) style="display: none;" @endif data-toggle="tab">Commentaires <small class="label bg-green" style="background-color: #8BC34A !important;" id="count-comment">0</small></a></li>
                </ul>
                <div class="tab-content">

                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal" id="edit-user" method="post" action="{{url('/user/'.Auth::user()->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-sm-2 control-label">@lang('messages.first_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="@lang('messages.first_name')" value="{{Auth::user()->first_name}}" autofocus>
                                    @if ($errors->has('first_name'))<span class="help-block"><strong>{{ $errors->first('first_name') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-sm-2 control-label">@lang('messages.last_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="@lang('messages.last_name')" value="{{Auth::user()->last_name}}">
                                    @if ($errors->has('last_name'))<span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>@endif

                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">@lang('messages.email')</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="@lang('messages.email')" value="{{Auth::user()->email}}">
                                    @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif

                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('tel') ? ' has-error' : '' }}">
                                <label for="tel" class="col-sm-2 control-label">@lang('messages.tel')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="tel" id="tel" class="form-control" placeholder="@lang('messages.tel')"  value="{{Auth::user()->tel}}"data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask="">
                                    @if ($errors->has('tel'))<span class="help-block"><strong>{{ $errors->first('tel') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-sm-2 control-label">@lang('messages.address')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address" class="form-control" id="address" placeholder="@lang('messages.address')" value="{{Auth::user()->address}}">
                                    @if ($errors->has('address'))<span class="help-block"><strong>{{ $errors->first('address') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('desc') ? ' has-error' : '' }}">
                                <label for="desc" class="col-sm-2 control-label">@lang('messages.desc')</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="3" name="desc" placeholder="@lang('messages.desc')">{{Auth::user()->desc}}</textarea>
                                    @if ($errors->has('desc'))<span class="help-block"><strong>{{ $errors->first('desc') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-sm-2 control-label">@lang('messages.image')</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" accept="image/*" id="image" placeholder="@lang('messages.image')">
                                    @if ($errors->has('image'))<span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default btn-cook">@lang('messages.save')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" @if(Auth::user()->role === \App\User::ADMIN) style="display: none;" @endif id="recipes">
                        <div class="box-tools pull-right">
                            <b><a class="pull-right btn btn-sm btn-success btn-cook" data-toggle="modal" data-target="#add-edit-recipe-modal"><i class="fa fa-plus"> @lang('messages.add')</i></a></b>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 scrollable">
                                <table id="recipes-table" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="30%">@lang('messages.information')</th>
                                        <th width="20%">@lang('messages.image')</th>
                                        <th width="25%">@lang('messages.tags')</th>
                                        <th width="20%">@lang('messages.competition')</th>
                                        <th width="5%">@lang('messages.actions')</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" @if(Auth::user()->role === \App\User::ADMIN) style="display: none;" @endif id="comments">
                        <!-- The timeline -->
                        <input type="hidden" name="page_comment" id="page-comment" value="1">
                        <ul class="timeline timeline-inverse content-comment">
                            <!-- END timeline item -->
                        </ul>
                        <div id="section-plus-comments" style="text-align: center;">
                            <a href="" id="plus-comments"> Plus des commentaires </a>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

