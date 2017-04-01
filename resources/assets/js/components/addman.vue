<template>
    <!--侧栏组件：添加员工/客户-->
    <div class="addman">
        <div class="men-wrapper">
            <div class="man-wrapper touch" v-show="men.length" v-for="man in men">
                <div class="man-ellipse" @click="removeMan(man)">
                    {{ man.name }}
                </div>
            </div>
        </div>

        <!--添加符号-->
        <div class="man-addicon">
            <div class="icon-wrapper" @click="showList">
                <i class="fa fa-btn fa-plus"></i>
            </div>
        </div>
        <!--弹出选框-->
        <transition name="fade">
            <div class="men-list" v-show="listFlag">
                <div class="men-search">
                    <input type="text" v-model="manName" :input="search(manName)">
                    <i class="fa fa-btn fa-close" @click="showList"></i>
                </div>
                <div class="men-result">
                    <table class="table table-striped">
                        <tbody class="text-center">
                        <tr v-for="row in rows">
                            <td class="touch" @click="addToList($event, row)" @click.ctrl="addToListMul(row)"> {{ row.name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </transition>
    </div>
</template>

<style lang="stylus" rel="stylesheet/stylus" type="text/stylus">
    .addman
        position relative
        display flex
        justify-content space-around
        align-items center
        .men-wrapper
            flex 1
            display flex
            flex-wrap wrap
            justify-content space-around
            align-items center
            .man-wrapper
                flex 1
                box-sizing border-box
                padding 0 2px
                .man-ellipse
                    min-width 100px
                    border-bottom: 2px solid #000;
                    color: #000;
                    text-align center
        .man-addicon
            flex 0 0 30px
            width 30px
            height 30px
            justify-self flex-around
            box-sizing border-box
            padding 3px
            .icon-wrapper
                width 100%
                border 1px dotted #000
                border-radius 50%
                &:active
                    background red
                i
                    margin 0 0 0 4.6px
        .fade-enter-active,.fade-leave-active
            transition all .2s ease-in
        .fade-enter, .fade-leave-to
            transform translateX( 20vh )
        .men-list
            position: fixed;
            top: 100px;
            right: 0;
            width: 20vh;
            height: calc(62% - 50px);
            background: #fff;
            .men-search
                display flex
                align-items center
                width 100%
                input
                    flex 1
                    margin 8px 10px
                    display block
                    height 24px
                    line-height 24px
                    text-indent 16px
                    border none
                    border-bottom 1px solid #000
                    outline:none
                .fa-close
                    flex 0 0 14px
                    width 14px
                    margin-right 8px


</style>

<script type="text/ecmascript">
    import Bus from '../utils/eventBus'
    var cc = console.log;
    export default {
        data(){
            return {
                manName:'',
                listFlag:false,
                rows:[],
            }
        },
        props:{
            men:{
              type: Array
            },
            type:{
                type:Number   //1:服务员工， 2:客户联系人  3:回访人员
            },
            contract_id:{  //用来找对应单位的客户联系人呢用
                type:Number
            }
        },
        methods:{
          search: _.debounce(function () {
              let id = this.contract_id
              let name = this.manName ? this.manName : "all"
                  if(this.type==2){
                      axios.get(id +'/customer2s/'+name).then(res=>{
                            this.rows = res.data
                      }, error=>{
                          error.status
                      })
                  }else if (this.type ==1 || this.type == 3){
                      axios.get('/searchuser/'+name).then(res=>{
                          this.rows = res.data
                      }, error=>{
                          error.status
                      })
                  }
              },300),
          addToList(event, man){
              var e = event || window.event || arguments.callee.caller.arguments[0];
                  if(e && e.ctrlKey){ //如果同时按下了ctrl，本方法就停止
                        return
                   }
                   //props通病，必须判断是否存在，否则无法使用.push()
              if (this.men){
                  this.men.push(man)
              }

              this.listFlag = false
                  if (this.type == 1){
                      Bus.$emit('addserviser', this.men)
                  } else if(this.type == 2){
                      Bus.$emit('addcus', this.men)
                  }else if(this.type == 3){
                      Bus.$emit('addvisitor', this.men)
              }

          },
          addToListMul(man){
                  //props通病，必须判断是否存在，否则无法使用.push()
                  if (this.men){
                      this.men.push(man)
                  }

                  if (this.type == 1) {
                      Bus.$emit('addserviser', this.men)
                  } else if (this.type == 2) {
                      Bus.$emit('addcus', this.men)
                  } else if (this.type == 3) {
                      Bus.$emit('addvisitor', this.men)
                  }
          },
          removeMan(man){
                  let index = this.men.indexOf(man)
                  if (this.men){
                      this.men.splice(index, 1)
                  }

                  if (this.type == 1){
                      Bus.$emit('rmserviser', this.men)
                  } else if(this.type == 2){
                      Bus.$emit('rmcus', this.men)
                  } else if(this.type == 3){
                      Bus.$emit('rmvisitor', this.men)
                  }
          },
          showList(){
              this.listFlag = !this.listFlag
          }
        },
        mounted() {

        }
    }
</script>
