import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import PatientDashboard from "../views/patient/PatientDashboard.vue"
import DoctorDashboard from "../views/doctor/DoctorDashboard.vue"
import Surveys from "../views/Surveys.vue";
import SurveyView from "../views/SurveyView.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import GroupAdminRegister from "../views/GroupAdminRegister.vue"
import NotFound from "../views/NotFound.vue";
import SurveyPublicView from "../views/SurveyPublicView.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";
import PatientProfile from "../views/patient/PatientProfile.vue"
import FindUs from "../views/patient/FindUs.vue"
import FindDoctor from "../views/patient/FindDoctor.vue"
import MedicalHistory from "../views/patient/MedicalHistory.vue"
import MyPrescription from "../views/patient/MyPrescription.vue"
import GroupAdminDashboard from "../views/group_admin/GroupAdminDashboard.vue"
import GroupAdminDefaultLayout from "../components/GroupAdminDefaultLayout.vue"
import GroupAdminCreateAccount from "../views/group_admin/GroupAdminCreateAccount.vue"
import PatientMakeAppointment from "../views/patient/PatientMakeAppointment.vue"
import MyAppointment from "../views/patient/MyAppointment.vue"
import PatientEditProfile from"../views/patient/PatientEditProfile.vue"
import ViewArticle from "../views/patient/ViewArticle.vue"
import MedicalAdminDefaultLayout from "../components/MedicalAdminDefaultLayout.vue"
import MedicalAdminCreateNewsArticle from "../views/medical_admin/MedicalAdminCreateNewsArticle.vue"
import MedicalAdminDashboard from "../views/medical_admin/MedicalAdminDashboard.vue"
import GroupAdminCreateInstitute from "../views/group_admin/GroupAdminCreateInstitute.vue"
import GroupAdminCreateSpecialty from "../views/group_admin/GroupAdminCreateSpecialty.vue"
import GroupAdminManageAccount from "../views/group_admin/GroupAdminManageAccount.vue"
import GroupAdminEditAccount from "../views/group_admin/GroupAdminEditAccount.vue"
import GroupAdminManageSpecialty from "../views/group_admin/GroupAdminManageSpecialty.vue"
import GroupAdminEditSpecialty from "../views/group_admin/GroupAdminEditSpecialty.vue"
import GroupAdminManageInstitute from "../views/group_admin/GroupAdminManageInstitute.vue"
import GroupAdminEditInstitute from "../views/group_admin/GroupAdminEditInstitute.vue"
import DoctorDefaultLayout from "../components/DoctorDefaultLayout.vue";
import ViewDoctorProfile from "../views/patient/ViewDoctorProfile.vue";
import DoctorManageSchedule from "../views/doctor/DoctorManageSchedule.vue";
import DoctorManageAppointments from "../views/doctor/DoctorManageAppointments.vue"
import DoctorViewPatient from "../views/doctor/DoctorViewPatient.vue"
import DoctorViewAppointment from "../views/doctor/DoctorViewAppointment.vue"
import NurseDefaultLayout from "../components/NurseDefaultLayout.vue"
import NurseDashboard from "../views/nurse/NurseDashboard.vue"
import NurseManageDoctor from "../views/nurse/NurseManageDoctor.vue"
import NurseManagePatientAndAppointments from "../views/nurse/NurseManagePatientAndAppointments.vue"
import NurseViewAppointment from "../views/nurse/NurseViewAppointment.vue"
import NurseViewPatient from "../views/nurse/NurseViewPatient.vue"
import MedicalAdminManageEducationalMaterial from "../views/medical_admin/MedicalAdminManageEducationalMaterial.vue"
import MedicalAdminEditMaterial from "../views/medical_admin/MedicalAdminEditMaterial.vue"
import MedicalAdminEditProfile from "../views/medical_admin/MedicalAdminEditProfile.vue"
import DoctorProfile from "../views/doctor/DoctorProfile.vue"
import DoctorEditProfile from "../views/doctor/DoctorEditProfile.vue"

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
    { path: "/find-doctor", name: "FindDoctor", component: FindDoctor },
    { path: "/medical-history", name: "MedicalHistory", component: MedicalHistory },
    { path: "/my-prescription", name: "MyPrescription", component: MyPrescription },
    { path: "/my-appointment", name: "MyAppointment", component: MyAppointment },
    { path: "/patient-make-appointment", name: "PatientMakeAppointment", component: PatientMakeAppointment },
    { path: "/patient-edit-profile", name: "PatientEditProfile", component: PatientEditProfile },
    { path: "/patient-view-article", name: "ViewArticle", component: ViewArticle },
    { path: "/patient-view-doctor-profile", name: "ViewDoctorProfile", component: ViewDoctorProfile },
    { path: "/surveys", name: "Surveys", component: Surveys },
    { path: "/surveys/create", name: "SurveyCreate", component: SurveyView },
    { path: "/surveys/:id", name: "SurveyView", component: SurveyView },
  ],
},
{
  path: "/d",
  redirect: "/doctor-dashboard",
  component: DoctorDefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/doctor-dashboard", name: "DoctorDashboard", component: DoctorDashboard },
    { path: "/doctor-manage-schedule", name: "DoctorManageSchedule", component: DoctorManageSchedule },
    { path: "/doctor-manage-appointments", name: "DoctorManageAppointments", component: DoctorManageAppointments },
    { path: "/doctor-view-patient", name: "DoctorViewPatient", component: DoctorViewPatient },
    { path: "/doctor-view-appointment", name: "DoctorViewAppointment", component: DoctorViewAppointment},
    { path: "/doctor-view-profile", name: "DoctorProfile", component: DoctorProfile},
    { path: "/doctor-edit-profile", name: "DoctorEditProfile", component: DoctorEditProfile},
  ],
},

