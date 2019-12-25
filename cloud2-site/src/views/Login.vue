<template>
    <v-container>
      <v-row justify="center">
        <v-col class="text-center" md="3" sm="4">
          <v-form ref="form">
            <v-text-field
              v-model="phone"
              :counter="11"
              label="Phone"
              class="my-2"
            ></v-text-field>
            <v-text-field
              v-model="password"
              :counter="6"
              type="password"
              label="password"
              class="my-2"
            ></v-text-field>
            <v-btn
              color="teal dark-3"
              class="my-2"
              @click="submit"
            >
              login
            </v-btn>
          </v-form>
        </v-col>
      </v-row>
    </v-container>
</template>

<script>
// @ is an alias to /src
import axios from 'axios';

export default {
  name: 'login',
  data() {
    return {
      name: 'Test content',
      phone: '',
      type: '3',
      password: '',
      resp: '',
    };
  },
  mounted() {
    if (localStorage.getItem('jwt') != null) {
      this.$router.replace('/dash');
    }
  },
  methods: {
    submit(event) {
      event.preventDefault();
      const data = JSON.stringify({
        phone: this.phone,
        password: this.password,
        type: this.type,
      });
      axios.post('https://nickotest.000webhostapp.com/api/login.php', data)
        .then((response) => {
          if (response.status === 200) {
            if (response.data.type === '3') {
              this.$store.dispatch('logIn', response);
              this.$router.push('/dash');
              this.resp = response.data;
            } else {
              this.resp = response.data;
            }
          } else {
            this.resp = response.data;
          }
        })
        .catch((error) => {
          this.resp = error.data;
        });
    },
  },
};
</script>
