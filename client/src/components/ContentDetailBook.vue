<template>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            <h1>Detail of Book</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><router-link to="/">Home</router-link></div>
                <div class="breadcrumb-item"><router-link to="/detailbook">Detail Book</router-link></div>
            </div>
            </div>
            <guest-book/>
            <example/>
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
                                <div :style="styleButton()">
                                    <a href="#" @click="seeStatistic()" style="padding: 10px; margin-left: 70px;" class="btn btn-primary">
                                        <i class="fa fa-chart-line"></i> Statistic Book
                                    </a>
                                </div>
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
                                <app-rating v-if="successLogin === true && roleId === 1"></app-rating>   
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
import store from '@/store'
import tableComment from './TableComment.vue'
import Rating from './Rating.vue'
import ExampleModal from './RatingDetail.vue'
import GuestBook from './GuestBook.vue'
export default {
    components: {
        'app-table-comment': tableComment,
        'app-rating': Rating,
        'example': ExampleModal,
        'guest-book': GuestBook
    },
    data () {
        return {
                rangeTgl: {
                    start: this.addDays(new Date(), -30),
                    end: new Date()
                },
                indexx: '',
                neww: null,
                successLogin: false,
                roleId: null,
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
        this.successLogin = eval(this.$cookie.get('user_success')),
        this.roleId = parseInt(this.$cookie.get('user_role')),
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
    },
    methods: {
        // ...mapActions({
        //     getDetailAction: 'getDetailBooks'
        // }),
        // getDetail(index) {
        //     this.getDetailAction(index).then(() => {
        //         if(store.state.book){
        //             console.log(store.state.book)
        //         }
        //     })
        // },
        styleButton(){
            if(this.$mq === 'desktop'){
                return "margin-left: 10px"
            }else{
                return "padding-bottom: 20px; margin-left: 15px;"
            }
        },
        fillData(){
            let data = store.state.book
            this.book.id = data.id
            this.book.title = data.title
            this.book.cover = data.cover
            this.book.publish_date = data.publish_date
            this.book.author = data.author
            this.book.category = data.category
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
        seeStatistic(){
            this.$cookie.set('book_id', store.state.indexx)
            this.$router.replace({
                name: 'StatisticBook'
            })
        }
    },
    // computed: mapState([
    //     'books'
    // ])
}
</script>