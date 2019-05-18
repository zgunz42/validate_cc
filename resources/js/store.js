import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const state = {
  cards: [],
  cardForm: {
    targetId: null,
    data: {
      cardholder: '',
      cardNumber: '',
      expiresIn: '',
      cvc: '',
    },
    isSubmit: false,
    isEditing: false,
  }
};
const getters = {
  cards: state => state.cards
};
const mutations = {
  FETCH_CARDS(state, {cards}) {
    state.cards = cards;
  },
  ADD_CARD(state, {card}) {
    // join card into cards state
    state.cards = [card, ...state.cards];
  },
  DESTROY_CARD(state, {id}) {
    state.cards = _.remove(state.cards, (card) => card.id !== id);
  },
  UPDATE_CARD({cards}, {id, data}) {
    let index = _.findIndex(cards, {id: id});
    cards.splice(index, 1, data);
  },
  CLEAR_FORM(state) {
    state.cardForm.isEditing = false;
    state.cardForm.isSubmit = false;
    state.cardForm.data = {
      cardholder: '',
      cardNumber: '',
      expiresIn: '',
      cvc: '',
    };
    state.cardForm.targetId = null;
  },
  EDIT_CARD(state, {cardId}) {
    let card = _.find(state.cards, (card) => card.id === cardId);
    let expiresDate = new Date(card.expires_in * 1000);
    let expiresMonth = ("0" + (expiresDate.getMonth() + 1)).slice(-2);
    let expiresYear = expiresDate.getFullYear();
    state.cardForm.targetId = cardId;
    state.cardForm.isEditing = true;
    state.cardForm.data = {
      cardholder: card.holder,
      cardNumber: card.cardNumber,
      expiresIn: `${expiresMonth}/${expiresYear}`,
      cvc: '',
    }
  }
};
const actions = {
  editCard({commit, state}, {cardId}) {
    let {isSubmit} = state.cardForm;
    if(!isSubmit) {
      commit('EDIT_CARD', {cardId});
    }
  },
  async fetchCards({commit, state}) {
    try {
      let cards = [];
      let response = await axios.get('cards');
      cards.push(...response.data['data']);
      commit('FETCH_CARDS', {cards});
    } catch (e) {
      console.log(e);
    }


  },
  async addCard({commit, state}) {
    try {
      let {isSubmit} = state.cardForm;
      if(!isSubmit) {
        let {data} = state.cardForm;
        let [expires_month, expires_years] = _.split(data.expiresIn, '/');
        console.log(_.split(data.expiresIn, '/'));
        let params = {
          cardholder: data.cardholder,
          card_number: data.cardNumber,
          expires_in: `${expires_years}-${expires_month}-01`,
          cvc: data.cvc
        };
        let response = await axios.post('cards', params);
        let card = response.data['data'];
        commit('ADD_CARD', {card});
        commit('CLEAR_FORM');
      }
    } catch (e) {
      console.log(e.response);
    }

  },
  async updateCard({commit, state}) {
    try {
      let { data, targetId } = state.cardForm;
      let [expires_month, expires_years] = _.split(data.expiresIn, '/');
      let response = await axios.put(`cards/${targetId}`, {
        cardholder: data.cardholder,
        card_number: data.cardNumber,
        expires_in: `${expires_years}-${expires_month}-01`,
        cvc: data.cvc
      });
      commit('UPDATE_CARD', {id: targetId, data: response.data['data'] });
      commit('CLEAR_FORM');
    }catch (e) {
      console.log(e.response);
    }
  },
  async destroyCard({commit, state}, {id}) {
    try {
      if(id === state.cardForm.targetId) {
        commit('CLEAR_FORM');
      }
      await axios.delete(`cards/${id}`);
      commit('DESTROY_CARD', {id});
    } catch (e) {
      console.log(e);
    }
  }
};

export default new Vuex.Store({
  state, getters, mutations, actions
})
