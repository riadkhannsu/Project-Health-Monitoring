
const routes = [
  {
    path: '/',
    component: () => import('layouts/SplashLayout.vue'),
    children: [
      { path: '', name: 'splash', component: () => import('pages/Splash.vue') },
      { path: 'login', name: 'login', component: () => import('pages/Login.vue') },
      { path: 'signup', name: 'signup', component: () => import('pages/Signup.vue') }
    ],
    meta: {
      guest: true
    }
  },
  {
    path: '/user',
    component: () => import('layouts/MyLayout.vue'),
    children: [
      { path: '', name: 'dash', component: () => import('pages/Dash.vue') },
      { path: '/docdash', name: 'docdash', component: () => import('pages/DoctorDash.vue') },
      { path: '/patient/:id', name: 'patient', component: () => import('pages/Patient.vue'), props: true },
      { path: '/diagnosis/:id', name: 'diagnosis', component: () => import('pages/Diagnosis.vue'), props: true },
      { path: '/prescription/:id', name: 'prescription', component: () => import('pages/Prescription.vue'), props: true },
      { path: '/patientdash', name: 'patientHome', component: () => import('pages/PatientDash.vue') },
      { path: '/addsession', name: 'session', component: () => import('pages/AddSession.vue') },
      { path: '/addproblem', name: 'problem', component: () => import('pages/AddProblem.vue') }
    ],
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/test',
    component: () => import('layouts/MyLayout.vue'),
    children: [
      { path: '', component: () => import('pages/Index.vue') }
    ],
    meta: {
      guest: true
    }
  }
]

// Always leave this as last one
if (process.env.MODE !== 'ssr') {
  routes.push({
    path: '*',
    component: () => import('pages/Error404.vue')
  })
}

export default routes
