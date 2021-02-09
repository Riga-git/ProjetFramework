<template>

  <div class="container mx-auto grid grid-flow-row">
    <div v-for="department in this.departmentList" v-bind:key="department.id">
      {{ department.name }}
    </div>
    <a class="button is-success">Success</a>

  </div>
</template>

<script>
  export default {
    props: ['departments'],

    data() {
      return {
        departmentList : this.departments
      }
    }

  }

</script>
