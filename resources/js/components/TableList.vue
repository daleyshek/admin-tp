<template>
    <div class="box box-default">
        <div class="overlay" v-bind:class="{hidden:!loading}">
            <i class="fa fa-refresh fa-spin"></i>
        </div>
        <div class="box-header">
            <h3>{{title}}</h3>
            <div class="box-tools">
                <div class="box-tools">
                    <form action="#" method="get">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="q" class="form-control pull-right" v-bind:placeholder="searchText"">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th v-for="label in labels">{{label}}</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="li in list">
                    <td v-for="(item,index) in labels" v-html="li[index]"></td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-xs"
                               v-bind:class="operate.class" v-for="operate in operations"
                               v-bind:title="operate.label"
                               v-on:click="btnClick(operate,li[operate.bind])">
                                <span class="fa" v-bind:class="operate.icon" v-if="operate.icon"></span>
                                <span v-if="!operate.icon"> {{operate.label}}</span>
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="javascript:" v-on:click="turn('-')">«</a></li>
                <li v-for="p in maxPage" v-bind:class="{active:p-1==page}"
                    v-if="Math.abs(p-page-1)<10&&(page>=10||page<=maxPage-10)||page<10&&p<20||page>maxPage-10&&p>maxPage-19">
                    <a href="javascript:" v-on:click="turn(p-1)">{{p}}</a></li>
                <li><a href="javascript:" v-on:click="turn('+')">»</a></li>
            </ul>
        </div>
    </div>
</template>
<script>
    export default {
        mounted() {
            this.init();
        },
        data(){
            return {
                url:null,
                storage: {},
                loading: false,
                title: null,
                page: 0,
                perPage: 20,
                maxPage: 1,
                labels: {},
                operations: [],
                list: [],
                searchText:'搜索',
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
                this.request();
            },
            request(){
                var self = this;
                this.loading = true;
                $.post(this.url, {
                    page: this.page,
                    per_page: this.perPage
                }, function (data, status) {
                    self.loading = false;
                    if (status == 'success') {
                        self.list = data.list;
                        self.page = data.page;
                        self.perPage = data.perPage;
                        self.maxPage = data.maxPage;
                        self.operations = data.operations;
                        self.labels = data.labels;
                        self.labels.opration = '操作';
                        if (data.searchText != null){
                            self.searchText = data.searchText;
                        }
                    }
                });
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
                this.request();
            },
            reload: function () {
                this.turn(this.page);
            },
            btnClick: function (operate, data) {
                var self = this;
                if (operate.pattern) {
                    let url = operate.pattern.replace(new RegExp('{'+operate.bind+'}'),data);

                    if (operate.silent) {
                        if(window.confirm('确认该操作？')){
                            $.get(url, {},function (data, status) {
                                if(data == 'success'){
                                    self.reload();
                                }else{
                                    alert(data);
                                }
                            });
                        }
                    } else {
                        window.location.href = url;
                    }
                }
            }
        }
    }
</script>