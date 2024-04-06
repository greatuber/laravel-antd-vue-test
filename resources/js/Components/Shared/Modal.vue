<script setup>
    const props = defineProps({

        hasActionButon: {
            type: Boolean,
            default: false,
        },

        closeButtonText: {
            type: String,
            default: 'Cerrar',
        },

        closeButtonColor: {
            type: String,
            default: 'btn-secondary',
        },

        actionButtonText: {
            type: String,
            default: '',
        },

        actionButtonColor: {
            type: String,
            default: 'btn-primary',
        },

        actionButtonFunction: {
            type: Function,
            default: () => function () {}
        },

        size: {
            type: String,
            default: '',
        },

        target: String,

        title: String,

    });
</script>
<template>

    <!-- Modal -->
    <div 
        class="modal fade" 
        :id="target" 
        tabindex="-1" 
        aria-hidden="true">
        <div :class="['modal-dialog', size]">
            <div class="modal-content">
                <div class="modal-header">
                    <slot name="header"></slot>
                    <button 
                        type="button" 
                        class="btn-close" 
                        data-bs-dismiss="modal" 
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button 
                        type="button" 
                        :class="['btn', closeButtonColor]" 
                        data-bs-dismiss="modal">
                        {{ closeButtonText }}
                    </button>
                    <button 
                        v-if="hasActionButon"
                        type="button" 
                        :class="['btn', actionButtonColor]">
                        {{ actionButtonText }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>