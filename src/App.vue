<template>
<div style=".overflow { margin-left: -17px; }">
  <transition name="component-fade" mode="out-in">
              <component v-bind:is="Store.display_page"></component>
  </transition>
</div>

</template>

<script>
import Vue from 'vue'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import DigitalClock from 'vue-digital-clock';
import moment from 'moment'
import Clock from 'vue-clock2'
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'
import Axios from 'axios'
import VueSession from 'vue-session'
import Login from './views/Login.vue'
import Queue from './views/Queue.vue'
import Customer from './views/Customer.vue'
import Mechanic from './views/Mechanic.vue'
import MechanicUse from './views/MechanicUse.vue'
import Cars from './views/Cars.vue'
import Celender from './views/Celenders.vue'
import History from './views/History.vue'
import CustomerUse from './views/CustomerUse.vue'
import AdminPage from './views/Homepage.vue'
// import login from './views/Login.vue'
Vue.use(VueSession)

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
    // eslint-disable-next-line vue/no-unused-components
    Queue,
    // eslint-disable-next-line vue/no-unused-components
    CustomerUse,
    // eslint-disable-next-line vue/no-unused-components
    Customer,
    // eslint-disable-next-line vue/no-unused-components
    Cars,
    // eslint-disable-next-line vue/no-unused-components
    Mechanic,
    // eslint-disable-next-line vue/no-unused-components
    MechanicUse,
    // eslint-disable-next-line vue/no-unused-components
    Celender,
    // eslint-disable-next-line vue/no-unused-components
    History,
    // eslint-disable-next-line vue/no-unused-components
    AdminPage,
    // eslint-disable-next-line vue/no-unused-components
    // eslint-disable-next-line no-undef
    // eslint-disable-next-line vue/no-unused-components
    Login,
    // eslint-disable-next-line vue/no-unused-components
    QrcodeStream,
    // eslint-disable-next-line vue/no-unused-components
    QrcodeDropZone,
    // eslint-disable-next-line vue/no-unused-components
    QrcodeCapture,
  },
  mounted() {
    console.log(this.$vuetify.breakpoint)
  },

  data() {
    return {
      valid: true,
      Store: this.$store.state,
      HeaderTxt: '',
      PageName: 'Login',
      toggle_exclusive: 0,
      drawer: true,
      myDate: null,
      dialog_Morword: false,
      dialog_Adminlogout: false,
      fromLogin: false,
      alertInsert: false,
      ErrorInsert: false,
      dialogQrcode: '',
      login_data: [{
        username: '',
        password: '',
      }],
      booking: [{
        name: null,
        lastname: null,
        lineID: null,
        tel: null,
        Email: null,
        car_brand: null,
        car_model: null,
        car_year: null,
        broken_desc: null,
        come_in_date: null,
      }],
      login: true,
      paused: true,
      test: this.$store.state.display_page,
    }
  },
  watch: {
    test() {
      if (this.test === 'Login') { this.PageName = 'Login' }
      if (this.test === 'MechanicUse') { this.PageName = 'MechanicUse' }
      if (this.test === 'CustomerUse') { this.PageName = 'CustomerUse' }
      if (this.test === 'AdminPage') { this.PageName = 'AdminPage' }
    },
  },

  created() {
    if (this.$session.get('usersloggedin')) {
      alert(this.$session.get('userType'))
      if (this.$session.get('userType') === 'Admin') {
        this.Store.display_page = 'AdminPage'
      } else if (this.$session.get('userType') === 'Customer') {
        this.Store.display_page = 'CustomerUse'
      } else if (this.$session.get('userType') === 'Employee') {
        this.Store.display_page = 'MechanicUse'
      }
      this.Store.IDforSELECT = this.$session.get('usersloggedin')
    } else {
      alert('not found user')
    }
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  },


  methods: {
    testdata() {
      this.test = this.Store.display_page
    },
    moment() {
      return moment();
    },

    changeName(name) {
      console.log(`name=${name}`)
      console.log(`before update=${this.HeaderTxt}`)
      this.HeaderTxt = null
      this.HeaderTxt = name
    },

    checkUser() {
      console.log('in methods')
      const api = 'https://testtingfuck.000webhostapp.com/checklogin.php';

      // // eslint-disable-next-line no-var
      // // eslint-disable-next-line vars-on-top
      const LoginParams = new URLSearchParams();

      LoginParams.append('username', this.login_data.username)
      LoginParams.append('password', this.login_data.password)
      // eslint-disable-next-line global-require
      Axios.post(api, LoginParams)
        .then((response) => {
          const readData = response.data
          console.log('loooooop =', readData.length)
          console.log(response.data[0].User_Type)
          // eslint-disable-next-line eqeqeq
          if (readData.length === 0) {
            console.log('wrong pass or username')
            alert('Wrong pass or username,Please try again')
          } else if (readData !== 0) {
            // router.push('/about');
            this.$session.start()
            const Utype = response.data[0].User_Type
            this.Store.User_type_store = Utype
            console.log(response.data[0].User_Type)
            if (Utype === 'Admin') {
              this.Store.display_page = 'AdminPage'
            } else if (Utype === 'Customer') {
              this.Store.display_page = 'CustomerUse'
            } else if (Utype === 'Employee') {
              this.Store.display_page = 'MechanicUse'
            }

            this.$session.set('usersloggedin', response.data[0].Owner_ID)
            this.$session.set('userType', Utype)

            this.Store.IDforSELECT = response.data[0].Owner_ID
            console.log(`store id=${this.Store.IDforSELECT}`)
            this.Store.login_page = false
          }
        })
    },

    insert_booking() {
      console.log('in methods')
      const api = 'https://testtingfuck.000webhostapp.com/Booking.php';
      console.log(this.booking)
      alert('asdsadsaads')
      const booking_params = new URLSearchParams();

      booking_params.append('name', this.booking.name)
      booking_params.append('lastname', this.booking.lastname)
      booking_params.append('lineID', this.booking.lineID)
      booking_params.append('tel', this.booking.tel)
      booking_params.append('Email', this.booking.Email)
      booking_params.append('car_brand', this.booking.car_brand)
      booking_params.append('car_model', this.booking.car_model)
      booking_params.append('car_year', this.booking.car_year)
      booking_params.append('come_in_date', '20190416')
      booking_params.append('broken_desc', this.booking.broken_desc)

      Axios.post(api, booking_params)
        .then((response) => {
          const readData = response.data
          console.log(response.data)
          if (response.data === 1) {
            this.alertInsert = true
          } else {
            this.ErrorInsert = true
          }
        })
    },

  },
}
</script>
