<script setup>
    const emit = defineEmits(['update:modelValue', 'custom-input']);
    const props = defineProps({
        modelValue: {
            required: true,
        },

        labelAlignment: {
            type: String,
            default: 'text-left'
        },

        classes: {
            type: Array,
            default: () => []
        },
        
        disabled: {
            type: Boolean,
            default: false
        },
        
        min: {
            type: String,
            default: null,
        },

        max: {
            type: String,
            default: null,
        },

        name: String,

        offset: {
            type: String,
            default: '',
        },

        size: {
            type: String,
            default: 'col-md-4',
        },

        step: {
            type: String,
            default: null,
        },

        text: String,

        type: {
            type: String,
            default: 'text',
        }

    });
    const id = props.name.split('_').join('-');
    const updateValue = (ev) => {
        emit('update:modelValue', ev.target.value);
        emit('custom-input');
    };
</script>
<template>
    <div :class="[...classes, size, offset]">
        <div :class="['mb-4', labelAlignment]">
            <label :for="id">
                {{ text }}
            </label>
            <input 
                :type="type"
                class="form-control"
                @input="updateValue"
                :name="name"
                :step="step"
                :min="min"
                :max="max"
                :id="id"
                :placeholder="text"
                :disabled="disabled">
        </div>
    </div>
</template>