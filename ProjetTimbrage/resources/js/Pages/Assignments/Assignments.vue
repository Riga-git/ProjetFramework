
<template>
    <app-layout>
        <div class="container mt-5">
          <div class="columns is-centered">
              <month-picker-input class="monthPicker"
                              lang="fr"
                              :default-month="defaultCalandar.defaultMonth"
                              :default-year="defaultCalandar.defaultYear"
                              :input-pre-filled="defaultCalandar.inputPrefilled"
                              @input="showDate">
            </month-picker-input>
          </div>
          <div class="columns is-2 is-centered">
              <div class="column is-half">
                    <div class="box">
                        <div class="columns is-centered">
                           content left
                        </div>
                  </div>
                </div>
                <div class="column is-half">
                    <div class="box">
                        content right
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import { MonthPickerInput } from 'vue-month-picker'
  //import JetNavLink from '@/Jetstream/NavLink'

export default {
  components: { AppLayout,
                MonthPickerInput,
              },

  props: [
    'actualMonth',
    'actualYear',
    'assigmentsForBaseMonth',
  ],

  data() {
    return {
      date: {
        from: null,
        to: null,
        month: null,
        year: null
      },

      defaultCalandar: {
        defaultMonth : this.actualMonth,
        defaultYear : this.actualYear,
        inputPrefilled : true,
      },
    }
  },

  methods: {
    showDate (date) {
      this.date = date
    }
  }
}

</script>
