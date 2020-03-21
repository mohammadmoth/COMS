import axios from 'axios'
import Vue from 'vue'

// create an axios instance
const service = axios.create()

  // request interceptor
  service.interceptors.request.use(
    config => {
      // do something before request is sent

      if (Vue.auth.getToken()) {

        config.headers['Authorization'] = `Bearer ${Vue.auth.getToken()}`
        config.headers['X-CSRF-Token'] = window.csrfToken;


      }
      return config
    },
    error => {

      console.log(error)
      return Promise.reject(error)
    }
  )

  // response interceptor
  service.interceptors.response.use(
    response => {
      const res = response.data
      const status  = response.status

      if ( res.hasOwnProperty("error"))
          if (res.error==true)  {

            console.log('err ' + res.data  + "  status:" + status ) // for debug
            return Promise.reject(new Error(response))
          } else {
            return response;
          }
      return response;
    },
    error => {
        console.log(error.response.status );
       if ( error.response.status == 401  )
       Vue.auth.removeToken();

      console.log('err' + error) // for debug

      return Promise.reject(error)
    }

  )
export default service
