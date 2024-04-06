<script setup>
    import { ref, defineEmits, nextTick } from 'vue';
    const emit  = defineEmits(['update:modelValue']); 
    const props = defineProps({
        text: String,
        name: String,
        items: {
            type: Array,
            default: () => []
        },
        url: {
            type: String,
            default: '',
        },

        value: {
            type: String,
            default: '',
        },

        modelValue: {
            required: true,
        },
    });

    const id = props.name ? props.name.split('_').join('-'):'';
    let itemsProps = props.items;

    const matchedItems = ref([]),
          selected = ref(0);

    const gettingItems = async(url) => {
        const fetchedItems = await fetch(url);
        const response = fetchedItems.json();
        return response;
    };

    
    const handleSearch = async(ev) => {
        emit('update:modelValue', ev.target.value);
        await nextTick();
        if (props.modelValue) {
            const regex = new RegExp(`.*${props.modelValue}.*`);
            if (!props.url.length) {
                matchedItems.value = itemsProps.filter(item => regex.test(item));
            } else {
                itemsProps = await gettingItems(`${props.url}/${props.modelValue}`);
                console.log(itemsProps);
                matchedItems.value = itemsProps.filter(item => regex.test(item));
            }
        } else {
            matchedItems.value = [];
            selected.value = 0;
        }
    };

    const handleClick = (ev) => {
        matchedItems.value = [];
        selected.value = 0;
        emit('update:modelValue', ev.target.innerText);
    };

    const selectByHover = (ev) => {
        const target = ev.target;
        target.classList.add('selected');
    },

    diselectByLeave = (ev) => {
        const target = ev.target;
        target.classList.remove('selected');
    },

    increaseDecreaseSelected = (ev) => {
        if (ev.keyCode === 40 && selected.value < matchedItems.value.length - 1 && props.modelValue.value.length > 0) {
            selected.value = selected.value + 1;
        } else if (ev.keyCode === 38 && selected.value > 0 && props.modelValue.value.length > 0) {
            selected.value = selected.value - 1;
        } else if (ev.keyCode === 13 && selected.value >= 0 && selected.value < matchedItems.value.length && props.modelValue.value.length > 0) {
            matchedItems.value = [];
            selected.value = 0;
            emit('update:ModelValue', matchedItems.value[selected.value]);
        }
    };
</script>
<template>
    <label :for="id">{{ text }}</label>
    <input 
        type="text"
        :name="name"
        :id="id"
        class="form-control"
        @input="handleSearch"
        @keydown="increaseDecreaseSelected"
        :placeholder="text"
        :value="props.modelValue">
    <ul 
        v-if="matchedItems"
        class="options">
        <li 
            v-for="(item, index) in matchedItems"
            @click="handleClick"
            @mouseenter="selectByHover"
            @mouseleave="diselectByLeave"
            :class="{selected: index === selected}"
            :key="index">
            {{ item }}
        </li>
    </ul>
</template>
<style>
    .options {
        list-style: none;
        padding-left: 0;
    }

    .options li {
        padding: 0.25rem 0.5rem;
        border: 1px solid #f1f1f1;
        font-size: 1.25rem;
    }

    .options li.selected {
        background-color: rgb(64, 78, 209);
        color:white;
    }
</style>