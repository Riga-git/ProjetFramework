<template>
  <div class="container">
    <div class="columns is-multiline">
      <div v-for="project in this.projectsList" v-bind:key="project.object" class="column">
          <inertia-link :href="'projects/' + project.id" :active=false>
            <div class="card">
              <div class="card-header has-background-primary-dark">
                <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ project.name }} - {{ project.number}}</p>
              </div>
              <div class="card-content">
                <p><span class="icon has-text-primary-dark"><em class="fas fa-clock"></em></span> {{ project.assignments[0]}}h</p>
              </div>
            </div>
          </inertia-link>
      </div>

    </div>
  </div>
</template>


<script>
  import JetNavLink from '@/Jetstream/NavLink'

  export default {
    props: ['projects'],

    components:{
      JetNavLink
    },

    data() {
      return {
        projectsList : this.projects
      }
    },
  }

</script>
