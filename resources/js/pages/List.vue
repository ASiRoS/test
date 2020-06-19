<template>
    <div class="container">
        <ul class="list-group">
            <li v-for="message in messages" class="list-group-item">
                <router-link :to="{ name: 'Show', params: { id: message.id } }">{{ message.name }}</router-link>
            </li>
        </ul>
    </div>
</template>

<script>
    import MessageService from "../services/MessageService";

    export default {
        name: 'List',
        data() {
            return {
                messages: []
            }
        },
        created() {
            MessageService.fetchAll().then(response => {
                this.messages = response.data.data;
            });
        }
    }
</script>

<style scoped></style>
