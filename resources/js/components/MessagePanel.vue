<template>
    <div v-if="message" class="message-panel">
        <div class="container">
            <div class="message" v-html="message"></div>
        </div>
        <span class="close-btn" @click.prevent="onClose">&cross;</span>
    </div>
</template>

<script>
export default {
    props: {
        message: String
    },
    data() {
        return {
        }
    },
    methods: {
        onClose(){
            this.$emit('onClose')
        }
    }
}
</script>

<style lang="scss">
.message-panel {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    min-height: 1em;
    background-color: darkblue;
    color: #fff;
    z-index: 10;

    .message{
        padding: 10px 0;
    }
    .close-btn{
        position: absolute;
        padding: 10px;
        top: 0;
        right: 0;
        cursor: pointer;
        z-index: 11;
    }
}
</style>
