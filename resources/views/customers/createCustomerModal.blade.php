<!-- Button trigger modal -->
<button type="button" class="btn btn-default modal-trigger" data-toggle="modal" data-target="#myModal">
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
            {!! Form::open(['route'=>'customers.store','files'=>true,'method'=>'POST']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name','客户名称：',['class'=>'control-label']) !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('addr','客户地址：',['class'=>'control-label']) !!}
                    {!! Form::text('addr',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('profession','客户行业：',['class'=>'control-label']) !!}
                    {!! Form::text('profession',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('type','是否签约：',['class'=>'control-label']) !!}
                    {!! Form::radio('type',0) !!}正式用户
                    {!! Form::radio('type',1) !!}非正式用户
                </div>
                <p>目前上线工期紧张，未使用AJAX技术，提交失败原因请再次打开本页面查看</p>
                @include('errors.errors')
            </div>
            <div class="modal-footer">
                {!! Form::submit('提交',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>