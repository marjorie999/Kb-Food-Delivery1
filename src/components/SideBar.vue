<template>
               <div id="layoutSidenav_nav">
                   <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: rgb(164, 33, 13);">
                       <div class="sb-sidenav-menu">
                           <div class="nav">
                               <div class="sb-sidenav-menu-heading">Home</div>
                               <a class="nav-link" href="index.html">
                                   <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                   Dashboard
                               </a>
                               <div class="sb-sidenav-menu-heading">Pages</div>
                                   <router-link to="/manage_order" exact-path class="nav-link" active-class="active">Orders</router-link>
                                   <router-link to="/manage_menu" exact-path class="nav-link" active-class="active">Menu</router-link>
                                    <router-link to="/manage_users" exact-path class="nav-link" active-class="active">Users</router-link>
                                </div>
                       </div>
                       
                   </nav>
               </div>
   </template>
   