<template>
  <div class="home">
    <HomeBanner />
  </div>
</template>

<script>
// @ is an alias to /src
import HomeBanner from '@/components/HomeBanner.vue';

export default {
  name: 'home',
  components: {
    HomeBanner,
  },
};
</script>
