import { headers, getToken } from '../services/api';

const Products = {
  listProducts() {
    return axios.get(`/api/products/`, headers(getToken()))
  },
  addProduct(form) {
    return axios.post(`/api/products/`, form, headers(getToken()))
  },
  updateProduct(form, id) {
    return axios.put(`/api/products/${id}`, form, headers(getToken()))
  },
  deleteProduct(id) {
    return axios.delete(`/api/products/${id}`, headers(getToken()));
  }
}

export default Products;
