import SendData from './service.js'
import * as users  from './users.js'

let rules = ["monitor","editor" ,'admin']

export function checkRules(type = null) {
if ( type == null)
type = rules;

    for (let index = 0; index < type.length; index++)
        if (type[index] == users.getUser().rules)
            return true
    return false
}



export function index() {
    /* 'name' => 'required',
              'email' => 'required|email',
              'password' => 'required',
              'c_password' => 'required|same:password',*/
    if (this.checkRules()) {
        return SendData({
            url: '/api/hasfromsponsors',
            method: 'get'

        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}
export function store(data) {
    /* 'name' => 'required',
              'email' => 'required|email',
              'password' => 'required',
              'c_password' => 'required|same:password',*/
    if (this.checkRules( ["editor" ,'admin'])) {
        return SendData({
            url: '/api/hasfromsponsors',
            method: 'post',
            data
        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}
export function show(id) {
  /* id */
    if (this.checkRules()) {
        return SendData({
            url: '/api/hasfromsponsors/'+   id,
            method: 'get',
            data
        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}
export function update(data) {
    /*   'id' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'type' => 'required|string|max:255',*/
    if (this.checkRules( ["editor" ,'admin'])) {
        return SendData({
            url: '/api/hasfromsponsors/'+data.id,
            method: 'put',
            data
        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}
export function destroy(id) {
    /* id */
    if (this.checkRules( ["editor" ,'admin'] )) {
        return SendData({
            url:  '/api/hasfromsponsors/'+id,
            method: 'delete'
        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}