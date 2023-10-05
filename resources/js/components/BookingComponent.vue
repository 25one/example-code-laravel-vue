<template>  
    <div class="row">
      <div class="col-md-2">
      </div>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <h3 style="margin:5px">History of your reservations</h3>
        <div class="row">
         <div class="col-md-3 border font-weight-bold">room</div>
         <div class="col-md-3 border font-weight-bold">price</div>
         <div class="col-md-3 border font-weight-bold">arrival date</div>
         <div class="col-md-3 border font-weight-bold">date of departure</div>
        </div>         
        <div class="row" v-for="reservation, index in reservations">
         <div class="col-md-3 border">{{ reservation.room.name }}</div>
         <div class="col-md-3 border">{{ reservation.room.price }}</div>
         <div class="col-md-3 border">{{ reservation.date_start }}</div>
         <div class="col-md-3 border">{{ reservation.date_end }}</div>
        </div> 
        <hr />
        <h3 style="margin:5px">New reservation</h3>
        <div class="row">
          <div class="col-md-4">
             <h4 style="margin:5px">arrival date</h4>
             <date-picker v-model="dateStart" valueType="format"></date-picker>
          </div>
          <div class="col-md-4">
             <h4 style="margin:5px">date of departure</h4>
             <date-picker v-model="dateEnd" valueType="format"></date-picker>
          </div>  
          <div class="col-md-4">
             <button class="btn btn-info" v-on:click="listVacancies()">check vacancies</button>
          </div>            
        </div>
        <hr >
        <div class="row" v-if="vacancies.length">
          <div class="col-md-4">
            <h4 style="margin:5px">vacancies</h4>
            <select class="mySelect" v-model="vacancyRoomId" v-on:change="showRoomInformation()">
               <option v-for="vacancy, index in vacancies" v-bind:value="vacancy.id">{{ vacancy.name }}</option>             
            </select>
          </div>
        </div>
        <div class="row m-3" v-if="room.image">
            <div class="col-lg-4 room_image">
               <img class="roomImg" :src="'images/' + room.image" />
            </div>
            <div class="col-lg-8 room_col">
               <div class="room_info">
                     <div class="room_name"><h4>{{ room.name }}</h4></div>
                     <div class="room_price">{{ room.price }}</div>
                     <div class="room_text">
                        <p>{{ room.title }}</p>
                     </div>
                     <div class="room_buttons">
                       <button class="btn btn-success" v-on:click="makeReservation()">reserve</button>
                     </div>
               </div>
            </div>
        </div>   
      </div>  
      <div class="col-md-2">
      </div>  
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import Vue from 'Vue';
import VueToast from 'vue-toast-notification';

    export default {
        components: { DatePicker },
        data: function() {
           return {
              apitoken: user.api_token,
              reservations: [],
              dateStart: null,
              dateEnd: null,
              vacancies: [],
              vacancyRoomId: null,
              room: {
                 id: null,
                 image: null,
                 name: null,
                 title: null,
                 price: null
              },          
           }
        },
        mounted() {
           var app = this;
           this.listReservations();
        },
        methods: {
           listReservations: function(){
             var app = this;

             axios.defaults.headers.common['Authorization'] = 'Bearer ' + app.apitoken;

             axios
              .get('/api/reservations')
                .then(function (resp) {
                    console.log(resp.data);

                    app.reservations = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp.response);                      
                });
           }, 

           listVacancies: function(){
             var app = this;

             let dateReservationInterval = {
                dateStart: this.dateStart,
                dateEnd: this.dateEnd, 
             };

             axios.defaults.headers.common['Authorization'] = 'Bearer ' + app.apitoken;

             axios
              .get('/api/vacancies', { params: dateReservationInterval })
                .then(function (resp) {
                    console.log(resp.data);

                    if (resp.data.length) {
                        app.vacancies = resp.data;

                        app.vacancyRoomId = null;
                        app.room.id = null;
                        app.room.image = null;
                        app.room.name = null;
                        app.room.title = null;
                        app.room.price = null;                        
                    } else {
                        app.vacancies = [];
                        app.vacancyRoomId = null;
                        app.room.id = null;
                        app.room.image = null;
                        app.room.name = null;
                        app.room.title = null;
                        app.room.price = null;

                        Vue.use(VueToast);
                        let parametersToast = { 
                           position: "top-left", 
                           duration : 5000
                        }
                        let instance = Vue.$toast.info('There are no vacancies for these dates. Try other dates.', parametersToast); 
                    }
                })
                .catch(function (resp) {
                    console.log(resp.response);
                    console.log(resp.response.data.errors)

                    app.vacancies = [];
                    app.vacancyRoomId = null;
                    app.room.id = null;
                    app.room.image = null;
                    app.room.name = null;
                    app.room.title = null;
                    app.room.price = null;

                    let errors = '';
                    for (let i in resp.response.data.errors) {
                       errors += resp.response.data.errors[i] + ' ';
                    }

                    Vue.use(VueToast);
                    let parametersToast = { 
                      position: "top-right", 
                      duration : 5000
                    }
                    let instance = Vue.$toast.error(errors, parametersToast);                        
                });
           }, 

           showRoomInformation() {
             var app = this;

             axios.defaults.headers.common['Authorization'] = 'Bearer ' + app.apitoken;

             axios
              .get('/api/room', { params: {id: this.vacancyRoomId} })
                .then(function (resp) {
                    console.log(resp.data);

                    app.room = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp.response);                    
                });
           },

           makeReservation(){
             var app = this;
             var newReservation = {
                room_id: app.room.id,
                date_start: app.dateStart,
                date_end: app.dateEnd, 
             };           
             axios
              .post('/api/reservation?api_token=' + app.apitoken, newReservation)
                .then(function (resp) {
                    console.log(resp);

                    app.dateStart = null;
                    app.dateEnd = null;
                    app.vacancies = [];
                    app.vacancyRoomId = null;
                    app.room.id = null;
                    app.room.image = null;
                    app.room.name = null;
                    app.room.title = null;
                    app.room.price = null;

                    app.listReservations();
                })
                .catch(function (resp) {
                    console.log(resp.response);
                    console.log(resp.response.data.errors)

                    let errors = '';
                    for (let i in resp.response.data.errors) {
                       errors += resp.response.data.errors[i] + ' ';
                    }

                    Vue.use(VueToast);
                    let parametersToast = { 
                      position: "top-right", 
                      duration : 5000
                    }
                    let instance = Vue.$toast.error(errors, parametersToast);                      
                });
           },
        },
    }
</script>
