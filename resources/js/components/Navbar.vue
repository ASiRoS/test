<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <router-link :to="{ name: 'Create' }" class="nav-link">Create</router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'List' }" class="nav-link">List</router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name: 'Navbar'
    }
</script>
