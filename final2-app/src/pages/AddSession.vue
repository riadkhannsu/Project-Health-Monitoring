<template>
  <q-page>
    <div class="col-4 text-center">
      <div style="margin: 20px 5px;" class="text-center">
        <h6>New Session</h6>
      </div>
    </div>

    <div class="row q-ma-sm">
      <div class="col-12">
        <div class="text-center col-12">
          Bluetooth devices detected
        </div>
        <q-list bordered>
          <q-item v-for="(device, i) in devices" v-bind:key="i" @click.prevent="connect(device)" clickable v-ripple>
            <q-item-section>
              <q-item-label>
                <q-icon color="primary" name="bluetooth" />
              </q-item-label>
            </q-item-section>
            <q-item-section>
              {{device.name}}
            </q-item-section>
          </q-item>
        </q-list>
      </div>
    </div>

    <div class="row">
      <div class="col-12 q-ma-sm">
        <h5 class="text-center text-weight-light">Data: </h5>
      </div>
      <div class="col-12 q-ma-sm">
        <h5 class="text-center">{{this.msg}}</h5>
      </div>
    </div>
    <div class=" row">
      <div class="col-12 text-center q-ma-sm">
        <q-btn color="white" text-color="black" label="get readings" @click.prevent="readSerial" />
      </div>
    </div>
    <div class="row">
      <div class="col-12 text-center q-ma-sm">
        <q-btn color="white" text-color="black" label="stop" @click.prevent="stopData" />
      </div>
    </div>
    <q-page-sticky position="bottom-right" :offset="[18, 18]">
      <q-btn fab icon="keyboard_backspace" color="red" @click="goBack"/>
    </q-page-sticky>
  </q-page>
</template>

<script>
import bluetoothSerial from '../../src-cordova/node_modules/cordova-plugin-bluetooth-serial/www/bluetoothSerial'

export default {
  mounted () {
    document.addEventListener('deviceready', () => {
      bluetoothSerial.isEnabled(
        () => {
          bluetoothSerial.list(devices => {
            this.devices = devices
          })
        },
        () => {
          alert('Bluetooth is not enabled!')
        }
      )
    })
  },
  name: 'AddSession',
  methods: {
    goBack (evt) {
      evt.preventDefault()
      this.$router.replace('/patientdash')
    },
    async connect (device) {
      this.loading = true
      await bluetoothSerial.isConnected(
        async () => {
          await bluetoothSerial.disconnect(this.connected.id)
          this.connected = null
        }
      )
      bluetoothSerial.connect(
        device.id,
        () => {
          this.connected = device
          this.loading = false
          alert('Connection established')
        },
        () => {
          this.loading = false
          alert('Can not connect to selected device')
        })
    },
    readSerial () {
      this.msg = ''
      this.interval = setInterval(this.getData, 30)
    },
    getData () {
      bluetoothSerial.read((data) => {
        this.msg = data
      },
      this.msg = '__'
      )
    },
    stopData () {
      clearInterval(this.interval)
    }
  },
  data () {
    return {
      showForm: true,
      msg: '',
      details: '',
      weekdays: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturay'
      ],
      devices: [],
      dataPoints: [],
      connected: false,
      loading: false
    }
  }
}
</script>
