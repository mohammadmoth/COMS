import SendData from './service.js'


var rules = ["admin"]
var user = {};
export function login(data) {
    return SendData({
        url: '/api/login',
        method: 'post',
        data
    })
}

export function checkRules() {

    for (let index = 0; index < rules.length; index++)
        if (rules[index] == getUser().rules)
            return true
    return false
}

export function getall() {
    if (this.checkRules()) {
        return SendData({
            url: '/api/users',
            method: 'get', data: {}
        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}


export function RefreshUserInfo() {
    return SendData({
        url: '/api/details',
        method: 'post'
    }
    )
}


export function logout() {

}
export function init() {
    try {
        if (localStorage.user)
            user = JSON.parse(localStorage.user);
    } catch (error) {

    }



    this.initUserData();
}
export function getUser() {

    try {
        if (localStorage.user)
            user = JSON.parse(localStorage.user);
        else
            this.initUserData()
    } catch (error) {

    }




    return user;

}
export async function initUserData() {

    await this.RefreshUserInfo().then(function (response) {
        user = response.data.success;
        localStorage.user = JSON.stringify(user)
    }).catch(function (error) {
        console.log(error);
    });

    return user
}



export function index() {
    /* 'name' => 'required',
              'email' => 'required|email',
              'password' => 'required',
              'c_password' => 'required|same:password',*/
    if (this.checkRules()) {
        return SendData({
            url: '/api/users',
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
    if (this.checkRules()) {
        return SendData({
            url: '/api/users',
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
            url: '/api/users/'+   id,
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
    if (this.checkRules()) {
        return SendData({
            url: '/api/users/'+data.id,
            method: 'put',
            data
        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}
export function destroy(id) {
    /* id */
    if (this.checkRules()) {
        return SendData({
            url:  '/api/users/'+id,
            method: 'delete'
        })
    }

    return Promise.reject({ msg: "You_do_not_have_privileges_to_do_that", code: 0 })

}



