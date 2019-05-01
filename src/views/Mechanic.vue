<template>
<v-card width="100%">
    <v-alert :value="alert" type="success" transition="scale-transition" dismissible>Insert queue successfuly!</v-alert>
    <v-tooltip left>
        <template v-slot:activator="{ on }">
            <v-btn fab dark fixed bottom right color="pink" v-on="on" style="margin-top:15px;" @click="dialogInsert = true,alert = false">
                <v-icon dark>add</v-icon>
            </v-btn>
        </template>
        <span>Insert employee</span>
    </v-tooltip>

    <v-expansion-panel focusable :pagination.sync="pagination">
        <v-expansion-panel-content :key="item.Emp_ID" v-for="item in GetData_Emp">
            <template v-slot:header>
                <div>
                    <h3>
                        <v-icon v-if="item.Pos_Name === 'Manager'" color="amber accent-4">supervisor_account</v-icon>
                        <v-icon v-if="item.Pos_Name === 'Mechanic'" color="amber accent-4">build</v-icon>
                         <b> {{item.Emp_ID}} | </b> {{item.Mac_Name}} - {{item.Pos_Name}}
                    </h3>
                </div>
            </template>
            <v-card color="grey lighten-3">
                <v-flex>
                    <v-layout>
                        <v-flex md11 xl11 sm11 lg11 xs11>
                            <v-card-text class="grey lighten-3">
                                <v-flex mb-2>
                                    <h2><b> Employee ID :</b> {{item.Emp_ID}} </h2>
                                </v-flex>
                                <v-divider></v-divider>
                                <v-divider></v-divider>
                                <v-flex mt-3 headline font-weight-bold>
                                    <v-icon>account_circle</v-icon> ข้อมูลส่วนตัว
                                </v-flex>
                                <v-flex mt-3 ml-3>
                                    <p><b> เลขที่บัตรประชาชน :</b> 232301040-1-301-3132 </p>
                                    <p><b> ชื่อ-สกุล :</b> {{item.Mac_Name}}</p>
                                    <p><b> ชื่อเล่น :</b> {{item.Nickname}} </p>
                                    <p><b> ตำแหน่ง :</b> {{item.Pos_Name}} </p>
                                    <p><b> อายุ :</b> {{calculate_age(item.Birthday)}}</p>
                                    <!-- {{calculate_age(item.Birthday)}} -->
                                    <p><b> วันเกิด :</b> {{item.Birthday}}</p>
                                    <p><b> ที่อยู่ :</b> {{item.Address}} </p>
                                    <p><b> วันเข้าทำงาน :</b> {{item.Start_Date}}</p>
                                    <p><b> เบอร์โทร :</b> {{item.Phone_Num}}</p>
                                    <p><b> Line ID :</b> {{item.LineID}}</p>
                                    <p><b> Email :</b> {{item.Email}}</p>
                                    <p><b> เงินเดือน :</b> {{item.Salary}}</p>
                                    <p><b> ความถนัด :</b> {{item.Speciality}} </p>
                                </v-flex>

                                <v-divider></v-divider>
                                <v-divider></v-divider>
                                <v-flex mt-3 headline font-weight-bold>
                                    <v-icon>ballot</v-icon> งานที่รับผิดชอบ
                                </v-flex>
                                <v-flex ml-3>

                                    <div  v-if="item.WorkDesc==='null'">
                                        <v-flex mt-3>
                                            <v-v-card-text><h4>ไม่มีงานที่ค้างอยู่</h4></v-v-card-text>
                                         </v-flex>
                                    </div >
                                    <div v-else v-for="work in item.WorkDesc" v-bind:key="work.W_ID">
                                        <v-flex mt-3>
                                        <h3>
                                            <p><b> Work ID : {{work.W_ID}} </b></p>
                                        </h3>
                                        <p><b>  Status : "{{work.Status}}" </b></p>

                                        <p><b> Car_ID : </b>{{work.Car_ID}}</p>
                                        <p><b> Description : </b> {{work.W_Desc}}</p>

                                        <p><b>วันนัดรับรถ :</b> {{work.Finish_Date}} </p>
                                        </v-flex>
                                        <v-divider></v-divider>
                                    </div>
                                </v-flex>

                            </v-card-text>
                        </v-flex>

                        <v-flex md1 xl1 sm1 lg1 xs1>
                            <v-layout justify-end wrap>
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn fab dark right color="orange accent-3" v-on="on" class="elevation-10" style="margin-top:10px;" @click="getdataexpan(item),dialog_Edit = true,alert = false">
                                            <v-icon dark>edit</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>แก้ไขข้อมูลพนักงาน</span>
                                </v-tooltip>

                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn fab dark right color="red" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_delete = true,alert = false">
                                            <v-icon dark>delete_forever</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>ลบพนักงานรายการนี้</span>
                                </v-tooltip>

                            </v-layout>

                        </v-flex>

                    </v-layout>
                </v-flex>
            </v-card>

            <v-dialog v-model="dialog_Edit" max-width="700px">
                <v-card v-if="insert == true" color="grey darken-4" class="white--text">
                    <v-card-text>
                        <h1 class="text-xs-center red--text">แก้ไขข้อมูลพนักงาน</h1>
                        <h3 class="text-xs-center white--text">F&I GARAGE</h3>
                    </v-card-text>

                    <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                        <v-layout wrap>
                            <v-flex>
                                <v-checkbox dark v-model="isEditing" color="orange" hide-details label="เปิดการแก้ไข"></v-checkbox>
                            </v-flex>

                            <v-card-text>ข้อมูลพนักงาน</v-card-text>
                            <v-card elevation="5" color="grey lighten-3" width="100%">
                                <v-layout wrap pl-4 pr-4 pb-3 pt-2>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="รหัสพนักงาน" :disabled="true" :value='getdataExpan.Emp_ID' required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="เลขที่บัตรประชาชน" :disabled="!isEditing" :value='getdataExpan.Emp_ID' required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="ชื่อ*" :disabled="!isEditing" :value='getdataExpan.Emp_Name' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="นามสกุล*" :disabled="!isEditing" :value='getdataExpan.Emp_Lname' persistent-hint required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm12 md12>
                                        <v-text-field label="ที่อยู่ปัจจุบัน*" :disabled="!isEditing" :value='getdataExpan.Address' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="วันเกิด*" :disabled="!isEditing" :value='calculate_age(getdataExpan.Birthday)' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="อายุ*" :disabled="!isEditing" :value='calculate_age(getdataExpan.Birthday)' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm12 md12 pr-3>
                                        <v-text-field label="อีเมล์*" :disabled="!isEditing" :value='getdataExpan.Email' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="Line ID*" :disabled="!isEditing" :value='getdataExpan.LineID' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="เบอร์โทร*" :disabled="!isEditing" :value='getdataExpan.Phone_Num' required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-autocomplete :value='item.Pos_ID' :disabled="!isEditing" :items="['หัวหน้าช่าง', 'ผู้ดูแลระบบ','ผู้ช่วยช่าง']" label="ตำแหน่ง*" persistent-hint>
                                        </v-autocomplete>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="ความถนัด" :disabled="!isEditing" :value='item.Email' required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="เงินเดือน*" :disabled="!isEditing" :value='item.Email' required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-card>
                            <v-card-text>ข้อมูลระบบ</v-card-text>
                            <v-card elevation="5" color="grey lighten-3" width="100%">
                                <v-layout wrap pl-4 pr-4 pb-2 pt-2>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="รหัสในการเข้าใช้ระบบ*" :disabled="!isEditing" required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="ยืนยันอีกครั้ง*" :disabled="!isEditing" required></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-card>

                        </v-layout>
                    </v-container>
                    <!-- <small>*indicates required field</small> -->

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="dialog_Edit = false">ยกเลิก</v-btn>
                        <v-btn color="blue darken-1" flat @click="dialog_Edit = false">ยืนยัน</v-btn>
                    </v-card-actions>
                </v-card>

            </v-dialog>

        </v-expansion-panel-content>
    </v-expansion-panel>

       <v-dialog v-model="dialogInsert" persistent max-width="700px">
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
<<<<<<< HEAD
                        <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                        <v-card elevation="0" color="grey lighten-3" width="100%">

                            <v-layout wrap pl-4 pr-4 pb-3>
                                <v-flex xs12 sm12 md12 mt-2>
                                    <v-layout wrap>
                                    <v-text-field label="เลขที่บัตรประชาชน" v-model="pId" :rules="pIdRules" required mask="#-####-#####-##-#"></v-text-field>

                                    <v-btn icon large color="red"><v-icon>search</v-icon></v-btn>
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
=======
                    <v-card-text>ข้อมูลพนักงาน</v-card-text>
                    <v-card elevation="5" color="grey lighten-3" width="100%">
                        <v-layout wrap pl-4 pr-4 pb-3 pt-2>
                            <v-flex xs12 sm12 md12>
                                <v-text-field label="เลขประจำตัวประชาชน*"  v-model="pId" mask="#-####-#####-##-#" :rules="pIdRules" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="ชื่อ*" v-model="fName" :rules="fNameRules" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6>
                                <v-text-field v- label="นามสกุล*" v-model="lName" :rules="lNameRules" persistent-hint required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm12 md12>
                                <v-text-field label="ที่อยู่ปัจจุบัน*" v-model="address" :rules="addressRules" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="วันเกิด*" v-model="birthday" :rules="birthdayRules" mask="##/##/####" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="อีเมล์*" v-model="email" :rules="emailRules" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="Line ID*" v-model="lineID" :rules="lineIDRules" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6>
                                <v-text-field label="เบอร์โทร*" :rules="telRules" mask="##-####-####" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-autocomplete :items="['หัวหน้าช่าง', 'ผู้ดูแลระบบ','ผู้ช่วยช่าง']" label="ตำแหน่ง*" persistent-hint v-model="position" :rules="positionRules">
                                </v-autocomplete>
                            </v-flex>
                            <v-flex xs12 sm6 md6>
                                <v-text-field label="ความถนัด" v-model="spaciality" :rules="spacialityRules" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="เงินเดือน*" v-model="salaly" :rules="salalyRules" required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-card>
                    <v-card-text>ข้อมูลระบบ</v-card-text>
                    <v-card elevation="5" color="grey lighten-3" width="100%">
                        <v-layout wrap pl-4 pr-4 pb-2 pt-2>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="รหัสในการเข้าใช้ระบบ*" :counter="10" mask="##########" v-model="password" :rules="passwordRules" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md6>
                                <v-text-field label="ยืนยันอีกครั้ง*" :counter="10" mask="##########" type="password" v-model="passwordConfirm" :rules="passwordConfirmRules"  required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-card>
                    </v-form>
                </v-layout>
            </v-container>
            <!-- <small>*indicates required field</small> -->

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="dialogInsert = false">Cencel</v-btn>
                <v-btn color="blue darken-1" flat @click="validate()">Add</v-btn>
            </v-card-actions>
        </v-card>
