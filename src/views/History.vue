<template>
<v-card width="100%">
<v-data-table
        :headers="headers"
        :items="desserts"
        :search="search"
        hide-actions
        :pagination.sync="pagination"
        class="elevation-13"
      >
        <template v-slot:items="props" @click.stop ="Description = true">
          <td class="text-xs">{{ props.item.Date }}</td>
          <td class="text-xs">{{ props.item.Car }}</td>
          <td class="text-xs">{{ props.item.LicensPlate }}</td>
          <td class="text-xs">{{ props.item.Customer }}</td>
          <td class="text-xs">{{ props.item.BasiCause }}</td>
          <td class="text-xs">{{ props.item.startDate }}</td>
          <td class="text-xs">{{ props.item.finishDate }}</td>
          <td class="text-xs">{{ props.item.Machanic }}</td>

        <v-btn icon small color="grey lighten-2" @click.stop ="Description = true"><v-icon>more_horiz</v-icon></v-btn>
        </template>
      </v-data-table>
      
      
      <v-dialog v-model="Description" max-width="600px">
        <v-layout justify-center>
         <v-card max-width="600px">
            <v-container grid-list-md style="padding: 2px 30px 10px 30px;">
              <v-layout wrap>
                <v-card-text><h2>Work ID : 23245</h2></v-card-text>
                <v-card elevation="0" color="grey lighten-3" width="100%">
                  <v-layout wrap pl-4 pr-4 pb-3 pt-3>
                <v-flex xs12 sm12 md12 pt-3>
                  <h3>Date : 12/12/2561</h3>
                </v-flex>
       
                <v-flex xs12 sm12 md12 pt-3>
                  <h3>รถ : Isuzu D-max 2005</h3>
                </v-flex>

                <v-flex xs12 sm12 md12 pt-3>
                  <h3>ทะเบียน : 62 ภพ 3825</h3>
                </v-flex>

                <v-flex xs12 sm12 md12 pt-3>
                  <h3>ผู้ครอบครอง : สมบัติ เมทานี</h3>
                </v-flex>

                <v-flex xs12 sm12 md12 pt-3>
                  <h3>อีเมลล์ : Phonpisud@gmail.com</h3>
                </v-flex>

                <v-flex xs12 sm12 md12 pt-3>
                  <h3>Line ID : @fgkqwktwb</h3>
                </v-flex>

                <v-flex xs12 sm12 md12 pt-3>
                  <h3>เบอร์โทร : 0916984687</h3>
                </v-flex>
                <v-flex xs12 sm12 md12 pt-3>
                  <h3>สาเหตุ/อาการเสีย : แบตเตอรี่เสื่อม</h3>
                </v-flex>
                <v-flex xs12 sm12 md12 pt-3>
                  <h3>วันเริ่มงาน : 12/02/2001</h3>
                </v-flex>
                <v-flex xs12 sm12 md12 pt-3>
                  <h3>วันสิ้นสุด : 2019</h3>
                </v-flex>
                <v-flex xs12 sm12 md12 pt-3>
                  <h3>รหัสในการเข้าใช้ระบบ : AA23667546</h3>
                </v-flex>
                </v-layout>
                </v-card>

              </v-layout>
            </v-container>
            <!-- <small>*indicates required field</small> -->
            <v-flex pr-3 pb-2>
                      <v-card-actions >
                        <v-spacer></v-spacer>
                        <v-btn color="amber darken-4"  @click="insertCheck = false,insert = true">Edit</v-btn>
                        <v-btn color="blue darken-1"  @click="dialogInsert = false,alert = !alert">Add</v-btn>
                      </v-card-actions>
            </v-flex>
          </v-card>
        </v-layout>
      </v-dialog>
</v-card>



</template>

<script>
export default {
  data() {
    return {
      Description: false,
      search: '',
      pagination: {},
      selected: [],
      headers: [
        { text: 'Date', value: 'Date' },
        { text: 'รถ', value: 'Car' },
        { text: 'ทะเบียน', value: 'LicensPlate' },
        { text: 'ผู้ครอบครอง', value: 'Customer' },
        { text: 'สาเหตุ/อาการ', value: 'BasiCause' },
        { text: 'วันเริ่มงาน', value: 'startDate' },
        { text: 'วันส่งงาน', value: 'finishDate' },
        { text: 'ช่างผู้รับผิดชอบ', value: 'Machanic' },

      ],
      desserts: [
        {
          Date: '12/12/2561',
          Car: 'Isuzu D-max 2005',
          LicensPlate: 'ภก 1253 กทม.',
          Customer: 'สมบัติ เมทานี',
          BasiCause: 'สตาร์ทไม่ติด คาดว่าแบตหมด',
          startDate: '02/01/2562',
          finishDate: '03/01/2562',
          Machanic: 'M.Phonpisud',
          prices: '2,000 B.',
        },
        {
          Date: '12/12/2561',
          Car: 'Isuzu D-max 2005',
          LicensPlate: 'ภก 1253 กทม.',
          Customer: 'สมบัติ เมทานี',
          BasiCause: 'สตาร์ทไม่ติด คาดว่าแบตหมด',
          startDate: '02/01/2562',
          finishDate: '03/01/2562',
          Machanic: 'M.Phonpisud',
          prices: '2,000 B.',

        },
        {
          Date: '12/12/2561',
          Car: 'Isuzu D-max 2005',
          LicensPlate: 'ภก 1253 กทม.',
          Customer: 'สมบัติ เมทานี',
          BasiCause: 'สตาร์ทไม่ติด คาดว่าแบตหมด',
          startDate: '02/01/2562',
          finishDate: '03/01/2562',
          Machanic: 'M.Phonpisud',
          prices: '2,000 B.',

        },
        {
          Date: '12/12/2561',
          Car: 'Isuzu D-max 2005',
          LicensPlate: 'ภก 1253 กทม.',
          Customer: 'สมบัติ เมทานี',
          BasiCause: 'สตาร์ทไม่ติด คาดว่าแบตหมด',
          startDate: '02/01/2562',
          finishDate: '03/01/2562',
          Machanic: 'M.Phonpisud',
          prices: '2,000 B.',

        },

      ],
    }
  },
  computed: {
    pages() {
      if (this.pagination.rowsPerPage == null || this.pagination.totalItems == null
      ) return 0

      return Math.ceil(this.pagination.totalItems / this.pagination.rowsPerPage)
    },
  },
}
</script>
