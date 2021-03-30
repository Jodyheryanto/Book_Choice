<template>
    <modal 
      name="example-resizable"
      transition="nice-modal-fade"
      height="auto"
      :scrollable="true"
      :delay="100"
      :adaptive="true">
    <div class="example-modal-content">
        <h3 style="margin: 15px 20px;">Ubah Buku</h3>
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
                <div class="form-group mb-0" style="margin-top: -20px;">
                  <label for="deskripsi">Deskripsi : </label>
                  <textarea class="form-control" name="deskripsi" ref="deskripsi" style="width: 90%;" v-model="form.description"></textarea>
                </div>
            </li>
            <li>
              <div class="form-group" style="margin-top: 0px;">
                <label for="category">Category : </label>
                <select class="form-control" name="category" ref="category" style="width: 90%;" v-model="form.category">
                    <option v-for="(select, index) in selects" v-bind:key="index" v-bind:value="select.id" >{{ select.value }}</option>
                </select>
              </div>
            </li>
            <li>
                <div class="form-group" style="margin-top: -20px;">
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
            <li>
              <div class="form-group" style="margin-top: -20px;">
                <label for="cover">Cover (Link url) : </label>
                <input type="text" class="form-control" name="cover" ref="cover" style="width: 90%;" v-model="form.cover">
              </div>
            </li>
        </ul>
        <footer class="modal-footer" style="margin-top: -20px">
          <slot name="footer">
            <button v-on:click="checkForm" class="btn-blue" style="margin: -5px 30px; padding: 10px;">Ubah Buku</button>
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
                id: '',
                title: '',
                category: '',
                author: '',
                cover: '',
                publish_date: '',
                description: ''
            },
            selects: [{id: 'non-fiction', value: 'Non-Fiction'}, {id: 'fiction', value: 'Fiction'}],
            errors:[],
            // images: ['c++-high-performance', 'kalilinux', 'bookandroid'],
            neww: '',
        }
    },
    methods:{
        checkForm:function(e) {
            if(this.form.title && this.form.author && this.form.description && this.form.publish_date){
                this.submitForm();
            }
            this.errors = [];
            if(!this.form.title) this.errors.push("Judul");
            if(!this.form.description) this.errors.push("Deskripsi");
            if(!this.form.author) this.errors.push("Nama Penulis");
            if(!this.form.publish_date) this.errors.push("Tanggal Publish");
            e.preventDefault();
        },
        close() {
        this.$emit('close');
        },
        submitForm(){
            this.form.judul = this.$refs.judul.value;
            this.form.deskripsi = this.$refs.deskripsi.value;
            this.form.category = this.$refs.category.value;
            this.form.authors = this.$refs.authors.value;
            this.form.publish = this.$refs.publish.value;
            this.form.cover = this.$refs.cover.value;
            store.state.param_book = this.form
            store.state.indexx = this.form.id
            this.$eventBus.$emit("datafromubah", this.form);
            this.$store.dispatch('changeBook').then(() => { alert(store.state.message); location.reload() })
        }
    },
    mounted() {
      this.$eventBus.$on("datafromcard", (x) => {
        this.neww = x;
        this.form.id = this.neww.id;
        this.form.title = this.neww.title;
        this.form.category = this.neww.category;
        this.form.description = this.neww.description;
        this.form.author = this.neww.author;
        this.form.publish_date = this.neww.publish_date;
        this.form.cover = this.neww.cover;
      });
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