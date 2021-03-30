<template>
    <div class="main-content" style="min-height: 600px">
        <section class="section">
            <div class="section-header">
            <h1>Compare Books</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><router-link to="/">Home</router-link></div>
                <div class="breadcrumb-item">Compare Books</div>
            </div>
            </div>

            <guest-book/>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-6">
                        <ul type="none">
                            <li>
                                <div class="search-element form-inline mr-auto">
                                    <input type="text" class="form-control" placeholder="Enter key word  ..." v-model="search" style="width: 100%" v-on:keyup="getfilteredData" v-on:enter="getfilteredData">
                                    <div class="search-result" :style="styleSearch()" v-if="search !== ''">
                                        <ul class="search-header" style="padding-top: 10px;" type="none" v-for="(book, index) in filteredData" v-bind:key="index">
                                            <li><a style="padding: 10px;" class="form-inline" href="#" @click="showData(book)"><img :src="book.cover" width="50"> <p style="padding-left: 30px"> {{ book.title.toUpperCase() }} </p></a></li>
                                        </ul>
                                        <ul class="search-header" style="padding-top: 10px;" type="none" v-if="filteredData.length === 0">
                                            <li style="padding: 10px">Data tidak ditemukan</li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <div v-if="book1.title !== ''">
                            <li>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Books Detail</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <img class="article-image" style="padding-left: 50px;" height="200" :src="book1.cover" />
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <ul style="padding-left: 40px">
                                                    <li>Author : {{ book1.author }}</li>
                                                    <li>Publish on : {{ book1.publish_date }}</li>
                                                    <li>Category : {{ book1.category }}</li>
                                                    <a href="#" @click="readMore(book1)" style="padding: 10px; margin-top: 20px" class="badge badge-primary">
                                                            See Detail?
                                                    </a>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Description</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-justify" v-if="perbesar === false">{{ book1.description.slice(0, 700) }} <a href="#" @click="perbesar = true">...</a></p>
                                        <p class="text-justify" v-else>{{ book1.description }} <a href="#" @click="perbesar = false">(Perkecil?)</a></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <app-chart-line></app-chart-line>
                            </li>
                            <li>
                                <app-chart-pie></app-chart-pie>
                            </li>
                            <li>
                                <app-table-comment></app-table-comment>
                            </li>
                            </div>
                            <div v-else style="padding-top: 100px" class="text-center"><h3>Silahkan cari buku pertama yang ingin dibandingkan</h3></div>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <ul type="none">
                            <li>
                                <div class="search-element form-inline mr-auto">
                                    <input type="text" class="form-control" placeholder="Enter key word  ..." v-model="search2" style="width: 100%" v-on:keyup="getfilteredData" v-on:enter="getfilteredData">
                                    <div class="search-result" :style="styleSearch()" v-if="search2 !== ''">
                                        <ul class="search-header" style="padding-top: 10px;" type="none" v-for="(book, index) in filteredData" v-bind:key="index">
                                            <li><a style="padding: 10px;" class="form-inline" href="#" @click="showData2(book)"><img :src="book.cover" width="50"> <p style="padding-left: 30px"> {{ book.title.toUpperCase() }} </p></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <div v-if="book2.title !== ''">
                            <li>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Books Detail</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <img class="article-image" style="padding-left: 50px;" height="200" :src="book2.cover" />
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-6">
                                                <ul style="padding-left: 40px">
                                                    <li>Author : {{ book2.author }}</li>
                                                    <li>Publish on : {{ book2.publish_date }}</li>
                                                    <li>Category : {{ book2.category }}</li>
                                                </ul>
                                                <a href="#" @click="readMore(book2)" style="padding: 10px; margin-top: 20px" class="badge badge-primary">
                                                        See Detail?
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Description</h4>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-justify" v-if="perbesar2 === false">{{ book1.description.slice(0, 700) }} <a href="#" @click="perbesar2 = true">...</a></p>
                                        <p class="text-justify" v-else>{{ book1.description }} <a href="#" @click="perbesar2 = false">(Perkecil?)</a></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <app-chart-line></app-chart-line>
                            </li>
                            <li>
                                <app-chart-pie></app-chart-pie>
                            </li>
                            <li>
                                <app-table-comment></app-table-comment>
                            </li>
                            </div>
                            <div v-else style="padding-top: 100px" class="text-center"><h3>Silahkan cari buku kedua yang ingin dibandingkan</h3></div>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import tableComment from './TableComment.vue'
