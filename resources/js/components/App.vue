<template>
    <div>
        <navbar class="mb-5"/>
        <div class="container">
            <router-view />
        </div>
    </div>
</template>

<script>
    import Navbar from "./Navbar";

    export default {
        name: 'App',
        components: {
            Navbar
        }
    }
</script>

<style scoped></style>
