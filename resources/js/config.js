import env from './env'

let apiRoot = `${env.domain}/api`

export default {
    routes: {
        researches: `${apiRoot}/researches`,
        holidays: `${apiRoot}/holidays`
    }
}