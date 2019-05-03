<template>
<v-app>
    <v-layout>

        <v-toolbar class="v-toolbar  v-toolbar--fixed theme--dark red elevation-6" style="margin-top:0px;padding-right:0px;padding-left:0px;transform:translateY(0px);">
            <v-flex title>
                Mechanic
            </v-flex>
            <v-flex>
                <v-flex title justify-center>{{moment().format('DD/MM/YYYY')}}</v-flex>
            </v-flex>

            <!-- รูปโปรไฟล์ของช่าง -->
            <v-avatar>
                <v-tooltip left>
                    <template v-slot:activator="{ on }">
                        <v-btn icon v-on="on" @click.stop="dialog_Morword = true">
                            <v-icon size="40">account_circle</v-icon>
                        </v-btn>
                    </template>
                    <span>User & Logout</span>
                </v-tooltip>
            </v-avatar>

        </v-toolbar>

        <main class="v-content__wrap" full-hight>
            <v-card v-if="window.width < 600" height="55" color="black"></v-card>
            <v-card v-if="window.width > 600" height="64" color="black"></v-card>
            <v-card height="700" color="">
                <v-expansion-panel focusable pt-3 mt-4>
                    <v-expansion-panel-content v-for="item in display_wip">
                        <template v-slot:header>
                            <div>
                                <h3>{{item.W_ID}} | {{item.CM_Name}} {{item.Model}} {{item.Car_Year}} - {{item.License_plate}} </h3>
                            </div>
                        </template>

                        <v-card color="grey lighten-3">
                          <v-flex>
                            <v-layout>
                                <v-flex md11 xl11 sm11 lg11 xs11>
                                    <v-card-text>
                                        <v-flex>
                                            <h3>
                                                <p> Work ID : {{item.W_ID}} </p>
                                            </h3>
                                        </v-flex>
                                        <v-divider></v-divider>
                                        <v-divider></v-divider>
                                        <v-flex mt-3 headline font-weight-bold>
                                            <v-icon>insert_drive_file</v-icon> รายละเอียดงาน
                                        </v-flex>
                                        <v-flex mt-3 ml-3>
                                            <p><b> Car : </b> {{item.CM_Name}} {{item.Model}} </p>
                                            <p><b> Year : </b>{{item.Car_Year}}</p>
                                            <!-- <p><b> Color :</b> {{item.Color}}</p> -->
                                            <p><b> Licens plate : </b>{{item.License_plate}}</p>
                                            <p><b> Customer : </b> {{item.cus_name}}</p>
                                            <p><b> อาการเบื้องต้น : </b> {{item.W_Desc}}</p>
                                            <p><b> ช่างผู้รับผิดชอบ : </b>{{item.emp_name}}</p>
                                            <!-- <p><b> Status :</b>{{item.Status}} -->
                                        </v-flex>
                                    </v-card-text>

                                    <v-flex>
                                        <v-flex>
                                            <v-layout justify-center wrap>
                                                <v-btn style="border-radius:20px 20px 0px 0px" color="light-green darken-1" dark @click="dialogFI = true,key_timeline=item.W_ID,this.$awn.success('Your custom message')">Update <v-icon>history </v-icon>
                                                </v-btn>
                                            </v-layout>
                                        </v-flex>
                                        <v-flex>
                                            <v-layout justify-center wrap v-for="day in dayleft" v-if="day.W_ID===item.W_ID">
                                                <b class="red--text">เหลือเวลาอีก {{day.day_left}} วัน จะถึงกำหนด</b>
                                            </v-layout>
                                        </v-flex>
                                    </v-flex>
                                </v-flex>
                                <v-flex md1 xl1 sm1 lg1 xs1 class="grey lighten-3">
                                  <v-layout justify-end wrap>
                                    <v-tooltip left>
                                        <template v-slot:activator="{ on }">
                                            <v-btn small fab dark color="green" v-on="on" class="elevation-10" style="margin-top:10px;" @click="getDataExpansDialog_confrim(item),alert = false">
                                                <v-icon dark>check_circle</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>ยืนยันรับงาน</span>
                                    </v-tooltip>
                                    </v-layout>
                                </v-flex>


                            </v-layout>
                          </v-flex>
                        </v-card>

                        <!-- Dialog update timline -->
                        <v-dialog v-model="dialogFI" fullscreen hide-overlay persistent>
                            <v-card>

                                <v-toolbar card dark color="red lighten-1">
                                    <v-btn icon dark @click="dialogFI = false">
                                        <v-icon>close</v-icon>
                                    </v-btn>
                                    <v-toolbar-title>Timeline & Update</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-toolbar-items>
                                        <v-btn dark flat @click="dialogFI = false">OK</v-btn>
                                    </v-toolbar-items>
                                </v-toolbar>

                                <v-alert :value="alertInsert" type="success" transition="scale-transition" dismissible Color="red">
                                    update งานสำเร็จ</v-alert>
                                <v-alert :value="ErrorInsert" type="error" transition="scale-transition" dismissible>
                                    ระบบไม่สามารถทำการให้ท่านได้.. โปรดตรวจสอบข้อมูลหรือการเชื่อมต่อ และลองใหม่อีกครั้งภายหลัง!</v-alert>
                                <v-container style="max-width: 600px;">
                                    <v-timeline dense align-top clipped>
                                        <v-timeline-item fill-dot class="white--text" color="orange" large>
                                            <template v-slot:icon><span>JL</span></template>
                                            <v-text-field outline v-model="input_header" hide-details flat label="กรอกรายละเอียด คลิกที่นี่.. " solo @click.stop="Post= true" @keydown.enter="comment">
                                                <template v-slot:append>

                                                    <v-flex>
                                                        <v-layout justify-centee>
                                                            <upload-btn icon ripple :fileChangedCallback="onChangeFileUpload">
                                                                <template slot="icon-left">
                                                                    <v-icon color="white">add_photo_alternate</v-icon>
                                                                </template>
                                                            </upload-btn>
                                                            <v-btn class="mx-0" icon @click="comment()">
                                                                <v-icon large color="blue">send</v-icon>
                                                            </v-btn>
                                                        </v-layout>
                                                    </v-flex>
                                                </template>
                                            </v-text-field>

                                            <v-flex>
                                                <v-layout justify-start>
                                                    <v-flex>
                                                        <v-chip small close v-for="(item,i) in 3" v-model="chip1">
                                                            <v-avatar class="elevation-5">
                                                                <img src="https://randomuser.me/api/portraits/men/35.jpg" alt="trevor" width="15" height="20" @click.stop = "dialog_picture= true">
                                              </v-avatar>
                                                        </v-chip>
                                                    </v-flex>
                                                </v-layout>
                                            </v-flex>

                                            <v-dialog v-model="Post" max-width="700px" persistent>
                                                <v-card color="grey lighten-3">
                                                    <v-layout wrap>
                                                        <v-flex>
                                                            <v-flex ml-3 mt-1>
                                                                <v-layout>
                                                                    <v-flex>
                                                                        <v-card-title>
                                                                            <h2>Post it</h2>
                                                                        </v-card-title>
                                                                    </v-flex>
                                                                    <v-flex mt-1 mr-1>
                                                                        <v-layout justify-end>
                                                                            <v-btn dark :disabled="!valid" color="blue darken-3" @click.stop="Post = false"> OK <v-icon color="white">exit_to_app</v-icon>
                                                                            </v-btn>
                                                                        </v-layout>
                                                                    </v-flex>
                                                                </v-layout>
                                                            </v-flex>
                                                            <v-form ref="form" v-model="valid" lazy-validation>
                                                                <v-flex ml-4 mr-4>
                                                                    <v-flex>
                                                                        <v-text-field :rules="nullRules" v-model="input_header" label="หัวข้อ" outline></v-text-field>
                                                                    </v-flex>
                                                                    <v-flex>
                                                                        <v-textarea :rules="nullRules" label="รายละเอียด" v-model="input_desc" box>oik</v-textarea>
                                                                    </v-flex>
                                                                </v-flex>
                                                            </v-form>
                                                            <!-- <v-flex mb-3 mr-3>
                                            <v-layout justify-end>
                                          <v-btn dark color="blue darken-3" @click.stop="input,Post = false"> OK <v-icon color="white">exit_to_app</v-icon></v-btn>
                                            </v-layout>
                                        </v-flex> -->
                                                        </v-flex>

                                                    </v-layout>
                                                </v-card>
                                            </v-dialog>
                                        </v-timeline-item>

                                        <!-- <v-timeline-item class="mb-4" hide-dot>
                                  <span>TODAY {{key_timeline}}</span>
                                </v-timeline-item> -->
                                        <v-slide-x-transition group>
                                            <v-timeline-item class="mb-3" small color="pink" v-for="timelineR in display_timeline" :key="timelineR.Report_ID" v-if="timelineR.W_ID===key_timeline">
                                                <v-card class="elevation-15">
                                                    <v-layout justify-space-between pt-3 pb-3 pr-3 pl-3>
                                                        <v-flex xs8>
                                                            <v-chip class="white--text ml-0" color="purple" label small>
                                                                รายงานผลปกติ
                                                            </v-chip><br/>
                                                            &nbsp;
                                                            <b>{{timelineR.Report_Name}}</b><br/>
                                                            <p><br/>&nbsp;&nbsp;&nbsp;{{timelineR.Description}}</p>
                                                        </v-flex>

                                                        <v-flex xs4 text-xs-right>{{timelineR.DateTime_Created}} <br/><b>M.{{item.emp_name}}</b></v-flex>
                                                    </v-layout>
                                                </v-card>
                                            </v-timeline-item>
                                        </v-slide-x-transition>
                                    </v-timeline>
                                </v-container>
                            </v-card>
                        </v-dialog>

                    </v-expansion-panel-content>
                </v-expansion-panel>

                <!-- Dailog User detail กดรูป -->
                <v-dialog v-model="dialog_Morword" max-width="350">
                    <v-card>
                        <v-list class="grey darken-4 white--text">
                            <v-list-tile avatar>
                                <v-list-tile-avatar>
                                    <img src="https://testtingfuck.000webhostapp.com/imageLogo/IconMechanic.png">
                              </v-list-tile-avatar>

                                    <v-list-tile-content>
                                        <v-list-tile-title>{{this.UserData[0].Emp_Name}} {{this.UserData[0].Emp_Lname}}</v-list-tile-title>
                                        <v-list-tile-sub-title class="white--text">ตำแหน่ง: Mechanicle</v-list-tile-sub-title>
                                    </v-list-tile-content>

                                    <v-list-tile-action>
                                        <v-tooltip left>
                                            <template v-slot:activator="{ on }">
                                                <v-btn color="blue" v-on="on" icon flat @click="log_out()">
                                                    <v-icon>logout</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>Logout</span>
                                        </v-tooltip>
                                    </v-list-tile-action>
                            </v-list-tile>
                            <!-- logoutdialog (key for search)-->
                        </v-list>
                        <v-divider></v-divider>
                        <v-card-text class="grey lighten-2">
                            <v-list-tile-title><b>รหัสพนักงาน : </b>{{this.UserData[0].Emp_ID}} </v-list-tile-title>
                        </v-card-text>
                        <v-divider class="grey lighten-1"></v-divider>
                        <v-divider class="grey lighten-1"></v-divider>

                        <v-card-actions class="grey lighten-2">
                            <v-flex font-italic ml-2>
                                <h4>F & I GARAGE</h4>
                            </v-flex>

                            <v-btn color="red" class="white--text" style="border-radius:70px 0px 70px 0px" @click="dialog_Morword = false">Close</v-btn>
                        </v-card-actions>

                    </v-card>
                </v-dialog>
            </v-card>

        </main>

        <v-footer color="black" app>
            <v-spacer></v-spacer>
            <v-flex-text class="white--text">&copy; F&I Garage 2019 Mechanic</v-flex-text>
            <v-spacer></v-spacer>
        </v-footer>

    </v-layout>
