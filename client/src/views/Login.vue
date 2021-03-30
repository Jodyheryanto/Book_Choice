<template>
  <div>
    <app-login></app-login>
    <demo-adaptive-modal/>
  </div>
</template>
<script>
import login from '../components/Login.vue'
import DemoAdaptiveModal from '../components/Register.vue'
export default {
  components: {
    'app-login': login,
    DemoAdaptiveModal
  }
}
</script>