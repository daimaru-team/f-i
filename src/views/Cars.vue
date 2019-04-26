<template>
<v-card width="100%">
      <v-expansion-panel focusable :pagination.sync="pagination" class="elevation-13">
      <v-expansion-panel-content v-for="item in Get_Data_WID" >

        <template v-slot:header>
          <div><h3>{{item.W_ID}} - {{item.License_plate}} <v-icon color="amber accent-4">mail</v-icon></h3></div>
        </template>
        <v-card color="grey darken-3">
          <v-flex class="">
            <v-card-text class="grey lighten-3">
              <p><b> ID : {{item.W_ID}} </b></p>
              <p><b> Car :</b> {{item.CM_Name}} {{item.Model}} </p>
              <p><b> Year :</b>{{item.Car_Year}}</p>
              <!-- <p><b> Color :</b> {{item.Color}}</p> -->
              <p><b> Licens plate :</b>{{item.License_plate}}</p>
              <p><b> Customer :</b> {{item.cus_name}}</p>
              <p><b> อาการเบื้องต้น :</b> {{item.W_Desc}}</p>
              <p><b> ช่างผู้รับผิดชอบ :</b>{{item.emp_name}}</p>
              <p><b> Status :</b>{{item.Status}}
                <!-- สถานะเสร็จ -->
                <v-icon v-if="0==1" color="amber accent-4" >error</v-icon>
                <!-- สถานะยังไม่เสร็จ -->
                <v-icon v-if="1==1" color="green">offline_pin</v-icon>
              </p>
            </v-card-text>
          </v-flex>
          <v-flex class="text-xs-center white--text" headline pt-3 pb-3>Timeline</v-flex>
              <v-container style="max-width: 1200px;" class="grey darken-4 white--text">

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

                  <v-timeline-item class="mb-3" small v-for="timelineR in Get_Data_Timeline" v-if="timelineR.W_ID===item.W_ID">
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        <v-chip class="white--text ml-0" color="purple" label small>
                          รายงานผลปกติ
                        </v-chip>
                        &nbsp;
                        <b>{{timelineR.Report_Name}}</b><br/>
                        <p><br/>&nbsp;&nbsp;&nbsp;{{timelineR.Description}}</p>
                      </v-flex>
                      <v-flex xs7></v-flex>
                      <v-flex xs5 text-xs-right>{{timelineR.DateTime_Created}}</v-flex>
                    </v-layout>
                  </v-timeline-item>


                </v-timeline>

              </v-container>
            <v-flex class="text-xs-center white--text" headline pt-3 pb-3>M.Phonpisud</v-flex>

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
    moment() {
      return moment();
    },
  },
}
</script>
