<template>
  <modal name="guest-book"
        transition="nice-modal-fade"
        height="auto" 
        :scrollable="true"
        :delay="100"
        :adaptive="true">
    <div class="example-modal-content">
        <h3 style="margin: 15px 20px;">Guest Book</h3>
      <hr>
      <p v-if="errors.length > 0" style="margin-left: 25px;">
          <b>Please correct the following error(s):</b>
          <b v-for="(error,index) in errors" v-bind:key="index" style="color: red;"> {{ error }}</b>
      </p>
      <p style="padding: 10px;" align= "justify">
        Guest Book ini berguna untuk memberikan sebuah saran dan kritik mengenai webiste kami, dan juga sebagai tanda bukti kunjungan anda. Harap diisi dengan benar dan penuh tanggung jawab. Terima kasih.
      </p>
      <br>
      <ul type="none" style="padding-left: 40px;">
          <li>
              <div class="form-group" style="margin-top: -50px;">
                <label for="nama">Nama : </label>
                <input type="text" class="form-control" name="nama" ref="nama" style="width: 90%;" v-model="form.guest_name">
              </div>
          </li>
          <li>
              <div class="form-group mb-0" style="margin-top: -25px;">
                <label for="ulasan">Kritik dan saran : </label>
                <textarea class="form-control" name="ulasan" ref="ulasan" style="width: 90%;" v-model="form.guest_message"></textarea>
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -5px;">
                <label for="job">Pekerjaan : </label>
                <select name="job" id="job" class="form-control" style="width: 90%;" v-model="form.job">
                  <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                  <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                  <option value="Pegawai Swasta">Pegawai Swasta</option>
                  <option value="Pengusaha">Pengusaha</option>
                  <option value="Dan lain-lain">Dan lain-lain</option>
                </select>
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -25px;">
                <label for="email">Email : </label>
                <input type="email" class="form-control" name="email" ref="email" style="width: 90%;" v-model="form.email">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -25px;">
                <label for="asal_instansi">Asal Instansi : </label>
                <input type="text" class="form-control" name="asal_instansi" ref="asal_instansi" style="width: 90%;" v-model="form.company">
              </div>
          </li>
      </ul>
      <footer class="modal-footer" style="margin-top: -30px">
        <slot name="footer">
          <button v-on:click="checkForm" class="btn-blue" style="margin: -5px 30px; padding: 10px;">Simpan</button>
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
  name: 'ExampleModal',
  data() {
      return {
          form: {
            guest_name: '',
            guest_message: '',
            job: '',
            email: '',
            company: ''
          },
          submit: 0,
          errors:[],
      }
  },
  methods:{
      checkForm:function(e) {
          this.errors = [];
          if(this.form.guest_name && this.form.guest_message && this.form.job && this.form.email && this.form.company){
              if (this.form.email.includes('@') === true){
                this.submit += 1
                this.submitForm();
              }else{
                this.errors.push("Email anda tidak valid");
                e.preventDefault();
              }
          }
          if(this.errors.length === 0){
            if(!this.form.guest_name) this.errors.push("Nama,");
            if(!this.form.guest_message) this.errors.push("Kritik/Saran,");
            if(!this.form.job) this.errors.push("Pekerjaan,");
            if(!this.form.email) this.errors.push("Email,");
            if(!this.form.company) this.errors.push("Asal Instansi,");
            if(this.errors.length !== 0){
              this.errors.push("Required");
            }
          }
          e.preventDefault();
      },
      submitForm(){
          if(this.submit === 1){
            store.state.param_guest = this.form
            this.$store.dispatch('addGuestBook')
          }else{
            alert("Anda sudah menekan tombol simpan")
          }
      },
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