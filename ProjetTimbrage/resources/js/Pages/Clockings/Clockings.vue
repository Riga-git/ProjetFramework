<template>
  <app-layout>
      <div class="container mt-5">
          <div class="columns is-2 ">
              <div class="column is-half is-justify-content-space-around is-align-items-center">
                  <div class="box">
                      clockings list
                  </div>
              </div>
              <div class="column is-half">
                  <div class="box">
                  <current-clockings :date="''" :key="updateCurrentClockings"></current-clockings>
                  </div>
              </div>
          </div>
      </div>
  </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CurrentClockings from '@/Components/CurrentClockings'

    export default {
        components: {
            AppLayout,
            CurrentClockings
        },

        data() {
            return {
            updateCurrentClockings : false
        }
    },

        methods : {
        }


    }
</script>