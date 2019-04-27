<template>
<v-card width="100%">
    <v-expansion-panel focusable :pagination.sync="pagination" class="elevation-13">
        <v-expansion-panel-content v-for="item in Get_Data_WID">

            <template v-slot:header>
                <div>
                    <h3>{{item.W_ID}} - {{item.License_plate}}
                        <v-icon color="amber accent-4">mail</v-icon>
                    </h3>
                </div>
            </template>

            <v-card color="grey lighten-3">
                <v-flex>
                    <v-layout>
                        <v-flex md11 xl11 sm11 lg11 xs11>
                            <v-card-text class="grey lighten-3">
                                <v-flex mb-2>
                                    <h3><b> W ID :</b> {{item.W_ID}} </h3>
                                </v-flex>
                                <v-divider></v-divider>
                                <v-flex mt-2>
                                    <h3>รายระเอียดงาน</h3><br/>
                                    <v-flex ml-3>
                                        <p><b> Car :</b> {{item.CM_Name}} {{item.Model}} </p>
                                        <p><b> Year :</b> {{item.Car_Year}}</p>

                                        <p><b> Licens plate : </b>{{item.License_plate}}</p>
                                        <p><b> Customer :</b> {{item.cus_name}}</p>
                                        <p><b> อาการเบื้องต้น :</b> {{item.W_Desc}}</p>
                                        <p><b> ช่างผู้รับผิดชอบ :</b> {{item.emp_name}}</p>
                                        <p><b> Status :</b> {{item.Status}}

                                            <v-icon v-if="0==1" color="amber accent-4">error</v-icon>

                                            <v-icon v-if="1==1" color="green">offline_pin</v-icon>
                                        </p>
                                    </v-flex>
                                </v-flex>
                            </v-card-text>
                        </v-flex>
                        <v-flex md1 xl1 sm1 lg1 xs1 class="grey lighten-3">
                            <v-layout justify-end wrap>
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn fab dark right color="orange accent-3" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_Edit = true,alert = false">
                                            <v-icon dark>edit</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>แก้ไขวันรับรถ</span>
                                </v-tooltip>
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn fab dark right color="green" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_confrim= true,alert = false">
                                            <v-icon dark>check_circle</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>ยืนยันรับงาน</span>
                                </v-tooltip>

                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn fab dark right color="red" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_delete = true,alert = false">
                                            <v-icon dark>delete_forever</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>ลบคิว</span>
                                </v-tooltip>

                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn fab dark right color="blue" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_Timeline = true,getDataExpans(item.W_ID)">
                                            <v-icon dark>storage</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>ไทม์ไลน์</span>
                                </v-tooltip>

                            </v-layout>
                        </v-flex>
                    </v-layout>
                </v-flex>

                <v-dialog v-model="dialog_confrim" persistent max-width="700px">
                    <v-card color="grey darken-4" elevation="10">
                        <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                            <v-layout wrap mt-1>
                                <v-flex mt-2 mb-2 class="white--text">
                                    <h2>
                                        <v-icon medium color="red">description</v-icon> Work ID : {{item.W_ID}}
                                    </h2>
                                </v-flex>
                                <v-card elevation="3" color="grey lighten-3" width="100%">
                                    <v-layout wrap pl-4 pr-4 pb-3 pt-3 subheading>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>Car : </b> {{item.CM_Name}}</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>Year : </b> {{item.Car_Year}}</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>ทะเบียน : </b> {{item.License_plate}}</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>ลูกค้า :</b> {{item.cus_name}}</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>อาการเบื้องต้น :</b> {{item.W_Desc}}</div>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>ช่างผู้รับผิดชอบ :</b> {{item.emp_name}}</div>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>Status :</b> {{item.Status}}</div>
                                        </v-flex>

                                    </v-layout>
                                </v-card>

                            </v-layout>
                        </v-container>
                        <!-- <small>*indicates required field</small> -->
                        <v-flex pl-3 pr-3>
                            <v-card-actions>
                                <v-flex>
                                    <img src="https://testtingfuck.000webhostapp.com/imageLogo/ForBgDark.png" width="170" height="50">
                            </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-btn color="red" class="white--text" @click="dialog_confrim = false,insert = true">Cancel</v-btn>
                                    <v-btn color="red" class="white--text" @click="dialog_confrim = false,alert = !alert">OK</v-btn>
                            </v-card-actions>
                        </v-flex>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="dialog_delete" max-width="300">
                    <v-card>
                        <v-card-title class="headline grey darken-4 white--text" primary-title>F&I Garage -
                            <v-icon large color="red"> delete_forever</v-icon>-
                        </v-card-title>

                        <v-card-text>
                            <h4>Work ID : {{item.W_ID}} คุณต้องลบรายการนี้หรือไม่ ?</h4>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="red white--text" @click="dialog_delete = false">No</v-btn>
                            <v-btn color="red white--text" @click="dialog_delete = false">Yes</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="dialog_Edit" persistent max-width="700px">
                    <v-card color="grey darken-4" class="white--text">
                        <v-card-text>
                            <h1 class="text-xs-center red--text">Edit Queue</h1>
                            <h3 class="text-xs-center">F&I GARAGE</h3>

                            <v-container grid-list-md style="padding: 0px 10px 10px 15px;">
                                <v-layout wrap>

                                    <v-card-text>แผนงาน</v-card-text>

                                    <v-card elevation="0" color="grey lighten-3" width="100%">
                                        <v-layout wrap pl-4 pr-4 pt-2>

                                            <v-flex xs12 sm6 pr-2>
                                                <v-menu ref="menu1" v-model="menu1" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width max-width="290px" min-width="290px">
                                                    <template v-slot:activator="{ on }">
                                                        <v-text-field v-model="dateFormatted" label="กำหนดวันเสร็จสิ้นและส่งมอบงาน" persistent-hint prepend-icon="event" @blur="date = parseDate(dateFormatted)" v-on="on" readonly></v-text-field>
                                                    </template>
                                                    <v-date-picker v-model="date" no-title @input="menu1 = false"></v-date-picker>
                                                </v-menu>
                                            </v-flex>

                                            <v-flex xs12 sm6>
                                                <v-select :items="Mac_for_newQ" value="Emp_ID" v-model="selectedItem_Owner" item-text="Mac_Name" label="ช่างผู้รับผิดชอบ" v-on:change="changeRoute(selectedItem_Owner.Emp_ID)" single-line return-object></v-select>
                                            </v-flex>
                                        </v-layout>
                                    </v-card>

                                    <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                                    <v-card elevation="0" color="grey lighten-3" width="100%">
                                        <v-layout wrap pl-4 pr-4 pb-3>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>ชื่อ-สกุล : </b>{{item.name}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>Line ID : </b> {{item.lineID}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>เบอร์โทรศัพท์ : </b> {{item.tel}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>อีเมลล์ :</b> {{item.Email}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>เบอร์โทร :</b> 0916984687</div>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>Car :</b> {{item.car_brand+' '+item.car_model}}</div>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>Year :</b> {{item.car_year}}</div>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>อาการเบื้องต้น :</b> {{item.broken_desc}}</div>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>วันที่ต้องการนำรถมาเข้ารับบริการ :</b> {{item.come_in_date}}</div>
                                            </v-flex>
                                        </v-layout>
                                    </v-card>

                                </v-layout>
                            </v-container>
                            <!-- <small>*indicates required field</small> -->

                            <v-card-actions>
                                <v-flex>
                                    <img src="https://testtingfuck.000webhostapp.com/imageLogo/ForBgDark.png" width="170" height="50">
                            </v-flex>
                                    <v-spacer></v-spacer>
                                    <v-btn color="red" class="white--text" @click="dialog_Edit = false,insert = true">Cancel</v-btn>
                                    <v-btn color="red" class="white--text" @click="dialog_Edit = false,alert = !alert">OK</v-btn>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="dialog_Timeline"  max-width="700px">
                    <v-card>
                        {{dialog_Timeline}}
                        <v-flex headline pt-2 pb-3>
                            <v-layout>
                                <v-flex xs11 md11 xl11 lg11 sm11 ml-4 mt-3 >
                                    <h3>Timeline</h3>
                                    <h6>{{item.CM_Name}} {{item.Model}}</h6>
                                    </v-flex>
                                <v-flex xs1 md1 xl1 lg1 sm1 mr-2>
                                     <v-btn fab small color="red" class="white--text" @click="dialog_Timeline = false,alert = !alert">
                                         <v-icon>chevron_right</v-icon>
                                     </v-btn>
                                </v-flex>

                            </v-layout>
                        </v-flex>
                        <v-flex pr-2 pl-2>
                            <v-layout justify-center>
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
                                        <span><h3>TODAY</h3></span>
                                    </v-timeline-item>

                                    <v-timeline-item class="mb-3" small v-for="timelineR in Get_Data_Timeline" v-if="timelineR.W_ID===item.W_ID">
                                        <v-card class="elevation-15">
                                            <v-layout justify-space-between pt-3 pb-3 pr-3 pl-3>
                                                <v-flex xs7>
                                                    <v-chip class="white--text ml-0" color="purple" label small>
                                                        รายงานผลปกติ
                                                    </v-chip>
                                                    &nbsp;
                                                    <b>{{timelineR.Report_Name}}</b><br/>
                                                    <p><br/>&nbsp;&nbsp;&nbsp;{{timelineR.Description}}</p>
                                                </v-flex>

                                                <v-flex xs5 text-xs-right>
                                                    <v-layout justify-end wrap>
                                                        <v-flex xs12 md12 xl12 lg12 sm12>{{timelineR.DateTime_Created}}</v-flex>
                                                        <v-flex mt-1 xs12 md12 xl12 lg12 sm12>
                                                            <h4>M.{{item.emp_name}}</h4>
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
        </v-expansion-panel-content>
    </v-expansion-panel>

</v-card>
</template>

<script>
import moment from 'moment'
import Clock from 'vue-clock2'
import Axios from 'axios'

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
  },
  created() {
    const api = 'https://testtingfuck.000webhostapp.com/select_display_cars.php';
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
          console.log('wrong pass or username')
          alert('table is null or error')
          // eslint-disable-next-line eqeqeq
        } else if (readData != 0) {
          console.log('reading')
          this.Get_Data_WID = readData
        }
      })

    const api2 = 'https://testtingfuck.000webhostapp.com/select_timeline.php';
    let readData2 = new Array();
    Axios.post(api2)
      .then((response) => {
        readData2 = response.data
        console.log('loooooop =', readData.length)
        // eslint-disable-next-line eqeqeq
        if (readData2.length == 0) {
          alert('table is null or error')
          // eslint-disable-next-line eqeqeq
        } else if (readData2 != 0) {
          console.log(readData2)
          this.Get_Data_Timeline = readData2
        }
      })

    console.log('in create')
    // this.read_table('WorkInProcess')
  },
  data() {
    return {
      timelineWID: '',
      dialog_Edit: false,
      dialog_Timeline: false,
      dialog_confrim: false,
      dialog_delete: false,
      search: '',
      pagination: {},
      selected: [],
      Get_Data_WID: [],
      Get_Data_Timeline: [],
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
  },
  methods: {
    getDataExpans(data) {
      this.timelineWID = data
    //   console.log('kkkkkkkk',this.timelineWID)
    },
    moment() {
      return moment();
    },
  },
}
</script>
