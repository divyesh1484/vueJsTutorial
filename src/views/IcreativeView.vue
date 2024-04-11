<template>
  <div class="home">
    <img alt="Company logo" src="../assets/logo_small.png">
    <HelloICreative company="ICreative"/>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloICreative from '@/components/HelloICreative.vue'

export default {
  name: 'IcreativeView',
  components: {
    HelloICreative
  }
}
</script>
