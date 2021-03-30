
<template>
    <div class="card">
        <div class="card-header">
            <h4>Post Values</h4>
        </div>
        <div class="card-body">
            <apexchart v-if="success === true && count > 0" class="chart" type="bar" height="245" style="padding: 10px;" :options="chartOptions" :series="series"></apexchart>
            <h3 style="color: red" v-else>Data review tidak ada</h3>
        </div>
    </div>
</template>

<script>
// @ is an alias to /src
import VueApexCharts from 'vue-apexcharts'
import store from '@/store'

export default {
    components: {
        'apexchart': VueApexCharts,
    },
    data() {
        return{
            success: false,
            count: 0,
            series: [{
                data: []
            }],
            chartOptions: {
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
            // this.fillData()
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
            this.series[0].data[0] = positive
            this.series[0].data[1] = negative
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
