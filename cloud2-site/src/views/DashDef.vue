<template>
  <div class="text-center">
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
      <p class="blue--text">Welcome to your dashboard, {{admin}}</p>
      <v-row>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="primary">
              Total Users : {{totalPatients.length + totalDoctors.length}}
            </v-chip>
          </div>
        </v-col>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="green" text-color="white">
              Total Patients : {{" " + totalPatients.length}}
            </v-chip>
          </div>
        </v-col>
        <v-col cols="12" sm="4">
          <div>
            <v-chip class="ma-2 px-4" color="orange" text-color="white">
              Total Doctors : {{" " + totalDoctors.length}}
            </v-chip>
          </div>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12" sm="6">
          <v-chip class="ma-2 px-8" color="green" text-color="white">
            New this month : {{totalPatients.length}}
          </v-chip>
        </v-col>
        <v-col cols="12" sm="6">
          <v-chip class="ma-2 px-8" color="green" text-color="white">
            New this week : {{totalPatients.length}}
          </v-chip>
        </v-col>
      </v-row>
    </div>

  </div>
</template>

<script>
// @ is an alias to /src
import axios from 'axios';

export default {
  name: 'DashDef',
  mounted() {
    this.showProgress = true;
    const data = JSON.stringify({
      req: 'getAll',
    });
    axios.post('https://nickotest.000webhostapp.com/api/get_patient.php', data)
      .then((response) => {
        if (response.status === 200) {
          //  console.log(response.data); // eslint-disable-line no-console
          this.totalPatients = response.data;
        }
      })
      .catch((error) => {
        console.error(error.data);
      });
    const data1 = JSON.stringify({
      method: 'getAll',
    });
    axios.post('https://nickotest.000webhostapp.com/api/get_docs.php', data1)
      .then((response) => {
        if (response.status === 200) {
          //  console.log(response.data); // eslint-disable-line no-console
          this.totalDoctors = response.data;
          this.showProgress = false;
        }
      })
      .catch((error) => {
        console.error(error.data);
      });
  },
  components: {
  },
  data() {
    return {
      admin: localStorage.getItem('firstname'),
      totalPatients: [],
      totalDoctors: [],
      showProgress: true,
    };
  },
};
</script>
