<template>
    <q-page class="flex justify-content column">
     <div class="row text-center q-ma-lg" id="id-card">
        <div class="col-12 text-center vertical-middle">
          <q-icon name="account_circle" color="grey" style="font-size: 100px"/>
        </div>
        <div v-if="patientSpinner" class="col-12 text-center">
          <q-spinner-oval id="mySpinner" color="primary" size="7em" class="q-ma-sm" />
        </div>

        <div v-else class="col-12 text-center q-pa-sm">
          <div class="text-h6">{{this.patient.firstname}} {{this.patient.lastname}}</div>
          <div class="text-weight-thin text-center text-white"><q-icon name="calendar_today" color="white" /> {{ new Date(this.patient.created).toDateString() }}</div>
          <div class="text-weight-thin text-center text-white"><q-icon name="local_phone" color="white" /> {{ this.patient.phone }}</div>
        </div>
      </div>

      <div class="text-center q-ma-lg">
        <div class="justify-evenly text-center row">
          <div class="col-5 text-center q-ma-sm">
            <q-btn rounded color="primary" style="color: white; margin:10px 15px; height:50px; width:50px" icon-right="post_add" label="" @click="writeDiag"/>
            <p class="text-grey">new diagnosis</p>
          </div>
          <div class="col-5 text-center q-ma-sm">
            <q-btn rounded color="primary" style="color: white; margin:10px 15px; height:50px; width:50px" icon-right="playlist_add" label="" @click="writePresc" />
            <p class="text-grey">new prescription</p>
          </div>
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
          <q-icon name="view_list" color="white" size="2em" right />
        </div>
        <div class="col-10">
          <div class="text-weight-light text-left text-white">Prescriptions</div>
          <div v-if="prescSpinner" class="text-left q-ma-lg">
            <q-spinner-ios id="mySpinner" color="primary" size="4em" class="q-ma-sm" style="margin-left: 30%" />
          </div>

          <div v-else class="text-left col-12">

            <div v-for="history in prescHistory" v-bind:key="history.index" class="q-ma-sm">
              <div class="row q-ma-sm">
                <q-separator />
              </div>
              <p class="text-grey"> {{ new Date(history.created).toDateString() }} </p>
              <p class="text-weight-light text-green"> {{ history.details }} </p>
              <p class="text-grey">diagnosed doctor id : {{ history.doctor_id }} </p>
            </div>
            <div v-if="!this.prescAvailable" class="text-weight-light text-left text-white">
              <p class="text-blue"> {{this.prescMsg}} </p>
            </div>
            <div v-else class="text-weight-light text-left text-grey">
              <q-btn rounded color="grey" style="color: white; margin:5px 5px;" label="see all" />
            </div>
          </div>
        </div>
      </div>

      <div class="row q-ma-sm">
        <div class="col-2">
          <q-icon name="assignment" color="white" size="2em" right />
        </div>
        <div class="col-10">
          <div class="text-weight-light text-left text-white">Diagnosis</div>
          <div v-if="diagSpinner" class="text-left q-ma-lg">
            <q-spinner-ios id="mySpinner" color="primary" size="4em" class="q-ma-sm" style="margin-left: 30%" />
          </div>

          <div v-else class="text-left col-12">

            <div v-for="history in diagnosisHistory" v-bind:key="history.index" class="q-ma-sm">
              <div class="row q-ma-sm">
                <q-separator />
              </div>
              <p class="text-grey"> {{ new Date(history.created).toDateString() }} </p>
              <p class="text-weight-light text-green"> {{ history.details }} </p>
              <p class="text-grey">diagnosed doctor id : {{ history.doctor_id }} </p>
            </div>
            <div v-if="!this.diagAvailable" class="text-weight-light text-left text-grey">
              <p class="text-blue"> {{this.diagMsg}} </p>
            </div>
            <div v-else class="text-weight-light text-left text-grey">
              <q-btn rounded color="grey" style="color: white; margin:5px 5px;" label="see all" />
            </div>
          </div>

        </div>
      </div>

      <div class="row">
        <q-separator />
      </div>

      <q-page-sticky position="bottom-right" :offset="[18, 18]">
        <q-btn fab icon="keyboard_backspace" color="red" @click="goBack"/>
      </q-page-sticky>
    </q-page>
</template>

<script>
export default {
  name: 'PatientDetails',
  mounted () {
    const data2 = JSON.stringify({
      req: 'getIndividual',
      p_id: this.id
    })
    this.$axios.post('http://nickotest.000webhostapp.com/api/get_patient.php', data2)
      .then(response => {
        if (response.status === 200) {
          this.patient = response.data
          this.patientSpinner = false
          this.viewDiagnosis(this.id)
          this.viewPrescriptions(this.id)
          this.viewIssues(this.id)
        }
      })
      .catch(error => {
        this.diagMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
      })
  },
  props: [
    'id'
  ],
  methods: {
    goBack (evt) {
      evt.preventDefault()
      this.$router.replace('/docdash')
    },
    writeDiag (evt) {
      evt.preventDefault()
      this.$router.replace('/diagnosis/' + this.id)
    },
    writePresc (evt) {
      evt.preventDefault()
      this.$router.replace('/prescription/' + this.id)
    },
    viewPrescriptions (id) {
      event.preventDefault()
      const data4 = JSON.stringify({
        method: 'getAllPresc',
        p_id: this.id
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
              this.prescMsg = 'This patient has no prescriptions yet.'
            }
          }
        })
        .catch(error => {
          this.prescAvailable = false
          this.prescMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
        })
    },
    viewDiagnosis (id) {
      event.preventDefault()
      const data3 = JSON.stringify({
        method: 'getAllDiagnosis',
        p_id: this.id
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
              this.diagMsg = 'This patient has no diagnosis report yet.'
            }
          }
        })
        .catch(error => {
          this.diagAvailable = false
          this.diagMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
        })
    },
    viewIssues (id) {
      event.preventDefault()
      const data6 = JSON.stringify({
        method: 'getAllProblems',
        p_id: this.id
      })
      this.$axios.post('https://nickotest.000webhostapp.com/api/get_problems.php', data6)
        .then(response => {
          if (response.status === 200) {
            this.issueAvailable = true
            this.issues = response.data.reverse()
            if (this.issues.length > 3) {
              this.issues = this.issues.splice(0, 3)
              this.issueAvailable = true
            }
            if (this.issues.length === 0) {
              this.issues = false
              this.issueMsg = 'This patient has no prescriptions yet.'
            }
          }
        })
        .catch(error => {
          this.prescAvailable = false
          this.prescMsg = 'Something went wrong, make sure interconnectivity is available and try again' + JSON.stringify(error)
        })
    }
  },
  data () {
    return {
      issues: {},
      issuesAvailable: false,
      patientSpinner: true,
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
#id-card {
  border-radius: 10px;
  background: #451e3e;
  padding: 50px 10px;
}
</style>
