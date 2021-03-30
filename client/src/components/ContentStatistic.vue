<template>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            <h1>Statistic of Book</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><router-link to="/">Home</router-link></div>
                <div class="breadcrumb-item"><router-link to="/detailbook">Detail Book</router-link></div>
                <div class="breadcrumb-item">Statistic of Book</div>
            </div>
            </div>

            <guest-book/>

            <div class="section-body">
                <ul type="none">
                    <li>
                        <div class="row">
                            <div class="col-12 col-md-3 col-lg-3">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>{{ book.title }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <img class="article-image" style="padding-left: 50px;" height="200" :src="book.cover" />
                                    </div>
                                    <div class="card-footer">
                                        <ul style="padding-left: 40px">
                                            <li>Author : {{ book.author }}</li>
                                            <li>Publish on : {{ book.publish_date }}</li>
                                            <li>Category: {{ book.category }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- <i class="fas fa-calendar-week"></i> Date Range
                                <vc-date-picker mode='range' :value="rangeTgl" v-model='rangeTgl'/>
                                <button @click="filterMenu" class="btn btn-primary" :style="styleButton()"><i class="fas fa-search"></i> Filter</button> -->
                            </div>
                            <div class="col-12 col-md-9 col-lg-9">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Description</h4>
                                            </div>
                                            <div class="card-body">
                                                <p style="text-align: justify">{{ book.description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <app-chart-line></app-chart-line>
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <app-chart-pie></app-chart-pie>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <app-chart-bar></app-chart-bar>
                                    </div>
                                </div>    
                                <app-table-comment></app-table-comment>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>
</template>
<script>
import chartLine from './ChartLine.vue'
import chartPie from './chartPie.vue'
import chartBar from './ChartBar.vue'
import tableComment from './TableComment.vue'
import GuestBook from './GuestBook.vue'
import store from '@/store'
export default {
    components: {
        'app-chart-line': chartLine,
        'app-chart-pie': chartPie,
        'app-chart-bar': chartBar,
        'app-table-comment': tableComment,
        'guest-book': GuestBook
    },
    data () {
      return {
        rangeTgl: {
            start: this.addDays(new Date(), -30),
            end: new Date()
        },
        neww: '',
        book: {
            id: '',
            title: '',
            author: '',
            cover: '',
            category: '',
            publish_date: '',
            description: ''
        }
      }
    },
    async mounted() {
        this.isBusy = true;
        try {
            if(this.$cookie.get('book_id') !== null){
                store.state.indexx = this.$cookie.get('book_id')
                await this.$store.dispatch('getDetailBooks')
                this.fillData()
            }
        } catch (ex) {
            this.error = "Failed to load data";
        } finally {
            this.isBusy = false;
        }
        // this.$store.dispatch('loadBooks'),
        this.$eventBus.$on("indexfordetail", (x) => {
            this.$eventBus.$emit("indexfromdetail", x);
        });
    },
    methods: {
        // styleButton(){
        //     if(this.$mq === 'desktop'){
        //         return "margin: 20px 99px;"
        //     }else{
        //         return "margin: 20px 110px;"
        //     }
        // },
        fillData(){
            let data = store.state.book
            this.book.id = data.id
            this.book.title = data.title
            this.book.cover = data.cover
            this.book.publish_date = data.publish_date
            this.book.category = data.category
            this.book.author = data.author
            this.book.description = data.description
            this.success = true 
        },
        getImgUrl(image) {
            var images = require.context("@/assets/stisla/assets/img", false, /\.png$/);
            return images("./" + image + ".png");
        },
        addDays(theDate, days) {
            return new Date(theDate.getTime() + days*24*60*60*1000);
        },
        // filterMenu(){
        //     console.log('test')
        // }
    },
}
</script>