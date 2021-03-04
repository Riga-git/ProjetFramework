<template>
  <div class="container">
    <div class="card">
      <div class="card-header has-background-primary-dark">
        <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ department[0].name }}</p>
      </div>
      <div class="card-content">
        <div class="box">
          <p class="is-size-4 has-text-weight-semibold mb-2">Chef de département</p>
          <article class="media is-align-items-center">
            <figure class="media-left">
              <p class="image is-64x64">
                <img class="is-rounded" :src="department[0].leader[0].profile_photo_url" alt="Profile photo leader">
              </p>
            </figure>
            <div class="media-content">
              <div class="content">
                <p>
                  <strong> {{ department[0].leader[0].firstName }} {{department[0].leader[0].lastName}}</strong>
                  <br>
                  <a :href="'mailto:' + department[0].leader[0].email"> {{ department[0].leader[0].email }} </a>
                </p>
              </div>
            </div>
            <div class="media-right">
              <span class="icon has-text-danger-dark">
                <em class="fas fa-trash-alt"></em>
              </span>
            </div>
          </article>
        </div>

        <nav class="panel">
          <p class="panel-heading">
            {{ department[0].members.length}} Membres
          </p>
          <div class="panel-block">
            <p class="control has-icons-left">
              <input class="input" type="text" v-model="searchQ" placeholder="Search">
              <span class="icon is-left">
                <i class="fas fa-search" aria-hidden="true"></i>
              </span>
            </p>
          </div>
          <div style="  max-height: 2em; overflow: auto;">
            <div v-for="member in getFilteredMembers" v-bind:key="member.id" class="panel-block is-align-items-center">
              <div class="media mb-0">
                <figure class="media-left">
                  <p class="image is-48x48">
                    <img class="is-rounded" :src="member.profile_photo_url" alt="Profile photo member">
                  </p>
                </figure>
              </div>
              <div class="media-content">
                <div class="content">
                  <p>
                    <strong> {{ member.firstName }} {{member.lastName}}</strong>
                    <br>
                    <a :href="'mailto:' + member.email"> {{ member.email }} </a>
                  </p>
                </div>
              </div>
              <div class="media-right">
                <span class="icon has-text-danger-dark">
                  <em class="fas fa-trash-alt"></em>
                </span>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    'departmentDetail',
  ],

  data() {
    return {
      department : this.departmentDetail,
      searchQ :''
    }
  },

  computed: {
    getFilteredMembers(){
      return this.department[0].members.filter(member => {
        return  member.firstName.toLowerCase().includes(this.searchQ.toLowerCase()) ||
                member.lastName.toLowerCase().includes(this.searchQ.toLowerCase()) ||
                member.email.toLowerCase().includes(this.searchQ.toLowerCase());
      });
    }
  }

}
</script>

<style>

</style>
