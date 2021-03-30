<template>
    <div>
        <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Post Comments</h4>
                </div>
                <div class="card-body">
                    <div class="table-wrapper-scroll-y my-custom-scrollbar" v-if="items.length > 0">
                        <b-table striped hover :items="items" :fields="fields">
                            <template v-slot:cell(user_name)="data">
                                <img :src="getImgUrl()" alt="test" width="50" height="50" style="margin-top: 10px;">
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
</template>
<script>
import store from '@/store'
export default {
    data() {
        return {
        // Note 'isActive' is left out and will not appear in the rendered table
        field_names: ['account'],
        fields: [
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
        items: []
        }
    },
    async mounted() {
        this.isBusy = true;
        try {
            if(store.state.indexx === null){
                store.state.indexx = this.$cookie.get('book_id')
                await this.$store.dispatch('loadReview')
                this.fillData()
            }else{
                await this.$store.dispatch('loadReview')
                this.fillData()
            }
            //await this.$store.dispatch('getDetailBooks')
            //await this.$store.dispatch('loadUser')
            // this.fillData()
        } catch (ex) {
            this.error = "Failed to load data";
        } finally {
            this.isBusy = false;
        }
    },
    methods: {
        getImgUrl() {
            var images = require.context("../assets/stisla/assets/img/avatar/", false, /\.png$/);
            return images("./" + "avatar-1" + ".png");
        },
        fillData(){
            //let data_book = store.state.book
            let data = store.state.reviews
            // let data_user = store.state.users
            for(var i = 0; i < data.length; i++){
                // if(data_book.id === data[i].book_id){
                    //for(var j = 0; j < data_user.length; j++){
                        //if(data[i].user_id === data_user[j].id){
                            //this.items.push({id: data[i].id, user_name: data_user[j].username, book_id: data[i].book_id, post: data[i].post, is_positive: data[i].is_positive, rating: data[i].rating, created_at: data[i].created_at})
                            this.items.push({id: data[i].id, user_name: data[i].user.fullname, book_id: data[i].book_id, post: data[i].post, is_positive: data[i].is_positive, rating: data[i].rating, created_at: data[i].created_at})
                        //}
                    //}
                // }
            }
            this.success = true 
        },
    },
}
</script>
<style scoped>
img {
    border-radius: 50%;
}
</style>
