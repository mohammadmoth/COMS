import SendData from './api/SendData.js'

export function login(data) {
  return SendData({
    url: '/vue-element-admin/user/login',
    method: 'post',
    data
  })
}

export function getInfo(token) {
  return SendData({
    url: '/vue-element-admin/user/info',
    method: 'get',
    params: { token }
  })
}

export function logout() {
  return SendData({
    url: '/vue-element-admin/user/logout',
    method: 'post'
  })
}