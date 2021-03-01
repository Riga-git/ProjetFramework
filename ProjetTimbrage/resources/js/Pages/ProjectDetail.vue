<template>
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
        projectDetail : this.project
      }
    },
  }

</script>
