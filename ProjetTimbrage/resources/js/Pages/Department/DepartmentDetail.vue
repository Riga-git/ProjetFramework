<template>
    <div class="container">
        <!-- Global Card -->
        <div class="card">
            <div class="card-header has-background-primary-dark">
                <p class="has-text-white has-text-weight-bold is-size-3 pl-2">{{ department[0].name }}</p>
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
                        <div class="media-right" @click="removeLeader()">
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

                <!-- Members section -->
                <user-list :title="department[0].members.length + ' Membres'"
                            :content="department[0].members" :editable="editionMode"
                            @member-deleted="removeMember($event)">
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
                    <p class="modal-card-title">Edition</p>
                    <button class="delete" aria-label="close"></button>
                </header>

                <div class="modal-card-body">
                    <user-list :title="'Sélection nouveau leader'"
                                :content="allUsers"
                                @member-selected="addLeader($event)">
                    </user-list>
                </div>
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
            allUsers : [],
        }
    },

    methods: {
        updateEditionMode(newValue){
            this.editionMode = newValue;
        },

        removeMember(member){
            //axios.put()
        },

        removeLeader(){
            axios.patch('/departments/' + this.department[0].id, {'leader' : null})
                    .then(response => console.log(response))
                    .catch(error => console.log(error));
        },

        showModalNewLeader(){
            this.getAllUsers();
            this.showModalNewLeaderStatus = true;
        },

        getAllUsers(){
            axios.get('/users/allusers')
                .then(response => this.allUsers = response.data)
                .catch(error => console.log(error));
        },

        addLeader(selected){
            axios.patch('/departments/' + this.department[0].id, {'leader' : selected.id})
                .then(response => {console.log(response);
                                    this.showModalNewLeaderStatus = false;
                                    this.department = response.data;
                                    })
                .catch(error => console.log(error));
        },
    },
}
</script>

<style>

</style>
