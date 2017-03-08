<template>
    <div class="contracts">
        <div class="newContract" @click="toggleNew">
            <i class="fa fa-btn fa-plus"></i>
        </div>
        <table class="table table-striped">
            <thead class="self-font-weight-700 text-center">
                <tr>
                    <td width="100"><span v-if="type===0">销售</span><span v-else>客服</span>合同编号</td>
                    <td width="300">合同名称</td>
                    <td width="100">项目经理</td>
                    <td width="100">技术经理</td>
                    <td width="200">合同金额（元）</td>
                    <td>状态</td>
                    <td colspan="2">操作</td>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr v-for="contract of contracts">
                    <td>{{contract.contract_id}}</td>
                    <td><a :href="'/contracts/'+ contract.id ">{{contract.name}}</a></td>
                    <td>{{contract.pm}}</td>
                    <td>{{contract.tm}}</td>
                    <td>{{contract.sum}}</td>
                    <td v-if="contract.active === 0">在保</td>
                    <td v-if="contract.active === 1">过保</td>
                    <td v-if="contract.active === 2">维保</td>
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label">合同编号</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" v-model="newContract.contract_id">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">项目经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" v-model="newContract.pm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">技术经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" v-model="newContract.tm">
                                </div>
                            </div>
                        </div>
                    </div>
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
                        <label class="col-sm-3 control-label">合同状态</label>
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
                    <!--状态radio-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">合同状态</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 form-inline">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="bao" value="0" v-model="newContract.active">
                                            在保
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="bao" value="1" v-model="newContract.active">
                                            过保
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="bao"  value="2" v-model="newContract.active">
                                            维保
                                        </label>
                                    </div>
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
                    <div class="form-group">
                        <label class="col-sm-3 control-label">合同编号</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="text" class="form-control" v-model.lazy="contract1.contractId">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">项目经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" v-model.lazy="contract1.pm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-3 control-label">技术经理</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" v-model.lazy="contract1.tm">
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <!--radio-->
                    <div class="form-group">
                        <label class="col-sm-3 control-label">合同状态</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 form-inline">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="bao" value="0" v-model.lazy="contract1.active" lazy>
                                            在保
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="bao" value="1" v-model.lazy="contract1.active" lazy>
                                            过保
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="bao" value="2" v-model.lazy="contract1.active" lazy>
                                            维保
                                        </label>
                                    </div>
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
        @media screen and (max-width: 1127px)
            height 600px
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


</style>

<script type="text/ecmascript">
    var cc = console.log;
    export default {
        data(){
            return {
                editFlag: false,
                newFlag: false,
                newContract:{
                    contract_id:null,
                    name:null,
                    pm:null,
                    tm:null,
                    sum:null,
                    type:1,  //默认选择客服
                    active:0, //默认选择在保
                },
                contract1:{}
            }
        },
        props:{
            parentId:{
                type:Number
            },
            type:{
               type:Number
            }, //销售还是客服
            active:{
                type:Number
            }, //过保状态
          freshContracts:{
              type:Array
          }
        },
        computed:{
            contracts(){
                return this.freshContracts.filter((freshContract)=>{
                    return freshContract.active === this.active && freshContract.type === this.type  //箭头函数的this绑定的是设定时的上下文，也就是vue，所以不会报错
                })
            }
        },
        methods:{
          toggleEdit(contract){
              this.editFlag = !this.editFlag
              this.contract1 = Object.assign({},this.contract1, contract)
          },
            toggleNew(){
              this.newFlag = !this.newFlag
            },
            addContract(){
                let data = {
                    parentId: this.parentId,
                    contractId: this.newContract.contract_id,
                    type:this.newContract.type,
                    name : this.newContract.name,
                    pm :this.newContract.pm,
                    tm : this.newContract.tm,
                    active : this.newContract.active,
                    sum : this.newContract.sum,
                }
                axios.post('/contracts/', data).then((res)=>{
                    this.newFlag = false
                    location.href = location.href  //todo 如果时间充足，就在外层做一个总的组件，然后用vuex解决数据更新问题
                }, (error)=>{
                    error.status
                })
            },
            updateContract(contract1){
              let data = {
                  contractId: contract1.contract_id,
                  name : contract1.name,
                  pm : contract1.pm,
                  tm : contract1.tm,
                  active : contract1.active,
                  sum : contract1.sum,
              }
              console.log(data)
              axios.patch('/contracts/'+contract1.id, data).then((res)=>{
                    this.editFlag = false
                    location.href = location.href  //todo 如果时间充足，就在外层做一个总的组件，然后用vuex解决数据更新问题。当然，对服务器的压力还是没有变。
              }, (error)=>{
                  error.status
              })
          },
            deleteConfirmContract(contract){
//                var _this = this
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
        }
    }
</script>