>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f

                                    <v-text-field label="อีเมล์*" v-model="email" :rules="emailRules" required></v-text-field>

                                </v-flex>

                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-text-field label="Line ID" v-model="lineID" :rules="lineIDRules" required></v-text-field>
                                </v-flex>

                                <v-flex xs12 sm6 md6>
                                    <v-text-field label="เบอร์โทร" v-model="tel" :rules="telRules" mask="##-####-####" required></v-text-field>
                                </v-flex>
                            </v-layout>

                        </v-card>
                        <v-card-text>ข้อมูลรถ</v-card-text>
                        <v-card elevation="0" color="grey lighten-3" width="100%">

                            <v-layout wrap pl-4 pr-4 pb-3 pt-2>
                                <v-flex xs12 sm6 md6 pr-3>
                                    <v-autocomplete :items="Car_list_forAdd" label='ยี่ห้อ' value="CM_ID" v-model="selectedItem_CM" :rules="selectedItem_CMRules" item-text="CM_Name" v-on:change="Gen_ID_Car()" single-line return-object></v-autocomplete>
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

                        <v-card elevation="0" color="grey lighten-3" width="100%">
                            <v-layout wrap pl-4 pr-4 pb-3>
                                <v-flex xs12 sm6 pr-2>
                                    <v-menu ref="menu1" v-model="menu1" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width max-width="290px" min-width="290px">
                                        <template v-slot:activator="{ on }">
                                            <v-text-field v-model="dateFormatted" label="กำหนดวันเสร็จสิ้นและส่งมอบงาน" persistent-hint prepend-icon="event" @blur="date = parseDate(dateFormatted)" v-on="on" readonly>
                                            </v-text-field>
                                        </template>
                                        <v-date-picker v-model="date" no-title @input="menu1 = false"></v-date-picker>
                                    </v-menu>
                                </v-flex>

