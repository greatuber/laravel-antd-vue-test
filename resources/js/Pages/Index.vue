<script setup>
import axios from 'axios';
import { ref, h } from 'vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
        title: String,
        ordersProp: {
            type: Object,
            default: {},
        },
        pageProp: {
            type: Number,
            default: 1,
        },
        totalOrdersProp: Number,
    });
const current = ref(props.pageProp);
const pageSize = ref(40);
const orders = ref(props.ordersProp.data);

const onShowSizeChange = (current, size) => {
    pageSize.value = size;
}

const onChange = async(page, pageSize) =>{
    orders.value = (await axios.get(`/orders-paginated?page=${page}&pageSize=${pageSize}`)).data;
    current.value = page;
}
</script>
<template>
    <a-row class="header">
        <a-col :md="{ span: 24 }">
            <a-row>
                <a-col :md="{span:10, offset: 2}">
                    <h1 :style="{fontSize: '1.4rem'}">Laboratorios de analisis del guadiana</h1>
                </a-col>
            </a-row>
        </a-col>
    </a-row>
    
</template>
<style>
    .medium {
        width: 50%;
        padding: 7px 15px;
    }

    .item {
        width: 32px;
        height: 32px; 
        background-color: brown;
    }

    .large {
        width: 2250px;
    }

    .header {
        background-color: firebrick;
        padding: 0.375rem 0.5rem;
    }
</style>
