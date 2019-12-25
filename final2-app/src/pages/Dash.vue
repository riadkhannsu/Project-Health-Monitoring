<template>
  <q-page class="flex flex-center">
    <div class="greeting">
      <p class="text-h5">Welcome back, {{fname}}</p>
    </div>
    <Cards v-bind:cards="cards"/>
  </q-page>
</template>

<script>
import Cards from 'components/Cards'

export default {
  name: 'PageDash',
  components: {
    Cards
  },
  data () {
    return {
      fname: localStorage.getItem('fname'),
      cards: [
        {
          id: 1,
          title: 'Sessions',
          image: 'statics/ecg.jpg'
        },
        {
          id: 2,
          title: 'Diagnosis',
          image: 'statics/diagnosis.jpg'
        },
        {
          id: 3,
          title: 'Prescriptions',
          image: 'statics/pharma.jpg'
        }
      ]
    }
  }

}
</script>
<style scoped>
  .q-page {
    background-color: aliceblue;
  }
  .greet {
    font-size: 18px;
  }
</style>
