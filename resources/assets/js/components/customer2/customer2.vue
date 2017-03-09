<template>
    <div class="customer2">
        <div class="newService" @click="toggleNew">
            <i class="fa fa-btn fa-plus"></i>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>联系人ID</th>
                    <th>客户联系人姓名</th>
                    <th>联系方式</th>
                    <th>所属客户单位</th>
                    <th colspan="2">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="cus2 in cus2s">
                    <td>{{ cus2.id }}</td>
                    <td>{{ cus2.name }}</td>
                    <td>{{ cus2.phone }}</td>
                    <td>{{ cus2.customer_name }}</td>
                    <td class="service-item-edit">
                        <i class="fa fa-btn fa-cog" @click="toggleEdit(cus2)"></i>
                        <i class="fa fa-btn fa-close" @click="deleteConfirm(cus2.id)"></i>
                    </td>
                </tr>
            </tbody>
        </table>

        <transition name="fade">
            <div class="new-wrapper" v-show="newFlag">
                <div class="modal-header">
                    <button type="button" class="close" @click="toggleNew"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">新建联系人</h4>
                </div>
                <br>
                <form class="form-horizontal width-100per-margin-auto">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">联系人姓名</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 ">
                                    <input type="text" class="form-control" v-model="newCus2.name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">联系方式</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 ">
                                    <input type="text" class="form-control" v-model="newCus2.phone">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">单位名称</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 ">
                                   <addcompany></addcompany>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <div class="btn btn-default" @click="addCus2(newCus2)">提交</div>
                        </div>
                    </div>

                </form>
            </div>
        </transition>
        <transition name="fade">
            <div class="new-wrapper" v-show="editFlag">
                <div class="modal-header">
                    <button type="button" class="close" @click="toggleEdit"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">编辑联系人</h4>
                </div>
                <br>
                <form class="form-horizontal width-100per-margin-auto">

                    <!--修改时要传个id，因为其他都可以改-->
                    <input type="hidden" v-model="editCus22.id">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">联系人姓名</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 ">
                                    <input type="text" class="form-control" v-model="editCus22.name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">联系方式</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 ">
                                    <input type="text" class="form-control" v-model="editCus22.phone">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">单位名称</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 ">
                                    <addcompany :customer_name="editCus22.customer_name"></addcompany>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <div class="btn btn-default" @click="editCus2(editCus22)">提交</div>
                        </div>
                    </div>

                </form>
            </div>
        </transition>
    </div>
</template>

<style lang="stylus" rel="stylesheet/stylus">
    .customer2
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
            top: 150px;
            left: 30vw;
            height: 350px;
            width: 30vw;
            background: rgba(255,255,255,0.9);
            border: 1px solid rgba(248,248,255,1);
            border-radius: 2%;

</style>

<script type="text/ecmascript">
    import addcompany from './addcompany.vue'
    import Bus from '../../utils/eventBus'
    var cc = console.log;
    export default {
        data(){
            return {
                newCus2:{
                    customer:null
                },
                editCus22:{},
                newFlag:false,
                editFlag:false,
            }
        },
        props:{
            cus2s: { //该客户下的所有联系人的数组
                type: Array
            },
        },
        methods:{
            addCus2(cus2){
                axios.post("/customer2s", cus2).then(res=>{
                    layer.msg("新增成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                    this.newFlag = false
                },error=>{
                    layer.msg("新增失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
            },
            editCus2(cus22){
                let id = cus22.id
                axios.patch("/customer2s/"+id, cus22).then(res=>{
                    layer.msg("修改成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                    this.newFlag = false
                },error=>{
                    layer.msg("修改失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
            },
            deleteConfirm(id){
                layer.confirm('确定要删除这条合同？', {
                    btn: ['确定','取消'] //按钮
                }, ()=>{
                    this.deleteCus2(id)
                });
            },
            deleteCus2(id){
                axios.delete("/customer2s/"+id).then(res=>{
                    layer.msg("删除成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                    this.newFlag = false
                },error=>{
                    layer.msg("删除失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
            },
            toggleNew(){
                this.newFlag = ! this.newFlag

            },
            toggleEdit(cus2){
                this.editFlag = !this.editFlag
//注意：因为cus的数据结构，是没有customer子对象的，其在第一层有一个customer_name的字段，作为单位名。
                if (this.editFlag){
                    this.editCus22 = Object.assign({}, this.editCus22, cus2)
                    this.editCus22.customer = {id:9999, name:cus2.customer_name}  //id其实没有产生作用，后台把主键改成名称了
                }
            }
        },
        mounted() {

        },
        created(){
            Bus.$on('addcompany', data=>{
                if (this.newFlag){
                    this.newCus2.customer = data
                }else if (this.editFlag){
                    this.editCus22.customer = data
                }
            })

            Bus.$on('rmcompany', ()=>{
                if (this.newFlag){
                    this.newCus2.customer = null
                }else if (this.editFlag){
                    this.editCus22.customer = null
                }
            })
        },
        components:{
            addcompany
        }
    }
</script>
