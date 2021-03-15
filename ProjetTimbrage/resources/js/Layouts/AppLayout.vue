<template>
    <div>
        <nav class="navbar is-primary has-background-primary-dark mb-5" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="/">
                    <img src="/Icons/logo.svg" width="112" height="28">
                </a>
                <a @click="toggleNavBar" v-bind:class="{'is-active': sideNavActive}" role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarJLT">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
        </div>

        <div id="navbarJLT" v-bind:class="{'is-active': sideNavActive}" class="navbar-menu">
            <div class="navbar-start">
                <a href="/clockings" v-bind:class="{'is-active': currentRoute.includes('/clockings')}" class="navbar-item">
                    Pointages
                </a>
                <a href="/projects" v-bind:class="{'is-active': currentRoute.includes('/projects')}" class="navbar-item">
                    Projets
                </a>
                <a href="/departments" v-bind:class="{'is-active': currentRoute.includes('/departments')}" class="navbar-item">
                    Departements 
                </a>
                <a href="/assignments" v-bind:class="{'is-active': currentRoute.includes('/assignments')}" class="navbar-item">
                    Assignations
            </a>
            </div>

            <div class="navbar-end">
            <div class="navbar-item">
                <form method="POST" @submit.prevent="logout">
                    <jet-responsive-nav-link as="button">
                        Logout
                    </jet-responsive-nav-link>
                </form>
            </div>
            </div>
        </div>
        </nav>
        <slot></slot>
    </div>
</template>

<script>
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
                sideNavActive : false,
                currentRoute : window.location.pathname
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },

            toggleNavBar(){
                this.sideNavActive = !this.sideNavActive;
            },
        }
    }
</script>