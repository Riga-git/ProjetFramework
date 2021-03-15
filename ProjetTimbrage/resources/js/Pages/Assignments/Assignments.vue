
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
                        <a v-for="(workingTime, index) in workingTimeForMonthData" v-bind:key="workingTime.object" class="tag mb-1 is-block is-medium is-flex is-justify-content-space-between">
                            <div>
                                {{index}}-{{actualMonthData}}-{{actualYearData}}
                            </div>
                            <div v-if="(workingTime.hours!== 0 || workingTime.minutes!== 0)">
                              {{workingTime.hours}} : {{workingTime.minutes}}
                            </div>
                        </a>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="box">
                        <div class="dropdown" v-bind:class="{'is-active': dropDownProjectsActive}">
                        <div class="dropdown-trigger" @click="toggleDropdownProjects">
                          <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                            <span>{{selectedProjectName}}</span>
                            <span class="icon is-small">
                              <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </span>
                          </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                          <div class="dropdown-content">
                            <a v-for="project in projects" v-bind:key="project.object" class="dropdown-item" @click="selectProject(project)">
                              {{project.name}}
                            </a>
                          </div>
                        </div>
                      </div>
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
    'workingTimeForMonth',
    'projectsList',
    'assigments',
  ],

  created(){
    this.projects = this.projectsList
    this.selectedProjectName = 'Projects...'
    this.lastDayInMonthData = this.LastDayInMonth
    this.workingTimeForMonthData = this.workingTimeForMonth
    this.actualMonthData = this.actualMonth
    this.actualYearData = this.actualYear
  },

  data() {
    return {
      dropDownProjectsActive : false,
      lastDayInMonthData : null,
      workingTimeForMonthData : null,
      actualMonthData : null,
      actualYearData : null,
        date: {
        from: null,
        to: null,
        month: null,
        year: null,
        projects : null,
        selectedProjectName : ''
      }, 

      defaultCalandar: {
        defaultMonth : this.actualMonth,
        defaultYear : this.actualYear,
        inputPrefilled : true,
      },

      dayDetail: {},
    }
  },

  methods: {
    showDate (date) {
      this.date = date
    },

    toggleDropdownProjects(){
      this.dropDownProjectsActive = !this.dropDownProjectsActive;
    },

    selectProject(project){
      this.$emit('project-selected', project.id)
      this.selectedProjectName = project.name
      this.toggleDropdownProjects()
    },

    showDayDetail(day, month, year){
      this.dayDetail = {

      }
    }

  }
}

</script>
