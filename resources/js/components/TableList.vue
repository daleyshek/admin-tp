<template>
    <div class="card">
        <!-- <div class="overlay" v-bind:class="{hidden:!loading}">
            <i class="fa fa-refresh fa-spin"></i>
        </div> -->
        <div class="overlay" v-show="loading">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
        </div>
        <div class="card-header">
            <h3 class="card-title">{{title}}</h3>
            <div class="card-tools" v-if="showSearch">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="query" class="form-control float-right" v-bind:placeholder="searchText">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th v-for="(label,i) in labels" :key="i">
                            <div class="flex-row">
                                <div>
                                    {{label}}
                                </div>
                                <a class="flex-1 text-gray" style="font-size:10px;padding-left:6px;" v-if="inOrders(i)" title="排序" @click="order(i)">
                                    
                                    <span class="fa fa-sort" v-if="orderBy!=i"></span>
                                    <template v-if="orderBy == i">
                                        <span class="fa fa-sort-asc text-black" v-if="orderBySort=='asc'"></span>
                                        <span class="fa fa-sort-desc text-black" v-if="orderBySort=='desc'"></span>
                                    </template>
                                </a>
                            </div>
                        </th>
                        <th v-if="operations && operations.length!=0">操作</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(li,i) in list" :key="i">
                        <td v-for="(item,index) in labels" v-html="li[index]" :key="index"></td>
                        <td v-if="operations && operations.length!=0">
                            <div class="btn-group">
                                <a class="btn btn-xs"
                                v-bind:class="operate.class" 
                                v-for="(operate,o) in operations" :key="o"
                                v-bind:title="operate.label"
                                v-show="li['shows-'+o]==undefined || li['shows-'+o] != undefined && li['shows-'+o]"
                                v-on:click ="btnClick(operate,li[operate.bind])" >
                                    <span class="fa" v-bind:class="operate.icon" v-if="operate.icon"></span>
                                    <span v-if="!operate.icon"> {{operate.label}}</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix flex-row">
            <div class="flex-1">
                <div v-if="showPageSize">
                    显示<input type="text" class="form-control form-control-sm text-center" v-model="pageSize" @change="reload" style="width:45px;display:inline-block;margin:0 5px;">项结果
                </div>
            </div>
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="javascript:" v-on:click="turn(0)">«</a></li>
                <li class="page-item" v-for="(p,i) in maxPage" v-bind:class="{active:p-1==page}"  :key="i"
                    v-show="Math.abs(p-page-1)<10&&(page>=10||page<=maxPage-10)||page<10&&p<20||page>maxPage-10&&p>maxPage-19">
                    <a class="page-link" href="javascript:" v-on:click="turn(p-1)">{{p}}</a></li>
                <li class="page-item"><a class="page-link" href="javascript:" v-on:click="turn(maxPage-1)">»</a></li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            if(this.defaultPageSize != this.pageSize) {
                this.pageSize = this.defaultPageSize;
            }
            this.init();
        },
        data(){
            return {
                url:null,
                storage: {},
                loading: false,
                title: null,
                page: 0,
                pageSize: 20,
                maxPage: 1,
                labels: {},
                operations: [], // 操作按钮
                list: [], // 数据
                orderBy:'', // 当前排序的字段
                orderBySort:'', //asc,desc
                orders:[], // 排序的字段
                searchText:'搜索',
                message:'删除成功'
            }
        },
        props: {
            showSearch:{
                type:Boolean,
                default:false,
            },
            // 两次确认
            doubleConfirm:{
                type:Boolean,
                default:false,
            },
            showPageSize:{
                type:Boolean,
                default:false,
            },
            defaultPageSize:{
                type:Number,
                default:20,
            }
        },
        methods: {
            init(){
                if(this.url == null){
                    this.url = window.location.href;
                }
                if(window.localStorage[this.url]){
                    this.page = window.localStorage[this.url];
                }
                this.request(this.page, this.pageSize);
            },
            inOrders(attr){
                for(let i in this.orders) {
                    if(this.orders[i] == attr) {
                        return true;
                    }
                }
                return false;
            },
            order(attr){
                if(attr == '') {
                    return;
                }
                this.orderBy = attr;
                this.orderBySort = this.orderBySort=='desc'?'asc':'desc';
                this.request(this.page,this.pageSize);
            },
            request(page, pageSize){
                this.loading = true;
                axios.request({url:this.url,method:'post',params:{action:'getList',page,'page_size':pageSize,'order_by':this.orderBy?(this.orderBy + '.' + this.orderBySort):''}}).then(res=>{
                    this.loading = false;
                    if (res.data.page && res.data.page > res.data.maxPage ){
                        this.request(res.data.maxPage, this.pageSize)
                    }else{
                        this.list = res.data.list;
                        this.page = res.data.page;
                        this.maxPage = res.data.maxPage;
                        this.operations = res.data.operations;
                        this.orders = res.data.orders?res.data.orders:[];

                        // 条件按钮，php传 `if=>'{条件}=={数值}'`
                        for(let i in this.operations){
                            if(this.operations[i].condition) {
                                for(let j in this.list) {
                                    let compare = '==';
                                    if(this.operations[i].condition.indexOf('>')>=0) {
                                        compare = '>';
                                    }
                                    if(this.operations[i].condition.indexOf('<')>=0) {
                                        compare = '<';
                                    }
                                    let ops = this.operations[i].condition.split(compare)
                                    if (ops.length == 2) {
                                        let _attr = ops[0].replace('{','').replace('}','')
                                        // console.log(this.list[j][_attr],'==',ops[1])
                                        switch(compare){
                                            case '==':
                                                if (this.list[j][_attr] == ops[1] ){
                                                    this.list[j]['shows-' + i] = true;
                                                }else{
                                                    this.list[j]['shows-' + i] = false;
                                                }
                                            break;
                                            case '>':
                                                if (this.list[j][_attr] > ops[1] ){
                                                    this.list[j]['shows-' + i] = true;
                                                }else{
                                                    this.list[j]['shows-' + i] = false;
                                                }
                                            break;
                                            case '<':
                                                if (this.list[j][_attr] < ops[1] ){
                                                    this.list[j]['shows-' + i] = true;
                                                }else{
                                                    this.list[j]['shows-' + i] = false;
                                                }
                                            break;
                                        }
                                    }
                                }
                            }
                        }

                        this.labels = res.data.labels;
                        if (res.data.searchText){
                            this.searchText = data.searchText;
                        }
                        if(res.data.title){
                            this.title = res.data.title
                        }
                    }
                }).catch(err => {
                    this.loading = false;
                    if(err.response){
                        let res = err.response;
                        switch(res.status){
                            case 422:
                            alert(res.data.message);
                            break;
                            case 500:
                            alert(res.data.message);
                            break;
                        }
                    }
                })
            },
            turn(page){
                if (page === '+') {
                    this.page++;
                    if (this.page >= this.maxPage) {
                        this.page = this.maxPage - 1;
                        return;
                    }
                } else if (page === '-') {
                    this.page--;
                    if (this.page < 0) {
                        this.page = 0;
                        return;
                    }
                } else {
                    this.page = page;
                }
                window.localStorage[this.url] = this.page;
                this.request(this.page, this.pageSize);
            },
            reload: function () {
                this.turn(this.page);
            },
            btnClick: function (operate, data) {
                var self = this;
                if (operate.pattern) {
                    let url = operate.pattern.replace(new RegExp('{'+operate.bind+'}'),data);
                    if (operate.silent) {
                        let title = `确认该${operate.label}操作？`
                        if (operate.prompt){
                            title = operate.prompt;
                        } 
                        if(window.confirm(title)){
                            if(this.doubleConfirm){
                                if (!window.confirm(title)){
                                    return
                                }
                            }
                            axios.get(url).then(res=>{
                                if(res.data.result){
                                    self.reload();
                                }else{
                                    alert(res.data.message);
                                }
                            }).catch(err => {
                                this.loading = false;
                                if(err.response){
                                    let res = err.response;
                                    switch(res.status){
                                        case 422:
                                        alert(res.data.message);
                                        break;
                                        case 500:
                                        alert(res.data.message);
                                        break;
                                    }
                                }
                            })
                        }
                    } else {
                        window.location.href = url;
                    }
                }
            }
        }
    }
</script>

<style>;
.flex-column{display: flex;flex-direction: column;}
.flex-row{display: flex;flex-direction: row;}
.flex-1{flex:1}
.flex-2{flex:2}
.flex-3{flex:3}
.flex-4{flex:4}
</style>
