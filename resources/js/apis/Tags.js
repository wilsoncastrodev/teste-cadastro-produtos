import { headers, getToken } from '../services/api';

const Tags = {
  listTags() {
    return axios.get(`/api/tags/`, headers(getToken()))
  },
  addTag(form) {
    return axios.post(`/api/tags/`, form, headers(getToken()))
  },
  updateTag(form, id) {
    return axios.put(`/api/tags/${id}`, form, headers(getToken()))
  },
  deleteTag(id) {
    return axios.delete(`/api/tags/${id}`, headers(getToken()));
  }
}

export default Tags;
