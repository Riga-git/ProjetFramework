<template>
    <div class="container">
        <div class="columns is-multiline">

            <!-- Departments list -->
            <div v-for="department in this.departmentList" v-bind:key="department.object" class="column is-one-quarter">
                <inertia-link :href="'departments/' + department.id" :active=false>
                    <div class="card">
                        <div class="card-header has-background-primary-dark">
                            <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ department.name }}</p>
                        </div>
                        <div class="card-content">
                            <p><span class="icon has-text-primary-dark"><em class="fas fa-user-tie"></em></span> <span v-if="department.leader.length > 0">{{ department.leader[0].firstName }} {{department.leader[0].lastName}}</span> </p>
                            <p><span class="icon has-text-primary-dark"><em class="fas fa-users"></em></span> {{ department.memberNbre }}</p>
                        </div>
                    </div>
                </inertia-link>
            </div>

            <!-- New department card -->
            <div class="column is-one-quarter">
                <div class="card">
                    <div class="card-header has-background-primary-dark">
                        <p class="has-text-white has-text-weight-bold is-size-3 pl-2">Nouveau</p>
                    </div>
                    <div class="card-content">
                        <figure class="image is-48x48" style="margin: 0 auto" @click="showModalNewDepartment()">
                            <img src="/Icons/Add.png" alt="edit">
                        </figure>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal department name -->
        <div v-bind:class="{'is-active': showModalDepartmentNameStatus}" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Nouveau Département</p>
                    <button class="delete" aria-label="close" @click="closeModalNewDepartment()"></button>
                </header>
                <section class="modal-card-body">
                    <div class="block">
                        <input v-model="emptyDepartment.name" class="input" type="text" placeholder="Nom du nouveau département">
                        <p v-if="errorInDepartmentNameForm" class="notification is-danger is-light">Le nom du départment n'est pas correct</p>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <div class="card-footer-item">
                        <div @click="saveNewDepartment()" class="box">
                            <figure class="image is-32x32">
                                <img src="/Icons/Save.png" alt="edit">
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
    props: ['departments'],

    components:{
      JetNavLink
    },

    data() {
      return {
        departmentList : this.departments,
        showModalDepartmentNameStatus :false,
        emptyDepartment : {'name' : ""},
        errorInDepartmentNameForm : false,
      }
    },

    methods: {
        showModalNewDepartment(){
            this.showModalDepartmentNameStatus = true;
        },

        closeModalNewDepartment(){
            this.showModalDepartmentNameStatus = false;
        },

        saveNewDepartment(){
            let trimmedName = this.emptyDepartment.name.trim();
            if (trimmedName.length > 0){
                axios.post('/departments', {'name' : trimmedName})
                    .then(response => { this.closeModalNewDepartment();
                                        this.departmentList = response.data;
                                    })
                    .catch(error => console.log(error));
            } else {
                this.errorInDepartmentNameForm = true;
            }
        },

    }
  }

</script>
