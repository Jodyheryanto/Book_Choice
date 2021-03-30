<template>
    <div class="main-sidebar" style="background-color: #353535;">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
            <a href=""><img src="@/assets/logo.png" height="150" style="margin: 10px 30px" alt="Booker"></a>
            <a style="color: white" href="">Booker</a>
            </div>
            <ul class="sidebar-menu">
                <li class="nav-item dropdown">
                <a href="" @click="Home" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
                </li>
                <li class="menu-header">Category</li>
                <li class="nav-item dropdown">
                <a href="" @click="category('non-fiction')"><i class="far fa-address-book"></i><span>Non-Fiction</span></a>
                <a href="" @click="category('fiction')"><i class="fas fa-hat-wizard"></i><span>Fiction</span></a>
                </li>
                <!-- <li><a href="#"><i class="fas fa-robot"></i> <span>Technology</span></a></li> -->
            </ul>
            <button type="button" title="Close Sidebar" v-if="$mq === 'mobile' || $mq === 'tablet'" @click="toggleBodyClassMini(kondisiMini, 'sidebar-gone')" style="margin: 0 25px" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="btn btn-icon btn-danger" style="background-color: red"><i class="fas fa-times"></i></span>
            </button>
        </aside>
    </div>
</template>
<script>
export default {
data: function(){
    return {
        booleanUbah: true,
        kondisiMini: true,
        indexx: ''
    }
},
methods : {
    sendBolUbah(){
        this.$eventBus.$emit("datafromsidebar", this.booleanUbah);
    },
    Home(){
        this.$cookie.set('category', '')
        this.$router.replace({
            name: 'Home'
        })
    },
    toggleBodyClassMini(kondisi, className) {
        const el = document.body;

        if (kondisi === true) {
            el.classList.add(className);
        } else {
            el.classList.remove(className);
        }
    },
    category(param){
        this.$cookie.set('category', param)
    }
}
}
</script>