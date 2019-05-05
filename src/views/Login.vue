<template>
<v-app>

    <div class="grey darken-4">
        <v-parallax width="230" height="1000" dark
        src="https://petrolblog.com/wp-content/uploads/2016/01/Skoda-garage-door.jpg">
            <v-alert :value="alertInsert"
            type="success"
            transition="scale-transition"
            dismissible>
                ทำการจองคิวสำเร็จ! โปรดรอเจ้าหน้าที่ติดต่อกลับ เพื่อยืนยันคิวในการเข้าซ่อมอีกครั้ง
            </v-alert>

            <v-alert :value="ErrorInsert"
            type="error"
            transition="scale-transition"
            dismissible>
            ระบบไม่สามารถทำการจองคิวให้ท่านได้.. โปรดตรวจสอบข้อมูลหรือการเชื่อมต่อ
            และลองใหม่อีกครั้ง!
            </v-alert>

             <v-alert :value="failedLogIn"
            type="error"
            transition="scale-transition"
            dismissible>
            การเข้าสู่ระบบล้มเหลว โปรดตรวจสอบ Username หรือ Password ให้ถูกต้อง
            </v-alert>

            <v-container fill-height wrap xs12>

                <v-layout md12 sm12 xs12 wrap>
                    <v-flex md2 sm2 xs0>
                    </v-flex>

                    <v-flex md8 sm8 xs12>

                        <v-flex mb-3>
                          <v-layout justify-end>


                                    <v-btn-toggle v-model="toggle_exclusive"
                                    dark style="border-radius:15px 0px 15px 0px">
                                        <v-btn color="green" style="border-radius:15px 0px 0px 0px"
                                        @click="fromLogin = false">
                                            <h4>จองคิว</h4>
                                        </v-btn>
                                        <v-btn color="green" style="border-radius:0px 0px 15px 0px"
                                        @click="fromLogin = true">
                                            <h4>Login</h4>
                                        </v-btn>
                                    </v-btn-toggle>
                          </v-layout>

                        </v-flex>

                        <v-flex v-if="fromLogin == false">
                            <v-layout wrap justify-center>
                                <v-card class="elevation-22 "
                                style="border-radius: 60px 0px 60px 0px"
                                light color="grey lighten-3">
                                    <v-layout mt-2 justify-center>

                                        <v-layout wrap>
                                            <v-flex mt-3 md3 xs3 sm3 lg3 xl3>
                                              <v-layout ml-4 justify-center
                                              v-if="window.width > 900">

                                                    <img src="https://testtingfuck.000webhostapp.com/imageLogo/newForGray.png" width="130" height="47">
                                              </v-layout>
                                            </v-flex>

                                            <v-flex md6 xs6 sm6 lg6 xl6 mt-3>
                                                <v-layout display-1 justify-center>
                                                    จองคิวซ่อม
                                                    <cer/> test                                              </v-layout>

                                            </v-flex>

                                            <v-flex mr-4 md3 xs3 sm3 lg3 xl3>
                                                <v-layout justify-center>

                                                </v-layout>

                                            </v-flex>

                                        </v-layout>

                                    </v-layout>

                                    <v-form ref="form" v-model="valid" lazy-validation>
                                        <v-layout ml-5 mr-5 wrap>
                                            <v-flex xs12 sm12 md12>
                                                <v-text-field label="เลขประจำตัวประชาชน"
                                                v-model="booking.pId" :rules="pIdRules"
                                                required mask="#-####-#####-##-#">></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm6 md6 pr-3>
                                                <v-text-field label="ชื่อ*"
                                                v-model="booking.name"
                                                :rules="fNameRules" required />
                                            </v-flex>
                                            <v-flex xs12 sm6 md6>
                                                <v-text-field label="นามสกุล*"
                                                v-model="booking.lastname"
                                                :rules="lNameRules" persistent-hint required />
                                            </v-flex>
                                            <v-flex xs12 sm6 md6 pr-3>
                                                <v-text-field label="Line ID"
                                                v-model="booking.lineID"
                                                :rules="lineIDRules" required />
                                            </v-flex>
                                            <v-flex xs12 sm6 md6>
                                                <v-text-field label="เบอร์โทรติดต่อกลับ"
                                                mask="##-####-####"
                                                :rules="telRules"
                                                v-model="booking.tel" required />
                                            </v-flex>
                                            <v-flex xs12 sm6 md6>
                                                <v-text-field label="E-mail"
                                                v-model="booking.Email"
                                                :rules="emailRules" required />
                                            </v-flex>
                                             <v-flex xs12 sm6 md6>
                                              <v-menu v-model="menuBookingDate"
                                                :close-on-content-click="false"
                                                :nudge-right="40" offset-y
                                                full-width min-width="290px">
                                                <template v-slot:activator="{ on }">
                                                  <v-text-field
                                                    v-model="booking.come_in_date"
                                                    label="วันที่สามารถนำรถมาเข้ารับบริการ"
                                                    prepend-icon="event" readonly
                                                    v-on="on"/>
                                              </template>
                                              <v-date-picker dark v-model="booking.come_in_date" @input="menuBookingDate = false" />
                                              </v-menu>
                                            </v-flex>
                                            <v-flex xs12 sm4 md4 mr-4>
                                                  <v-autocomplete :items="Car_list_forAdd"
                                                  label='ยี่ห้อ' value="CM_ID"
                                                  v-model="booking.car_brand"
                                                  :rules="selectedItem_CMRules"
                                                  item-text="CM_Name"
                                                  single-line return-object></v-autocomplete>
                                            </v-flex>
                                            <v-flex xs12 sm3 md3 mr-4>
                                                <v-text-field label="รุ่น(Model)"
                                                v-model="booking.car_model"
                                                required :rules="modelRules"></v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm4 md4>
                                                <v-text-field label="ปีผลิต"
                                                v-model="booking.car_year"
                                                required :rules="yearRules" mask="####">
                                                </v-text-field>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12>
                                                <v-text-field label="อาการเบื้องต้น"
                                                v-model="booking.broken_desc"
                                                :rules="DescRules" required />
                                            </v-flex>
                                            <!-- เหลือ วันที่ และ Email ที่ยังไม่มี input -->
                                        </v-layout>
                                    </v-form>
                                    <v-layout justify-center>
                                        <v-card-title>

                                            <v-tooltip top open-delay>
                                                <template v-slot:activator="{ on }">
                                                    <v-btn :loading="booking_loading"
                                                    large style="border-radius:40px"
                                                    class="white--text"
                                                    color="light-green darken-2"
                                                    :disabled="!valid" @click="insert_booking()">
                                                    ยืนยัน</v-btn>
                                                </template>
                                                <span>ส่งเรื่องของคุณไปยังเจ้าหน้าที่</span>
                                            </v-tooltip>

                                        </v-card-title>
                                    </v-layout>
                                </v-card>
                            </v-layout>
                        </v-flex>

                        <!-- แสดงหน้า Login -->
                        <v-flex v-if="fromLogin == true">
                            <v-card class="elevation-10 "
                            hover max-height="700"
                            style="border-radius: 60px 0px 60px 0px"
                            light color="grey lighten-3">
                                <v-flex pt-2>
                                    <v-layout wrap>
                                        <v-flex mt-3 md3 xs3 sm3 lg3 xl3>
                                            <v-layout justify-center ml-4 v-if="window.width > 900">
                                                <img src="https://testtingfuck.000webhostapp.com/imageLogo/newForGray.png" width="130" height="47">
                                                  </v-layout>
                                        </v-flex>

                                        <v-flex md6 xs6 sm6 lg6 xl6 mt-3>
                                            <v-layout
                                            v-if="window.width > 900"
                                            display-1 justify-center>
                                                F & I GARAGE
                                            </v-layout>
                                            <v-layout v-else headline justify-center>
                                                F & I GARAGE
                                            </v-layout>

                                        </v-flex>

                                        <v-flex md3 xs3 sm3 lg3 xl3>
                                            <v-layout justify-center>

                                            </v-layout>

                                        </v-flex>

                                    </v-layout>
                                </v-flex>
                               <v-form ref="form" v-model="valid" lazy-validation >
                                <v-layout ml-5 mr-5>
                                    <v-flex display-3>
                                        <v-text-field label="user"
                                        v-model="login_data.username"
                                        :rules="loginRules" @keyup.enter="checkUser"></v-text-field>
                                        <v-text-field label="password"
                                        type="password"
                                        v-model="login_data.password"
                                        :rules="passwordRules" @keyup.enter="checkUser"></v-text-field>
                                    </v-flex>
                                </v-layout>
                                <v-layout justify-center>
                                    <v-card-title>
                                        <!-- <v-btn class="white--text"
                                        color="green darken-1"
                                        @click="Queue = true,login = false">login</v-btn> -->
                                        <!-- <v-progress-circular
                                    :indeterminate="loading"
                                    :color="loading_color"
                                    :aria-hidden="loading"
                                  ></v-progress-circular> -->
                                        <v-btn :loading="loading"
                                        class="white--text elevation-10"
                                        style="border-radius:40px" large
                                        color="light-green darken-2"
                                        @click="checkUser">login</v-btn>
                              <!-- <v-tooltip top open-delay>
                                <template v-slot:activator="{ on }">
                                  <v-btn class="white--text" color="blue-grey darken-3"
                                  @click="dialogQrcode= true,paused=false">QR Code</v-btn>
                                </template>
                                    <span>เข้าสู่ระยยโดยใช้ Qrcode ที่ได้จากเจ้าหน้าที่</span>
                              </v-tooltip> -->
                                    </v-card-title>
                                </v-layout>
                               </v-form>
                            </v-card>
                        </v-flex>

                        <v-flex class="text-xs-center" v-if="window.width >700">
                            <v-card-text>
                                <!-- <v-btn v-for="icon in icons"
                                :key="icon"
                                class="mx-3 white--text" icon>
                                    <v-icon size="24px">{{ icon }}</v-icon>
                                </v-btn> -->
                            </v-card-text>

                            <v-card-text class="white--text pt-0">
                                F&I Garage Management System
                                provides services for managing
                                internal work and services for customers'
                                convenience and internal staff. Can use effectively.
                            </v-card-text>

                            <v-divider></v-divider>
                            <v-card-text class="white--text">
                                &copy;2019 — <strong>F & I Garage</strong>
                            </v-card-text>
                        </v-flex>

                    </v-flex>

                    <v-flex md2 sm2 xs0>
                    </v-flex>

                </v-layout>

            </v-container>
        </v-parallax>
        <v-footer color="black" app>
            <v-spacer></v-spacer>
            <!-- <v-flex-text  class="white--text">&copy; F&I Garage 2019 </v-flex-text> -->
            <v-spacer></v-spacer>
        </v-footer>
        <v-dialog v-model="dialogQrcode" max-width="700px">
            <v-card>
                <v-card-text>
                    <h3 class="text-xs-center">F&I GARAGE</h3>
                    <!-- <qrcode-stream :paused="paused" :enable="fasle"></qrcode-stream> -->
                </v-card-text>
            </v-card>
        </v-dialog>

    </div>
