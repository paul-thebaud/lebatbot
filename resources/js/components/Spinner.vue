<template>
    <div class="spinner-container">
        <div class="spinner">
            <span class="spinner-inner"></span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Spinner"
    };
</script>

<style scoped>
    .spinner-container {
        @apply mt-3;
    }

    .spinner {
        @apply inline-block text-grey-dark;
        display: inline-block;
        border-radius: 0.5rem;
        width: 30px;
        height: 30px;
        position: relative;
        border: 4px solid;
        top: 50%;
        animation: spinner 3s infinite ease;
    }

    .spinner-inner {
        @apply bg-grey-dark;
        vertical-align: top;
        display: inline-block;
        width: 100%;
        animation: spinner-inner 3s infinite ease-in;
    }

    @keyframes spinner {
        0% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(180deg);
        }

        50% {
            transform: rotate(180deg);
        }

        75% {
            transform: rotate(360deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes spinner-inner {
        0% {
            height: 0%;
        }

        25% {
            height: 0%;
        }

        50% {
            height: 100%;
        }

        75% {
            height: 100%;
        }

        100% {
            height: 0%;
        }
    }
</style>
