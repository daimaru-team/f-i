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
                                <img src="https://randomuser.me/api/portraits/men/1.jpg" width="30" height="20">
                        </v-btn>
                        </v-avatar>
                        <v-btn dark icon @click.stop="dialog_Detail= true">
                            <v-icon>more_vert</v-icon>
                        </v-btn>
                    </v-layout>
                </v-flex>

            </v-layout>

        </v-toolbar>

        <main class="v-content__wrap" full-hight style="padding: 50px 0px 0px 0px;">
            <v-expansion-panel focusable>
                <v-expansion-panel-content v-for="(item,i) in 3" :key="i">
                    <template v-slot:header>
                        <div>
                            <h3>Toyota Revo 2.4J<v-icon color="amber accent-4">mail</v-icon>
                            </h3>
                        </div>
                    </template>
                    <v-card color="grey lighten-3">
                        <v-flex>
                            <v-layout>
                                <v-flex md11 xl11 sm11 lg11 xs11>
                                    <v-card-text class="grey lighten-3">
                                        <v-flex mb-2 ml-1>
                                            <h2><b> Booking ID :</b> {{item.book_ID}} </h2>
                                        </v-flex>
                                        <v-divider></v-divider>
                                        <v-divider></v-divider>
                                        <v-flex mt-2>
                                            <v-flex mt-2 headline font-weight-bold>
                                                <v-icon>person</v-icon> รายระเอียดงาน
                                            </v-flex>
                                            <v-flex mt-3 ml-3>
                                                <p><b> Car :</b> Toyota </p>
                                                <p><b> รุ่น :</b> Revo 2.4L </p>
                                                <p><b> ปี :</b> 2014</p>
                                                <p><b> ทะเบียน :</b> 61160 </p>
                                                <p><b> อาการ/สาเหตุ :</b> สตาร์ทไม่ติด คล้ายไฟไม่ชาจต์</p>
                                                <p><b> ช่างผู้รับผิดชอบ :</b> M.Phonpisud Sumangsa</p>
                                                <p><b> วันเริ่มงาน :</b> 13/12/2561</p>
                                                <p><b> วันส่งงาน :</b> 13/12/2561</p>
                                                <p><b> Status :</b> อยู่ระหว่างดำเนินการ</p>
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
                                <v-flex md1 xl1 sm1 lg1 xs1 mr-1 class="grey lighten-3">
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
                                <v-btn color="blue" icon flat @click="dialog_logout = true">
                                    <v-icon>logout</v-icon>
                                </v-btn>
                            </v-list-tile-action>
                    </v-list-tile>

                </v-list>
                <v-divider></v-divider>
                <v-card-text>
                    <v-list-tile-title>Phonsiri Sirichai</v-list-tile-title>
                    <v-list-tile-title v-for="(item,i) in items_Cars" :key="i">Car {{i+1}}:{{items_Cars}}</v-list-tile-title>

                </v-card-text>
                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn color="primary" flat @click="dialog_Detail = false">OK</v-btn>
                </v-card-actions>

            </v-card>
        </v-dialog>

        <v-dialog v-model="dialog_About" max-height="900">

            <v-card height="100%" style="border-radius:60px 0px 60px 0px">
                <v-flex>
                    <v-layout justify-center style="padding: 25px 0px 0px 0px;">
                        <img src="https://testtingfuck.000webhostapp.com/imageLogo/ForBgWhite.png" width="240" height="80">
                    </v-layout>
                        <v-btn fab small color="red" class="white--text" @click="dialog_About = false,alert = !alert">
                            <v-icon>logout</v-icon>
                        </v-btn>
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
                                        <img src="https://image.flaticon.com/icons/svg/81/81070.svg" width="200" height="200">
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
<<<<<<< HEAD
      dataCustomer: '',
      dataWorkInProcess: '',
=======
      window: {
        width: 0,
        height: 0,
      },
>>>>>>> 2a6b3c7a229cc49f913e9a596a46c94db83bfe09
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
<<<<<<< HEAD

      items2: ['Foo', 'Bar', 'Fizz', 'Buzz'],
=======
    
>>>>>>> 2a6b3c7a229cc49f913e9a596a46c94db83bfe09
      right: null,
    }
  },
  created() {
    window.addEventListener('resize', this.handleResize)
    this.handleResize();
    const api = 'https://testtingfuck.000webhostapp.com/select_display_emp.php';
    // eslint-disable-next-line camelcase
    const Emp_params = new URLSearchParams();
    let readData = new Array();
    Emp_params.append('Table', 'Employee')
    // eslint-disable-next-line global-require
    Axios.post(api, Emp_params)
      .then((response) => {
        readData = response.data
        console.log('loooooop =', readData.length)
        // eslint-disable-next-line eqeqeq
        if (readData.length == 0) {
          console.log('wrong pass or username')
          alert('table is null or error')
          // eslint-disable-next-line eqeqeq
        } else if (readData != 0) {
          console.log('reading')
          this.GetData_Emp = readData
          console.log('tst')
          console.log(this.GetData_Emp.data)
          // eslint-disable-next-line no-unused-vars
          const aaa = this.calculate_age(this.GetData_Emp[0].Birthday)
        }
      })
    const WID_params = new URLSearchParams();
    let readData2 = new Array();
    WID_params.append('Table', 'WorkInProcess')
    // eslint-disable-next-line global-require
    Axios.post(api, WID_params)
      .then((response) => {
        readData2 = response.data
        console.log('loooooop =', readData2.length)
        if (readData2.length === 0) {
          alert('มีบางอย่างผิดพลาด โปรด reload ใหม่อีกครั้ง')
        } else if (readData2 !== 0) {
          this.GetData_Work_in = readData2
          console.log('ING', this.GetData_Work_in)
        }
      })
    // this.read_table('Employee')
    // this.read_Table2()
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
<<<<<<< HEAD

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
=======
    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
    async dayleft() { // นับจำนวนวันที่เหลือ
      const api3 = '_';
      const dayParam = new URLSearchParams();
      dayParam.append('Emp_ID', this.Store.IDforSELECT)
      dayParam.append('date', moment().format('YYYY-MM-DD'))

      const response = await Axios.post(api3, day_param)

      this.dayleft = response.data
      if (this.display_timeline.length === 0) {
        this.alertNotfound = true
      } else if (this.display_timeline.length !== 0) {
        console.log('dayyyy')
        // alert(this.dayleft.length)
        // alert(typeof (Number(this.dayleft[0].day_left)))
        console.log(this.dayleft)
>>>>>>> 2a6b3c7a229cc49f913e9a596a46c94db83bfe09
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
