<template>
<div>
    <v-app>
        <v-toolbar class="v-toolbar v-toolbar--fixed theme--dark red elevation-6" height="50" style="margin-top:0px;padding-right:0px;padding-left:0px;transform:translateY(0px);">
            <v-layout v-if="window.width > 1200">

                <v-flex style="padding: 0px 30px 0px 0px;"></v-flex>
                <v-flex xs3 sm3 md3>
                    <h1>{{this.HeaderTxt}} </h1>
                </v-flex>

                <v-flex xs3 sm3 md3 font-weight-black font-italic class="text-xs-center">
                    <h1><span><digital-clock :blink="true"/></span></h1>
                </v-flex>
                <v-flex class="text-xs-right">
                    <h1>{{moment(myDate).format('DD / MM / YYYY')}}</h1>
                </v-flex>

            </v-layout>
            <v-layout v-else-if="window.width < 1200 && window.width > 500">

                <v-flex xs4 sm4 md4>
                    <h1>{{this.HeaderTxt}} </h1>
                </v-flex>

                <v-flex xs4 sm4 md4 class="text-xs-center">
                    <v-layout justify-center>
                        <!-- <h1>{{moment(myDate).format('DD / MM / YYYY')}}</h1> -->
                    </v-layout>
                </v-flex>
                <v-flex xs4 sm4 md4 headline font-weight-black font-italic class="text-xs-right"><span><digital-clock :blink="true"/></span></v-flex>
            </v-layout>
            <v-layout v-if="window.width < 700">

                <v-flex xs5 sm5 md5>
                    <h2>{{this.HeaderTxt}} {{window.width}}</h2>
                </v-flex>

            </v-layout>
            <v-btn dark icon @click.stop="dialog_Morword= true">
                <v-icon>more_vert</v-icon>
            </v-btn>
        </v-toolbar>


        <v-navigation-drawer v-model="drawer" class="grey darken-4" dark fixed hide-overlay width="250">
            <v-flex mt-2 mb-1>
                <v-layout justify-center>
                    <img src="https://testtingfuck.000webhostapp.com/imageLogo/ForBgDark.png" width="240" height="80">
                </v-layout>
            </v-flex>
            <v-divider></v-divider>
            <v-divider></v-divider>
            <v-list>
                <v-list-tile avatar>
                    <v-list-tile-avatar>
                        <v-flex ml-1>
                            <v-icon size="45">account_circle</v-icon>
                        </v-flex>
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>{{this.UserData[0].Emp_Name}} {{this.UserData[0].Emp_Lname}}</v-list-tile-title>
                        <h6 class="blue--text"># Online</h6>
                    </v-list-tile-content>
                    <v-btn dark icon @click.stop="dialog_Morword= true">
                        <v-icon>more_vert</v-icon>
                    </v-btn>
                </v-list-tile>
                <v-divider class="grey darken-4 pt-1"></v-divider>
                <v-divider></v-divider>
                <v-divider></v-divider>
            </v-list>

            <v-list class="pt-0">

                <v-list-tile v-for="item in items" @click="changeName(item.name)" :key="item.key" :to="item.link" :name="item.name">
                    <v-flex>
                        <h3>
                            <v-icon size="23" style="padding:0px 4px 0px 0px">{{item.icon}} </v-icon>
                            {{item.title}}
                        </h3>
                    </v-flex>
                    <h1>></h1>
                </v-list-tile>
            </v-list>
                  <v-btn v-if="window.width < 1200" color="yellow" class="black--text" bottom right small fab fixed style="border-radius: 60px 0px 0px 60px" @click.stop="drawer = !drawer">
                    <<
                  </v-btn>
        </v-navigation-drawer>

          <main class="v-content" style="padding: 47px 0px 0px 0px;" width="100%">
              <v-layout v-if="window.width > 1200" style="padding: 0px 0px 0px 251px;" justify-start>
                  <router-view />
              </v-layout>
              <v-layout v-if="window.width < 1200" style="padding: 0px 0px 0px 0px;" justify-start>
                  <router-view />
                  <v-btn color="yellow" bottom small fab fixed style="border-radius: 0px 60px 60px 0px" @click.stop="drawer = !drawer">
                    >>
                  </v-btn>
              </v-layout>

          </main>
   
        <v-dialog v-model="dialog_Morword" max-width="350">
            <v-card>
                <v-list class="grey darken-4 white--text">
                    <v-list-tile avatar>
                        <v-list-tile-avatar>
                            <v-icon color="red" size="45">account_circle</v-icon>
                        </v-list-tile-avatar>

                        <v-list-tile-content>
                            <v-list-tile-title><b>{{Display_user_nav.fullname}} </b> ({{Display_user_nav.nickname}})</v-list-tile-title>
                            <v-list-tile-sub-title class="white--text">สิทธิ์การเข้าถึง :{{Store.User_type_store}} </v-list-tile-sub-title>
                        </v-list-tile-content>

                        <v-list-tile-action>
                            <v-btn color="blue" icon flat @click="log_out()">
                                <v-icon>logout</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-list-tile>

                </v-list>
                <v-divider></v-divider>

                <v-card-text class="grey lighten-3">
                    <v-list-tile-title>รหัสพนักงาน:{{UserData[0].Emp_ID}}</v-list-tile-title>
                    <!-- <v-list-tile-title  v-for="(item,i) in items_Cars" :key="i">Car {{i+1}}:{{items_Cars}}</v-list-tile-title> -->
                </v-card-text>
                <v-divider></v-divider>

                <v-card-actions class="grey lighten-3">
                    <v-spacer></v-spacer>
                    <v-btn color="red" style="border-radius:40px 0px 40px 0px" @click="dialog_Morword = false">OK</v-btn>
                </v-card-actions>

            </v-card>
        </v-dialog>

        <v-dialog v-model="dialog_Adminlogout" max-width="300">
            <v-card>
                <v-card-title class="headline grey lighten-2" primary-title>F&I Garage</v-card-title>
                <v-card-text>Do you want to logout?</v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue white--text" @click="dialog_Adminlogout = false">No</v-btn>
                    <v-btn color="blue white--text" @click="log_out()">Yes</v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-app>
