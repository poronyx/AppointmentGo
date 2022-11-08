import { createStore } from "vuex";
import axiosClient from "../axios";

const store = createStore({
  state: {
    user: {
      data: {},
      token: sessionStorage.getItem("TOKEN"),
      createData: {
        address: {},
        qualifications: {},
        specialty: {},
        instituition: {}

      }
    },
    patientMakeAppointment: {
      doctorsFromInstitute: [],
      doctorsFromSpecialty: [],
      makeAppointmentData: {
        "appointment_type": "on-site",
      },
      slotAvailability: []
    },
    patientFindDoctor: {
      allDoctors: [],
      viewDoctorData: {}
    },
    patientProfile: {
      userID: {},
      appointments: [],
      medicalHistories: [],
    }
    ,
    material: {
      loading: false,
      data: {},
      slides: []
    },
    institute: {
      loading: false,
      data: {},
      instituition_list: [],
      dataSlot: {},
      deleteData: {},
      editData: {}
    },
    specialty: {
      data: {},
      specialty_list: [],
      editData: {},
      deleteData: {}
    },
    groupAdminManageAccount: {
      loading: false,
      user_list: [],
      deleteData: {},
      suspendData: {},
      editData: {}
    },
    groupAdminManageInstitute: {
      loading: false,
      time_slot1: [],
      time_slot2: [],
      time_slot3: [],
      time_slot4: [],
    },
    doctorDashBoard: {
      events: []
    },
    doctorManageAppointments: {
      appointmentsData: [],
      allPatientData: [],
      viewPatientData: {},
      viewAppointmentData: {}
    },
    dashboard: {
      loading: false,
      data: {}
    },
    surveys: {
      loading: false,
      links: [],
      data: []
    },
    currentSurvey: {
      data: {},
      loading: false,
    },
    questionTypes: ["text", "select", "radio", "checkbox", "textarea"],
    notification: {
      show: false,
      type: 'success',
      message: ''
    }
  },
  getters: {
    getInstituteById: (state) => (id) => {
      return state.institute.instituition_list.find(institute => institute.id === id)
    },
    getUserID: (state) => {
      return state.user.data.id
    }
  },
  actions: {

    register({ commit }, user) {
      return axiosClient.post('/register', user)
        .then(({ data }) => {
          commit('setUser', data.user);
          commit('setToken', data.token)
          console.log(data)
          return data;
        })
    },
    registerForAll(_, user) {
      return axiosClient.post('/register', user)
        .then((res) => {
          console.log("After Admin Create Account", res.data.user)
          return res.data.user;
        })
    },
    login({ commit }, user) {
      return axiosClient.post('/login', user)
        .then(({ data }) => {
          commit('setUser', data.user);
          commit('setToken', data.token)
          return data;
        })
    },
    logout({ commit }) {
      return axiosClient.post('/logout')
        .then(response => {
          commit('logout')
          return response;
        })
    },
    getMaterialData({ commit }) {
      commit('materialLoading', true)
      return axiosClient.get(`/material/get`)
        .then((res) => {
          commit('materialLoading', false)
          commit('setMaterialData', res.data.material)

          return res;
        })
        .catch(error => {
          commit('materialLoading', false)
          return error;
        })

    },
    createMaterial({ commit }, material) {
      return axiosClient.post('/material/create', material)
        .then(({ data }) => {
          commit('addMaterial', data.material)
        })
    },
    getInstituteData({ commit }) {
      commit('instituteLoading', true)
      return axiosClient.get(`/institute/get`)
        .then((res) => {
          commit('instituteLoading', false)
          commit('setInstituteData', res.data.institutes)

          return res;
        })
        .catch(error => {
          commit('materialLoading', false)
          return error;
        })

    },
    createInstitute({ commit }, input) {
      console.log("PayLoad: ", input)
      return axiosClient.post('/institute/create', input)
        .then(({ data }) => {
          commit('addInstitute', data.institute)


        })
    },
    updateInstitute(_, input) {
      console.log("PayLoad: ", input)
      return axiosClient.post('/institute/update', input)
        .then(() => {


        })
    },
    deleteInstitute({ commit }, input) {
      console.log("PayLoad: ", input)
      return axiosClient.post(`/institute/delete`, input)
        .then((res) => {
          console.log("Response from API: ", res)
          commit('setInstituteForDelete', res.data)
          console.log("After Delete in Store res: ", res.data)
          return res;
        })

    },
    //Generate Slots
    generateSlots(_, input) {
      console.log("PayLoad: ", input)
      return axiosClient.post('/institute/generateSlots', input)
        .then((res) => {
          console.log(res);
        })
    },
    getUser({ commit }) {
      return axiosClient.get('/user')
        .then(res => {
          console.log(res);
          commit('setUser', res.data)
        })
    },
    //Group Admin Manage Account 
    getAllUsersData({ commit }) {
      commit('manageAccountLoading', true)
      return axiosClient.get(`/users/getAll`)
        .then((res) => {
          commit('manageAccountLoading', false)
          commit('setAllUsersData', res.data.users)

          return res;
        })
        .catch(error => {
          commit('materialLoading', false)
          return error;
        })

    },
    deleteUser({ commit }, input) {
      return axiosClient.post(`/users/deleteUser`, input)
        .then((res) => {
          commit('setUserDeleteData', res.data)
          console.log("After Delete in Store res: ", res.data)
          return res;
        })

    },
    suspendUser({ commit }, input) {
      return axiosClient.post(`/users/suspendUser`, input)
        .then((res) => {
          commit('setUserSuspendData', res.data)
          console.log("After Suspend in Store res: ", res.data)
          return res;
        })

    },
    unSuspendUser({ commit }, input) {
      return axiosClient.post(`/users/unSuspendUser`, input)
        .then((res) => {
          commit('setUserSuspendData', res.data)
          console.log("After Suspend in Store res: ", res.data)
          return res;
        })

    },
    updateUser({ commit }, input) {
      return axiosClient.post(`/users/updateUser`, input)
        .then((res) => {
          commit('setUserForEdit', res.data)
          console.log("After Update User in Store res: ", res.data)
          return res;
        })

    },
    //For User's appointment page 
    getDoctorsFromInstitute({ commit }, input) {
      return axiosClient.post(`/patient/getDoctorsFromInstitute`, input)
        .then((res) => {
          commit('setDoctorsFromInstitute', res.data)
          console.log("Res Doctor from inst", res.data)
          return res.data;
        })

    },
    getDoctorsFromSpecialty({ commit }, input) {
      return axiosClient.post(`/patient/getDoctorsFromSpecialty`, input)
        .then((res) => {
          commit('setDoctorsFromSpecialty', res.data)
          console.log("Res Doctor from Specialty", res.data)
          return res.data;
        })

    },
    getAllDoctors({ commit }) {
      return axiosClient.get(`/patient/getDoctors`)
        .then((res) => {
          commit('setAllDoctorsData', res.data)
          console.log("All Doctors: ", res)

        })
        .catch(error => {
          return error;
        })

    },
    //Get availability
    getAvailabilityData(_, input) {
      console.log("After Picked Date data", input)
      return axiosClient.post(`/patient/getDoctorAvailability`, input)
        .then((res) => {
          console.log(res)
          return res;
        })
        .catch(error => {
          return error;
        })

    },
    //Patient Profile Page
    getAppointmentData({ commit }, input) {
      return axiosClient.post(`/appointment/patientGetAppointments`, input)
        .then((res) => {
          commit('setAppointmentData', res.data.appointments)
          return res;
        })
        .catch(error => {
          return error;
        })
    },
    //For Doctor's page
    getEventData(_, input) {
      return axiosClient.post(`/appointment/getDoctor`, input)
        .then((res) => {
          console.log(res)
          return res;
        })
        .catch(error => {
          return error;
        })
    },
    //Patient Profile Page
    getAppointmentDataDoctor({ commit }, input) {
      return axiosClient.post(`/appointment/doctorGetAppointments`, input)
        .then((res) => {
          commit('setAppointmentDataDoctor', res.data.appointments)
          return res;
        })
        .catch(error => {
          return error;
        })
    },

    getAllPatientData({ commit }) {
      return axiosClient.get(`/doctor/getPatients`)
        .then((res) => {
          commit('setAllPatientData', res.data.patients)
          return res;
        })
        .catch(error => {
          return error;
        })
    },
    //Group Admin Manage Specialty
    getSpecialtyData({ commit }) {
      return axiosClient.get(`/specialty/get`)
        .then((res) => {
          commit('setSpecialtyData', res.data.specialties)

          return res;
        })
        .catch(error => {
          return error;
        })

    },
    updateSpecialty({ commit }, input) {
      return axiosClient.post(`/specialty/update`, input)
        .then((res) => {
          commit('setSpecialtyForEdit', res.data)
          console.log("After Update Specialty in Store res: ", res.data)
          return res;
        })

    },
    createSpecialty({ commit }, input) {
      console.log("PayLoad: ", input)
      return axiosClient.post('/specialty/create', input)
        .then(({ data }) => {
          commit('addSpecialty', data.specialty)
        })
    },
    deleteSpecialty({ commit }, input) {
      console.log("PayLoad: ", input)
      return axiosClient.post(`/specialty/delete`, input)
        .then((res) => {
          console.log("Response from API: ", res)
          commit('setSpecialtyForDelete', res.data)
          console.log("After Delete in Store res: ", res.data)
          return res;
        })

    },
    makeAppointment(_, input) {
      console.log("appointment data before API", input)
      return axiosClient.post(`/appointment/create`, input)
        .then((res) => {
          console.log("Res from making Appointment", res)

          return res;
        })
        .catch(error => {
          return error;
        })

    },
    getDashboardData({ commit }) {
      commit('dashboardLoading', true)
      return axiosClient.get(`/dashboard`)
        .then((res) => {
          commit('dashboardLoading', false)
          commit('setDashboardData', res.data)
          return res;
        })
        .catch(error => {
          commit('dashboardLoading', false)
          return error;
        })

    },
    getSurveys({ commit }, { url = null } = {}) {
      commit('setSurveysLoading', true)
      url = url || "/survey";
      return axiosClient.get(url).then((res) => {
        commit('setSurveysLoading', false)
        commit("setSurveys", res.data);
        return res;
      });
    },
    getSurvey({ commit }, id) {
      commit("setCurrentSurveyLoading", true);
      return axiosClient
        .get(`/survey/${id}`)
        .then((res) => {
          commit("setCurrentSurvey", res.data);
          commit("setCurrentSurveyLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentSurveyLoading", false);
          throw err;
        });
    },
    getSurveyBySlug({ commit }, slug) {
      commit("setCurrentSurveyLoading", true);
      return axiosClient
        .get(`/survey-by-slug/${slug}`)
        .then((res) => {
          commit("setCurrentSurvey", res.data);
          commit("setCurrentSurveyLoading", false);
          return res;
        })
        .catch((err) => {
          commit("setCurrentSurveyLoading", false);
          throw err;
        });
    },
    saveSurvey({ commit, dispatch }, survey) {

      delete survey.image_url;

      let response;
      if (survey.id) {
        response = axiosClient
          .put(`/survey/${survey.id}`, survey)
          .then((res) => {
            commit('setCurrentSurvey', res.data)
            return res;
          });
      } else {
        response = axiosClient.post("/survey", survey).then((res) => {
          commit('setCurrentSurvey', res.data)
          return res;
        });
      }

      return response;
    },
    deleteSurvey({ dispatch }, id) {
      return axiosClient.delete(`/survey/${id}`).then((res) => {
        dispatch('getSurveys')
        return res;
      });
    },
    saveSurveyAnswer({ commit }, { surveyId, answers }) {
      return axiosClient.post(`/survey/${surveyId}/answer`, { answers });
    },
  },
  mutations: {
    logout: (state) => {
      state.user.token = null;
      state.user.data = {};
      sessionStorage.removeItem("TOKEN");
    },

    setUser: (state, user) => {
      state.user.data = user;
      state.patientMakeAppointment.makeAppointmentData.patient_id = user.id
      state.patientMakeAppointment.patientProfile = user.id
    },
    setUserCreate: (state, user) => {
      state.user.createData = user;
    },
    setToken: (state, token) => {
      state.user.token = token;
      sessionStorage.setItem('TOKEN', token);
    },
    addMaterial: (state, material) => {
      state.user.data = material;
    },
    setMaterialData: (state, data) => {
      state.material.data = data
      const imageList = []
      for (let x in data) {
        imageList.push(data[x].image_url)
      }
      state.material.slides = imageList
    },
    setDoctorsFromInstitute: (state, data) => {
      console.log("Setting Data into doctr after institute is set : ", data.doctors)
      state.patientMakeAppointment.doctorsFromInstitute = data.doctors
      state.patientMakeAppointment.doctorsFromInstitute.push({
        name: "--Not Specified--",
        id: "NA"
      })
    },
    setDoctorsFromSpecialty: (state, data) => {
      console.log("Setting Data into doctr after specialty is set : ", data.doctors)
      state.patientMakeAppointment.doctorsFromSpecialty = data.doctors
    },
    addInstitute: (state, institute) => {
      state.institute.data = institute;
    },
    setInstituteData: (state, data) => {
      console.log("All Institutes : ", data)
      state.institute.instituition_list = data
    },
    setAppointmentData: (state, data) => {
      console.log("All Institutes : ", data)
      state.patientProfile.appointments = data
    },
    setAppointmentDataDoctor: (state, data) => {
      console.log("All Institutes : ", data)
      state.doctorManageAppointments.appointmentsData = data
    },
    setAllPatientData: (state, data) => {
      console.log("All Patients : ", data)
      state.doctorManageAppointments.allPatientData = data
    },
    setInstituteForDelete: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.institute.deleteData = data
    },

    setUserDeleteData: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.groupAdminManageAccount.deleteData = data;
    },
    setUserSuspendData: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.groupAdminManageAccount.suspendData = data;
    },
    setDoctorDashBoardData: (state, data) => {
      console.log("Inside Mutations: ", data.appointments)
      const dataList = []
      let i = 0
      for (let x in data.appointments) {
        if (data.appointments[x].appointment_type == "off-day") {
          dataList.push({
            start: data.appointments[x].appointment_date,
            end: data.appointments[x].appointment_date,
            title: 'Day off!',
            content: '<br> \u00A0Take a break, You deserve it!</div>',
            class: 'new-event',
            allDay: true
          })

        } else {
          console.log("X = ", x)
          console.log("Inside Loop", data.appointments[x])
          let startTime = data.appointments[x].time
          let endTime = parseInt(data.appointments[x].time) + 1
          dataList.push({
            start: data.appointments[x].appointment_date + " " + toHoursAndMinutes(startTime * 15),
            end: data.appointments[x].appointment_date + " " + toHoursAndMinutes(endTime * 15),
            title: data.appointments[x].appointment_type + "<br> \u00A0",
            class: data.appointments[x].appointment_type,
            appointment_id: data.appointments[x].id
          })
        }
      }

      console.log("Data LIST", dataList)

      state.doctorDashBoard.events = dataList
    },
    addSpecialty: (state, specialty) => {
      state.specialty.data = specialty;
    },
    setSpecialtyData: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.specialty.specialty_list = data
    },
    setSpecialtyForDelete: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.specialty.deleteData = data
    },
    setSpecialtyForEdit: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.specialty.editData = data
    },
    setInstituteForEdit: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.institute.editData = data
      state.institute.editData.timeChanged = false;
    },
    setAvailableSlots: (state, data) => {
      console.log("Inside Mutations: ", data)
      const timeSlots = []
      for (let x in data) {
        let minutes = data[x] * 15
        timeSlots.push({
          key: data[x],
          time: toHoursAndMinutes(minutes),
        });
      }
      state.patientMakeAppointment.slotAvailability = timeSlots
    },
    setAllUsersData: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.groupAdminManageAccount.user_list = data
    },
    setAllDoctorsData: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.patientFindDoctor.allDoctors = data.doctors
    },
    setDoctorForView: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.patientFindDoctor.viewDoctorData = data
    },
    setUserForEdit: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.groupAdminManageAccount.editData = data
    },
    setPatientForView: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.doctorManageAppointments.viewPatientData = data
    },
    setAppointmentForManage: (state, data) => {
      console.log("Inside Mutations: ", data)
      state.doctorManageAppointments.viewAppointmentData = data
    },
    setTimeSlotForCreateInstitute1: (state) => {
      const timeSlots = []
      for (let x = 1; x <= 96; x++) {
        let minutes = x * 15
        timeSlots.push({
          key: x,
          time: toHoursAndMinutes(minutes),
        });
      }
      console.log(timeSlots)

      state.groupAdminManageInstitute.time_slot1 = timeSlots

    },
    setTimeSlotForCreateInstitute2: (state, input) => {

      const timeSlots = []
      for (let x = input + 1; x <= 96; x++) {
        let minutes = x * 15
        timeSlots.push({
          key: x,
          time: toHoursAndMinutes(minutes),
        });
      }
      state.groupAdminManageInstitute.time_slot2 = timeSlots

    },
    setTimeSlotForCreateInstitute3: (state, input) => {

      const timeSlots = []
      for (let x = input + 1; x <= 96; x++) {
        let minutes = x * 15
        timeSlots.push({
          key: x,
          time: toHoursAndMinutes(minutes),
        });
      }
      state.groupAdminManageInstitute.time_slot3 = timeSlots

    },
    setTimeSlotForCreateInstitute4: (state, input) => {

      const timeSlots = []
      for (let x = input + 1; x <= 96; x++) {
        let minutes = x * 15
        timeSlots.push({
          key: x,
          time: toHoursAndMinutes(minutes),
        });
      }
      state.groupAdminManageInstitute.time_slot4 = timeSlots

    },
    materialLoading: (state, loading) => {
      state.material.loading = loading;
    },
    instituteLoading: (state, loading) => {
      state.institute.loading = loading;
    },
    manageAccountLoading: (state, loading) => {
      state.groupAdminManageAccount.loading = loading;
    },

    dashboardLoading: (state, loading) => {
      state.dashboard.loading = loading;
    },
    setDashboardData: (state, data) => {
      state.dashboard.data = data
    },
    setSurveysLoading: (state, loading) => {
      state.surveys.loading = loading;
    },
    setSurveys: (state, surveys) => {
      state.surveys.links = surveys.meta.links;
      state.surveys.data = surveys.data;
    },
    setCurrentSurveyLoading: (state, loading) => {
      state.currentSurvey.loading = loading;
    },
    setCurrentSurvey: (state, survey) => {
      state.currentSurvey.data = survey.data;
    },
    notify: (state, { message, type }) => {
      state.notification.show = true;
      state.notification.type = type;
      state.notification.message = message;
      setTimeout(() => {
        state.notification.show = false;
      }, 3000)
    },
  },
  modules: {

  },
});

function toHoursAndMinutes(totalMinutes) {
  const minutes = totalMinutes % 60;
  const hours = Math.floor(totalMinutes / 60);

  return `${padTo2Digits(hours)}:${padTo2Digits(minutes)}`;
}

function padTo2Digits(num) {
  return num.toString().padStart(2, '0');
}

export default store;
