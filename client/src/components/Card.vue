<template>
<div>
<h2 class="section-title">List Book</h2>
<div class="search-wrapper">
    <div class="form-row">
        <div class="col" style="padding: 20px 20px;">
        <input type="text" class="form-control" placeholder="Enter key word  ..." v-model="search" v-on:keyup="getfilteredData" v-on:enter="getfilteredData">
        </div>
    </div>
</div>
<h5 v-if="this.filter === '' && this.search === ''" style="padding-left: 15px">Category : All</h5>
<h5 v-else-if="this.search !== ''" style="padding-left: 15px" class="form-inline">Category : Search with keyword <h5 v-if="this.filter !== ''" style="margin: 3px;">({{ this.filter }})</h5></h5>
<h5 v-else style="padding-left: 15px">Category : {{ this.filter }}</h5>
<div class="row" :style="rowBuku()">
    <p v-if="filteredData.length === 0" style="margin-left: 20px">Tidak ada buku yang tersedia.</p>
    <div class="col-12 col-md-4 col-lg-4" v-if="successLogin === true && roleId === 0 && search === ''">
        <a href="#" @click="$modal.show('example-draggable')">
            <article class="article article-style-c">
                <div class="article-header article-details" style="height: 650px; width:100%; text-align:center">
                    <img src="https://icons.iconarchive.com/icons/iconsmind/outline/256/Add-icon.png" style="margin-top: 50%"/>
                    <h2 style="text-align: center">Add Book</h2>
                </div>
            </article>
        </a>
    </div>
    <div class="col-12 col-md-4 col-lg-4" v-for="(book, index) in filteredData" v-bind:key="index">
    <article class="article article-style-c" :style="artikelBuku(filteredData.length)">
        <div class="article-header" style="height: 400px;">
        <img class="article-image" :src="book.cover" />
        <button type="button" title="Ubah" @click="showModalUbah(book)" v-if="successLogin === true && roleId === 0" style="margin: -390px 55px" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i></span>
        </button>
        <button type="button" title="Hapus" @click="deleteBook(book)" v-if="successLogin === true && roleId === 0" style="margin: -390px 15px" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-icon btn-danger" style="background-color: red"><i class="fas fa-times"></i></span>
        </button>
        <!-- image path -->
        </div>
        <div class="article-details" style="height: 250px">
        <div class="article-category">
            <a href="#">Publication on :</a>
            <div class="bullet"></div>
            <a href="#">{{ book.publish_date }}</a>
        </div>
        <!-- tanggal publikasi -->
        <div class="article-title">
            <h2>
            <a href="#" v-if="$mq === 'desktop'">{{ book.title.toUpperCase() }}</a>
            <a href="#" v-else>{{ book.title.toUpperCase().slice(0, 23) }}<a v-if="book.title.length > 23">...</a></a>
            </h2>
            <!-- judul buku -->
        </div>
        <p v-if="$mq === 'desktop'">{{ book.description.slice(0, 70) }} <a v-if="book.description.length > 70">...</a></p>
        <p v-else>{{ book.description.slice(0, 50) }} <a v-if="book.description.length > 50">...</a></p>
        <!-- deskripsi buku -->
        <!-- <a href="#" class="btn btn-outline-primary">Get Books</a> -->
        <div class="article-user">
            <img alt="image" src="@/assets/stisla/assets/img/avatar/avatar-2.png" />
            <div class="article-user-details">
            <div class="user-detail-name" style="margin-top: 10px;">
                <a href="#" class="float-left" v-if="!book.author.includes('&') && $mq === 'desktop'">{{ book.author }}</a>
                <a href="#" class="float-left" v-else-if="$mq === 'mobile' || $mq === 'tablet'">{{ book.author.slice(0,4) }} ...</a>
                <a href="#" class="float-left" v-else>{{ book.author.slice(0,15) }} et all</a>
                <a href="#" @click="readMore(book)" style="padding: 10px" class="badge badge-primary float-right">
                    Interest? Read More >
                </a>
            </div>
            </div>
        </div>
        </div>
    </article>
    </div>
</div>
</div>
</template>
<script>
import store from '@/store'
export default {
components: {

},
data: function() {
return {
    filteredData: [],
    search: '',
    filter: '',
    neww: [],
    books: [],
    bolUbah: "",
    indexx: "",
    successLogin: false,
    roleId: null
};
},
methods: {
rowBuku(){
    if(this.$mq === 'desktop'){
        return "padding: 0px 15px;"
    }else{
        return "padding: 0px 15px;"
    }
},
artikelBuku(jumlah_buku){
    if(jumlah_buku === 1 && this.$mq === 'desktop'){
        return "width: 400.33px"
    }else{
        return ""
    }
},
fillData(){
    let data = store.state.books
    for(var i = 0; i < data.length; i++){
        this.books.push({id: data[i].id,title: data[i].title.toLowerCase(), cover: data[i].cover, category: data[i].category.toLowerCase(), publish_date: data[i].publish_date, author: data[i].author, description: data[i].description})
    }
    this.success = true 
},
readMore(book){
    this.indexx = book.id;
    //this.$eventBus.$emit("indexfromcard", this.indexx);
    this.$cookie.set('book_id', this.indexx)
    this.$router.replace({
        name: 'DetailBook'
    })
},
deleteBook(book) {
    var r = confirm("Are you sure about that ?");
    if (r == true) {
        store.state.indexx = book.id
        //const index = this.books.indexOf(book);
        this.$store.dispatch('deleteBook').then(() => { alert(store.state.message); location.reload() })
        // this.books.splice(index, 1);
    }
},
showModalUbah(book) {
    this.indexx = this.books.indexOf(book);
    this.$eventBus.$emit("datafromcard", this.books[this.indexx]);
    this.$modal.show("example-resizable");
},
getImgUrl(image) {
    var images = require.context("@/assets/stisla/assets/img", false, /\.png$/);
    return images("./" + image + ".png");
},
getfilteredData: function() {
    this.filteredData = this.books;
    var filteredDataByfilters = this.filter;
    let filteredDataBySearch = [];
    // first check if filters where selected
    if (this.filter !== '') {
        filteredDataByfilters= this.filteredData.filter(obj => obj.category === this.filter.toLowerCase());
        this.filteredData = filteredDataByfilters;
    } 
    if (this.search !== '') {
        filteredDataBySearch = this.filteredData.filter(obj => obj.title.indexOf(this.search.toLowerCase()) >= 0);
        this.filteredData = filteredDataBySearch;
    }
}
},
// mounted() {
// this.successLogin = store.state.successLogin,
// this.roleId = store.state.roleId,
// this.$store.dispatch('loadBooks'),
// console.log(this.books)
// this.$eventBus.$on("datafromubah", z => {
//     this.neww = z;
//     // console.log(this.neww.judul);
//     this.grabbb2();
// });
// this.$eventBus.$on("datafrominput", x => {
//     this.neww = x;
//     this.grabbb();
// });
// },
async mounted() {
    this.successLogin = eval(this.$cookie.get('user_success')),
    this.roleId = parseInt(this.$cookie.get('user_role')),
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
    this.filter = this.$cookie.get('category');
    this.getfilteredData();
},
};
</script>
