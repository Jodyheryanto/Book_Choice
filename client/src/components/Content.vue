<template>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            <h1>Books</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Home</div>
            </div>
            </div>

            <demo-draggable-modal/>
            <demo-resizable-modal/>
            <guest-book/>
            <input-carousel/>
            <ubah-carousel/>
            <filter-data/>

            <div class="section-body">
            <div class="row">
                <carousel></carousel>                
                <app-card></app-card>
            </div>
            </div>
        </section>
    </div>
</template>
<script>
//pemanggilan component card
import Card from './Card.vue'
import DemoDraggableModal from './InputBuku.vue'
import DemoResizableModal from './UbahBuku.vue'
import InputCarousel from './InputCarousel.vue'
import UbahCarousel from './UbahCarousel.vue'
import FilterDate from './FilterDate.vue'
import Carousel from './Carousel.vue'
import GuestBook from './GuestBook.vue'
export default {
    components: {
        'app-card': Card,
        DemoDraggableModal,
        DemoResizableModal,
        'guest-book': GuestBook,
        'carousel': Carousel,
        'input-carousel': InputCarousel,
        'ubah-carousel': UbahCarousel,
        'filter-data': FilterDate
    },
}
</script>