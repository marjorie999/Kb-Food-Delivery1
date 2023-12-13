import { createRouter, createWebHistory } from "vue-router";
import Home from '../views/users/Home.vue'
import About from '../views/About.vue'
import Menu from '../views/users/Menu.vue'
import Login from '../views/auth/Login.vue'
import Register from '../views/auth/Register.vue'
import PlaceOrder from '../views/users/PlaceOrder.vue'
import Orders from '../views/admin/Orders.vue'
import UserOrders from '../views/users/UserOrders.vue'
import AdminMenu from '../views/admin/AdminMenu.vue'
import WaitingPage from '../views/users/WaitingPage.vue'
import PageNotFound from '../views/404NotFound.vue'
import OrderReceived from '../views/users/OrderReceived.vue'
import CreateFood from '../views/admin/CreateFood.vue'
import EditFood from '../views/admin/EditFood.vue'
import ManageUser from '../views/admin/ManageUser.vue'

const router =createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/', name: 'Home', component: Home, meta: { requiresAuth: true,  role: 'user'}},
        {path: '/menu', name: 'Menu', component: Menu, meta: { requiresAuth: true, role: 'user'}},
        {path: '/orderReceived', name: 'OrderReceived', component: OrderReceived, meta: { requiresAuth: true, role: 'user'}},
        {path: '/login', name: 'Login', component: Login},
        {path: '/register', name: 'Register', component: Register},
        {path: '/place_order/:id', name: 'PlaceOrder', component: PlaceOrder, meta: { requiresAuth: true, role: 'user'}},
        {path: '/manage_order', name: 'Orders', component: Orders, meta: { requiresAuth: true ,role: 'admin'}},
        {path: '/manage_users', name: 'ManageUser', component: ManageUser, meta: { requiresAuth: true ,role: 'admin'}},
        {path: '/my_order', name: 'UserOrders', component: UserOrders, meta: { requiresAuth: true ,role: 'admin'}},
        {path: '/manage_menu', name: 'AdminMenu', component: AdminMenu, meta: { requiresAuth: true ,role: 'admin'}},
        {path: '/create_menu', name: 'CreateFood', component: CreateFood, meta: { requiresAuth: true ,role: 'admin'}},
        {path: '/edit_menu', name: 'EditFood', component: EditFood, meta: { requiresAuth: true ,role: 'admin'}},
        {path: '/waiting_order/:id', name: 'WaitingPage', component: WaitingPage, meta: { requiresAuth: true , role: 'user'}},
        {path: '/page_not_found', name: 'PageNotFound', component: PageNotFound},
    ]
})

router.beforeEach((to, from, next) => {
    let isAuthenticated = false;
    let userRole; 

    if(localStorage.getItem('isLoggedIn') != null){
        isAuthenticated = true
    }

    if(localStorage.getItem('role') != null){
        userRole = localStorage.role;
    }
    
    if (to.name === 'Login' && isAuthenticated || to.name === 'register' && isAuthenticated) {
        // If user is authenticated and trying to access login, redirect elsewhere
        next({ name: 'Home' }); // Redirect to dashboard or another route
    } else if (to.matched.some(record => record.meta.requiresAuth)) {
      // Route requires authentication
      if (!isAuthenticated) {
        // If not authenticated, redirect to login
        next({ name: 'Login' });
      } else {
        // Check if route has role requirements
        const requiredRole = to.meta.role; // Define role needed for route (e.g., 'user' or 'admin')
        
        if (requiredRole && userRole !== requiredRole) {
            // If user role does not match required role for the route, redirect to unauthorized page or default route
            next({ name: 'PageNotFound ' }); // Redirect to an unauthorized page or default route
        } else {
            // If authenticated and role matches, proceed to the route
            next();
        }
      }
    } else {
      // If the route doesn't require authentication, proceed
      next();
    }
  });

export default router;