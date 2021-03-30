import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    users: [],
    books: [],
    carousels: [],
    temp: {
      dari_tgl: null,
      smp_tgl: null
    },
    book: [],
    reviews: [],
    reviewalls: [],
    listguests: [],
    param_book: [],
    param_carousel: [],
    param_guest: [],
    param_user: [],
    param_login: {
      username: '',
      password: ''
    },
    message: '',
    param_review: [],
    name: '',
    userid: null,
    successLogin: false,
    roleId: null,
    indexx: null,
    reviewid: null
  },
  actions: {
    // async loadBooks({ commit }) {
    //   axios
    //     .get('https://my-json-server.typicode.com/JodyHeryanto/demo/books')
    //     .then(r => r.data)
    //     .then(books => {
    //       commit('SET_BOOKS', books)
    //     })
    // },
    async addBook() {
      let response = await axios.post('https://thawing-fjord-07577.herokuapp.com/api/book', this.state.param_book)
      this.state.message = response.data.message
    },
    async changeBook() {
      let response = await axios.put('https://thawing-fjord-07577.herokuapp.com/api/book/' + this.state.indexx, this.state.param_book)
      this.state.message = response.data.message
    },
    async loadBooks(context) {
      var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/book");
      context.commit("SET_BOOKS", result.data.book);
    },
    async getDetailBooks(context) {
      var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/book/" + this.state.indexx);
      context.commit("SET_BOOK", result.data.book[0]);
    },
    async deleteBook() {
      let response = await axios.delete("https://thawing-fjord-07577.herokuapp.com/api/book/" + this.state.indexx);
      this.state.message = response.data.message
    },
    async addCarousel() {
      let response = await axios.post('https://thawing-fjord-07577.herokuapp.com/api/carousel', this.state.param_carousel)
      this.state.message = response.data.message
    },
    async loadCarousels(context) {
      var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/carousel");
      context.commit("SET_CAROUSELS", result.data.carousel);
    },
    async changeCarousel() {
      let response = await axios.put('https://thawing-fjord-07577.herokuapp.com/api/carousel/' + this.state.indexx, this.state.param_carousel)
      this.state.message = response.data.message
    },
    async deleteCarousel() {
      let response = await axios.delete("https://thawing-fjord-07577.herokuapp.com/api/carousel/" + this.state.indexx);
      this.state.message = response.data.message
    },
    // async loadReview(context) {
    //   var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/review");
    //   context.commit("SET_REVIEWS", result.data.review);
    // },
    async addUser(context) {
      let response = await axios.post('https://thawing-fjord-07577.herokuapp.com/api/register', this.state.param_user)
      context.commit("SET_MESSAGE", response.data.message);
    },
    async loadUser(context) {
      var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/user");
      context.commit("SET_USERS", result.data.users);
    },
    async addReview() {
      let response = await axios.post('https://thawing-fjord-07577.herokuapp.com/api/review', this.state.param_review)
      this.state.message = response.data.message
    },
    async changeReview() {
      let response = await axios.put('https://thawing-fjord-07577.herokuapp.com/api/review/' + this.state.reviewid, this.state.param_review)
      this.state.message = response.data.message
    },
    async addGuestBook() {
      let response = await axios.post('https://thawing-fjord-07577.herokuapp.com/api/guestbook', this.state.param_guest)
      alert(response.data.message)
    },
    async loadGuest(context) {
      var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/guestbook");
      context.commit("SET_GUESTS", result.data.guestbook);
    },
    async loadReview(context) {
      var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/review/book/" + this.state.indexx);
      context.commit("SET_REVIEWS", result.data.review);
    },
    async loadReviews(context) {
      var result = await axios.get("https://thawing-fjord-07577.herokuapp.com/api/review");
      context.commit("SET_REVIEWALL", result.data.review);
    },
    async signIn({ dispatch }) {
      var result = await axios.post("https://thawing-fjord-07577.herokuapp.com/api/login", this.state.param_login);
      return dispatch('attempt', result)
      // if (credentials.email === "admin" && credentials.password === "admin"){
      //   response[0] = true
      //   response[1] = 0
      //   response[2] = "Admin"
      //   return dispatch('attempt', response)
      // } else if (credentials.email === "user" && credentials.password === "user") {
      //   response[0] = true
      //   response[1] = 1
      //   response[2] = "User"
      //   return dispatch('attempt', response)
      // }

    },
    async attempt({ commit }, result) {
      if (result) {
        if (result.status === 200) {
          //Vue.$cookies.set('user', result.data.user.api_token);
          // var user = {
          //   success: true,
          //   id: result.data.user.id,
          //   name: result.data.user.name,
          //   role: result.data.user.role,
          //   toke: result.data.user.api_token
          // };
          // Vue.$cookies.set('user', user);
          // print user name
          // console.log(this.$cookies.get('user').name)
          commit('SET_SUCCESS', true)
          commit('SET_ROLE', result.data.user.role)
          commit('SET_NAME', result.data.user.fullname)
          commit('SET_USERID', result.data.user.id)
        }
      }
    },
    signOut({ commit }) {
      commit('SET_SUCCESS', false)
      commit('SET_ROLE', null)
      commit('SET_NAME', null)
      commit('SET_USERID', null)
    }
  },
  mutations: {
    SET_BOOKS(state, books) {
      state.books = books
    },
    SET_BOOK(state, book) {
      state.book = book
    },
    SET_CAROUSELS(state, carousels) {
      state.carousels = carousels
    },
    SET_SUCCESS(state, success) {
      state.successLogin = success
    },
    SET_ROLE(state, role) {
      state.roleId = role
    },
    SET_NAME(state, name) {
      state.name = name
    },
    SET_REVIEWS(state, reviews) {
      state.reviews = reviews
    },
    SET_REVIEWALL(state, reviewalls) {
      state.reviewalls = reviewalls
    },
    SET_GUESTS(state, listguests) {
      state.listguests = listguests
    },
    SET_USERS(state, users) {
      state.users = users
    },
    SET_USERID(state, userid) {
      state.userid = userid
    },
    SET_MESSAGE(state, message) {
      state.message = message
    }
  }
})
