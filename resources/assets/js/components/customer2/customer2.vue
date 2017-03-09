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
                        <td>

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
                        <label class="col-sm-3 control-label">联系人姓名</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <input type="text" class="form-control" v-model="newCus2.name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">联系方式</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <input type="text" class="form-control" v-model="newCus2.phone">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">单位名称</label>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-xs-10 col-xs-offset-1">
                                   <addcompany></addcompany>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-10">
                            <div class="btn btn-default" @click="addCus2(newCus2)">新建服务单</div>
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
                newCus2:{},
                newFlag:true,
                editFlag:true,
            }
        },
        props:{
            cus2s: {
                type: Array
            },
        },
        methods:{
            addCus2(cus2){

            },
            toggleNew(){
                this.newFlag = ! this.newFlag
            },
        },
        mounted() {

        },
        created(){

        },
        components:{
            addcompany
        }
    }
</script>
