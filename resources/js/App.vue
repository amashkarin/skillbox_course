<template>
    <div>
        <MessagePanel :message="message" @onClose="closePanel"></MessagePanel>
    </div>
</template>

<script>
import MessagePanel from "./components/MessagePanel";

export default {
    components: {
        MessagePanel
    },
    data() {
        return {
            message: null
        }
    },
    methods: {
        setMessage(message) {
            this.message = message
        },

        closePanel() {
            this.message = null
        }
    }
}
</script>
