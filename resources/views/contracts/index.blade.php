@extends('layouts.app')

@section('content')
    <div class="container tasks-styl">
        <v-services :services="{{ $services }}" :contract_id="{{ $id }}" :stype="0"></v-services>
    </div>

@endsection

@section('customJS')
    <script>
        //不放jq初始化里，因为太慢了。
        //第二个参数为默认值
        var oPosition = loadFromLocal('serviceposition',1)
        $('a[role="tab"][data-content='+ oPosition +']').click()

        //tab栏位置存档
        function goPosition(e) {
            var position = $(e).data('content')
            saveToLocal('serviceposition', position)
        }
    </script>
@endsection