</v-app>
</template>

<script>
import Vue from 'vue'
import Axios from 'axios'
import VueSession from 'vue-session'

import {
  QrcodeStream,
  QrcodeDropZone,
  QrcodeCapture,
} from 'vue-qrcode-reader'
import Datepicker from 'vuejs-datepicker';
import cer from './cer.vue'

Vue.use(VueSession)

export default {
  name: 'login',
  components: {
    cer,
    // eslint-disable-next-line vue/no-unused-components
    QrcodeStream,
    // eslint-disable-next-line vue/no-unused-components
    QrcodeDropZone,
    // eslint-disable-next-line vue/no-unused-components
    QrcodeCapture,
    // eslint-disable-next-line vue/no-unused-components
    Datepicker,
  },

  data() {
    return {
      menuBookingDate: false,
      pId: '',
      pIdRules: [
        v => !!v || 'กรุณากรอกข้อมูลเลขที่บัตรประชาชน',
        v => (v && v.length === 13) || 'เลขบัตรประชาชนของคุณไม่ถูกต้อง',
      ],

      fName: '',
      fNameRules: [
        v => !!v || 'กรุณากรอกชื่อ',
      ],

      lName: '',
      lNameRules: [
        v => !!v || 'กรุณากรอกนามสกุล',

      ],

      address: '',
      addressRules: [
        v => !!v || 'กรุณากรอกที่อยู่',

      ],

      lineIDRules: [
        v => !!v || 'กรุณากรอกไลน์ไอดี',

      ],
      telRules: [
        v => !!v || 'กรุณากรอกเบอร์โทรศัพท์',
        v => (v && v.length >= 10) || 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
      ],

      selectedItem_CMRules: [
        v => !!v || 'กรุณาเลือกยี่ห้อรถ',
      ],
      modelRules: [
        v => !!v || 'กรุณาเลือกรุ่นรถ',

      ],
      yearRules: [
        v => !!v || 'กรุณากรอกข้อมูลปีรถ',
        v => (v && v.length >= 4) || 'กรุณากรอกข้อมูลให้ถูกต้อง (ค.ศ xxxx)',
      ],
      DescRules: [
        v => !!v || 'กรุณากรอกข้อมูล',

      ],
      loginRules: [
        v => !!v || 'กรุณากรอกชื่อผู้ใช้',

      ],
      passwordRules: [
        v => !!v || 'กรุณากรอกรหัสผ่าน',
      ],
      emailRules: [
        v => !!v || 'กรุณากรอกอีเมลล์',
        v => /.+@.+/.test(v) || 'กรุณากรอกอีเมลล์ให้ถูกต้อง',
      ],


      toggle_exclusive: 0,
      Store: this.$store.state,
      valid: true,
      booking_loading: false,
      fromLogin: false,
      alertInsert: false,
      ErrorInsert: false,
      failedLogIn: false,
      dialogQrcode: '',
      dialog_Morword: false,
      dialog_Adminlogout: false,
      loading: false,
      Car_list_forAdd: [],
      loading_color: 'success',
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
      window: {
        width: 0,
        height: 0,
      },
      nullRules: [
        v => (v && v.length <= 0) || 'กรุณากรอกข้อมูลให้ครบถ้วน',
      ],
    }
  },
  created() {
    this.getCarMaker()
    window.addEventListener('resize', this.handleResize)
    this.handleResize();
    if (this.$session.get('usersloggedin')) {
      if (this.$session.get('userType') === 'Admin') {
        this.Store.IDforSELECT = this.$session.get('usersloggedin')
      } else if (this.$session.get('userType') === 'Customer') {
        this.Store.IDforSELECT = this.$session.get('usersloggedin')
      } else if (this.$session.get('userType') === 'Employee') {
        this.Store.IDforSELECT = this.$session.get('usersloggedin')
      }
      this.login = false
    }

    this.get_maker_list()
  },

  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  },

  methods: {
    fullname() {
      this.dialog = true
    },
    async getCarMaker() {
      const apicarlist = 'https://testtingfuck.000webhostapp.com/CarMaker_Select.php';
      const carReadParams = new URLSearchParams();
      carReadParams.append('Table', 'Car_Maker')
      // eslint-disable-next-line global-require
      const response = await Axios.post(apicarlist, carReadParams)
      this.Car_list_forAdd = response.data
    },

    async insert_booking() {
      // this.$validator.validateAll()
      this.booking_loading = true
      const api = 'https://testtingfuck.000webhostapp.com/Booking.php';
      console.log(this.booking)
      alert('asdsadsaads')
      const bookingParams = new URLSearchParams();
      bookingParams.append('name', this.booking.name)
      bookingParams.append('lastname', this.booking.lastname)
      bookingParams.append('lineID', this.booking.lineID)
      bookingParams.append('tel', this.booking.tel)
      bookingParams.append('Email', this.booking.Email)
      bookingParams.append('car_brand', this.booking.car_brand.CM_ID)
      bookingParams.append('car_model', this.booking.car_model)
      bookingParams.append('car_year', this.booking.car_year)
      bookingParams.append('come_in_date', this.booking.come_in_date)
      bookingParams.append('broken_desc', this.booking.broken_desc)

      // console.log('name', this.booking.name)
      // console.log('lastname', this.booking.lastname)
      // console.log('lineID', this.booking.lineID)
      // console.log('tel', this.booking.tel)
      // console.log('Email', this.booking.Email)
      // console.log('car_brand', this.booking.car_brand.CM_ID)
      // console.log('car_model', this.booking.car_model)
      // console.log('car_year', this.booking.car_year)
      // console.log('come_in_date', this.booking.come_in_date)
      // console.log('broken_desc', this.booking.broken_desc)
      const response = await Axios.post(api, bookingParams)

      console.log(response.data)

      if (response.data === 1) {
        this.alertInsert = true;
        setTimeout(() => {
          this.alertInsert = false;
        }, 10000);
      } else {
        this.ErrorInsert = true;
        setTimeout(() => {
          this.ErrorInsert = false;
        }, 10000);
      }

      this.booking_loading = false
    },

    checkUser() {
      if (this.fromLogin === true) {
        this.loading = true
        this.loading_color = 'red'
        console.log('in methods')
        const api = 'https://testtingfuck.000webhostapp.com/checklogin.php';
        const LoginParams = new URLSearchParams();

        LoginParams.append('username', this.login_data.username)
        LoginParams.append('password', this.login_data.password)

        Axios.post(api, LoginParams)
          .then((response) => {
            const readData = response.data

            if (readData.length === 0) {
              this.failedLogIn = true;
              setTimeout(() => {
                this.failedLogIn = false;
              }, 5000);
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
              // alert(this.Store.display_page)
              this.$session.set('usersloggedin', response.data[0].Owner_ID)
              this.$session.set('userType', Utype)
              this.Store.IDforSELECT = response.data[0].Owner_ID
              console.log(`store id=${this.Store.IDforSELECT}`)
              this.Store.login_page = false
            }
            this.loading = false
            this.loading_color = 'success'
          })
      }
    },

    async get_maker_list() {
      const api = 'https://testtingfuck.000webhostapp.com/CarMaker_Select.php';
      const params = new URLSearchParams();

      params.append('Table', 'Car_Maker')
      const response = await Axios.post(api, params)

      if (response.data.length === 0) {
        console.log('Table: Car_Maker Error')
      } else if (response.data.length !== 0) {
        this.Car_list_forAdd = response.data
      }
    },

    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },

  },
}
</script>
