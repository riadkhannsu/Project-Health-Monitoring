<template>
  <div>
    <v-container fluid fill-height class="home-hero">
      <v-layout justify-center align-center column pa-5>
        <div class="display-2 font-weight-black white--text text-xs-center">
          A DOCTOR ON THE GO
        </div>
        <div class="display-2 font-weight-thin white--text text-xs-center mb-3">
          ONLY FOR YOU
        </div>
        <div class="subtitle font-weight-light white--text text-xs-center">
          A smart health service for everyone, everywhere, anytime.
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
          <div class="text-xs-center">
            <h1 class="display-2">The future of affordable instant healthcare</h1>
            <span class="subheading">
              No more restrictions, no more limits
            </span>
          </div>
        </v-flex>
        <v-flex xs12>
          <v-container grid-list-xl>
            <v-layout row wrap align-center>
              <v-flex xs12 md4>
                <v-card class="elevation-0 transparent">
                  <v-card-text class="text-xs-center" height="200px">
                    <v-icon x-large class="blue--text">mdi-hospital-box-outline</v-icon>
                  </v-card-text>
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline text-xs-center">Healthcare everywhere</div>
                  </v-card-title>
                  <v-card-text>
                    We enable to you be withing a cell-tower's reach of healthcare.
                    Regardless of your location, healthcare is no more a variable.
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs12 md4>
                <v-card class="elevation-0 transparent">
                  <v-card-text class="text-xs-center" height="200px">
                    <v-icon x-large class="blue--text text--lighten-2">mdi-flash-outline</v-icon>
                  </v-card-text>
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline">Instant Service</div>
                  </v-card-title>
                  <v-card-text>
                    Time is important, we don't want you to waste it.
                    We get back to you within minutes, if not seconds.
                    No time wasted, fewer risks taken!
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs12 md4>
                <v-card class="elevation-0">
                  <v-card-text class="text-xs-center" height="200px">
                    <v-icon x-large class="blue--text text--lighten-2">mdi-charity</v-icon>
                  </v-card-text>
                  <v-card-title primary-title class="layout justify-center">
                    <div class="headline text-xs-center">Cut the line</div>
                  </v-card-title>
                  <v-card-text>
                    No queues, no lines. Sign up and our physicians will be right with you.
                    upload your vitals and get immediate advice!
                  </v-card-text>
                </v-card>
              </v-flex>
            </v-layout>
          </v-container>
        </v-flex>
      </v-layout>
    </section>

    <section>
      <v-parallax :src="imageLink.main" height="380">
        <v-layout column align-center justify-center>
          <div class="headline white--text mb-3 text-xs-center">
            +CloudHeath is an online platform that ensures instant healthcare.
          </div>
          <em>
            With the power of +cloudHealth, you dont have to wait to get medical attention, ever!
          </em>
          <v-btn class="blue lighten-2 mt-5" dark large href="/pre-made-themes">
            Get more info
          </v-btn>
        </v-layout>
      </v-parallax>
    </section>

    <section>
      <v-container grid-list-xl  class="text-center">
        <v-layout row wrap justify-center class="my-5">
          <v-flex xs12 sm4>
            <v-card class="elevation-0 transparent">
              <v-card-title primary-title class="layout justify-center">
                <div class="headline">Our Beliefs</div>
              </v-card-title>
              <v-card-text>
                We are not a business. We ARE healthcare.
                We believe success only comes from effectiveness
                and hard work.
              </v-card-text>
            </v-card>
          </v-flex>
          <v-flex xs12 sm4 offset-sm1>
            <v-card class="elevation-0 transparent">
              <v-card-title primary-title class="layout justify-center">
                <div class="headline">We are hiring</div>
              </v-card-title>
              <v-card-text>
                Do you like helping people who need it?
                Then you will feel right at home working
                with us and providing crucial help to others.
              </v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </section>

    <section>
      <v-container  class="text-center">
        <v-layout>
          <v-flex xs12 class="text-xs-center">
              <img height="200px" :src="imageLink.logo">
          </v-flex>
        </v-layout>
      </v-container>
    </section>

  </div>
</template>

<script>
export default {
  name: 'HomeBanner',
  data() {
    return {
      imageLink: {
        main:
          'https://firebasestorage.googleapis.com/v0/b/endorfinevue.appspot.com/o/assets%2Fb13f0434-b228-11e6-8e5d-5252025056ab_web_scale_0.4666667_0.4666667__.jpg?alt=media&token=660df23e-599e-434b-9313-ba69c973eeea',
        sub_main:
          'https://firebasestorage.googleapis.com/v0/b/endorfinevue.appspot.com/o/assets%2FNight-Club-Clubbing-Jobs-Abroad2.jpg?alt=media&token=82bbda7d-5df4-430b-9217-adaf1c8485c5',
        logo:
          'https://firebasestorage.googleapis.com/v0/b/endorfinevue.appspot.com/o/assets%2Fandroid-chrome-512x512.png?alt=media&token=8a0a66f6-4741-4ff6-8f28-eb9ec74374df',
        social_cover:
          'https://firebasestorage.googleapis.com/v0/b/endorfinevue.appspot.com/o/assets%2Fo-NIGHTCLUB-facebook.jpg?alt=media&token=cefc5c4c-9714-41da-9c22-f63caf5e89a4',
      },
    };
  },
};
</script>

<style scoped>
.home-hero {
  background: url('../assets/clh.jpg');
  background-size: cover;
  width: 100vw;
  height: 100vh;
}
</style>
