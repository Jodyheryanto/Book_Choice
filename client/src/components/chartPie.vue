<template>
    <div class="card">
        <div class="card-header">
            <h4>Sentiments Total</h4>
        </div>
        <div class="card-body">
            <apexchart type="pie" :options="chartOptions" :series="series" v-if="success === true && count > 0"></apexchart>
            <h3 style="color: red" v-else>Data review tidak ada</h3>
        </div>
    </div> 
</template>
<script>
import VueApexCharts from 'vue-apexcharts'
import store from '@/store'
export default {
    components: {
        apexchart: VueApexCharts,
    },
    data() {
        return{
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
            count: 0
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
        } catch (ex) {
            this.error = "Failed to load data";
        } finally {
            this.isBusy = false;
        }
    },
    methods: {
        fillData(){
            //let data_book = store.state.book
            let data = store.state.reviews
            var positive = 0
            var negative = 0
            for(var i = 0; i < data.length; i++){
                // if(data_book.id === data[i].book_id){
                    if(data[i].is_positive === 1){
                        positive += 1
                        this.count += 1
                    }else{
                        negative += 1
                        this.count += 1
                    }
                // }
            }
            this.series[0] = positive
            this.series[1] = negative
            // for(var i = 0; i < data.length; i++){
            //     if(data_book.id === data[i].book_id){
            //         for(var j = 0; j < data_user.length; j++){
            //             if(data[i].user_id === data_user[j].id){
            //                 this.series.push({})
            //             }
            //         }
            //     }
            // }
            this.success = true 
        },
    },
}
</script>