</v-app>
</template>

<script>
import DigitalClock from 'vue-digital-clock';
import moment from 'moment'
import Clock from 'vue-clock2'
// eslint-disable-next-line no-unused-vars
import Vue from 'vue'
import Axios from 'axios'
import VueSession from 'vue-session'
// eslint-disable-next-line no-unused-vars
import UploadButton from 'vuetify-upload-button';
// eslint-disable-next-line no-unused-vars
import Vuetify from 'vuetify'
import VueAWN from 'vue-awesome-notifications'

Vue.use(VueSession)
Vue.use(VueAWN)

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
    // eslint-disable-next-line vue/no-unused-components
    'upload-btn': UploadButton,
    // eslint-disable-next-line vue/no-unused-components
    DigitalClock,
    // eslint-disable-next-line vue/no-unused-components
    VueAWN,
    // eslint-disable-next-line vue/no-unused-components

  },
  data() {
    return {
      UserData: [],
      nullRules: [
        v => (v.length > 0) || 'กรุณากรอกข้อมูลให้ครบถ้วน',
      ],
      valid: true,
      Store: this.$store.state,
      key_timeline: '',
      alertNotfound: false,
      dialog_picture: false,
      dialog_logout: false,
      alertInsert: false,
      ErrorInsert: false,
      Post: false,
      events: [],
      input_header: null,
      input_desc: null,
      nonce: 0,
      dialogFI: false,
      notifications: false,
      dialog_Morword: false,
      sound: true,
      widgets: false,
      HeaderTxt: '',
      drawer: true,
      myDate: null,
      dayleft: null,
      Mechanicle: true,
      display_wip: [],
      data_to_insert: [{
        W_ID: null,
        Report_ID: null,
        img_name: null,
        img_data: null,
      }],
      display_timeline: [],
      moment,
      window: {
        width: 0,
        height: 0,
      },
      // login: true,
      right: null,
    }
  },
  beforeCreate() {

  },
  watch: {
    display_timeline() {
      return this.display_timeline.slice().reverse()
    },
  },
  mounted() {
    const a = this.Store.IDforSELECT;
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
        this.Display_user_nav.fullname = `${this.UserData[0].Emp_Name} ${this.UserData[0].Emp_FName}`
        this.Display_user_nav.nickname = this.UserData[0].Nickname
      })
    console.log(this.$vuetify.breakpoint)
    // alert(`session is : ${this.$session.get('usersloggedin')}`)
  },

  created() {
    window.addEventListener('resize', this.handleResize)
    this.handleResize();

    const api = 'https://testtingfuck.000webhostapp.com/select_wip_forEmp.php';
    const wip_id_param = new URLSearchParams();
    wip_id_param.append('Emp_ID', this.Store.IDforSELECT)
    Axios.post(api, wip_id_param)
      .then((response) => {
        this.display_wip = response.data

        if (this.display_wip.length === 0) {
          console.log('wrong pass or username')
          this.alertNotfound = true
        } else if (this.display_wip.length !== 0) {
          console.log('reading')
        }
      })

    const api2 = 'https://testtingfuck.000webhostapp.com/select_timeline.php';
    Axios.post(api2)
      .then((response) => {
        this.display_timeline = response.data
        if (this.display_timeline.length === 0) {
          this.alertNotfound = true
        } else if (this.display_timeline.length !== 0) {
          console.log(this.display_timeline)
        }
      })

    const api3 = 'https://testtingfuck.000webhostapp.com/select_left_day.php';
    const day_param = new URLSearchParams();
    day_param.append('Emp_ID', this.Store.IDforSELECT)
    day_param.append('date', moment().format('YYYY-MM-DD'))

    Axios.post(api3, day_param)
      .then((response) => {
        this.dayleft = response.data
        if (this.display_timeline.length === 0) {
          this.alertNotfound = true
        } else if (this.display_timeline.length !== 0) {
          console.log('dayyyy')
          // alert(this.dayleft.length)
          // alert(typeof (Number(this.dayleft[0].day_left)))
          console.log(this.dayleft)
        }
      })
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  },
  methods: {
    momentInsert(date) {
      const year = Number(moment(date).format('YYYY'))
      // console.log(year.length)
      const month = moment(date).format('MM')
      const day = moment(date).format('DD')
      const time = moment().format('HHmmss')
      const currentDate = `${(year) + month + day}${time}`
      // this.currentDate = currentDate
      return currentDate;
    },
    comment() {
      this.events.push({
        // eslint-disable-next-line no-plusplus
        id: this.nonce++,
        header: this.input_header,
        text: this.input_desc,
        reporter: this.key_timeline,
        time: this.momentInsert(moment().format('YYYYMMDD')),
      })
      const itemToInsert = [{
        Iw_ID: this.key_timeline,
        Report_Name: this.input_header,
        Description: this.input_desc,
        Pic_total: 0, // อยาลืมแก้ให้ระบุจำนวนรูปได้
        DateTime_Created: this.momentInsert(moment().format('YYYYMMDD')),
        Emp_ID_Posted: this.Store.IDforSELECT,
      }];

      this.insert_timeline(itemToInsert)
      this.update_timeline()

      console.log('this.events', this.events)
      this.input_header = null
      this.input_desc = null
    },
    update_timeline() {
      const api2 = 'https://testtingfuck.000webhostapp.com/select_timeline.php';
      Axios.post(api2)
        .then((response) => {
          this.display_timeline = response.data
          console.log('loooooop =', this.display_timeline.length)
          if (this.display_timeline.length === 0) {
            this.alertNotfound = true
          } else if (this.display_timeline.length !== 0) {
            console.log('update finish')
            console.log(this.display_timeline)
          }
        })
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
    get_date_now() {
      return moment((new Date()).toDateString(), 'DD/MM/YYYY').format('YYYYMMDD')
    },
    moment_format(date) {
      const year = Number(moment(date).format('YYYY'))
      const month = moment(date).format('MM')
      const day = moment(date).format('DD')
      const time = moment().format('h:mm:ssa')
      const currentDate = `${(year + 543) + month + day} ${time}`
      return currentDate;
    },
    async insert_timeline(dataToInsert) {
      const api2 = 'https://testtingfuck.000webhostapp.com/insert_timeline.php';
      const dataJson = JSON.stringify(dataToInsert)
      console.log('json to insert= ', dataJson)
      const paramInsert = new URLSearchParams();
      paramInsert.append('data_insert', dataJson)
      // const check = false
      // Axios.post(api2, paramInsert)
      //   .then((response) => {
      const response = await Axios.post(api2, paramInsert)
      const res = response.data
      console.log(res.count)
      console.log(res)
      if (res === 1) {
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
    },

    log_out() {
      this.$session.clear()
      this.$session.destroy()
      this.Store.display_page = 'Login'
      this.dialog_Morword = false
    },
    onChangeFileUpload(fileInput) {
      this.file = fileInput
      this.addDataImg(this.Store.IDforSELECT)
    },
    async addDataImg(IdOfEmp) {
      console.log(this.file)
      for (let i = 0; i < this.file.length; i += 1) {
        const filename = this.file[i].name

        // if (filename.includes('.jpg') || filename.includes('.png')) {
        //   formData.append('file', this.file[i]);
        //   console.log(`databefore sent=${this.file[i].name}`)
        //   formData.append('name', this.file.name)
        // }
        // const blob = this.file[i].slice(0, this.file[i].size, 'image/png');
        // const newFile = new File([blob], 'name.png', { type: 'image/png' });
        const dataset = {
          W_ID: null,
          img_name: null,
          img_data: null,
        }
        // eslint-disable-next-line no-await-in-loop
        const test = await this.getBase64(this.file[i])
        console.log(test)
        dataset.img_data = test
        dataset.img_name = filename
        dataset.W_ID = IdOfEmp
        dataset.Report_ID = '2'
        this.data_to_insert.push(dataset)
      }
      const jsonS = JSON.stringify(this.data_to_insert)
      console.log(jsonS)
    },

    getBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
      });
    },

  },
  computed: {
    timeline() {
      return this.events.slice().reverse()
    },
    timeline2() {
      return this.display_timeline.slice().reverse()
    },
  },
}
</script>

<style scoped>
/* move scrollbar out of page*/
#content browser {
    margin-right: -14px !important;
    overflow-y: scroll;
}
</style>
