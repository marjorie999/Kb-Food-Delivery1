<template>
   
    <div class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-danger" style="background-color: rgb(164, 33, 13) !important;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">KUBO</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
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
        isLoggedIn: false
      }
    },
    methods: {
      setAuth() {
        this.role = localStorage.role;
        this.isLoggedIn = localStorage.isLoggedIn;
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

      }</script>