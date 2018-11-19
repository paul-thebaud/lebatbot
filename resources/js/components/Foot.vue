<template>
    <div class="mt-3 mb-3">
        <small>
            <a href="https://github.com/paul-thebaud" target="_blank">Paul Thébaud</a>
            &copy; {{ (new Date()).getFullYear() }}
        </small>
        <br/>
        <small>
            Cette application est hébergée par
            <a href="https://heroku.com/home" target="_blank">Heroku</a>.
        </small>
    </div>
</template>

<script>
    export default {
        name: 'Footer'
    };
</script>

<style scoped>
    a {
        @apply text-grey-lighter;
    }
</style>
