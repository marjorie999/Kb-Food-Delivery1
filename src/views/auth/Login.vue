<template>
    <div class="wrapper md-center p-3">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
    <div class="col col-sm-4">
      <!--  -->
    </div>
    <div class="col-lg-3" >
        <div class="card text-center" style="background-color: rgb(164, 33, 13);border-radius: 20px; ">
            <p v-if="message">{{ message }}</p>
                <div class="card-body"  >
                    <img class="mb-2" src='../../assets/images/ku-bo.png' style="height:80px ;" alt="">
                    <h5 class="card-title" style="color: white; font-size: 30px; font-family: 'Cairo';">RestoCafe'</h5>
                    <!-- <form class="p-1"> -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" v-model="email" placeholder="name@example.com" value="renz@gmail.com">
                            <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-2">
                            <input type="password" class="form-control" v-model="password" placeholder="Password" value="1qa1qa1qa">
                            <label for="floatingPassword">Password</label>
                        </div>
                <!-- <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Email</label>
                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                    </div>
                    <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Password</label>
                    <input type="password" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
                </div> -->
                <button class="btn btn-warning" @click="login">Login</button>
                <p class="text-white">Not registered? <router-link to="/register">Register</router-link></p>
                    <!-- </form>   -->
                </div>
            </div>
        </div>
        <div class="col col-sm-4">
        <!--  -->
        </div>
  </div>
           
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: '',
      message: ''
    };
  },
  methods: {
    async login() {
        const formData = new FormData()
        formData.append('email', this.email)
        formData.append('password', this.password)
      try {
        const response = await fetch('http://localhost:8080/login', {
          method: 'POST',
        //   headers: {
        //     'Content-Type': 'application/json'
        //   },
          body: formData
        });

        if (response.ok) {
          // Handle successful login
          const responseBody = await response.json(); // Parse response body
            const dataArray = [];
            dataArray.push(responseBody.user_info);
            const json = JSON.stringify(dataArray[0])
            localStorage.setItem('user_info', json)
            localStorage.setItem('isLoggedIn', true)
            console.log(dataArray[0][0], 'info')
            localStorage.setItem('role', dataArray[0][0].role)
            if(localStorage.role == 'user'){
                this.$router.push({
                path: "/"
            })
            }else{
                this.$router.push({
                path: "/manage_menu"
            })
            }
            let isAuthenticated = false;
            console.log(isAuthenticated, 'false')
            if(localStorage.getItem('isLoggedIn') != null){
                isAuthenticated = true
                console.log(isAuthenticated, 'true')
            }
        } else {
          // Handle unsuccessful login
          this.message = 'Invalid credentials';
        }
      } catch (error) {
        console.error('Error:', error);
        this.message = 'Error occurred during login';
      }
    }
  }
};
</script>