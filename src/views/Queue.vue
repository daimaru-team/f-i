<template>

    <!-- <v-alert :value="alertUpdateNewDate" type="success"
    transition="scale-transition" dismissible Color="red">
        อัพเดทวันจะเข้ารับบริการสำเร็จ </v-alert>
    <v-alert :value="errorUpdateNewDate" type="error" transition="scale-transition" dismissible>
        ระบบไม่สามารถทำการให้ท่านได้.. โปรดตรวจสอบข้อมูลหรือการเชื่อมต่อ และลองใหม่อีกครั้งภายหลัง!
    </v-alert> -->

    <v-card width="100%">
        <v-alert fixed :value="alert" type="success" transition="scale-transition" dismissible>
            Insert queue successfully!
        </v-alert>

        <v-expansion-panel focusable
        :pagination.sync="pagination" class="elevation-13" v-model="panel">
            <v-expansion-panel-content v-for="item in display_booking">
                <template v-slot:actions>
                    <v-icon @click="disableNotification(panel)"
                    color="gray">$vuetify.icons.expand</v-icon>
                </template>
                <template v-slot:header>
                    <div @click="disableNotification(panel)">
                        <h3>{{item.come_in_date}} |
                          {{item.CM_Name}} {{item.car_model}} |
                          {{item.name}}&nbsp;{{item.last_name}}
                        </h3>

                    </div>
                    <v-layout justify-end mr-1 @click="disableNotification(panel)">
                        <v-icon v-if="item.confirm_status==='1'"
                        medium color="green">beenhere</v-icon>
                        <v-icon v-if="item.confirm_status==='0'"
                        medium color="amber">report</v-icon>
                    </v-layout>
                </template>

                <v-card color="grey lighten-3">
                    <v-flex>
                        <v-layout>
                            <v-flex md11 xl11 sm11 lg11 xs11>
                                <v-card-text class="grey lighten-3">
                                    <v-flex mb-2>
                                        <h3><b> Booking ID :</b> {{item.book_ID}} </h3>
                                    </v-flex>
                                    <v-divider></v-divider>
                                    <v-flex mt-2>
                                        <v-flex mt-2 headline font-weight-bold>
                                            <v-icon>person</v-icon> ข้อมูลลูกค้า
                                        </v-flex>
                                        <v-flex mt-3 ml-3>
                                            <p><b> เลขที่บัตรประชาชน : </b> {{item.Emp_ID}}</p>
                                            <p><b> ชื่อ-สกุล :</b> {{item.name}}</p>
                                            <p><b> line ID :</b> {{item.lineID}}</p>
                                            <p><b> เบอร์โทรศัพท์ :</b> {{item.tel}}</p>
                                            <p><b> E-mail :</b> {{item.Email}}</p>
                                        </v-flex>
                                    </v-flex>
                                    <v-divider></v-divider>
                                    <v-flex mt-2>
                                        <v-flex mt-2 headline font-weight-bold>
                                            <v-icon>directions_car</v-icon> ข้อมูลรถ
                                        </v-flex>
                                        <v-flex mt-3 ml-3>
                                            <p><b> Car :</b>
                                            {{item.CM_Name+' '+item.car_model}}
                                            </p>
                                            <p><b> Year :</b> {{item.car_year}}</p>
                                            <!-- <p><b> Color :</b> {{item.}} </p> -->
                                            <p><b> อาการเบื้องต้น :</b> {{item.broken_desc}} </p>
                                            <p><b>
                                              วันที่ต้องการนำรถมาเข้ารับบริการ :</b>
                                              {{item.come_in_date}} </p>
                                        </v-flex>
                                    </v-flex>
                                    <v-divider></v-divider>
                                    <v-flex mt-2>
                                        <h3>
                                            <p v-if="item.confirm_status==='0'">
                                              <b> Status :</b> รอยืนยัน
                                                <!-- สถานะเสร็จ -->
                                                <v-icon color="amber accent-4">report</v-icon>
                                            </p>
                                            <p v-if="item.confirm_status==='1'">
                                              <b> Status :</b> ยืนยันการจอง
                                                <!-- สถานะยังไม่เสร็จ -->
                                                <v-icon color="green">beenhere</v-icon>
                                            </p>
                                        </h3>

                                    </v-flex>
                                </v-card-text>

                            </v-flex>

                            <v-flex md1 xl1 sm1 lg1 xs1>

                                <v-layout justify-end wrap>
                                    <div v-if="item.confirm_status==='1'">
                                        <v-tooltip left>
                                            <template v-slot:activator="{ on }">
                                                <v-btn small fab dark right
                                                color="light-blue darken-3" v-on="on"
                                                class="elevation-10" style="margin-top:10px;"
                                                 @click="getDataExpansDialog_add_to_garage(item)
                                                 ,alert = false">
                                                    <v-icon dark>keyboard_tab</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>รับรถเข้าอู่</span>
                                        </v-tooltip>
                                    </div>
                                    <div v-if="item.confirm_status==='0'">
                                        <v-tooltip left>
                                            <template v-slot:activator="{ on }">
                                                <v-btn small fab dark right
                                                color="green" v-on="on"
                                                class="elevation-10"
                                                style="margin-top:10px;"
                                                @click="getDataExpansDialog_confrim(item)
                                                ,alert = false">
                                                    <v-icon dark>check_circle</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>ยืนยันรับงาน</span>
                                        </v-tooltip>
                                    </div>
                                    <div>
                                        <v-tooltip left>
                                            <template v-slot:activator="{ on }">
                                                <v-btn fab small dark right
                                                color="orange accent-3" v-on="on"
                                                class="elevation-10" style="margin-top:10px;"
                                                @click="getDataExpansDialog_Edit_date(item)
                                                ,alert = false">
                                                    <v-icon dark>edit</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>แก้ไขวันรับรถ</span>
                                        </v-tooltip>
                                    </div>
                                    <div>

                                        <v-tooltip left>
                                            <template v-slot:activator="{ on }">
                                                <v-btn small fab dark right color="red"
                                                v-on="on" class="elevation-10"
                                                style="margin-top:10px;"
                                                @click="getDataExpansDialog_delete(item)
                                                ,alert = false">
                                                    <v-icon dark>delete_forever</v-icon>
                                                </v-btn>
                                            </template>
                                            <span>ลบคิว</span>
                                        </v-tooltip>
                                    </div>
                                </v-layout>
                            </v-flex>

                        </v-layout>
                    </v-flex>
                </v-card>

                <v-dialog v-model="dialog_confrim" persistent max-width="700px">
                    <v-card color="grey darken-4" class="white--text">
                        <v-card-text>
                            <h1 class="text-xs-center red--text">ยืนยันคิว</h1>
                            <h3 class="text-xs-center">
                              {{book_ID.car_brand+' '+book_ID.car_model+' '+book_ID.car_year}}</h3>

                            <v-container grid-list-md style="padding: 0px 10px 10px 15px;">
                                <v-layout wrap>

                                    <v-card-text>แผนงาน</v-card-text>

                                    <v-card style="border-radius:80px 0px 0px 0px"
                                    elevation="0" color="grey lighten-3" width="100%">
                                        <v-layout wrap pl-4 pr-4 pt-2>

                                            <v-flex xs12 sm6 pr-2>
                                            <v-menu v-model="menuConfirm"
                                                :close-on-content-click="false"
                                                >
                                                <template v-slot:activator="{ on }">
                                                  <v-text-field
                                                    v-model="dateEdit"
                                                    label="วันที่เริ่มดำเนินงาน"
                                                    readonly
                                                    v-on="on"/>
                                                </template>
                                                <v-date-picker dark v-model="dateEdit"
                                                key="comeDate"
                                                @input="menuConfirm = false" />
                                              </v-menu>
                                            </v-flex>

                                            <v-flex xs12 sm6>
                                                <v-select :items="Mac_for_newQ"
                                                value="Emp_ID" v-model="selectedEmp_Confirm"
                                                item-text="Mac_Name" label="ช่างผู้รับผิดชอบ"
                                                single-line return-object></v-select>
                                            </v-flex>
                                        </v-layout>
                                    </v-card>

                                    <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                                    <v-card style="border-radius:0px 0px 80px 0px"
                                    elevation="0" color="grey lighten-3"
                                    width="100%">
                                        <v-layout wrap pl-4 pr-4 pb-3>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>ชื่อ-สกุล : </b>{{book_ID.name}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>Line ID : </b> {{book_ID.lineID}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>เบอร์โทรศัพท์ : </b> {{book_ID.tel}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>อีเมลล์ :</b> {{book_ID.Email}}</div>
                                            </v-flex>

                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>เบอร์โทร :</b> {{book_ID.tel}}</div>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>Car :</b>
                                                {{book_ID.car_brand+' '+book_ID.car_model}}</div>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>Year :</b> {{book_ID.car_year}}</div>
                                            </v-flex>
                                            <v-flex xs12 sm12 md12 pt-3>
                                                <div><b>อาการเบื้องต้น :</b>
                                                {{book_ID.broken_desc}}</div>
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
                                    <v-btn style="border-radius:40px 0px 0px 0px"
                                    color="red" class="white--text"
                                     @click="dialog_confrim = false,
                                     insert = true">Cancel</v-btn>
                                    <v-btn style="border-radius:0px 0px 40px 0px"
                                    color="red" class="white--text"
                                    @click="confirmStatusBooking(book_ID.book_ID)
                                    ,dialog_confrim = false,alert = !alert">OK</v-btn>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="dialog_add_to_garage" persistent max-width="700px">
                    <v-card color="grey darken-4" class="white--text">
                        <v-form ref="form2" v-model="valid2" lazy-validation>
                            <v-card-text>
                                <h1 class="text-xs-center red--text">รับรถเข้าสู่กระบวนการ</h1>
                                <h3 class="text-xs-center">
                                  </h3>

                                <v-container grid-list-md style="padding: 0px 10px 10px 15px;">
                                    <v-layout wrap>

                                        <v-card-text>แผนงาน</v-card-text>

                                        <v-card style="border-radius:60px 0px 0px 0px"
                                        elevation="0" color="grey lighten-3" width="100%">
                                            <v-layout wrap pl-4 pr-4 pt-2>
                                                <v-flex xs12 sm4 md4 pr-3>
                                              <v-menu v-model="menuWIP1"
                                                :close-on-content-click="false"
                                                >
                                                <template v-slot:activator="{ on }">
                                                  <v-text-field
                                                    v-model="come_in_date"
                                                    label="วันที่เริ่มดำเนินงาน"
                                                    readonly
                                                    v-on="on"/>
                                                </template>
                                                <v-date-picker dark v-model="come_in_date" key="comeDate"
                                                @input="menuWIP1 = false" />
                                              </v-menu>
                                                </v-flex>
                                                <v-flex xs12 sm4 md4 pr-3>
                                              <v-menu v-model="menuWIP2"
                                                :close-on-content-click="false"
                                                >
                                                <template v-slot:activator="{ on }">
                                                  <v-text-field
                                                    v-model="finish_date"
                                                    label="กำหนดวันส่งคืนรถให้ลูกค้า"
                                                    readonly
                                                    v-on="on"/>
                                                </template>
                                                <v-date-picker dark v-model="finish_date" key="sendDate"
                                                @input="menuWIP2 = false" />
                                              </v-menu>
                                                </v-flex>

                                                <v-flex xs12 sm4 md4>
                                                    <v-select :items="Mac_for_newQ"
                                                    item-value="Emp_ID" v-model="selectedItem_Owner"
                                                    item-text="Mac_Name" label="ช่างผู้รับผิดชอบ"
                                                    single-line return-object></v-select>
                                                </v-flex>
                                            </v-layout>
                                        </v-card>

                                        <v-card-text>ข้อมูลส่วนตัว</v-card-text>
                                        <v-card style="border-radius:0px 0px 80px 0px"
                                        elevation="0" color="grey lighten-3" width="100%">
                                            <v-layout wrap pl-4 pr-4 pb-3 pt-2>
                                                <v-flex xs12 sm12 md12 mt-2>
                                                    <v-layout wrap>
                                                        <v-text-field label="เลขที่บัตรประชาชน"
                                                        v-model="pId" :rules="pIdRules"
                                                        required mask="#-####-#####-##-#">
                                                        </v-text-field>

                                                        <v-btn icon large color="red"
                                                         @click="findPID(pId)">
                                                            <v-icon>search</v-icon>
                                                        </v-btn>
                                                    </v-layout>
                                                </v-flex>

                                                <v-flex xs12 sm6 md6 pr-3>
                                                    <v-text-field label="ชื่อ*"
                                                    v-model="fName" :rules="fNameRules"
                                                    required></v-text-field>

                                                </v-flex>

                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="นามสกุล*"
                                                    v-model="lName" :rules="lNameRules"
                                                    persistent-hint required></v-text-field>
                                                </v-flex>

                                                <v-flex xs12 sm12 md12>
                                                    <v-text-field label="ที่อยู่ปัจจุบัน"
                                                    v-model="address" :rules="addressRules"
                                                    required></v-text-field>
                                                </v-flex>

                                                <v-flex xs12 sm6 md6 pr-3>
                                               <v-menu v-model="menuBD"
                                                :close-on-content-click="false"
                                                :nudge-right="40" offset-y
                                                full-width min-width="290px">
                                                <template v-slot:activator="{ on }">
                                                  <v-text-field
                                                    v-model="birthday"
                                                    label="วันเกิด"
                                                     readonly
                                                    v-on="on"/>
                                              </template>
                                              <v-date-picker dark v-model="birthday" @input="menuBD = false" />
                                              </v-menu>
                                                </v-flex>

                                                <v-flex xs12 sm6 md6>

                                                    <v-text-field label="อีเมล์*"
                                                    v-model="email"
                                                    :rules="emailRules"
                                                    required></v-text-field>

                                                </v-flex>

                                                <v-flex xs12 sm6 md6 pr-3>
                                                    <v-text-field label="Line ID"
                                                    v-model="lineID"
                                                    :rules="lineIDRules"
                                                    required></v-text-field>
                                                </v-flex>

                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="เบอร์โทร"
                                                    v-model="tel" :rules="telRules"
                                                    mask="##-####-####" required>
                                                    </v-text-field>
                                                </v-flex>

                                            </v-layout>
                                        </v-card>

                                        <v-card-text>ข้อมูลรถ</v-card-text>
                                        <v-card style="border-radius:0px 0px 80px 0px"
                                        elevation="0" color="grey lighten-3" width="100%">
                                            <v-layout wrap pl-4 pr-4 pb-3 pt-2>

                                                <v-flex xs12 sm6 md6 pr-3>

                                                    <v-autocomplete :items="Car_list_forAdd"
                                                    label='ยี่ห้อ' value="CM_ID"
                                                    v-model="selectedItem_CM"
                                                    :rules="selectedItem_CMRules"
                                                    item-text="CM_Name"
                                                    single-line return-object></v-autocomplete>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="รุ่น"
                                                    v-model="model"
                                                    :rules="modelRules" required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 pr-3>
                                                    <v-text-field label="สี"
                                                    v-model="color" :rules="colorRules"
                                                    required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="ทะเบียน"
                                                    v-model="licensPlate"
                                                    :rules="licensPlateRules"
                                                    required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6 pr-3>
                                                    <v-text-field label="ปีผลิต"
                                                    v-model="year" :rules="yearRules"
                                                    mask="####" :counter="4" required>
                                                    </v-text-field>
                                                </v-flex>
                                                <v-flex xs12 sm6 md6>
                                                    <v-text-field label="เลขตัวถัง"
                                                    v-model="BodyID"
                                                    :rules="BodyIDRules"
                                                    required></v-text-field>
                                                </v-flex>
                                                <v-flex xs12>
                                                    <v-text-field label="สาเหตุ/อาการเบื้องต้น"
                                                    v-model="Desc" :rules="DescRules"
                                                     required></v-text-field>
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
                                        <v-btn style="border-radius:40px 0px 0px 0px"
                                        color="red" class="white--text"
                                        @click="dialog_add_to_garage = false
                                        ,insert = true">Cancel</v-btn>
                                        <v-btn style="border-radius:0px 0px 40px 0px"
                                        color="red" class="white--text"
                                        @click="validateAddGarage()" :disabled="!valid2">OK</v-btn>
                                </v-card-actions>
                            </v-card-text>
                        </v-form>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="dialog_delete" max-width="300">
                    <v-card>
                        <v-card-title class="headline grey darken-4 white--text"
                        primary-title>F&I Garage -
                            <v-icon large color="red"> delete_forever</v-icon>-
                        </v-card-title>

                        <v-card-text class="text-xs-center grey lighten-3">
                            <h4>Booking : {{book_ID.book_ID}} |
                              {{book_ID.car_brand+' '+book_ID.car_model+' '+book_ID.car_year}}</h4>
                            <h4> คุณต้องลบรายการนี้หรือไม่ ?</h4>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="red white--text"
                            style="border-radius:80px 0px 0px 0px"
                            @click="dialog_delete = false">No</v-btn>
                            <v-btn color="red white--text"
                            style="border-radius:0px 0px 50px 0px"
                            @click="deleteBooking(book_ID.book_ID)
                            ,dialog_delete = false">Yes</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

                <v-dialog v-model="dialog_Edit_date" persistent max-width="400px">
                    <v-card color="grey darken-4" class="white--text">
                        <v-card-text>
                            <h1 class="text-xs-center red--text">Edit date</h1>

                            <h3 class="text-xs-center">Booking ID : {{book_ID.book_ID}} </h3>

                            <v-container grid-list-md style="padding: 0px 10px 10px 15px;">
                                <v-form ref="form" v-model="valid" lazy-validation>
                                    <v-layout wrap>
                                        <v-card elevation="0" color="grey lighten-3" width="100%">
                                            <v-layout wrap pl-4 pr-4 pt-2>

                                            </v-layout>
                                        </v-card>

                                        <v-card-text>
                                        {{book_ID.CM_Name+' '+
                                        book_ID.car_model+' '+book_ID.car_year}}
                                        </v-card-text>
                                        <v-card style="border-radius:50px 0px 50px 0px"
                                        elevation="17" color="grey lighten-3" width="100%">
                                            <v-layout wrap pl-4 pr-4 pb-1>

                                                <v-flex xs12 sm12 md12 pr-3>
                                                <v-menu v-model="menuEdit"
                                                :close-on-content-click="false"
                                                >
                                                <template v-slot:activator="{ on }">
                                                  <v-text-field
                                                    v-model="dateEdit"
                                                    label="วันที่เริ่มดำเนินงาน"
                                                    readonly
                                                    v-on="on"/>
                                                </template>
                                                <v-date-picker dark v-model="dateEdit"
                                                key="comeDate"
                                                @input="menuEdit = false" />
                                              </v-menu>
                                                </v-flex>

                                            </v-layout>
                                        </v-card>

                                    </v-layout>
                                </v-form>
                            </v-container>
                            <!-- <small>*indicates required field</small> -->

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="red" class="white--text"
                                style="border-radius:40px 0px 0px 0px"
                                @click="dialog_Edit_date = false,insert = true">Cancel</v-btn>
                                <v-btn color="red" class="white--text"
                                style="border-radius:0px 0px 40px 0px"
                                @click="validate()" :disabled="!valid">
                                OK
                                </v-btn>
                            </v-card-actions>
                        </v-card-text>
                    </v-card>
                </v-dialog>

            </v-expansion-panel-content>
        </v-expansion-panel>

        <v-dialog v-model="dialogAddSucess" max-width="300">
            <v-card>
                <v-card-title class="headline grey lighten-2"
                primary-title>F&I Garage</v-card-title>
                <v-card-title>Do you want to Add queue ?</v-card-title>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue white--text"
                    @click="dialog_Insert = false,dialogAddSucess = false">No</v-btn>
                    <v-btn color="blue white--text" @click="testo()">Yes</v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>

    </v-card>

</template>

<script>
import moment from 'moment'
import Clock from 'vue-clock2'
import Datepicker from 'vuejs-datepicker'
import Axios from 'axios';


import 'material-design-icons-iconfont/dist/material-design-icons.css'

// const state = {
//   date: new Date(2016, 9, 16),
// }
export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
    // eslint-disable-next-line vue/no-unused-components
    Datepicker,
  },
  beforeCreate() {
    const api = 'https://testtingfuck.000webhostapp.com/Select_Mac.php';
    const Empparams = new URLSearchParams();
    let readData = []
    Empparams.append('Table', 'WorkInProcess')
    // eslint-disable-next-line global-require
    Axios.post(api, Empparams)
      .then((response) => {
        readData = response.data
        console.log('loooooop =', readData.length)
        if (readData !== 0) {
          console.log(readData)
          this.Mac_for_newQ = readData
        }
      })
    const apicarlist = 'https://testtingfuck.000webhostapp.com/CarMaker_Select.php';

    const carReadParams = new URLSearchParams();
    carReadParams.append('Table', 'Car_Maker')
    // eslint-disable-next-line global-require
    Axios.post(apicarlist, carReadParams)
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
    this.getdataBooking()
    console.log(this.display_booking)
  },
  data() {
    return {
      panel: '',
      panelNum: '',
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
        v => !!v || 'กรุณากรอกข้อมูล',

      ],

      selectedItem_Owner: '',
      selectedEmp_Confirm: '',
      selectedItem_OwnerRules: [
        v => !!v || 'กรุณาเลือกรายการนี้',
      ],

      come_in_date: '',
      finish_date: '',
      come_in_dateRules: [
        v => !!v || 'กรุณากรอก',
      ],

      dateEdit: '',
      dateEditRules: [
        v => !!v || 'กรุณากรอกวันที่จะนำรถเข้ามารับบริการ',
        v => (v && v.length >= 8) || 'กรุณากรอกข้อมูลให้ถูกต้อง (ปี/เดือน/วัน)',
      ],

      book_ID: '',
      valid: false,
      valid2: false,
      dialog_add_to_garage: false,
      dialog_confrim: false,
      dialog_delete: false,
      Store: this.$store.state,
      alert: false,
      dialog_Insert: null,
      dialog_Edit_date: null,
      dialog_Edit_confirmBook: null,
      dialog_Edit_startWo: null,
      menu_edit: false,
      menuWIP1: null,
      menuWIP2: null,
      menuEdit: null,
      menuConfirm: null,
      menuBD: false,
      menu1: false,
      menu2: false,
      dataCustomer: '',
      dataWorkInProcess: '',
      date: new Date().toISOString().substr(0, 10),
      dateFormatted: this.formatDate(new Date().toISOString().substr(0, 10)),
      Mac_for_newQ: [],
      Car_list_forAdd: [],
      pagination: {},
      selected: [],
      alertUpdateNewDate: false,
      errorUpdateNewDate: false,
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
    data_dis_booking() {
      return this.data_dis_booking.slice().reverse()
    },
    // computedDateFormatted() {
    //   return this.formatDate(this.date)
    // },
  },
  watch: {
    // display_booking() {
    //   this.getdataBooking()
    // }
  },
  methods: {
    async getdataBooking() {
      const apibooking = 'https://testtingfuck.000webhostapp.com/select_display_booking.php';
      const response = await Axios.post(apibooking)
      this.display_booking = response.data
      console.log('data_dis_booking', this.display_booking)
    },
    disableNotification(data) {
      this.panelNum = data
      // alert('Disable icn Noti Panel ที่'+ data + 'แล้วววว')
    },
    getDataExpansDialog_Edit_date(data) {
      this.book_ID = data
      this.dateEdit = data.come_in_date
      this.dialog_Edit_date = true
    },
    getDataExpansDialog_confrim(data) {
      this.book_ID = data
      this.dialog_confrim = true
      // this.selectedItem_Owner = data.Emp_ID
      // this.selectedItem_CM = data.CM_Name
    },
    getDataExpansDialog_delete(data) {
      this.book_ID = data

      this.dialog_delete = true
    },
    getDataExpansDialog_add_to_garage(data) {
      this.selectedItem_Owner = data.Emp_ID
      this.selectedItem_CM = data.CM_Name
      this.book_ID = data.book_ID
      this.model = data.car_model

      this.year = data.car_year
      this.Desc = data.car_model
      this.Desc = data.broken_desc

      this.come_in_date = data.come_in_date
      this.fName = data.name
      this.lName = data.last_name

      this.email = data.Email
      this.tel = data.tel
      this.dialog_add_to_garage = true
    },
    validate() {
      // if (this.$refs.form.validate()) {
      this.UpdateBookingDate(this.book_ID.book_ID, this.dateEdit)
      this.dialog_Edit_date = false
      // }
    },
    validateAddGarage() {
      // if (this.$refs.form2.validateAddGarage()) {
      this.dialog_add_to_garage = false
      this.insertToWIP()
      this.alert = !this.alert
      // }
      console.log('TES2');
    },
    testo() {
      this.dialogAddSucess = false
      this.dialog_Insert = false
      this.alert = !this.alert
      this.QrPic = true
    },
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
    async UpdateBookingDate(bookId, datenew) {
      const api = 'https://testtingfuck.000webhostapp.com/update_booking_date.php'
      const paramUpdate = new URLSearchParams()
      paramUpdate.append('book_id', bookId)
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
      this.getdataBooking()
    },
    async insertToWIP() {
      const datainsert = [{
        booking_id: this.book_ID,
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
        Start_Date: this.come_in_date,
        Finish_Date: this.finish_date,
        Emp_ID: this.selectedItem_Owner.Emp_ID,
      }]
      const api = 'https://testtingfuck.000webhostapp.com/insert_update_bookingIN.php'
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
    async confirmStatusBooking(id) {
      const api = 'https://testtingfuck.000webhostapp.com/update_booking_confirm.php'
      const param = new URLSearchParams()
      param.append('book_ID', id)
      param.append('Emp_ID', this.selectedEmp_Confirm.Emp_ID)
      const response = await Axios.post(api, param)
      const res = response.data
      console.log(res)
      if (res === 1) {
        console.log('pass')
      } else {
        console.log('error update')
      }
      this.getdataBooking()
    },
    async deleteBooking(id) {
      const api = 'https://testtingfuck.000webhostapp.com/deleteBooking.php'
      const param = new URLSearchParams()
      param.append('book_ID', id)
      const response = await Axios.post(api, param)
      const res = response.data
      console.log('delete =', res)
      if (res === 1) {
        this.alertUpdateNewDate = true;
        setTimeout(() => {
          this.alertUpdateNewDate = false;
        }, 10000);
        console.log('pass')
      } else {
        this.errorUpdateNewDate = true;
        setTimeout(() => {
          this.errorUpdateNewDate = false;
        }, 10000);
      }
      this.getdataBooking()
    },
  },
  // eslint-disable-next-line space-before-blocks
}
</script>
