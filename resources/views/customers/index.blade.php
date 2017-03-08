@extends('layouts.app')

@section('content')

<div class="container">
    <h3>客户信息库</h3>
    <hr>
    <div class="row">
        @if($customers)
            @foreach($customers as $customer)
                <div class="col-sm-6 col-sm-6 col-md-3 col-lg-3 cus-hook">
                    <div class="thumbnail">
                        <ul class="icon-bar">
                            <li>
                                若不显示请刷新页面
                            </li>
                            <li>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editModal-{{ $customer->id }}">
                                    <i class="fa fa-btn fa-cog"></i>
                                </button>
                            </li>
                            <li>
                                @include('customers.deleteCustomer')
                            </li>
                        </ul>
                        <a href="{{ route('customers.show', $customer->id) }}"><img src="{{ asset('storage/thumbnails/test.jpg')  }}" alt="..."></a>
                       <div class="caption text-center">
                            <h4><a href="{{ route('customers.show', $customer->id) }}">{{ $customer->name }}</a></h4>
                        </div>
                    </div>
                </div>
                @include('customers.editCustomerModal')
            @endforeach
        @endif
            <div class="project-modal col-sm-6 col-md-3 col-lg-3">
                <div class="inner-project-modal">
                    @include('customers.createCustomerModal')
                </div>
            </div>
    </div>
</div>
@endsection

@section('customJS')
    <script>
        $(function () {
            toggleBar()
            setInterval(setHeight, 500)
        })

        function toggleBar(){
            $('.icon-bar').hide()
            $('.thumbnail').hover(function () {
                $(this).find('.icon-bar').toggle()
            })
        }
        function setHeight() {
            var cHeight = $('.cus-hook:first').height()
            if (cHeight){
                $('.inner-project-modal').height(cHeight-48);
            }
        }
    </script>
@endsection
