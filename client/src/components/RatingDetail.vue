<template>
  <modal name="example"
        transition="nice-modal-fade"
        height="auto" 
        :scrollable="true"
        :delay="100"
        :adaptive="true">
    <div class="example-modal-content">
        <h3 style="margin: 15px 20px;">Rating Buku</h3>
        <hr>
        <p v-if="errors.length" style="margin-left: 25px;">
            <b>Please correct the following error(s):</b>
            <b v-for="(error,index) in errors" v-bind:key="index" style="color: red;"> {{ error }},</b><b style="color: red;"> Required</b>
        </p>
        <br>
        <ul type="none" style="margin-left: 15px;">
            <li>
                <div class="form-group mb-0">
                  <label for="deskripsi">Rating : </label>
                  <star-rating :border-width="4" v-model="form.rating" border-color="#d8d8d8" :rounded-corners="true" :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"></star-rating>
                </div>
            </li>
            <li>
                <div class="form-group mb-0">
                  <label for="deskripsi">Komentar : </label>
                  <textarea class="form-control" name="deskripsi" ref="deskripsi" style="width: 90%; height: 150px;" v-model="form.post"></textarea>
                </div>
            </li>
        </ul>
        <footer class="modal-footer" style="margin-top: 40px">
          <slot name="footer">
            <button v-on:click="checkForm" class="btn-blue" style="margin: -5px 30px; padding: 10px;">Simpan Rating</button>
          </slot>
        </footer>
    </div>
  </modal>
</template>
<script>
import StarRating from 'vue-star-rating'
import store from '@/store'
export default {
  name: 'ExampleModal',
  components: {
      'star-rating': StarRating
  },
  data() {
      return {
          form: {
            user_id: parseInt(this.$cookie.get('user_id')),
            book_id: 0,
            post: '',
            is_positive: '',
            rating: 0
          },
          reviewid: null,
          edit: false,
          neww: [],
          errors:[],
      }
  },
  methods:{
      checkForm:function(e) {
          if(this.form.post && this.form.rating){
              this.submitForm();
          }
          this.errors = [];
          if(!this.form.post) this.errors.push("Deskripsi");
          if(this.form.rating === 0) this.errors.push("Rating");
          e.preventDefault();
      },
      submitForm(){
          if(this.form.rating < 3){
            this.form.is_positive = 0
          }else if(this.form.rating >= 3){
            this.form.is_positive = 1
          }
          store.state.param_review = this.form
          if(this.edit === true){
            store.state.reviewid = this.reviewid
            this.$store.dispatch('changeReview').then(() => { alert(store.state.message); location.reload() })
          }else{
            this.$store.dispatch('addReview').then(() => { alert(store.state.message); location.reload() })
          }
      },
      fillData(){
          let data = store.state.book
          this.form.book_id = data.id
        },
  },
  async mounted() {
      this.$eventBus.$on("datafromrating", (x) => {
        this.neww = x;
        this.form.rating = this.neww.rating
        this.form.post = this.neww.message
        this.reviewid = this.neww.reviewid
        if(this.form.reviewid !== null){
          this.edit = true
        }
      });
      this.isBusy = true;
      try {
          await this.$store.dispatch('getDetailBooks')
          this.fillData()
      } catch (ex) {
          this.error = "Failed to load data";
      } finally {
          this.isBusy = false;
      }
      // this.$store.dispatch('loadBooks'),
      this.$eventBus.$on("indexfordetail", (x) => {
          this.$eventBus.$emit("indexfromdetail", x);
      });
  },
}
</script>
<style scope>
li{
  padding-bottom: 10px;
}
.modal-backdrop {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: rgba(0, 0, 0, 0.3);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal {
  background: #FFFFFF;
  box-shadow: 2px 2px 20px 1px;
  overflow-x: auto;
  display: flex;
  flex-direction: column;
}

.modal-header,
.modal-footer {
  padding: 15px;
  display: flex;
}

.modal-header {
  border-bottom: 1px solid #eeeeee;
  color: #4AAE9B;
  justify-content: space-between;
}

.modal-footer {
  border-top: 1px solid #eeeeee;
  justify-content: flex-end;
}

.modal-body {
  position: relative;
  padding-right: 30px;
  padding-top: 10px;
}

.btn-close {
  border: none;
  font-size: 20px;
  cursor: pointer;
  font-weight: bold;
  color: #4AAE9B;
  background: transparent;
}

.btn-blue {
  color: white;
  font-weight: bold;
  font-size: 13px;
  background: #0044ff;
  border: 1px solid #4AAE9B;
  border-radius: 5px;
  padding: 5px;
}

.btn-green {
  color: white;
  font-weight: bold;
  font-size: 13px;
  background: #22ff00;
  border: 1px solid #4AAE9B;
  border-radius: 5px;
  padding: 5px;
}

.btn-red {
  margin-left: 2px;
  color: white;
  font-weight: bold;
  font-size: 13px;
  background: red;
  border-radius: 5px;
  padding: 5px;
}
</style>