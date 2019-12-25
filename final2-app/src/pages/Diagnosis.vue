<template>
    <q-page class="column justify-start">
      <div class="col-4 text-center">
      </div>

      <div class="col-4 text-center">
        <div style="margin: 20px 5px;" class="text-center">
          <h6>New Diagnosis</h6>
          <p style="margin: 50px">{{this.errMsg}}</p>
        </div>
      </div>
      <div class="col-4 text-center">
        <q-separator />
        <p></p>
        <p><span  class="text-weight-regular">Patient: </span>{{this.patient.firstname}} {{this.patient.lastname}}</p>
        <p class="text-weight-light"><q-icon name="local_phone" color="primary" /> {{this.patient.phone}}</p>
        <p class="text-weight-regular">Written on: {{new Date().toDateString() }}</p>
      </div>

      <div v-if="showForm" class="col-4 text-center">
        <q-separator />
        <q-input
          v-model="details"
          filled
          type="textarea"
          style="margin:15px"
          hint="Diagnosis Details"
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
      p_id: this.id
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
      this.$router.replace('/patient/' + this.id)
    },
    submitDiag (evt) {
      evt.preventDefault()
      const prescData = JSON.stringify({
        method: 'createDiagnosis',
        p_id: this.patient.id,
        d_id: localStorage.getItem('id'),
        details: this.details
      })
      if (this.details === '') {
        this.errMsg = 'Diagnosis report empty. Please enter a diagnosis for the patient or go back.'
      } else {
        this.$axios.post('http://nickotest.000webhostapp.com/api/get_presc_diagnosis.php', prescData)
          .then(response => {
            this.errMsg = 'Diagnosis successfully created and submitted'
            this.showForm = false
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
