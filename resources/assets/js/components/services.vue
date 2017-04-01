<template>
    <div class="services" @click="test">
        <div class="newService" @click="toggleNew">
            <i class="fa fa-btn fa-plus"></i>
        </div>
        <table class="table table-striped table-hover">
            <thead class="self-font-weight-700 text-center">
                <tr>
                    <td width="100">内部受理编号</td>
                    <td width="100" class="result-filter">信息来源<i class="fa fa-btn fa-caret-square-o-down touch" @click="sourceShow()"></i>
                        <div class="result-animate" v-show="sourceFlag">
                            <span class="touch" @click="sortSource(0)">4</span>
                            <span class="touch" @click="sortSource(1)">工</span>
                            <span class="touch" @click="sortSource(2)">销</span>
                            <span class="touch" @click="sortSource(3)">营</span>
                            <span class="touch" @click="sortSource(4)">全</span>
                        </div>
                    </td>
                    <td width="100" class="result-filter">服务类型<i class="fa fa-btn fa-caret-square-o-down touch" @click="typeShow()"></i>
                        <div class="result-animate" v-show="typeFlag">
                            <span class="touch" @click="sortType(0)">故</span>
                            <span class="touch" @click="sortType(1)">巡</span>
                            <span class="touch" @click="sortType(2)">应</span>
                            <span class="touch" @click="sortType(3)">远</span>
                            <span class="touch" @click="sortType(4)">其</span>
                            <span class="touch" @click="sortType(5)">全</span>
                        </div>
                    </td>
                    <td widtd="100">问题描述</td>
                    <td width="150">服务人员</td>
                    <td width="100" class="result-filter">收费情况<i class="fa fa-btn fa-caret-square-o-down touch" @click="chargeShow()"></i>
                        <div class="result-animate" v-show="chargeFlag">
                            <span class="touch" @click="sortCharge(0)">免</span>
                            <span class="touch" @click="sortCharge(1)">收</span>
                            <span class="touch" @click="sortCharge(2)">全</span>
                        </div>
                    </td>
                    <td width="100" class="result-filter">用户评价<i class="fa fa-btn fa-caret-square-o-down touch" @click="ratingShow()"></i>
                        <!--<transition name="show">-->
                            <div class="result-animate" v-show="ratingFlag">
                                <span class="touch" @click="sortRating(0)">非</span>
                                <span class="touch" @click="sortRating(1)">满</span>
                                <span class="touch" @click="sortRating(2)">一</span>
                                <span class="touch" @click="sortRating(3)">不</span>
                                <span class="touch" @click="sortRating(4)">未</span>
                                <span class="touch" @click="sortRating(5)">全</span>
                            </div>
                        <!--</transition>-->
                    </td>
                    <td width="100" class="result-filter">处理状态<i class="fa fa-btn fa-caret-square-o-down touch" @click="resultShow()"></i>
                        <!--<transition name="show">-->
                            <div class="result-animate" v-show="resultFlag">
                                <span class="touch" @click="sortResult(0)">待</span>
                                <span class="touch" @click="sortResult(1)">已</span>
                                <span class="touch" @click="sortResult(2)">未</span>
                                <span class="touch" @click="sortResult(3)">全</span>
                            </div>
                        <!--</transition>-->
                    </td>
                    <td width="100" class="result-filter">回访情况<i class="fa fa-btn fa-caret-square-o-down touch" @click="callbackShow()"></i>
                        <div class="result-animate" v-show="callbackFlag">
                            <span class="touch" @click="sortCallback(0)">非</span>
                            <span class="touch" @click="sortCallback(1)">满</span>
                            <span class="touch" @click="sortCallback(2)">一</span>
                            <span class="touch" @click="sortCallback(3)">不</span>
                            <span class="touch" @click="sortCallback(4)">未</span>
                            <span class="touch" @click="sortCallback(5)">全</span>
                        </div>
                    </td>
                    <td colspan="2">操作</td>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr v-for="service in _services">
                    <td>{{ service.s_id }}</td>
                    <td>
                        <span v-if="service.source == 0">400电话</span>
                        <span v-else-if="service.source == 1">工程中心</span>
                        <span v-else-if="service.source == 2">销售中心</span>
                        <span v-else="service.source == 3">营业中心</span>
                    </td>
                    <td>
                        <span v-if="service.type == 0">故障处理</span>
                        <span v-else-if="service.type == 1">巡检</span>
                        <span v-else-if="service.type == 2">应急保障</span>
                        <span v-else-if="service.type == 3">远程协助</span>
                        <span v-else="service.type == 4">其他</span>
                    </td>
                    <td><div @click="descQuestion(service.desc1)"
                            class="btn btn-default btn-sm">问题描述</div></td>
                    <td>
                        <span v-for="person in service.serviser" class="single-floor">
                        {{ person.name }}
                        </span>
                    </td>
                    <td>
                        <span v-if="service.charge_if === 0">免费</span>
                        <span v-else>收费</span>
                    </td>
                    <!--客户评价-->
                    <td>
                        <div v-if="service.rating===0" class="btn btn-success btn-sm" @click="customer(service.customer2)">非常满意</div>
                        <div v-else-if="service.rating===1" class="btn btn-primary btn-sm" @click="customer(service.customer2)">满意</div>
                        <div v-else-if="service.rating===2" class="btn btn-warning btn-sm" @click="customer(service.customer2)">一般</div>
                        <div v-else-if="service.rating===3" class="btn btn-danger btn-sm" @click="customer(service.customer2)">不满意</div>
                        <div v-else="service.rating===4" class="btn btn-default btn-sm" @click="customer(service.customer2)">未评价</div>
                    </td>
                    <!--处理结果-->
                    <td>
                        <div v-if="service.result_deal===0" class="btn btn-warning btn-sm" @click="descSolve(service)">待解决</div>
                        <div v-if="service.result_deal===1" class="btn btn-success btn-sm" @click="descSolve(service)">{{service.time1}}</div>
                        <div v-if="service.result_deal===2" class="btn btn-danger btn-sm" @click="descSolve(service)">未解决</div>
                    </td>
                    <!--回访评价-->
                    <td>
                        <div v-if="service.result_visit===0" class="btn btn-success btn-sm" @click="visit(service.visitor,service.time3)">非常满意</div>
                        <div v-else-if="service.result_visit===1" class="btn btn-primary btn-sm" @click="visit(service.visitor,service.time3)">满意</div>
                        <div v-else-if="service.result_visit===2" class="btn btn-warning btn-sm" @click="visit(service.visitor,service.time3)">一般</div>
                        <div v-else-if="service.result_visit===3" class="btn btn-danger btn-sm" @click="visit(service.visitor,service.time3)">不满意</div>
                        <div v-else="service.result_visit===4" class="btn btn-default btn-sm">未回访</div>
                    </td>
                    <td class="service-item-edit">
                        <i class="fa fa-btn fa-share" @click="confirmPrintTask(service)"></i>
                        <i class="fa fa-btn fa-cog" @click="toggleEdit(service)"></i>
                        <i class="fa fa-btn fa-close" @click="deleteConfirmService(service.id)"></i>
                    </td>
                </tr>
            </tbody>
        </table>
        <!--分页-->
        <div class="page">
            <el-pagination
                    @current-change="handleCurrentChange"
                    @size-change="handleSizeChange"
                    :current-page="currentPage"
                    :page-sizes="pageSizes"
                    :page-size="pageSize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="total">
            </el-pagination>
        </div>
        <!--增加新服务-->
        <transition name="fade">
            <div class="new-wrapper" v-show="newFlag">
                <div class="modal-header">
                    <button type="button" class="close" @click="toggleNew"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">新建服务</h4>
                </div>
                <br>

                <form class="form-horizontal width-100per-margin-auto">
                    <div class="info-container">
                        <!--编号类型radio-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">编号类型</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10 form-inline">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="service_id_check" value="0" v-model="service_id_check">
                                                自动生成
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="service_id_check" value="1" v-model="service_id_check">
                                                手动输入
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--服务编号-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">服务编号</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" v-model="newService.s_id">
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <addman :type="1" :men="newService.serviser"></addman>
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
                                        <addman :type="2"  :men="newService.customer2" :contract_id="contract_id"></addman>
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
                        <!--占用工时-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">工作量</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input class="form-control" v-model.number="newService.time4">
                                    </div>
                                    <div class="col-xs-4">
                                        <span class="time4">天</span>
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
                                        <addman :type="3" :men="newService.visitor"></addman>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--回访评价radio-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">回访评价</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10 form-inline">
                                        <div class="radio" v-for="result_visit in basic.result_visits">
                                            <label>
                                                <input type="radio" name="result_visit" v-model="newService.result_visit" :value="result_visit.value">
                                                {{ result_visit.text }}
                                            </label>
                                        </div>
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
        <!--修改服务-->
        <transition name="fade">
            <div class="new-wrapper" v-show="editFlag">
                <div class="modal-header">
                    <button type="button" class="close" @click="toggleEdit"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">修改服务</h4>
                </div>
                <br>

                <form class="form-horizontal width-100per-margin-auto">
                    <div class="info-container">
                        <!--编号类型radio-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">编号类型</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10 form-inline">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="service_id_check" value="0" v-model="service_id_check">
                                                自动生成
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="service_id_check" value="1" v-model="service_id_check">
                                                手动输入
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--服务编号-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">服务编号</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="text" class="form-control" v-model="editService.s_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--信息来源-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">信息来源</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <select v-model="editService.source" class="form-control">
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
                                        <select class="form-control" v-model="editService.type">
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
                                                v-model="editService.time1" type="date" placeholder="选择受理日期"
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
                                        <textarea v-model="editService.desc1" class="form-control" cols="60" rows="3"></textarea>
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
                                        <addman :type="1" :men="editService.serviser"></addman>
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
                                                <input type="radio" name="type" :value="charge.value" v-model="editService.charge_if">
                                                {{ charge.text }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--客户联系人，目前一级，后面有空做成二级：点击显示客户列表-》选择客户-》出现该客户下的联系人
                            已经做成默认显示本客户下的所有联系人，因此没必要了。当然有时间，为追求美观还是可以用iview的多级框改的-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">客户联系人</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10">
                                        <addman :type="2" :men="editService.customer2" :contract_id="contract_id"></addman>
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
                                                v-model="editService.time2" type="date" placeholder="选择完工日期"
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
                                        <textarea v-model="editService.desc2" class="form-control" cols="60" rows="3"></textarea>
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
                                                <input type="radio" name="bao" :value="result.value" v-model="editService.result_deal">
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
                                        <textarea v-model="editService.remark" class="form-control" cols="60" rows="3"></textarea>
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
                                                <input type="radio" name="rating" v-model="editService.rating" :value="rating.value">
                                                {{ rating.text }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--占用工时-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">工作量</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <input class="form-control" placeholder="请填写整数" v-model.number="editService.time4">
                                    </div>
                                    <div class="col-xs-4">
                                        <span class="time4">天</span>
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
                                        <addman :type="3" :men="editService.visitor"></addman>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--回访评价radio-->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">回访评价</label>
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-xs-10 form-inline">
                                        <div class="radio" v-for="result_visit in basic.result_visits">
                                            <label>
                                                <input type="radio" name="result_visit" v-model="editService.result_visit" :value="result_visit.value">
                                                {{ result_visit.text }}
                                            </label>
                                        </div>
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
                                                v-model="editService.time3" type="date" placeholder="选择回访日期"
                                                :format="datepicker.format"
                                                :size="datepicker.size" :editable="datepicker.editable">
                                        </el-date-picker>
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
                            <div class="btn btn-default" @click="updateService(editService)">修改服务单</div>
                        </div>
                    </div>
                </form>
            </div>
        </transition>
        <!--侧栏信息:type1:客户联系人 tpye2:回访情况-->
        <bounce></bounce>
    </div>
</template>

<style lang="stylus" rel="stylesheet/stylus">
    .services
        .page
            display block
            float right
    .service-item-edit
        .fa-btn
            cursor pointer
            margin-right 5px

.result-filter
    position relative
    .show-enter-active, .show-leave-active
        transition all .3s ease-in
    .show-enter, .show-leave-to
        opacity 0
    .result-animate
        position: absolute;
        left: 0;
        top: 25px;
        height: 20px;
        width: 110px;
        background: rgba(224,224,236,0.3);
        border-radius: 8%;
        z-index :100
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
    import bounce from './bounce.vue'
    import * as base from '../utils/base'
    let token = document.querySelector('meta[name=csrf-token]').getAttribute('content')
    var cc = console.log;
    export default {
        data(){
            return {
                newFlag:false,
                editFlag:false,
                typeFlag:false,
                sourceFlag:false,
                chargeFlag:false,
                ratingFlag:false,
                resultFlag:false,
                callbackFlag:false,
                service_id_check:0,  //0:自动， 1：手工
                sort_type:5,  //0:故障，1：巡检，2：应急，3：远程，4：其他，5：全部
                sort_source:4,  //0:400，1：工程，2：销售，3：营运，4：全部
                sort_charge: 2,  //0:免费， 1：收费， 2：全部
                sort_rating: 5,  //0：非常满意，1：满意，2：一般，3：不满意，4：未评价, 5:全部
                sort_result: 3,  //0:待， 1：已， 2：未， 3：全部
                sort_callback: 5,  //0：非常满意，1：满意，2：一般，3：不满意，4：未回访, 5:全部
                currentPage:1,
                pageSize:10,
                pageSizes:[10, 20, 30],
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
                        {text:"巡检", value:1},
                        {text:"应急保障", value:2},
                        {text:"远程协助", value:3},
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
                    result_visits:[
                        {text:"非常满意", value :0},
                        {text:"满意", value :1},
                        {text:"一般", value :2},
                        {text:"不满意", value :3},
                        {text:"尚未评价", value :4},
                    ],
                    desc1:null,
                },
                //数据对象
                newService:{
                    source:0,  //默认400电话
                    type:0,    //默认故障处理
                    desc1:null,
                    serviser:[
//                        {}
                    ],
                    charge_if:0, //默认不收费
                    contract_id:this.contract_id,//母合同编号,
                    customer2:[
//                        {}  //一般就一个，以防万一
                    ],
                    time1:null,
                    desc2:null,
                    result_deal:0, //默认待解决
                    remark:null,
                    rating:4, //默认未评价
                    visitor:[
//                        {}  //用于测试
                    ],
                    result_visit:4,
                    time2:null,
                    result_visit:4, //默认未回访
                    time3:null,  //默认3*0.5 = 1.5天
                    files:[
                        {name:"任务单纸质文件", file_name:null }
                    ]
                },
                editService:{},
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
        computed:{
            //页码总数
            total(){
                if (this.services){
                    let _services = this.services
                    var ra = this.rating_sort
                    var re = this.result_sort
                        _services.filter(service=>{
                        if(ra !=5 && re==3){
                            return service.rating == ra
                        }else if(ra ==5 && re!=3){
                            return service.result_deal == re
                        }else if(ra ==5 && re ==3){
                            return true
                        }
                    }).length
                }
            },
            _services(){
                //跳页数据开始位置在数组中的下标
                let start = (this.currentPage -1 ) * this.pageSize
                let end = start + this.pageSize

               var type = this.sort_type  //5
               var source = this.sort_source  //4
               var charge = this.sort_charge //2
               var rating = this.sort_rating //5
               var result = this.sort_result //3
               var callback = this.sort_callback  //5
                if (this.services){
                   var _services =  this.services

                    //服务类型
                    if (type !=5){
                       _services = _services.filter(service=>{
                           return service.type == type
                       })
                    }else{
                        //信息来源
                        if (source != 4){
                            _services = _services.filter(service=>{
                                return service.source == source
                            })
                        }else{
//                            收费
                            if(charge != 2){
                                _services = _services.filter(service=>{
                                    return service.charge_if == charge
                                })
                            }else{
//                                服务评价
                                if(rating !=5 ){
                                    _services = _services.filter(service=>{
                                        return service.rating == rating
                                    })
                                }else{
//                                    处理结果
                                    if(result !=3){
                                        _services = _services.filter(service=>{
                                            return service.result_deal == result
                                        })
                                    }else{
                                        //回访情况
                                        if(callback != 5){
                                            _services = _services.filter(service=>{
                                                return service.result_visit == callback
                                            })
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                return _services.slice(start, end)
            }
        },
        methods:{
            resetFlag(){
                this.typeFlag=false
                this.sourceFlag=false
                this.chargeFlag=false
                this.ratingFlag=false
                this.resultFlag=false
                this.callbackFlag=false
            },
            resetSort(){
                this.sort_type = 5
                this.sort_source = 4
                this.sort_charge = 2
                this.sort_rating = 5
                this.sort_result = 3
                this.sort_callback = 5
            },
            typeShow(){
                this.typeFlag = !this.typeFlag
            },
            sourceShow(){
                this.sourceFlag = !this.sourceFlag
            },
            chargeShow(){
                this.chargeFlag = !this.chargeFlag
            },
            ratingShow(){
                this.ratingFlag = !this.ratingFlag
            },
            resultShow(){
                this.resultFlag = !this.resultFlag
            },
            callbackShow(){
                this.callbackFlag = !this.callbackFlag
            },
            sortType(num){
                this.resetSort()
                this.sort_type = num
                this.resetFlag()
            },
            sortSource(num){
                this.resetSort()
                this.sort_source = num
                this.resetFlag()
            },
            sortCharge(num){
                this.resetSort()
                this.sort_charge = num
                this.resetFlag()
            },
            sortRating(num){
                this.resetSort()
                this.sort_rating = num
                this.resetFlag()
            },
            sortResult(num){
                this.resetSort()
                this.sort_result = num
                this.resetFlag()
            },
            sortCallback(num){
                this.resetSort()
                this.sort_callback = num
                this.resetFlag()
            },
            test(){
            },
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
            customer(customer2){
                Bus.$emit('bounce', {type:1, data:customer2})
            },
            visit(visitor, time){
                Bus.$emit('bounce', {type:2, data:visitor, time:time})
            },
            toggleNew(){
                this.newFlag = ! this.newFlag
            },
            toggleEdit(service){
                this.editFlag = ! this.editFlag
                this.editService = Object.assign({}, service )
            },
            addService(service){
                service.s_id = this.service_id_check===0 ?  null : service.s_id
                cc(service.s_id)
                axios.post('/services', service).then((res)=>{
                    layer.msg("新增成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                    this.newFlag = false
                },error=>{
                    layer.msg("新增失败，请检查", {icon: 5})
                    setTimeout(function(){
                        location.href = location.href
                    },900)
                })
            },
            updateService(service){
                service.s_id = this.service_id_check ? service.s_id : null

                var id = service.id
                axios.patch('/services/'+id, service).then((res)=>{
                    layer.msg("更新成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                    this.newFlag = false
                },error=>{
                    error.status
                    layer.msg("更新失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
            },
            deleteConfirmService(id){
                layer.confirm('确定要删除这条服务记录？', {
                    btn: ['确定','取消'] //按钮
                }, ()=>{
                    this.deleteService(id)
                });
            },
            deleteService(id){
                axios.delete('/services/'+id).then((res)=>{
                    layer.msg("删除成功", {icon: 6});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                    this.newFlag = false
                },error=>{
                    error.status
                    layer.msg("删除失败，请检查", {icon: 5});
                    setTimeout(function(){
                        location.href = location.href;
                    },900)
                })
            },
            handleCurrentChange(val) {
                this.currentPage = val;
            },
            handleSizeChange(val) {
                this.pageSize = val
            },
            confirmPrintTask(service){
                layer.confirm('导出客服工作任务单？', {
                    btn: ['确定','取消'] //按钮
                }, ()=>{
                    this.printTask(service)
                });
            },
            printTask(service){
                var index = layer.load(1, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                axios.post(base.baseUrl+'createTask', service).then(res=>{
                    layer.close(index)
                    location.href = base.baseUrl + 'printTask'
                }, error=>{
                    error.status
                })
            },
        },
        mounted() {
        },
        created(){
            //由于再外层用的blade填充5个v-services组件，所以事件被监听了5次
            //可想而知，当还要扩展已解决和未解决时，会有10次。
            //目前先传v-service type + result_deal解决，后期全部vue化
            Bus.$on('addserviser', data=>{
                if (this.newFlag){
                    this.newService.serviser = data
                }else if (this.editFlag){
                    this.editService.serviser = data
                }
            })
            Bus.$on('addcus', data=>{
                if (this.newFlag){
                    this.newService.customer2 = data
                }else if (this.editFlag){
                    this.editService.customer2 = data
                }
            })
            Bus.$on('addvisitor', data=>{
                if (this.newFlag){
                    this.newService.visitor = data
                }else if (this.editFlag){
                    this.editService.visitor = data
                }
            })
            Bus.$on('rmserviser', data=>{
                if (this.newFlag){
                    this.newService.serviser = data
                }else if (this.editFlag){
                    this.editService.serviser = data
                }
            })
            Bus.$on('rmcus', data=>{
                if (this.newFlag){
                    this.newService.customer2 = data
                }else if (this.editFlag){
                    this.editService.customer2 = data
                }
            })
            Bus.$on('rmvisitor', data=>{
                if (this.newFlag){
                    this.newService.visitor = data
                }else if (this.editFlag){
                    this.editService.visitor = data
                }
            })
        },
        components:{
            addman, bounce
        }
    }
</script>
