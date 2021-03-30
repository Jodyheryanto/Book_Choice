<template>
  <div>
    <!--Start Header-->
    <app-header></app-header>
    <app-sidebar></app-sidebar>
    <app-content></app-content>
    <app-footer></app-footer>
    <!--End Container-->
  </div>
</template>

<script>
import Header from "@/components/Header.vue"
import Sidebar from "@/components/Sidebar.vue"
import Content from "@/components/Content.vue"
import Footer from '@/components/Footer.vue'
export default {
  components: {
    'app-header': Header,
    'app-sidebar': Sidebar,
    'app-content': Content,
    'app-footer': Footer
  },
}
</script>

<style scoped>
</style>