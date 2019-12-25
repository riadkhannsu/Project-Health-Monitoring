<template>
  <div class="about">
    <v-container fluid fill-height class="home-hero">
      <v-layout justify-center align-center column pa-5>
        <div class="display-2 font-weight-black white--text text-xs-center">
          WE STRIVE TO PROVIDE HEALTHCARE
        </div>
        <div class="display-2 font-weight-thin white--text text-xs-center mb-3">
          ANYWHERE, EVERYWHERE
        </div>
      </v-layout>
    </v-container>

    <section>
      <v-layout
        column
        wrap
        class="my-5 text-center"
        align-center
      >
        <v-flex xs12 sm4 class="my-3">
          <div class="text-xs-left">
            <h1 class="display-2">Our Goal is universal healthcare</h1>
          </div>
        </v-flex>
        <v-flex xs12>
          <v-container grid-list-xl>
            <v-layout row wrap align-center>
              <v-flex xs12 md4>
                <v-card class="elevation-0 transparent">
                  <v-card-text class="" height="200px">
                    <v-icon size="12em" class="blue--text">mdi-hospital-box-outline</v-icon>
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs12 md8>
                <v-card class="elevation-0">
                  <v-card-text>
                    Starting with +CloudHealth, we aim to make healthcare universally accessible
                    to the people of our country. At the moment the best way we see fit to
                    achieve that is using the mobile communication infrustructre
                    that is already present.
                  </v-card-text>
                </v-card>
              </v-flex>
            </v-layout>
          </v-container>
        </v-flex>
      </v-layout>
    </section>

    <section>
      <v-container>
        <div>
          <h1 class="text-h1">What we do</h1>
          <p>
            We aim to constantly add new and innovative low cost methods health assesment
            allowing our users to effectively communicate with thir doctors. Our ultimate vision
            is to make health care universally accessible to everyone. An ever increasing population
            requires more effective methods of accessing healthcare
            than what is present in our country.
          </p>
          <p>
            currently our platform provides an easy way for our users to get preliminary healthcare.
            We are constantly adding new and improved features to enrich our platform and take
             it closer to our vision of making healthcare accessible to all.
          </p>
        </div>
      </v-container>
    </section>
  </div>
</template>

<script>
export default {
  data: () => ({
  }),
};
</script>
<style scoped>
.home-hero {
  background: url('../assets/doctor.jpg');
  background-size: cover;
  width: 100vw;
  height: 60vh;
}
footer {
  height: 200px;
}
</style>
