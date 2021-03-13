<template>
    <app-layout>
        <template #header>
        </template>
    <div class="container mt-5">
        <div class="columns is-2 ">
            <div class="column is-half is-justify-content-space-around is-align-items-center">
                <div class="box">
                    <div class="columns is-centered">
                        <div class="column is-half">
                            <figure class="image is-64x64" style="margin:auto">
                                <img class="block" src="/Icons/ClockIn.png" alt="Clock In">
                            </figure>
                        </div>
                        <div class="column is-half">
                            <figure class="image is-64x64" style="margin:auto">
                                <img class="block" src="/Icons/Clockings.png" alt="Clockings">
                            </figure>
                        </div>
                    </div>
                    <div class="columns is-justify-content-space-around is-align-items-center">
                        <div class="column is-half">
                            <figure class="image is-64x64" style="margin:auto">
                                <img src="/Icons/Projects.png" alt="Clock In">
                            </figure>
                        </div>
                        <div class="column is-half">
                            <figure class="image is-64x64" style="margin:auto">
                                <img src="/Icons/Assignments.png" alt="Clockings">
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-half">
                <div class="box">
                  <current-clockings :date="''"></current-clockings>
                </div>
            </div>
        </div>
    </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CurrentClockings from '@/Components/CurrentClockings'

    export default {
        components: {
            AppLayout,
            CurrentClockings
        },

    
    }
</script>
