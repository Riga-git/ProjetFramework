  
<template>
<div class="columns is-centered">
  <div class="column is-full">
    <div class="columns is-centered">
      <p style="text-align: center" class="has-text-weight-bold is-size-3">{{currentTime}}</p>
    </div>
    <div class="columns is-centered">
      <div class="column is-full">
        <div class="columns is-centered">
          <div class="column is-justify-content-center">
           <p style="text-align: center" class="has-text-weight-bold is-size-5 mb-2">entrée</p>
           <p v-for="clocking in clocksIn" v-bind:key="clocking.object" style="text-align: center" class="has-text-weight-bold is-size-5">{{clocking}}</p>
          </div>
            <div class="column is-justify-content-center">
            <p style="text-align: center" class="has-text-weight-bold is-size-5 mb-2">sortie</p>
            <p v-for="clocking in clocksOut" v-bind:key="clocking.object" style="text-align: center" class="has-text-weight-bold is-size-5">{{clocking}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>


<script>

  export default {
    props: {
        date : String,
    },

    data() {
      return {
        dateIn : '',
        currentDate : null,
        timeSeparator : '',
        currentTime : '-- : --',
        interval : null,
        clockingsList : null,
        clocksIn : [],
        clocksOut : [],
      }
    },

    created(){
        this.dateIn = this.date === '' ? this.getCurrentDate() : this.date;
        this.interval = setInterval(() => this.updateTime(), 1000);
    },

    mounted(){  
      axios.get('/getClockings', { params: { date: this.dateIn } })
        .then(response => {
          if (response.status === 200) {
              this.clockingsList = response.data.clockingsList;
              this.currentDate = response.data.date;
              for (let index = 0; index < this.clockingsList.length; index++) {
                  if (index % 2){
                    this.clocksOut.push(this.clockingsList[index].substring(6,0))
                  }else
                  {
                    this.clocksIn.push(this.clockingsList[index].substring(6,0))
                  }
              }
          } 
        })
        .catch(error => {
          this.$toasted.show(error.response.data,{duration:3000, icon: 'fa-exclamation-triangle',type:'error'});
          });
    },

    methods: {
      updateTime(){
        let date = new Date
        let hours = date.getHours() < 10 ? '0' + date.getHours() : date.getHours()
        let minutes = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes()
        this.timeSeparator = this.timeSeparator === ' ' ? ':' : ' '
        this.currentTime = hours +  this.timeSeparator + minutes
      },

      getCurrentDate() {
        let date = new Date
        let day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate()
        let month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1 // Jan -> 0
        let year = date.getFullYear() < 10 ? '0' + date.getFullYear() : date.getFullYear()
        return year + '-' + month + '-' + day
      }
    }
  }

</script>
