<template>
    <button :type="type" class="is-inline-flex  px-4 py-2 button is-primary is-dark">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
