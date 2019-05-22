<div class="modal fade" role="dialog" id="logoutModal" style="display: none;">
    <div class="modal-dialog sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="row">
                    <p>@lang('messages.Want_you_to_logout')</p>
                </div>
                <div class="row">
                    <a href="#" class="btn btn-danger btn-lg" style="background-color: #8BC34A; border: 3px solid #000000;" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">@lang('messages.Yes')</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="btn btn-default btn-lg " style="border: 3px solid transparent;" data-dismiss="modal">@lang('messages.No')</button>
                </div>
            </div>
        </div>
    </div>
</div>