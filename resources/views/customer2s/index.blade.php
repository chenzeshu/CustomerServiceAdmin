@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2">
                <h3>客户联系人</h3>&nbsp;
            </div>
            {{--搜索--}}
            <div class="col-sm-6" style="margin-top:20px">
                <div class="inner-project-modal float-left">
                    @include('customer2s.createCustomerModal')
                </div>
                <form action="{{asset('searchcus2name')}}" method="POST" class="float-left">
                    {{csrf_field()}}
                    <input type="text" name="searchcus2name">
                    <button class="btn btn-default btn-sm">搜索联系人</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>联系人姓名</th>
                    <th>联系方式</th>
                    <th>所属单位</th>
                    <th class="text-center" colspan="2">操作</th>
                </tr>
                </thead>
                <tbody>
                @if($customer2s)
                    @foreach($customer2s as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>
                              <ul>
                                  <div class="float-left">
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal-{{ $customer->id }}">
                                          <i class="fa fa-btn fa-cog"></i>
                                      </button>
                                  </div>
                                  <div class="float-left">
                                      @include('customer2s.deleteCustomer')
                                  </div>
                              </ul>
                            </td>
                        </tr>
                        @include('customer2s.editCustomerModal')
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

        <div class="row">

            <div class="clearfix"></div>
            <div class="container">
                <div class="service-index-page">
                    {{ $customer2s->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection



@section('customerJS')

@endsection