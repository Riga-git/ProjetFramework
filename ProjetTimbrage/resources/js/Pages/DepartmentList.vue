<template>

  <div class="container">
    <div class="columns is-multiline">
      <div v-for="department in this.departmentList" v-bind:key="department.object" class="column">
          <inertia-link :href="'departments/' + department.id" :active=false>
            <div class="card">
              <div class="card-header has-background-primary-dark">
                <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ department.name }}</p>
              </div>
              <div class="card-content">
                <p><span class="icon has-text-primary-dark"><em class="fas fa-user-tie"></em></span> {{ department.leader[0].firstName }} {{department.leader[0].lastName}} </p>
                <p><span class="icon has-text-primary-dark"><em class="fas fa-users"></em></span> {{ department.memberNbre }}</p>
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
    props: ['departments'],

    components:{
      JetNavLink
    },

    data() {
      return {
        departmentList : this.departments
      }
    },
  }

</script>
