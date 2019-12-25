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
          Doctor Info
        </v-card-title>

        <v-card-text>
          <div class="ma-2">
            <p>Id: {{ docInfo.id }}</p>
            <p>Name: Dr. {{ docInfo.firstname + " " + docInfo.lastname }}</p>
            <p>phone: {{ docInfo.phone }}</p>
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

    <v-dialog
      v-model="patientDialog"
      width="500"
    >
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          All Assigned Patients
        </v-card-title>

        <v-card-text>
          <p>patients assigned: {{patients.length}}</p>
          <div class="ma-2" v-for="patient in patients" :key="patient.id">
            <v-divider></v-divider>
            <p>Id: {{ patient.patient_id }}</p>
            <p>Name: Dr. {{ patient.firstname + " " + patient.lastname }}</p>
            <p>phone: {{ patient.phone }}</p>
          </div>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="patientDialog = false"
          >
            close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog
      v-model="unassignedPatientDialog"
      width="500"
    >
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          All Unassigned Patients
        </v-card-title>

        <v-card-text>
          <p>Total : {{unassignedPatients.length}}</p>
          <p>Total : {{unassignedPatients.length}}</p>
          <div class="ma-2" v-for="patient in unassignedPatients" :key="patient.patient_id">
            <v-divider></v-divider>
            <p>Id: {{ patient.patient_id }}</p>
            <p>Name: {{ patient.firstname + " " + patient.lastname }}</p>
            <p>phone: {{ patient.phone }}</p>
            <v-btn text icon color="blue" @click="assignPatient(patient.patient_id, docId)">
              <v-icon>mdi-clipboard-check</v-icon>
            </v-btn>
          </div>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="primary"
            text
            @click="unassignedPatientDialog = false"
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
      <p class="blue--text">Doctors</p>
      <v-row>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="primary">
              Total Doctors : {{allDocs.length}}
            </v-chip>
          </div>
        </v-col>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="green" text-color="white">
              Doctors Assigned : {{assigned.length}}
            </v-chip>
          </div>
        </v-col>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="orange" text-color="white">
              Doctors Unassigned : {{allDocs.length - assigned.length}}
            </v-chip>
          </div>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" sm="12" class="text-center">
          <p class="red--text">Unassigned Doctors</p>
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
                <tr v-for="item in unassignedDocs" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td class="white--text">{{ item.firstname + " " +item.lastname }}</td>
                  <td>
                    <v-btn text icon color="yellow">
                      <v-icon>mdi-account-minus-outline</v-icon>
                    </v-btn>
                    <v-btn text icon color="green" @click="showInfoDialog(item.id)">
                      <v-icon>mdi-information</v-icon>
                    </v-btn>
                    <v-btn text icon color="green" @click="getUnassignedPatients(item.id)">
                      <v-icon>mdi-account-multiple-plus</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" sm="12" class="text-center">
          <p class="green--text">Assigned Doctors</p>
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
                <tr v-for="item in assignedDocs" :key="item.id" height="50px">
                  <td>{{ item.id }}</td>
                  <td class="white--text">{{ item.first_name + " " +item.last_name }}</td>
                  <td>
                    <v-btn text icon color="yellow">
                      <v-icon>mdi-account-minus-outline</v-icon>
                    </v-btn>
                    <v-btn text icon color="green" @click="showInfoDialog(item.id)">
                      <v-icon>mdi-information</v-icon>
                    </v-btn>
                    <v-btn text icon color="green" @click="showPatientDialog(item.id)">
                      <v-icon>mdi-account-multiple</v-icon>
                    </v-btn>
                    <v-btn text icon color="white" @click="getUnassignedPatients(item.id)">
                      <v-icon>mdi-account-multiple-plus</v-icon>
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
  name: 'Doctors',
  mounted() {
    this.showProgress = true;
    this.getAllDocs();
    this.getAssignedDocs();
  },
  components: {
  },
  data() {
    return {
      unassignedPatientDialog: false,
      infoDialog: false,
      patientDialog: false,
      allDocs: [],
      showProgress: false,
      assigned: [],
      assignedDocs: [],
      unassignedDocs: [],
      docInfo: {},
      patients: [],
      unassignedPatients: [],
      docId: '',
    };
  },
  methods: {
    getAllDocs() {
      const data = JSON.stringify({
        method: 'getAll',
      });
      axios.post('https://nickotest.000webhostapp.com/api/get_docs.php', data)
        .then((response) => {
          if (response.status === 200) {
            //  console.log(response.data); // eslint-disable-line no-console
            this.allDocs = response.data;
          }
        })
        .catch((error) => {
          JSON.stringify(error.data);
          // console.error(error.data); // eslint-disable-line no-console
        });
    },
    getAssignedDocs() {
      const data1 = JSON.stringify({
        method: 'getAllAssigned',
      });
      axios.post('https://nickotest.000webhostapp.com/api/get_docs.php', data1)
        .then((response) => {
          if (response.status === 200) {
            // console.log(response.data); // eslint-disable-line no-console
            this.assigned = response.data;
            if (this.allDocs.length !== 0) {
              this.allDocs.forEach((element1) => {
                let flag = false;
                this.assigned.forEach((element2) => {
                  if (element1.id === element2.doctor_id) {
                    flag = true;
                  }
                });
                if (!flag) {
                  this.unassignedDocs.push(element1);
                } else {
                  this.assignedDocs.push(element1);
                }
              });
            }
            this.showProgress = false;
          }
        })
        .catch((error) => {
          console.error(error.data); // eslint-disable-line no-console
        });
    },
    showInfoDialog(id) {
      this.docInfo = this.allDocs.find(obj => obj.id === id);
      this.infoDialog = true;
    },
    showPatientDialog(id) {
      const pData = JSON.stringify({
        req: 'getAllMy',
        d_id: id,
      });
      axios.post('https://nickotest.000webhostapp.com/api/get_patient.php', pData)
        .then((response) => {
          this.patients = response.data;
          this.patientDialog = true;
        });
    },
    getUnassignedPatients(dId) {
      const data1 = JSON.stringify({
        req: 'getAllUnassigned',
      });
      axios.post('https://nickotest.000webhostapp.com/api/get_patient.php', data1)
        .then((response) => {
          this.unassignedPatients = response.data;
          this.docId = dId;
          this.unassignedPatientDialog = true;
        });
    },
    assignPatient(pId, dId) {
      const data1 = JSON.stringify({
        method: 'assignDoctor',
        p_id: pId,
        d_id: dId,
      });
      axios.post('https://nickotest.000webhostapp.com/api/create_assignments.php', data1)
        .then((response) => {
          if (response.status === 200) {
            this.unassignedPatients = this.unassignedPatients.filter(obj => obj.patient_id !== pId);
          }
        });
    },
  },
};
</script>
