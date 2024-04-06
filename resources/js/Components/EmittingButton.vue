<script setup>
    const emit = defineEmits(['textHasNeedle']);
    const props = defineProps({
        text: String,
        element: {
            type: Object,
            default: () => {}
        }
    });
    const handleClick = (ev, needle) => {
        const button = ev.target;
        console.log(needle);
        if (button.innerText.includes(needle)) {
            props.element.classList.add('invisible');
            emit('textHasNeedle', needle);
        } else {    
            alert('Does not contains ' + needle);
        }
    };
</script>
<template>
    <button
        @click="(ev) => handleClick(ev, 'M')" 
        class="btn btn-primary">
        {{ text }}
    </button>
</template>