<<<<<<< HEAD
                                <v-flex xs12 sm6>
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
                <v-btn color="blue darken-1" flat @click="dialog_Insert = false">Cencel</v-btn>
                <v-btn color="blue darken-1" dark flat @click="validate()" :disabled="!valid">Add</v-btn>
            </v-card-actions>
        </v-card>
=======
                    </v-layout>
                </v-container>
                <!-- <small>*indicates required field</small> -->
                <v-flex pr-3 pb-2>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="amber darken-4" flat @click="insertCheck = false,dialogInsert = true">แก้ไข</v-btn>
                        <v-btn color="blue darken-1" flat @click="dialogInsert = false,insertCheck = false,alert = !alert">ยืนยัน</v-btn>
                    </v-card-actions>
                </v-flex>
            </v-card>
        </v-dialog>

>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f
    </v-dialog>


    <v-dialog v-model="dialog_delete" max-width="300">
        <v-card>
            <v-card-title class="headline grey darken-4 white--text" primary-title>F&I Garage -
                <v-icon large color="red"> delete_forever</v-icon>-
            </v-card-title>

            <v-card-text>
                <h4>Employee ID : คุณต้องลบรายการนี้หรือไม่ ?</h4>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red white--text" @click="dialog_delete = false">No</v-btn>
                <v-btn color="red white--text" @click="dialog_delete = false">Yes</v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>

