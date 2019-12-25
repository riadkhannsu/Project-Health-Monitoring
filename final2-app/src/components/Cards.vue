<template>
  <div style="width:100%;">
    <q-card v-bind:key="card.id" v-for="card in cards" class="my-card" style="margin: 30px 10px;">
      <q-parallax
        v-bind:src="card.image"
        :height="100"
      />

      <q-card-section>
        <div class="text-h6">{{card.title}}</div>
        <div class="text-subtitle2">Check your previously uploaded vital data</div>
      </q-card-section>
    </q-card>
  </div>
</template>
<script>
export default {
  name: 'Cards',
  props: ['cards']
}
</script>
