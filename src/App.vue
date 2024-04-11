<script>
  import {RouterLink, RouterView} from 'vue-router'

  export default{
    name:'App',
    components:{
      RouterLink,
      RouterView
    }
  }
</script>

<template>
  <nav>
    <RouterLink to="/">Home</RouterLink> |
    <RouterLink to="/icreative">ICreative</RouterLink> |
    <RouterLink to="/json">Json</RouterLink> |
    <RouterLink :to="{ name: 'Products', params: { id: 'divyesh' } }">Product</RouterLink>
  </nav>
  <RouterView/>
</template>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
