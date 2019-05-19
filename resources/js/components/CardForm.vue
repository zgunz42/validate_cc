<template>
  <form id="check-cc" class="px-8 pt-6 pb-8" action="#cards" @submit.prevent="submitCard">
    <modal name="dialog">
      hello, world!
    </modal>
    <div class="mb-4">
      <label
        for="holder"
        class="block text-gray-600 text-sm font-bold mb-2 uppercase"
      >Holder Name</label
      >
      <input
        class="appearance-none w-full border-b text-gery-dark py-2"
        name="cardholder"
        v-model="cardForm.data.cardholder"
        id="holder"
        placeholder="name place on card"
        type="text"
      />
    </div>
    <div class="mb-4">
      <label
        for="card"
        class="block text-gray-600 text-sm font-bold mb-2 uppercase"
      >Card number</label
      >
      <the-mask
        mask="#### #### #### ####"
        v-model="cardForm.data.cardNumber"
        placeholder="16 digit number"
        class="appearance-none w-full border-b text-grey-dark py-2"
        id="card"
        name="card_number"
        type="text"
      ></the-mask>
    </div>
    <div class="mb-4 flex justify-between">
      <div class="text-left pl-2">
        <div class="relative">
          <label
            for="expires_in"
            class="block text-gray-600 text-sm font-bold mb-2 uppercase"
          >Expiration Date</label
          >
          <div class="flex items-center">
            <div class="mr-2">
              <the-mask
                mask="##/####"
                :masked="true"
                placeholder="mm/yyyy"
                v-model="cardForm.data.expiresIn"
                class="appearance-none border-b text-grey-dark text-gery-dark py-2"
                id="expires_in"
                type="text"
                size="5"
              ></the-mask>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center pr-2">
        <div class="relative">
          <label
            for="cvc"
            class="block text-gray-600 text-sm font-bold mb-2 uppercase"
          >cvc
            <svg class="icon icon-sm icon-question hover:text-blue fill-current">
              <use xlink:href="/images/symbol-defs.svg#icon-question"></use>
            </svg>
          </label
          >
          <input
            id="cvc"
            type="password"
            name="cvc"
            v-model="cardForm.data.cvc"
            class="border-b appearance-none text-gray-600 bg-white py-2 inline pl-2"
            maxLength="3"
            size="1"
          />
        </div>
      </div>
    </div>
    <div class="flex item-center justify-center mt-8">
      <button
        :disabled="isSubmit"
        class="w-2/3 shadow bg-blue-600 hover:bg-blue-400 focus:shadow-outline font-bold text-white px-2 py-3 rounded"
      >{{ buttonLabel }}
      </button>
    </div>
  </form>

</template>

<script>
  import { mapState } from 'vuex';
  import {TheMask} from 'vue-the-mask';
  import debounce from 'lodash/debounce';
  import client from '../api/client';
  const identifyCard = debounce(async (cardNumber, callback) =>{
    try {
      let cardInfo = await client.get(`identify?card_number=${cardNumber}`);
      callback(cardInfo.data);
    }catch ({response}) {
      callback(response.data);
    }
  }, 1000);

  export default {
    data() {
      return {
        cardStatus: '',
        isSubmit: false
      }
    },
    watch: {
      'cardForm.data.cardNumber': function (number) {
        identifyCard(number, (messages) => {
          this.cardStatus = messages;
        });
      },
    },
    components: {TheMask},
    computed: {
      ...mapState(['cardForm']),
      buttonLabel() {
        if (this.isSubmit) {
          return 'Please Wait'
        }
        if (this.cardForm.isEditing) {
          return 'Update Card';
        }else {
          return 'Check Card';
        }
      },
    },
    methods: {
      async submitCard() {
        this.isSubmit = true;
        if (this.cardForm.isEditing) {
          await this.$store.dispatch('updateCard');
        }else {
          await this.$store.dispatch('addCard');

        }
        this.isSubmit = false;
      }
    }
  }
</script>
