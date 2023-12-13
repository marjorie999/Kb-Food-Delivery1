<template>
    <div class="card p-4">
        <h4>My Orders</h4>
    </div>
    <div class="container-md">
        <div class="row align-items-center text-center">
    <div class="col-2">
     <!--  -->
    </div>
    <div class="col-8">
        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Select</th>
      <th scope="col">All Orders</th>
      <th scope="col">Status</th>
      <th scope="col">Order Total</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row"><input type="checkbox" aria-label="Checkbox for following text input"></th>
      <td>3pc Burger</td>
      <td><span class="badge rounded-pill bg-success">Completed</span></td>
      <td>200.00</td>
      <td> <button class="btn btn-outline-warning" disabled>Order Received</button></td>
    </tr>
    <tr>
      <th scope="row"><input type="checkbox" aria-label="Checkbox for following text input"></th>
      <td>1pc Sisig</td>
      <td><span class="badge rounded-pill bg-success">Completed</span></td>
      <td>120.00</td>
      <td> <button class="btn btn-outline-warning" disabled>Order Received</button></td>
    </tr>
    <tr>
      <th scope="row"><input type="checkbox" aria-label="Checkbox for following text input"></th>
      <td>2pc Sisig</td>
      <td><span class="badge rounded-pill bg-warning">Pending</span></td>
      <td>450.00</td>
      <td> <button class="btn btn-outline-warning" >Order Received</button></td>
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