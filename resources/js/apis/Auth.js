import { getToken, setToken, clearToken, setUserCurrent, clearUserCurrent } from '../services/api';

const Auth = {
  login(form, router) {
    return axios.post('/api/login', form)
                .then((response) => {
                  if(response.data.success) {
                    setToken(response.data.data.token);
                    setUserCurrent(JSON.stringify(response.data.data.user));
                    router.push({ name: "Products" });
                  }
                })
  },
  logout(router) {
    return axios.post('/api/logout', null, {
                  headers: {
                    Authorization: `Bearer ${getToken()}`,
                  },
                })
                .then((response) => {
                  if(response.data.success) {
                    clearToken();
                    clearUserCurrent();
                    router.push({ name: "Login" });
                  }
                })
  }
}

export default Auth;
