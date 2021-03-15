
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
                        <div class="dropdown" v-bind:class="{'is-active': dropDownProjectsActive}">
                        <div class="dropdown-trigger" @click="toggleDropdownProjects">
                          <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                            <span>Projects</span>
                            <span class="icon is-small">
                              <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </span>
                          </button>
                        </div>
                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                          <div class="dropdown-content">
                            <a v-for="project in projects" v-bind:key="project.object" class="dropdown-item" @click="selectProject(project.id)">
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
    'assigmentsForBaseMonth',
    'projectsList'
  ],

  created(){
    this.projects = this.projectsList
  },

  data() {
    return {
      dropDownProjectsActive : false,
      date: {
        from: null,
        to: null,
        month: null,
        year: null,
        projects : null,
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
    },
    toggleDropdownProjects(){
      this.dropDownProjectsActive = !this.dropDownProjectsActive;
    },
    selectProject(id){
      this.$emit('project-selected', id);
    }
  }
}

</script>
