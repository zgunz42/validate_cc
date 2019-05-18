<template>
    <ul class="list-reset">
        <li v-for="card in cards" :key="card.id" class="py-2 border-b">
            <card-item :card="card"></card-item>
        </li>
    </ul>
</template>
<script>
    import {mapState} from 'vuex';
    import CardItem from './CardItem';

    export default {
        components: {CardItem},
        computed: mapState(['cards']),
        mounted() {
            this.$store.dispatch('fetchCards');
        },
    }
</script>
