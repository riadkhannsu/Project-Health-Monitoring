<template>
  <q-page class="col-12">
    <div class="greeting text-center">
      <p class="text-h5 text-weight-light">Welcome back, {{fname}}</p>
    </div>
    <div class="text-center hidden-msg" style="padding: 10px">
      <p>{{net_msg}}</p>
    </div>

    <div class="row q-ma-sm">
      <div class="col-2">
        <q-icon name="fingerprint" color="blue" size="2em" right />
      </div>
      <div class="col-10">
        <div class="text-weight-light text-left text-white text-h4">Your Patients</div>
        <p v-if="this.assigned.length < 1" class="text-blue">You have not been assigned any patients yet</p>
      </div>
      <div class="text-left col-12">
        <div v-if="patientSpinner" class="text-center q-ma-lg">
          <q-spinner-ios id="mySpinner" color="primary" size="4em" class="q-ma-sm"/>
        </div>

        <div v-for="patient in assigned" v-bind:key="patient.index" class="text-left row pat-card">
          <div class="col-2 text center a-circle">
            <q-icon name="account_circle" color="white" style="font-size: 50px"/>
          </div>
          <div class="q-ma-sm col-6 diag-card" clickable @click="viewPatient(patient.id)">
            <p class="text-white text-h6">{{patient .firstname}} {{patient.lastname}} </p>
            <p class="text-white">Phone : {{patient.phone}}</p>
            <p class="text-white"> Joined : {{ new Date(patient.created).toDateString() }} </p>
          </div>
        </div>
      </div>
    </div>
  </q-page>
</template>

<script>
export default {
  mounted () {
    const data2 = JSON.stringify({
      req: 'getAllMy',
      d_id: localStorage.getItem('id')
    })
    this.$axios.post('http://nickotest.000webhostapp.com/api/get_patient.php', data2)
      .then(response => {
        if (response.status === 200) {
          this.assigned = response.data
          this.patientSpinner = false
        }
      })
      .catch(error => {
        this.net_msg = 'Unfortunately connection to the database could not be established. Make sure you are connected to the internet ' + error
      })
  },
  data () {
    return {
      fname: localStorage.getItem('fname'),
      assigned: [],
      net_msg: '',
      patientSpinner: true
    }
  },
  methods: {
    viewPatient (id) {
      event.preventDefault()
      this.$router.replace('/patient/' + id)
    }
  }
}
</script>

<style scoped>
  .greeting {
    margin: 20px;
    padding: 20px 0px 5px 0px;
    border-radius: 25px;
    background: #451e3e;
  }
  .pat-card{
    padding: 5px;
    margin: 20px 10px;
    background: #451e3e;
    border-radius: 10px;
  }

  .hidden-msg {
    max-height: 0px;
    color: red;
  }

  .a-circle {
    padding-top: 20px;
  }

</style>
