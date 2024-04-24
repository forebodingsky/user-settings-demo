<template>
  <default-layout>
    <template #navigation>
      <navigation-list/>
    </template>
    <router-view />
  </default-layout>
</template>
<script>
import DefaultLayout from '@/layout/DefaultLayout.vue';
import NavigationList from './components/NavigationList.vue';

export default {
  name: "App",
  components: {
    DefaultLayout,
    NavigationList
},
}
</script>
