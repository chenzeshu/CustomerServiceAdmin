<!-- Modal -->
<div class="modal fade" id="editModal-{{ $customer->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editModal-{{ $customer->id }}">修改联系人信息</h4>
            </div>
            {!! Form::model($customer, ['route'=>['customer2sblade.update',$customer->id],'files'=>true,'method'=>'PATCH']) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name','联系人名称：',['class'=>'control-label']) !!}
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
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{{--<script>--}}
    {{--function customer2Update(customer){--}}
        {{--console.log(customer)--}}
        {{--return--}}
        {{--var data = {--}}
            {{--name:customer.name,--}}
            {{--phone:customer.phone,--}}
            {{--customer_name:customer.customer_name,--}}
            {{--_token:"{{csrf_token()}}",--}}
            {{--_method:"PATCH"--}}
        {{--}--}}
        {{--$.post("{{asset('customer2sblade')}}/"+customer.id, data, function (data) {--}}
            {{--location.reload()--}}
        {{--})--}}
    {{--}--}}
{{--</script>--}}