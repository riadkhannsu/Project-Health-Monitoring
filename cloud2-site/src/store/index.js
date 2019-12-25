import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    loggedIn: false,
  },
  mutations: {
    signIn(state, val) {
      state.loggedIn = val;
    },
    signOut(state, val) {
      state.loggedIn = val;
    },
  },
  actions: {
    logIn({ commit }, n) {
      localStorage.setItem('jwt', n.data.jwt);
      localStorage.setItem('id', n.data.user);
      localStorage.setItem('firstname', n.data.name);
      commit('signIn', true);
    },
    logOut({ commit }) {
      localStorage.clear();
      commit('signOut', false);
    },
    forceIn({ commit }) {
      commit('signIn', true);
    },
  },
  getters: {
    isLoggedIn: state => state.loggedIn,
  },
  modules: {
  },
});
