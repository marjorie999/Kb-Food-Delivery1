<template>
   
    <div class="p-4">
        <nav class="p-2" style="--bs-breadcrumb-divider: '>'; background-color: whitesmoke;" aria-label="breadcrumb">
            <div class="row">
                <div class="col-2">
                    <!--  -->
                </div>
                <div class="col-6">
                    <h4>Manage Users</h4>
                </div>
                <div class="col">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Users</li>
                    </ol>
                </div>
            </div>
</nav>
    </div>

    <div class="container-fluid">
        <div class="row align-items-center">
    <div class="col-2">
      <!--  -->
    </div>
    <div class="col-8" >
        <table class="table table-hover"  >
  <thead class="table-dark" >
    <tr >
      <th scope="col">#</th>
      <th scope="col" >Name</th>
      <th scope="col" >Address</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Role</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody v-for="(data, index) in user">
    <tr>
      <th  scope="row" >{{ index + 1 }}</th>
      <td> {{ data.first_name }} {{ data.last_name }}</td>
      <td>{{ data.address }}</td>
      <td>{{ data.email }}</td>
      <td>{{ data.phone_number}}</td>
      <td>{{ data.role}}</td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
        <button type="button" class="btn btn-warning">Edit</button>
        <button type="button" class="btn btn-danger">Delete</button>
        </div>
      
    </td>
      
    </tr>
  </tbody>
</table>
    </div>
    <div class="col-2">
      <!--  -->
    </div>
  </div>
    </div>
</template>


<script>

export default {
    data() {
    return {  
      user:[]
    };
  },
  methods: {
    fetchUserData() {
      fetch('http://localhost:8080/fetchUser', {
        method: "GET"
      })
        .then((response) => {
          response.json().then((data) => {
            this.user = data.data;
            console.log( this.user);
            
          });
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },
  beforeMount() {
 
    this.fetchUserData();
  }
   
}
</script>