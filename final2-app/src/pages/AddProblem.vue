<template>
    <q-page class="column justify-start">
      <div class="col-4 text-center">
      </div>

      <div class="col-4 text-center">
        <div style="margin: 20px 5px;" class="text-center">
          <h6>New health Issue</h6>
          <p style="margin: 50px">{{this.errMsg}}</p>
        </div>
      </div>
      <div class="col-4 text-center">
        <q-separator />
        <p></p>
        <p><span  class="text-weight-regular">Patient: </span>{{this.patient.firstname}} {{this.patient.lastname}}</p>
        <p class="text-weight-regular">Written on: {{new Date().toDateString() }}</p>
      </div>

      <div v-if="showForm" class="col-4 text-center">
        <q-select filled dark v-model="severity" :options="['1','2', '3','4',5]" label="Severity out of 5" />
        <q-separator />
        <q-input
          v-model="details"
          filled
          dark
          type="textarea"
          style="margin:15px"
          hint="Issue description"
        />
        <q-btn color="" icon-right="control_point" label="Submit" @click="submitDiag"/>
      </div>

      <q-page-sticky position="bottom-right" :offset="[18, 18]">
        <q-btn fab icon="keyboard_backspace" color="red" @click="goBack"/>
      </q-page-sticky>
    </q-page>
</template>

<script>
export default {
  mounted () {
    const data2 = JSON.stringify({
      req: 'getIndividual',
      p_id: localStorage.getItem('id')
    })
    this.$axios.post('http://nickotest.000webhostapp.com/api/get_patient.php', data2)
      .then(response => {
        if (response.status === 200) {
          this.patient = response.data
        }
      })
  },
  props: [
    'id'
  ],
  methods: {
    goBack (evt) {
      evt.preventDefault()
      this.$router.replace('/patientdash')
    },
    submitDiag (evt) {
      evt.preventDefault()
      const prescData = JSON.stringify({
        method: 'createProblem',
        p_id: this.patient.id,
        details: this.details,
        severity: this.severity
      })
      if (this.details === '' || this.severity === '') {
        this.errMsg = 'Diagnosis report empty. Please enter a diagnosis for the patient or go back.'
      } else {
        this.$axios.post('http://nickotest.000webhostapp.com/api/get_problems.php', prescData)
          .then(response => {
            if (response.status === 200) {
              this.errMsg = 'Health issue submitted successfully'
              this.showForm = false
            } else {
              this.errMsg = 'Error submitting health issue'
              this.showForm = false
            }
          })
          .catch(error => {
            this.errMsg = error.data
          })
      }
    }
  },
  data () {
    return {
      patient: {
      },
      showForm: true,
      errMsg: '',
      details: '',
      severity: '',
      weekdays: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturay'
      ]
    }
  }

}
</script>

<style scoped>
.q-btn {
  border: 1px solid white;
  color: white;
}
</style>
