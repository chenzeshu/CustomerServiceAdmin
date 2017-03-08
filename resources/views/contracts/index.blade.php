@extends('layouts.app')

@section('content')
    <div class="container tasks-styl">




        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="#guzhang" aria-controls="home" role="tab" data-toggle="tab"
                data-content="1" onclick="goPosition(this)">故障处理</a></li>
            <li role="presentation"><a href="#xunjian" aria-controls="profile" role="tab" data-toggle="tab"
               data-content="2" onclick="goPosition(this)">巡　检</a></li>
            <li role="presentation"><a href="#yingji" aria-controls="messages" role="tab" data-toggle="tab"
               data-content="3" onclick="goPosition(this)">应急保障</a></li>
            <li role="presentation"><a href="#yuancheng" aria-controls="settings" role="tab" data-toggle="tab"
               data-content="4" onclick="goPosition(this)">远程协助</a></li>
            <li role="presentation"><a href="#qita" aria-controls="settings" role="tab" data-toggle="tab"
               data-content="5" onclick="goPosition(this)">其　他</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active fade" id="guzhang">
                <v-services :services="{{ $services }}" :contract_id="{{ $id }}"></v-services>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="xunjian">
                <v-services></v-services>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="yingji">
                <v-services></v-services>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="yuancheng">
                <v-services></v-services>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="qita">
                <v-services></v-services>
            </div>
        </div>
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