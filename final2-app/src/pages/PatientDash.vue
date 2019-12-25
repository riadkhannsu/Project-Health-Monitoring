<template>
    <q-page class="flex justify-content column">
      <div class="row text-center q-ma-lg" id="id-card">
        <div class="col-12 text-center vertical-middle">
          <q-icon name="account_circle" color="blue" style="font-size: 100px"/>
        </div>
        <div v-if="patientSpinner" class="col-12 text-center">
          <q-spinner-oval id="mySpinner" color="primary" size="7em" class="q-ma-sm" />
        </div>

        <div v-else class="col-12 text-center q-pa-sm">
          <div class="text-subtitle text-blue">Your Details</div>
          <div class="text-h4 text-weight-bold">{{this.patient.firstname}} {{this.patient.lastname}}</div>
          <div class="text-weight-light text-center text-white"><span class="text-blue">Date of Birth :</span>  {{ new Date(this.patient.dob).toDateString() }}</div>
          <div class="text-weight-light text-center text-white"><span class="text-blue">Gender :</span>  {{ this.patient.gender }}</div>
          <div class="text-weight-light text-center text-white"><span class="text-blue">Location :</span>  {{ this.patient.location }}</div>
          <div class="text-weight-light text-center text-white"><q-icon name="email" color="white" />  {{ this.patient.email }}</div>
          <div class="text-weight-thin text-center text-white"><q-icon name="local_phone" color="white" /> {{ this.patient.phone }}</div>
        </div>
      </div>

      <div id="add-btn" class="text-center row">
          <div class="col-3">
          </div>
          <div class="col-6 text-center" >
            <q-btn rounded color="primary" style="color: white; margin:10px 15px; height:50px; width:50px" icon="playlist_add" label="" @click="addProblem()"/>
            <p class="text-white text-weight-thin">Issue</p>
          </div>
      </div>

      <div class="row q-ma-sm">
        <div class="col-2">
          <q-icon name="fingerprint" color="blue" size="2em" right />
        </div>
        <div class="col-10">
          <div class="text-weight-light text-left text-white text-h5">Health Issues</div>
          <p v-if="!this.issuesAvailable" class="text-blue"> Unable to get Issues from database</p>
        </div>
        <div class="col-12">
          <div class="text-left col-12">
            <div v-for="history in issues" v-bind:key="history.index" class="q-ma-sm">
              <div class="diag-card">
                <p class="text-grey"> {{ new Date(history.created).toDateString() }} </p>
                <p class="text-weight-light text-white">Details: {{ history.description }} </p>
                <p class="text-weight-light text-white">severity {{ history.severity }} </p>
                <p class="text-grey">Doctor id : {{ history.doctor_id }} </p>
              </div>
            </div>
            <div v-if="this.issues.length > 3 " class="text-weight-light text-left text-grey">
              <q-btn class="see-all-btn" rounded  style="color: white; margin:5px 5px;" label="see all" />
            </div>
          </div>
        </div>
      </div>

      <div class="row q-ma-sm">
        <div class="col-2">
          <q-icon name="local_hospital" color="blue" size="2em" right />
        </div>
        <div class="col-10">
          <div class="text-weight-light text-left text-white text-h5">Prescriptions</div>
          <p v-if="!this.prescAvailable" class="text-blue"> {{this.prescMsg}} </p>
        </div>
        <div class="col-12">
          <div v-if="prescSpinner" class="text-left q-ma-lg">
            <q-spinner-ios id="mySpinner" color="primary" size="4em" class="q-ma-sm" style="margin-left: 30%" />
          </div>

          <div v-else class="text-left col-12">
            <div v-for="history in prescHistory" v-bind:key="history.index" class="q-ma-sm diag-card">
              <p class="text-grey"> {{ new Date(history.created).toDateString() }} </p>
              <p class="text-weight-light text-white"> {{ history.details }} </p>
              <p class="text-grey">Doctor id : {{ history.doctor_id }} </p>
            </div>
            <div v-if="this.prescAvailable" class="text-weight-light text-left text-grey">
              <q-btn class="see-all-btn" rounded  style="color: white; margin:5px 5px;" label="see all" />
            </div>
          </div>
        </div>
      </div>

      <div class="row q-ma-sm">
        <div class="col-2">
          <q-icon name="assignment" color="blue" size="2em" right />
        </div>
        <div class="col-10">
          <div class="text-weight-light text-left text-white text-h5">Diagnosis</div>
          <p v-if="!this.diagAvailable" class="text-blue"> {{this.diagMsg}} </p>
        </div>
        <div class="col-12">
          <div v-if="diagSpinner" class="text-left q-ma-lg">
            <q-spinner-ios id="mySpinner" color="primary" size="4em" class="q-ma-sm" style="margin-left: 30%" />
          </div>
          <div  class="text-left col-12">

            <div v-for="history in diagnosisHistory" v-bind:key="history.index" class="q-ma-sm diag-card">
              <p class="text-grey text-weight-light">Created On {{ new Date(history.created).toDateString() }} </p>
              <p class="text-weight-light text-white"> {{ history.details }} </p>
              <p class="text-white text-weight-thin">Doctor id : {{ history.doctor_id }} </p>
            </div>
            <div v-if="this.diagAvailable" class="text-weight-light text-left text-grey">
              <q-btn rounded style="color: white; margin:5px 5px;" label="see all" class="see-all-btn" />
            </div>
          </div>

        </div>
      </div>

      <div class="row">
        <q-separator />
      </div>

    </q-page>
