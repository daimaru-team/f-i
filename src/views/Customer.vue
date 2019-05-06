<template>

    <v-card width="100%">
    <v-expansion-panel focusable :pagination.sync="pagination" class="elevation-13">
        <v-expansion-panel-content :key="item.Cus_ID" v-for="item in GetData_Cus" >
            <template v-slot:header>
                <div>
                    <h3>{{item.Cus_ID}} | {{item.CusFullName}}</h3>
                </div>
            </template>

            <v-card color="grey darken-3">
                <v-flex>
                    <v-layout>
                        <v-flex md11 xl11 sm11 lg11 xs11>
                            <v-card-text class="grey lighten-3">
                                <v-flex mb-2>
                                    <h2><b> Customer ID :</b> {{item.Cus_ID}} </h2>
                                </v-flex>
                                <v-divider></v-divider>
                                <v-divider></v-divider>

                                <v-flex mt-2>
                                    <v-flex mt-3 headline font-weight-bold>
                                    <v-icon>person</v-icon> ข้อมูลลูกค้า
                                    </v-flex>
                                    <v-flex mt-3 ml-3>
                                        <p><b> เลขที่บัตรประชาชน :</b> {{item.Cus_ID}}</p>
                                        <p><b> ชื่อ-สกุล :</b> {{item.CusFullName}}</p>
                                        <p><b> ที่อยู่ :</b> {{item.Address}} </p>
                                        <p><b> วันเกิด:</b> {{item.Birthday}} </p>
                                        <p><b> line ID :</b> {{item.Line_userId}}</p>
                                        <p><b> เบอร์โทรศัพท์ :</b> {{item.Phone_Num}} </p>
                                        <p><b> E-mail :</b> {{item.Email}}</p>
                                        <p><b> วันที่ทำรายการ :</b> {{item.Birthday}}</p>
                                        <p><b> ครอบครองรถจำนวน :</b> 2 </p>
                                    </v-flex>
                                </v-flex>

                                <v-flex v-for="itemCar in item.Car_Detail">
                                    <v-divider></v-divider>
                                    <v-flex mb-2 mt-2>
                                        <h3><v-icon>time_to_leave</v-icon><b> Car ID :</b> {{itemCar.Car_ID}} </h3>
                                    </v-flex>
                                    <v-flex ml-5>
                                        <p><b> รถ :</b> {{itemCar.CM_Name}} {{itemCar.Model}}</p>
                                        <p><b> ปี :</b> {{itemCar.Car_Year}} </p>
                                        <p><b> สี :</b> {{itemCar.Color}} </p>
                                        <p><b> ทะเบียน :</b> {{itemCar.License_plate}}</p>
                                        <p class="red"><b> สถานะ :</b>  ยังงไม่มานนนนะะ
                                            <!-- สถานะเสร็จ -->
                                            <v-icon v-if="1==1" color="amber accent-4">error</v-icon>
                                            <!-- สถานะยังไม่เสร็จ -->
                                            <v-icon v-if="0==1" color="green">offline_pin</v-icon>
                                        </p>
                                    </v-flex>
                                </v-flex>
                            </v-card-text>
                        </v-flex>
                        <v-flex md1 xl1 sm1 lg1 xs1 class="grey lighten-3">
                            <v-layout justify-end wrap>

                                <v-tooltip left>
                                    <template v-slot:activator="{ on }">
                                        <v-btn small fab dark right color="red"
                                        v-on="on" class="elevation-10"
                                        @click="dialog_delete = true,
                                        getDataDelete(item.Cus_ID),alert = false">
                                            <v-icon dark>delete_forever</v-icon>
                                        </v-btn>
                                    </template>
                                    <span>ลบรายการนี้</span>
                                </v-tooltip>

                            </v-layout>
                        </v-flex>

                    </v-layout>
                </v-flex>
            </v-card>

            <v-dialog v-model="dialog_delete" max-width="300">
                <v-card>
                    <v-card-title class="headline grey darken-4 white--text" primary-title>F&I Garage -
                        <v-icon large color="red"> delete_forever</v-icon>-
                    </v-card-title>

                    <v-card-text>
                        <h4>Customer ID : {{WidForDeleteBT}} <br/> คุณต้องการลบรายการนี้หรือไม่ ?</h4>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red white--text" @click="dialog_delete = false">No</v-btn>
                        <v-btn color="red white--text" @click="DeleteCustomer()">Yes</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>

        </v-expansion-panel-content>
    </v-expansion-panel>

</v-card>


</template>

<script>
import moment from 'moment'
import Clock from 'vue-clock2'
import Axios from 'axios';


export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
    // eslint-disable-next-line vue/no-unused-components

  },
  created() {
    window.addEventListener('resize', this.handleResize)
    this.handleResize();


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
    //       console.log('ING', this.GetData_Work_in)
    //     }
    //   })
    // this.read_table('Employee')
    // this.read_Table2()
  },
  mounted() {
    this.getDataCustomer();
  },
  data() {
    return {
      WidForDeleteBT: '',
      dialog_delete: false,
      dialog_Timeline: false,
      dialog_confrim: false,
      alertUpdateNewDate: false,
      errorUpdateNewDate: false,
      search: '',
      pagination: {},
      selected: [],
      GetData_Cus: [],
      DataEdit: [{

      }],
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
    moment() {
      return moment();
    },
    getDataDelete(data) {
      console.log('data delete=', data)
      this.WidForDeleteBT = data
      console.log(this.WidForDeleteBT)
      // this.Get_Data_WID.W_ID = data
      //   console.log('kkkkkkkk',this.timelineWID)
    },
    async getDataCustomer() {
      const api = 'https://testtingfuck.000webhostapp.com/select_display_customer.php';
      const response = await Axios.post(api)
      console.log(response.data)
      this.GetData_Cus = response.data
    },
    async DeleteCustomer() {
      const api = 'https://testtingfuck.000webhostapp.com/delete_customer.php'
      const param = new URLSearchParams()
      param.append('DeleteID', this.WidForDeleteBT)
      const response = await Axios.post(api, param)
      console.log('======>DeleteCustomer', response)
      this.dialog_delete = false
    },

    async UpdateDataCustomer(data) {
      const api = ''
      const param = new URLSearchParams()
      const dataJSON = JSON.stringify(data);
      param.append('data_insert', dataJSON)
      const response = await Axios.post(api, param)
      if (response.data === 1) {

      } else {

      }
    },
  },
}
</script>
