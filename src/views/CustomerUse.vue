<template>
<v-app>
    <div>
        <v-toolbar class="v-toolbar--fixed theme--dark red elevation-6" height="50">

            <v-layout md12 wrap>
                <v-flex style="padding: 10px 0px 0px 0px;">
                    <h1>F&I Garage</h1>
                </v-flex>
                <v-flex md6>
                    <v-layout justify-end>
                        <v-avatar>
                            <v-btn small icon @click.stop="dialog_Detail= true">
                                <v-icon size="30" color="white">account_circle</v-icon>
                        </v-btn>
                        </v-avatar>
                    </v-layout>
                </v-flex>

            </v-layout>

        </v-toolbar>

        <main class="v-content__wrap" full-hight style="padding: 50px 0px 0px 0px;">
            <v-expansion-panel focusable>
                <v-expansion-panel-content v-for="item in dataWorkInProcess" :key="i">
                    <template v-slot:header>
                        <div>
                            <h3>{{item.CM_Name +" "+item.Model +" "+item.Car_Year +" | "+item.License_plate}}
                            </h3>
                        </div>
                    </template>
                    <v-card color="grey lighten-3">
                        <v-flex>
                            <v-layout>
                                <v-flex md11 xl11 sm11 lg11 xs11>
                                    <v-card-text class="grey lighten-3">
                                        <v-flex mb-2 ml-1>
                                            <h2><b> Booking ID :</b> {{item.W_ID}} </h2>
                                        </v-flex>
                                        <v-divider></v-divider>
                                        <v-divider></v-divider>
                                        <v-flex mt-2>
                                            <v-flex mt-2 >
                                                <h2> <v-icon size="30px">person</v-icon> รายระเอียดงาน</h2>
                                            </v-flex>
                                            <v-flex mt-3 ml-3>
                                                <p><b> Car :</b> {{item.CM_Name}} </p>
                                                <p><b> รุ่น :</b> {{item.Model}} </p>
                                                <p><b> ปี :</b> {{item.Car_Year}}</p>
                                                <p><b> ทะเบียน :</b> {{item.License_plate}} </p>
                                                <p><b> อาการ/สาเหตุ :</b> {{item.W_Desc}}</p>
                                                <p><b> ลูกค้า :</b> {{item.cus_name}}</p>
                                                <p><b> ช่างผู้รับผิดชอบ :</b> {{item.emp_name}}</p>
                                                <p><b> วันเริ่มงาน :</b>{{item.Start_Date}}</p>
                                                <p><b> วันส่งงาน :</b> {{item.Finish_Date}}</p>
                                                <p><b> Status :</b> {{item.Status}}</p>
                                            </v-flex>
                                        </v-flex>
                                        <v-flex mt-2>
                                            <h3>
                                                <p v-if="item.confirm_status==='0'"><b> Status :</b> รอยืนยัน
                                                    <!-- สถานะเสร็จ -->
                                                    <v-icon color="amber accent-4">error</v-icon>
                                                </p>
                                                <p v-if="item.confirm_status==='1'"><b> Status :</b> ยืนยันการจอง
                                                    <!-- สถานะยังไม่เสร็จ -->
                                                    <v-icon color="green">offline_pin</v-icon>
                                                </p>
                                            </h3>

                                        </v-flex>
                                    </v-card-text>
                                </v-flex>
                                <v-flex md1 xl1 sm1 lg1 xs1 mr-2 class="grey lighten-3">
                                    <v-layout justify-end wrap>

                                        <v-flex text-xs-right md12 xl12 sm12 lg12 xs12>
                                            <v-tooltip left>
                                                <template v-slot:activator="{ on }">
                                                    <v-btn small fab dark right color="red" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_About = true,getDataDeletegetDataDelete(item.W_ID),alert = false">
                                                        <v-icon dark>contact_phone</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>เกี่ยวกับ</span>
                                            </v-tooltip>
                                        </v-flex>
                                        <v-flex text-xs-right md12 xl12 sm12 lg12 xs12>
                                            <v-tooltip left>
                                                <template v-slot:activator="{ on }">
                                                    <v-btn small fab dark right color="blue" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_Timeline = true,getDataExpans(item)">
                                                        <v-icon dark>storage</v-icon>
                                                    </v-btn>
                                                </template>
                                                <span>ไทม์ไลน์</span>
                                            </v-tooltip>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-flex>

                        <v-dialog v-model="dialog_Timeline" max-width="700px" >
                            <v-card style="border-radius:30px 0px 0px 30px;">
                                <v-flex headline pt-2 pb-3>
                                    <v-layout justify-space-around>
                                        <v-flex xs11 md11 xl11 lg11 sm11 ml-4 mt-3>
                                            <h3>Timeline</h3>
                                            <h6>{{item.CM_Name}} {{item.Model}} {{item.Car_Year}}</h6>
                                        </v-flex>
                                        <v-flex xs1 md1 xl1 lg1 sm1 mr-2>
                                            <v-btn fab small color="red" class="white--text" @click="dialog_Timeline = false,alert = !alert">
                                                <v-icon>logout</v-icon>
                                            </v-btn>
                                        </v-flex>

                                    </v-layout>
                                </v-flex>
                                <v-flex pr-3 pl-3>
                                    <v-layout justify-space-around>
                                        <v-timeline dense clipped class="">

                                            <v-timeline-item color="grey darken-3" class="mb-4">
                                                <h3>{{DataTimeLine.W_ID}}</h3>
                                            </v-timeline-item>

                                            <v-timeline-item color="red" class="mb-3" small v-for="timelineItem in DataTimeLine.timeline">
                                                <v-card class="elevation-6" style="border-radius:30px 0px 35px 0px;" min-width="400px">
                                                    <v-layout justify-space-between pt-3 pb-3 pr-3 pl-3>
                                                        <v-flex xs7>
                                                            <v-chip class="white--text ml-0" color="grey darken-4" style="border-radius:15px 0px 15px 0px;" label small>
                                                                รายงานผลปกติ
                                                            </v-chip>
                                                            &nbsp;
                                                            <b>{{timelineItem.Report_Name}}</b><br/>
                                                            <p><br/>&nbsp;&nbsp;&nbsp;{{timelineItem.Description}}</p>
                                                        </v-flex>

                                                        <v-flex xs5 text-xs-right>
                                                            <v-layout justify-end wrap>
                                                                <v-flex xs12 md12 xl12 lg12 sm12>Datetime : {{timelineItem.DateTime_Created}}</v-flex>
                                                                <v-flex mt-1 xs12 md12 xl12 lg12 sm12>
                                                                    <h4 class="blue--text">M.{{item.emp_name}}</h4>
                                                                </v-flex>
                                                            </v-layout>
                                                        </v-flex>

                                                    </v-layout>
                                                </v-card>
                                            </v-timeline-item>

                                        </v-timeline>

                                    </v-layout>
                                </v-flex>
                            </v-card>
                        </v-dialog>


                    </v-card>
                    <v-divider class="grey darken-4"></v-divider>
                </v-expansion-panel-content>
            </v-expansion-panel>
        </main>

        <v-dialog v-model="dialog_Detail" max-width="350">
            <v-card>
                <v-list class="grey darken-4 white--text">
                    <v-list-tile avatar >
                        <v-list-tile-avatar>
                            <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John">
                              </v-list-tile-avatar>

                            <v-list-tile-content>
                                <v-list-tile-title>{{dataCustomer[0].CusFullName}}</v-list-tile-title>
                                <v-list-tile-sub-title class="white--text">Customer</v-list-tile-sub-title>
                            </v-list-tile-content>

                            <v-list-tile-action>
                                <v-btn color="blue"  icon flat @click="log_out()">
                                    <v-icon>logout</v-icon>
                                </v-btn>
                            </v-list-tile-action>
                    </v-list-tile>

                </v-list>
                <v-divider></v-divider>
                <v-card-text>
                    <v-list-tile-title><b>Car in garage </b></v-list-tile-title>
                    <v-list-tile-title v-for="(item,i) in dataWorkInProcess">
                          Car {{i+1}} : {{item.CM_Name +' '+ item.Model +"sss "+item.Car_Year}}
                        </v-list-tile-title>

                </v-card-text>
                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn style="border-radius:15px 0px 15px 0px" color="red" @click="dialog_Detail = false">Close</v-btn>
                </v-card-actions>

            </v-card>
        </v-dialog>

        <v-dialog v-model="dialog_About" max-height="900">

            <v-card height="100%" style="border-radius:60px 0px 60px 0px">

               <v-btn style="padding: 0px 14px 0px 0px;" fab flat right fixed small class="white--text" @click="dialog_About = false,alert = !alert">
                  <v-icon color="black" medium>logout</v-icon>
                </v-btn>

                <v-flex>
                    <v-layout justify-center style="padding: 20px 0px 0px 0px;">
                        <img src="https://testtingfuck.000webhostapp.com/imageLogo/ForBgWhite.png" width="220" height="80">
                    </v-layout>

                        <v-flex ml-4 mr-4>
                            <v-flex ml-1 mb-2 font-italic class="text-xs-center">
                                <h2>F&I Garage customer service</h2>

                            </v-flex>
                            <v-divider></v-divider>
                            <v-divider></v-divider>
                            <v-divider></v-divider>
                            <v-divider></v-divider>
                            <v-flex ml-2>
                                <v-flex>
                                    <v-layout justify-center mt-4>
                                        <img src="https://testtingfuck.000webhostapp.com/imageLogo/IconMechanic.png" width="170" height="170">
                          </v-layout>
                                </v-flex>
                                <v-flex mt-3>
                                    <v-card color="grey darken-4" class="white--text" style="border-radius:70px 0px 70px 0px">
                                        <v-card-text>
                                            <v-layout wrap>

                                                <v-flex>
                                                    <h1 class="text-xs-center red--text">ข้อมูลช่าง</h1>
                                                    <h3 class="text-xs-center">F&I GARAGE</h3>
                                                </v-flex>

                                            </v-layout>
                                        </v-card-text>

                                        <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                                            <v-layout wrap>

                                                <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                                                <v-flex mb-5>
                                                    <v-card elevation="0" color="grey lighten-3" width="100%" style="border-radius:40px 0px 40px 0px">

                                                        <v-layout wrap pl-4 pr-4 pb-3>

                                                            <v-flex xs12 sm6 md6 pr-3>
                                                                <v-text-field label="ชื่อ" readonly :value="window.width"></v-text-field>

                                                            </v-flex>

                                                            <v-flex xs12 sm6 md6>
                                                                <v-text-field label="นามสกุล"></v-text-field>
                                                            </v-flex>

                                                            <v-flex xs12 sm12 md12>
                                                                <v-text-field label="ที่อยู่ปัจจุบัน"></v-text-field>
                                                            </v-flex>

                                                            <v-flex xs12 sm6 md6 pr-3>
                                                                <v-text-field label="วันเกิด"></v-text-field>
                                                            </v-flex>

                                                            <v-flex xs12 sm6 md6>

                                                                <v-text-field label="อีเมล์*"></v-text-field>

                                                            </v-flex>

                                                            <v-flex xs12 sm6 md6 pr-3>
                                                                <v-text-field label="Line ID"></v-text-field>
                                                            </v-flex>

                                                            <v-flex xs12 sm6 md6>
                                                                <v-text-field label="เบอร์โทร"></v-text-field>
                                                            </v-flex>
                                                        </v-layout>

                                                    </v-card>
                                                </v-flex>

                                            </v-layout>
                                        </v-container>
                                        <!-- <small>*indicates required field</small> -->

                                    </v-card>
                                </v-flex>
                            </v-flex>
                        </v-flex>
                </v-flex>
            </v-card>

        </v-dialog>

        <v-footer color="black" app>
            <v-spacer></v-spacer>
            <v-flex-text class="white--text">&copy; F&I Garage 2019 Customer service</v-flex-text>
            <v-spacer></v-spacer>
        </v-footer>

    </div>
