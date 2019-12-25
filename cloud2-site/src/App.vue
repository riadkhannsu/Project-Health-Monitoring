<template>
  <v-app>
    <v-navigation-drawer
      color="Primary"
      v-model="drawer"
      absolute
      temporary
    >
      <v-subheader>Menu</v-subheader>

      <v-divider></v-divider>
      <v-list-item-group>
        <v-list-item :to="'/'">
          <v-list-item-icon>
              <v-icon>mdi-crosshairs-gps</v-icon>
            </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>Home</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item :to="'/about'">
          <v-list-item-icon>
              <v-icon>mdi-information-outline</v-icon>
            </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title >About</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item :to="'/contact'">
          <v-list-item-icon>
              <v-icon>mdi-email-outline</v-icon>
            </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>Contact</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item :to="'/dash'">
          <v-list-item-icon>
              <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-icon>

          <v-list-item-content>
            <v-list-item-title>DashBoard</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
      <v-divider></v-divider>

        <div class="pa-2">
          <v-btn v-if="loggedIn" color="error" block>Logout</v-btn>
        </div>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="primary"
      dark
    >
      <div class="d-flex align-center">
      </div>
      <v-toolbar-items>
        <v-app-bar-nav-icon
          class="hidden-lg-and-up"
          @click.stop="drawer = !drawer"
        >
        </v-app-bar-nav-icon>
        <v-btn
        to="/"
        text>
          <span class="font-weight-thin">+Cloud</span>
          <span class="font-weight-bold">Health</span>
        </v-btn>
        <v-btn class="hidden-md-and-down" text :to="'/about'">
          <span class="font-weight-light">About</span>
        </v-btn>
        <v-btn class="hidden-md-and-down" text :to="'/contact'">
          <span class="font-weight-light">Contact</span>
        </v-btn>
        <v-btn class="hidden-md-and-down" :to="'/dash'" text>
          <span class="font-weight-light">Dash</span>
        </v-btn>
      </v-toolbar-items>
      <v-spacer></v-spacer>

      <template v-if="loggedIn">
        <v-btn
        text
        @click="signOut"
        >
          <v-icon left>mdi-logout-variant</v-icon>
          <span class="mr-2 font-weight-light hidden-sm-and-down">Sign Out</span>
        </v-btn>
      </template>
      <template v-else>
        <v-btn
        text
        to='/login'
        >
          <v-icon left>mdi-login-variant</v-icon>
          <span class="mr-2 font-weight-light hidden-sm-and-down">Sign In</span>
        </v-btn>
      </template>
    </v-app-bar>

    <v-content>
      <router-view>
      </router-view>
    </v-content>
    <v-footer
      color="primary"
      padless
    >
      <v-row
        justify="center"
        no-gutters
      >
        <v-btn
          color="white"
          text
          rounded
          class="my-2"
          :to="'/'"
        >
          Home
        </v-btn>
        <v-btn
          color="white"
          text
          rounded
          class="my-2"
          :to="'/about'"
        >
          About Us
        </v-btn>
        <v-btn
          color="white"
          text
          rounded
          class="my-2"
          :to="'/contact'"
        >
          Contact Us
        </v-btn>
        <v-btn
          color="white"
          text
          rounded
          class="my-2"
          :to="'/dash'"
        >
          Dash
        </v-btn>
        <v-col
          class="primary py-4 text-center white--text"
          cols="12"
        >
          {{ new Date().getFullYear() }}
          <span class="font-weight-thin">+Cloud</span>
          <span class="font-weight-bold">Health</span>
        </v-col>
      </v-row>
    </v-footer>
  </v-app>
</template>

<script>


export default {
  name: 'App',
  computed: {
    loggedIn() {
      return this.$store.getters.isLoggedIn;
    },
  },
  mounted() {
    if (localStorage.getItem('jwt' === null)) {
      this.$store.dispatch('logOut');
    } else {
      this.$store.dispatch('forceIn');
    }
  },
  components: {
  },
  data: () => ({
    drawer: null,
  }),
  methods: {
    signOut(event) {
      event.preventDefault();
      this.$store.dispatch('logOut');
      this.$router.replace('/');
    },
  },
};
</script>
