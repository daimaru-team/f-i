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
                    <h3><b>{{item.Emp_ID}}::</b> {{item.Emp_Name}} {{item.Emp_Lname}}
                        <v-icon color="amber accent-4">build</v-icon>
                    </h3>
                </div>
            </template>
            <v-card color="grey lighten-3">
                <v-flex>
                    <v-layout>
                        <v-flex md11 xl11 sm11 lg11 xs11>
                            <v-card-text class="grey lighten-3">
                                <v-flex mb-2>
                                    <h3><b> Employee ID :</b> {{item.Emp_ID}} </h3>
                                </v-flex>
                                <v-divider></v-divider>
                                <v-flex mt-3 ml-3>
                                    <p><b> เลขที่บัตรประชาชน :</b> 232301040-1-301-3132 </p>
                                    <p><b> ชื่อ-สกุล :</b> {{item.Emp_Name}} {{item.Emp_Lname}} </p>
                                    <p><b> ตำแหน่ง :</b> {{item.Pos_ID}} </p>
                                    <p><b> อายุ :</b> {{calculate_age(item.Birthday)}}</p>
                                    <!-- {{calculate_age(item.Birthday)}} -->
                                    <p><b> วันเกิด :</b> วันเกิดยังไม่ได้ทำนะพี่ฟีน*******</p>
                                    <p><b> ที่อยู่ :</b> {{item.Address}} </p>
                                    <p><b> วันเข้าทำงาน :</b> {{item.Start_Date}}</p>
                                    <p><b> เบอร์โทร :</b> {{item.Phone_Num}}</p>
                                    <p><b> Line ID :</b> {{item.LineID}}</p>
                                    <p><b> Email :</b> {{item.Email}}</p>
                                    <p><b> เงินเดือน :</b> 20,000 *******</p>
                                    <p><b> ความถนัด :</b> Honda********* </p>
                                </v-flex>

                            </v-card-text>
                        </v-flex>

                        <v-flex md1 xl1 sm1 lg1 xs1>
                            <v-layout justify-end wrap>
                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn fab dark right color="orange accent-3" v-on="on" class="elevation-10" style="margin-top:10px;" @click="dialog_Edit = true,alert = false">
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

                <v-container class="grey lighten-2 black--text">
                    <v-flex class="text-xs-center black--text" pt-2>
                        <h1>Work in procress</h1>
                    </v-flex>
                    <v-flex>
                        <v-container style="max-width: 1000px;" class="lighten-2">
                            <div v-for="work in GetData_Work_in" v-bind:key="work.W_ID" v-if="work.Emp_ID===item.Emp_ID">
                                <h3>Work ID : {{work.W_ID}} Status: "{{work.Status}}"</h3>
                                <p> Car_ID:{{work.Car_ID}}<br/> Description: {{work.W_Desc}}<br/><b>วันนัดรับรถ:</b> {{work.Finish_Date}} </p>
                                <p></p>
                            </div>
                        </v-container>
                    </v-flex>
                </v-container>
            </v-card>

            <v-dialog v-model="dialog_Edit" max-width="700px">
                <v-card v-if="insert == true">
                    <v-card-text>
                        <h1 class="text-xs-center">แก้ไขข้อมูลพนักงาน</h1>
                        <h3 class="text-xs-center">F&I GARAGE</h3>
                    </v-card-text>

                    <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                        <v-layout wrap>
                            <v-card-text>ข้อมูลพนักงาน</v-card-text>
                            <v-btn color="purple darken-3" fab small @click="isEditing = !isEditing">
                                <v-icon v-if="isEditing">mdi-close</v-icon>
                                <v-icon v-else>mdi-pencil</v-icon>
                            </v-btn>

                            <v-card elevation="5" color="grey lighten-3" width="100%">
                                <v-layout wrap pl-4 pr-4 pb-3 pt-2>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="รหัสพนักงาน" :disabled="true" :value='item.Emp_ID' required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="เลขที่บัตรประชาชน" :disabled="!isEditing" :value='item.Emp_ID' required></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="ชื่อ*" :disabled="!isEditing" :value='item.Emp_Name' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="นามสกุล*" :disabled="!isEditing" :value='item.Emp_Lname' persistent-hint required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm12 md12>
                                        <v-text-field label="ที่อยู่ปัจจุบัน*" :disabled="!isEditing" :value='item.Address' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="วันเกิด*" :disabled="!isEditing" :value='calculate_age(item.Birthday)' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="อายุ*" :disabled="!isEditing" :value='calculate_age(item.Birthday)' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm12 md12 pr-3>
                                        <v-text-field label="อีเมล์*" :disabled="!isEditing" :value='item.Email' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6 pr-3>
                                        <v-text-field label="Line ID*" :disabled="!isEditing" :value='item.LineID' required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md6>
                                        <v-text-field label="เบอร์โทร*" :disabled="!isEditing" :value='item.Phone_Num' required></v-text-field>
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

                <v-dialog v-model="insertCheck" persistent max-width="700px">
                    <v-card color="white" elevation="10">
                        <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                            <v-layout wrap>
                                <v-card-text>
                                    <h2>รหัสพนักงาน : {{EmpID}}</h2>
                                </v-card-text>
                                <v-card elevation="3" color="grey lighten-3" width="100%">
                                    <v-layout wrap pl-4 pr-4 pb-3 pt-3 subheading>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>ชื่อ : </b>{{Name}}</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>นามสกุล :</b> {{LastName}}</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>ที่อยู่ :</b> 62 / fge5g sdfbse hk sa.fg rgeorg . wr weefefg 10400</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>วันเกิด :</b> 02/04/40</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>อีเมลล์ :</b> Phonpisud</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>Line ID :</b> @fgkqwktwb</div>
                                        </v-flex>

                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>เบอร์โทร :</b> 0916984687</div>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>ตำแหน่ง :</b> หัวหน้าช่าง</div>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>ความถนัด :</b> ขันน็อตได้</div>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>เงินเดือน :</b> 60,000-</div>
                                        </v-flex>
                                        <v-flex xs12 sm12 md12 pt-3>
                                            <div><b>รหัสในการเข้าใช้ระบบ :</b> AA23667546</div>
                                        </v-flex>
                                    </v-layout>
                                </v-card>

                            </v-layout>
                        </v-container>
                        <!-- <small>*indicates required field</small> -->
                        <v-flex pr-3 pb-2>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="amber darken-4" @click="insertCheck = false,insert = true">Edit</v-btn>
                                <v-btn color="blue darken-1" @click="dialogInsert = false,alert = !alert">Add</v-btn>
                            </v-card-actions>
                        </v-flex>
                    </v-card>
                </v-dialog>
            </v-dialog>

        </v-expansion-panel-content>
    </v-expansion-panel>

    <v-dialog v-model="dialogInsert" persistent max-width="700px">
        <v-card v-if="insert == true">
            <v-card-text>
                <h1 class="text-xs-center">Insert Employee</h1>
                <h3 class="text-xs-center">F&I GARAGE</h3>
            </v-card-text>

            <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                <v-layout wrap>
                    <v-card-text>ข้อมูลพนักงาน</v-card-text>
                    <v-card elevation="5" color="grey lighten-3" width="100%">
                        <v-layout wrap pl-4 pr-4 pb-3 pt-2>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="ชื่อ*" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6>
                                <v-text-field label="นามสกุล*" persistent-hint required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm12 md12>
                                <v-text-field label="ที่อยู่ปัจจุบัน*" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="วันเกิด*" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="อีเมล์*" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="Line ID*" required></v-text-field>
                            </v-flex>

                            <v-flex xs12 sm6 md6>
                                <v-text-field label="เบอร์โทร*" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-autocomplete :items="['หัวหน้าช่าง', 'ผู้ดูแลระบบ','ผู้ช่วยช่าง']" label="ตำแหน่ง*" persistent-hint>
                                </v-autocomplete>
                            </v-flex>
                            <v-flex xs12 sm6 md6>
                                <v-text-field label="ความถนัด" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="เงินเดือน*" required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-card>
                    <v-card-text>ข้อมูลระบบ</v-card-text>
                    <v-card elevation="5" color="grey lighten-3" width="100%">
                        <v-layout wrap pl-4 pr-4 pb-2 pt-2>
                            <v-flex xs12 sm6 md6 pr-3>
                                <v-text-field label="รหัสในการเข้าใช้ระบบ*" required></v-text-field>
                            </v-flex>
                            <v-flex xs12 sm6 md6>
                                <v-text-field label="ยืนยันอีกครั้ง*" required></v-text-field>
                            </v-flex>
                        </v-layout>
                    </v-card>

                </v-layout>
            </v-container>
            <!-- <small>*indicates required field</small> -->

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="dialogInsert = false">Cencel</v-btn>
                <v-btn color="blue darken-1" flat @click="insertCheck = true">Add</v-btn>
            </v-card-actions>
        </v-card>

        <v-dialog v-model="insertCheck" persistent max-width="700px">
            <v-card color="white" elevation="10">
                <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
                    <v-layout wrap>
                        <v-card-text>
                            <h2>รหัสพนักงาน : {{EmpID}}</h2>
                        </v-card-text>
                        <v-card elevation="3" color="grey lighten-3" width="100%">
                            <v-layout wrap pl-4 pr-4 pb-3 pt-3 subheading>
                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>ชื่อ : </b>{{Name}}</div>
                                </v-flex>

                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>นามสกุล :</b> {{LastName}}</div>
                                </v-flex>

                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>ที่อยู่ :</b> 62 / fge5g sdfbse hk sa.fg rgeorg . wr weefefg 10400</div>
                                </v-flex>

                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>วันเกิด :</b> 02/04/40</div>
                                </v-flex>

                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>อีเมลล์ :</b> Phonpisud</div>
                                </v-flex>

                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>Line ID :</b> @fgkqwktwb</div>
                                </v-flex>

                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>เบอร์โทร :</b> 0916984687</div>
                                </v-flex>
                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>ตำแหน่ง :</b> หัวหน้าช่าง</div>
                                </v-flex>
                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>ความถนัด :</b> ขันน็อตได้</div>
                                </v-flex>
                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>เงินเดือน :</b> 60,000-</div>
                                </v-flex>
                                <v-flex xs12 sm12 md12 pt-3>
                                    <div><b>รหัสในการเข้าใช้ระบบ :</b> AA23667546</div>
                                </v-flex>
                            </v-layout>
                        </v-card>

                    </v-layout>
                </v-container>
                <!-- <small>*indicates required field</small> -->
                <v-flex pr-3 pb-2>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="amber darken-4" @click="insertCheck = false,insert = true">Edit</v-btn>
                        <v-btn color="blue darken-1" @click="dialogInsert = false,alert = !alert">Add</v-btn>
                    </v-card-actions>
                </v-flex>
            </v-card>
        </v-dialog>
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
        const api = 'https://testtingfuck.000webhostapp.com/read_Mechanic_load.php';
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
                    console.log(this.GetData_Work_in)
                }
            })
        // this.read_table('Employee')
        // this.read_Table2()
    },
    data() {
        return {
            isEditing: null,
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
            EmpID: '21454',
            Name: 'Phonpisud',
            LastName: 'Sumangsa',
            selected: [],
            headers: [{
                    text: 'Mechanic ID',
                    align: '',
                    sortable: false,
                    value: 'Emp_ID',
                },
                {
                    text: 'Name',
                    value: 'Emp_name',
                },
                {
                    text: 'Last Name',
                    value: 'Emp_name',
                },
                {
                    text: 'Position',
                    value: 'Pos_ID',
                },
                {
                    text: 'Address',
                    value: 'Position',
                },
                {
                    text: 'Date OB',
                    value: 'Date OB',
                },
                {
                    text: 'Join date',
                    value: 'Join date',
                },
                {
                    text: 'Salary',
                    value: 'Salary',
                },
                {
                    text: 'Phone number',
                    value: 'Phone number',
                },
                {
                    text: 'Email',
                    value: 'Email',
                },
                {
                    text: 'Line ID',
                    value: 'Line ID',
                },
            ],
        }
    },
    computed: {

        pages() {
            // eslint-disable-next-line vue/no-side-effects-in-computed-properties
            this.pagination.rowsPerPage = 12
            console.log(this.pagination.rowsPerPage)
            if (this.pagination.rowsPerPage == null ||
                this.pagination.totalItems == null
            ) return 0
            return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
        },
    },
    methods: {
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
    },
}
</script>
