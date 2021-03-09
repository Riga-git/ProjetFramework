<template>
    <div class="container">
        <!-- Global Card -->
        <div class="card">
            <div class="card-header has-background-primary-dark">
                <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ department[0].name}}
                    <span v-if="editionMode" @click="showModalDepartmentName()" class="icon has-text-white ml-2"><em class="fas fa-edit"></em></span>
                </p>
            </div>
            <div class="card-content">
                <!-- Team leader section -->
                <div class="box">
                    <p class="is-size-4 has-text-weight-semibold mb-2">Chef de département</p>
                    <article class="media is-align-items-center" v-if="department[0].leader.length > 0">
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
                        <div v-if="editionMode" class="media-right" @click="removeLeader()">
                        <span class="icon has-text-danger-dark">
                            <em class="fas fa-trash-alt"></em>
                        </span>
                        </div>
                    </article>
                    <div v-if="department[0].leader.length == 0 && editionMode">
                        <figure class="image is-48x48" style="margin: 0 auto" @click="showModalNewLeader()">
                            <img src="/Icons/Add.png" alt="edit">
                        </figure>
                    </div>
                </div>

                <!-- Members list -->
                <user-list :title="department[0].members.length + ' Membres'"
                            :content="department[0].members" :editable="editionMode"
                            @member-deleted="removeMember($event)"
                            @member-add="showModalNewMember()">
                </user-list>
            </div>

            <!-- Footer -->
            <div class="card-footer">
                <div class="card-footer-item">
                    <div @click="updateEditionMode(true)"  class="box">
                        <figure class="image is-32x32">
                            <img src="/Icons/Edit.png" alt="edit">
                        </figure>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal leader -->
        <div v-bind:class="{'is-active': showModalNewLeaderStatus}" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edition Département</p>
                    <button class="delete" aria-label="close" @click="closeModalNewLeader()"></button>
                </header>
                <div class="modal-card-body">
                    <user-list :title="'Sélection nouveau leader'"
                                :content="allUsers"
                                @member-selected="addLeader($event)">
                    </user-list>
                </div>
            </div>
        </div>

        <!-- Modal department name -->
        <div v-bind:class="{'is-active': showModalDepartmentNameStatus}" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edition Département</p>
                    <button class="delete" aria-label="close" @click="closeModalDepartmentName()"></button>
                </header>
                <section class="modal-card-body">
                    <div class="block">
                        <input v-model="department[0].name" class="input" type="text" placeholder="Nouveau nom du département">
                        <p v-if="errorInDepartmentNameForm" class="notification is-danger is-light">Le nom du départment n'est pas correct</p>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <div class="card-footer-item">
                        <div @click="saveDepartmentName()" class="box">
                            <figure class="image is-32x32">
                                <img src="/Icons/Save.png" alt="edit">
                            </figure>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Modal new member -->
        <div v-bind:class="{'is-active': showModalNewMemberStatus}" class="modal">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edition Département</p>
                    <button class="delete" aria-label="close" @click="closeModalNewMember()"></button>
                </header>
                <section class="modal-card-body">
                    <user-list :title="'Sélection nouveau membre'"
                                :content="userWithoutDepartment"
                                @member-selected="addMember($event)">
                    </user-list>
                </section>
            </div>
        </div>
    </div>
</template>

<script>
import UserList from "../../Components/UserList.vue"


export default{
    components: {
        UserList,
    },

    props: [
        'departmentDetail',
    ],

    data() {
        return {
            department : this.departmentDetail,
            editionMode : false,
            showModalNewLeaderStatus : false,
            showModalDepartmentNameStatus : false,
            showModalNewMemberStatus : false,
            allUsers : [],
            userWithoutDepartment : [],
            errorInDepartmentNameForm : false,
        }
    },

    methods: {
        updateEditionMode(newValue){
            this.editionMode = newValue;
        },

        removeMember(selected){
            axios.patch('/users/' + selected.id, {'department_id' : null})
                .then(response => this.department[0].members = response.data)
                .catch(error => console.log(error));
        },

        removeLeader(){
            axios.patch('/departments/' + this.department[0].id, {'leader' : null})
                .then(response => this.department = response.data)
                .catch(error => console.log(error));
        },

        showModalNewLeader(){
            this.getAllUsers();
            this.showModalNewLeaderStatus = true;
        },

        closeModalNewLeader(){
            this.showModalNewLeaderStatus = false;
        },

        showModalDepartmentName(){
            this.showModalDepartmentNameStatus = true;
        },

        closeModalDepartmentName(){
            this.showModalDepartmentNameStatus = false;
        },

        showModalNewMember(){
            this.getUsersWithoutDepartment();
            this.showModalNewMemberStatus = true;
        },

        closeModalNewMember(){
            this.showModalNewMemberStatus = false;
        },

        getAllUsers(){
            axios.get('/users' + '?option=all')
                .then(response => this.allUsers = response.data)
                .catch(error => console.log(error));
        },

        getUsersWithoutDepartment(){
            axios.get('/users' + '?option=without-department')
                .then(response => this.userWithoutDepartment = response.data)
                .catch(error => console.log(error));
        },

        addLeader(selected){
            axios.patch('/departments/' + this.department[0].id, {'leader' : selected.id})
                .then(response => { this.closeModalNewLeader();
                                    this.department = response.data;
                                  })
                .catch(error => console.log(error));
        },

        addMember(selected){
            axios.patch('/users/' + selected.id, {'department_id' : this.department[0].id})
                .then(response => { this.closeModalNewMember();
                                    //this.department[0].members.push(response.data[0]);
                                    this.department[0].members = response.data;
                                  })
                .catch(error => console.log(error));
        },

        saveDepartmentName(){
            let trimmedName = this.department[0].name.trim();
            if (trimmedName.length > 0){
                axios.patch('/departments/' + this.department[0].id, {'name' : trimmedName})
                    .then(response => { this.closeModalDepartmentName();
                                        this.department = response.data;
                                    })
                    .catch(error => console.log(error));
            } else {
                this.errorInDepartmentNameForm = true;
            }
        }
    },
}
</script>

<style>

</style>
