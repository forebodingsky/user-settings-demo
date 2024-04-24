<template>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
      <slot name="navigation"/>
    </div>
  </nav>
  <main class="container d-flex flex-column flex-grow-1">
    <slot />
  </main>
  <footer class="mt-auto bg-body-tertiary p-3">
    <div class="container">
      <slot name="footer"/>
    </div>
  </footer>
</template>
<script>
export default {
  name: "DefaultLayout",
}
</script>
