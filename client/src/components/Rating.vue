<template>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Rating this Book</h4>
                </div>
                <div class="card-body">
                    <ul type="none">
                        <li>
                            <star-rating v-bind:star-size="styleRating()" :border-width="4" v-model="rating" border-color="#d8d8d8" :rounded-corners="true" :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"></star-rating>
                        </li>
                        <li>
                            <a href="#" @click="rateNow()" :style="styleButton()" class="btn btn-primary">
                                <i class="fa fa-edit"></i> Rate Now !
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import StarRating from 'vue-star-rating'
import store from '@/store'
export default {
    components:{
        'star-rating': StarRating
    },
    async mounted() {
        this.isBusy = true;
        try {
            if(this.$cookie.get('book_id') !== null){
                await this.$store.dispatch('loadReview')
                this.fillData()
            }
        } catch (ex) {
            this.error = "Failed to load data";
        } finally {
            this.isBusy = false;
        }
    },
    methods: {
        fillData(){
            let data = store.state.reviews
            for(var i = 0; i < data.length; i++){
                if(data[i].user_id === parseInt(this.$cookie.get('user_id'))){
                    this.rating = parseInt(data[i].rating)
                    this.message = data[i].post
                    this.reviewid = data[i].id
                }
            }
        },
        styleRating(){
            if(this.$mq === 'desktop'){
                return 65
            }else{
                return 40
            }
        },
        styleButton(){
            if(this.$mq === 'desktop'){
                return "padding: 10px; margin: 10px 130px;"
            }else{
                return "padding: 10px; margin: 10px 90px;"
            }
        },
        setRating: function(rating) {
        this.rating = "You have Selected: " + rating + " stars";
        },
        showCurrentRating: function(rating) {
        this.currentRating = (rating === 0) ? this.currentSelectedRating : "Click to select " + rating + " stars"
        },
        setCurrentSelectedRating: function(rating) {
        this.currentSelectedRating = "You have Selected: " + rating + " stars";
        },
        rateNow(){
            let reviews = {reviewid: this.reviewid, rating: this.rating, message: this.message}
            this.$eventBus.$emit("datafromrating", reviews);
            this.$modal.show('example');
        }
    },
    data() {
        return{
            boundRating: 3,
            rating: 0,
            message: '',
            reviewid: null
        }
    },
}
</script>