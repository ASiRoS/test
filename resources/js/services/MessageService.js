import api from "./api";

export default {
    fetchAll() {
        return api.get('/messages');
    },
    fetch(id) {
        return api.get('/messages/' + id);
    },
    post(message) {
        return api.post('/messages', message);
    }
};
