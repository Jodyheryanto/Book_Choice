<template>
  <modal 
    name="example-draggable"
    transition="nice-modal-fade"
    height="auto" 
    :scrollable="true"
    :delay="100"
    :adaptive="true">
  <div class="example-modal-content">
      <h3 style="margin: 15px 20px;">Input Buku</h3>
      <hr>
      <p v-if="errors.length" style="margin-left: 25px;">
          <b>Please correct the following error(s):</b>
          <b v-for="(error,index) in errors" v-bind:key="index" style="color: red;"> {{ error }},</b><b style="color: red;"> Required</b>
      </p>
      <br>
      <ul type="none" style="padding-left: 40px;">
          <li>
              <div class="form-group" style="margin-top: -20px;">
                <label for="judul">Judul : </label>
                <input type="text" class="form-control" name="judul" ref="judul" style="width: 90%;" v-model="form.title">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -20px;">
                <label for="cover">Cover (Link Url) : </label>
                <input type="text" class="form-control" name="cover" ref="cover" style="width: 90%;" v-model="form.cover">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -20px;">
                <label for="category">Category : </label>
                <select class="form-control" style="width: 90%" name="category" ref="category" v-model="form.category">
                  <option value="non-fiction">Non-Fiction</option>
                  <option value="fiction">Fiction</option>
                  <!-- <option value="technology">Technology</option> -->
                </select>
              </div>
          </li>
          <li>
              <div class="form-group mb-0" style="margin-top: -20px;">
                <label for="deskripsi">Deskripsi : </label>
                <textarea class="form-control" name="deskripsi" ref="deskripsi" style="width: 90%;" v-model="form.description"></textarea>
              </div>
          </li>
          <li>
              <div class="form-group">
                <label for="publish">Tanggal Publish : </label>
                <input type="date" class="form-control" name="publish" ref="publish" style="width: 90%;" v-model="form.publish_date">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -20px;">
                <label for="authors">Nama Penulis : </label>
                <input type="text" class="form-control" name="authors" ref="authors" style="width: 90%;" v-model="form.author">
              </div>
          </li>
          <!-- <li>
              <label for="image">Image : </label>
              <input type="file" name="image" ref="image">
          </li> -->
          <!-- <li> -->
              <!-- <input type="submit" value="submit"> -->
              <!-- <button v-on:click="submitForm" class="btn-blue">Tambah Buku</button> -->
          <!-- </li> -->
          <!-- <li v-for="(book,index) in books" v-bind:key="index">{{ book.judul }}</li> -->
          <!-- <li v-for="book in books">{{ book.judul }}</li> -->
      </ul>
      <footer class="modal-footer" style="margin-top: -20px">
        <slot name="footer">
          <button v-on:click="checkForm" class="btn-blue" style="margin: 0px 30px; padding: 10px;">Tambah Buku</button>
          <!-- <button type="submit" class="btn-green">Selesai!</button>

          <button
            type="button"
            class="btn-red"
            @click="close"
            aria-label="Close modal"
          >
            Close me!
          </button> -->
        </slot>
      </footer>
  </div>
</modal>
</template>
<script>
import store from '@/store'
export default {
  data() {
      return {
          form: {
              title: '',
              cover: '',
              category: '',
              author: '',
              publish_date: '',
              description: ''
          },
          errors:[],
          // images: ['c++-high-performance', 'kalilinux', 'bookandroid'],
      }
  },
  mounted() {
    store.state.param_book = null
  },
  methods:{
      checkForm:function(e) {
          if(this.form.title && this.form.author && this.form.description && this.form.publish_date && this.form.cover && this.form.category){
              this.submitForm();
          }
          this.errors = [];
          if(!this.form.title) this.errors.push("Judul");
          if(!this.form.cover) this.errors.push("Cover");
          if(!this.form.category) this.errors.push("Category");
          if(!this.form.description) this.errors.push("Deskripsi");
          if(!this.form.author) this.errors.push("Nama Penulis");
          if(!this.form.publish_date) this.errors.push("Tanggal Publish");
          e.preventDefault();
      },
      close() {
      this.$emit('close');
      },
      submitForm(){
          //this.form.cover = this.images[Math.floor(Math.random() * this.images.length)];
          store.state.param_book = this.form
          this.$eventBus.$emit("datafrominput", this.form);
          this.$store.dispatch('addBook').then(() => { alert(store.state.message); location.reload() })
      }
  }
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