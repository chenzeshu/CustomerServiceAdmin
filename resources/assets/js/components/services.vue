<template>
    <div class="services">
        <div class="newService" @click="toggleNew">
            <i class="fa fa-btn fa-plus"></i>
        </div>
        <table class="table table-striped table-hover">
            <thead class="self-font-weight-700 text-center">
            <tr>
                <th width="100">内部受理编号</th>
                <th width="150">信息来源</th>
                <th width="100">问题描述</th>
                <th width="100">服务人员</th>
                <th width="100">收费情况</th>
                <th>用户评价</th>
                <th>处理状态<i class="fa fa-btn fa-caret-square-o-down"></i></th>
                <th width="100">回访情况</th>
                <th colspan="2">操作</th>
            </tr>
            </thead>
            <tbody class="text-center">
                <tr v-for="service in services">
                    <td>{{ service.s_id }}</td>
                    <td>{{ service.source }}</td>
                    <td><div @click="descQuestion(service.desc1)"
                            class="btn btn-default btn-sm">问题描述</div></td>
                    <td>{{ service.serviser }}</td>
                    <td>
                        <span v-if="service.charge_if === 0">不收费</span>
                        <span v-else>收费</span>
                    </td>
                    <!--服务评价-->
                    <td>
                        <div v-if="service.rating===0" class="btn btn-success btn-sm" @click="customer(service)">非常满意</div>
                        <div v-if="service.rating===1" class="btn btn-primary btn-sm" @click="customer(service)">满意</div>
                        <div v-if="service.rating===2" class="btn btn-warning btn-sm" @click="customer(service)">一般</div>
                        <div v-if="service.rating===3" class="btn btn-danger btn-sm" @click="customer(service)">不满意</div>
                        <div v-if="service.rating===4" class="btn btn-default btn-sm" @click="customer(service)">未评价</div>
                    </td>
                    <!--是否解决-->
                    <td>
                        <div v-if="service.result_deal===0" class="btn btn-warning btn-sm" @click="descSolve(service)">待解决</div>
                        <div v-if="service.result_deal===1" class="btn btn-success btn-sm" @click="descSolve(service)">{{service.time1}}</div>
                        <div v-if="service.result_deal===2" class="btn btn-danger btn-sm" @click="descSolve(service)">未解决</div>
                    </td>
                    <!--回访-->
                    <td>
                        <div v-if="service.result_visit===0" class="btn btn-success btn-sm" @click="visit(service)">非常满意</div>
                        <div v-if="service.result_visit===1" class="btn btn-primary btn-sm" @click="visit(service)">满意</div>
                        <div v-if="service.result_visit===2" class="btn btn-warning btn-sm" @click="visit(service)">一般</div>
                        <div v-if="service.result_visit===3" class="btn btn-danger btn-sm" @click="visit(service)">不满意</div>
                        <div v-if="service.result_visit===4" class="btn btn-default btn-sm">未回访</div>
                    </td>
                    <td class="service-item-edit">
                        <i class="fa fa-btn fa-cog"></i>
                        <i class="fa fa-btn fa-close"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <transition name="fade">
            <div class="new-wrapper" v-show="newFlag">
                <div class="modal-header">
                    <button type="button" class="close" @click="toggleNew"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">新建服务</h4>
                </div>
                <br>

                <form class="form-horizontal width-100per-margin-auto">
                    <div class="info-container">
                        <!--信息来源-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">信息来源</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <select v-model="newService.source" class="form-control">
                                            <option v-for="source in basic.sources" :value="source.value">{{ source.text }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--服务类型-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">服务类型</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <select class="form-control" v-model="newService.type">
                                            <option v-for="type in basic.types" :value="type.value">{{ type.text }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--受理时间-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">受理时间</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <el-date-picker
                                                v-model="newService.time1" type="date" placeholder="选择受理日期"
                                                :format="datepicker.format"
                                                :size="datepicker.size" :editable="datepicker.editable">
                                        </el-date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--问题描述-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">问题描述</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <textarea v-model="newService.desc1" class="form-control" cols="60" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--服务人员--组件传值>-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">服务人员</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <addman :type="1"></addman>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--是否收费radio-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">是否收费</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10 form-inline">
                                        <div class="radio" v-for="charge in basic.charge_if">
                                            <label>
                                                <input type="radio" name="type" :value="charge.value" v-model="newService.charge_if">
                                                {{ charge.text }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--客户联系人，目前一级，后面有空做成二级：点击显示客户列表-》选择客户-》出现该客户下的联系人-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">客户联系人</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <addman :type="2"></addman>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--完工时间-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">完工时间</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <el-date-picker
                                                v-model="newService.time2" type="date" placeholder="选择完工日期"
                                                :format="datepicker.format"
                                                :size="datepicker.size" :editable="datepicker.editable">
                                        </el-date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--处理描述-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">处理描述</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <textarea v-model="newService.desc2" class="form-control" cols="60" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--处理结果radio-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">处理结果</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10 form-inline">
                                        <div class="radio" v-for="result in basic.result_deal">
                                            <label>
                                                <input type="radio" name="bao" :value="result.value" v-model="newService.result_deal">
                                                {{ result.text }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--备注派生-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">备注派生</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <textarea v-model="newService.remark" class="form-control" cols="60" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--客户评价radio-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">客户评价</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10 form-inline">
                                        <div class="radio" v-for="rating in basic.ratings">
                                            <label>
                                                <input type="radio" name="rating" v-model="newService.rating" :value="rating.value">
                                                {{ rating.text }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--回访人员--组件传值>-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">回访人员</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <addman :type="3"></addman>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--回访时间-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">回访时间</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <el-date-picker
                                                v-model="newService.time3" type="date" placeholder="选择回访日期"
                                                :format="datepicker.format"
                                        :size="datepicker.size" :editable="datepicker.editable">
                                        </el-date-picker>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--占用工时-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">回访时间（单位0.5天）</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input class="form-control" placeholder="请填写整数" v-model.number="newService.time4">
                                    </div>
                                    <div class="col-xs-4">
                                        <span class="time4">× 0.5天</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--上传文件-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">上传文件（暂时不做）</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <input type="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <div class="btn btn-default" @click="addService(newService)">新建服务单</div>
                        </div>
                    </div>
                </form>
            </div>
        </transition>
    </div>
</template>

<style lang="stylus" rel="stylesheet/stylus">
    .service-item-edit
        .fa-btn
            cursor pointer
            margin-right 5px

.modal-header
    padding: 5px 15px;

.services
    position relative
    .newService
        position absolute
        top 0
        left 0
        width 30px
        height 30px
        .fa-btn
            cursor pointer
            margin-right 5px
    .table
        .fa-caret-square-o-down
            margin-left 8px
            color #3097D1
    .fade-enter-active
        transition all .3s ease-in
    .fade-leave-active
        transition all .3s ease-in
        transform:translate(500px)
    .fade-enter
        transform translateX(-500px)
        opacity 0
    .fade-leave-to
        opacity 0
    .new-wrapper
        position: fixed;
        top: 100px;
        left: 30vw;
        height: 550px;
        width: 40vw;
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(248,248,255,1);
        border-radius: 2%;
        .info-container
            height: 400px;
            overflow: scroll
            margin-bottom: 20px;
            /*定义滚动条宽高及背景，宽高分别对应横竖滚动条的尺寸*/
            &::-webkit-scrollbar
                width: 6px;
                height: 0;
                background-color: #fff;
                @media screen and (max-width:1127px)
                    height 6px
            /*定义滚动条的轨道，内阴影及圆角*/
            &::-webkit-scrollbar-track
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                border-radius: 2%;
                background-color: #fff;
                z-index 50
            /*定义滑块，内阴影及圆角*/
            &::-webkit-scrollbar-thumb
                height: 20px;
                border-radius: 2%;
                -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                background-color: #DBDBDB;
                z-index 50
            .time4
                font-size 19px
                font-weight 700
    .edit-wrapper
        position: fixed;
        top: 100px;
        left: 30vw;
        height: 450px;
        width: 35vw;
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(248,248,255,1);
        border-radius: 2%;
        @media screen and (max-width: 1127px)
            height 550px
.layui-layer-rim2
    border:2px solid rgba(117,117,109,.3)
</style>

<script type="text/ecmascript">
    import Bus from '../utils/eventBus'
    import addman from './addman.vue'
    var cc = console.log;
    export default {
        data(){
            return {
                newFlag:true,
                editFlag:true,
                datepicker:{
                  size:"small",
                  editable:false,
                  format:"yyyy-MM-dd"
                },
                basic:{
                    sourcesSelected:0,
                    sources:[
                        {text:"400电话", value:0},
                        {text:"工程中心", value:1},
                        {text:"销售中心", value:2},
                        {text:"营运中心", value:3},
                    ],
                    typesSelected:0,
                    types:[
                        {text:"故障处理", value:0},
                        {text:"应急保障", value:1},
                        {text:"远程协助", value:2},
                        {text:"巡检", value:3},
                        {text:"其他", value:4},
                    ],
                    charge_if:[
                        {text:"未收费", value :0},
                        {text:"已收费", value :1},
                    ],
                    result_deal:[
                        {text:"待解决", value :0},
                        {text:"已解决", value :1},
                        {text:"未解决", value :2},
                    ],
                    ratings:[
                        {text:"非常满意", value :0},
                        {text:"满意", value :1},
                        {text:"一般", value :2},
                        {text:"不满意", value :3},
                        {text:"尚未评价", value :4},
                    ],
                    desc1:null,
                },
                newService:{
                    source:0,  //默认400电话
                    type:0,    //默认故障处理
                    desc1:null,
                    serviser:[
                        {user_id:1, name:"张小龙"}
                    ],
                    charge_if:0, //默认不收费
                    contract_id:this.contract_id,//母合同编号,
                    customer2:[
                        {cus2_id:1, cus2:"土豪"}  //一般就一个，以防万一
                    ],
                    time1:null,
                    desc2:null,
                    result_deal:0, //默认待解决
                    remark:null,
                    rating:4, //默认未评价
                    vistor:[
                        {id:1, name:"土豪"}  //用于测试
                    ],
                    time2:null,
                    result_visit:4, //默认未回访
                    time3:null,  //默认3*0.5 = 1.5天
                    files:[
                        {name:"任务单纸质文件", file_name:null }
                    ]
                },
                editService:{}
            }
        },
        props:{
          services:{
              type:Array
          },
          contract_id:{
              type:Number
          }
        },
        methods:{
          descQuestion(desc){
              layer.open({
                  type: 1,
                  skin: 'layui-layer-rim2', //加上边框
                  area: ['420px', '240px'], //宽高
                  content: `
                <div class="desc1-style">
                    <p>${desc}</p>
                </div>
`
              });
          },
            descSolve(desc){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim2', //加上边框
                    area: ['720px', '360px'], //宽高
                    content: `
                <table class="table table-striped">
                <thead>
                    <tr>
                        <td width="120">处理时间</td>
                        <td>处理描述</td>
                        <td>备注（派生）</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>${desc.time1}</td>
                        <td>${desc.desc2}</td>
                        <td>${desc.remark}</td>
                    </tr>
                </tbody>
</table>
`
                });
            },
            customer(service){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim2', //加上边框
                    area: ['380px', '180px'], //宽高
                    content: `
                <table class="table table-striped text-center">
                <tr>
                    <td>客户联系人id</td>
                    <td>客户联系人</td>
                </tr>
                <tr>
                    <td>${service.customer2_id}</td>
                    <td>${service.customer2}</td>
</tr>
</table>
`
                })
            },
            visit(service){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim2', //加上边框
                    area: ['380px', '180px'], //宽高
                    content: `
                <table class="table table-striped text-center">
                <tr>

                    <td>回访人</td>
                    <td>回访日期</td>
                </tr>
                <tr>
                    <td>${service.vistor}</td>
                    <td>${service.time2}</td>
</tr>
</table>
`
                })
            },
            toggleNew(){
                this.newFlag = ! this.newFlag
            },
            addService(service){
                axios.post('/services', service).then((res)=>{
                    res = res.data
                    console.log(res)
                },(error)=>{
                    error.status
                })
            },
            updateService(){

            },
        },
        mounted() {
        },
        created(){
            //由于再外层用的blade填充5个v-services组件，所以事件被监听了5次
            //可想而知，当还要扩展已解决和未解决时，会有10次。
            //目前先传v-service type + result_deal解决，后期全部vue化
            Bus.$on('addserviser', data=>{
                this.newService.serviser = data
            })
            Bus.$on('addcus', data=>{
                this.newService.serviser = data
            })
            Bus.$on('addvisitor', data=>{
                this.newService.serviser = data
            })
            Bus.$on('rmserviser', data=>{
                this.newService.serviser = data
            })
            Bus.$on('rmcus', data=>{
                this.newService.serviser = data
            })
            Bus.$on('rmvisitor', data=>{
                this.newService.serviser = data
            })
        },
        components:{
            addman
        }
    }
</script>
