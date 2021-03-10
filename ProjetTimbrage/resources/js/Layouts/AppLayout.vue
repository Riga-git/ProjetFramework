<template>
    <div>
        <nav class="navbar is-primary has-background-primary-dark" role="navigation" aria-label="main navigation">
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
                <a href="/clockings" class="navbar-item">
                    Clockings
                </a>
                <a href="/projects" class="navbar-item">
                    Projects
                </a>
                <a href="/departments" class="navbar-item">
                    Departments
                </a>
                <a href="/assignments" class="navbar-item">
                    Assignments
            </a>
            </div>

            <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                <a class="button is-primary">
                    <strong>Log-out</strong>
                </a>
                </div>
            </div>
            </div>
        </div>
        </nav>
        <slot></slot>
    </div>
</template>

<script>
    //import JetApplicationMark from '@/Jetstream/ApplicationMark'
    //import JetBanner from '@/Jetstream/Banner'
    //import JetDropdown from '@/Jetstream/Dropdown'
    //import JetDropdownLink from '@/Jetstream/DropdownLink'
    //import JetNavLink from '@/Jetstream/NavLink'
    //import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            //JetApplicationMark,
            //JetBanner,
            //JetDropdown,
            //JetDropdownLink,
            //JetNavLink,
            //JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
                sideNavActive : false,
            }
        },

        methods: {
            logout() {
                this.$inertia.post(route('logout'));
            },

            toggleNavBar(){
                this.sideNavActive = !this.sideNavActive;
            }
        }
    }
</script>