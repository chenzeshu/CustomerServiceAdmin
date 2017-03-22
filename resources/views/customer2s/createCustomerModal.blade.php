<!-- Button trigger modal -->
<button type="button" class="btn btn-default btn-sm modal-trigger" data-toggle="modal" data-target="#myModal">
    <i class="fa fa-btn fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">新建客户</h4>
            </div>
            {!! Form::open(['route'=>'customer2sblade.store','method'=>'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name','联系人姓名：',['class'=>'control-label']) !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone','联系方式：',['class'=>'control-label']) !!}
                    {!! Form::text('phone',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('customer_name','客户单位：',['class'=>'control-label']) !!}
                    {!! Form::text('customer_name',null,['class'=>'form-control']) !!}
                </div>
                @include('errors.errors')
            </div>
            <div class="modal-footer">
                {!! Form::submit('提交',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>