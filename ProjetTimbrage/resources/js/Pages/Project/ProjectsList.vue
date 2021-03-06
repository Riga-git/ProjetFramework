<template>
  <div>
    <div class="container mt-5">
      <div class="columns is-multiline">
        <div v-for="project in this.projectsList" v-bind:key="project.object" class="column">
            <inertia-link :href="'projects/' + project.id" :active=false>
              <div class="card">
                <div class="card-header has-background-primary-dark">
                  <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ project.name }}</p>
                </div>
                <div class="card-content">
                  <p class="tag is-primary-dark has-text-weight-bold is-medium mb-2">{{ project.number }}</p>
                  <p><span class="icon has-text-primary-dark"><em class="fas fa-clock"></em></span> {{ project.totalHours}}</p>
                </div>
              </div>
            </inertia-link>
        </div>
        <div class="column">
    
          <div class="card">
            <div class="card-header has-background-primary-dark">
              <p class="has-text-white has-text-weight-bold is-size-3 pl-2">New Project</p>
            </div>
            <div class="card-content" style="margin: 0 auto">
              <figure @click="updateShowModal(true)" class="image is-64x64" style="margin: 0 auto">
                <img src="/Icons/Add.png" alt="edit">
              </figure>
            </div>
          </div>

        </div>
      </div>
    </div>
    <project-modal  :title="'New project'" 
                    :name="''" 
                    :number="''"
                    :show="this.showModal" 
                    @closeRequest="updateShowModal(false)"
                    @newProjValues="addNew($event)">

    </project-modal>
  </div>
</template>


<script>
  import JetNavLink from '@/Jetstream/NavLink'
  import ProjectModal from './ProjectModal.vue';

  export default {
    props: ['projects'],

    components:{
      JetNavLink,
      ProjectModal
    },

    data() {
      return {
        projectsList : this.projects,
        showModal : false
      }
    },

    methods: {
      updateShowModal(newValue){
        this.showModal = newValue;
      },

      addNew(data){
        axios.post('/projects', {
        name : data.name, number : data.number 
        })
        .then(response => {
              if (response.status === 200) {
                this.projectsList = response.data.newProj;
              } 
            this.updateShowModal(false);
        })
        .catch(error => {
          console.log(error);
          this.updateShowModal(false);
          });
      },
    }
  }

</script>
