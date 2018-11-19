<template>
    <div id="app" class="flex items-stretch text-center leading-normal h-full w-full">
        <div class="flex flex-col container self-center max-w-md mx-auto px-4 h-full">
            <heading></heading>
            <div class="flex-1 mt-2">
                <form>
                    <input id="search" type="text"
                           placeholder="Rechercher un mot déjà tweeté ..."
                           class="rounded py-2 px-3 w-full bg-black text-grey-lighter border border-grey-dark leading-tight appearance-none"
                           v-model="word" @input="onInput">
                </form>
                <small v-if="state === 'none' || (state === 'success' && tweets.length === 0)">
                    Aucun résultat trouvé.
                </small>
                <tweet v-if="state === 'success'" v-for="tweet in tweets" :key="tweet.id" v-bind="tweet"></tweet>
                <spinner v-if="state === 'loading'"></spinner>
            </div>
            <foot></foot>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import debounce from 'debounce';

    import Heading from '../components/Heading';
    import Search from '../components/Search';
    import Tweet from '../components/Tweet';
    import Foot from '../components/Foot';
    import Spinner from '../components/Spinner';

    export default {
        name: 'Index',
        components: {
            Spinner,
            Heading,
            Search,
            Tweet,
            Foot
        },
        data() {
            return {
                tweets: [],
                word: '',
                state: 'loading'
            };
        },
        mounted() {
            this.search(this.word || null);
        },
        methods: {
            onInput() {
                this.state = 'loading';
                this.search(this.word || null);
            },
            search: debounce(function (word) {
                axios.get('/api/tweets', { params: { word } })
                    .then(response => {
                        this.tweets = response.data;
                    })
                    .catch(error => {
                        alert('Le serveur a rencontré une erreur inconnue.');
                        console.log(error.response);
                    })
                    .finally(() => this.state = 'success');
            }, 350)
        }
    };
</script>

<style scoped>
</style>
