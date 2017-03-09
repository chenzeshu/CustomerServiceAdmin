@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>员工id</th>
                    <th>员工姓名</th>
                    <th>邮箱</th>
                    <th>联系方式</th>
                    <th>创建时间</th>
                </tr>
            </thead>
            <tbody>
                @if($users)
                    @foreach( $users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ link_to_route('users.show', $user->name, $user->id) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
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
