<template>
    <div class="main-content">
        <section class="section">
            <div class="section-header">
            <h1>Books Search</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><router-link to="/">Home</router-link></div>
                <div class="breadcrumb-item">Books Search</div>
            </div>
            </div>

            <guest-book/>
            <div class="section-body">
            <div class="row">
                <div class="search-element form-inline mr-auto" style="padding: 30px">
                    <input class="form-control" type="search" placeholder="Search" style="width: 750px" aria-label="Search" data-width="250">
                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
            </div>
        </section>
    </div>
</template>
<script>
import GuestBook from './GuestBook.vue'
export default {
    components: {
        'guest-book': GuestBook
    },
    data () {
      return {
          
      }
    },
}
</script>