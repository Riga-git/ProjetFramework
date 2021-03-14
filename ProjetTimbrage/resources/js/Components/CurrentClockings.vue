  
<template>
<div class="columns">
  <div class="column is-full">
    <div class="columns is-centered">
      <p class="has-text-weight-bold is-size-3">{{currentTime}}</p>
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
        dataDate : '',
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
        this.dataDate = this.date;
        this.interval = setInterval(() => this.updateTime(), 1000);
    },

    mounted(){  
      axios.get('/clockings', { params: { date: this.getDate() } })
        .then(response => {
          if (response.status === 200) {
              this.clockingsList = response.data.clockingsList;
              for (let index = 0; index < this.clockingsList.length; index++) {
                  if (index % 2){
                    this.clocksOut.push(this.clockingsList[index])
                  }else
                  {
                    this.clocksIn.push(this.clockingsList[index])
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
        this.currentDate = new Date
        let hours = this.currentDate.getHours() < 10 ? '0' + this.currentDate.getHours() : this.currentDate.getHours()
        let minutes = this.currentDate.getMinutes() < 10 ? '0' + this.currentDate.getMinutes() : this.currentDate.getMinutes()
        this.timeSeparator = this.timeSeparator === ' ' ? ':' : ' '
        this.currentTime = hours +  this.timeSeparator + minutes
      },
      getDate() {
        let date = new Date
        let day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate()
        let month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1 // Jan -> 0
        let year = date.getFullYear() < 10 ? '0' + date.getFullYear() : date.getFullYear()
        return year + '-' + month + '-' + day
    },
    }
  }

</script>
