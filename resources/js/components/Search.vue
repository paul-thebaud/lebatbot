<template>
</template>

<script>
    import debounce from 'debounce';

    export default {
        name: 'Search',
        data() {
            return { word: '' };
        },
        methods: {
            onInput: debounce(function () {
                console.log(this.word);
            }, 450)
        }
    };
</script>

<style scoped>
    input {
    }
</style>
