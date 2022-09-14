import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import PatientDashboard from "../views/patient/PatientDashboard.vue"
import DoctorDashboard from "../views/doctor/DoctorDashboard.vue"
import MedicalAdminDashboard from "../views/medicaladmin/MedicalAdminDashboard.vue"
import NurseDashboard from "../views/nurse/NurseDashboard.vue"
import Calendar from "../views/nurse/Calendar.vue"
import Surveys from "../views/Surveys.vue";
import SurveyView from "../views/SurveyView.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import NotFound from "../views/NotFound.vue";
import SurveyPublicView from "../views/SurveyPublicView.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";
import PatientProfile from "../views/patient/PatientProfile.vue"
import FindUs from "../views/patient/FindUs.vue"

let routes = [{
  path: "/",
  redirect: "/patient-dashboard",
  component: DefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/dashboard", name: "Dashboard", component: Dashboard },
    { path: "/patient-dashboard", name: "PatientDashboard", component: PatientDashboard },
    { path: "/patient-profile", name: "PatientProfile", component: PatientProfile },
    { path: "/find-us", name: "FindUs", component: FindUs },
    { path: "/doctor-dashboard", name: "DoctorDashboard", component: DoctorDashboard },
    { path: "/nurse-dashboard", name: "NurseDashboard", component: NurseDashboard },
    { path: "/calendar", name: "Calendar", component: Calendar },
    { path: "/medicaladmin-dashboard", name: "MedicalAdminDashboard", component: MedicalAdminDashboard },
    { path: "/surveys", name: "Surveys", component: Surveys },
    { path: "/surveys/create", name: "SurveyCreate", component: SurveyView },
    { path: "/surveys/:id", name: "SurveyView", component: SurveyView },
  ],
},
{
  path: "/view/survey/:slug",
  name: 'SurveyPublicView',
  component: SurveyPublicView
},
{
  path: "/auth",
  redirect: "/login",
  name: "Auth",
  component: AuthLayout,
  meta: { isGuest: true },
  children: [
    {
      path: "/login",
      name: "Login",
      component: Login,
    },
    {
      path: "/register",
      name: "Register",
      component: Register,
    },
  ],
},
{
  path: '/404',
  name: 'NotFound',
  component: NotFound
}];



const router = createRouter({
  history: createWebHistory(),
  routes,
});


router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.user.token) {
    next({ name: "Login" });
  } else if (store.state.user.token && to.meta.isGuest) {
    next({ name: "Dashboard" });
  } else {
    next();
  }
});

export default router;
