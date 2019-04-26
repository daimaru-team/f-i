<template>
  <v-card width="100%">
    <v-alert fixed :value="alert" type="success"
    transition="scale-transition" dismissible>Insert queue successfully!</v-alert>
    <v-tooltip bottom>
      <template v-slot:activator="{ on }">
          <v-btn fab dark fixed right bottom color="pink" v-on="on"
          class="elevation-10" style="margin-bottom:10px;" @click="dialog = true,alert = false">
                <v-icon dark>add</v-icon>
          </v-btn>
      </template>
    <span>Insert Queue</span>
    </v-tooltip>

    <v-expansion-panel focusable :pagination.sync="pagination" class="elevation-13">
      <v-expansion-panel-content v-for="item in display_booking" >
        <template v-slot:header>
          <div>
            <h3>{{item.come_in_date}} | {{item.car_brand}} |{{'    '+item.name}}&nbsp;{{item.last_name}}
              <v-badge right overlap v-if="1==1">
                <template v-slot:badge>
                  <span>1</span>
                </template>
                  <v-icon medium color="grey lighten-1">notifications_active</v-icon>
              </v-badge>
            </h3>
          </div>
        </template>

        <v-card color="grey darken-3" >
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                  <v-btn fab dark fixed right color="orange accent-3" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog = true,alert = false">
                        <v-icon dark>edit</v-icon>
                  </v-btn>
              </template>
              <span>Edit</span>
            </v-tooltip>
            <v-tooltip bottom>
              <template v-slot:activator="{ on }">
                  <v-btn fab dark fixed right color="green" v-on="on" class="elevation-10" style="margin-top:78px;" @click="dialog = true,alert = false">
                        <v-icon dark>check_circle</v-icon>
                  </v-btn>
              </template>
              <span>Work finished</span>
            </v-tooltip>
          <v-flex>
            <v-card-text class="grey lighten-3">
              <p><b> Booking ID :</b> {{item.book_ID}} </p>
              <h3>ข้อมูลเจ้าของรถ</h3><br/>
               <p><b> line ID :</b>  {{item.lineID}}</p>
               <p><b> เบอร์โทรศัพท์ :</b>  {{item.tel}}</p>
               <p><b> E-mail :</b>  {{item.Email}}</p>
              <h3>ข้อมูลรถ</h3><br/>
              <p><b> Car :</b>  {{item.car_brand+' '+item.car_model}} </p>
              <p><b> Year :</b>  {{item.car_year}}</p>
              <!-- <p><b> Color :</b> {{item.}} </p> -->
              <p><b> อาการเบื้องต้น :</b> {{item.broken_desc}} </p>
              <p><b> วันที่ต้องการนำรถมาเข้ารับบริการ :</b> {{item.come_in_date}} </p>

              <p><b> Status :</b>
                <!-- สถานะเสร็จ -->
                <v-icon v-if="item.confirm_status==='0'" color="amber accent-4" >error<p>  รอยืนยัน</p></v-icon>
                <!-- สถานะยังไม่เสร็จ -->
               <v-icon v-if="item.confirm_status==='1'" color="green">offline_pin<p>ยืนยันการจอง</p></v-icon>
              </p>
            </v-card-text>

          </v-flex>
             <!-- <v-flex class="text-xs-center white--text" headline pt-3 pb-3>Timeline</v-flex>

          <v-container class="grey darken-4 white--text black--text">
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
               </v-timeline>
          </v-container>
           <v-flex class="text-xs-center white--text" headline pt-3 pb-3>M.Phonpisud</v-flex> -->
        </v-card>

      </v-expansion-panel-content>
    </v-expansion-panel>

      <v-dialog v-model="dialog" persistent max-width="700px" >
        <v-card>
          <v-card-text>
            <h1 class="text-xs-center">Insert Queue</h1>
            <h3 class="text-xs-center">F&I GARAGE</h3>
          </v-card-text>

            <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
              <v-layout wrap>
                <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                <v-card elevation="0" color="grey lighten-3" width="100%">
                  <v-layout wrap pl-4 pr-4 pb-3>
                <v-flex xs12 sm6 md6 pr-3>
                  <v-text-field label="ชื่อ*" required></v-text-field>

                </v-flex>

                <v-flex xs12 sm6 md6>
                  <v-text-field label="นามสกุล*" persistent-hint required></v-text-field>
                </v-flex>

                <v-flex xs12 sm12 md12 >
                  <v-text-field label="ที่อยู่ปัจจุบัน" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md6 pr-3>
                  <v-text-field label="วันเกิด" required ></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md6 pr-3>
                  <v-text-field label="อีเมล์*" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md6 pr-3>
                  <v-text-field label="Line ID" required></v-text-field>
                </v-flex>

                <v-flex xs12 sm6 md6>
                  <v-text-field label="เบอร์โทร" required></v-text-field>
                </v-flex>
                </v-layout>
                </v-card>
                <v-card-text >ข้อมูลรถ</v-card-text>
                <v-card elevation="0" color="grey lighten-3" width="100%">
                <v-layout wrap pl-4 pr-4 pb-3>
                      <v-flex xs12 sm6 md6 pr-3>
                <v-autocomplete
                    :items="Car_list_forAdd"
                     label='ยี่ห้อ'
                    value="CM_ID"
                    v-model="selectedItem_CM"
                    item-text="CM_Name"
                v-on:change="Gen_ID_Car()"
                single-line
                return-object
                  ></v-autocomplete>
                      </v-flex>
                      <v-flex xs12 sm6 md6>
                        <v-text-field label="รุ่น" required></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6 md6 pr-3>
                        <v-text-field label="สี" required></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6 md6>
                        <v-text-field label="ทะเบียน" required></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6 md6 pr-3>
                        <v-text-field label="ปีผลิต" required></v-text-field>
                      </v-flex>
                      <v-flex xs12 sm6 md6>
                        <v-text-field label="เลขตัวถัง" required></v-text-field>
                      </v-flex>
                      <v-flex xs12>
                        <v-text-field label="สาเหตุ/อาการเบื้องต้น" required></v-text-field>
                      </v-flex>
                </v-layout>
                </v-card>
                <v-card-text >แผนงาน</v-card-text>

                <v-card elevation="0" color="grey lighten-3" width="100%">
                <v-layout wrap pl-4 pr-4 pb-3>

                  <v-flex xs12 sm6 pr-2>
                      <v-menu
                    ref="menu1"
                    v-model="menu1"
                    :close-on-content-click="false"
                    :nudge-right="40"
                    lazy
                    transition="scale-transition"
                    offset-y
                    full-width
                    max-width="290px"
                    min-width="290px"
                  >
                    <template v-slot:activator="{ on }">
                      <v-text-field
                        v-model="dateFormatted"
                        label="กำหนดวันเสร็จสิ้นและส่งมอบงาน"
                        persistent-hint
                        prepend-icon="event"
                        @blur="date = parseDate(dateFormatted)"
                        v-on="on"
                        readonly
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="date" no-title @input="menu1 = false"></v-date-picker>
                  </v-menu>
                  </v-flex>

                <v-flex xs12 sm6>
                <v-select
                :items="Mac_for_newQ"
                value="Emp_ID"
                v-model="selectedItem_Owner"
                item-text="Mac_Name"
                label="ช่างผู้รับผิดชอบ"
                v-on:change="changeRoute(selectedItem_Owner.Emp_ID)"
                single-line
                return-object
                ></v-select>
                </v-flex>
                </v-layout>
                </v-card>
              </v-layout>
            </v-container>
            <!-- <small>*indicates required field</small> -->

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="dialog = false">Cencel</v-btn>
            <v-btn color="blue darken-1" flat @click="dialogAddSucess = true">Add</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog v-model="dialogAddSucess" max-width="300">
        <v-card>
          <v-card-title class="headline grey lighten-2" primary-title>F&I Garage</v-card-title>
          <v-card-title>Do you want to Add queue ?</v-card-title>
          <v-card-actions><v-spacer></v-spacer>
            <v-btn color="blue white--text" @click="dialog = false,dialogAddSucess = false">No</v-btn>
            <v-btn color="blue white--text" @click="dialogAddSucess = false,dialog = false,alert = !alert,QrPic = true">Yes</v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>

    <v-dialog v-model="QrPic" max-width="300">
      <v-flex mb-2 >
        <v-card color="green">
            <v-layout justify-center class="white--text">
              <h3>Send Qr code to Email complete !</h3>
            </v-layout>
          </v-card>
          </v-flex>
        <v-card>
          <img src="https://mrkenthelibrarian.files.wordpress.com/2012/05/qrcmrken.png?w=280&h=280" width="300" height="300">

        </v-card>
        <v-flex mt-2 >
          <v-card color="green">
            <v-layout justify-center class="white--text">
              <h3>Qr code สำหรับการเข้าใช้ระบบ</h3>
            </v-layout>
          </v-card>
          </v-flex>
      </v-dialog>

