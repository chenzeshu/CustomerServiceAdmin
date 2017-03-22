<template>
    <div class="contracts">
        <div class="newContract" @click="toggleNew">
            <i class="fa fa-btn fa-plus"></i>
        </div>
        <table class="table table-striped">
            <thead class="self-font-weight-700 text-center">
                <tr>
                    <td width="100">合同编号</td>
                    <td width="200">合同名称</td>
                    <td width="100">合同类型<i class="fa fa-btn fa-caret-square-o-down touch" @click="sortContractShow"></i>
                        <transition name="contractShow">
                            <div class="contract-flag" v-show="statusContractTypeFlag">
                                <span class="touch" @click="sortContract(0)">集</span>
                                <span class="touch" @click="sortContract(1)">服</span>
                                <span class="touch" @click="sortContract(2)">信</span>
                                <span class="touch" @click="sortContract(3)">综</span>
                                <span class="touch" @click="sortContract(4)">全</span>
                            </div>
                        </transition>
                    </td>
                    <td width="100">签订类型<i class="fa fa-btn fa-caret-square-o-down touch" @click="sortTypeShow"></i>
                        <transition name="contractShow">
                            <div class="contract-flag" v-show="statusTypeFlag">
                                <span class="touch" @click="sortType(0)">销</span>
                                <span class="touch" @click="sortType(1)">客</span>
                                <span class="touch" @click="sortType(2)">全</span>
                            </div>
                        </transition>
                   </td>
                    <td width="100">项目经理</td>
                    <td width="100">技术经理</td>
                    <td width="100">合同金额（元）</td>
                    <td>相关信息</td><!-- 具体签订日期，验收日期，质保日期，合同相关描述，主要外协单位-->
                    <td>是否验收<i class="fa fa-btn fa-caret-square-o-down touch" @click="sortCheckShow"></i>
                        <transition name="contractShow">
                            <div class="contract-flag" v-show="statusCheckFlag">
                                <span class="touch" @click="sortCheck(0)">已</span>
                                <span class="touch" @click="sortCheck(1)">未</span>
                                <span class="touch" @click="sortCheck(2)">全</span>
                            </div>
                        </transition>
                    </td>
                    <td>质保状态&nbsp;&nbsp;<i class="fa fa-btn fa-caret-square-o-down touch" @click="sortShow"></i>
                        <transition name="contractShow">
                            <div class="contract-flag" v-show="statusFlag">
                                <span class="touch" @click="sort(0)">在</span>
                                <span class="touch" @click="sort(1)">过</span>
                                <span class="touch" @click="sort(2)">全</span>
                            </div>
                        </transition></td>
                    <td colspan="2">操作</td>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr v-for="contract of contracts">
                    <td>{{contract.contract_id}}</td>
                    <td><a :href="'/contracts/'+ contract.id ">{{contract.name}}</a></td>
                    <td>
                        <span v-if="contract.contract_type==0">集成</span>
                        <span v-else-if="contract.contract_type==1">服务</span>
                        <span v-else-if="contract.contract_type==2">信道</span>
                        <span v-else-if="contract.contract_type==3">综合</span>
                    </td>
                    <td>
                        <span v-if="contract.type==0">销售</span>
                        <span v-if="contract.type==1">客服</span>
                    </td>
                    <td><span v-for="p in contract.pm">{{ p.name }}</span></td>
                    <td><span v-for="t in contract.tm">{{ t.name }}</span></td>
                    <td>{{contract.sum}}</td>
                    <!--相关信息-->
                    <td @click="showTime1(contract)">
                        <button class="btn btn-default btn-sm">相关信息</button>
                    </td>
                    <!--是否验收-->
                    <td>
                        <button class="btn btn-default btn-sm" v-if="contract.time3==0">未验收</button>
                        <button class="btn btn-success btn-sm" @click="showTime3(contract)" v-else>已验收</button>
                    </td>
                    <!--是否在保-->
                    <td @click="showTime2(contract)">
                        <button class="btn btn-danger btn-sm" v-if="contract.time2 < nowaday">过保</button>
                        <button class="btn btn-success btn-sm" v-else>在保</button>
                    </td>
                    <!--<td v-if="contract.active ==1">维保</td>-->
                    <td class="contract-item-edit">
                         <i class="fa fa-btn fa-cog" @click="toggleEdit(contract)"></i>
                         <i class="fa fa-btn fa-close" @click="deleteConfirmContract(contract)"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <!--新建-->
        <transition name="fade">
            <div class="new-wrapper" v-show="newFlag">
                <div class="modal-header">
                    <button type="button" class="close" @click="toggleNew"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">新建合同</h4>
                </div>
                <br>
                <form  @submit.prevent="addContract()"
                       class="form-horizontal width-80per-margin-auto">
                    <!--合同名称-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">合同名称</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" v-model="newContract.name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--项目经理-->
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">项目经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <addman :type="1" :men="newContract.pm"></addman>
                                    <!--<input type="text" class="form-control" v-model="newContract.pm">-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--技术经理-->
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">技术经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <addman :type="3" :men="newContract.tm"></addman>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--合同金额-->
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">合同金额</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" v-model="newContract.sum" placeholder="自动保留二位小数">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--合同类型radio-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">合同类型</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 form-inline">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="0" v-model="newContract.contract_type">
                                            集成
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="1" v-model="newContract.contract_type">
                                            服务
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="2" v-model="newContract.contract_type">
                                            信道
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="3" v-model="newContract.contract_type">
                                            综合
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--签订类型radio-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">签订类型</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 form-inline">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" value="0" v-model="newContract.type">
                                            销售签
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" value="1" v-model="newContract.type">
                                            客服签
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--合同签订日期-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">签订日期</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-date-picker
                                            v-model="newContract.time1" type="date" placeholder="签订日期"
                                            :format="datepicker.format"
                                            :size="datepicker.size" :editable="datepicker.editable">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--验收日期-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">验收日期</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-date-picker
                                            v-model="newContract.time3" type="date" placeholder="质保起始日期"
                                            :format="datepicker.format"
                                            :size="datepicker.size" :editable="datepicker.editable">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--质保结束日期-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">质保结束日期</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-date-picker
                                            v-model="newContract.time2" type="date" placeholder="质保结束日期"
                                            :format="datepicker.format"
                                            :size="datepicker.size" :editable="datepicker.editable">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--基本描述-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">基本描述</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-input type="textarea" v-model="newContract.desc"></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--主要外协单位-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">主要外协单位</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-input v-model="newContract.main_unit"></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="submit" class="btn btn-default">新建合同</button>
                        </div>
                    </div>
                </form>
            </div>
        </transition>
        <!--更新-->
        <transition name="fade">
            <div class="edit-wrapper" v-show="editFlag">
                <div class="modal-header">
                    <button type="button" class="close" @click="toggleEdit"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">编辑合同</h4>
                </div>
                <br>
                <form  @submit.prevent="updateContract(contract1)"
                        class="form-horizontal width-80per-margin-auto">
                    <!--合同名称-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">合同名称</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" v-model.lazy="contract1.name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--项目经理-->
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">项目经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <addman :type="1" :men="contract1.pm"></addman>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--技术经理-->
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">技术经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <addman :type="3" :men="contract1.tm"></addman>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--合同类型radio-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">签订类型</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 form-inline">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="0" v-model="contract1.contract_type">
                                            集成
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="1" v-model="contract1.contract_type">
                                            服务
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="2" v-model="contract1.contract_type">
                                            信道
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="contract_type" value="3" v-model="contract1.contract_type">
                                            综合
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--签订类型radio-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">签订类型</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 form-inline">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" value="0" v-model="contract1.type">
                                            销售签
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" value="1" v-model="contract1.type">
                                            客服签
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--合同金额-->
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">合同金额</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" v-model.lazy="contract1.sum" placeholder="自动保留二位小数">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--合同签订日期-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">签订日期</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-date-picker
                                            v-model="contract1.time1" type="date" placeholder="签订日期"
                                            :format="datepicker.format"
                                            :size="datepicker.size" :editable="datepicker.editable">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--验收日期-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">验收日期</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-date-picker
                                            v-model="contract1.time3" type="date" placeholder="质保起始日期"
                                            :format="datepicker.format"
                                            :size="datepicker.size" :editable="datepicker.editable">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--质保结束日期-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">质保结束日期</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-date-picker
                                            v-model="contract1.time2" type="date" placeholder="质保结束日期"
                                            :format="datepicker.format"
                                            :size="datepicker.size" :editable="datepicker.editable">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--基本描述-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">基本描述</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-input type="textarea" v-model="contract1.desc"></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--主要外协单位-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">主要外协单位</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10">
                                    <el-input v-model="contract1.main_unit"></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <button type="submit" class="btn btn-default">提交修改</button>
                        </div>
                    </div>
                </form>
            </div>
        </transition>
    </div>
