<template>
    <nav class="navbar navbar-expand-lg" style="background-color: rgb(164, 33, 13);">
  <div class="container">
    <a class="navbar-brand" href="#">KUBO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link class="nav-link" active-class="active" to="/" exact>HOME</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/menu" exact-path class="nav-link" active-class="active">MENU</router-link>
        </li>
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <router-link to="/login" exact-path class="nav-link" active-class="active" v-if="isLoggedIn == false">LOGIN</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/register" exact-path class="nav-link" active-class="active" v-if="isLoggedIn == false">REGISTER</router-link>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" class="nav-link">{{fullName}}</a>
        </li>
        <li class="nav-item">
          <a href="javascript:void(0)" @click="logout" class="nav-link">LOGOUT</a>
        </li>
      </ul>
      </div>
    </div>
  </div>
</nav>
</template>

<script>
export default {
        
        created(){
    this.currentRoute;
    //this.nombreRuta = this.$route.name;
},
computed: {
    currentRouteName() {
        return this.$route.name;
    }
},data() {
      return {
        role: "",
        isLoggedIn: false,
        fullName: ''
      }
    },
    methods: {
      setAuth() {
        this.role = localStorage.role;
        this.isLoggedIn = localStorage.isLoggedIn;
        var data = JSON.parse(localStorage.user_info);
        this.fullName = data[0].first_name;
      },
      logout() {
        localStorage.removeItem('role');
        localStorage.removeItem('isLoggedIn');
        localStorage.removeItem('user_info');
        this.$router.go(this.$router.currentRoute)
      }
    },
    beforeMount() {
      this.setAuth();
    }

      }
</script>