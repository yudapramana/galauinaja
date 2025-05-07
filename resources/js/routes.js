
export default [
  {
    path: '/landing',
    name: 'app.landing',
    component: () => import('./pages/Landing.vue'),
  },
  {
    path: '/login',
    name: 'app.login',
    component: () => import('./pages/auth/Login.vue'),
  },
  {
    path: '/admin',
    meta: { requiresAdmin: true },
    children: [
      {
        path: 'dashboard',
        name: 'admin.dashboard',
        component: () => import('./components/Dashboard.vue'),
      },
      {
        path: 'vervals',
        name: 'admin.vervals',
        component: () => import('./pages/vervals/VervalList.vue'),

      },
      {
        path: 'workunits',
        name: 'admin.workunits',
        component: () => import('./pages/workunits/WorkUnitList.vue'),
      },
      {
        path: 'reports',
        name: 'admin.reports',
        component: () => import('./pages/reports/ListReports.vue'),
      },
      {
        path: 'org-reports',
        name: 'admin.orgreports',
        component: () => import('./pages/org_reports/OrgReports.vue'),

      },
      {
        path: 'users',
        name: 'admin.users',
        component: () => import('./pages/users/UserList.vue'),
      },
      {
        path: 'users/:id/documents',
        name: 'admin.user.documents',
        component: () => import('./pages/docs/UserDocs.vue'),
      },
      {
        path: 'docusers',
        name: 'admin.doc.users',
        component: () => import('./pages/users/UserDocList.vue'),
      },
      {
        path: 'settings',
        name: 'admin.settings',
        component: () => import('./pages/settings/UpdateSetting.vue'),
      },
      {
        path: 'profile',
        name: 'admin.profile',
        component: () => import('./pages/profile/UpdateProfile.vue'),
      },
      {
        path: 'docprogress',
        name: 'admin.doc.progress',
        component: () => import('./pages/progress/DocProgress.vue'),
      },
    ],
  },
  {
    path: '/user',
    children: [
      {
        path: 'dashboard',
        name: 'user.dashboard',
        component: () => import('./components/UserDashboard.vue'),
      },
      {
        path: 'profile',
        name: 'user.profile',
        component: () => import('./pages/profile/UserProfile.vue'),
      },
      {
        path: 'docs',
        name: 'user.docs',
        component: () => import('./pages/docs/MyDocs.vue'),
      },
      {
        path: 'upload',
        name: 'user.upload',
        component: () => import('./pages/docs/UserUploadDoc.vue'),
      },
    ],
  },
];
