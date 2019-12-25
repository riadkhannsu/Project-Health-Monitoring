<template>
  <div class="dash">
    <v-container>
      <v-row>
        <v-col cols="3" sm="3" class="pa-1 mx-1 my-0">
          <v-card class="pa-0 mx-0 my-0">
            <v-card-text>
              <v-list class="text-center ma-0 pa-0">
                <v-list-item-group color="primary">

                  <v-list-item :to="'/dash'">
                    <v-list-item-icon>
                      <v-icon>mdi-chart-bar-stacked</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                      <v-list-item-title>Dash</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item :to="'/docs'">
                    <v-list-item-icon>
                      <v-icon>mdi-doctor</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                      <v-list-item-title>Doctors</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item :to="'/patients'">
                    <v-list-item-icon>
                      <v-icon>mdi-account-multiple</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                      <v-list-item-title>Patients</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                  <v-list-item :to="'/assignments'">
                    <v-list-item-icon>
                      <v-icon>mdi-account-search</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                      <v-list-item-title>Search</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>

                </v-list-item-group>
              </v-list>
            </v-card-text>
          </v-card>
        </v-col>

        <v-col cols="8" sm="8">
          <router-view>
          </router-view>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
// @ is an alias to /src


export default {
  name: 'dash',
  created() {
    if (localStorage.getItem('jwt') === null) {
      this.$router.replace('/');
    }
  },
  data() {
    return {
    };
  },
  components: {
  },
};
</script>
