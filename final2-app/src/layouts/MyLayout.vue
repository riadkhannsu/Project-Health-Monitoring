<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>

        <q-toolbar-title class="text-weight-thin">
          +Cloud<span class="text-weight-bold">Health</span>
        </q-toolbar-title>

        <q-btn
          flat
          dense
          round
          @click="leftDrawerOpen = !leftDrawerOpen"
          icon="menu"
          aria-label="Menu"
        />
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      content-class="bg-grey-2"
    >
      <q-list>
        <q-item-label header>Essential Links</q-item-label>
        <q-item clickable tag="a" target="_blank" href="#">
          <q-item-section avatar>
            <q-icon name="notification_important" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Notifications</q-item-label>
            <q-item-label caption>All the lastest updates you need</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable tag="a" target="_blank" href="#">
          <q-item-section avatar>
            <q-icon name="account_circle" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Update Info</q-item-label>
            <q-item-label caption>update your personal information</q-item-label>
          </q-item-section>
        </q-item>
        <q-item clickable tag="a" target="_blank" href="#">
          <q-item-section avatar>
            <q-icon name="perm_phone_msg" />
          </q-item-section>
          <q-item-section>
            <q-item-label>Contact Us</q-item-label>
            <q-item-label caption>Get in touch with us to know more</q-item-label>
          </q-item-section>
        </q-item>
        <q-item tag="a" target="_blank" href="#">
          <q-btn icon="power_settings_new" color="black" label="Sign Out" style="width: 100%" @click="SignOut"/>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script>
export default {
  name: 'MyLayout',

  data () {
    return {
      leftDrawerOpen: false
    }
  },
  methods: {
    SignOut (evt) {
      evt.preventDefault()
      localStorage.removeItem('jwt')
      localStorage.removeItem('id')
      localStorage.removeItem('fname')
      localStorage.removeItem('type')
      this.$router.replace('/')
    }
  }
}
</script>
<style scoped>
.q-layout {
  background-image: linear-gradient(15deg, #051e3e , #051e3e);
  color:white;
}
.q-toolbar {
  background: #051e3e ;
}
.q-drawer {
  background: linear-gradient(0deg, #451e3e , #051e3e);
}
</style>
