<template>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            <h1>Report Books</h1>
            </div>
            <filter-data/>

            <div class="section-body">
                <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Books</h4>
                        </div>
                        <div class="card-body">
                            <div v-if="items.length > 0" :class="styleTable()">
                                <b-table striped hover :items="items" :fields="fields">
                                    <template v-slot:cell(titleimg)="data">
                                        <img :src="data.value.cover" alt="test" width="50" height="50" style="margin-left: 20px; margin-top: 10px;">
                                        <div style="margin-top: 5px; margin-left: 7px" sortable="true">{{ data.value.title }}</div>
                                    </template>
                                    <template v-slot:cell(description)="data">
                                        {{ data.value.slice(0, 70) }} ...
                                    </template>
                                </b-table>
                            </div>
                            <h3 style="color: red" v-else>Data review tidak ada</h3>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Sentiments Total</h4>
                            </div>
                            <div class="card-body" style="height: 268px;">
                                <apexchart type="pie" style="margin-top: 30px" height="150" :options="chartOptions" :series="series" v-if="success === true"></apexchart>
                                <h3 style="color: red" v-else>Data review tidak ada</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Post Values</h4>
                            </div>
                            <div class="card-body" style="height: 268px;">
                                <apexchart v-if="success === true" class="chart" type="bar" height="200" style="padding: 10px;" :options="chartOptions2" :series="series2"></apexchart>
                                <h3 style="color: red" v-else>Data review tidak ada</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Total Post Come in</h4>
                            </div>
                            <div class="card-body" style="height: 268px; ">
                                <div v-if="success === true" style="text-align: center; margin-top: 20px"><h1>{{ total_post }}</h1><h4>Post</h4></div>
                                <div v-else style="text-align: center  margin-top: 20px"><h1 style="color: red">0</h1><h4>Post</h4></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Total Books Come in</h4>
                            </div>
                            <div class="card-body" style="height: 268px;">
                                <div v-if="success === true" style="text-align: center;  margin-top: 20px"><h1>{{ total_book }}</h1><h4>Books</h4></div>
                                <div v-else style="text-align: center  margin-top: 20px"><h1 style="color: red">0</h1><h4>Post</h4></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Post Comments</h4>
                        </div>
                        <div class="card-body">
                            <div v-if="item_comments.length > 0" :class="styleTable()">
                                <b-table striped hover :items="item_comments" :fields="fields2">
                                    <template v-slot:cell(book)="data">
                                        <img :src="data.value.img" alt="test" width="50" height="50" style="margin-left: 20px; margin-top: 10px;">
                                        <div style="margin-top: 5px; margin-left: 7px; text-align: center" sortable="true">{{ data.value.title }}</div>
                                    </template>
                                    <template v-slot:cell(user_name)="data">
                                        <img :src="getImgUrl()" alt="test" width="50" height="50" style="margin-top: 10px; border-radius: 50%;">
                                        <div style="margin-top: 5px; margin-left: 7px"><a href="#">{{ data.value }}</a></div>
                                    </template>
                                    <template v-slot:cell(is_positive)="data">
                                        <div v-if="data.value === 0">
                                            <p class="badge badge-danger">negative</p>
                                        </div>
                                        <div v-if="data.value === 1">
                                            <p class="badge badge-success">positive</p>
                                        </div>
                                    </template>
                                </b-table>
                            </div>
                            <h3 style="color: red" v-else>Data review tidak ada</h3>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import store from '@/store'
