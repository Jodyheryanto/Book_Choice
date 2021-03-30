<template>
  <modal 
    name="example-adaptive"
    transition="nice-modal-fade"
    height="auto" 
    :scrollable="true"
    :delay="100"
    :adaptive="true">
  <div class="example-modal-content">
      <h3 style="margin: 15px 20px;">Form Registrasi</h3>
      <hr>
      <br>
      <ul type="none">
          <li>
              <div class="form-group" style="margin-top: -20px; margin-left: 50px;">
                <label for="username">Username : </label>
                <input type="text" class="form-control" name="username" style="width: 90%;" v-model="form.username">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -20px; margin-left: 50px;">
                <label for="full_name">Full Name : </label>
                <input type="text" class="form-control" name="full_name" style="width: 90%;" v-model="form.fullname">
              </div>
          </li>
          <li>
              <div class="form-group mb-0" style="margin-top: -20px; margin-left: 50px;">
                <label for="email">Email : </label>
                <input type="email" class="form-control" name="email" style="width: 90%;" v-model="form.email">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-left: 50px;">
                <label for="password">Password : </label>
                <input type="password" class="form-control" name="password" style="width: 90%;" v-model="form.password">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -20px; margin-left: 50px;">
                <label for="password2">Confirmation Password : </label>
                <input type="password" class="form-control" name="password2" style="width: 90%;" v-model="validate.password_confirmation">
              </div>
          </li>
          <li>
              <div class="form-group" style="margin-top: -20px; margin-left: 50px;">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="agree" class="custom-control-input" id="agree" v-model="validate.isAgree">
                  <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                </div>
              </div>
          </li>
      </ul>
      <footer class="modal-footer" style="margin-top: -40px">
        <slot name="footer">
          <button v-on:click="submitForm" class="btn-blue" style="margin: -3px 30px; padding: 10px;">Registrasi</button>
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
            username: '',
            fullname: '',
            email: '',
            password: '',
            avatar: 'default.png'
        },
        validate: {
            isAgree: false,
            password_confirmation: ''
        },
        notificationSystem: {
          options: {
              success: {
                  position: "topLeft"
              },
              warning: {
                  position: "topLeft"
              },
          }
        }
      }
  },
  methods:{
      checkForm:function() {
          if(this.form.username && this.form.fullname && this.form.email && this.form.password && this.validate.password_confirmation && this.validate.isAgree){
            if(this.form.password === this.validate.password_confirmation){
              this.submitForm();
            }else{
              alert("password doesn't match")
            }
          }else{
            alert("Error")
          }
      },
      close() {
      this.$emit('close');
      },
      submitForm(){
          store.state.param_user = this.form
          this.$store.dispatch('addUser')
          this.$toast.success('You Succeeded Register!', 'Congratulation', this.notificationSystem.options.success)
            setTimeout( () => this.$router.replace({
                name: 'Auth'
          }), 3000)
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