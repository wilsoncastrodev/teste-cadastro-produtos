export const setToken = (token) => localStorage.setItem('token', token);

export const getToken = () => localStorage.getItem('token');

export const clearToken = () => localStorage.setItem('token', '');

export const setUserCurrent = (user) => localStorage.setItem("user", JSON.stringify(user));

export const getUserCurrent = () => JSON.parse(JSON.parse(localStorage.getItem('user')));

export const clearUserCurrent = () => localStorage.setItem('user', null);

export const headers = {
  headers: {
    Authorization: `Bearer ${getToken()}`,
  },
}
