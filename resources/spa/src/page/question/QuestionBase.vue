<template>
  <div class="page-question">
    <!-- App Bar. -->
    <switch-bar />

    <!-- Module content. -->
    <router-view />
  </div>
</template>

<script>
import SwitchBar from './components/SwitchBar.vue'

export default {
  name: 'Questions',
  components: {
    SwitchBar,
  },
}
</script>

<style lang="less" scoped>
.page-question {
  padding-bottom: 0 !important;
}
</style>
