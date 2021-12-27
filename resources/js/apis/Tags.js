import { headers } from '../services/api';

const Tags = {
  listTags() {
    return axios.get(`/api/tags/`, headers)
  },
  addTag(form) {
    return axios.post(`/api/tags/`, form, headers)
  },
  updateTag(form, id) {
    return axios.put(`/api/tags/${id}`, form, headers)
  },
  deleteTag(id) {
    return axios.delete(`/api/tags/${id}`, headers);
  }
}

export default Tags;
