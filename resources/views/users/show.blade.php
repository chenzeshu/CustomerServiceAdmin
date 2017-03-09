@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>序号</th>
                <th>员工id</th>
                <th>服务id</th>
                <th>职责</th>
                <th>发生时间</th>
            </tr>
            </thead>
            <tbody>
            @if($duties)
                @foreach( $duties as $duty)
                    <tr>
                        <td>{{ $duty->id }}</td>
                        <td>{{ $duty->user_id }}</td>
                        <td>{{ $duty->service_id }}</td>
                        <td>{{ $duty->duty }}</td>
                        <td>{{ $duty->created_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
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
