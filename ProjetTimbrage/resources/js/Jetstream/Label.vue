<template>
    <label class="is block has-text-weight-medium is-size-4 has-text-dark">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot></slot></span>
    </label>
</template>

<script>
    export default {
        props: ['value']
    }
</script>
