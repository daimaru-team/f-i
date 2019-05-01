<template>
  <v-app>
    <div>
      <v-toolbar class="v-toolbar--fixed theme--dark red elevation-6">
        <v-flex title>
          F&I Garage
        </v-flex>
        <h3>Username</h3>
        <v-avatar>
          <v-btn icon @click.stop="dialog_Detail= true">
            <img src="https://randomuser.me/api/portraits/men/1.jpg" width="30" height="20">
          </v-btn>
        </v-avatar>
        <v-btn dark icon @click.stop="dialog_Detail= true">
          <v-icon>more_vert</v-icon>
        </v-btn>
      </v-toolbar>

      <v-card height="60"></v-card>
      <main class="v-content__wrap" full-hight>
        <v-expansion-panel focusable>
          <v-expansion-panel-content v-for="(item,i) in 3" :key="i">
            <template v-slot:header>
              <div><h3>Toyota Revo 2.4J<v-icon color="amber accent-4">mail</v-icon></h3></div>
            </template>
        <v-card color="grey lighten-3">
          <v-tooltip left color="blue">
            <template v-slot:activator="{ on }">
                <v-btn fab dark fixed right color="blue" v-on="on" style="margin-top:10px;" @click.stop = "dialog_Chat= true">
                      <v-icon dark>chat</v-icon>
                </v-btn>
            </template>
            <span>ส่งข้อความเพื่อสื่อสารกับช่าง</span>
           </v-tooltip>
            <v-card-text class="grey lighten-3">
              <p><b> Car :</b> Toyota  </p>
              <p><b> รุ่น :</b> Revo 2.4L </p>
              <p><b> ปี :</b> 2014</p>
              <p><b> ทะเบียน :</b> 61160 </p>
              <p><b> อาการ/สาเหตุ :</b> สตาร์ทไม่ติด คล้ายไฟไม่ชาจต์</p>
              <p><b> ช่างผู้รับผิดชอบ :</b> M.Phonpisud Sumangsa</p>
              <p><b> วันเริ่มงาน :</b> 13/12/2561</p>
              <p><b> วันส่งงาน :</b> 13/12/2561</p>
               <p><b> Status :</b> อยู่ระหว่างดำเนินการ
                <!-- สถานะเสร็จ -->
                <v-icon v-if="1==1" color="amber accent-4" >error</v-icon>
                <!-- สถานะยังไม่เสร็จ -->
                <v-icon v-if="0==1" color="green">offline_pin</v-icon>
              </p>
            </v-card-text>
                  <v-flex xs12 class="text-xs-center">
                    <v-card dark color="blue darken-3">
                      <v-card-text class="px-0"><h2>Timeline</h2> </v-card-text>
                    </v-card>
                  </v-flex>
          <v-flex mt-1>
            <v-layout justify-center>
            <v-card max-width="1000px">
              <v-flex ml-3 mr-3>
                <v-timeline dense clipped>
                  <v-slide-x-transition group>
                    <v-timeline-item v-for="event in timeline" :key="event.id" class="mb-3" color="pink" small>
                      <v-layout justify-space-between>
                        <v-flex xs7 v-text="event.text"></v-flex>
                        <v-flex xs5 text-xs-right v-text="event.time"></v-flex>
                      </v-layout>
                    </v-timeline-item>
                  </v-slide-x-transition>

                  <v-timeline-item class="mb-4" hide-dot>
                    <span>TODAY</span>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" color="grey" icon-color="grey lighten-2" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>This order was archived.</v-flex>
                      <v-flex xs5 text-xs-right>15:26 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        <v-chip class="white--text ml-0" color="purple" label small>
                          APP
                        </v-chip>
                        Digital Downloads fulfilled 1 item.
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" color="grey" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        Order confirmation email was sent to John Leider (john@vuetifyjs.com).
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" hide-dot>
                    <v-btn class="mx-0" color="white">
                      Resend Email
                    </v-btn>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" color="grey" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        A $15.00 USD payment was processed on PayPal Express Checkout
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item color="grey" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        John Leider placed this order on Online Store (checkout #1937432132572).
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>
                </v-timeline>
              </v-flex>
            </v-card>
            </v-layout>
          </v-flex>

        </v-card>
         <v-divider class="grey darken-4"></v-divider>
      </v-expansion-panel-content>
    </v-expansion-panel>
        </main>


      <v-dialog v-model="dialog_Detail" max-width="350">
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
                                <v-btn color="blue" icon flat @click= "dialog_logout = true"><v-icon>logout</v-icon></v-btn>
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

                            <v-btn color="primary" flat @click="dialog_Detail = false">OK</v-btn>
                          </v-card-actions>

                </v-card>
              </v-dialog>

              <v-dialog v-model="dialog_Chat" max-width="700">
                <v-app>
                  <v-card height="500" width="700" flat>
                    <v-layout row wrap>
                      <v-flex>
                        <v-card height="50" color="blue">
                          <v-card-text class="px-2"><h3>Chat room</h3> </v-card-text>
                        </v-card>
                      </v-flex>
                    </v-layout>
                    <div class="headline text-xs-center pa-5">
                      This Chat ...
                      dsdaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                      asdggggggggggggggggggggggggggggggggggggggggggggggggggggasdgasd
                    </div>

      <v-dialog v-model="dialog_logout" max-width="300">
        <v-card>
          <v-card-title class="headline grey lighten-2" primary-title>F&I Garage</v-card-title>
            <v-card-text>Do you want to logout?</v-card-text>
              <v-card-actions><v-spacer></v-spacer>
                <v-btn color="blue white--text" @click="dialog_logout = false">No</v-btn>
                <v-btn color="blue white--text" @click="dialog_logout = false">Yes</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
      </v-dialog>
      <v-bottom-nav :active.sync="bottomNav" :value="true" absolute color="transparent" >
        <v-layout>
          <v-text-field solo></v-text-field>
            <v-btn><v-icon>send</v-icon></v-btn>
        </v-layout>
      </v-bottom-nav>
    </v-card>
  </v-app>
  </v-dialog>


</div>
   </v-app>
</template>


<script>
// eslint-disable-next-line no-unused-vars
import {
  fas,
} from '@fortawesome/free-solid-svg-icons'
  // eslint-disable-next-line no-unused-vars
import {
  FontAwesomeIcon,
} from '@fortawesome/vue-fontawesome'
import 'material-design-icons-iconfont/dist/material-design-icons.css' // Ensure you are using css-loader
// eslint-disable-next-line no-unused-vars
import Vue from 'vue'
// eslint-disable-next-line no-unused-vars
import Vuetify from 'vuetify'
// eslint-disable-next-line no-unused-vars
import moment from 'moment'
import DigitalClock from 'vue-digital-clock';
import Axios from 'axios';
import Clock from 'vue-clock2'
// eslint-disable-next-line no-unused-vars
export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
    // eslint-disable-next-line vue/no-unused-components
    DigitalClock,
    // eslint-disable-next-line vue/no-unused-components
  },
  mounted() {
    console.log(this.$vuetify.breakpoint)
  },
  data() {
    return {
      dataCustomer: '',
      dataWorkInProcess: '',
      dialog_Detail: false,
      dialog_logout: false,
      dialog_Chat: false,
      events: [],
      input: null,
      nonce: 0,
      dialogFI: false,
      notifications: false,
      sound: true,
      widgets: false,
      HeaderTxt: '',
      drawer: true,
      myDate: null,
      // login: false,
      Mechanicle: true,
      // login: true,
      items_Cars: [{
        title: 'TOYOTA 2.4J 2017',
      },
      {
        title: 'Nissan BIG M 2.5 TBTDI 1998',
      },
      {
        title: 'Ford Mustang 2.3 Eco Boost 2018',
      },
      ],
      items_More: [{
        title: 'Logout',
      }],

      items2: ['Foo', 'Bar', 'Fizz', 'Buzz'],
      right: null,
    }
  },
  methods: {
    comment() {
      const time = (new Date()).toTimeString()
      this.events.push({
        // eslint-disable-next-line no-plusplus
        id: this.nonce++,
        text: this.input,
        // eslint-disable-next-line no-unused-vars
        time: time.replace(/:\d{2}\sGMT-\d{4}\s\((.*)\)/, (match, contents, offset) => {
          return ` ${contents.split(' ').map(v => v.charAt(0)).join('')}`
        }),
      })
      this.input = null
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

    async getDataDisplay() {
      const apiCus = 'https://testtingfuck.000webhostapp.com/select_display_customerUse.php';
      const paramKey = new URLSearchParams();
      paramKey.append('key', this.Store.IDforSELECT)
      const responseCus = await Axios.post(apiCus, paramKey)
      this.dataCustomer = responseCus.data

      const apiWIP = 'https://testtingfuck.000webhostapp.com/select_WIP_customerUse.php'
      const responseWip = await Axios.post(apiWIP, paramKey)
      this.dataWorkInProcess = responseWip.data

      if (this.dataWorkInProcess.length === 0) {
        alert('Work in process is null')
      } else {
        console.log(this.dataWorkInProcess)
      }

      if (this.dataCustomer.length === 0) {
        alert('Customer table is null')
      } else {
        console.log(this.dataCustomer)
      }
    },
  },
  computed: {
    timeline() {
      return this.events.slice().reverse()
    },
  },
}
</script>
