let apiRoot = `${window.location.origin}/api`
export default {
  routes: {
    apiRoot: apiRoot,
    csrf: `${window.location.origin}/sanctum/csrf-cookie`,
    login: `${window.location.origin}/login`,
    analyses: `${apiRoot}/analyses`,
    genes: `${apiRoot}/genes`
  },
  datetimeFormat: 'YYYY-MM-DD'
}