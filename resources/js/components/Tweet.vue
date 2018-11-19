<template>
    <a :href="`https://twitter.com/lebatbot/status/${this.twitter_id}`" class="no-underline">
        <div class="border border-grey-dark rounded p-3 mt-3 text-grey-lighter">
            {{ this.word }}
            <br>
            <small>{{ moment(this.created_at).fromNow() }}</small>
        </div>
    </a>
</template>

<script>
    import moment from 'moment';

    export default {
        name: 'Tweet',
        props: ['twitter_id', 'word', 'created_at'],
        data() {
            return { moment };
        }
    };
</script>

<style scoped>
    a div {

        transition: 250ms ease;
    }
    a div:hover {
        @apply bg-grey-darkest;
    }
</style>
