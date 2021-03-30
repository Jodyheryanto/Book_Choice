<template>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            <h1>Guest Books</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><router-link to="/">Home</router-link></div>
                <div class="breadcrumb-item">Guest Book</div>
            </div>
            </div>
            <filter-data/>

            <div class="section-body">
                <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Guests</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-wrapper-scroll-y my-custom-scrollbar" v-if="items.length > 0">
                                <b-table striped hover :items="items" :fields="fields">
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
export default {
    components: {
        'filter-data': FilterDate
    },
    data() {
        return {
        // Note 'isActive' is left out and will not appear in the rendered table
        field_names: ['account'],
        fields: [
            {
            key: 'guest_name',
            label: 'Guest Name',
            sortable: true
            },
            {
            key: 'job',
            label: 'Pekerjaan',
            sortable: true
            },
            {
            key: 'company',
            label: 'Asal Instansi',
            sortable: true
            },
            {
            key: 'email',
            label: 'Email',
            sortable: true
            },
            {
            key: 'guest_message',
            label: 'Guest Message'
            },
            {
            key: 'created_at',
            label: 'Date'
            }
        ],
        items: []
        }
    },
    async mounted() {
        this.isBusy = true;
        try {
            await this.$store.dispatch('loadGuest')
            this.fillData()
        } catch (ex) {
            this.error = "Failed to load data";
        } finally {
            this.isBusy = false;
        }
    },
    methods: {
        fillData(){
            let data = store.state.listguests
            for(var i = 0; i < data.length; i++){
                this.items.push({id: data[i].id, guest_name: data[i].guest_name, job: data[i].job, company: data[i].company, email: data[i].email, guest_message: data[i].guest_message, created_at: data[i].created_at})
            }i
            this.success = true 
        },
    },
}
</script>