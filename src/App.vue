<script setup>
import HelloWorld from './components/HelloWorld.vue'
import NavBar from './components/NavBar.vue';
import SideBar from './components/SideBar.vue';
import AdminNavBar from './components/AdminNavbar.vue'
</script>

<template>
  <div class="container-fluid p-0">
    <!--User part start-->
    <template v-if="isLoggedIn != false">
    <template v-if="role == 'user'">
        <NavBar/>
        <router-view/>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 px-5 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            KUBO
          </a>
          <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
        </ul>
      </footer>
    </template>
  <!--User part end-->

  <!-- Admin part Start-->
  <template v-if="role == 'admin'">
  <div class="sb-nav-fixed">
    <div id="layoutSidenav">
      <SideBar/>
      <div id="layoutSidenav_content">
        <main>
          <router-view/>               
        </main>
        <footer class="py-4 bg-light mt-auto">
          <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
              <div class="text-muted">Copyright &copy; Your Website 2023</div>
                <div>
                  <a href="#">Privacy Policy</a>
                      &middot;
                  <a href="#">Terms &amp; Conditions</a>
                </div>
              </div>
            </div>
          </footer>
        </div>
    </div>
  </div>
<AdminNavBar/>
</template>
</template>
  <!-- Admin part End-->

  <!--AUTH VIEWS-->
  <template v-if="!isLoggedIn">
      <router-view/>
    </template>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        role: "",
        isLoggedIn: false
      }
    },
    methods: {
      
    },
    created() {
      this.role = localStorage.role;
        this.isLoggedIn = localStorage.isLoggedIn;
        console.log(this.role, this.isLoggedIn);
    }
  }
</script>
