<template>
    <div class="container">
        <form @submit.prevent="post">
            <div class="form-group">
                <label for="name">Имя</label>
                <input v-model="message.name" class="form-control" type="text" id="name" required>
            </div>

            <div class="form-group">
                <label for="phone">Телефон</label>
                <input v-model="message.phone" class="form-control" type="text" id="phone" required>
            </div>

            <div class="form-group">
                <label for="content">Сообщение</label>
                <textarea v-model="message.content" class="form-control" id="content" cols="30" rows="10"
                          required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    import MessageService from "../services/MessageService";

    export default {
        data() {
            return {
                message: {
                    name: null,
                    phone: null,
                    content: null
                }
            }
        },
        methods: {
            post() {
                MessageService.post(this.message).then(() => {
                    this.$router.push('/');
                });
            }
        }
    };
</script>
