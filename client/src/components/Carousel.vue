<template>
    <div>
        <!-- bagian carousel -->
        <button v-if="carousels.length === 0 && (successLogin === true && roleId === 0)" type="button" title="Tambah" @click="$modal.show('input-carousel')" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="btn btn-icon btn-success">Tambah Carousel?</span>
        </button>
        <b-carousel
            id="carousel-fade"
            v-if="carousels.length !== 0"
            :style="styleCarousel()"
            fade
            indicators
            img-width="1350"
            img-height="480"
        >
            <b-carousel-slide
            v-for="(carousel, index) in carousels"
            v-bind:key="index"
            :img-src="carousel.img"
            >
            <button type="button" title="Tambah" @click="$modal.show('input-carousel')" v-if="$mq === 'desktop' && (successLogin === true && roleId === 0)" class="close" data-dismiss="modal" aria-label="Close" style="margin: 260px -65px">
                <span aria-hidden="true" class="btn btn-icon btn-success"><i class="fas fa-plus"></i></span>
            </button>
            <button type="button" title="Ubah" @click="showModalUbah(carousel)" v-if="$mq === 'desktop' && (successLogin === true && roleId === 0)" class="close" data-dismiss="modal" aria-label="Close" style="margin: 260px -115px">
                <span aria-hidden="true" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i></span>
            </button>
            <button type="button" title="Hapus" @click="deleteBook(carousel)" v-if="$mq === 'desktop' && (successLogin === true && roleId === 0)" class="close" data-dismiss="modal" aria-label="Close" style="margin: 260px -160px">
                <span aria-hidden="true" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></span>
            </button>
            <h3 style="margin-top: 500px" v-if="$mq !== 'desktop' && (roleId !== 0)">{{ carousel.caption }}</h3>
            <h3 style="margin-top: 500px" v-if="$mq === 'desktop'">{{ carousel.caption }}</h3>
            <button type="button" title="Tambah" @click="$modal.show('input-carousel')" v-if="$mq !== 'desktop' && (successLogin === true && roleId === 0)" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 50px; margin-top: 45px;">
                <span aria-hidden="true" class="btn btn-icon btn-success"><i class="fas fa-plus"></i></span>
            </button>
            <button type="button" title="Ubah" @click="showModalUbah(carousel)" v-if="$mq !== 'desktop' && (successLogin === true && roleId === 0)" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 10px; margin-top: 45px;">
                <span aria-hidden="true" class="btn btn-icon btn-primary"><i class="fas fa-edit"></i></span>
            </button>
            <button type="button" title="Hapus" @click="deleteBook(carousel)" v-if="$mq !== 'desktop' && (successLogin === true && roleId === 0)" class="close" data-dismiss="modal" aria-label="Close" style="margin-right: 10px; margin-top: 45px;">
                <span aria-hidden="true" class="btn btn-icon btn-danger"><i class="fas fa-times"></i></span>
            </button>
            </b-carousel-slide>
        </b-carousel>    
    </div>
</template>
<script>
import store from '@/store'
export default {
    data() {
        return{
            carousels: [],
            successLogin: false,
            roleId: null,
            neww: []
        }
    },
    methods: {
        styleCarousel(){
            if(this.$mq === 'desktop'){
                return "text-shadow: 0px 0px 2px #000; padding-left: 10px; width: 99%"
            }else{
                return "text-shadow: 0px 0px 2px #000; padding-left: 10px; width: 97%"
            }
        },
        deleteBook(carousel) {
            var r = confirm("Are you sure about that ?");
            if (r == true) {
                store.state.indexx = carousel.id
                this.$store.dispatch('deleteCarousel').then(() => { alert(store.state.message); location.reload() })
            }
        },
        showModalUbah(id) {
            this.indexx = this.carousels.indexOf(id);
            this.$eventBus.$emit("datafromcarousel", this.carousels[this.indexx]);
            this.$modal.show("ubah-carousel");
        },
        fillData(){
            let data = store.state.carousels
            for(var i = 0; i < data.length; i++){
                this.carousels.push({id: data[i].id,title: data[i].title, caption: data[i].caption, img: data[i].image_path})
            }
            this.success = true 
        },
    },
    async mounted() {
        this.isBusy = true;
        try {
            await this.$store.dispatch('loadCarousels')
            this.fillData()
        } catch (ex) {
            this.error = "Failed to load data";
        } finally {
            this.isBusy = false;
        }
        this.successLogin = eval(this.$cookie.get('user_success')),
        this.roleId = parseInt(this.$cookie.get('user_role'))
    }
}
</script>
<style>
    .img-fluid{
        border-radius: 10px;
    }
</style>