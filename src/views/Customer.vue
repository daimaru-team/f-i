<template>

    <v-card width="100%">
    <v-expansion-panel focusable :pagination.sync="pagination" class="elevation-13">
        <v-expansion-panel-content :key="item.Cus_ID" v-for="item in GetData_Cus" >
            <template v-slot:header>
                <div>
                    <h3>{{item.Cus_ID}} | {{item.CusFullName}}
                        <v-badge right overlap v-if="1==1">
                            <template v-slot:badge>
                                <span>1</span>
                            </template>
                            <v-icon medium color="grey lighten-1">notifications_active</v-icon>
                        </v-badge>
                    </h3>
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

                                <v-flex v-for="(item,i) in 2">
                                    <v-divider></v-divider>
                                    <v-flex mb-2 mt-2>
                                        <h3><v-icon>time_to_leave</v-icon><b> Car Number :</b> {{i+1}} </h3>
                                    </v-flex>
                                    <v-flex ml-5>
                                        <p><b> Car ID :</b> 23423 </p>
                                        <p><b> รถ :</b> ISUZU D-max </p>
                                        <p><b> ปี :</b> 2005</p>
                                        <p><b> สี :</b> Blue</p>
                                        <p><b> ทะเบียน :</b> ghfy-29384 bkk</p>
                                        <p><b> อาการเบื้องต้น :</b> สตาร์ทไม่ติด อาการคล้ายแบตเตอรี่หมด</p>
                                        <p><b> ช่างผู้รับผิดชอบ :</b> M.phonpisud</p>
                                        <p><b> สถานะ :</b> อยู่ระหว่างดำเนินการ
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
                                        <v-btn fab dark right color="red"
                                        v-on="on" class="elevation-10"
                                        style="margin-top:10px;"
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
                        <h4>Customer ID : {{WidForDeleteBT}} <br/> คุณต้องลบรายการนี้หรือไม่ ?</h4>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red white--text" @click="dialog_delete = false">No</v-btn>
                        <v-btn color="red white--text" @click="dialog_delete = false">Yes</v-btn>
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
      // this.Get_Data_WID.W_ID = data
      //   console.log('kkkkkkkk',this.timelineWID)
    },
    async getDataCustomer() {
      const api = 'https://testtingfuck.000webhostapp.com/select_display_customer.php';
      const response = await Axios.post(api)
      console.log(response.data)
      this.GetData_Cus = response.data
    },


  },
}
</script>
