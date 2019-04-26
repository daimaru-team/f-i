<template>
    <div class="grey darken-4">
        <v-parallax width="230" height="800" dark src="https://petrolblog.com/wp-content/uploads/2016/01/Skoda-garage-door.jpg">

            <v-container fill-height wrap xs12>
                <v-layout justify-center pt-4>

                    <v-card class="elevation-22 " hover height="350" width="500" light color="grey lighten-2">
                        <v-layout mt-4 justify-center>
                            <v-card-title display-2 ml-5 pl-5>
                                <v-flex headline justify-center>
                                   <h2 class="text-xs-center">F&I GARAGE</h2>
                                   <h6 class="text-xs-center">for customer service</h6>
                                </v-flex>

                            </v-card-title>

                        </v-layout>
                        <v-layout ml-5 mr-5>
                            <v-flex display-3>
                                <v-text-field label="user" v-model="user" hint="รหัสลูกค้า 4 หลัก" ></v-text-field>
                                <!-- <v-text-field label="Lastname" v-model="Lastname"></v-text-field> -->
                                <v-text-field label="password" type="password"></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout justify-center>
                            <v-card-title>
                                <v-btn class="white--text" color="green darken-1" @click="dialog = true">login</v-btn>
                                <v-btn class="white--text" color="blue-grey darken-3">QR  aaaaaaCode</v-btn>
                            </v-card-title>
                        </v-layout>
                    </v-card>
                </v-layout>


                <v-dialog v-model="dialog" max-width="290">
                    <v-card>
                        <v-card-text>
                            <v-text-field disabled v-model="test"></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="green darken-1" flat="flat" @click="dialog = false">
                                Disagree
                            </v-btn>
                            <v-btn color="green darken-1" flat="flat" @click="dialog = false">
                                Agree
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>

            </v-container>

        </v-parallax>
                  <v-footer color="black" app >
            <v-spacer></v-spacer>

            <v-flex-text  class="white--text">&copy; F&I Garage 2019 </v-flex-text>

            <v-spacer></v-spacer>
          </v-footer>
    </div>
</template>


<script>
import VueQrcodeReader from 'vue-qrcode-reader'

export default {
  name: 'login',
  data() {
    return {
      user: null,
      test: null,
      dialog: null,
    }
  },
  methods: {
    fullname() {
      this.dialog = true
    },
  },
}
</script>
