<template>
  <div class="about">
    <v-container fluid fill-height class="home-hero">
      <v-layout justify-center align-center column pa-5>
        <div class="display-2 font-weight-black white--text text-xs-center">
          GET IN TOUCH WITH US
        </div>
        <div class="display-2 font-weight-thin white--text text-xs-center mb-3">
          WE ARE HAPPY TO HEAR FROM YOU
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
        </v-flex>
        <v-flex xs12>
          <v-container grid-list-xl>
            <v-layout row wrap align-center>
              <v-flex xs12 md4>
                <v-card class="elevation-0 transparent">
                  <v-card-text class="" height="200px">
                    <v-icon size="12em" class="blue--text">mdi-message-alert</v-icon>
                  </v-card-text>
                </v-card>
              </v-flex>
              <v-flex xs12 md8>
                <v-card class="elevation-0">
                  <v-card-text>
                    Here at +CloudHealth we are happy to hear from you anytime. Feel free to
                    leave your comments and suggestions. We believe we can only enrich our
                    platform listening to our userbase.
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
        <div class="text-center contact">
          <h1 class="text-h1">GET IN TOUCH</h1>
          <ul>
            <li><span class="font-weight-bold">Our email :</span> mi.shuvo103@gmail.com</li>
            <li><span class="font-weight-bold">Phone :</span> 017 2019 837</li>
            <li><span class="font-weight-bold">Address :</span> 221 B Baker Street<br>
              NW1 SXE, London<br>
              United Kingdom
            </li>
          </ul>
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
  background: url('../assets/contact.jpg');
  background-size: cover;
  width: 100vw;
  height: 60vh;
}
footer {
  height: 200px;
}
ul li {
  list-style-type: none;
}
.contact {
  margin-bottom: 100px;
}
</style>