</template>

<style lang="stylus" rel="stylesheet/stylus">
    .contract-item-edit
        .fa-btn
            cursor pointer
            margin-right 5px
.gift
    padding-top 24px
    font-size:18px
    font-weight:700


.contracts
    position relative
    .newContract
        position absolute
        top 0
        left 0
        width 30px
        height 30px
        .fa-btn
            cursor pointer
            margin-right 5px
    .fade-enter-active
        transition all .3s ease-in
    .fade-leave-active
        transition all .3s ease-in
        transform:translate(500px)
    .fade-enter
        transform scale3d(0.2,0.2,0.2) translateX(-500px)
        opacity 0
    .fade-leave-to
        opacity 0
    .new-wrapper
        position: fixed;
        top: 100px;
        left: 30vw;
        height: 500px;
        width: 35vw;
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(248,248,255,1);
        border-radius: 2%;
        overflow scroll
        @media screen and (max-width: 1127px)
            height 700px
    .edit-wrapper
        position: fixed;
        top: 100px;
        left: 30vw;
        height: 550px;
        width: 35vw;
        overflow scroll
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(248,248,255,1);
        border-radius: 2%;
        @media screen and (max-width: 1127px)
            height 550px
</style>

<script type="text/ecmascript">
    import Bus from '../utils/eventBus'
    import addman from './addman.vue'
    import * as base from '../utils/base'
    import { unixToDate } from '../utils/date'
    var cc = console.log;
    export default {
        data(){
            return {
                editFlag: false,
                newFlag: false,
                newContract:{
                    name:null,
                    pm:[],
                    tm:[],
                    sum:null,
                    type:1,  //默认选择客服
//                    active:null, //默认选择在保 --》2017.3.15 变成0：非维保，1：维保
                    time1:null,
                    time2:null,
                    time3:null,
                    desc:'',
                    main_unit:'',
                    contract_type:null,
                },
                contract1:{},
                datepicker:{
                    size:"small",
                    editable:false,
                    format:"yyyy-MM-dd"
                },
                nowaday:null,
                statusFlag:false,
                statusTypeFlag:false,
                statusContractTypeFlag:false,
                statusCheckFlag:false,
                status:2, //0:显示在保，1：显示过保, 2:全部
                status_type:2, //签订类型  0：销售， 1：客服，  2：全部
                status_contract_type:4,  //合同类型  0：集成、1：服务、2：信道、3：综合、4：全部
                status_check:2,  //验收类型  0：已验收、1：未验收、2：全部
            }
        },
        props:{
            parentId:{
                type:Number
            },
            freshContracts:{
              type:Array
            }
        },
        computed:{
            type(){
              if (this.freshContracts){
                  return freshContracts.type
              }
            },
            contracts(){
                //这串意大利面条还能S.O.L.I.D???
                var _freshContracts
                var _nowaday = this.nowaday
                if (this.freshContracts){
                    _freshContracts =  this.freshContracts
                    _freshContracts.time1Show = null
                    _freshContracts.time2Show = null
                    _freshContracts.time3Show = null
                }
                //在保状态
                if (this.status==0){
                    _freshContracts = _freshContracts.filter(contract=>{
                        return contract.time2 >= _nowaday
                    })
                }else if(this.status==1){
                    _freshContracts = _freshContracts.filter(contract=>{
                        return contract.time2 < _nowaday
                    })
                }else{
                    //签订类型
                    if (this.status_type !=2){
                        _freshContracts = _freshContracts.filter(contract =>{
                            return contract.type == this.status_type
                        })
                    }else{
                        //合同类型
                        if (this.status_contract_type != 4){
                            _freshContracts = _freshContracts.filter(contract =>{
                                return contract.contract_type == this.status_contract_type
                            })
                        }else{
                            //验收状态
                            if (this.status_check==0){
                                _freshContracts = _freshContracts.filter(contract=>{
                                    return contract.time3 != 0
                                })
                            }else if(this.status_check==1){
                                _freshContracts = _freshContracts.filter(contract=>{
                                    return contract.time3 == 0
                                })
                            }else{
                                _freshContracts = this.freshContracts
                            }
                        }
                    }
                }
                for(let contract of _freshContracts){
                    contract.time1Show = unixToDate(contract.time1,"yy-MM-dd hh:mm")
                    contract.time2Show = unixToDate(contract.time2,"yy-MM-dd hh:mm")
                    contract.time3Show = unixToDate(contract.time3,"yy-MM-dd hh:mm")
                }
                return _freshContracts
            },
        },
        methods:{
            //签订日期、基本描述、主要外协单位
            showTime1(contract){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim2', //加上边框
                    area: ['720px'], //宽高
                    content: `<table class="table table-striped table-hover">
<tr><td width="200">合同签订日期</td><td>${contract.time1Show}</td></tr>
<tr><td>基本描述</td><td>${contract.desc}</td></tr>
<tr><td>主要外协单位</td><td>${contract.main_unit}</td></tr>
</table>`
                })
            },
            //质保截止日期
            showTime2(contract){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim2', //加上边框
                    area: ['360px', '160px'], //宽高
                    content: `<div class="gift text-center">质保结束日期：${contract.time2Show}</div>`
                })
            },
            //验收日期
            showTime3(contract){
                layer.open({
                    type: 1,
                    skin: 'layui-layer-rim2', //加上边框
                    area: ['360px', '160px'], //宽高
                    content: `<div class="gift text-center">验收日期：${contract.time3Show}</div>`
                })
            },
            resetSort(){
                this.status_type = 2
                this.status_contract_type = 4
                this.status_check = 2
                this.status = 2
            },
            resetFlag(){
                this.statusFlag = false
                this.statusTypeFlag = false
                this.statusContractTypeFlag = false
                this.statusCheckFlag = false
            },
            //签订SHOW
            sortTypeShow(){
               this.statusTypeFlag = !this.statusTypeFlag
            },
            //合同类型SHOW
            sortContractShow(){
                this.statusContractTypeFlag = !this.statusContractTypeFlag
            },
            //验收类型SHOW
            sortCheckShow(){
                this.statusCheckFlag = !this.statusCheckFlag
            },
            //在保类型SHOW
            sortShow(){
                this.statusFlag = !this.statusFlag
            },
            //签订类型
            sortType(num){
                this.resetSort()
                this.status_type = num
                this.resetFlag()
            },
            //合同类型
            sortContract(num){
                this.resetSort()
                this.status_contract_type = num
                this.resetFlag()
            },
            //验收类型
            sortCheck(num){
                this.resetSort()
                this.status_check = num
                this.resetFlag()
            },
            //在保类型
            sort(num){
                this.resetSort()
                this.status = num
                this.resetFlag()
            },
            toggleEdit(contract){
              this.editFlag = !this.editFlag
              if (this.editFlag){
                  this.contract1 = Object.assign({},contract)
                  let _contract1 = this.contract1
                  _contract1.time1 = unixToDate(_contract1.time1, "yyyy-MM-dd")
                  _contract1.time2 = unixToDate(_contract1.time2, "yyyy-MM-dd")
                  _contract1.time3 = unixToDate(_contract1.time3, "yyyy-MM-dd")
              }
          },
            toggleNew(){
              this.newFlag = !this.newFlag
            },
            addContract(){
                let token = document.querySelector('meta[name=csrf-token]').getAttribute('content')
                let info = {
                    parentId: this.parentId,
                    type:this.newContract.type,
                    name : this.newContract.name,
                    pm :this.newContract.pm,
                    tm : this.newContract.tm,
                    sum : this.newContract.sum,
                    time1: this.newContract.time1,
                    time2: this.newContract.time2,
                    time3: this.newContract.time3,
                    main_unit : this.newContract.main_unit,
                    desc:this.newContract.desc,
                    contract_type:this.newContract.contract_type
//                    _token:token
                }
//                $.post('/contracts', info, function (data) {
//                    cc(data)
//                })
                axios.post('/contracts', info).then((res)=>{
                    //todo 如果时间充足，就在外层做一个总的组件，然后用vuex解决数据更新问题
                    layer.msg("新建成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                    this.newFlag = false
            },error=>{
                    error.status
                    layer.msg("新建失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
            },
            updateContract(contract1){
              let data = {
                  name : contract1.name,
                  pm : contract1.pm,
                  tm : contract1.tm,
                  sum : contract1.sum,
                  time1: contract1.time1,
                  time2: contract1.time2,
                  time3: contract1.time3,
                  main_unit : contract1.main_unit,
                  desc:contract1.desc,
                  contract_type:contract1.contract_type,
                  type:contract1.type
              }
              axios.patch('/contracts/'+contract1.id, data).then((res)=>{
                  layer.msg("更新成功", {icon: 6});
                setTimeout(function(){
                    location.href = location.href;
                },900)
                this.editFlag = false
            },error=>{
                    error.status
                    layer.msg("更新失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
          },
            deleteConfirmContract(contract){
                layer.confirm('确定要删除这条合同？', {
                    btn: ['确定','取消'] //按钮
                }, ()=>{
                    this.deleteContract(contract)
                });
            },
            deleteContract(contract){
                axios.delete('/contracts/'+contract.id).then((res)=>{
                    layer.msg("删除成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)

                }, (error)=>{
                    error.status
                    layer.msg("删除失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
            },
            open() {
                this.$alert('这是一段内容', '标题名称', {
                    confirmButtonText: '确定',
                    callback: action => {
                        this.$message({
                            type: 'info',
                            message: `action: ${ action }`
                        });
                    }
                });
            }
        },
        mounted() {
            this.nowaday = Date.parse(new Date())/1000;
        },
        created(){
            //不设新事件了，直接用已有事件，  serviser对应pm,  visitor对应tm
//            2017.3.14补充：serviser type为1，visitor为3，这个同时也要写正确。
            Bus.$on('addserviser', data=>{
                if (this.newFlag){
                    this.newContract.pm = data
                }else if (this.editFlag){
                    this.contract1.serviser = data
                }
            })
            //借用visitor作为合同模块的tm了
            Bus.$on('addvisitor', data=>{
                if (this.newFlag){
                    this.newContract.tm = data
                }else if (this.editFlag){
                    this.contract1.tm = data
                }
            })
        },
        components:{
            addman
        }
    }
</script>
