<template>
  <div class="container">
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
