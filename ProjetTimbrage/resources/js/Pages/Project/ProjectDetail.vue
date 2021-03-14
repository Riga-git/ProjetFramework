<template>
  <app-layout>
    <div>
      <div class="container">
        <div class="card">
          <div class="card-header has-background-primary-dark">
            <div class="container block is-flex is-justify-content-space-between is-align-items-center">
              <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ projectDetail[0].name }}</p>
              <p class="tag mr-4 is-primary-dark has-text-weight-bold is-medium">{{ projectDetail[0].number }}</p>
            </div>
          </div>
          <div class="card-content">
            <nav class="panel">
              <p class="panel-heading">{{ projectDetail[0].totalHours}} affectées sur le projet </p>
              <div v-if="this.projectDetail[0].assignments.length > 0" class="panel-block">
                <p class="control has-icons-left">
                  <input class="input" type="text" v-model="searchedValue" placeholder="Search">
                  <span class="icon is-left">
                    <i class="fas fa-search" aria-hidden="true"></i>
                  </span>
                </p>
              </div>
              <a v-for="assignment in getFilteredAssignments" v-bind:key="assignment.object" class="panel-block" >
              <p>
                <strong> {{ assignment.user.firstName}} {{ assignment.user.lastName}} </strong>
                le {{assignment.date}} : {{assignment.duration}}
              </p>
              </a>
            </nav>
          </div>
          <div v-if="canEdit" class="card-footer">
            <div class="card-footer-item">
              <div @click="updateEditionMode(true)"  class="box">
                  <figure class="image is-32x32">
                    <img src="/Icons/Edit.png" alt="edit">
                  </figure>
              </div>
            </div>
            <div class="card-footer-item">
              <div @click="deleteProjectRequest()"  class="box">
                <figure class="image is-32x32">
                  <img src="/Icons/Delete.png" alt="delete">
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
      <project-modal  :title="'Edit project'"
                      :name="projectDetail[0].name"
                      :number="projectDetail[0].number"
                      :show="this.editionMode"
                      @closeRequest="updateEditionMode(false)"
                      @newProjValues="updateProjectRequest($event)">

      </project-modal>
    </div>
  </app-layout>
</template>

<script>
  import JetNavLink from '@/Jetstream/NavLink'
  import ProjectModal from './ProjectModal.vue'
  import AppLayout from '@/Layouts/AppLayout'

  export default {
    props: ['project',
            'hasAuth',
    ],

    components:{
      JetNavLink,
      ProjectModal,
      AppLayout
    },

    data() {
      return {
        projectDetail : '',
        editForm : '',
        editionMode : false,
        searchedValue : '',
        canEdit : this.hasAuth,
      }
    },

    created(){
      this.projectDetail =  this.project;
    },

    methods: {

      updateEditionMode(newValue){
        this.editionMode = newValue;
      },

      updateProjectRequest(newData) {
        axios.patch('/projects/'+ this.projectDetail[0].id, {
        name : newData.name, number : newData.number
        })
        .then(response => {
            if (response.status === 200) {
              this.projectDetail[0] = response.data.newProj[0];
            }
            this.updateEditionMode(false);
        })
        .catch(error => {
          this.$toasted.show(error.response.data,{duration:3000, icon: 'fa-exclamation-triangle',type:'error'});
          this.updateEditionMode(false);
          });
      },

      deleteProjectRequest() {
        axios.delete('/projects/'+ this.projectDetail[0].id)
        .then(response => {
            if (response.status === 200) {
              window.location.href = '/projects';
            }
        })
        .catch(error => {
          this.$toasted.show(error.response.data,{duration:3000, icon: 'fa-exclamation-triangle',type:'error'});
          });
      }
    },
    computed: {
            getFilteredAssignments(){
                return this.projectDetail[0].assignments.filter(assignment => {
                    return  assignment.user.firstName.toLowerCase().includes(this.searchedValue.toLowerCase()) ||
                            assignment.user.lastName.toLowerCase().includes(this.searchedValue.toLowerCase()) ||
                            assignment.date.toLowerCase().includes(this.searchedValue.toLowerCase()) ||
                            assignment.duration.toLowerCase().includes(this.searchedValue.toLowerCase());
               });
            }
        }
  }

</script>
