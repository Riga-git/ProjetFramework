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

                <user-list :title="department[0].members.length + ' Membres'"
                            :content="department[0].members" :editable="editMode"
                            @member-deleted="alertDeleted($event)">
                </user-list>

            </div>
        </div>
    </div>
</template>

<script>
import UserList from "../Jetstream/UserList.vue"

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
            editMode : true
        }
    },

    methods: {

        alertDeleted(id){
            window.alert('Id N° ' + id + ' supprimé');
        }

    },
}
</script>

<style>

</style>
