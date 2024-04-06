<script setup>
    import { ref } from 'vue';
    defineProps({
        title: String,
    });
    const value = ref(null);
    const open = ref(false);
const showModal = () => {
  open.value = true;
};
const handleOk = e => {
  console.log(e);
  open.value = false;
};
</script>
<template>
    <h1>{{ title }}</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <p>Testing the grid</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <a-input v-model:value="value" placeholder="Basic usage" class="medium"/>
            </div>
        </div>
        <div>
            <a-button type="primary" @click="showModal">Open Modal</a-button>
            <a-modal 
                v-model:open="open" 
                title="Basic Modal" 
                @ok="handleOk"
                width="1900px">
                <p>Some contents...</p>
                <p>Some contents...</p>
                <p>Some contents...</p>
            </a-modal>
        </div>
    </div>
</template>
<style>
    .medium {
        width: 50%;
        padding: 7px 15px;
    }

    .large {
        width: 2250px;
    }
</style>
