<template>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Sentiments History</h4>
            </div>
            <div class="card-body">
                <apexchart v-if="success === true" class="chart" type="line" height="350" style="padding: 10px;" :options="chartOptions" :series="series"></apexchart>
            </div>
        </div>        
    </div>
</div>
</template>

<script>
// @ is an alias to /src
import VueApexCharts from 'vue-apexcharts'
import store from '@/store'
import moment from 'moment';
export default {
components: {
'apexchart': VueApexCharts,
},
    data() {
        return{
            success: false,
            temps: [],
            date_temps: [],
            series: [
                {
                    name: "Posts Total",
                    data: []
                },
                {
                    name: "Positive Reviews",
                    data: []
                },
                {
                    name: "Negative Reviews",
                    data: []
                }
            ],
            chartOptions: {
                chart: {
                    type: 'area',
                    stacked: false,
                    height: 350,
                    zoom: {
                    type: 'x',
                    enabled: true,
                    autoScaleYaxis: true
                    },
                    toolbar: {
                    autoSelected: 'zoom'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 0,
                },
                yaxis: {
                    title: {
                    text: 'Posts'
                    }
                },
                xaxis: {
                    categories: [],
                    title: {
                    text: 'Month'
                    }
                },
            }
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
        async fillData () {
            let data = store.state.reviews
            for(var i = 0; i < data.length; i++){
                this.temps.push({date: data[i].created_at, month: moment(data[i].created_at, 'YYYY-MM-DD hh:mm:ss').format('YYYYMM'), label: moment(data[i].created_at, 'YYYY-MM-DD hh:mm:ss').format('MMMM YYYY'), sentiment: data[i].is_positive})
            }
            if(this.date_temps.length === 0){
                this.date_temps.push(this.temps[0].month)
            }
            for(i = 0; i < this.temps.length; i++){
                var is_ava = 0
                for(var j = 0; j < this.date_temps.length; j++){
                    if(this.date_temps[j] === this.temps[i].month){
                        is_ava = 1
                    }
                }
                if(is_ava === 0){
                    this.date_temps.push(this.temps[i].month)
                }
            }
            this.date_temps.sort()
            for(i = 0; i < this.date_temps.length; i++){
                this.chartOptions.xaxis.categories.push(moment(this.date_temps[i], 'YYYYMM').format('MMMM YYYY'))
            }
            // moment(date, 'YYYYMM').format('MMMM YYYY')
            // console.log(this.temps)
            // i = 0;
            // while(i < this.temps.length){
            //     for(var j = 0; j < this.temps.length; j++){
            //         if(this.temps[i].month !== this.temps.month[j]){
            //             this.chartOptions.xaxis.categories.push(this.temps[i].month)
            //         }
            //     }
            // }
            // console.log(this.chartOptions.xaxis.categories)
            for(i = 0; i < this.chartOptions.xaxis.categories.length; i++){
                var temp = 0
                var pos = 0
                var neg = 0
                for(j = 0; j < this.temps.length; j++){
                    if(moment(this.temps[j].month, 'YYYYMM').format('MMMM YYYY') === this.chartOptions.xaxis.categories[i]){
                        if(this.temps[j].sentiment === 0){
                            neg += 1
                            temp += 1
                        }else{
                            pos += 1
                            temp += 1
                        }
                    }
                }
                this.series[0].data.push(temp)
                this.series[1].data.push(pos)
                this.series[2].data.push(neg)
            }
            this.success = true 
        },
        // async fillData () {
        //     axios.get('https://api.worldbank.org/v2/countries/NOR/indicators/NY.GDP.MKTP.KD.ZG?per_page=12&MRV=30&format=json').then(response1 => {
        //         this.series[0].name = response1.data[1][0].indicator.value
        //         for(var i = response1.data[0].per_page-1; i >= 0; i--){
        //         this.series[0].data.push(response1.data[1][i].value)
        //         this.chartOptions.xaxis.categories.push(response1.data[1][i].date)
        //         }
        //         axios.get('https://api.worldbank.org/v2/countries/NOR/indicators/SL.AGR.EMPL.ZS?per_page=12&MRV=30&format=json').then(response2 => {
        //             this.series[1].name = response2.data[1][0].indicator.value
        //             for(var i = response2.data[0].per_page-1; i >= 0; i--){
        //                 this.series[1].data.push(response2.data[1][i].value)
        //             }
        //             this.success = true
        //         })
        //     })
        // }
    },
}
</script>
