<template>
<v-card width="100%">
    <v-tooltip bottom>
        <template v-slot:activator="{ on }">
            <v-btn fab dark fixed right bottom color="pink" v-on="on" class="elevation-10" style="margin-bottom:10px;" @click="dialog_Insert = true,alert = false">
                <v-icon dark>add</v-icon>
            </v-btn>
        </template>
        <span>Insert work</span>
    </v-tooltip>
    <v-expansion-panel focusable :pagination.sync="pagination" class="elevation-13">
        <v-expansion-panel-content v-for="item in Get_Data_WID">
            <template v-slot:header>
                <div>
                    <h3><b v-if="moment(myDate).format('YYYY-MM-DD') === item.Start_Date" class="red--text">{{item.Start_Date}}</b>
                        <b v-else>{{item.Start_Date}}</b>
                        | {{item.W_ID}} | {{item.CM_Name}} {{item.Model}} - {{item.License_plate}}
                        <v-icon v-if="moment(myDate).format('YYYY-MM-DD') === item.Finish_Date" color="amber accent-4">alarm</v-icon>

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
                                <v-divider></v-divider>
                                <v-flex mt-2>
                                    <h2>
                                        <v-icon> list_alt</v-icon> รายระเอียดงาน
                                    </h2><br/>
                                    <v-flex ml-3>
                                        <p><b> Car :</b> {{item.CM_Name}} {{item.Model}} </p>
                                        <p><b> Year :</b> {{item.Car_Year}}</p>

                                        <p><b> Licens plate : </b>{{item.License_plate}}</p>
                                        <p><b> Customer :</b> {{item.cus_name}}</p>
                                        <p><b> อาการเบื้องต้น :</b> {{item.W_Desc}}</p>
                                        <p><b> ช่างผู้รับผิดชอบ :</b> {{item.emp_name}}</p>
                                        <p><b> วันเริ่มงาน :</b> {{item.Start_Date}}</p>
                                        <p><b> วันส่งงาน :</b> {{item.Finish_Date}} <b class="red--text" v-if="moment(myDate).format('YYYY-MM-DD') === item.Finish_Date">Today !</b></p>

                                        <p v-if="item.Status == 0"><b> Status :</b> Error
                                            <v-icon color="amber accent-4">error</v-icon>
                                        </p>
                                        <p v-if="item.Status == 1"><b> Status :</b> Inprocess
                                            <v-icon v-if="item.Status == 1" color="green">hourglass_empty</v-icon>
                                        </p>
                                        <p v-if="item.Status == 2"><b> Status :</b> Complete
                                            <v-icon color="green">offline_pin</v-icon>
                                        </p>
                                    </v-flex>
                                </v-flex>
                            </v-card-text>
                        </v-flex>
                        <v-flex md1 xl1 sm1 lg1 xs1 class="grey lighten-3">
                            <v-layout justify-end wrap>
                                <v-flex text-xs-right md12 xl12 sm12 lg12 xs12>
                                    <v-tooltip left>
                                        <template v-slot:activator="{ on }">
                                            <v-btn small fab dark right color="orange accent-3" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_Edit = true,dateEditID=item.W_ID,alert = false">
                                                <v-icon dark>edit</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>แก้ไขวันรับรถ</span>
                                    </v-tooltip>
                                </v-flex>
                                <v-flex text-xs-right md12 xl12 sm12 lg12 xs12>
                                    <v-tooltip left>
                                        <template v-slot:activator="{ on }">
                                            <v-btn small fab dark right color="red" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_delete = true,WidForDeleteBT=item.W_ID,alert = false">
                                                <v-icon dark>delete_forever</v-icon>
                                            </v-btn>
                                        </template>
                                        <span>ยกเลิกงานนี้</span>
                                    </v-tooltip>
                                </v-flex>
                                <v-flex text-xs-right md12 xl12 sm12 lg12 xs12>
                                    <v-tooltip left>
                                        <template v-slot:activator="{ on }">
                                            <v-btn small fab dark right color="blue" v-on="on" class="elevation-10"  style="margin-top:10px;" @click="getDataExpans(item)">
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
                            <h4>Work ID : {{WidForDeleteBT}} <br/> คุณต้องลบรายการนี้หรือไม่ ?</h4>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn style="border-radius:40px 0px 0px 0px;" color="red white--text" @click="dialog_delete = false">No</v-btn>
                            <v-btn style="border-radius:0px 0px 40px 0px;" color="red white--text" @click="deletewip(WidForDeleteBT),dialog_delete = false">Yes</v-btn>
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
                                <!-- {{dateFormatted}} {{date}} -->
                                    <v-card-text>แผนงาน </v-card-text>

                                    <v-card elevation="0" style="border-radius:40px 0px 0px 0px;" color="grey lighten-3" width="100%">
                                        <v-layout wrap pl-4 pr-4 pt-2>

                                            <v-flex xs12 sm6 pr-2>

                                                <v-menu ref="menu1" v-model="menu1" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width max-width="290px" min-width="290px">
                                                    <template v-slot:activator="{ on }">
                                                        <v-text-field v-model="date" label="กำหนดวันเสร็จสิ้นและส่งมอบงาน" persistent-hint prepend-icon="event" @blur="date = parseDate(dateFormatted)" v-on="on" readonly></v-text-field>
                                                    </template>
                                                    <v-date-picker v-model="date" no-title @input="menu1 = false"></v-date-picker>
                                                </v-menu>
                                            </v-flex>

                                            <v-flex xs12 sm6>
                                                <!-- <v-select :items="Mac_for_newQ" value="Emp_ID" v-model="selectedItem_Owner" item-text="Mac_Name" label="ช่างผู้รับผิดชอบ"
                                                 single-line return-object></v-select> -->
                                            </v-flex>
                                        </v-layout>
                                    </v-card>

                                    <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                                    <v-card elevation="0" color="grey lighten-3" width="100%" style="border-radius:0px 0px 40px 0px;">
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
                                    <v-btn color="red" style="border-radius:20px 0px 0px 0px;" class="white--text" @click="dialog_Edit = false,insert = true">Cancel</v-btn>
                                    <v-btn color="red" style="border-radius:0px 0px 20px 0px;" class="white--text" @click="UpdateDate(dateEditID,date),dialog_Edit = false,alert = !alert">OK</v-btn>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="dialog_Timeline" max-width="700px">
                    <v-card>
                        <v-flex headline pt-2 pb-3>
                            <v-layout justify-space-around>
                                <v-flex xs11 md11 xl11 lg11 sm11 ml-4 mt-3>
                                    <h3>Timeline</h3>
                                    <h6>{{timelineWID.CM_Name}} {{timelineWID.Model}} {{timelineWID.Car_Year}}</h6>
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
                                        <h3>{{timelineWID.W_ID}}</h3>
                                    </v-timeline-item>

                                    <v-timeline-item color="red" class="mb-3" small v-for="timelineItem in timelineWID.timeline">
                                        <v-card  class="elevation-15" style="border-radius:30px 0px 35px 0px;" min-width="400px">
                                            <v-layout justify-space-between pt-3 pb-3 pr-3 pl-3>
                                                <v-flex xs7>
                                                    <v-chip class="white--text ml-0" color="grey darken-4" label small style="border-radius:15px 0px 15px 0px;">
                                                        รายงานผลปกติ
                                                    </v-chip>
                                                    &nbsp;
                                                    <b>{{timelineItem.Report_Name}}</b><br/>
                                                    <p><br/>&nbsp;&nbsp;&nbsp;{{timelineItem.Description}}</p>
                                                </v-flex>

                                                <v-flex xs5 text-xs-right>
                                                    <v-layout justify-end wrap>
                                                        <v-flex xs12 md12 xl12 lg12 sm12>{{timelineItem.DateTime_Created}}</v-flex>
                                                        <v-flex mt-1 xs12 md12 xl12 lg12 sm12>
                                                            <h4>M.{{timelineWID.emp_name}}</h4>
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

    <v-dialog v-model="dialog_Insert" persistent max-width="700px">
        <v-card color="grey darken-4" class="white--text">
            <v-card-text>
                <v-layout wrap>
                    <v-flex mt-1 md1 xl1 sm1 lg1 xs1>
                        <img src="https://testtingfuck.000webhostapp.com/imageLogo/ForBgDark.png" width="130" height="50">
                    </v-flex>
                        <v-flex md12 xl10 sm10 lg10 xs10>
                            <h1 class="text-xs-center red--text">Insert work</h1>
                            <h3 class="text-xs-center">F&I GARAGE</h3>
                        </v-flex>
                        <v-flex md1 xl1 sm1 lg1 xs1>

                        </v-flex>
                </v-layout>
            </v-card-text>

            <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                <v-layout wrap>
                    <v-form ref="form" v-model="valid" lazy-validation>
                        <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                        <v-card elevation="0" color="grey lighten-3" width="100%" style="border-radius:80px 0px 0px 0px">

                            <v-layout wrap pl-4 pr-4 pb-3>
                                <v-flex xs12 sm12 md12 mt-2 ml-3>
                                    <v-layout wrap>
                                    <v-text-field label="เลขที่บัตรประชาชน" v-model="pId" :rules="pIdRules" required mask="#-####-#####-##-#"></v-text-field>

                                    <v-btn icon large color="red" @click="findPID(pId)"><v-icon>search</v-icon></v-btn>
                                    </v-layout>
                                </v-flex>

                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-text-field label="ชื่อ*" v-model="fName" :rules="fNameRules" required></v-text-field>

                                </v-flex>

                                <v-flex xs12 sm6 md6>
                                    <v-text-field label="นามสกุล*" v-model="lName" :rules="lNameRules" persistent-hint required></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm12 md12>
                                    <v-text-field label="ที่อยู่ปัจจุบัน" v-model="address" :rules="addressRules" required></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-text-field label="วันเกิด" v-model="birthday" :rules="birthdayRules" required mask="##/##/####" hint="พ.ศ"></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md6>

                                    <v-text-field label="อีเมล์*" v-model="email" :rules="emailRules" required></v-text-field>

                                </v-flex>

                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-text-field label="Line ID" v-model="lineID" :rules="lineIDRules" required></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md6>
                                    <v-text-field label="เบอร์โทร" v-model="tel" :rules="telRules" :counter="10" mask="##-####-####" required></v-text-field>
                                </v-flex>
                            </v-layout>

                        </v-card>
                        <v-card-text>ข้อมูลรถ</v-card-text>
                        <v-card elevation="0" color="grey lighten-3" width="100%">

                            <v-layout wrap pl-4 pr-4 pb-3 pt-2>
                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-autocomplete :items="Car_list_forAdd" label='ยี่ห้อ' value="CM_ID" v-model="selectedItem_CM" :rules="selectedItem_CMRules" item-text="CM_Name"  single-line return-object></v-autocomplete>
                                </v-flex>
                                <v-flex xs12 sm6 md6>
                                    <v-text-field label="รุ่น" v-model="model" :rules="modelRules" required></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-text-field label="สี" v-model="color" :rules="colorRules" required></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md6>
                                    <v-text-field label="ทะเบียน" v-model="licensPlate" :rules="licensPlateRules" required></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-text-field label="ปีผลิต" v-model="year" :rules="yearRules" mask="####" :counter="4" required></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm6 md6>
                                    <v-text-field label="เลขตัวถัง" v-model="BodyID" :rules="BodyIDRules" required></v-text-field>
                                </v-flex>
                                <v-flex xs12>
                                    <v-text-field label="สาเหตุ/อาการเบื้องต้น" v-model="Desc" :rules="DescRules" required></v-text-field>
                                </v-flex>
                            </v-layout>

                        </v-card>
                        <v-card-text>แผนงาน</v-card-text>

                        <v-card elevation="0" color="grey lighten-3" width="100%" style="border-radius:0px 0px 80px 0px">
                            <v-layout wrap pl-4 pr-4 pb-3>

                                <v-flex xs12 sm6 md6 pr-2>
                                    <v-text-field  label="วันเริ่มงาน" persistent-hint v-model="startDate" mask="####-##-##" :rules="startDateRules" prepend-icon="event"></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md6 pr-2>
                                    <v-text-field  label="วันรับรถ" persistent-hint v-model="finishDatetDate"  mask="####-##-##" :rules="finishDateRules"></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md6>
                                    <v-select :items="Mac_for_newQ" value="Emp_ID" v-model="selectedItem_Owner" :rules="selectedItem_OwnerRules" item-text="Mac_Name" label="ช่างผู้รับผิดชอบ" v-on:change="changeRoute(selectedItem_Owner.Emp_ID)" single-line return-object></v-select>
                                </v-flex>
                            </v-layout>
                        </v-card>
                    </v-form>
                </v-layout>
            </v-container>
            <!-- <small>*indicates required field</small> -->

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red" style="border-radius:40px 0px 40px 0px" dark @click="dialog_Insert = false">Cencel</v-btn>
                <v-btn color="red" style="border-radius:40px 0px 40px 0px" dark @click="validate()" :disabled="!valid">Add</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-dialog v-model="dialogAddSucess" max-width="300">
        <v-card>
            <v-card-title class="headline white--text grey darken-4" primary-title>F&I Garage</v-card-title>
            <v-card-title>Do you want to Add queue ?</v-card-title>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red white--text" style="border-radius:40px 0px 0px 0px" @click="dialog_Insert = false,dialogAddSucess = false">No</v-btn>
                <v-btn color="red white--text" style="border-radius:0px 0px 40px 0px" @click="dialogAddSucess = false">Yes</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
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
          console.log(readData)
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
      date: '',
      myDate: null,
      WidForDeleteBT: '',
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

      birthday: '',
      birthdayRules: [
        v => !!v || 'กรุณากรอกวันเกิด',
        v => (v && v.length >= 8) || 'di6',
      ],

      email: '',
      emailRules: [
        v => !!v || 'กรุณากรอกอีเมลล์',
        v => /.+@.+/.test(v) || 'กรุณากรอกอีเมลล์ให้ถูกต้อง',
      ],

      lineID: '',
      lineIDRules: [
        v => !!v || 'กรุณากรอกไลน์ไอดี',

      ],

      tel: '',
      telRules: [
        v => !!v || 'กรุณากรอกเบอร์โทรศัพท์',
        v => (v && v.length >= 10) || 'กรุณากรอกเบอร์โทรศัพท์ให้ถูกต้อง',
      ],

      selectedItem_CM: '',
      selectedItem_CMRules: [
        v => !!v || 'กรุณาเลือกยี่ห้อรถ',
      ],

      model: '',
      modelRules: [
        v => !!v || 'กรุณาเลือกรุ่นรถ',

      ],

      color: '',
      colorRules: [
        v => !!v || 'กรุณากรอกข้อมูลสีรถ',

      ],

      licensPlate: '',
      licensPlateRules: [
        v => !!v || 'กรุณากรอกข้อมูลป้ายทะเบียน',

      ],
      year: '',
      yearRules: [
        v => !!v || 'กรุณากรอกข้อมูลปีรถ',
        v => (v && v.length >= 4) || 'กรุณากรอกข้อมูลให้ถูกต้อง (ค.ศ xxxx)',
      ],

      BodyID: '',
      BodyIDRules: [
        v => !!v || 'กรุณากรอกเลขตัวถัง',

      ],
      Desc: '',
      DescRules: [
        v => !!v || 'กรุณากรอกรายละเอียด',

      ],

      selectedItem_Owner: '',
      selectedItem_OwnerRules: [
        v => !!v || 'กรุณาเลือกรายการนี้',
      ],

      startDate: '',
      startDateRules: [
        v => !!v || 'กรุณากรอกวันเริ่มงาน',
        v => (v && v.length >= 8) || 'กรุณากรอกข้อมูลให้ถูกต้อง (ปี/เดือน/วัน)',
      ],
      finishDate: '',
      finishDateRules: [
        v => !!v || 'กรุณากรอกวันสิ้นสุดงาน',
        v => (v && v.length >= 8) || 'กรุณากรอกข้อมูลให้ถูกต้อง (ปี/เดือน/วัน)',
      ],

      dateEditID: '',
      valid: false,
      timelineWID: '',
      dialog_Edit: false,
      dialog_Timeline: false,
      dialog_confrim: false,
      dialog_delete: false,
      dialog_Insert: false,
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
  methods: {
    getDataExpans(data) {
      this.timelineWID = data
      this.dialog_Timeline = true
      //   console.log('kkkkkkkk',this.timelineWID)
    },
    getDataDelete(data) {
      console.log('data delete=', data)
      this.WidForDeleteBT = data
      // this.Get_Data_WID.W_ID = data
      //   console.log('kkkkkkkk',this.timelineWID)
    },
    validate() {
      this.snackbar = true
      this.dialogAddSucess = true

      this.insertToWIP();
      console.log('TES2');
    },
    moment() {
      return moment();
    },
    async insertToWIP() {
      const datainsert = [{

        Cus_ID: this.pId,
        Cus_Name: this.fName,
        Cus_Lname: this.lName,
        Address: this.address,
        Email: this.email,
        LineID: this.lineID,
        Tel: this.tel,
        Birthday: this.birthday,
        Cm_ID: this.selectedItem_CM.CM_ID,
        Model: this.model,
        Car_Color: this.color,
        License_Plete: this.licensPlate,
        Year: this.year,
        Tank_Num: this.BodyID,
        Broken_List: this.Desc,
        Start_Date: this.startDate,
        Finish_Date: this.finishDatetDate,
        Emp_ID: this.selectedItem_Owner.Emp_ID,
        Remark: 'ไม่มี',
      }]
      const api = 'https://testtingfuck.000webhostapp.com/insert_new_wip.php'
      const param = new URLSearchParams()
      console.log(datainsert)
      param.append('data_insert', JSON.stringify(datainsert))
      const response = await Axios.post(api, param)
      const res = response.data
      console.log(res)

      if (res === '1') {
        console.log('insert finished')
      } else if (res === '0') {
        console.log('insert false')
      }
    },

    async findPID(id) {
      console.log('testq')
      if (id.length === 13) {
        const api = 'https://testtingfuck.000webhostapp.com/findID.php'
        const paramkey = new URLSearchParams();
        paramkey.append('key', id);
        const response = await Axios.post(api, paramkey)
        const res = response.data
        if (res !== '0') {
          this.pId = res[0].Cus_ID
          this.fName = res[0].Cus_Fname
          this.lName = res[0].Cus_Lname
          this.tel = res[0].Phone_Num
          this.address = res[0].Address
          this.email = res[0].Email
          this.lineID = res[0].LineID
          this.birthday = res[0].Birthday
        } else {
          console.log('not found this user')
        }
      }
    },
    async deletewip(id) {
      const api = 'https://testtingfuck.000webhostapp.com/deleteWIP.php'
      const param = new URLSearchParams()
      param.append('W_ID', id)
      const response = await Axios.post(api, param)
      const res = response.data
      console.log('res', res)
      // eslint-disable-next-line eqeqeq
      if (res == '1') {
        console.log('pass')
      } else {
        console.log('error update')
      }
    },

    async UpdateDate(bookId, datenew) {
      alert(bookId)
      alert(datenew)
      const api = 'https://testtingfuck.000webhostapp.com/update_wip_detail.php'
      const paramUpdate = new URLSearchParams()
      paramUpdate.append('W_ID', bookId)
      paramUpdate.append('date', datenew)
      const response = await Axios.post(api, paramUpdate)
      const res = response.data
      console.log(res.count)
      console.log(res)
      if (res === 1) {
        this.alertUpdateNewDate = true;
        setTimeout(() => {
          this.alertUpdateNewDate = false;
        }, 10000);
      } else {
        this.errorUpdateNewDate = true;
        setTimeout(() => {
          this.errorUpdateNewDate = false;
        }, 10000);
      }
    },
  },
}
</script>