import chartLine from './ChartLine.vue'
import chartPie from './chartPie.vue'
import GuestBook from './GuestBook.vue'
import store from '@/store'
export default {
    components: {
        'app-table-comment': tableComment,
        'app-chart-line': chartLine,
        'app-chart-pie': chartPie,
        'guest-book': GuestBook
    },
    data: function() {
return {
    filteredData: [],
    perbesar: false,
    perbesar2: false,
    search: '',
    search2: '',
    neww: [],
    book1: {
        id: '',
        title: '',
        author: '',
        cover: '',
        category: '',
        publish_date: '',
        description: ''
    },
    book2: {
        id: '',
        title: '',
        author: '',
        cover: '',
        category: '',
        publish_date: '',
        description: ''
    },
    books: [],
    indexx: "",
    show: false
};
},
methods: {
    styleSearch(){
        if(this.$mq === 'desktop'){
            return "z-index: 9002; position: absolute; top: 43px; background-color: #fff; width: 500px; max-height: 400px; overflow: scroll"
        }else{
            return "z-index: 9002; position: absolute; top: 43px; background-color: #fff; width: 95%; max-height: 400px; overflow: scroll"
        }
    },
    readMore(book){
        this.indexx = book.id;
        //this.$eventBus.$emit("indexfromcard", this.indexx);
        this.$eventBus.$emit("indexfordetail", this.indexx);
        store.state.indexx = this.indexx
        this.$router.replace({
            name: 'DetailBook'
        })
    },
    fillData(){
        let data = store.state.books
        for(var i = 0; i < data.length; i++){
            this.books.push({id: data[i].id,title: data[i].title.toLowerCase(), cover: data[i].cover, category: data[i].category.toLowerCase(), publish_date: data[i].publish_date, author: data[i].author, description: data[i].description})
        }
        this.success = true 
    },
    fillDataBook1(){
        this.search = ''
        let data = store.state.book
        this.book1.id = data.id
        this.book1.title = data.title
        this.book1.cover = data.cover
        this.book1.publish_date = data.publish_date
        this.book1.author = data.author
        this.book1.category = data.category
        this.book1.description = data.description
    },
    fillDataBook2(){
        this.search2 = ''
        let data = store.state.book
        this.book2.id = data.id
        this.book2.title = data.title
        this.book2.cover = data.cover
        this.book2.publish_date = data.publish_date
        this.book2.author = data.author
        this.book2.category = data.category
        this.book2.description = data.description
    },
    getfilteredData: function() {
        this.show = true;
        this.filteredData = this.books;
        let filteredDataBySearch = [];
        if (this.search !== '') {
            filteredDataBySearch = this.filteredData.filter(obj => obj.title.indexOf(this.search.toLowerCase()) >= 0);
            this.filteredData = filteredDataBySearch;
        }else if (this.search2 !== '') {
            filteredDataBySearch = this.filteredData.filter(obj => obj.title.indexOf(this.search2.toLowerCase()) >= 0);
            this.filteredData = filteredDataBySearch;
        }
    },
    async showData(book){
        store.state.indexx = book.id
        if(book.id !== this.book2.id){
            try {
            await this.$store.dispatch('getDetailBooks')
            this.fillDataBook1()
            } catch (ex) {
                this.error = "Failed to load data";
            } finally {
                this.isBusy = false;
            }
        }else{
            alert('Anda sudah memilih buku ini')
        }
    },
    async showData2(book){
        store.state.indexx = book.id
        if(book.id !== this.book1.id){
            try {
                await this.$store.dispatch('getDetailBooks')
                this.fillDataBook2()
            } catch (ex) {
                this.error = "Failed to load data";
            } finally {
                this.isBusy = false;
            }
        }else{
            alert('Anda sudah memilih buku ini')
        }
    }
},
async mounted() {
    this.isBusy = true;
    try {
        await this.$store.dispatch('loadBooks')
        this.fillData()
        this.getfilteredData();
    } catch (ex) {
        this.error = "Failed to load data";
    } finally {
        this.isBusy = false;
    }
},
};
</script>