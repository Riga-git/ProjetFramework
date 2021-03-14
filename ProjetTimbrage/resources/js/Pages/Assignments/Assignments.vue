<template>
  <app-layout>
        <month-picker-input lang="fr"
                            :default-month="defaultCalandar.defaultMonth"
                            :default-year="defaultCalandar.defaultYear"
                            :input-pre-filled="defaultCalandar.inputPrefilled"
                            @input="showDate">
          </month-picker-input>
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
