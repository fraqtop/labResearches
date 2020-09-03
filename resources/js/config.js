let apiRoot = `${window.location.origin}/api`
export default {
  routes: {
    apiRoot: apiRoot,
    csrf: `${window.location.origin}/sanctum/csrf-cookie`,
    login: `${window.location.origin}/login`,
    analyses: `${apiRoot}/analyses`,
    genes: `${apiRoot}/genes`,
    patients: `${apiRoot}/patients`,
    users: `${apiRoot}/users`,
    institutions: `${apiRoot}/institutions`,
    materials: `${apiRoot}/materials`,
    payTypes: `${apiRoot}/pay-types`,
    researches: `${apiRoot}/researches`,
    analysisTypes: `${apiRoot}/analysis-types`,
    holidays: `${apiRoot}/holidays`
  },
  defaultMessages: {
    '404': 'Не найдено',
    '403': 'Нет прав доступа',
    '500': 'Внутренняя ошибка сервера'
  },
  datetimeFormat: 'YYYY-MM-DD'
}