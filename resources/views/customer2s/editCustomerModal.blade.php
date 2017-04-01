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
                    {!! Form::text('name',null,['class'=>'form-control', 'id'=>'name'.$customer->id]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone','联系方式：',['class'=>'control-label']) !!}
                    {!! Form::text('phone',null,['class'=>'form-control', 'id'=>'phone'.$customer->id]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('customer_name','客户单位：',['class'=>'control-label']) !!}
                    {!! Form::text('customer_name',null,['class'=>'form-control', 'id'=>'customer'.$customer->id]) !!}
                </div>
                @include('errors.errors')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="customer2Update({{$customer->id}})">提交</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    function customer2Update(id){
        var name = $('#name'+id).val()
        var phone = $('#phone'+id).val()
        var customer = $('#customer'+id).val()
        var data = {
            name:name,
            phone:phone,
            customer_name:customer,
            _token:"{{csrf_token()}}",
            _method:"PATCH"
        }
        $.post("{{asset('customer2s')}}/"+id, data, function (data) {
            location.reload()
        })
    }
</script>