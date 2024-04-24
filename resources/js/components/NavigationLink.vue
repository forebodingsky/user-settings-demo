<template>
  <li class="nav-item">
    <router-link
      class="nav-link"
      active-class="active"
      :to="to"
    >
      <slot />
    </router-link>
  </li>
</template>
<script>
export default {
  name: "NavigationLink",
  props: {
    to: {
      type: String,
      required: true,
    },
  },
}
</script>
