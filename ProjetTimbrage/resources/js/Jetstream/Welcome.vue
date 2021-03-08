<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <jet-application-logo class="block h-12 w-auto" />
            </div>
        </div>
        <div class="columns">
            <div class="column is-5 is-offset-1">
                <div class="is-flex is-justify-content-space-around is-align-items-center">
                    <div class="box">
                        <figure class="image is-64x64">
                            <img src="/Icons/ClockIn.png" alt="Clock In">
                        </figure>
                    </div>
                    <div class="box">
                        <figure class="image is-64x64">
                            <img src="/Icons/Clockings.png" alt="Clockings">
                        </figure>
                    </div>
                </div>
                <div class="is-flex is-justify-content-space-around is-align-items-center">
                    <div class="box">
                        <figure class="image is-64x64">
                            <img src="/Icons/Projects.png" alt="Projects">
                        </figure>
                    </div>
                    <div class="box">
                        <figure class="image is-64x64">
                            <img src="/Icons/Assignments.png" alt="Assignments">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="column is-5 is-offset-1">
                gdfgsdfh
            </div>
        </div>
</div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'

    export default {
        components: {
            JetApplicationLogo,
        },
    }
</script>
