@foreach($roles as $role)
    <div class="col-md-3">
        <div class="panel {{$role->name == 'admin' ? 'panel-success':'panel-default'}}">

            <div class="panel-heading">
                <div class="pull-left">
                    <i class="fa fa-btn fa-user"></i>
                    {{$role->display_name or $role->name}}
                </div>

                    {{--只有admin可以删除角色，同时后台做了admin不能自删--}}
                    {{--第三个参数指是否前面的条件都要满足，默认是false--}}
                    @ability('admin', 'delete_role', ['validate_all' =>true])
                        @include('auth.roles._deleteForm')
                    @endability


                    @ability('admin','edit_role')
                        @include('auth.roles._editRoleModal')
                    @endability
                <div class="clearfix"></div>
            </div>

            <div class="panel-body">
                <ul class="fa-ul">
                    @foreach($role->perms as $perm)
                        <li>
                            <i class="fa-li fa fa-tag"></i>
                            {{$perm->display_name or $perm->name}}
                        </li>
                    @endforeach
                </ul>
            </div>
            @if($role->description)
                <div class="panel-footer">
                    {{$role->description}}
                </div>
            @endif
        </div>
    </div>
@endforeach