<template>
    <div class="bounce" @click="toggle">
        <transition name="bounce">
            <div class="bounce-wrapper" v-show="showFlag">
                <div class="header">
                    <h2>详细情况</h2>
                </div>
                <hr>
                <div class="content">
                    <table class="table table-striped text-center">
                        <thead>
                            <tr>
                                <td>{{header1}}</td>
                                <td>{{header2}}</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="da of data.data">
                                <td v-if="data.type==1">{{ da.id }}</td>
                                <td v-else>{{da.name}}</td>
                                <td v-if="data.type==1">{{ da.name }}</td>
                                <td v-else>{{time}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
           </div>
        </transition>
    </div>
</template>

<style lang="stylus" rel="stylesheet/stylus">
    .bounce
        .bounce-enter-active
            transition all .3s ease-in
        .bounce-leave-active
            transition all .3s ease-in
            transform:translateX(100%)
        .bounce-enter
            transform translateX(100%)
            opacity 0
        .bounce-leave-to
            opacity 0
        .bounce-wrapper
            position fixed
            top 60px
            right 0
            width 20%
            height calc(100% - 60px)
            background #FDF5E6

</style>

<script type="text/ecmascript">
    import Bus from '../utils/eventBus'
    var cc = console.log;
    export default {
        data(){
            return {
                showFlag :false,
                data:[],
                result:[],
                time:null
            }
        },
        methods:{
          toggle(){
              this.showFlag = !this.showFlag
          },
        },
        computed:{
          header1(){
              if (this.data.type ==1){
                  //用户评价
                  return  "联系人id"
              }else if(this.data.type==2){
                  //回访
                  return "回访人"
              }
          },
            header2(){
                if (this.data.type ==1){
                    //用户评价
                    return "联系人姓名"
                }else if(this.data.type==2){
                    //回访
                    return  "日期"
                }
            }
        },
        created(){
          Bus.$on('bounce', data=>{
              this.data = data

              if(data.type ==2){
                  this.time = data.time
              }

              this.toggle()
          })
        },
        mounted() {

        }
    }
</script>
