export default {
    newFlag: true,
    editFlag: true,
    newService: {
        source: null,  //默认400电话
        type: null,    //默认故障处理
        time1:null,     //受理时间
        desc1: null,
        serviser: [
            //服务人员 type:1
            {id: 1, name: "张小龙"}
        ],
        charge_if: 0, //默认不收费
        contract_id: null,//母合同编号,
        customer2: [
            // 客户联系人 tpye:2
            {id: 1, name: "土豪"}  //一般就一个，以防万一
        ],
        time2: null, //完工时间
        desc2: null, //处理描述
        result_deal: 0, //默认待解决
        remark: null,
        rating: 4, //默认未评价
        vistor: [  //回访人员 type 3
            {id: 1, name: "土豪"}  //用于测试
        ],
        time3: null,
        result_visit: 4, //默认未回访
        time4: 3,  //默认3*0.5 = 1.5天
        files: [
            {name: "任务单纸质文件", file_name: null}
        ]
    }
}
