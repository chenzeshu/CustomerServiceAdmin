@extends('layouts.app')

@section('content')
    <div class="container tasks-styl">


        <div>
            <!-- Nav tabs -->
            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                <li role="presentation">
                    <a href="#contracttab" aria-controls="settings" role="tab" data-toggle="tab" data-content="1"
                       onclick="goPosition(this)">合同</a>
                </li>
                <li role="presentation">
                    <a href="#cus2" aria-controls="settings" role="tab" data-toggle="tab" data-content="2"
                       onclick="goPosition(this)">客户联系人</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane" id="contracttab">
                    <v-contracts :fresh-contracts="{{$contracts}}" :parent-id="{{ $id }}"></v-contracts>
                </div>
                {{--客户联系人--}}
                <div role="tabpanel" class="tab-pane" id="cus2">
                    <v-customer2 :cus2s="{{ $cus2s }}"></v-customer2>
                </div>
            </div>
        </div>

        </div>
    </div>

@endsection

@section('customJS')
    <script>
        //不放jq初始化里，因为太慢了。
        //默认选择客服在保（4）
        var oPosition = loadFromLocal('position',1)
        $('a[role="tab"][data-content='+ oPosition +']').click()


        //tab栏位置存档
        function goPosition(e) {
            var position = $(e).data('content')
            saveToLocal('position', position)
        }

    </script>
@endsection