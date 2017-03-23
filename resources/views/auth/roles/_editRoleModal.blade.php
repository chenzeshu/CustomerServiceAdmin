<!-- Button trigger modal -->
<button type="button" class="role-btn btn btn-sm pull-right"  data-toggle="modal" data-target="#editRoleModal-{{ $role->id }}">
    <i class="fa fa-btn fa-cog"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editRoleModal-{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="editRoleModal-{{ $role->id }}-Label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">编辑角色</h4>
            </div>
            <div class="modal-body">
                {!! Form::model($role, ['method'=>'patch', 'route'=>['roles.update', $role->id]]) !!}
                    @include('auth.roles._createForm')
                <div class="checkbox">
                    @foreach($perms as $perm)
                        <label for="">
                            {!! Form::checkbox('perm[]', $perm->id, permCheck($perm, $role)) !!}
                            {{ $perm->display_name or $perm->name }}
                        </label>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    {!! Form::submit('保存编辑' ,['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
</div>