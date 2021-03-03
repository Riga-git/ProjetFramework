<template>
<div>
  <div class="container">
    <div class="card">
      <div class="card-header has-background-primary-dark">
        <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ projectDetail[0].name }}</p>
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
          <div class="box">
              <figure class="image is-32x32">
                <img v-on:click="toggleEdit" src="/Icons/Edit.png" alt="edit">
              </figure>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div v-bind:class="{'is-active': editionMode}" class="modal">
    <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Edit project</p>
          <button v-on:click="toggleEdit" class="delete" aria-label="close"></button>
        </header>
        <section class="modal-card-body">
          <div class="block">
            <input v-model="name" class="input" type="text" placeholder="project name">
          </div>
          <div class="block">
            <input v-model="number" class="input" type="text" placeholder="project number">
          </div>
        </section>
        <footer class="modal-card-foot">
          <div class="card-footer-item">
            <div class="box">
                <figure class="image is-32x32">
                  <img v-on:click="updateProjectRequest" src="/Icons/Save.png" alt="edit">
                </figure>
            </div>
          </div>
        </footer>
      </div>
  </div>
</div>

</template>

<script>
  import JetNavLink from '@/Jetstream/NavLink'

  export default {
    props: ['project'],

    components:{
      JetNavLink
    },

    data() {
      return {
        projectDetail : this.project,
        name : '',
        number : '',
        editionMode : false
      }
    },

    methods: {

    toggleEdit() {
        this.editionMode = !this.editionMode;
    },

      updateProjectRequest() {
        let tmp = this.projectDetail;
        tmp[0].name = this.name;
        tmp[0].number = this.number;
        axios.patch('/projects/'+ this.projectDetail[0].id, {
            newValues : tmp
        })
        .then(response => {
          console.log(response);
            if (response.status === 200) {
                this.toggleEdit();
            }
        })
        .catch(error => console.log(error));
      }
    },
  }

</script>
