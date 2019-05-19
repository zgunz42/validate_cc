<template>
  <transition name="fade">
    <div class="flex flex-wrap justify-center items-center">
      <div class="mr-4 relative h-16 w-16">
        <svg class="icon w-full icon-visa border rounded-lg p-2">
          <use :xlink:href="card.provider['iconUrl']"></use>
        </svg>
        <div
          v-if="!card.valid"
          class="absolute bottom-0 right-0 w-6 h-6 inline text-white bg-red-400 p-1 rounded-full flex items-center justify-center">
          <svg class="icon icon-xs icon-cross align-middle">
            <use xlink:href="/images/symbol-defs.svg#icon-cross"></use>
          </svg>
        </div>
        <div
          v-else
          class="absolute bottom-0 right-0 w-6 h-6 inline text-white bg-green-400 p-1 rounded-full flex items-center justify-center">
          <svg class="icon icon-xs icon-checkmark align-middle">
            <use xlink:href="/images/symbol-defs.svg#icon-checkmark"></use>
          </svg>
        </div>
      </div>
      <div class="flex-1">
        <h4 class="card-name mb-2 font-bold tracking-wide">{{card.provider.name }}
        </h4>
        <p class="card-number tracking-wider">{{ displayNumber }}</p>
      </div>
      <div class="w-full pt-1 text-right md:w-2/6 md:pt-0">
        <div class="inline-flex">
          <button @click="edit(card.id)" class="bg-blue-600 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded-l">
            Edit
          </button>
          <button @click="remove(card.id)" class="bg-red-600 hover:bg-red-400 text-white font-bold py-2 px-4 rounded-r">
            Delete
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
  export default {
    props: {
      card: {
        type: Object,
        default: {}
      },
    },
    computed: {
      displayNumber() {
        return this.card.cardNumber.replace(/(.{4})/g, '$1 ')
      }
    },
    methods: {
      edit(cardId) {
        this.$store.dispatch('editCard', {cardId: cardId});
      },
      remove(cardId) {
        this.$store.dispatch('destroyCard', {id: cardId});
      },
    }
  }
</script>
