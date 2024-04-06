<script setup>
    const props = defineProps({
        btnStyle: {
            type: Boolean,
            default: true,
        },

        btnColor: {
            type: String,
            default: 'btn-success'
        },

        btnText: {
            type: String,
            required: true,
        },

        target: {
            type: String,
            required: true,
        },
    })
</script>
<template>
    <button 
        v-if="btnStyle"
        type="button" 
        :class="['btn', btnColor]" 
        data-bs-toggle="modal" 
        :data-bs-target="`#${target}`">
        {{ btnText }}
    </button>

    <a
        v-else
        data-bs-toggle="modal"
        :data-bs-target="`#${target}`">
        {{ btnText }}
    </a>
</template>