</v-card>
</template>

<script>
import Axios from 'axios';
import moment from 'moment'
import Clock from 'vue-clock2'

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
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
  data() {
    return {
      window: {
        width: 0,
        height: 0,
      },
      insert: {
        Emp_ID: '',
        Emp_Name: '',
        Emp_Lname: '',
        Pos_ID: '',
        Nickname: '',
        Birthday: '',
        Start_Date: '',
        Salary: '',
        Emp_Type: '',
        Address: '',
        Phone_Num: '',
        Email: '',
        // y: '',
        // : '',
        // : '',

      },
      isEditing: false,
      dialog_Edit: false,
      dialog_delete: false,
      search: '',
      GetData_Emp: [],
      GetData_Work_in: [],
      alert: false,
      dialogInsert: false,
      insert: true,
      insertCheck: false,
      pagination: {},
      getdataExpan: [],
      EmpID: '21454',
      Name: 'Phonpisud',
      LastName: 'Sumangsa',
      selected: [],
<<<<<<< HEAD

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
=======
      headers: [{
        text: 'Mechanic ID',
        align: '',
        sortable: false,
        value: 'Emp_ID',
      },
      ],
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
>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f

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

<<<<<<< HEAD
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
        v => !!v || 'กรุณากรอกข้อมูล',

      ],

=======

      Desc: '',
      DescRules: [
        v => !!v || 'กรุณากรอกข้อมูล',

      ],
      position: '',
      positionRules: [
        v => !!v || 'กรุณากรอกข้อมูล',

      ],
      spaciality: '',
      spacialityRules: [
        v => !!v || 'กรุณากรอกข้อมูล',

      ],
      salaly: '',
      salalyRules: [
        v => !!v || 'กรุณากรอกข้อมูล',

      ],
      password: '',
      passwordRules: [
        v => !!v || 'กรุณากรอกรหัสผ่าน',

      ],
      passwordConfirm: '',
      passwordConfirmRules: [
        v => !!v || 'กรุณากรอกรหัสผ่านอีกครั้ง',

      ],


>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f
      selectedItem_Owner: '',
      selectedItem_OwnerRules: [
        v => !!v || 'กรุณาเลือกรายการนี้',
      ],
<<<<<<< HEAD
=======
      valid: false,
>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f

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

  destroyed() {
    window.removeEventListener('resize', this.handleResize)
  },
  methods: {
    testtest() {
      this.isEditing = !this.isEditing
    },
    getdataexpan(data) {
      this.getdataExpan = data
      console.log('this.getdataExpan', this.getdataExpan)
    },
    handleResize() {
      this.window.width = window.innerWidth;
      this.window.height = window.innerHeight;
    },
    moment() {
      return moment();
    },
    calculate_age(birthday) {
      const birthdate = new Date(birthday);
      const cur = new Date();
      const diff = cur - birthdate; // This is the difference in milliseconds
      const age = Math.floor(diff / 31557600000);
      return age
    },
    validate() {
<<<<<<< HEAD
      console.log('TESt');
      if (this.$refs.form.validate()) {
        console.log('TES1');
        this.snackbar = true
        this.dialogAddSucess = true
=======
      if (this.$refs.form.validate()) {
        if (this.password === this.passwordConfirm) {
          this.snackbar = true
          this.insertCheck = true
        } else {
          alert('กรุณากรอกรหัสผ่านให้ตรงกัน')
        }
      }
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

      if (this.dataCustodataWorkInProcessmer.length === 0) {
        alert('Customer table is null')
      } else {
        console.log(this.dataCustomer)
>>>>>>> 02e29ac2b153fab90fc349d108f981b458ab1e9f
      }
      console.log('TES2');
    },
    async insertNewEmp() {
    //   const api = 'https://testtingfuck.000webhostapp.com/insert_new_emp.php'
    //   const param = new URLSearchParams()
        //   param.append('',)
    //   param.append('Emp_PID',)
    //   param.append('Emp_Name',)
    //   param.append('Emp_Lname',)
    //   param.append('Pos_ID',)
    //   param.append('Nickname',)
    //   param.append('Birthday',)
    //   param.append('Start_Date',)
    //   param.append('Salary',)
    //   param.append('Emp_Type',)
    //   param.append('Address',)
    //   param.append('Phone_Num',)
    //   param.append('Email',)
    //   param.append('LineID',)
    //   param.append('speciality',)


    
    },
  },
}
</script>
