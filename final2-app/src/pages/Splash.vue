<template>
  <q-page class="flex column text-center">
    <div class="img-logo" padding>
      <img alt="CloudHealth logo" src="statics/app-logo.png">
      <h1 class="text-h4 text-white"><span class="text-weight-thin">+Cloud</span><span class="">Health</span></h1>
    </div>

    <div v-if="this.loggedIn === false">
      <div class="cred-btn">
        <q-btn
          to='login'
          rounded
          dense
          size="md"
          label="Log in"
          style="width:200px;"
        />
      </div>
      <div>
        <q-btn
          to='Signup'
          rounded
          dense
          size="md"
          label="Sign Up"
          style="width:200px;"
        />
      </div>
    </div>
    <div v-else>
      <h1 class="text-h4 text-weight-thin text-grey" >WELCOME BACK</h1>
      <q-spinner-dots color="green" size="3em" />
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'PageSplash',
  created () {
    this.type = localStorage.getItem('type')
    if (this.type === '1') {
      this.loggedIn = true
      setTimeout(this.$router.push('/patientdash'), 10000)
    } else if (this.type === '2') {
      this.loggedIn = true
      setTimeout(this.$router.push('/docdash'), 10000)
    }
  },
  data () {
    return {
      loggedIn: false,
      type: null
    }
  }
}
</script>
<style scoped>
  .img-logo {
    padding: 30px 0px;
  }
  .cred-btn {
    padding: 20px 0px;
  }
  .q-btn {
    border: 1px solid white;
    color: white;
  }
</style>
