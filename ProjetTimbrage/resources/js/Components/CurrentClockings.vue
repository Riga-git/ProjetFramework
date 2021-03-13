  
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
           <p style="text-align: center" class="has-text-weight-bold is-size-5">in</p>
          </div>
            <div class="column is-justify-content-center">
            <p style="text-align: center" class="has-text-weight-bold is-size-5">out</p>
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
        interval : null
      }
    },

    created(){
        this.dataDate = this.date;
        this.interval = setInterval(() => this.updateTime(), 1000);
    },

    methods: {
      updateTime(){
        this.currentDate = new Date
        let hours = this.currentDate.getHours() < 10 ? '0' + this.currentDate.getHours() : this.currentDate.getHours()
        let minutes = this.currentDate.getMinutes() < 10 ? '0' + this.currentDate.getMinutes() : this.currentDate.getMinutes()
        this.timeSeparator = this.timeSeparator === ' ' ? ':' : ' '
        this.currentTime = hours +  this.timeSeparator + minutes
      }
    },
  }

</script>
