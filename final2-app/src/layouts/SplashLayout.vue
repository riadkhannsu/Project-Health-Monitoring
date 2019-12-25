<template>
  <q-layout view="lHh Lpr lFf">
    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: 'SplashLayout',

  data () {
    return {
    }
  }
}
</script>
<style>
.q-layout {
  background-image: linear-gradient(15deg, #051e3e , #051e3e)
}
.q-date__header {
  background: #051e3e;
}
</style>
