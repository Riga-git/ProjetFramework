<template>
    <app-layout>
        <div class="container mt-5">
          <div class="columns is-2 is-centered">
              <div class="column is-half">
                    <div class="box">
                        <div class="columns is-centered">
                            <vc-calendar :attributes='attrs' @dayclick="updateClockings($event)"></vc-calendar>
                        </div>
                  </div>
                </div>
                <div class="column is-half">
                    <div class="box">
                        <current-clockings :date="selectedDate" :key="selectedDate"></current-clockings>
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
            updateCurrentClockings : false,
            selectedDate : '',
            attrs: [{
                key: 'today',
                highlight: true,
                dates: new Date(),
            }],
        }
    },

        methods : {
            updateClockings(datePicked){
                this.selectedDate = datePicked.id;
            },
        }
    }
</script>