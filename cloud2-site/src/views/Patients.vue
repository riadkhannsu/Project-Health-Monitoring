<template>
  <div class="text-center">
    <v-dialog
      v-model="infoDialog"
      width="500"
    >
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Patient Info
        </v-card-title>

        <v-card-text>
          <div class="ma-2">
            <p>Id: {{ patientInfo.patient_id }}</p>
            <p>Name: {{ patientInfo.firstname + " " + patientInfo.lastname }}</p>
            <p>phone: {{ patientInfo.phone }}</p>
          </div>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="infoDialog = false"
          >
            close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <div v-if="showProgress" >
      <v-row>
        <v-col>
          <v-progress-circular
            :size="70"
            indeterminate
            color="primary"
          ></v-progress-circular>
        </v-col>
      </v-row>
    </div>

    <div v-else>
      <p class="blue--text">Patients</p>
      <v-row>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="primary">
              Total Patients : {{assignedPatients.length + unassignedPatients.length}}
            </v-chip>
          </div>
        </v-col>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="green" text-color="white">
              Assigned Patients : {{assignedPatients.length}}
            </v-chip>
          </div>
        </v-col>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="orange" text-color="white">
              Unassigned Patients : {{unassignedPatients.length}}
            </v-chip>
          </div>
        </v-col>
      </v-row>

      <v-row class="my-4">
        <v-col cols="12" sm="12" class="text-center">
          <p class="red--text">Unassigned Patients</p>
          <v-simple-table dark fixed-header height="300px">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-center">id</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in unassignedPatients" :key="item.index">
                  <td>{{ item.patient_id }}</td>
                  <td class="white--text">{{ item.firstname + " " +item.lastname }}</td>
                  <td>
                    <v-btn text icon color="green" @click="showPatientInfo(item.id)">
                      <v-icon>mdi-information</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>
      <v-divider></v-divider>
      <v-divider></v-divider>
      <v-divider></v-divider>
      <v-row class="my-4">
        <v-col cols="12" sm="12" class="text-center">
          <p class="green--text">Assigned Patients</p>
          <v-simple-table dark fixed-header height="300px">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-center">id</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Options</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in assignedPatients" :key="item.patient_id" height="50px">
                  <td>{{ item.patient_id }}</td>
                  <td class="white--text">{{ item.firstname + " " +item.lastname }}</td>
                  <td>
                    <v-btn text icon color="green" @click="showPatientInfo(item.id)">
                      <v-icon>mdi-information</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import axios from 'axios';

export default {
  name: 'Patients',
  mounted() {
    this.showProgress = true;
    const data = JSON.stringify({
      req: 'getAllUnassigned',
    });
    axios.post('https://nickotest.000webhostapp.com/api/get_patient.php', data)
      .then((response) => {
        if (response.status === 200) {
          //  console.log(response.data); // eslint-disable-line no-console
          this.unassignedPatients = response.data;
        }
      })
      .catch((error) => {
        JSON.stringify(error.data);
        // console.error(error.data); // eslint-disable-line no-console
      });
    const data1 = JSON.stringify({
      req: 'getAllAssigned',
    });
    axios.post('https://nickotest.000webhostapp.com/api/get_patient.php', data1)
      .then((response) => {
        if (response.status === 200) {
          // console.log(response.data); // eslint-disable-line no-console
          this.assignedPatients = response.data;
          this.showProgress = false;
        }
      })
      .catch((error) => {
        console.error(error.data); // eslint-disable-line no-console
      });
  },
  components: {
  },
  data() {
    return {
      infoDialog: false,
      showProgress: false,
      assignedPatients: [],
      unassignedPatients: [],
      allpatients: [],
      patientInfo: {},
    };
  },
  methods: {
    showPatientInfo(id) {
      this.allpatients = this.assignedPatients.concat(this.unassignedPatients);
      this.patientInfo = this.allpatients.find(obj => obj.id === id);
      this.infoDialog = true;
    },
  },
};
</script>
