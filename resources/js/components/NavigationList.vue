<template>
  <ul class="navbar-nav">
    <navigation-link to="/">Home</navigation-link>
    <navigation-link to="/users">Users</navigation-link>
  </ul>
</template>
<script>
import NavigationLink from './NavigationLink.vue';
export default {
  name: "NavigationList",
  components: {
    NavigationLink,
  },
}
</script>
