@extends('layouts.app')

@section('content')
    <div class="container tasks-styl">

        <div>
            <!-- Nav tabs -->
            <ul id="myTabs" class="nav nav-tabs" role="tablist">
                <li role="presentation" class="dropdown">
                    <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">客服合同 <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                        <li><a href="#dropdown4" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1" data-content="4"
                               onclick="goPosition(this)">在保</a></li>
                        <li><a href="#dropdown5" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2" data-content="5"
                               onclick="goPosition(this)">过保</a></li>
                        <li><a href="#dropdown6" role="tab" id="dropdown3-tab" data-toggle="tab" aria-controls="dropdown3" data-content="6"
                               onclick="goPosition(this)">维保</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="#" id="myTabDrop2" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">销售合同 <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="myTabDrop1" id="myTabDrop2-contents">
                        <li><a href="#dropdown1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1" data-content="1"
                               onclick="goPosition(this)">在保</a></li>
                        <li><a href="#dropdown2" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2" data-content="2"
                               onclick="goPosition(this)">过保</a></li>
                        <li><a href="#dropdown3" role="tab" id="dropdown3-tab" data-toggle="tab" aria-controls="dropdown2" data-content="3"
                               onclick="goPosition(this)">维保</a></li>
                    </ul>
                </li>

            </ul>
            {{--销售 对应id dropdown1 2 3  客服对应id dropdown4 5 6--}}
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
                    <v-contracts :fresh-contracts="{{$contracts}}" :type="0" :active="0" :parent-id="{{ $id }}"></v-contracts>
                </div>
                <div role="tabpane1" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown1-tab">
                    <v-contracts :fresh-contracts="{{$contracts}}" :type="0" :active="1" :parent-id="{{ $id }}"></v-contracts>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="dropdown3" aria-labelledby="dropdown1-tab">
                    <v-contracts :fresh-contracts="{{$contracts}}" :type="0" :active="2" :parent-id="{{ $id }}"></v-contracts>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="dropdown4" aria-labelledby="dropdown1-tab" data-content="1">
                    <v-contracts :fresh-contracts="{{$contracts}}" :type="1" :active="0" :parent-id="{{ $id }}"></v-contracts>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="dropdown5" aria-labelledby="dropdown1-tab" data-content="2">
                    <v-contracts :fresh-contracts="{{$contracts}}" :type="1" :active="1" :parent-id="{{ $id }}"></v-contracts>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="dropdown6" aria-labelledby="dropdown1-tab" data-content="3">
                    <v-contracts :fresh-contracts="{{$contracts}}" :type="1" :active="2" :parent-id="{{ $id }}"></v-contracts>
                </div>
            </div>
        </div><!-- /example -->

        </div>
    </div>

@endsection

@section('customJS')
    <script>
        //不放jq初始化里，因为太慢了。
        //默认选择客服在保（4）
        var oPosition = loadFromLocal('position',4)
        $('a[role="tab"][data-content='+ oPosition +']').click()


        //tab栏位置存档
        function goPosition(e) {
            var position = $(e).data('content')
            saveToLocal('position', position)
        }

    </script>
@endsection