</div>
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
import Axios from 'axios';
// eslint-disable-next-line no-unused-vars
import VueDaterangePicker from 'vue-daterange-picker';
// eslint-disable-next-line no-unused-vars
import VueSession from 'vue-session'
import VueAWN from 'vue-awesome-notifications'
import Login from './Login.vue'
import Queue from './Queue.vue'
import Customer from './Customer.vue'
import Mechanic from './Mechanic.vue'
// eslint-disable-next-line no-unused-vars
import MechanicUse from './MechanicUse.vue'
import Cars from './Cars.vue'
import Celender from './Celenders.vue'
import History from './History.vue'
import CustomerUse from './CustomerUse.vue';
import store from '../store'

Vue.use(VueSession)
Vue.use(VueAWN)
// import login from './views/Login.vue'
export default {
    components: {
        // eslint-disable-next-line vue/no-unused-components
        Clock,
        // eslint-disable-next-line vue/no-unused-components
        Queue,
        // eslint-disable-next-line vue/no-unused-components
        VueAWN,
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
        // eslint-disable-next-line vue/no-unused-components
        // eslint-disable-next-line no-undef
        // eslint-disable-next-line vue/no-unused-components
        Login,
        DigitalClock,
        // eslint-disable-next-line vue/no-unused-components

    },
    data() {
        return {
            Store: this.$store.state,
            HeaderTxt: '',
            UserData: [],
            toggle_exclusive: 0,
            drawer: null,
            myDate: null,
            mini: false,
            right: null,
            dialog_Morword: false,
            dialog_Adminlogout: false,
            fromLogin: false,
            alert: false,
            Display_user_nav: [{
                fullname: '',
                nickname: '',

            }],
            // update: true,
            // website: true,
            // login: true,
            // QrcodeReader: true,
            // CustomerUse: true,
            // Mechanicle: true,
            Queue: true,

            window: {
                width: 0,
                height: 0,
            },

            items: [{
                    key: 'Queue',
                    title: 'Qeue Management',
                    icon: 'developer_board',
                    link: '/Queue',
                    name: 'Queue',
                    badge: true,

                },
                {
                    key: 'Customer',
                    title: 'Customer',
                    icon: 'person',
                    link: '/Customer',
                    name: 'Customer',
                },
                {
                    key: 'Mechanic',
                    title: 'Employee',
                    icon: 'assignment_ind',
                    link: '/Mechanic',
                    name: 'Mechanic',
                },
                {
                    key: 'Cars',
                    title: 'Work in process',
                    icon: 'directions_car',
                    link: '/Cars',
                    name: 'Cars',
                },
                // {
                //   // key: 'Celender',
                //   // title: 'Celenders work',
                //   // // icon: 'label',
                //   // link: '/Celenders',
                //   // name: 'Celenders',
                // },
                // {
                //   // key: 'History',
                //   // title: 'History',
                //   // // icon: 'label',
                //   // link: '/History',
                //   // name: 'History',
                // },
            ],
        }
    },

    mounted() {
        const a = this.Store.IDforSELECT;
        // alert(a)
        const api = 'https://testtingfuck.000webhostapp.com/data_user_select.php';
        const user_data_params = new URLSearchParams();
        user_data_params.append('Table', 'Employee')
        user_data_params.append('Colname', 'Emp_ID')
        user_data_params.append('ID', this.Store.IDforSELECT)

        Axios.post(api, user_data_params)
            .then((response) => {
                this.UserData = response.data
                // console.log('select data = ')
                // console.log(this.UserData)
                this.Display_user_nav.fullname = `${this.UserData[0].Emp_Name} ${this.UserData[0].Emp_Lname}`
                this.Display_user_nav.nickname = this.UserData[0].Nickname
                console.log('dataUser :', this.UserData)
            })

        console.log(this.$vuetify.breakpoint)
    },

    beforeCreate() {
        const api_booking = 'https://testtingfuck.000webhostapp.com/select_display_booking.php';

        Axios.post(api_booking)
            .then((response) => {
                this.Store.data_dis_booking = response.data
                // console.log(this.Store.data_dis_booking)
            })
    },
    created() {
        window.addEventListener('resize', this.handleResize)
        this.handleResize();
    },
    destroyed() {
        window.removeEventListener('resize', this.handleResize)
    },
    methods: {
        log_out() {
            this.$session.clear()
            this.$session.destroy()
            this.Store.display_page = 'Login'
            this.dialog_Morword = false
        },
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

    onChangeFileUpload(fileInput) {
        this.file = fileInput
        this.addDataImg(this.Store.IDforSELECT)
    },
}
</script>
