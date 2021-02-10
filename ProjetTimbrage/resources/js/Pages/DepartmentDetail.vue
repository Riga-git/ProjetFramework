<template>

  <div>{{department}}</div>

</template>

<script>
export default {
  props: [
    'departmentDetail',
  ],

  data() {
    return {
      department : this.departmentDetail
    }
  }
}
</script>

<style>

</style>