</v-app>
</template>

<script>
// eslint-disable-next-line no-unused-vars

import 'material-design-icons-iconfont/dist/material-design-icons.css' // Ensure you are using css-loader
import Vue from 'vue'
import moment from 'moment'
import DigitalClock from 'vue-digital-clock';
import Clock from 'vue-clock2'
import Axios from 'axios'

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
    // eslint-disable-next-line vue/no-unused-components
    DigitalClock,
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
      window: {
        width: 0,
        height: 0,
      },
      dialog_Timeline: false,
      Store: this.$store.state,
      dataWorkInProcess: [],
      dataCustomer: [],
      DataTimeLine:
      { timeline: '' },
      dialog_Detail: false,
      dialog_logout: false,
      dialog_Chat: false,
      dialog_About: false,
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

      right: null,
    }
  },
  created() {
    window.addEventListener('resize', this.handleResize)
    this.handleResize();
    // const api = 'https://testtingfuck.000webhostapp.com/select_display_emp.php';
    // // eslint-disable-next-line camelcase
    // const Emp_params = new URLSearchParams();
    // let readData = new Array();
    // Emp_params.append('Table', 'Employee')
    // // eslint-disable-next-line global-require
    // Axios.post(api, Emp_params)
    //   .then((response) => {
    //     readData = response.data
    //     console.log('loooooop =', readData.length)
    //     // eslint-disable-next-line eqeqeq
    //     if (readData.length == 0) {
    //       console.log('wrong pass or username')
    //       alert('table is null or error')
    //       // eslint-disable-next-line eqeqeq
    //     } else if (readData != 0) {
    //       console.log('reading')
    //       this.GetData_Emp = readData
    //       console.log('tst')
    //       console.log(this.GetData_Emp.data)
    //       // eslint-disable-next-line no-unused-vars
    //       const aaa = this.calculate_age(this.GetData_Emp[0].Birthday)
    //     }
    //   })
    // const WID_params = new URLSearchParams();
    // let readData2 = new Array();
    // WID_params.append('Table', 'WorkInProcess')
    // // eslint-disable-next-line global-require
    // Axios.post(api, WID_params)
    //   .then((response) => {
    //     readData2 = response.data
    //     console.log('loooooop =', readData2.length)
    //     if (readData2.length === 0) {
    //       alert('มีบางอย่างผิดพลาด โปรด reload ใหม่อีกครั้ง')
    //     } else if (readData2 !== 0) {
    //       this.GetData_Work_in = readData2
    //       console.log(this.GetData_Work_in)
    //     }
    //   })
    this.getDataDisplay()
    // this.read_table('Employee')
    // this.read_Table2()
  },
  methods: {
    getDataExpans(data) {
      this.DataTimeLine = data
    },
    log_out() {
      console.log('11111')
      this.$session.clear()
      this.$session.destroy()
      this.Store.display_page = 'Login'
      this.dialog_Adminlogout = false
      this.dialog_Morword = false
    },
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
    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
    // async dayleft() { // นับจำนวนวันที่เหลือ
    //   const api3 = '_';
    //   const dayParam = new URLSearchParams();
    //   dayParam.append('Emp_ID', this.Store.IDforSELECT)
    //   dayParam.append('date', moment().format('YYYY-MM-DD'))

    //   const response = await Axios.post(api3, dayParam)

    //   this.dayleft = response.data
    //   if (this.display_timeline.length === 0) {
    //     this.alertNotfound = true
    //   } else if (this.display_timeline.length !== 0) {
    //     console.log('dayyyy')
    //     // alert(this.dayleft.length)
    //     // alert(typeof (Number(this.dayleft[0].day_left)))
    //     console.log(this.dayleft)
    //   }
    // },

    async getDataDisplay() {
      const apiCus = 'https://testtingfuck.000webhostapp.com/select_display_customerUse.php';
      const paramKey = new URLSearchParams();
      // alert(this.Store.IDforSELECT)
      paramKey.append('key', this.Store.IDforSELECT)
      const responseCus = await Axios.post(apiCus, paramKey)
      this.dataCustomer = responseCus.data
      console.log('this Cus', responseCus.data)

      const apiWIP = 'https://testtingfuck.000webhostapp.com/select_WIP_customerUse.php'
      const responseWip = await Axios.post(apiWIP, paramKey)
      console.log('this WIP', responseWip.data)
      this.dataWorkInProcess = responseWip.data

      if (this.dataWorkInProcess.length === 0) {
        // alert('Work in process is null')
      } else {
        console.log('ING1', this.dataWorkInProcess)
      }

      if (this.dataCustomer.length === 0) {
        // alert('Customer table is null')
      } else {
        console.log('AAAA', this.dataCustomer)
      }
    },
    async getDataEmployee() {

    },
  },
  computed: {
    timeline() {
      return this.events.slice().reverse()
    },
  },

}
</script>
