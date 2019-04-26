<template>
<v-card width="100%">
      <v-expansion-panel focusable :pagination.sync="pagination" class="elevation-13">
      <v-expansion-panel-content v-for="(item,i) in 1" :key="i" >
        <template v-slot:header>
          <div><h3>283746 | K.sombut methanee.
            <v-badge right overlap v-if="1==1">
                <template v-slot:badge>
                  <span>1</span>
                </template>
                  <v-icon medium color="grey lighten-1">notifications_active</v-icon>
              </v-badge>
            </h3></div>
        </template>

        <v-card color="grey darken-3">
           <v-flex>
            <v-card-text class="grey lighten-3">
              <p><b> ID :</b> 23423 </p>
              <p><b> Car :</b> ISUZU D-max </p>
              <p><b> Year :</b> 2005</p>
              <p><b> Color :</b> Blue</p>
              <p><b> Licens plate :</b> ghfy-29384 bkk</p>
              <p><b> Customer :</b> Paul walker</p>
              <p><b> อาการเบื้องต้น :</b> สตาร์ทไม่ติด อาการคล้ายแบตเตอรี่หมด</p>
              <p><b> ช่างผู้รับผิดชอบ :</b> M.phonpisud</p>
              <p><b> Status :</b> อยู่ระหว่างดำเนินการ
                <!-- สถานะเสร็จ -->
                <v-icon v-if="1==1" color="amber accent-4" >error</v-icon>
                <!-- สถานะยังไม่เสร็จ -->
                <v-icon v-if="0==1" color="green">offline_pin</v-icon>
              </p>
            </v-card-text>
          </v-flex>
          <v-flex class="grey darken-3 text-xs-center white--text " headline pt-3 pb-3>Timeline</v-flex>
          <v-container class="grey darken-4 white--text black--text">
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

                  <v-timeline-item class="mb-3" color="grey" icon-color="grey lighten-2" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>This order was archived.</v-flex>
                      <v-flex xs5 text-xs-right>15:26 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        <v-chip class="white--text ml-0" color="purple" label small>
                          APP
                        </v-chip>
                        Digital Downloads fulfilled 1 item.
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" color="grey" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        Order confirmation email was sent to John Leider (john@vuetifyjs.com).
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" hide-dot>
                    <v-btn class="mx-0" color="white">
                      Resend Email
                    </v-btn>
                  </v-timeline-item>

                  <v-timeline-item class="mb-3" color="grey" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        A $15.00 USD payment was processed on PayPal Express Checkout
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>

                  <v-timeline-item color="grey" small>
                    <v-layout justify-space-between>
                      <v-flex xs7>
                        John Leider placed this order on Online Store (checkout #1937432132572).
                      </v-flex>
                      <v-flex xs5 text-xs-right>15:25 EDT</v-flex>
                    </v-layout>
                  </v-timeline-item>
                </v-timeline>
          </v-container>
          <v-flex class="grey darken-3 text-xs-center white--text" headline pt-3 pb-3>M.Phonpisud</v-flex>

        </v-card>
      </v-expansion-panel-content>
    </v-expansion-panel>

</v-card>
</template>

<script>
import moment from 'moment'
import Clock from 'vue-clock2'

export default {
  components: {
    // eslint-disable-next-line vue/no-unused-components
    Clock,
  },
  data() {
    return {
      search: '',
      pagination: {},
      selected: [],
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
