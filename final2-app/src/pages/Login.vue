<template>
  <q-page class="flex justify-content column" padding>
    <div class="text-center">
      <h1 class="text-weight-thin">Log In to +CloudHealth</h1>
    </div>
    <div class="gutter-md text-center">
      <q-form @submit="onSubmit" class="q-gutter-md" ref="loginForm">
        <q-btn-toggle
          v-model="type"
          class="my-custom-toggle"
          no-caps
          rounded
          unelevated
          toggle-color="blue"
          color="transparent"
          text-color="white"
          :options="[
            {label: 'Patient', value: '1'},
            {label: 'Doctor', value: '2'}
          ]"
        />
        <q-input dark v-model="phone" type="number" hint="Telephone number" required :rules="phoneRules" filled/>
        <q-input dark v-model="password" filled :type="isPwd ? 'password' : 'text'" hint="Password" required :rules="passwordRules">
          <template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
        </q-input>
        <q-btn
          rounded
          dense
          size="md"
          label="Log in"
          style="width:160px;"
          type="submit"
        />
      </q-form>
      <div class="text-center">
        <p class="sm-print">{{log}} {{msg}}</P>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'PageLogin',
  created () {
    if (localStorage.getItem('jwt') != null && localStorage.getItem('type') === '2') {
      this.$router.replace('/docdash')
    } else if (localStorage.getItem('jwt') != null && localStorage.getItem('type') === '1') {
      this.$router.replace('/patientdash')
    }
  },
  data () {
    return {
      msg: 'Dont have an account? You can sign up by going back to the main screen.',
      type: '1',
      log: '',
      phone: null,
      password: null,
      isPwd: true,
      phoneRules: [
        v => !!v || 'Phone number is required',
        v =>
          v.length >= 11 ||
          'Phone number must be greater than 10 digits'
      ],
      passwordRules: [
        v => !!v || 'Password is required',
        v =>
          v.length >= 6 ||
          'Password must be greater than 6 characters'
      ]
    }
  },
  methods: {
    onSubmit (evt) {
      evt.preventDefault()
      if (this.type === '1') {
        const data = JSON.stringify({
          type: this.type,
          phone: this.phone,
          password: this.password
        })
        this.$axios.post('https://nickotest.000webhostapp.com/api/login.php', data)
          .then(response => {
            if (response.status === 200) {
              localStorage.setItem('jwt', response.data.jwt)
              localStorage.setItem('id', response.data.user)
              localStorage.setItem('fname', response.data.name)
              localStorage.setItem('type', response.data.type)
              this.$router.replace('/patientdash')
            } else if (response.status === 401) {
              this.log = 'Server denied response'
            } else {
              this.log = 'failed to sign in'
            }
          })
          .catch(error => {
            this.log = 'Failed to log in. Make sure youre phone number and password are correct and you are connected to the internet.' + error.message
          })
      } else if (this.type === '2') {
        const data = JSON.stringify({
          type: this.type,
          phone: this.phone,
          password: this.password
        })
        this.$axios.post('https://nickotest.000webhostapp.com/api/login.php', data)
          .then(response => {
            if (response.status === 200) {
              localStorage.setItem('jwt', response.data.jwt)
              localStorage.setItem('id', response.data.user)
              localStorage.setItem('fname', response.data.name)
              localStorage.setItem('type', response.data.type)
              this.$router.replace('/docdash')
            } else if (response.status === 401) {
              this.log = 'Server denied response'
            } else {
              this.log = 'failed to sign in'
            }
          })
          .catch(error => {
            this.log = 'Failed to log in. Make sure youre phone number and password are correct and you are connected to the internet.' + error.message
          })
      }
    }
  }

}
</script>
<style scoped>
  .q-btn {
    margin:20px;
    border: 1px solid white;
  }
  h1 {
    font-size: 24px;
  }
  .sm-print {
    padding: 50px 10px;
    width: 100%;
    font-size: 12px;
  }
  .q-page {
    color: white;
  }
  .q-input {
    background: transparent;
    color: white;
  }
  .q-icon {
    color: white;
  }
  .q-transition {
    color: white;
  }
  .my-custom-toggle {
    border: 1px solid #ffffff;
  }
</style>
