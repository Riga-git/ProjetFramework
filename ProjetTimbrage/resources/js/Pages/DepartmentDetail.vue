<template>
  <div class="container">
    <div class="card">
      <div class="card-header has-background-primary-dark">
        <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ department[0].name }}</p>
      </div>
      <div class="card-content">
        <div class="box">
          <p class="is-size-4 has-text-weight-semibold mb-2">Chef de département</p>
          <article class="media">
            <figure class="media-left">
              <p class="image is-64x64">
                <img class="is-rounded" :src="department[0].leader[0].profile_photo_url">
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
              <input class="input" type="text" placeholder="Search">
              <span class="icon is-left">
                <i class="fas fa-search" aria-hidden="true"></i>
              </span>
            </p>
          </div>
          <a class="panel-block is-active">
            <span class="panel-icon">
              <i class="fas fa-book" aria-hidden="true"></i>
            </span>
            À remplir avec la liste des membres (v-for), ajouter une petite poubelle à droite et virer le lien qui ne sert à rien
          </a>
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
      department : this.departmentDetail
    }
  }
}
</script>

<style>

</style>
