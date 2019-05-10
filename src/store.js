import Vue from 'vue';
import Vuex from 'vuex';
import pathify from 'vuex-pathify';
import { make } from 'vuex-pathify';


pathify.options.mapping = 'simple';

const staticState = {
  data: '',
  Username: '',
  IDforSELECT: '',
  User_type_store: '',
  data_dis_booking: [],
  Queue_page: false,
  Mechanicle_page: false,
  CustomerUse_page: false,
  login_page: true,
  display_page: 'Login',
  item_wid_delete: '',
  pdfData: '',

};

// initial state
const state = Object.assign(staticState);
// console.log(staticState.msgLogin)

const mutations = make.mutations(state);
const resetMutation = {
  resetState(state) {
    Object.assign(state, getDefaultState());
    // state = {
    //   ...state,
    //   ...getDefaultState()
    // }
  },
};
Object.assign(mutations, resetMutation);

const actions = make.actions(state);
const getters = make.getters(state);

// use store
Vue.use(Vuex);


// create store
export default new Vuex.Store({
  modules: {

  },
  // use the plugin
  plugins: [
    pathify.plugin,
  ],
  // store properties
  state,
  mutations,
  actions,
  getters,
});
