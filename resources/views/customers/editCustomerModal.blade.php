<!-- Modal -->
<div class="modal fade" id="editModal-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModal-{{ $customer->id }}">修改客户信息</h4>
            </div>
            {!! Form::model($customer, ['route'=>['customers.update',$customer->id],'files'=>true,'method'=>'PATCH']) !!}
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
                {{--<div class="form-group">--}}
                    {{--{!! Form::label('name','缩略图：',['class'=>'control-label']) !!}--}}
                    {{--{!! Form::file('thumbnail',null,['class'=>'form-control']) !!}--}}
                {{--</div>--}}
                @include('errors.errors')
            </div>
            <div class="modal-footer">
                {!! Form::submit('提交修改',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>