<template>
    <div class="card">
        <div class="card-header">
            {{ message.name }}
        </div>
        <div class="card-body">
            <p class="card-text">{{ message.phone }}</p>
            <p class="card-text">{{ message.content }}</p>
        </div>
    </div>
</template>

<script>
    import MessageService from "../services/MessageService";

    export default {
        name: 'Show',
        data() {
            return {
                message: {
                    name: null,
                    phone: null,
                    content: null
                }
            }
        },
        created() {
            MessageService.fetch(this.id).then(response => {
                this.message = response.data.data;
                console.log(this.message);
            });
        },
        computed: {
            id() {
                return this.$route.params.id;
            }
        }
    }
</script>

<style scoped></style>
