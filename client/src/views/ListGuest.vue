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
import Content from "@/components/ContentGuest.vue"
import Footer from '@/components/Footer.vue'
export default {
  components: {
    'app-header': Header,
    'app-sidebar': Sidebar,
    'app-content': Content,
    'app-footer': Footer
  },
  mounted() {
    if(eval(this.$cookie.get('user_success')) !== true && parseInt(this.$cookie.get('user_role')) !== 0){
      this.$router.replace({
          name: '404'
      })
    }
  },
}
</script>

<style scoped>
</style>