</v-card>
</template>

<script>
import moment from 'moment'
import Clock from 'vue-clock2'
// eslint-disable-next-line no-unused-vars
import Datepicker from 'vuejs-datepicker'
import Axios from 'axios';
import { Store } from 'vuex';
// eslint-disable-next-line no-unused-vars
const state = {
  date: new Date(2016, 9, 16),
}

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
    // eslint-disable-next-line vue/no-unused-components
    Datepicker,
  },
  beforeCreate() {
    const api = 'https://testtingfuck.000webhostapp.com/Select_Mac.php';
    const Emp_params = new URLSearchParams();
    let readData = new Array();
    Emp_params.append('Table', 'WorkInProcess')
    // eslint-disable-next-line global-require
    Axios.post(api, Emp_params)
      .then((response) => {
        readData = response.data
        console.log('loooooop =', readData.length)
        // eslint-disable-next-line eqeqeq
        if (readData.length == 0) {
          alert('table is null or error')
          // eslint-disable-next-line eqeqeq
        } else if (readData != 0) {
          console.log(readData)
          this.Mac_for_newQ = readData
        }
      })

    const api_car_list = 'https://testtingfuck.000webhostapp.com/CarMaker_Select.php';
    const CMread = new Array();
    const car_read_params = new URLSearchParams();
    car_read_params.append('Table', 'Car_Maker')
    // eslint-disable-next-line global-require
    Axios.post(api_car_list, car_read_params)
      .then((response) => {
        this.Car_list_forAdd = response.data
        if (this.Car_list_forAdd.length === 0) {
          alert('table is null or error')
        } else if (this.Car_list_forAdd.length !== 0) {
          console.log()
        }
      })

  },
  mounted() {
    console.log('test storqqqq')
    
    this.display_booking = this.Store.data_dis_booking
    console.log(this.display_booking)
  },
  data() {
    return {
      Store: this.$store.state,
      alert: false,
      dialog: null,
      menu1: false,
      menu2: false,
      search: '',
      selectedItem_Owner: '',
      selectedItem_CM: '',
      date: new Date().toISOString().substr(0, 10),
      dateFormatted: this.formatDate(new Date().toISOString().substr(0, 10)),
      Mac_for_newQ: [],
      Car_list_forAdd: [],
      pagination: {},
      selected: [],
      insert_newQ: [{
        Cus_ID: '',
        Cus_name: '',
        Cus_Lname: '',
        Cus_Address: '',
        Cus_Email: '',
        Cus_LindID: '',
        Cus_Tel: '',
        Birthday: '',
        Car_ID: '',
        Brand: '',
        model: '',
        Color: '',
        year: '',
        W_ID: '',
        Broken_List: '',
        Finish_date: '',
        Work_Owner_Emp: '',

      }],
      dialogAddSucess: false,
      QrPic: false,
      display_booking: [],
    }
  },
  computed: {

    pages() {
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.pagination.rowsPerPage = 12
      console.log(this.pagination.rowsPerPage)
      if (this.pagination.rowsPerPage == null
          || this.pagination.totalItems == null
      ) return 0
      return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
    },
    computedDateFormatted() {
      return this.formatDate(this.date)
    },
  },
  watch: {
    date(val) {
      this.dateFormatted = this.formatDate(this.date)
      // eslint-disable-next-line comma-dangle
    }
  },
  methods: {
    moment() {
      return moment();
    },
    formatDate(date) {
      if (!date) return null

      const [year, month, day] = date.split('-')
      return `${month}/${day}/${year}`
    },
    parseDate(date) {
      if (!date) return null

      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    },
    getJSON() {
      return new Promise(((resolve) => {
        Axios.get('https://tutorialzine.com/misc/files/example.json')
          .then((json) => {
            // The data from the request is available in a .then block
            // We return the result using resolve.
            console.log(json)
            resolve(json);
          });
      }));
    },

  },
}
</script>