{
  path: "/n",
  redirect: "/nurse-dashboard",
  component: NurseDefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/nurse-dashboard", name: "NurseDashboard", component: NurseDashboard },
    { path: "/nurse-manage-doctor", name: "NurseManageDoctor", component: NurseManageDoctor },
    { path: "/nurse-manage-patient-and-appointments", name: "NurseManagePatientAndAppointments", component: NurseManagePatientAndAppointments },
    { path: "/nurse-view-appointment", name: "NurseViewAppointment", component: NurseViewAppointment },
    { path: "/nurse-view-patient", name: "NurseViewPatient", component: NurseViewPatient },
  ],
},
{
  path: "/m",
  redirect: "/medical-admin-dashboard",
  component: MedicalAdminDefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/medical-admin-dashboard", name: "MedicalAdminDashboard", component: MedicalAdminDashboard },
    { path: "/medical-admin-create-news-article", name: "MedicalAdminCreateNewsArticle", component: MedicalAdminCreateNewsArticle },
    { path: "/medical-admin-manage-educational", name: "MedicalAdminManageEducationalMaterial", component: MedicalAdminManageEducationalMaterial },
    { path: "/medical-admin-edit-material", name: "MedicalAdminEditMaterial", component: MedicalAdminEditMaterial },
    { path: "/medical-admin-edit-profile", name: "MedicalAdminEditProfile", component: MedicalAdminEditProfile },
  ],
},
{
  path: "/g",
  redirect: "/group-admin/dashboard",
  component: GroupAdminDefaultLayout,
  meta: { requiresAuth: true },
  children: [
    { path: "/group-admin/dashboard", name: "GroupAdminDashboard", component: GroupAdminDashboard },
    { path: "/group-admin/create-account", name: "GroupAdminCreateAccount", component: GroupAdminCreateAccount },
    { path: "/group-admin/create-institute", name: "GroupAdminCreateInstitute", component: GroupAdminCreateInstitute },
    { path: "/group-admin/create-specialty", name: "GroupAdminCreateSpecialty", component: GroupAdminCreateSpecialty },
    { path: "/group-admin/manage-account", name: "GroupAdminManageAccount", component: GroupAdminManageAccount },
    { path: "/group-admin/edit-account", name: "GroupAdminEditAccount", component: GroupAdminEditAccount },
    { path: "/group-admin/manage-specialty", name: "GroupAdminManageSpecialty", component: GroupAdminManageSpecialty },
    { path: "/group-admin/edit-specialty", name: "GroupAdminEditSpecialty", component: GroupAdminEditSpecialty },
    { path: "/group-admin/manage-institute", name: "GroupAdminManageInstitute", component: GroupAdminManageInstitute },
    { path: "/group-admin/edit-institute", name: "GroupAdminEditInstitute", component: GroupAdminEditInstitute },
    
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
    {
      path: "/registerAdmin/:subType",
      name: "GroupAdminRegister",
      component: GroupAdminRegister,
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
    next({ name: "PatientDashboard" });
  } else {
    next();
    
  }
});

export default router;
