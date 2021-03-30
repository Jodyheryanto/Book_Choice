<template>
<div>
    <div class="navbar-bg" style="background-color: #525252"></div>
    <div class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
        <li><a href="#" v-if="$mq === 'mobile' || $mq === 'tablet'" @click="toggleBodyClassMini(kondisiMini, 'sidebar-gone')" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        <li><a href="#" @click="toggleBodyClass(kondisi, 'sidebar-mini')" class="nav-link nav-link-lg" v-if="$mq === 'laptop' || $mq === 'desktop'"><i class="fas fa-bars"></i></a></li>
        <div class="nav-collapse">
        <b-nav pills v-if="$mq === 'mobile' || $mq === 'tablet'">
            <b-nav-item-dropdown
            text="Menu"
            toggle-class="nav-link-custom"
            right
            >
            <b-dropdown-item><a @click="Home" href="" class="nav-link">Home</a></b-dropdown-item>
            <!-- <b-dropdown-item><a @click="SearchBook" href="#" class="nav-link">Search Book</a></b-dropdown-item> -->
            <b-dropdown-item><a @click="GuestBook" href="#" class="nav-link">Guest Book</a></b-dropdown-item>
            <b-dropdown-item><a @click="CompareBooks" v-if="successLogin === true && roleId === 1" href="#" class="nav-link">Compare Books</a></b-dropdown-item>
            <b-dropdown-item><a @click="ReportBooks" v-if="successLogin === true && roleId === 0" href="#" class="nav-link">Report List Books</a></b-dropdown-item>
            </b-nav-item-dropdown>
        </b-nav>
        <ul class="navbar-nav" v-else>
            <li class="nav-item active"><a @click="Home" href="" class="nav-link">Home</a></li>
            <!-- <li class="nav-item"><a @click="SearchBook" href="#" class="nav-link">Search Book</a></li> -->
            <li class="nav-item"><a @click="GuestBook" href="#" class="nav-link">Guest Book</a></li>
            <li class="nav-item"><a @click="CompareBooks" v-if="successLogin === true && roleId === 1" href="#" class="nav-link">Compare Books</a></li>
            <li class="nav-item"><a @click="ReportBooks" v-if="successLogin === true && roleId === 0" href="#" class="nav-link">Report List Books</a></li>
        </ul>
        </div>
        </ul>
        <!-- <div class="search-element" style="padding-left: 100px">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit" @click="search()"><i class="fas fa-search"></i></button>
        </div> -->
    </form>
    <ul class="navbar-nav navbar-right" v-if="!successLogin">
        <li class="nav-item"><a @click="SignIn" href="" class="nav-link shadow-none btn btn-dark">Sign In</a></li>
    </ul>
    <ul class="navbar-nav navbar-right" v-else>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="@/assets/stisla/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">{{ name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Logged by {{ name }}</div>
            <div class="dropdown-divider"></div>
            <a href="" @click="signOut" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a> 
        </div>
        </li>
    </ul>
    </div>
</div>
</template>
<script>
import { mapActions } from 'vuex'
export default {
    data() {
        return {
            successLogin: false,
            roleId: null,
            name: '',
            kondisi: false,
            kondisiMini: false
        }
    },
    methods: {
        search(){
            alert("testing")
        },
        toggleBodyClass(kondisi, className) {
            const el = document.body;

            if (kondisi === true) {
                this.kondisi = false
                el.classList.add(className);
            } else {
                this.kondisi = true
                el.classList.remove(className);
            }
        },
        toggleBodyClassMini(kondisi, className) {
            const el = document.body;

            if (kondisi === true) {
                el.classList.add(className);
            } else {
                el.classList.remove(className);
            }
        },
        Home(){
            this.$cookie.set('category', '')
            this.$router.replace({
                name: 'Home'
            })
            location.reload()
        },
        ReportBooks(){
            // this.$router.replace({
            //     name: 'ReportBooks'
            // })
            this.$modal.show('filter-data');
        },
        SignIn(){
            this.$router.replace({
                name: 'Auth'
            })
        },
        SearchBook(){
            this.$router.replace({
                name: 'SearchBook'
            })
        },
        GuestBook(){
            if(eval(this.$cookie.get('user_success')) === true && parseInt(this.$cookie.get('user_role')) === 0){
                this.$router.replace({
                    name: 'ListGuest'
                })
            }else{
                this.$modal.show('guest-book');
            }
        },
        CompareBooks(){
            this.$router.replace({
                name: 'CompareBooks'
            })
        },
        ...mapActions({
            signOutAction: 'signOut'
        }),

        signOut(){
            var r = confirm("Are you sure about that ?");
            if (r == true) {
                this.$cookie.set('user_success', false);
                this.$cookie.set('user_id', null);
                this.$cookie.set('user_name', '');
                this.$cookie.set('user_role', null);
                this.signOutAction()
            }
        }
    },
    mounted() {
        this.successLogin = eval(this.$cookie.get('user_success')),
        this.roleId = parseInt(this.$cookie.get('user_role')),
        this.name = this.$cookie.get('user_name')
    },
}
</script>