</template>

<script>
export default {
  name: 'PatientDash',
  mounted () {
    const data2 = JSON.stringify({
      req: 'getIndividual',
      p_id: localStorage.getItem('id')
    })
    this.$axios.post('https://nickotest.000webhostapp.com/api/get_patient.php', data2)
      .then(response => {
        if (response.status === 200) {
          this.patient = response.data
          this.patientSpinner = false
          this.viewDiagnosis(localStorage.getItem('id'))
          this.viewPrescriptions(localStorage.getItem('id'))
          this.viewIssues(localStorage.getItem('id'))
        }
      })
      .catch(error => {
        this.diagMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
      })
  },
  data () {
    return {
      patientSpinner: true,
      issues: {},
      issuesAvailable: false,
      diagSpinner: true,
      prescSpinner: true,
      sessionSpinner: true,
      patient: {},
      diagnosisHistory: {},
      prescHistory: {},
      diagAvailable: false,
      diagMsg: '',
      prescAvailable: false,
      prescMsg: ''
    }
  },
  methods: {
    addProblem () {
      event.preventDefault()
      this.$router.push('/addproblem')
    },
    viewDiagnosis (id) {
      event.preventDefault()
      const data3 = JSON.stringify({
        method: 'getAllDiagnosis',
        p_id: localStorage.getItem('id')
      })
      this.$axios.post('https://nickotest.000webhostapp.com/api/get_presc_diagnosis.php', data3)
        .then(response => {
          if (response.status === 200) {
            this.diagnosisHistory = response.data.reverse()
            if (this.diagnosisHistory.length > 3) {
              this.diagnosisHistory = this.diagnosisHistory.splice(0, 3)
              this.diagAvailable = true
            }
            this.diagSpinner = false
            if (this.diagnosisHistory.length === 0) {
              this.diagAvailable = false
              this.diagMsg = 'You have diagnosis report yet.'
            }
          }
        })
        .catch(error => {
          this.diagAvailable = false
          this.diagMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
        })
    },
    viewPrescriptions (id) {
      event.preventDefault()
      const data4 = JSON.stringify({
        method: 'getAllPresc',
        p_id: localStorage.getItem('id')
      })
      this.$axios.post('https://nickotest.000webhostapp.com/api/get_presc_diagnosis.php', data4)
        .then(response => {
          if (response.status === 200) {
            this.prescHistory = response.data.reverse()
            if (this.prescHistory.length > 3) {
              this.prescHistory = this.prescHistory.splice(0, 3)
              this.prescAvailable = true
            }
            this.prescSpinner = false
            if (this.prescHistory.length === 0) {
              this.prescAvailable = false
              this.prescMsg = 'You have no prescriptions yet.'
            }
          }
        })
        .catch(error => {
          this.prescAvailable = false
          this.prescMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
        })
    },
    viewIssues (id) {
      event.preventDefault()
      const data5 = JSON.stringify({
        method: 'getAllProblems',
        p_id: localStorage.getItem('id')
      })
      this.$axios.post('https://nickotest.000webhostapp.com/api/get_problems.php', data5)
        .then(response => {
          if (response.status === 200) {
            this.issues = response.data.reverse()
            this.issuesAvailable = true
            if (this.issues.length > 3) {
              this.issues = this.issues.splice(0, 3)
              this.issuesAvailable = true
            }
            if (this.issues.length === 0) {
              this.issuesAvailable = false
              this.issueMsg = 'You have no prescriptions yet.'
            }
          }
        })
        .catch(error => {
          this.issuesAvailable = false
          this.issueMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
        })
    }
  }
}
</script>
<style scoped>
.diag-card {
  background: #451e3e;
  padding: 10px 15px;
  margin-top: 20px;
  border-radius: 10px;
}
.see-all-btn {
  background: transparent;
  border: 1px solid white;
}
#id-card {
  border-radius: 10px;
  background: #451e3e;
  padding: 50px 10px;
}
#add-btn {
  margin-top: -60px;
}
</style>
