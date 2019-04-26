<template>
  <v-app>
    
  <v-toolbar class="v-toolbar v-toolbar--clipped v-toolbar--fixed theme--dark red elevation-6" height="50" style="margin-top:0px;padding-right:0px;padding-left:0px;transform:translateY(0px);">
    <v-layout>
            <v-flex v-if="window.width > 600" headline xs12 sm1 md2 mr-2></v-flex>
            <v-flex headline xs3 sm1 md3>{{this.HeaderTxt}}</v-flex>
          <v-flex v-if="window.width < 600" title xs5 sm1 md4 mt-2 mr-3 class="text-xs-center">{{moment(myDate).format('DD / MM / YYYY')}}</v-flex>
          <v-flex v-if="window.width > 600" headline xs5 sm1 md4 mr-3 class="text-xs-center">{{moment(myDate).format('DD / MM / YYYY')}}</v-flex>
          <v-flex v-if="window.width > 600" xs3 sm1 md3 headline mr-3 class="text-xs-right"><span><digital-clock :blink="true"/></span></v-flex>
                <v-flex xs3 sm1 md1>
                  <v-btn-toggle v-model="toggle_exclusive">
                    <v-btn small  color="blue">Pending</v-btn>
                    <v-btn small color="blue">Ago</v-btn>
                  </v-btn-toggle>
                </v-flex>
    </v-layout>
  </v-toolbar>

  <v-navigation-drawer class="grey darken-4" app dark permanent fixed hide-overlay width="250">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/de/Yamaha_Motor_logo.svg/1280px-Yamaha_Motor_logo.svg.png" width="230" height="60">
      <v-list>
        <v-list-tile avatar>
          <v-list-tile-avatar>
            <img src="https://cmkt-image-prd.global.ssl.fastly.net/0.1.0/ps/1402451/1160/772/m1/fpnw/wm0/mechanic-avatar-icon-flat-01-.jpg?1467032839&s=1661b6ffa5d32fa4b2c3eb17980c818d">
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title>Ing Racing</v-list-tile-title>
              <h6># Online</h6>
            </v-list-tile-content>
            <v-btn dark icon @click.stop="dialog_Morword= true">
              <v-icon>more_vert</v-icon>
            </v-btn>
        </v-list-tile>
      </v-list>

      <v-list class="pt-0" dense>
        <v-divider class="green accent-4"></v-divider>
          <v-list-tile v-for="item in items" @click="changeName(item.name)" :key="item.key" :to="item.link" :name="item.name">
            <v-flex mt-3>
              {{item.title}}
                <v-badge v-if="badge == true " color="red">
                  <template v-slot:badge v-if="update == true">
                      <span>!</span>
                  </template>
                      <v-icon color="yellow" v-if="update == true">{{item.icon}}</v-icon>
                </v-badge>
            </v-flex>
              <h1>></h1>
          </v-list-tile>
      </v-list>
  </v-navigation-drawer>

  <main v-if="window.width < 600" class="v-content" style="padding: 47px 0px 0px 0px;">
    <router-view/>
  </main>
  <main v-if="window.width > 600" class="v-content" style="padding: 47px 0px 0px 250px;">
    <router-view/>
  </main>

    <v-dialog v-model="dialog_Morword" max-width="350">
      <v-card>
        <v-list>
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
            </v-list-tile-avatar>
                  
            <v-list-tile-content>
              <v-list-tile-title>Phonsiri Sirichai</v-list-tile-title>
              <v-list-tile-sub-title>Customer</v-list-tile-sub-title>
            </v-list-tile-content>
                  
            <v-list-tile-action>
              <v-btn color="blue" icon flat @click="dialog_Adminlogout = true"><v-icon>logout</v-icon></v-btn>
            </v-list-tile-action>
          </v-list-tile>
                           
        </v-list>
        <v-divider></v-divider>

          <v-card-text>
            <v-list-tile-title>Phonsiri Sirichai</v-list-tile-title>
            <v-list-tile-title  v-for="(item,i) in items_Cars" :key="i">Car {{i+1}}:{{items_Cars}}</v-list-tile-title>
          </v-card-text>
          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" flat @click="dialog_Morword = false">OK</v-btn>
          </v-card-actions>
                   
      </v-card>
    </v-dialog>

    <v-dialog v-model="dialog_Adminlogout" max-width="300">
      <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>F&I Garage</v-card-title>
        <v-card-text>Do you want to logout?</v-card-text>
        <v-card-actions><v-spacer></v-spacer>
          <v-btn color="blue white--text" @click="dialog_Adminlogout = false">No</v-btn>
          <v-btn color="blue white--text" @click="dialog_Adminlogout = false,dialog_Morword = false,Queue = false , login =true" >Yes</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-app>
