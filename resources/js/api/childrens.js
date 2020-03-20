import SendData from './api/service.js'

export function login(data) {
  return SendData({
    url: '',
    method: 'post',
    data
  })
}
export function login(data) {
    return SendData({
      url: '',
      method: 'post',
      data
    })
  }
  

export function getInfo(token) {
  return SendData({
    url: '',
    method: 'get',
    params: { token }
  })
}

export function logout() {
  return SendData({
    url: '',
    method: 'post'
  })
}