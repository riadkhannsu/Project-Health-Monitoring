<template>
  <q-page class="column items-center text-center" padding>
    <div class="row text-center">
      <h1 class="text-white">Sign Up to +Cloud<span class="text-weight-bold">Health</span></h1>
    </div>
    <div class="gutter-md text-center">
      <q-form @submit="onSubmit" class="q-gutter-md">
        <q-btn-toggle
          v-model="user"
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
        <q-input dark v-model="firstname" type="text" hint="First name" filled :rules="fNameRules"/>
        <q-input dark v-model="lastname" type="text" hint="Last name" filled :rules="lNameRules"/>
        <q-input dark v-model="phone" type="number" hint="Phone number" filled :rules="phoneRules"/>
        <q-input dark v-model="password" filled :type="isPwd ? 'password' : 'text'" hint="Password" :rules="passRules">
          <template v-slot:append>
            <q-icon
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            />
          </template>
        </q-input>
        <q-input dark v-model="email" type="email" hint="email" filled/>
        <q-select filled dark v-model="location" :options="['Dhaka','Chittagong', 'Sylhet']" label="Location" />
        <q-select filled dark v-model="gender" :options="['male','female', 'non-binary']" label="Gender" />
        <q-date
          v-model="age"
          dark
          subtitle="Date of Birth"
        />
        <q-input v-if="this.user === '2'" dark v-model="license" type="text" hint="License no" filled/>
        <q-input v-if="this.user === '2'" dark v-model="specialty" type="text" hint="Specialty" filled/>
        <q-input v-if="this.user === '2'" dark v-model="practice" type="text" hint="Place of Practice" filled/>
        <q-input v-if="this.user === '2'" dark v-model="education" type="text" hint="Education" filled/>
        <q-btn
          rounded
          dense
          type="submit"
          text-color="white"
          size="md"
          label="Sign Up"
          style="width:200px;"
        />
      </q-form>
      <P id="sm-print" class="text-white text-center" style="width: 100%">Already have an account? You can log in by going back to the main screen.</P>
    </div>
  </q-page>
</template>

<script>
export default {
  name: 'PageSignup',
  data () {
    return {
      log: '',
      user: '1',
      email: '',
      age: '1990/01/01',
      gender: '',
      license: '',
      specialty: '',
      location: '',
      practice: '',
      status: '1',
      education: '',
      firstname: null,
      lastname: null,
      phone: null,
      password: null,
      isPwd: true,
      fNameRules: [
        v => !!v || 'First name is required',
        v =>
          v.length >= 1 ||
          'First name must be greater than 1 character'
      ],
      lNameRules: [
        v => !!v || 'Last name is required',
        v =>
          v.length >= 1 ||
          'Last name must be greater than 1 character'
      ],
      phoneRules: [
        v => !!v || 'Phone number is required',
        v =>
          v.length >= 11 ||
          'Phone number must be greater than 10 digits'
      ],
      passRules: [
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
      if (this.user === '1') {
        const data = JSON.stringify({
          firstname: this.firstname,
          lastname: this.lastname,
          phone: this.phone,
          password: this.password,
          type: this.user,
          dob: this.age,
          gender: this.gender,
          email: this.email,
          location: this.location
        })
        this.$axios.post('https://nickotest.000webhostapp.com/api/create_user.php', data)
          .then(response => {
            if (response.status === 200) {
              this.log = 'server says: ' + JSON.stringify(response.data.message)
              this.$router.replace('/login')
            } else if (response.status === 400) {
              this.log = 'failed to sign in'
            } else {
              this.log = JSON.stringify(response.data)
            }
          })
          .catch(error => {
            this.log = 'Failed to Sign Up. Make sure youre details follow given rules and you are connected to the internet.' + JSON.stringify(error)
          })
      } else {
        const data = JSON.stringify({
          firstname: this.firstname,
          lastname: this.lastname,
          phone: this.phone,
          type: this.user,
          password: this.password,
          practice: this.practice,
          email: this.email,
          dob: this.age,
          gender: this.gender,
          license: this.license,
          specialty: this.specialty,
          location: this.location,
          education: this.education,
          status: '0'
        })
        this.$axios.post('https://nickotest.000webhostapp.com/api/create_doctor.php', data)
          .then(response => {
            if (response.status === 200) {
              this.log = 'server says: ' + JSON.stringify(response.data.message)
              this.$router.replace('/login')
            } else if (response.status === 400) {
              this.log = 'failed to sign in'
            } else {
              this.log = JSON.stringify(response.data)
            }
          })
          .catch(error => {
            this.log = 'Failed to Sign Up. Make sure youre details follow given rules and you are connected to the internet.' + JSON.stringify(error)
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
    font-size: 18px;
  }
  #sm-print {
    width: 300px;
    font-size: 12px;
  }
  .my-custom-toggle {
    border: 1px solid #ffffff;
  }
  .q-input {
    background: transparent;
    color: white;
  }
  .q-date {
    background: transparent;
    border: 1px solid white;
  }
</style>