</template>


<script>
// eslint-disable-next-line no-unused-vars
import Vuetify from 'vuetify'
// eslint-disable-next-line no-unused-vars
import Vue from 'vue'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import DigitalClock from 'vue-digital-clock';
import moment from 'moment'
import Clock from 'vue-clock2'
// eslint-disable-next-line import/no-unresolved
import Login from './views/Login.vue'
// eslint-disable-next-line import/no-unresolved
import Queue from './views/Queue.vue'
// eslint-disable-next-line import/no-unresolved
import Customer from './views/Customer.vue'
// eslint-disable-next-line import/no-unresolved
import Mechanic from './views/Mechanic.vue'
// eslint-disable-next-line no-unused-vars
// eslint-disable-next-line import/no-unresolved
import MechanicUse from './views/MechanicUse.vue'
// eslint-disable-next-line import/no-unresolved
import Cars from './views/Cars.vue'
// eslint-disable-next-line import/no-unresolved
import Celender from './views/Celenders.vue'
// eslint-disable-next-line import/no-unresolved
import History from './views/History.vue'
// eslint-disable-next-line import/no-unresolved
import CustomerUse from './views/CustomerUse.vue'
// eslint-disable-next-line import/no-unresolved
import website from './views/website.vue'
// import login from './views/Login.vue'
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
    // eslint-disable-next-line no-undef
    // eslint-disable-next-line vue/no-unused-components
    Login,
    DigitalClock,
    website,
    // eslint-disable-next-line vue/no-unused-components

  },
  data2: () => ({
    items2: ['Foo', 'Bar', 'Fizz', 'Buzz'],
    cruds: [
      ['Create', 'add'],
    ],
  }),
  mounted() {
    console.log(this.$vuetify.breakpoint)
  },
  data() {
    return {
      HeaderTxt: '',
      toggle_exclusive: 0,
      drawer: true,
      myDate: null,
      dialog_Morword: false,
      dialog_Adminlogout: false,
      update: true,
      // website: true,
      login: true,
      // QrcodeReader: true,
      // CustomerUse: true,
      // Mechanicle: true,
      // Queue: true,

      window: {
        width: 0,
        height: 0,
      },

      items: [{
        key: 'Queue',
        title: 'Qeue Management',
        icon: 'mail',
        link: '/Queue',
        name: 'Queue',
        badge: true,
      },
      {
        key: 'Customer',
        title: 'Customer Ser',
        // icon: 'label',
        link: '/Customer',
        name: 'Customer',
      },
      {
        key: 'Mechanic',
        title: 'Mechanic',
        // icon: 'label',
        link: '/Mechanic',
        name: 'Mechanic',
      },
      {
        key: 'Cars',
        title: 'Cars in stock',
        // icon: 'label',
        link: '/Cars',
        name: 'Cars',
      },
      {
        key: 'Celender',
        title: 'Celenders work',
        // icon: 'label',
        link: '/Celenders',
        name: 'Celenders',
      },
      {
        key: 'History',
        title: 'History',
        // icon: 'label',
        link: '/History',
        name: 'History',
      },
      ],
      items2: ['Foo', 'Bar', 'Fizz', 'Buzz'],
      right: null,
    }
  },
  created() {
    window.addEventListener('resize', this.handleResize)
    this.handleResize();
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  },
  methods: {
    moment() {
      return moment();
    },
    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
    changeName(name) {
      console.log(`name=${name}`)
      console.log(`before update=${this.HeaderTxt}`)
      this.HeaderTxt = null
      this.HeaderTxt = name
    },
  },
}
</script>
