<template>
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
          <p class="panel-heading">{{ projectDetail[0].totalHours}} already spent on the project </p>
          <div class="panel-block">
            <p class="control has-icons-left">
              <input class="input" type="text" placeholder="Search">
              <span class="icon is-left">
                <i class="fas fa-search" aria-hidden="true"></i>
              </span>
            </p>
          </div>
          <a v-for="assignment in this.projectDetail[0].assignments" v-bind:key="assignment.object" class="panel-block" >
          <p>
            <strong> {{ assignment.user.firstName}} {{ assignment.user.lastName}} </strong> 
            on {{assignment.date}} : {{assignment.duration}} 
          </p>
          </a>
        </nav>
      </div>
      <div class="card-footer">
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
</template>

<script>
  import JetNavLink from '@/Jetstream/NavLink'
  import ProjectModal from './ProjectModal.vue';

  export default {
    props: ['project'],

    components:{
      JetNavLink,
      ProjectModal
    },

    data() {
      return {
        projectDetail : '',
        editForm : '',
        editionMode : false
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
              this.projectDetail[0] = response.data.newProj;
            } 
            updateEditionMode(false);
        })
        .catch(error => {
          console.log(error);
          updateEditionMode(false);
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
          console.log(error);
          });
      }
    }
    
  }

</script>
