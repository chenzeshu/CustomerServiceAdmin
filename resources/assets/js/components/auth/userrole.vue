<template>
    <div class="userrole">
        <el-table
                :data="_users"
                stripe
                style="width: 100%">
            <el-table-column
                    prop="id"
                    label="用户id"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="用户姓名"
                    width="180">
            </el-table-column>
            <el-table-column
                    prop="role"
                    label="用户角色">
            </el-table-column>
            <el-table-column
                    prop="perm"
                    label="用户权限">
            </el-table-column>
            <el-table-column label="操作">
                <template scope="scope">
                    <el-button
                            size="small"
                            @click="tranformEdit(scope.$index, scope.row)">编辑</el-button>
                    <el-button
                            size="small"
                            type="warning"
                            @click="handleRemove(scope.$index, scope.row)">清空</el-button>
                    <el-button
                            size="small"
                            type="danger"
                            @click="handleDelete(scope.$index, scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <!--修改表单-->
        <el-dialog title="修改角色" v-model="editFlag" @close="close()">
            <el-form>
                <el-form-item label="角色" :label-width="formLabelWidth">
                    <el-radio-group v-model="editSource.roleid">
                        <el-radio class="radio" :label="role.id" v-for="role in roles">{{role.name}}</el-radio>
                        <el-radio class="radio" :label="defaultRoleID">未选择</el-radio>
                    </el-radio-group>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="editFlag = false">取 消</el-button>
                <el-button type="primary" @click="handleEdit()">确 定</el-button>
            </div>
        </el-dialog>
        <br>
        <br>
        <!--分页-->
        <div class="row">
            <el-pagination
                    class="col-xs-6 col-md-4 col-center-block"
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
                    :page-sizes="pageSizes"
                    :page-size="pageSize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="total">
            </el-pagination>
        </div>
    </div>
</template>

<script type="text/ecmascript">
    var cc = console.log;
    export default {
        data(){
            return {
                defaultRoleID : 999,
                editFlag:false,
                formLabelWidth:'60px',
                editIndex:null,
                editSource:{}, //原信息
                pageSizes:[10, 20, 30, 40],
                pageSize:10,
                currentPage:1,
            }
        },
        props:{
            users:{
                type:Array
            },
            roles:{
                type:Array
            }
        },
        computed:{
            total(){
                if(this.users){
                    return this.users.length
                }
            },
          _users(){
              if (this.users){
                  let freshs = this.users
                  for (let fresh of freshs){
                      if (fresh.roles.length){
                          for(let role of fresh.roles){
                              fresh.role = role.display_name
                              fresh.roleid = role.id
                              fresh.perm = []
                              for(let perm of role.perms){
                                  fresh.perm.push(perm.display_name)
                              }
                              fresh.perm = fresh.perm.join("，")
                          }
                      }else{
                          fresh.roleid = 999
                      }

                  }
                  //分页改造逻辑
                  let end = this.currentPage * this.pageSize
                  let start =  end - this.pageSize

                  return freshs.slice(start,end)
              }

          }
        },
        methods:{
            tranformEdit(index,row){
                this.editFlag = !this.editFlag
                this.editSource = row
            },
            handleEdit(){
                let data={
                    id: this.editSource.roleid
                }
                axios.patch('/admin/users/'+this.editSource.id, data).then(res=>{
                    this.$message({
                        type: 'success',
                        message: '修改成功'
                    });
                    setTimeout(()=>{
                        location.reload()
                    },1000)
                }, error=>{
                    this.$message({
                        type: 'error',
                        message: '修改失败'
                    });
                    setTimeout(()=>{
                        location.reload()
                    },1000)
                })
            },
            handleRemove(index, row){
                this.$confirm('此操作将清空该用户的角色, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then((index) => {
                    axios.delete('/admin/users/'+row.id).then(res=>{
                        this.$message({
                            type: 'success',
                            message: '清空成功'
                        });
                        setTimeout(()=>{
                            location.reload()
                        },1000)
                    }, error=>{
                        this.$message({
                            type: 'error',
                            message: ' 清空失败'
                        });
                        setTimeout(()=>{
                            location.reload()
                        },1000)
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            handleDelete(index, row){
                this.$confirm('此操作将删除该用户, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then((index) => {
                    axios.delete('/admin/users/'+row.id).then(res=>{
                        this.$message({
                            type: 'success',
                            message: '清空成功'
                        });
                    }, error=>{
                        this.$message({
                            type: 'error',
                            message: ' 清空失败'
                        });
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'
                    });
                });
            },
            close(){
                this.$message({
                    type: 'info',
                    message: '已取消修改'
                });
            },
            handleSizeChange(val){
                this.pageSize = val
            },
            handleCurrentChange(val){
                this.currentPage = val
            }
        },
        mounted() {
//            if(this.users){
//                //用于测试一下前台三层循环时间
//                cc(this._users)
//            }

        }
    }
</script>

<style type="text/stylus" lang="stylus" rel="stylesheet/stylus" >
    .col-center-block
        float: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
</style>


