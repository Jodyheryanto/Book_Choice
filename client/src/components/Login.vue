<template>
    <div>
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                <div class="p-4 m-3">
                    <img src="../assets/logo.png" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                    <h4 class="text-dark font-weight-normal">Welcome to <span class="font-weight-bold">Booker</span></h4>
                    <p class="text-muted">Before you get started, you must login or register if you don't already have an account.</p>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input id="username" type="text" class="form-control" v-model="form.username" name="username" tabindex="1" required autofocus v-on:keyup.enter="submit">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>    
                        <div class="input-group">
                            <input id="password" :type="passwordFieldType" v-model="form.password" class="form-control" name="password" tabindex="2" required v-on:keyup.enter="submit">
                            <button class="buttonTransparent" type="password" @click="switchVisibility"><i class="fas fa-eye eyeClass"></i></button>
                        </div>
                    </div>

                    <div class="form-group">
                        <button @click="submit" type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                        </button>
                    </div>

                    <div class="mt-5 text-center">
                        Don't have an account? <a href="#" @click="$modal.show('example-adaptive')">Create new one</a><br>
                        Or return to <a href="#" @click="Home()">Home </a>?
                    </div>

                    <div class="text-center mt-5 text-small">
                    Copyright &copy; Gajebo Group.
                    </div>
                </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="https://i.imgur.com/raRCwHV.jpg">
                <div class="absolute-bottom-left index-2">
                    <div class="text-light p-5 pb-2">
                    <div class="mb-5 pb-3">
                        <h1 class="mb-2 display-4 font-weight-bold">Welcome to Booker</h1>
                        <h5 class="font-weight-normal text-muted-transparent">Present by Gajebo Group</h5>
                    </div>
                    Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/kGUmNEYaSMY">Jon Tyson</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
//import axios from 'axios'
import { mapActions } from 'vuex'
import store from '@/store'
export default {
        name: 'Login',
        data() {
            return {
                form: {
                    username: "",
                    password: ""
                },
                passwordFieldType: 'password',
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
        methods: {
            ...mapActions({
                signIn: 'signIn'
            }),
            Home(){
                this.$router.replace({
                    name: 'Home'
                })
            },
            submit() {
                if(this.form.username === "" && this.form.password === ""){
                    this.$toast.warning('Please fill the Username & Password!', 'Failed', this.notificationSystem.options.warning)
                }
                else if(this.form.username !== ""){
                    if(this.form.password){
                        store.state.param_login.username = this.form.username
                        store.state.param_login.password = this.form.password
                        this.signIn().then(() => {
                            this.$cookie.set('user_success', store.state.successLogin, { expires: '30m' });
                            this.$cookie.set('user_id', store.state.userid, { expires: '30m' });
                            this.$cookie.set('user_name', store.state.name, { expires: '30m' });
                            this.$cookie.set('user_role', store.state.roleId, { expires: '30m' });
                            if(store.state.successLogin === true){
                                this.$toast.success('You Succeeded Login!', 'Congratulation', this.notificationSystem.options.success)
                                setTimeout( () => this.$router.replace({
                                    name: 'Home'
                                }), 3000)
                            }else{
                                this.$toast.warning('Your Username or Password is Not Valid!', 'Failed', this.notificationSystem.options.warning)
                            }                   
                        })
                    }else{
                        this.$toast.warning('Please fill the Password!', 'Failed', this.notificationSystem.options.warning)
                    }
                }else{
                    this.$toast.warning('Please fill the Email!', 'Failed', this.notificationSystem.options.warning)
                }
            },
            switchVisibility() {
                this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password'
            }
        },
    }
</script>
<style scoped>
    .buttonTransparent {
        background-color: Transparent;
        background-repeat:no-repeat;
        border: none;
        cursor:pointer;
        overflow: hidden;
        outline:none;
        margin: 0 10px;
    }
    .eyeClass{
        color: #003777;
    }
</style>