import FilterDate from './FilterDate.vue'
import VueApexCharts from 'vue-apexcharts'
export default {
    components: {
        'filter-data': FilterDate,
        apexchart: VueApexCharts,
    },
    data() {
        return {
        // Note 'isActive' is left out and will not appear in the rendered table
        series2: [{
            data: []
        }],
        chartOptions2: {
            chart: {
            type: 'bar',
            height: 380
            },
            plotOptions: {
            bar: {
                horizontal: true,
            }
            },
            dataLabels: {
            enabled: false
            },
            xaxis: {
            categories: ['Positive', 'Negative'],
            }
        },
        series: [],
        chartOptions: {
            chart: {
            width: 380,
            type: 'pie',
            },
            labels: ['Positive', 'Negative'],
            responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 200
                },
                legend: {
                position: 'bottom'
                }
            }
            }]
        },
        success: false,
        success2: false,
        count: 0,
        field_names: ['account'],
        fields: [
            {
            key: 'titleimg',
            label: 'Judul'
            },
            {
            key: 'category',
            label: 'Kategori',
            sortable: true
            },
            {
            key: 'author',
            label: 'Penulis',
            sortable: true
            },
            {
            key: 'publish_date',
            label: 'Tanggal Publish',
            sortable: true
            },
            {
            key: 'description',
            label: 'Deskripsi'
            }
        ],
        fields2: [
            {
            key: 'book',
            label: 'Book'
            },
            {
            key: 'user_name',
            label: 'Account',
            sortable: true
            },
            {
            key: 'post',
            label: 'Post',
            sortable: true
            },
            {
            key: 'created_at',
            label: 'Date',
            sortable: true
            },
            {
            key: 'rating',
            label: 'Rating',
            sortable: true
            },
            {
            key: 'is_positive',
            label: 'Sentiment'
            }
        ],
        items: [],
        item_comments: [],
        neww: [],
        total_post : null,
        total_book: null
        }
    },
    mounted() {
        this.neww.dari_tgl = this.$cookie.get('dari_tgl')
        this.neww.smp_tgl = this.$cookie.get('smp_tgl')
        this.fillFilter();
    },
    methods: {
        styleTable(){
            if(this.$mq === 'desktop'){
                return ""
            }else{
                return "table-wrapper-scroll-y my-custom-scrollbar"
            }
        },
        getImgUrl() {
            var images = require.context("../assets/stisla/assets/img/avatar/", false, /\.png$/);
            return images("./" + "avatar-1" + ".png");
        },
        async fillData(){
            let data = store.state.books
            let data_reviews = store.state.reviewalls
            for(var i = 0; i < data.length; i++){
                if(data[i].created_at > this.neww.dari_tgl && data[i].created_at < this.neww.smp_tgl){
                    this.total_book += 1
                    this.items.push({titleimg: {title: data[i].title, cover: data[i].cover}, category: data[i].category, author: data[i].author, publish_date: data[i].publish_date, description: data[i].description})
                }
            }
            for(i = 0; i < data_reviews.length; i++){
                store.state.indexx = data_reviews[i].book_id
                for(var j = 0; j < data.length; j++){
                    if(data_reviews[i].created_at > this.neww.dari_tgl && data_reviews[i].created_at < this.neww.smp_tgl){
                        if(data_reviews[i].book_id === data[j].id){
                            this.total_post += 1
                            this.item_comments.push({id: data_reviews[i].id, book: {title: data[j].title, img: data[j].cover}, user_name: data_reviews[i].user.fullname, book_id: data_reviews[i].book_id, post: data_reviews[i].post, is_positive: data_reviews[i].is_positive, rating: data_reviews[i].rating, created_at: data_reviews[i].created_at})
                        }
                    }
                }
            }
            this.fillDataChart();
        },
        fillDataChart(){
            let data = store.state.reviewalls
            var positive = 0
            var negative = 0
            for(var i = 0; i < data.length; i++){
                if(data[i].created_at > this.neww.dari_tgl && data[i].created_at < this.neww.smp_tgl){
                    if(data[i].is_positive === 1){
                        positive += 1
                        this.count += 1
                    }else{
                        negative += 1
                        this.count += 1
                    }
                }
            }
            this.series[0] = positive
            this.series[1] = negative
            this.series2[0].data[0] = positive
            this.series2[0].data[1] = negative
            if(this.count !== 0){
                this.success = true 
            }
        },
        async fillFilter(){
            this.isBusy = true;
            try {
                await this.$store.dispatch('loadBooks')
                await this.$store.dispatch('loadReviews')
                this.fillData()
            } catch (ex) {
                this.error = "Failed to load data";
            } finally {
                this.isBusy = false;
            }
        }
    },
}
</script>
<style scoped>
    h1 {
        font-size: 100px;
    }
</style>