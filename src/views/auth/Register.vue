<template>
    <div class="wrapper md-center p-3">
      <div class="container-fluid">
        <div class="row justify-content-md-center">
          <div class="col col-sm-3">
            <!-- Left column content (if any) -->
          </div>
          <div class="col-lg-4">
            <div class="card text-center" style="background-color: rgb(164, 33, 13); border-radius: 20px;">
              <div class="card-body">
                <img class="mb-2" src="../../assets/images/ku-bo.png" style="height: 80px;" alt="">
                <h5 class="card-title" style="color: white; font-size: 30px; font-family: 'Cairo';">RestoCafe'</h5>
                <form class="p-0" @submit.prevent="register">
                  <!-- First Name and Last Name fields -->
                  <div class="row">
                    <div class="col">
                      <div class="form-floating mb-2">
                        <input v-model="firstName" type="text" class="form-control" placeholder="First Name">
                        <label>First Name</label>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-floating mb-2">
                        <input v-model="lastName" type="text" class="form-control" placeholder="Last Name">
                        <label>Last Name</label>
                      </div>
                    </div>
                  </div>
                  <!-- Email and Mobile Number fields -->
                  <div class="form-floating mb-2">
                    <input v-model="email" type="email" class="form-control" placeholder="name@example.com">
                    <label>Email Address</label>
                    <div v-if="emailExist" class="text-warning">{{ emailExist }}</div>
                  </div>
                  <div class="form-floating mb-2">
                    <input v-model="mobileNumber" type="text" class="form-control" placeholder="Mobile Number">
                    <label>Mobile Number</label>
                  </div>
                  <!-- Address field -->
                  <div class="form-floating mb-2">
                    <input v-model="address" type="text" class="form-control" placeholder="Address">
                    <label>Address</label>
                  </div>
                  <!-- Password and Confirm Password fields -->
                  <div class="form-floating mb-2">
                    <input v-model="password" type="password" class="form-control" placeholder="Password">
                    <label>Password</label>
                  </div>
                  <div class="form-floating mb-2">
                    <input v-model="confirmPassword" type="password" class="form-control" placeholder="Re-type password">
                    <label>Confirm Password</label>
                    <div v-if="passwordMismatchError" class="text-warning">{{ passwordMismatchError }}</div>
                  </div>
                  <!-- Register button -->
                  <button type="submit" class="btn btn-warning">Register</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col col-sm-3">
            <!-- Right column content (if any) -->
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
export default {
  methods: {
    async register() {
      try {
        // Perform password and confirm password validation
        if (this.password !== this.confirmPassword) {
          this.passwordMismatchError = 'Passwords do not match';
          return; // Prevent form submission if passwords don't match
        }

        // // Construct form data
        // const formData = {
        //   first_name: this.firstName,
        //   last_name: this.lastName,
        //   email: this.email,
        //   phone_number: this.mobileNumber,
        //   password: this.password,
        //   address: this.address
        // };

        var formData = new FormData();
        formData.append('first_name', this.firstName)
        formData.append('last_name', this.lastName)
        formData.append('email', this.email)
        formData.append('phone_number', this.mobileNumber)
        formData.append('password', this.password)
        formData.append('address', this.address)

        // Send form data to the backend
        const response = await fetch('http://localhost:8080/register', {
          method: 'POST',
        //   headers: {
        //     'Content-Type': 'application/json'
        //   },
          body: formData
        });

        if (response.ok) {
          response.json().then((data) => {
                if(data.msg == 'Email already exist.')  {
                    this.emailExist = data.msg;
                }else{
                    this.$router.push({ name: 'Login' });
                }  
                
                    });
          // this.$router.push({ name: 'Login' });
        } else {
          // Registration failed
          console.error('Registration failed');
        }
      } catch (error) {
        console.error('Error:', error);
        // Handle error during registration
      }
    }
  },
  data() {
    return {
      firstName: '',
      lastName: '',
      email: '',
      mobileNumber: '',
      password: '',
      confirmPassword: '',
      address: '',
      passwordMismatchError: '',
      emailExist: ''
    };
  }
};
</script>